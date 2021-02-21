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

namespace eMingFeng\OpenPlatform\Auth;

use eMingFeng\Kernel\Contracts\Tools;
use eMingFeng\Kernel\core\BaseClient;

class Client extends BaseClient
{
    /**
     * code换取session_key
     * @param string $appid 小程序的AppID
     * @param string $js_code 登录时获取的code
     * @return array
     */
    public function session(string $appid, string $js_code)
    {
        $component_appid = $this->config->get('component_appid');
        $component_access_token = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/sns/component/jscode2session?appid={$appid}&js_code={$js_code}&grant_type=authorization_code&component_appid={$component_appid}&component_access_token={$component_access_token}";
        return json_decode(Tools::get($url), true);
    }

    /**
     * oauth 授权跳转接口
     * @param string $appid 授权公众号或小程序的appid
     * @param string $redirectUri 回调地址
     * @param string $scope snsapi_userinfo|snsapi_base
     * @param string $state 重定向后会带上 state 参数，开发者可以填写任意参数值，最多 128 字节
     * @return string
     */
    public function getOauthRedirect(string $appid, string $redirectUri, string $scope, string $state)
    {
        $redirectUri = urlencode($redirectUri);
        $componentAppid = $this->config->get('component_appid');
        return "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirectUri}&response_type=code&scope={$scope}&state={$state}&component_appid={$componentAppid}#wechat_redirect";
    }

    /**
     * 通过code获取AccessToken
     * @param string $appid 授权公众号或小程序的appid
     * @return bool|array
     */
    public function getOauthAccessToken(string $appid)
    {
        if (empty($_REQUEST['code'])) {
            return false;
        }
        $componentAppid = $this->config->get('component_appid');
        $componentAccessToken = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/sns/oauth2/component/access_token?appid={$appid}&code={$_GET['code']}&grant_type=authorization_code&component_appid={$componentAppid}&component_access_token={$componentAccessToken}";
        $result = $this->httpGetForJson($url);
        Tools::setCache("{$appid}_oauth_access_token", $result['access_token'], 7000);
        Tools::setCache("{$appid}_oauth_refresh_token", $result['refresh_token'], 99999999);
        return $result;
    }

    /**
     * 刷新 access_token（如果需要）
     * @param string $appid
     * @return array
     */
    public function oauthRefreshToken(string $appid)
    {
        $refreshToken = Tools::getCache("{$appid}_oauth_refresh_token");
        $componentAppid = $this->config->get('component_appid');
        $componentAccessToken = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/sns/oauth2/component/refresh_token?appid={$appid}&grant_type=refresh_token&component_appid={$componentAppid}&component_access_token={$componentAccessToken}&refresh_token={$refreshToken}";
        return $this->httpGetForJson($url);
    }

    /**
     * 通过网页授权 access_token 获取用户基本信息（需授权作用域为 snsapi_userinfo）
     * @param string $accessToken 网页授权接口调用凭证,注意：此 access_token 与基础支持的 access_token 不同
     * @param string $openid 用户的唯一标识
     * @param string $lang 返回国家地区语言版本，zh_CN 简体，zh_TW 繁体，en 英语
     */
    public function getUserInfo(string $openid, string $lang = 'zh_CN', string $accessToken)
    {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$accessToken}&openid={$openid}&lang={$lang}";
        return $this->httpGetForJson($url);
    }
}