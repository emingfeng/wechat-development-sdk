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

namespace eMingFeng\PaymentV2;

use eMingFeng\Kernel\core\ContainerBase;

/**
 * Class Application
 * @package eMingFeng\Payment
 *
 * @method shortUrl($long_url);
 *
 * @property \eMingFeng\PaymentV2\Base\Client                         $base                         基础
 * @property \eMingFeng\PaymentV2\Bill\Client                         $bill                         下载交易账单
 * @property \eMingFeng\PaymentV2\Order\Client                        $order                        订单管理
 * @property \eMingFeng\PaymentV2\Coupon\Client                       $coupon                       优惠券或立减
 * @property \eMingFeng\PaymentV2\Refund\Client                       $refund                       退款管理
 * @property \eMingFeng\PaymentV2\Redpack\Client                      $redpack                      现金红包
 * @property \eMingFeng\PaymentV2\Sandbox\Client                      $sandbox                      沙盒
 * @property \eMingFeng\PaymentV2\Fundflow\Client                     $fundflow                     下载资金账单
 * @property \eMingFeng\PaymentV2\Transfer\Client                     $transfer                     企业付款
 * @property \eMingFeng\PaymentV2\ProfitSharing\Client                $profitSharing                分账
 */

class Application extends ContainerBase
{


    protected $provider = [
        Base\ServiceProvider::class,
        Bill\ServiceProvider::class,
        Order\ServiceProvider::class,
        Coupon\ServiceProvider::class,
        Refund\ServiceProvider::class,
        Redpack\ServiceProvider::class,
        Sandbox\ServiceProvider::class,
        Fundflow\ServiceProvider::class,
        Transfer\ServiceProvider::class,
        ProfitSharing\ServiceProvider::class
    ];

    public function __call($method, $args)
    {
        return $this->base->$method(...$args);
    }

    public function getKey(string $url = null)
    {
        if ('sandboxnew/pay/getsignkey' === $url) {
            return $this->options['mch_key'];
        }

        $key = $this->isSandBox() ? $this['sandbox']->getKey() : $this->options['mch_key'];


        return $key;
    }

    /**
     * @return bool
     */
    public function isSandBox(): bool
    {
        return (bool) $this->options['sandbox'];
    }
}