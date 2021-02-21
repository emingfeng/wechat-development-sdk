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
use eMingFeng\Kernel\Contracts\Tools;
use eMingFeng\Kernel\Exceptions\InvalidArgumentException;
use eMingFeng\Kernel\Exceptions\InvalidResponseException;

/**
 * Class BaseClient
 * @package eMingFeng\core
 */

class BaseClient
{
    /**
     * 当前微信配置
     * @var DataArray
     */
    protected $config;

    /**
     * 访问AccessToken
     * @var string
     */
    public $access_token = '';

    /**
     * 当前请求方法参数
     * @var array
     */
    protected $currentMethod = [];

    /**
     * 当前模式
     * @var bool
     */
    protected $isTry = false;

    /**
     * 静态缓存
     * @var static
     */
    protected static $cache;

    protected $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
        if (!empty($app->options['cache_path'])) {
            Tools::$cache_path = $app->options['cache_path'];
        }
        $this->config = new DataArray($app->options);
    }

    /**
     * 获取访问 访问令牌
     * @return string
     */
    public function getAccessToken()
    {
        if (!empty($this->access_token)) {
            return $this->access_token;
        }
        $cache = $this->config->get('appid') . '_access_token';

        $this->access_token = Tools::getCache($cache);
        if (!empty($this->access_token)) {
            return $this->access_token;
        }

        if ($this->config->get('component_appid'))
        {
            return $this->access_token = $this->refreshToken();
        }
        list($appid, $secret) = [$this->config->get('appid'), $this->config->get('appsecret')];

        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
        $result = Tools::json2arr(Tools::get($url));

        if (!empty($result['access_token'])) {
            Tools::setCache($cache, $result['access_token'], 7000);
        }
        return $this->access_token = $result['access_token'];
    }


    /**
     * 设置AccessToken
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        if (!is_string($accessToken)) {
            throw new InvalidArgumentException("Invalid AccessToken type, need string.");
        }
        $cache = $this->config->get('appid') . '_access_token';
        Tools::setCache($cache, $this->access_token = $accessToken);
    }

    public function getComponentAccessToken()
    {
        $cache = 'component_access_token';
        if (($componentAccessToken = Tools::getCache($cache))) {
            return $componentAccessToken;
        }
        $params = [
            'component_appid'         => $this->config->get('component_appid'),
            'component_appsecret'     => $this->config->get('component_appsecret'),
            'component_verify_ticket' => Tools::getCache('component_verify_ticket'),
        ];

        $url = 'https://api.weixin.qq.com/cgi-bin/component/api_component_token';
        $result = $this->httpPostForJson($url, $params);
        if (empty($result['component_access_token'])) {
            throw new InvalidResponseException($result['errmsg'], $result['errcode'], $result);
        }
        Tools::setCache($cache, $result['component_access_token'], 7000);
        return $result['component_access_token'];
    }

    public function refreshToken()
    {
        $appId = $this->config->get('appid');
        $cache = $appId . '_refresh_token';
        $refreshToken = Tools::getCache($cache);

        $componentAccessToken = $this->getComponentAccessToken();

        $url = "https://api.weixin.qq.com/cgi-bin/component/api_authorizer_token?component_access_token={$componentAccessToken}";
        $data = [
            'authorizer_appid'         => $appId,
            'authorizer_refresh_token' => $refreshToken,
            'component_appid'          => $this->config->get('component_appid'),
        ];
        $result = $this->httpPostForJson($url, $data);

        if (empty($result['authorizer_access_token'])) {
            throw new InvalidResponseException($result['errmsg'], $result['errcode'], $result);
        }
        Tools::setCache("{$appId}_access_token", $result['authorizer_access_token'], 7000);
        Tools::setCache("{$appId}_refresh_token", $result['authorizer_refresh_token'], 99999999);
        return $result['authorizer_access_token'];
    }

    /**
     * 清理删除 AccessToken
     * @return bool
     */
    public function delAccessToken()
    {

        if($this->config->get('component_appid'))
        {
            return $this->refreshToken();
        }
        $this->access_token = '';
        return Tools::delCache($this->config->get('appid') . '_access_token');
    }

    /**
     * 以GET获取接口数据并转为数组
     * @param string $url 接口地址
     * @return array
     * @throws \eMingFeng\Kernel\Exceptions\InvalidResponseException
     * @throws \eMingFeng\Kernel\Exceptions\LocalCacheException
     */
    protected function httpGetForJson($url)
    {

        try {
            return Tools::json2arr(Tools::get($url));
        } catch (InvalidResponseException $exception) {
            if (isset($this->currentMethod['method']) && empty($this->isTry)) {
                if (in_array($exception->getCode(), ['40014', '40001', '41001', '42001'])) {
                    [$this->delAccessToken(), $this->isTry = true];
                    return call_user_func_array([$this, $this->currentMethod['method']], $this->currentMethod['arguments']);
                }
            }
            throw new InvalidResponseException($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * 以POST获取接口数据并转为数组
     * @param string $url 接口地址
     * @param array $data 请求数据
     * @param bool $buildToJson
     * @return array
     * @throws \eMingFeng\Kernel\Exceptions\InvalidResponseException
     * @throws \eMingFeng\Kernel\Exceptions\LocalCacheException
     */
    protected function httpPostForJson($url, array $data, $buildToJson = true)
    {
        try {
            $options = [];
            if ($buildToJson) $options['headers'] = ['Content-Type: application/json'];
            return Tools::json2arr(Tools::post($url, $buildToJson ? Tools::arr2json($data) : $data, $options));
        } catch (InvalidResponseException $exception) {
            if (!$this->isTry && in_array($exception->getCode(), ['40014', '40001', '41001', '42001'])) {
                [$this->delAccessToken(), $this->isTry = true];
                return call_user_func_array([$this, $this->currentMethod['method']], $this->currentMethod['arguments']);
            }
            throw new InvalidResponseException($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * 下载文件
     * @param string $url 接口地址
     * @param array $data 请求数据
     * @return bool|mixed|string
     */
    protected function httpDownload($url, array $data)
    {
        try{
            return Tools::post($url, Tools::arr2json($data));
        } catch (InvalidResponseException $exception) {
            if (!$this->isTry && in_array($exception->getCode(), ['40014', '40001', '41001', '42001'])) {
                [$this->delAccessToken(), $this->isTry = true];
                return call_user_func_array([$this, $this->currentMethod['method']], $this->currentMethod['arguments']);
            }
            throw new InvalidResponseException($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * 上传文件
     * @param string $url 接口地址
     * @param string $file 文件地址
     * @param string $type 类型
     * @param array $form
     * @return mixed
     */
    protected function httpUpload($url, $file, $type, $form = [])
    {
        try{
            return Tools::Upload($url, $file, $type, $form);
        } catch (InvalidResponseException $exception) {
            if (!$this->isTry && in_array($exception->getCode(), ['40014', '40001', '41001', '42001'])) {
                [$this->delAccessToken(), $this->isTry = true];
                return call_user_func_array([$this, $this->currentMethod['method']], $this->currentMethod['arguments']);
            }
            throw new InvalidResponseException($exception->getMessage(), $exception->getCode());
        }
    }


    /**
     * Upload请求方法
     * @param string $url 接口URL
     * @param string $data 媒体
     * @param string $type 类型
     * @param array $data 接口参数
     */
    public function callUploadApi($url, $data, $type, $form = [])
    {

        $this->registerApi($url, __FUNCTION__, func_get_args());

        return $this->httpUpload($url, $data, $type, $form);
    }

    /**
     * Download请求方法
     * @param string $url 接口URL
     * @param array $data 接口参数
     * @return array

     */
    public function callDownloadApi($url, array $data)
    {
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpDownload($url, $data);
    }

    /**
     * 通用POST请求方法
     * @param string $url 接口URL
     * @param array $data POST提交接口参数
     * @param bool $isBuildJson
     * @return array
     */
    public function callPostApi($url, array $data, $isBuildJson = true)
    {
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data, $isBuildJson);
    }

    /**
     * 通用GET请求方法
     * @param string $url 接口URL
     * @return array
     */
    public function callGetApi($url)
    {
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpGetForJson($url);
    }

    /**
     * 注册当前请求接口
     * @param string $url 接口地址
     * @param string $method 当前接口方法
     * @param array $arguments 请求参数
     * @return string
     */
    protected function registerApi(&$url, $method, $arguments = [])
    {
        $this->currentMethod = ['method' => $method, 'arguments' => $arguments];
        if (empty($this->access_token)) $this->access_token = $this->getAccessToken();
        return $url = str_replace('ACCESS_TOKEN', urlencode($this->access_token), $url);
    }
}