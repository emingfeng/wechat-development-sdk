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

namespace eMingFeng\OpenPlatform\Base;

use eMingFeng\Kernel\Contracts\DataArray;
use eMingFeng\Kernel\Contracts\Tools;
use eMingFeng\Kernel\Exceptions\InvalidArgumentException;
use eMingFeng\Kernel\Exceptions\InvalidResponseException;
use eMingFeng\Kernel\core\BaseClient;
use eMingFeng\Kernel\core\BasePushEvent as Receive;

class Client extends BaseClient
{

    protected $config;

    public function __construct($options)
    {

        if(empty($options['cache_path'])){
            $options = $options->options;
        }
        if (!empty($options['cache_path'])) {
            Tools::$cache_path = $options['cache_path'];
        }
        $this->config = new DataArray($options);
    }

    /**
     * 处理公众平台推送的授权事件
     * @return array
     */
    public function handleAuthorizationEvent()
    {
        $receive = new Receive([
            'token'          => $this->config->get('component_token'),
            'appid'          => $this->config->get('component_appid'),
            'appsecret'      => $this->config->get('component_appsecret'),
            'encodingaeskey' => $this->config->get('component_encodingaeskey'),
            'cache_path'     => $this->config->get('cache_path'),
        ]);
        $data = $receive->getReceive();
        if (!empty($data['ComponentVerifyTicket'])) {
            Tools::setCache('component_verify_ticket', $data['ComponentVerifyTicket']);
        }
        return $data;
    }

    /**
     * 启动（检测）ticket推送服务
     * @return array
     */
    public function startPushTicket()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/component/api_start_push_ticket";
        $data = [
            'component_appid' => $this->config->get('component_appid'),
            'component_secret' => $this->config->get('component_appsecret')
        ];
        return $this->httpPostForJson($url, $data);
    }



    /**
     * 获取预授权码
     * @return string
     */
    public function createPreAuthCode()
    {
        $componentAccessToken = $this->getCAT();
        $url = "https://api.weixin.qq.com/cgi-bin/component/api_create_preauthcode?component_access_token={$componentAccessToken}";
        $params = ['component_appid' => $this->config->get('component_appid')];
        $result = $this->httpPostForJson($url, $params);
        if (empty($result['pre_auth_code'])) {
            throw new InvalidResponseException('GetPreauthCode Faild.', '0', $result);
        }
        return $result['pre_auth_code'];
    }

    /**
     * 获取授权页网址
     * @param string $redirectUri 回调URI
     * @param integer $authType 1 仅展示公众号、2 仅展示小程序，3 公众号和小程序都展示
     * @return string
     */
    public function getAuthUrl(string $redirectUri, int $authType = 3)
    {
        $queries = [
            'auth_type'         => $authType,
            'redirect_uri'      => $redirectUri,
            'pre_auth_code'     => $this->createPreAuthCode(),
            'component_appid'   => $this->config->get('component_appid')
        ];
        return 'https://mp.weixin.qq.com/cgi-bin/componentloginpage?'.http_build_query($queries);
    }

    /**
     * 使用授权码获取授权信息
     * @param null $authCode 授权码
     * @return bool|array
     */
    public function handleAuthorize(string $authCode = null)
    {

        if (is_null($authCode) && isset($_REQUEST['auth_code'])) {
            $authCode = $_GET['auth_code'];
        }
        if (empty($authCode)) {
            throw new InvalidArgumentException('Request auth_code !');
        }
        $componentAccessToken = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/component/api_query_auth?component_access_token={$componentAccessToken}";
        $params = [
            'authorization_code' => $authCode,
            'component_appid'    => $this->config->get('component_appid'),
        ];
        $result = $this->httpPostForJson($url, $params);
        if (empty($result['authorization_info'])) {
            throw new InvalidResponseException($result['errmsg'], $result['errcode'], $params);
        }

        $appId = $result['authorization_info']['authorizer_appid'];
        $accessToken = $result['authorization_info']['authorizer_access_token'];
        $refreshToken = $result['authorization_info']['authorizer_refresh_token'];

        Tools::setCache("{$appId}_refresh_token", $refreshToken, 99999999);
        Tools::setCache("{$appId}_access_token", $accessToken, 7000);
        return $result['authorization_info'];
    }

    /**
     * 获取（刷新）令牌
     * @param string $appid 授权公众号或小程序的appid
     * @param string $refreshToken 授权方的刷新令牌
     * @return array
     */
    public function refreshAccessToken(string $appId, string $refreshToken = null)
    {
        $refreshToken = Tools::getCache("{$appId}_refresh_token");
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
        Tools::setCache("{$appId}_access_token", $result['authorizer_refresh_token'], 99999999);
        return $result;
    }

    /**
     * 获取授权方的帐号基本信息
     * @param string $appId 授权公众号或小程序的appid
     * @return array
     */
    public function getAuthorizer(string $appId)
    {
        $componentAccessToken = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/component/api_get_authorizer_info?component_access_token={$componentAccessToken}";
        $params = [
            'authorizer_appid' => $appId,
            'component_appid'  => $this->config->get('component_appid'),
        ];
        $result = $this->httpPostForJson($url, $params);
        if (empty($result['authorizer_info'])) {
            throw new InvalidResponseException($result['errmsg'], $result['errcode'], $result);
        }
        return $result['authorizer_info'];
    }

    /**
     * 获取授权方选项信息
     * @param string $appId 授权公众号或小程序的appid
     * @param string $name 选项名称
     * location_report	地理位置上报选项	0	无上报  1	进入会话时上报  2	每 5s 上报
     * voice_recognize	语音识别开关选项	0	关闭语音识别 1	开启语音识别
     * customer_service	多客服开关选项	0	关闭多客服 1	开启多客服
     * @return array
     */
    public function getAuthorizerOption(string $appId, string $name)
    {
        $componentAccessToken = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/component/api_get_authorizer_option?component_access_token={$componentAccessToken}";
        $params = [
            'option_name'      => $name,
            'authorizer_appid' => $appId,
            'component_appid'  => $this->config->get('component_appid'),
        ];
        $result = $this->httpPostForJson($url, $params);
        return $result;
    }

    /**
     * 设置授权方的选项信息
     * @param string $appId 授权公众号或小程序的appid
     * @param string $name 选项名称
     * @param string $value 设置的选项值
     * @return array
     */
    public function setAuthorizerOption(string $appId, string $name, string $value)
    {
        $componentAccessToken = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/component/api_set_authorizer_option?component_access_token={$componentAccessToken}";
        $params = [
            'option_name'      => $name,
            'option_value'     => $value,
            'authorizer_appid' => $appId,
            'component_appid'  => $this->config->get('component_appid'),
        ];
        return $this->httpPostForJson($url, $params);
    }

    /**
     * 拉取所有已授权的帐号信息
     * @param int $count 拉取数量，最大为500
     * @param int $offset 偏移位置/起始位置
     * @return array
     */
    public function getAuthorizers(int $offset = 0, int $count = 500)
    {
        $componentAccessToken = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/component/api_get_authorizer_list?component_access_token={$componentAccessToken}";
        $params = ['count' => $count, 'offset' => $offset, 'component_appid' => $this->config->get('component_appid')];
        return $this->httpPostForJson($url, $params);
    }

    /**
     * 对第三方平台所有API调用次数清零
     * @return array
     */
    public function clearQuota()
    {
        $componentAccessToken = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/component/clear_quota?component_access_token={$componentAccessToken}";
        $params = ['component_appid' => $this->config->get('component_appid')];
        return $this->httpPostForJson($url, $params);
    }

    /**
     * 获取微信API接口 IP地址
     * @return array
     */
    public function getApiDomainIp()
    {
        $componentAccessToken = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/get_api_domain_ip?access_token={$componentAccessToken}";
        return $this->httpGetForJson($url);
    }

    /**
     * 获取微信callback IP地址
     * @return array
     */
    public function getCallbackIp()
    {
        $componentAccessToken = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token={$componentAccessToken}";
        return $this->httpGetForJson($url);
    }


    /**
     * 确认接受公众号将某权限集高级权限的授权
     * @param string $appid 授权公众号或小程序的appid
     * @param string $funcscopeCategoryId 权限集ID
     * @param string $value 是否确认(1.确认授权, 2.取消确认)
     * @return array
     * @throws InvalidResponseException
     * @throws \OfficialAccount\Exceptions\LocalCacheException
     */
    public function setAuthorization(string $appid, string $funcscopeCategoryId, string $value)
    {
        $componentAccessToken = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/component/api_confirm_authorization?component_access_token={$componentAccessToken}";
        return $this->httpPostForJson($url, [
            'confirm_value'         => $value,
            'authorizer_appid'      => $appid,
            'funcscope_category_id' => $funcscopeCategoryId,
            'component_appid'       => $this->config->get('component_appid'),
        ]);
    }



    /**
     * 获取授权公众号\小程序配置参数
     * @param string $appid 授权公众号的appid
     * @return array
     */
    public function getConfigs(string $appid)
    {
        $config = $this->config->get();
        $config['appid'] = $appid;
        $config['token'] = $this->config->get('component_token');
        $config['appsecret'] = $this->config->get('component_appsecret');
        $config['encodingaeskey'] = $this->config->get('component_encodingaeskey');
        return $config;
    }
}