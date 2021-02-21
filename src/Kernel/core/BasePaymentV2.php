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

use eMingFeng\PaymentV2\Application;
use eMingFeng\Kernel\Contracts\DataArray;
use eMingFeng\Kernel\Contracts\Tools;
use eMingFeng\Kernel\Exceptions\InvalidArgumentException;
use eMingFeng\Kernel\Exceptions\InvalidResponseException;

/**
 * 微信支付基础类V2
 * Class BasePaymentV2
 * @package eMingFeng\Kernel\core
 */

class BasePaymentV2
{

    protected $base = 'https://api.mch.weixin.qq.com/';

    /**
     * 商户配置
     * @var DataArray
     */
    protected $config;

    /**
     * 当前请求数据
     * @var DataArray
     */
    protected $params;

    /**
     * 静态缓存
     * @var static
     */
    protected static $cache;

    /**
     * WeChat constructor.
     * @param array $options
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
        if (empty($app->options['appid'])) {
            throw new InvalidArgumentException("Missing Config -- [appid]");
        }
        if (empty($app->options['mch_id'])) {
            throw new InvalidArgumentException("Missing Config -- [mch_id]");
        }
        if (empty($app->options['mch_key'])) {
            throw new InvalidArgumentException("Missing Config -- [mch_key]");
        }
        if (!empty($app->options['cache_path'])) {
            Tools::$cache_path = $app->options['cache_path'];
        }
        $this->config = new DataArray($app->options);
        // 商户基础参数
        $this->params = new DataArray([
            'appid'     => $this->config->get('appid'),
            'mch_id'    => $this->config->get('mch_id'),
            'nonce_str' => Tools::createNoncestr(),
        ]);
        // 商户参数支持
        if ($this->config->get('sub_appid')) {
            $this->params->set('sub_appid', $this->config->get('sub_appid'));
        }
        if ($this->config->get('sub_mch_id')) {
            $this->params->set('sub_mch_id', $this->config->get('sub_mch_id'));
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
     * 获取微信支付通知
     * @return array
     * @throws InvalidResponseException
     */
    public function getNotify()
    {
        $data = Tools::xml2arr(file_get_contents('php://input'));
        if (isset($data['sign']) && $this->getPaySign($data) === $data['sign']) {
            return $data;
        }
        throw new InvalidResponseException('Invalid Notify.', '0');
    }

    /**
     * 获取微信支付通知回复内容
     * @return string
     */
    public function getNotifySuccessReply()
    {
        return Tools::arr2xml(['return_code' => 'SUCCESS', 'return_msg' => 'OK']);
    }

    /**
     * 生成支付签名
     * @param array $data 参与签名的数据
     * @param string $signType 参与签名的类型
     * @param string $buff 参与签名字符串前缀
     * @return string
     */
    public function getPaySign(array $data, $signType = 'MD5', $buff = '')
    {
        ksort($data);
        if (isset($data['sign'])) unset($data['sign']);
        foreach ($data as $k => $v) $buff .= "{$k}={$v}&";
        $buff .= ("key=" . $this->app->getKey());
        if (strtoupper($signType) === 'MD5') {
            return strtoupper(md5($buff));
        }
        return strtoupper(hash_hmac('SHA256', $buff, $this->config->get('mch_key')));
    }

    public function getSandboxSign(array $data, $signType = 'MD5', $buff = '')
    {
        ksort($data);
        if (isset($data['sign'])) unset($data['sign']);
        foreach ($data as $k => $v) $buff .= "{$k}={$v}&";
        $buff .= ("key=" . $this->config->get('mch_key'));

        if (strtoupper($signType) === 'MD5') {
            return strtoupper(md5($buff));
        }
        return strtoupper(hash_hmac('SHA256', $buff, $this->config->get('mch_key')));

    }

    /**
     * 转换短链接
     * @param string $longUrl 需要转换的URL，签名用原串，传输需URLencode
     * @return array
     */
    public function shortUrl($longUrl)
    {
        $url = $this->base.'tools/shorturl';
        return $this->callPostApi($url, ['long_url' => $longUrl]);
    }

    /**
     * 数组直接转xml数据输出
     * @param array $data
     * @param bool $isReturn
     * @return string
     */
    public function toXml(array $data, $isReturn = false)
    {
        $xml = Tools::arr2xml($data);
        if ($isReturn) {
            return $xml;
        }
        echo $xml;
    }
    protected function callSandbox($url,$signType = 'MD5')
    {

        $option['headers'] = ['Content-Type: application/xml'];
        $url = $this->base.$url;

        $params = $this->params->merge([]);

        $params['sign'] = $this->getSandboxSign($params, 'MD5');
        $result = Tools::xml2arr(Tools::post($url, Tools::arr2xml($params), $option));

        if ($result['return_code'] !== 'SUCCESS') {
            if($result['return_msg'])
                throw new InvalidResponseException($result['return_msg'], '0');
            throw new InvalidResponseException($result['retmsg'], $result['retcode']);
        }
        return $result;
    }

    /**
     * 以Post请求接口
     * @param string $url 请求
     * @param array $data 接口参数
     * @param bool $isCert 是否需要使用双向证书
     * @param string $signType 数据签名类型 MD5|SHA256
     * @param bool $needSignType 是否需要传签名类型参数
     * @return array
     * @throws InvalidResponseException
     * @throws InvalidArgumentException
     */
    protected function callPostApi($url, array $data, $isCert = false, $signType = 'HMAC-SHA256', $needSignType = true)
    {
        $option = ['Content-Type: application/xml'];
        if ($isCert) {
            $option['ssl_p12'] = $this->config->get('ssl_p12');
            $option['ssl_cer'] = $this->config->get('ssl_cer');
            $option['ssl_key'] = $this->config->get('ssl_key');
            if (is_string($option['ssl_p12']) && file_exists($option['ssl_p12'])) {
                $content = file_get_contents($option['ssl_p12']);
                if (openssl_pkcs12_read($content, $certs, $this->config->get('mch_id'))) {
                    $option['ssl_key'] = Tools::pushFile(md5($certs['pkey']) . '.pem', $certs['pkey']);
                    $option['ssl_cer'] = Tools::pushFile(md5($certs['cert']) . '.pem', $certs['cert']);
                } else throw new InvalidArgumentException("P12 certificate does not match MCH_ID --- ssl_p12");
            }
            if (empty($option['ssl_cer']) || !file_exists($option['ssl_cer'])) {
                throw new InvalidArgumentException("Missing Config -- ssl_cer", '0');
            }
            if (empty($option['ssl_key']) || !file_exists($option['ssl_key'])) {
                throw new InvalidArgumentException("Missing Config -- ssl_key", '0');
            }
        }

        $params = $this->params->merge($data);
        $needSignType && ($params['sign_type'] = strtoupper($signType));
        $params['sign'] = $this->getPaySign($params, $signType);
        $result = Tools::xml2arr(Tools::post($url, Tools::arr2xml($params), $option));



        if ($result['return_code'] !== 'SUCCESS') {
            if($result['return_msg'])
                throw new InvalidResponseException($result['return_msg'], '0');
            throw new InvalidResponseException($result['retmsg'], $result['retcode']);
        }


        return $result;
    }

    /**
     * 切换正式/沙箱
     * @param $url
     * @return string
     */
    public function wrap($url)
    {
        return $this->app->isSandbox() ? $this->base."sandboxnew/{$url}" : $this->base.$url;
    }
}