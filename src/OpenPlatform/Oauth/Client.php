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

namespace eMingFeng\OpenPlatform\Oauth;

use eMingFeng\Kernel\Contracts\DataArray;
use eMingFeng\Kernel\Contracts\Tools;
use eMingFeng\Kernel\Exceptions\InvalidArgumentException;
use eMingFeng\Kernel\core\BaseClient;

/**
 * 网站应用微信登录
 * Class WechatLogin
 * @package OpenPlatform
 * @doc https://developers.weixin.qq.com/doc/oplatform/Website_App/WeChat_Login/Wechat_Login.html
 */
class Client extends BaseClient
{
    /**
     * 当前配置对象
     * @var DataArray
     */
    protected $config;

    /**
     * UserClient constructor.
     * @param array $options
     */

    public function __construct(array $options)
    {
        if (empty($options['appid'])) {
            throw new InvalidArgumentException("Missing Config -- [appid]");
        }
        if (empty($options['appsecret'])) {
            throw new InvalidArgumentException("Missing Config -- [appsecret]");
        }
        $this->config = new DataArray($options);
    }

    /**
     * 请求CODE
     * @param string $redirectUri 重定向地址
     * @param string $state 授权请求后原样带回给第三方
     * @return string
     */
    public function auth(string $redirectUri, string $state)
    {
        $appid = $this->config->get('appid');
        $redirectUri = urlencode($redirectUri);
        return "https://open.weixin.qq.com/connect/qrconnect?appid={$appid}&redirect_uri={$redirectUri}&response_type=code&scope=snsapi_login&state={$state}#wechat_redirect";
    }

    /**
     * 通过code获取access_token
     * @return array
     */
    public function accessToken()
    {
        $appid = $this->config->get('appid');
        $secret = $this->config->get('appsecret');
        $code = isset($_GET['code']) ? $_GET['code'] : '';
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code={$code}&grant_type=authorization_code";
        return json_decode(Tools::get($url));
    }

    /**
     * 刷新或续期access_token使用
     * @param string $refreshToken
     * @return array
     */
    public function refreshToken($refreshToken)
    {
        $appid = $this->config->get('appid');
        $url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid={$appid}&grant_type=refresh_token&refresh_token={$refreshToken}";
        return json_decode(Tools::get($url));
    }

    /**
     * 检验授权凭证（access_token）是否有效
     * @param string $accessToken 调用凭证
     * @param string $openid 普通用户的标识，对当前开发者帐号唯一
     * @return array
     */
    public function checkAccessToken($accessToken, $openid)
    {
        $url = "https://api.weixin.qq.com/sns/auth?access_token={$accessToken}&openid={$openid}";
        return json_decode(Tools::get($url));
    }

    /**
     * 获取用户个人信息（UnionID机制）
     * @param string $accessToken 调用凭证
     * @param string $openid 普通用户的标识，对当前开发者帐号唯一
     * @return array
     */
    public function getUserinfo($accessToken, $openid)
    {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$accessToken}&openid={$openid}";
        return json_decode(Tools::get($url));
    }

}