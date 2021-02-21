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

namespace eMingFeng\PaymentV2\Order;

use eMingFeng\Kernel\Contracts\Tools;
use eMingFeng\Kernel\core\BasePaymentV2;

/**
 * 订单管理
 * Class Room
 * @package eMingFeng\PaymentV2\Order
 */

class Client extends BasePaymentV2
{
    /**
     * 统一下单
     * @param array $options
     * @return array
     */
    public function unifiedOrder(array $data)
    {
        $url = $this->wrap('pay/unifiedorder');
        return $this->callPostApi($url, $data, false, 'MD5');
    }

    /**
     * 获取JsApi及H5支付参数
     * @param string $prepay_id 统一下单预支付码
     * @return array
     */
    public function getJsapiParams($prepay_id)
    {
        $data = [];
        $data["appId"] = $this->config->get('appid');
        $data["timeStamp"] = strval(time());
        $data["nonceStr"] = Tools::createNoncestr();
        $data["package"] = "prepay_id={$prepay_id}";
        $data["signType"] = "MD5";
        $data["paySign"] = $this->getPaySign($data, 'MD5');
        $data['timestamp'] = $data['timeStamp'];
        return $data;
    }

    /**
     * 获取WeixinJSBridge,小程序支付参数
     * @param string $prepay_id 统一下单预支付码
     * @return array
     */
    public function getJsParams(string $prepay_id, bool $json = true)
    {
        $data = [
            'appId' => $this->config->get('appid'),
            'timeStamp' => strval(time()),
            'nonceStr' => Tools::createNoncestr(),
            'package' => "prepay_id={$prepay_id}",
            'signType' => 'MD5'
        ];
        $data['paySign'] = $this->getPaySign($data, 'MD5');
        return $json ? json_encode($data) : $data;
    }


    /**
     * 获取微信App支付参数
     * @param string $prepay_id 统一下单预支付码
     * @return array
     */
    public function getAppParams($prepayId)
    {
        $data = [
            'appid'     => $this->config->get('appid'),
            'partnerid' => $this->config->get('mch_id'),
            'prepayid'  => strval($prepayId),
            'package'   => 'Sign=WXPay',
            'timestamp' => strval(time()),
            'noncestr'  => Tools::createNoncestr(),
        ];
        $data['sign'] = $this->getPaySign($data, 'MD5');
        return $data;
    }


    /**
     * 刷卡支付
     * @param array $options
     * @return array
     */
    public function microPay(array $data)
    {
        $url = $this->wrap('pay/micropay');
        return $this->callPostApi($url, $data, false, 'MD5');
    }

    /**
     * 刷卡支付 撤销订单
     * @param array $options
     * @return array
     */
    public function reverse(array $data)
    {
        $url = $this->wrap($this->app->isSandBox() ? 'pay/reverse' : 'secapi/pay/reverse');
        return $this->callPostApi($url, $data, true);
    }

    /**
     * 刷卡支付 授权码查询openid
     * @param string $auth_code 扫码支付授权码，设备读取用户微信中的条码或者二维码信息
     * @return array
     */
    public function authCodeToOpenid($auth_code)
    {
        $url = $this->wrap('tools/authcodetoopenid');
        return $this->callPostApi($url, ['auth_code' => $auth_code]);
    }

    /**
     * 刷新支付 - 交易保障
     * @param array $options
     * @return array
     */
    public function microReport(array $data)
    {
        $url = $this->wrap('payitil/report');
        return $this->callPostApi($url, $data);
    }

    /**
     * 交易保障
     * @param array $options
     * @return array
     */
    public function report(array $data)
    {
        $url = $this->wrap('payitil/report');
        return $this->callPostApi($url, $data);
    }

    /**
     * 查询订单 - 商户系统订单号
     * @param string $out_trade_number 商户系统订单号
     * @return array
     */
    public function queryByOutTradeNumber(string $out_trade_number)
    {
        $url = $this->wrap('pay/orderquery');
        $data = ['out_trade_number' => $out_trade_number];
        return $this->callPostApi($url, $data);
    }

    /**
     * 查询订单 - 微信订单号
     * @param string $transaction_id 微信订单号
     * @return array
     */
    public function queryByTransactionId(string $transaction_id)
    {
        $url = $this->wrap('pay/orderquery');
        $data = ['transaction_id' => $transaction_id];
        return $this->callPostApi($url, $data);
    }

    /**
     * 关闭订单
     * @param string $out_trade_no 商户订单号
     * @return array
     */
    public function close($out_trade_no)
    {
        $url = $this->wrap('pay/closeorder');
        $data = ['out_trade_no' => $out_trade_no];
        return $this->callPostApi($url, $data);
    }


    /**
     * 拉取订单评价数据
     * @param array $options
     * @return array
     */
    public function queryComment(string $begin_time, string $end_time, int $offset = 0, int $limit = 100)
    {
        $url = $this->wrap('billcommentsp/batchquerycomment');
        $data = [
            'begin_time' => $begin_time,
            'end_time' => $end_time,
            'offset' => $offset,
            'limit' => $limit
        ];
        return $this->callPostApi($url, $data, true);
    }


}