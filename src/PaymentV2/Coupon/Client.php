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

namespace eMingFeng\PaymentV2\Coupon;

use eMingFeng\Kernel\core\BasePaymentV2;

/**
 * 代金券或立减优惠
 * Class Room
 * @package eMingFeng\PaymentV2\Coupon
 */

class Client extends BasePaymentV2
{
    /**
     * 发放代金券
     * @param array $data
     * @return array
     */
    public function sendCoupon(array $data)
    {
        $url = $this->wrap('mmpaymkttransfers/send_coupon');
        return $this->callPostApi($url, $data, true);
    }

    /**
     * 查询代金券批次
     * @param array $data
     * @return array
     */
    public function queryStock(array $data)
    {
        $url = $this->wrap('mmpaymkttransfers/query_coupon_stock');
        return $this->callPostApi($url, $data);
    }

    /**
     * 查询代金券信息
     * @param array $data
     * @return array
     */
    public function queryInfo(array $data)
    {
        $url = $this->wrap('mmpaymkttransfers/query_coupon_stock');
        return $this->callPostApi($url, $data);
    }

}