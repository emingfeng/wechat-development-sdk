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

namespace eMingFeng\PaymentV2\Refund;

use eMingFeng\Kernel\Contracts\Tools;
use eMingFeng\Kernel\core\BasePaymentV2;
use eMingFeng\Kernel\Exceptions\InvalidDecryptException;
use eMingFeng\Kernel\Exceptions\InvalidResponseException;

/**
 * 退款管理
 * Class Room
 * @package eMingFeng\PaymentV2\Refund
 */

class Client extends BasePaymentV2
{

    /**
     * 按商户订单号退款
     * @param string $out_trade_no
     * @param string $out_refund_no
     * @param int $total_fee
     * @param int $refund_fee
     * @param array $options
     * @return array
     */
    public function refundByOutTradeNumber(string $out_trade_no, string $out_refund_no, int $total_fee, int $refund_fee, array $options = [])
    {
        return $this->refund($out_refund_no, $total_fee, $refund_fee, array_merge($options, ['out_trade_no' => $out_trade_no]));
    }

    /**
     * 按微信订单号退款
     * @param string $transaction_id
     * @param string $out_refund_no
     * @param int $total_fee
     * @param int $refund_fee
     * @param array $options
     * @return array
     */
    public function refundByTransactionId(string $transaction_id, string $out_refund_no, int $total_fee, int $refund_fee, array $options = [])
    {
        return $this->refund($out_refund_no, $total_fee, $refund_fee, array_merge($options, ['transaction_id' => $transaction_id]));
    }

    /**
     * 申请退款
     * @param string $out_refund_no
     * @param int $total_fee
     * @param int $refund_fee
     * @param array $options
     * @return array
     */
    protected function refund(string $out_refund_no, int $total_fee, int $refund_fee, $options = [])
    {

        $url = $this->wrap($this->app->isSandBox() ? 'pay/refund' : 'secapi/pay/refund');
        $data = array_merge([
            'out_refund_no' => $out_refund_no,
            'total_fee' => $total_fee,
            'refund_fee' => $refund_fee
        ], $options);

        return $this->callPostApi($url, $data, true);
    }

    /**
     * 按微信退款单号查询退款
     * @param string $refund_id
     * @return array
     */
    public function queryByRefundId(string $refund_id, int $offset = 0)
    {
        return $this->query($refund_id, 'refund_id', $offset);
    }

    /**
     * 按商户退款单号查询退款
     * @param string $out_refund_no
     * @return array
     */
    public function queryByOutRefundNo(string $out_refund_no, int $offset = 0)
    {
        return $this->query($out_refund_no, 'out_refund_no', $offset);
    }

    /**
     * 按微信订单号查询退款
     * @param string $transaction_id
     * @return array
     */
    public function queryByTransactionId(string $transaction_id, int $offset = 0)
    {
        return $this->query($transaction_id, 'transaction_id', $offset);
    }

    /**
     * 按商户订单号查询退款
     * @param string $out_trade_no
     * @return array
     */
    public function queryByOutTradeNo(string $out_trade_no, int $offset = 0)
    {
        return $this->query($out_trade_no, 'out_trade_no', $offset);
    }

    /**
     * 查询退款
     * @param string $number
     * @param string $type
     * @return array
     */
    protected function query(string $number, string $type, $offset = 0)
    {
        $url = $this->wrap('pay/refundquery');
        $data = [
            $type => $number,
            'offset' => $offset
        ];
        return $this->callPostApi($url, $data);
    }

    /**
     * 获取退款通知
     * @return array
     */
    public function getNotify()
    {
        $data = Tools::xml2arr(file_get_contents("php://input"));
        if (!isset($data['return_code']) || $data['return_code'] !== 'SUCCESS') {
            throw new InvalidResponseException('获取退款通知XML失败！');
        }
        try {
            $key = md5($this->config->get('mch_key'));
            $decrypt = base64_decode($data['req_info']);
            $response = openssl_decrypt($decrypt, 'aes-256-ecb', $key, OPENSSL_RAW_DATA);
            $data['result'] = Tools::xml2arr($response);
            return $data;
        } catch (\Exception $exception) {
            throw new InvalidDecryptException($exception->getMessage(), $exception->getCode());
        }
    }
}