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

namespace eMingFeng\PaymentV2\Redpack;

use eMingFeng\Kernel\core\BasePaymentV2;

/**
 * 现金红包
 * Class Room
 * @package eMingFeng\PaymentV2\Redpack
 */

class Client extends BasePaymentV2
{
    /**
     * 发放普通红包 - 公众号
     * @param array $data
     * @return array
     */
    public function sendRedpack(array $data)
    {
        $url = $this->wrap("mmpaymkttransfers/sendredpack");
        $this->params->offsetUnset('appid');
        $this->params->set('wxappid', $this->config->get('appid'));
        return $this->callPostApi($url, $data, true, 'MD5', false);
    }

    /**
     * 发放普通红包 - 小程序
     * @param array $data
     * @return array
     */
    public function sendMiniprogramRedpack(array $data)
    {
        $url = $this->wrap("mmpaymkttransfers/sendminiprogramhb");
        $this->params->offsetUnset('appid');
        $this->params->set('wxappid', $this->config->get('appid'));
        $data = array_merge($data,['notify_way' => 'MINI_PROGRAM_JSAPI']);
        return $this->callPostApi($url, $data, true, 'MD5', false);
    }

    /**
     * 发放裂变红包
     * @param array $data
     * @return array
     */
    public function sendGroupRedpack(array $data)
    {
        $url = $this->wrap("mmpaymkttransfers/sendgroupredpack");
        $this->params->offsetUnset('appid');
        $this->params->set('wxappid', $this->config->get('appid'));
        return $this->callPostApi($url, $data, true, 'MD5', false);
    }

    /**
     * 查询红包记录
     * @param string $mch_billno 商户发放红包的商户订单号
     * @return array
     */
    public function getRedpackInfo($mch_billno)
    {
        $url = $this->wrap("mmpaymkttransfers/gethbinfo");
        $this->params->offsetUnset('wxappid');
        $this->params->set('appid', $this->config->get('appid'));
        $data = ['mch_billno' => $mch_billno, 'bill_type' => 'MCHT'];
        return $this->callPostApi($url, $data, true, 'MD5', false);
    }
}