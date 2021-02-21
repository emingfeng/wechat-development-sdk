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

namespace eMingFeng\OfficialAccount\Analysis;

use eMingFeng\Kernel\core\Container;
use eMingFeng\Kernel\interfaces\Provider;

class ServiceProvider implements Provider
{
    public function serviceProvider(Container $container)
    {
        $container['ad_analysis'] = function ($container){
            return new AdClient($container);
        };

        $container['msg_analysis'] = function ($container){
            return new MsgClient($container);
        };

        $container['user_analysis'] = function ($container){
            return new UserClient($container);
        };

        $container['graphic_analysis'] = function ($container){
            return new GraphicClient($container);
        };

        $container['interface_analysis'] = function ($container){
            return new InterfaceClient($container);
        };
    }
}
