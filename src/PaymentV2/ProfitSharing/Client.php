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

namespace eMingFeng\PaymentV2\ProfitSharing;

use eMingFeng\Kernel\core\BasePaymentV2;

/**
 * 分账
 * Class Room
 * @package eMingFeng\PaymentV2\ProfitSharing
 */

class Client extends BasePaymentV2
{
    /**
     * 请求单次分账
     * @param string $transaction_id 微信支付订单号
     * @param string $out_order_no    商户系统内部的分账单号
     * @param array  $receivers     分账接收方列表
     * @return array
     */
    public function singleShare(string $transaction_id, string $out_order_no, array $receivers)
    {
        $url = "https://api.mch.weixin.qq.com/secapi/pay/profitsharing";
        $data = [
            'transaction_id' => $transaction_id,
            'out_order_no' => $out_order_no,
            'receivers' => json_encode($receivers,JSON_UNESCAPED_UNICODE)
        ];
        return $this->callPostApi($url, $data, true);
    }

    /**
     * 请求多次分账
     * @param string $transaction_id 微信支付订单号
     * @param string $out_order_no    商户系统内部的分账单号
     * @param array  $receivers     分账接收方列表
     * @return array
     */
    public function multiShare(string $transaction_id, string $out_order_no, array $receivers)
    {
        $url = "https://api.mch.weixin.qq.com/secapi/pay/multiprofitsharing";
        $data = [
            'transaction_id' => $transaction_id,
            'out_order_no' => $out_order_no,
            'receivers' => json_encode($receivers,JSON_UNESCAPED_UNICODE)
        ];
        return $this->callPostApi($url, $data, true);

    }

    /**
     * 查询分账结果
     * @param string $transaction_id 微信支付订单号
     * @param string $out_order_no    商户系统内部的分账单号
     * @return array
     */
    public function query(string $transaction_id, string $out_order_no)
    {
        $url = "https://api.mch.weixin.qq.com/pay/profitsharingquery";
        $data = [
            'transaction_id' => $transaction_id,
            'out_order_no' => $out_order_no,
        ];
        return $this->callPostApi($url, $data);
    }

    /**
     * 添加分账接收方
     * @param array $receiver 分账接收方对象，json格式
     * @return array
     */
    public function addReceiver(array $receiver)
    {
        $url = "https://api.mch.weixin.qq.com/pay/profitsharingaddreceiver";
        $data = ['receiver' => json_encode($receiver,JSON_UNESCAPED_UNICODE)];
        return $this->callPostApi($url, $data);
    }

    /**
     * 删除分账接收方
     * @param array $receiver 分账接收方对象，json格式
     * @return array
     */
    public function removeReceiver(array $receiver)
    {
        $url = "https://api.mch.weixin.qq.com/pay/profitsharingremovereceiver";
        $data = ['receiver' => json_encode($receiver,JSON_UNESCAPED_UNICODE)];
        return $this->callPostApi($url, $data);
    }

    /**
     * 完结分账
     * @param string $transaction_id 微信订单号
     * @param string $out_order_no 商户分账单号
     * @param string $description 分账完结描述
     * @return array
     */
    public function finish(string $transaction_id, string $out_order_no, string $description)
    {
        $url = "https://api.mch.weixin.qq.com/secapi/pay/profitsharingfinish";

        $data = [
            'transaction_id' => $transaction_id,
            'out_order_no' => $out_order_no,
            'description' => $description
        ];
        return $this->callPostApi($url, $data, true);
    }

    /**
     * 查询订单待分账金额
     * @param string $transaction_id 微信订单号
     * @return array
     */
    public function queryAmount(string $transaction_id)
    {
        $url = "https://api.mch.weixin.qq.com/pay/profitsharingorderamountquery";

        $data = [
            'transaction_id' => $transaction_id
        ];
        return $this->callPostApi($url, $data, true);
    }

    /**
     * 分账回退 微信分账单号
     * @param string $order_id    微信分账单号
     * @param string $out_return_no   商户回退单号
     * @param int    $return_amount  回退金额
     * @param string $return_account 回退方账号
     * @param string $description   回退描述
     * @return array
     */
    public function returnByOrderId(
        string $order_id,
        string $out_return_no,
        int $return_amount,
        string $return_account,
        string $description
    ) {
        $url = "https://api.mch.weixin.qq.com/secapi/pay/profitsharingreturn";
        $data = [
            'order_id' => $order_id,
            'out_return_no' => $out_return_no,
            'return_account_type' => 'MERCHANT_ID',
            'return_account' => $return_account,
            'return_amount' => $return_amount,
            'description' => $description,
        ];
        return $this->callPostApi($url, $data, true);
    }

    /**
     * 分账回退 商户分账单号
     * @param string $out_order_no    商户分账单
     * @param string $out_return_no   商户回退单号
     * @param int    $return_amount  回退金额
     * @param string $return_account 回退方账号
     * @param string $description   回退描述
     * @return array
     */
    public function returnByOutOrderNo(
        string $out_order_no,
        string $out_return_no,
        int $return_amount,
        string $return_account,
        string $description
    ) {
        $url = "https://api.mch.weixin.qq.com/secapi/pay/profitsharingreturn";
        $data = [
            'out_order_no' => $out_order_no,
            'out_return_no' => $out_return_no,
            'return_account_type' => 'MERCHANT_ID',
            'return_account' => $return_account,
            'return_amount' => $return_amount,
            'description' => $description,
        ];
        return $this->callPostApi($url, $data, true);
    }

    public function queryReturnByOrderId(string $order_id, string $out_return_no)
    {
        $url = "https://api.mch.weixin.qq.com/pay/profitsharingreturnquery";
        $data = [
            'order_id' => $order_id,
            'out_return_no' => $out_return_no
        ];
        return $this->callPostApi($url, $data, true);
    }

    public function queryReturnByOutOrderNo(string $out_order_no, string $out_return_no)
    {
        $url = "https://api.mch.weixin.qq.com/pay/profitsharingreturnquery";
        $data = [
            'out_order_no' => $out_order_no,
            'out_return_no' => $out_return_no
        ];
        return $this->callPostApi($url, $data, true);
    }
}