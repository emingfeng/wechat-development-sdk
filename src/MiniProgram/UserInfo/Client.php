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

namespace eMingFeng\MiniProgram\UserInfo;

use eMingFeng\Kernel\core\BaseClient;

class Client extends BaseClient
{
    /**
     * 用户支付完成后，获取该用户的 UnionId
     * @param string $openid 支付用户唯一标识
     * @param null|string $transaction_id 微信支付订单号
     * @param null|string $mch_id 微信支付分配的商户号，和商户订单号配合使用
     * @param null|string $out_trade_no 微信支付商户订单号，和商户号配合使用
     * @return array
     */
    public function getPaidUnionId($openid, $transaction_id = null, $mch_id = null, $out_trade_no = null)
    {
        $url = "https://api.weixin.qq.com/wxa/getpaidunionid?access_token=ACCESS_TOKEN&openid={$openid}";
        if (is_null($mch_id)) $url .= "&mch_id={$mch_id}";
        if (is_null($out_trade_no)) $url .= "&out_trade_no={$out_trade_no}";
        if (is_null($transaction_id)) $url .= "&transaction_id={$transaction_id}";
        return $this->callGetApi($url);
    }
}