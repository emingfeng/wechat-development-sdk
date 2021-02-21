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

namespace eMingFeng\MiniProgram\Live;

use eMingFeng\Kernel\core\Container;
use eMingFeng\Kernel\interfaces\Provider;

class ServiceProvider implements Provider
{
    public function serviceProvider(Container $container)
    {
        $container['live'] = function ($container){
            return new Live($container);
        };
        $container['live.room'] = function ($container){
            return new Room($container);
        };
        $container['live.goods'] = function ($container){
            return new Goods($container);
        };
        $container['live.role'] = function ($container){
            return new Role($container);
        };
        $container['live.subscribe'] = function ($container){
            return new Subscribe($container);
        };
    }
}
