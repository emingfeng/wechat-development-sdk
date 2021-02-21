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

namespace eMingFeng\PaymentV2\Sandbox;

use eMingFeng\Kernel\Contracts\Tools;
use eMingFeng\Kernel\core\BasePaymentV2;

/**
 * 沙盒
 * Class Room
 * @package eMingFeng\PaymentV2\Sandbox
 */

class Client extends BasePaymentV2
{
    public function getKey()
    {

        if ($cache = Tools::getCache($this->getCacheKey())) {
            return $cache;
        }

        $response = $this->callSandbox('sandboxnew/pay/getsignkey',[]);

        if ('SUCCESS' === $response['return_code']) {
            Tools::setCache($this->getCacheKey(),$key = $response['sandbox_signkey'], 24 * 3600);
            return $key;
        }

    }

    /**
     * @return string
     */
    protected function getCacheKey(): string
    {
        return 'payment.sandbox.'.md5($this->app->options['appid'].$this->app->options['mch_id']);
    }
}