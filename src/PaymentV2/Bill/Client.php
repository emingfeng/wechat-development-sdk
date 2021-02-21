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

namespace eMingFeng\PaymentV2\Bill;

use eMingFeng\Kernel\core\BasePaymentV2;

/**
 * 下载交易账单
 * Class Room
 * @package eMingFeng\PaymentV2\Order
 */

class Client extends BasePaymentV2
{
    public function download(string $bill_date, string $bill_type = 'ALL', string $tar_type = null)
    {
        $url = $this->wrap('pay/downloadbill');
        $data = ['bill_date' => $bill_date, 'bill_type' => $bill_type, 'tar_type' => $tar_type];
        return $this->callPostApi($url, $data, false, 'MD5');
    }
}