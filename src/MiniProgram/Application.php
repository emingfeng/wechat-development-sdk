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

namespace eMingFeng\MiniProgram;

use eMingFeng\Kernel\core\ContainerBase;

/**
 * Class Application
 * @package eMingFeng\MiniProgram
 * @property \eMingFeng\MiniProgram\Ocr\Client                 $ocr                  OCR
 * @property \eMingFeng\MiniProgram\Bind\Client                $bind                 微信开放平台帐号管理
 * @property \eMingFeng\MiniProgram\Live\Live                  $live                 直播管理
 * @property \eMingFeng\MiniProgram\Soter\Client               $soter                生物认证
 * @property \eMingFeng\MiniProgram\Login\Client               $login                登录
 * @property \eMingFeng\MiniProgram\Image\Client               $image                图像处理
 * @property \eMingFeng\MiniProgram\Search\Client              $search               小程序搜索
 * @property \eMingFeng\MiniProgram\Plugin\Client              $plugin               插件管理
 * @property \eMingFeng\MiniProgram\Express\Client             $express              物流助手
 * @property \eMingFeng\MiniProgram\AppCode\Client             $app_code             小程序码管理
 * @property \eMingFeng\MiniProgram\Plugin\DevClient           $dev_plugin           插件管理
 * @property \eMingFeng\MiniProgram\Security\Client            $security             内容安全
 * @property \eMingFeng\MiniProgram\Delivery\Client            $delivery             即时配送
 * @property \eMingFeng\MiniProgram\Analysis\Client            $analysis             数据分析
 * @property \eMingFeng\MiniProgram\NearbyPoi\Client           $nearby_poi           附近的小程序
 * @property \eMingFeng\MiniProgram\Operation\Client           $operation            运维中心
 * @property \eMingFeng\MiniProgram\UrlScheme\Client           $url_scheme           获取小程序scheme码
 * @property \eMingFeng\MiniProgram\RiskControl\Client         $risk_control         安全风控
 * @property \eMingFeng\MiniProgram\ServiceMarket\Client       $service_market       服务市场
 *
 * @property \eMingFeng\OfficialAccount\Analysis\AdClient      $ad_analysis          广告分析
 *
 * @property \eMingFeng\MiniProgram\UniformMessage\Client      $uniform_message      统一服务消息
 * @property \eMingFeng\MiniProgram\CustomerMessage\Client     $customer_message     客服消息
 * @property \eMingFeng\MiniProgram\SubscribeMessage\Client    $subscribe_message    订阅消息
 * @property \eMingFeng\MiniProgram\UpdatableMessage\Client    $updatable_message    动态消息
 */

class Application extends ContainerBase
{
    protected $provider = [
        Ocr\ServiceProvider::class,
        Bind\ServiceProvider::class,
        Live\ServiceProvider::class,
        Soter\ServiceProvider::class,
        Login\ServiceProvider::class,
        Image\ServiceProvider::class,
        Search\ServiceProvider::class,
        Plugin\ServiceProvider::class,
        Express\ServiceProvider::class,
        AppCode\ServiceProvider::class,
        Security\ServiceProvider::class,
        Delivery\ServiceProvider::class,
        Analysis\ServiceProvider::class,
        NearbyPoi\ServiceProvider::class,
        Operation\ServiceProvider::class,
        UrlScheme\ServiceProvider::class,
        RiskControl\ServiceProvider::class,
        ServiceMarket\ServiceProvider::class,
        UniformMessage\ServiceProvider::class,
        CustomerMessage\ServiceProvider::class,
        SubscribeMessage\ServiceProvider::class,
        UpdatableMessage\ServiceProvider::class
    ];

    public function __call($method, $args)
    {
        return $this->$method(...$args);
    }
}