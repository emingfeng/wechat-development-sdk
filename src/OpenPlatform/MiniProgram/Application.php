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

namespace eMingFeng\OpenPlatform\MiniProgram;

use eMingFeng\MiniProgram\Application as MiniProgram;

/**
 * Class Application
 * @package eMingFeng\OpenPlatform\MiniProgram
 * @property \eMingFeng\OpenPlatform\MiniProgram\Code\Client        $code          代码管理
 * @property \eMingFeng\OpenPlatform\MiniProgram\Live\Client        $live          小程序直播
 * @property \eMingFeng\OpenPlatform\MiniProgram\Tester\Client      $tester        成员管理
 * @property \eMingFeng\OpenPlatform\MiniProgram\QrCode\Client      $qrcode        普通链接二维码
 * @property \eMingFeng\OpenPlatform\MiniProgram\Domain\Client      $domain        域名设置
 * @property \eMingFeng\OpenPlatform\MiniProgram\Records\Client     $records       违规和申诉
 * @property \eMingFeng\OpenPlatform\MiniProgram\Setting\Client     $setting       基础信息设置，扫码关注组件，
 * @property \eMingFeng\OpenPlatform\MiniProgram\Account\Client     $account       基础信息设置
 * @property \eMingFeng\OpenPlatform\MiniProgram\Category\Client    $category      类目管理
 * @property \eMingFeng\OpenPlatform\MiniProgram\Scancode\Client    $scancode      扫码关注组件
 * @property \eMingFeng\OpenPlatform\MiniProgram\Delivery\Client    $delivery      即时配送
 */

class Application extends MiniProgram
{
    /**
     * Application constructor.
     */
    public function __construct(array $config = [], array $prepends = [])
    {
        parent::__construct($config, $prepends);

        $providers = [
            Code\ServiceProvider::class,
            Live\ServiceProvider::class,
            Tester\ServiceProvider::class,
            QrCode\ServiceProvider::class,
            Domain\ServiceProvider::class,
            Records\ServiceProvider::class,
            Setting\ServiceProvider::class,
            Account\ServiceProvider::class,
            Category\ServiceProvider::class,
            Scancode\ServiceProvider::class,
            Delivery\ServiceProvider::class
        ];

        foreach ($providers as $provider) {
            $this->serviceRegister(new $provider());
        }
    }

}
