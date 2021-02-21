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

namespace eMingFeng\OpenPlatform\OfficialAccount;

use eMingFeng\OfficialAccount\Application as OfficialAccount;

/**
 * Class Application
 * @package eMingFeng\OpenPlatform\OfficialAccount
 * @property \eMingFeng\OpenPlatform\OfficialAccount\MiniProgram\Client    $miniprogram    代码管理
 */

class Application extends OfficialAccount
{
    /**
     * Application constructor.
     * @param array $config
     * @param array $prepends
     */
    public function __construct(array $config = [], array $prepends = [])
    {
        parent::__construct($config, $prepends);

        $providers = [
            MiniProgram\ServiceProvider::class,
        ];

        foreach ($providers as $provider) {
            $this->serviceRegister(new $provider());
        }
    }
}
