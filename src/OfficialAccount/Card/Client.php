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
 * 创建卡券
 * Class Room
 * @package eMingFeng\OfficialAccount\Card
 * @officialAccount doc https://developers.weixin.qq.com/doc/offiaccount/Cards_and_Offer/Create_a_Coupon_Voucher_or_Card.html
 */

class Client extends BaseClient
{
    /**
     * 创建代金券
     * @param array $data 基本的卡券数据
     * @param int $least_cost 代金券专用，表示起用金额（单位为分）,如果无起用门槛则填0。
     * @param int $reduce_cost 代金券专用，表示减免金额。（单位为分）
     * @return array
     */
    public function createCashCard(array $data = [], int $least_cost = 0, int $reduce_cost)
    {
        $url = "https://api.weixin.qq.com/card/create?access_token=ACCESS_TOKEN";
        $temp = ['least_cost' => $least_cost,'reduce_cost' => $reduce_cost];
        $data = array_merge($temp, $data);
        $params = [
            'card' => [
                'card_type' => 'CASH',
                'cash' => $data
            ]
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 创建团购券
     * @param string $deal_detail 团购券专用，团购详情。
     * @param array $data 基本的卡券数据
     * @return array
     */
    public function createGrouponCard(array $data, string $deal_detail)
    {
        $url = "https://api.weixin.qq.com/card/create?access_token=ACCESS_TOKEN";
        $temp = ['deal_detail' => $deal_detail];
        $data = array_merge($temp, $data);
        $params = [
            'card' => [
                'card_type' => 'GROUPON',
                'groupon' => $data
            ]
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 创建折扣券
     * @param string $discount 折扣券专用，表示打折额度（百分比）。填30就是七折。
     * @param array $data 基本的卡券数据
     * @return array
     */
    public function createDiscountCard(array $data, string $discount)
    {
        $url = "https://api.weixin.qq.com/card/create?access_token=ACCESS_TOKEN";
        $temp = ['discount' => $discount];
        $data = array_merge($temp, $data);
        $params = [
            'card' => [
                'card_type' => 'DISCOUNT',
                'discount' => $data
            ]
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 创建兑换券
     * @param string $gift 兑换券专用，填写兑换内容的名称。
     * @param array $data 基本的卡券数据
     * @return array
     */
    public function createGiftCard(array $data, string $gift)
    {
        $url = "https://api.weixin.qq.com/card/create?access_token=ACCESS_TOKEN";
        $temp = ['gift' => $gift];
        $data = array_merge($temp, $data);
        $params = [
            'card' => [
                'card_type' => 'GIFT',
                'gift' => $data
            ]
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 创建优惠券
     * @param string $default_detail 优惠券专用，填写优惠详情。
     * @param array $data 基本的卡券数据
     * @return array
     */
    public function createGeneralCouponCard(array $data, string $default_detail)
    {
        $url = "https://api.weixin.qq.com/card/create?access_token=ACCESS_TOKEN";
        $temp = ['default_detail' => $default_detail];
        $data = array_merge($temp, $data);
        $params = [
            'card' => [
                'card_type' => 'GENERAL_COUPON',
                'general_coupon' => $data
            ]
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 设置快速买单
     * @param string $card_id 卡券id
     * @param bool $is_open 是否开启买单功能，填true/false
     * @return array
     */
    public function setPaysell(string $card_id, bool $is_open)
    {
        $url = "https://api.weixin.qq.com/card/paycell/set?access_token=ACCESS_TOKEN";
        $params = ['card_id' => $card_id, 'is_open' => $is_open];
        return $this->callPostApi($url, $params);
    }

    /**
     * 设置自助核销
     * @param string $card_id 卡券id
     * @param bool $is_open 是否开启自助核销功能，填true/false，默认为false
     * @param bool $need_verify_cod 用户核销时是否需要输入验证码， 填true/false， 默认为false
     * @param bool $need_remark_amount 用户核销时是否需要备注核销金额， 填true/false， 默认为false
     * @return array
     */
    public function setSelfConsumeCell(string $card_id, bool $is_open = false, bool $need_verify_cod = false, bool $need_remark_amount = false)
    {
        $url = "https://api.weixin.qq.com/card/selfconsumecell/set?access_token=ACCESS_TOKEN";
        $params = ['card_id' => $card_id, 'is_open' => $is_open, 'need_verify_cod' =>$need_verify_cod, 'need_remark_amount' => $need_remark_amount];
        return $this->callPostApi($url, $params);
    }
}
