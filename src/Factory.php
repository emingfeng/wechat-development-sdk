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

namespace eMingFeng;

/**
 * class Factory
 * @method static \eMingFeng\PaymentV2\Application         PaymentV2(array $config)
 * @method static \eMingFeng\PaymentV3\Application         PaymentV3(array $config)
 * @method static \eMingFeng\MiniProgram\Application       MiniProgram(array $config)
 * @method static \eMingFeng\OpenPlatform\Application      OpenPlatform(array $config)
 * @method static \eMingFeng\OfficialAccount\Application   OfficialAccount(array $config)
 */

class Factory
{
    /**
     * @param string $name
     * @param array  $config
     */
    public static function make($name, array $config)
    {
        $application = "\\eMingFeng\\{$name}\\Application";

        return new $application($config);
    }
    /**
     * @param string $name
     * @param array  $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}
