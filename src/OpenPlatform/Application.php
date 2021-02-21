<?php
namespace eMingFeng\OpenPlatform;

use eMingFeng\Kernel\core\ContainerBase;
use eMingFeng\OpenPlatform\MiniProgram\Application as MiniProgram;
use eMingFeng\OpenPlatform\OfficialAccount\Application as OfficialAccount;

/**
 * Class Application
 * @package eMingFeng\OpenPlatform
 * @method handleAuthorizationEvent()
 * @method handleAuthorize(string $authCode = null)
 * @method clearQuota()
 * @method getComponentAccessToken()
 * @method createPreAuthCode()
 * @method refreshAccessToken(string $appId);
 * @method getAuthUrl(string $redirectUri, int $authType = 3)
 * @method getAuthorizer($appId)
 * @method getAuthorizers(int $count = 500, int $offset = 0)
 * @method getAuthorizerOption(string $appId, string $name)
 * @method setAuthorizerOption(string $appId, string $name, string $value)
 *
 * @property \eMingFeng\OpenPlatform\Base\Client            $base           第三方基础业务
 * @property \eMingFeng\OpenPlatform\Auth\Client            $auth           登录授权
 * @property \eMingFeng\OpenPlatform\Beta\Client            $beta           试用小程序
 * @property \eMingFeng\OpenPlatform\Oauth\Client           $oauth          网站应用
 * @property \eMingFeng\OpenPlatform\FastRegister\Client    $fast_register  代注册小程序
 * @property \eMingFeng\OpenPlatform\ServiceMarket\Client   $service_market 调用服务平台接口
 * @property \eMingFeng\OpenPlatform\CodeTemplate\Client    $code_template  代码库模板设置
 */
class Application extends ContainerBase
{


    public function __construct($options = array())
    {
        parent::__construct($options);
    }

    protected $provider = [
        Base\ServiceProvider::class,
        Auth\ServiceProvider::class,
        Beta\ServiceProvider::class,
        Oauth\ServiceProvider::class,
        FastRegister\ServiceProvider::class,
        CodeTemplate\ServiceProvider::class,
        ServiceMarket\ServiceProvider::class
    ];

    protected function getAuthorizerConfig(string $appId, string $refreshToken = null): array
    {
        $old = $this->options;
        return $new = array_merge($old,[
            'appid'              => $appId,
            'token'              => $old['component_token'],
            'appsecret'          => $old['component_appsecret'],
            'encodingaeskey'     => $old['component_encodingaeskey'],
            'refresh_token'      => $refreshToken
        ]);
    }
    public function officialAccount($appId, $refreshToken = null)
    {
        return new OfficialAccount($this->getAuthorizerConfig($appId,$refreshToken));
    }
    public function miniProgram($appId, $refreshToken = null)
    {
        return new MiniProgram($this->getAuthorizerConfig($appId,$refreshToken));
    }

    public function __call($method, $args)
    {
        return $this->base->$method(...$args);

    }
}