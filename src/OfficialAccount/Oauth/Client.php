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

namespace eMingFeng\OfficialAccount\Oauth;

use eMingFeng\Kernel\Contracts\Tools;
use eMingFeng\Kernel\core\BaseClient;

/**
 * 网页授权
 * Class Oauth
 * @package eMingFeng\OfficialAccount\Oauth
 * @officialaccount doc https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/Wechat_webpage_authorization.html
 */

class Client extends BaseClient
{
    /**
     * oauth 授权跳转接口
     * @param string $redirectUri 回调地址
     * @param string $scope snsapi_userinfo|snsapi_base
     * @param string $state 重定向后会带上 state 参数，开发者可以填写任意参数值，最多 128 字节
     * @return string
     */
    public function getOauthRedirect(string $redirectUri, string $scope, string $state)
    {
        $appid = $this->config->get('appid');
        $redirectUri = urlencode($redirectUri);
        return "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirectUri}&response_type=code&scope={$scope}&state={$state}#wechat_redirect";
    }

    /**
     * 通过code获取AccessToken
     * @return bool|array
     */
    public function getOauthAccessToken()
    {
        if (empty($_REQUEST['code'])) {
            return false;
        }
        $appid = $this->config->get('appid');
        $appsecret = $this->config->get('appsecret');
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$appsecret}&code={$_REQUEST['code']}&grant_type=authorization_code";
        $result = $this->httpGetForJson($url);
        Tools::setCache("{$appid}_oauth_access_token", $result['access_token'], 7000);
        Tools::setCache("{$appid}_oauth_refresh_token", $result['refresh_token'], 99999999);
        return $result;
    }

    /**
     * 刷新 access_token（如果需要）
     * @return array
     */
    public function oauthRefreshToken()
    {
        $appid = $this->config->get('appid');
        $refresh_token = Tools::getCache("{$appid}_oauth_refresh_token");
        $url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid={$appid}&grant_type=refresh_token&refresh_token={$refresh_token}";
        $result = $this->httpGetForJson($url);
        Tools::setCache("{$appid}_oauth_access_token", $result['access_token'], 7000);
        Tools::setCache("{$appid}_oauth_refresh_token", $result['refresh_token'], 99999999);
        return $result;
    }

    /**
     * 通过网页授权 access_token 获取用户基本信息（需授权作用域为 snsapi_userinfo）
     * @param string $access_token 网页授权接口调用凭证,注意：此 access_token 与基础支持的 access_token 不同
     * @param string $openid 用户的唯一标识
     * @param string $lang 返回国家地区语言版本，zh_CN 简体，zh_TW 繁体，en 英语
     */
    public function getUserInfo(string $openid, string $lang = 'zh_CN', string $access_token)
    {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang={$lang}";
        return $this->httpGetForJson($url);
    }

}