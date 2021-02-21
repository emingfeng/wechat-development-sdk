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

namespace eMingFeng\OfficialAccount\Card;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 核销卡券
 * Class Redeeming
 * @package eMingFeng\OfficialAccount\Card
 * @officialAccount doc https://developers.weixin.qq.com/doc/offiaccount/Cards_and_Offer/Redeeming_a_coupon_voucher_or_card.html
 */

class Redeeming extends BaseClient
{
    /**
     * 查询Code
     * @param string $code 单张卡券的唯一标准。
     * @param string $card_id 卡券ID代表一类卡券。自定义code卡券必填。
     * @param bool $check_consume 是否校验code核销状态，填入true和false时的code异常状态返回数据不同。
     * @return array
     */
    public function getCode(string $code, string $card_id, bool $check_consume)
    {
        $url = "https://api.weixin.qq.com/card/code/get?access_token=ACCESS_TOKEN";
        $params = ['code' => $code, 'card_id' => $card_id, 'check_consume' => $check_consume];
        return $this->callPostApi($url, $params);
    }

    /**
     * 核销Code
     * @param string $card_id 卡券ID。创建卡券时use_custom_code填写true时必填。非自定义Code不必填写。
     * @param string $code 需核销的Code码。
     * @return array
     */
    public function consumeCode(string $card_id, string $code)
    {
        $url = "https://api.weixin.qq.com/card/code/consume?access_token=ACCESS_TOKEN";
        $params = ['card_id' => $card_id, 'code' => $code];
        return $this->callPostApi($url, $params);
    }

    /**
     * Code解码
     * @param string $encrypt_code
     * @return array
     */
    public function decryptCode(string $encrypt_code)
    {
        $url = "https://api.weixin.qq.com/card/code/decrypt?access_token=ACCESS_TOKEN";
        $params = ['encrypt_code' => $encrypt_code];
        return $this->callPostApi($url, $params);
    }
}

