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

namespace eMingFeng\PaymentV2\Transfer;

use eMingFeng\Kernel\Contracts\Tools;
use eMingFeng\Kernel\core\BasePaymentV2;
use eMingFeng\Kernel\Exceptions\InvalidDecryptException;
use eMingFeng\Kernel\Exceptions\InvalidResponseException;

/**
 * 企业付款
 * Class Room
 * @package eMingFeng\PaymentV2\Transfer
 */

class Client extends BasePaymentV2
{
    /**
     * 企业付款到零钱
     * @param array $data
     * @return array
     */
    public function transfers(array $data)
    {
        $url = $this->wrap("mmpaymkttransfers/promotion/transfers");
        $this->params->offsetUnset('appid');
        $this->params->offsetUnset('mch_id');
        $this->params->set('mchid', $this->config->get('mch_id'));
        $this->params->set('mch_appid', $this->config->get('appid'));

        return $this->callPostApi($url, $data, true, 'MD5', false);
    }

    /**
     * 查询企业付款到零钱
     * @param string $partnerTradeNo 商户调用企业付款API时使用的商户订单号
     * @return array
     */
    public function query($partner_trade_no)
    {
        $url = $this->wrap("mmpaymkttransfers/gettransferinfo");
        $this->params->offsetUnset('mchid');
        $this->params->offsetUnset('mch_appid');
        $this->params->set('appid', $this->config->get('appid'));
        $this->params->set('mch_id', $this->config->get('mch_id'));
        $data = ['partner_trade_no' => $partner_trade_no];
        return $this->callPostApi($url, $data, true, 'MD5', false);
    }

    /**
     * 企业付款到银行卡
     * @param array $data
     * @return array
     */
    public function payBank(array $data)
    {
        $url = $this->wrap("mmpaysptrans/pay_bank");
        $this->params->offsetUnset('appid');
        $data = [
            'amount'           => $data['amount'],
            'bank_code'        => $data['bank_code'],
            'partner_trade_no' => $data['partner_trade_no'],
            'enc_bank_no'      => $this->rsaEncode($data['enc_bank_no']),
            'enc_true_name'    => $this->rsaEncode($data['enc_true_name']),
            'desc'             => isset($data['desc']) ? $data['desc'] : '',
        ];
        return $this->callPostApi($url, $data, true, 'MD5', false);
    }

    /**
     * 查询商户企业付款到银行卡
     * @param string $partner_trade_no 商户订单号，需保持唯一
     * @return array
     */
    public function queryBank($partner_trade_no)
    {
        $url = $this->wrap("mmpaysptrans/query_bank");
        $this->params->offsetUnset('appid');
        $data = ['partner_trade_no' => $partner_trade_no];
        return $this->callPostApi($url, $data, true, 'MD5', false);
    }

    /**
     * RSA加密处理
     * @param string $string
     * @param string $encrypted
     * @return string
     */
    private function rsaEncode($string, $encrypted = '')
    {
        $search = ['-----BEGIN RSA PUBLIC KEY-----', '-----END RSA PUBLIC KEY-----', "\n", "\r"];
        $pkc1 = str_replace($search, '', $this->getRsaContent());
        $publicKey = '-----BEGIN PUBLIC KEY-----' . PHP_EOL .
            wordwrap('MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8A' . $pkc1, 64, PHP_EOL, true) . PHP_EOL .
            '-----END PUBLIC KEY-----';
        if (!openssl_public_encrypt("{$string}", $encrypted, $publicKey, OPENSSL_PKCS1_OAEP_PADDING)) {
            throw new InvalidDecryptException('Rsa Encrypt Error.');
        }
        return base64_encode($encrypted);
    }

    /**
     * 获取签名文件内容
     * @return string
     */
    private function getRsaContent()
    {
        $cacheKey = "pub_ras_key_" . $this->config->get('mch_id');
        if (($pub_key = Tools::getCache($cacheKey))) {
            return $pub_key;
        }
        $data = $this->callPostApi('https://fraud.mch.weixin.qq.com/risk/getpublickey', [], true, 'MD5');
        if (!isset($data['return_code']) || $data['return_code'] !== 'SUCCESS' || $data['result_code'] !== 'SUCCESS') {
            $error = 'ResultError:' . $data['return_msg'];
            $error .= isset($data['err_code_des']) ? ' - ' . $data['err_code_des'] : '';
            throw new InvalidResponseException($error, 20000, $data);
        }
        Tools::setCache($cacheKey, $data['pub_key'], 600);
        return $data['pub_key'];
    }
}