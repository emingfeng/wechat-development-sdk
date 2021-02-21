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

namespace eMingFeng\OpenPlatform\MiniProgram\Delivery;

use eMingFeng\MiniProgram\Delivery\Client as Delivery;

class Client extends Delivery
{
    /**
     * 第三方代商户发起开通即时配送权限
     * @param array $data
     * @return array
     */
    public function openDelivery()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/local/business/open?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url,[]);
    }

    /**
     * 发起绑定帐号
     * @param string $deliveryId
     * @return array
     */
    public function bindAccount(string $deliveryId)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/local/business/shop/add?access_token=ACCESS_TOKEN";
        $params = ['delivery_id' => $deliveryId];
        return $this->callPostApi($url, $params , true);
    }
}