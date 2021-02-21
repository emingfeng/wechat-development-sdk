<?php
// +----------------------------------------------------------------------
// | Wechat Developmet SDK
// +----------------------------------------------------------------------
// | 版权所有 2017~2020 凤凰县铭锋计算机科技有限公司
// +----------------------------------------------------------------------
// | 官方网站: https://www.emingfeng.com
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | gitee ：https://gitee.com/emingfeng/wechat-development-sdk
// | github：https://github.com/eMingFeng/wechat-development-sdk
// +----------------------------------------------------------------------

namespace eMingFeng\Kernel\core;

use eMingFeng\Kernel\Contracts\DataArray;
use eMingFeng\PaymentV3\Cert\Client;
use eMingFeng\Kernel\Contracts\Tools;
use eMingFeng\Kernel\Exceptions\InvalidArgumentException;
use eMingFeng\Kernel\Exceptions\InvalidResponseException;
use eMingFeng\Kernel\Exceptions\LocalCacheException;

/**
 * 微信支付基础类V3
 * Class BasePaymentV3
 * @package eMingFeng\Kernel\core
 */

abstract class BasePaymentV3
{
    /**
     * 接口基础地址
     * @var string
     */
    protected $base = 'https://api.mch.weixin.qq.com';

    /**
     * 实例对象静态缓存
     * @var array
     */
    static $cache = [];



    /**
     * BasicWePayV3 constructor.
     * @param array $options [mch_id, mch_v3_key, cert_public, cert_private]
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
        if (empty($app->options['mch_id'])) {
            throw new InvalidArgumentException("Missing Config -- [mch_id]");
        }
        if (empty($app->options['mch_v3_key'])) {
            throw new InvalidArgumentException("Missing Config -- [mch_v3_key]");
        }
        if (empty($app->options['cert_private'])) {
            throw new InvalidArgumentException("Missing Config -- [cert_private]");
        }
        if (empty($app->options['cert_public'])) {
            throw new InvalidArgumentException("Missing Config -- [cert_public]");
        }
        $this->config = new DataArray($app->options);

        $this->config['appid'] = isset($app->options['appid']) ? $app->options['appid'] : '';
        $this->config['mch_id'] = $app->options['mch_id'];
        $this->config['mch_v3_key'] = $app->options['mch_v3_key'];
        $this->config['cert_public'] = $app->options['cert_public'];
        $this->config['cert_private'] = $app->options['cert_private'];
        $this->config['cert_serial'] = openssl_x509_parse($this->config['cert_public'])['serialNumberHex'];

        if (empty($this->config['cert_serial'])) {
            throw new InvalidArgumentException("Failed to parse certificate public key");
        }
    }

    /**
     * 静态创建对象
     * @param array $config
     * @return static
     */
    public static function instance(array $config)
    {
        $key = md5(get_called_class() . serialize($config));
        if (isset(self::$cache[$key])) return self::$cache[$key];
        return self::$cache[$key] = new static($config);
    }

    /**
     * 模拟发起请求
     * @param string $method 请求访问
     * @param string $pathinfo 请求路由
     * @param string $jsondata 请求数据
     * @param bool $verify 是否验证
     * @return array
     * @throws InvalidResponseException
     */
    public function doRequest($method, $pathinfo, $jsondata = '', $verify = false)
    {
        list($time, $nonce) = [time(), uniqid() . rand(1000, 9999)];
        $signstr = join("\n", [$method, $pathinfo, $time, $nonce, $jsondata, '']);
        // 生成数据签名TOKEN
        $token = sprintf('mchid="%s",nonce_str="%s",timestamp="%d",serial_no="%s",signature="%s"',
            $this->config['mch_id'], $nonce, $time, $this->config['cert_serial'], $this->signBuild($signstr)
        );
        list($header, $content) = $this->_doRequestCurl($method, $this->base . $pathinfo, [
            'data' => $jsondata, 'header' => [
                "Accept: application/json", "Content-Type: application/json",
                'User-Agent: https://thinkadmin.top', "Authorization: WECHATPAY2-SHA256-RSA2048 {$token}",
            ],
        ]);
        if ($verify) {
            $headers = [];
            foreach (explode("\n", $header) as $line) {
                if (stripos($line, 'Wechatpay') !== false) {
                    list($name, $value) = explode(':', $line);
                    list(, $keys) = explode('wechatpay-', strtolower($name));
                    $headers[$keys] = trim($value);
                }
            }
            try {
                $string = join("\n", [$headers['timestamp'], $headers['nonce'], $content, '']);
                if (!$this->signVerify($string, $headers['signature'], $headers['serial'])) {
                    throw new InvalidResponseException("验证响应签名失败");
                }
            } catch (\Exception $exception) {
                throw new InvalidResponseException($exception->getMessage(), $exception->getCode());
            }
        }
        return json_decode($content, true);
    }

    /**
     * 通过CURL模拟网络请求
     * @param string $method 请求方法
     * @param string $location 请求方法
     * @param array $options 请求参数 [data, header]
     * @return array [header,content]
     */
    private function _doRequestCurl($method, $location, $options = [])
    {
        $curl = curl_init();
        // POST数据设置
        if (strtolower($method) === 'post') {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $options['data']);
        }
        // CURL头信息设置
        if (!empty($options['header'])) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $options['header']);
        }
        curl_setopt($curl, CURLOPT_URL, $location);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $content = curl_exec($curl);
        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        curl_close($curl);
        return [substr($content, 0, $headerSize), substr($content, $headerSize)];
    }

    /**
     * 生成数据签名
     * @param string $data 签名内容
     * @return string
     */
    protected function signBuild($data)
    {
        $pkeyid = openssl_pkey_get_private($this->config['cert_private']);
        openssl_sign($data, $signature, $pkeyid, 'sha256WithRSAEncryption');
        return base64_encode($signature);
    }

    /**
     * 验证内容签名
     * @param string $data 签名内容
     * @param string $sign 原签名值
     * @param string $serial 证书序号
     * @return int
     * @throws InvalidResponseException
     * @throws LocalCacheException
     */
    protected function signVerify($data, $sign, $serial = '')
    {
        $cert = $this->tmpFile($serial);
        if (empty($cert)) {
            Client::instance($this->config)->download();
            $cert = $this->tmpFile($serial);
        }
        return @openssl_verify($data, base64_decode($sign), openssl_x509_read($cert), 'sha256WithRSAEncryption');
    }

    /**
     * 写入或读取临时文件
     * @param string $name
     * @param null|string $content
     * @return string
     * @throws LocalCacheException
     */
    protected function tmpFile($name, $content = null)
    {
        if (is_null($content)) {
            return base64_decode(Tools::getCache($name) ?: '');
        } else {
            return Tools::setCache($name, base64_encode($content), 7200);
        }
    }
}