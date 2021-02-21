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

namespace eMingFeng\OfficialAccount\Card;

use eMingFeng\Kernel\core\Container;
use eMingFeng\Kernel\interfaces\Provider;

class ServiceProvider implements Provider
{
    public function serviceProvider(Container $container)
    {
        $container['card'] = function ($container){
            return new Card($container);
        };
        $container['card.create'] = function ($container){
            return new Client($container);
        };
        $container['card.distributing'] = function ($container){
            return new Distributing($container);
        };
        $container['card.redeeming'] = function ($container){
            return new Redeeming($container);
        };
        $container['card.managing'] = function ($container){
            return new Managing($container);
        };
        $container['card.membership'] = function ($container){
            return new Membership($container);
        };
        $container['card.submerchant'] = function ($container){
            return new SubMerchant($container);
        };
        $container['card.specialticket'] = function ($container){
            return new SpecialTicket($container);
        };
    }
}
