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

namespace eMingFeng\MiniProgram\Delivery;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 即时配送
 * Class Room
 * @package eMingFeng\MiniProgram\Delivery
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/immediate-delivery/by-business/immediateDelivery.abnormalConfirm.html
 * @openplatform doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/Mini_Programs/immediate-delivery/immediate_delivery.html
 * todo immediateDelivery.onOrderStatus 配送单配送状态更新通知接口
 */

class Client extends BaseClient
{
    /**
     * 下配送单
     * @param array $data
     * @return array
     */
    public function addOrder($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/local/business/order/add?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 增加小费
     * @param array $data
     * @return array
     */
    public function addTip($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/local/business/order/addtips?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 取消配送单
     * @param array $data
     * @return array
     */
    public function cancelOrder($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/local/business/order/cancel?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 拉取配送单信息
     * @param array $data
     * @return array
     */
    public function getOrder($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/local/business/order/get?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 预下配送单
     * @param array $data
     * @return array
     */
    public function preAddOrder($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/local/business/order/pre_add?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 预取消配送单
     * @param array $data
     * @return array
     */
    public function preCancelOrder($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/local/business/order/precancel?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 重新下单
     * @param array $data
     * @return array
     */
    public function reOrder($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/local/business/order/readd?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 异常件退回商家商家确认收货
     * @param array $data
     * @return array
     */
    public function abnormalConfirm($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/local/business/order/confirm_return?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 拉取已绑定账号
     * @param array $data
     * @return array
     */
    public function getBindAccount()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/local/business/shop/get?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, []);
    }

    /**
     * 获取已支持的配送公司列表
     * @param array $data
     * @return array
     */
    public function getAllImmeDelivery()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/local/business/delivery/getall?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, []);
    }

    /**
     * 模拟配送公司更新配送单状态
     * @param array $data
     * @return array
     */
    public function mockUpdateOrder($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/local/business/test_update_order?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 模拟配送公司更新配送单状态
     * @param array $data
     * @return array
     */
    public function realMockUpdateOrder($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/local/business/realmock_update_order?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }
}