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
 * 礼品卡
 * Class GiftCard
 * @package eMingFeng\OfficialAccount\Card
 * @officialAccount doc https://developers.weixin.qq.com/doc/offiaccount/Cards_and_Offer/gift_card.html
 */

class GiftCard extends BaseClient
{
    /**
     * 创建礼品卡
     * @param array $data 基本的卡券数据
     * @param string $background_pic_url 背景图片
     * @return array
     */
    public function createGiftCard(array $data, string $background_pic_url)
    {
        $url = "https://api.weixin.qq.com/card/create?access_token=ACCESS_TOKEN";
        $temp = ['background_pic_url' => $background_pic_url,'sub_card_type' => 'GIFT_CARD'];
        $data = array_merge($data, $temp);
        $params = [
            'card' => [
                'card_type' => 'GENERAL_CARD',
                'general_card' => $data
            ]
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 创建兑换卡
     * @param array $data 基本的卡券数据
     * @param string $background_pic_url 背景图片
     * @return array
     */
    public function createVoucherCard(array $data, string $background_pic_url)
    {
        $url = "https://api.weixin.qq.com/card/create?access_token=ACCESS_TOKEN";
        $temp = ['background_pic_url' => $background_pic_url,'sub_card_type' => 'VOUCHER'];
        $data = array_merge($data, $temp);
        $params = [
            'card' => [
                'card_type' => 'GENERAL_CARD',
                'general_card' => $data
            ]
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 创建-礼品卡货架
     * @param array $data
     * @return array
     */
    public function addPage(array $data)
    {
        $url = "https://api.weixin.qq.com/card/giftcard/page/add?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 修改-礼品卡货架
     * @param string $page_id 货架id
     * @param array $data
     * @return array
     */
    public function updatePage(string $page_id, array $data)
    {
        $url = "https://api.weixin.qq.com/card/giftcard/page/update?access_token=ACCESS_TOKEN";
        $temp = ['page_id' => $page_id];
        $data = array_merge($data, $temp);
        return $this->callPostApi($url, $data);
    }

    /**
     * 查询-礼品卡货架信息
     * @param string $page_id 货架id
     * @return array
     */
    public function getPage(string $page_id)
    {
        $url = "https://api.weixin.qq.com/card/giftcard/page/get?access_token=ACCESS_TOKEN";
        $params = ['page_id' => $page_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询-礼品卡货架列表
     * @param string $page_id 货架id
     * @return array
     */
    public function batchGetPage(string $page_id)
    {
        $url = "https://api.weixin.qq.com/card/giftcard/page/batchget?access_token=ACCESS_TOKEN";
        $params = ['page_id' => $page_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 下架-礼品卡货架
     * @param string $page_id 货架id 将某个货架设置为下架
     * @return array
     */
    public function setMainTain(string $page_id = '')
    {
        $url = "https://api.weixin.qq.com/card/giftcard/maintain/set?access_token=ACCESS_TOKEN";
        $params = ($page_id ? ['page_id' => $page_id] : ['all' => true]) + ['maintain' => true];
        return $this->callPostApi($url, $params);
    }

    /**
     * 申请微信支付礼品卡权限
     * @param string $sub_mch_id 微信支付子商户号
     * @return array
     */
    public function addWhiteList(string $sub_mch_id)
    {
        $url = "https://api.weixin.qq.com/card/giftcard/pay/whitelist/add?access_token=ACCESS_TOKEN";
        $params = ['sub_mch_id' => $sub_mch_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 绑定商户号到礼品卡小程序
     * @param string $sub_mch_id 微信支付子商户号
     * @param string $wxa_appid 小程序id
     */
    public function bindMchToWxa(string $sub_mch_id, string $wxa_appid)
    {
        $url = "https://api.weixin.qq.com/card/giftcard/pay/submch/bind?access_token=ACCESS_TOKEN";
        $params = [
            'sub_mch_id' => $sub_mch_id,
            'wxa_appid' => $wxa_appid,
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 上传小程序代码
     * @param string $wxa_appid 小程序id
     * @param string $page_id **
     * @return array
     */

    public function setWxa(string $wxa_appid, string $page_id)
    {
        $url = "https://api.weixin.qq.com/card/giftcard/wxa/set?access_token=ACCESS_TOKEN";
        $params = [
            'wxa_appid' => $wxa_appid,
            'page_id' => $page_id,
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * @param string $begin_time	查询的时间起点，十位时间戳（utc+8）
     * @param string $end_time	查询的时间终点，十位时间戳（utc+8）
     * @param string $sort_type	填"ASC" / "DESC"，表示对订单创建时间进行“升 / 降”排序
     * @param string $offset	查询的订单偏移量，如填写100则表示从第100个订单开始拉取
     * @param string $count	查询订单的数量，如offset填写100，count填写10，则表示查询第100个到第110个订单
     * @return array
     */
    public function batchgetOrder( string $begin_time, string $end_time, string $sort_type, string $offset, string $count)
    {
        $url = "https://api.weixin.qq.com/card/giftcard/order/batchget?access_token=ACCESS_TOKEN";
        $params = [
            'begin_time' => $begin_time,
            'end_time' => $end_time,
            'sort_type' => $sort_type,
            'offset' => $offset,
            'count' => $count,
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询-单个礼品卡订单信息
     * @param string $order_id
     * @return array
     */
    public function getOrder(string $order_id)
    {
        $url = "https://api.weixin.qq.com/card/giftcard/order/get?access_token=ACCESS_TOKEN";
        $params = ['order_id' => $order_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 更新用户礼品卡信息
     * @return array
     */
    public function updateUserGifCard($params = [])
    {
        $url = "https://api.weixin.qq.com/card/giftcard/order/get?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询礼品卡信息
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
     * 核销用户礼品卡
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
     * 退款
     * @param string $order_id
     * @return array
     */
    public function refund(string $order_id)
    {
        $url = "https://api.weixin.qq.com/card/giftcard/order/refund?access_token=ACCESS_TOKEN";
        $params = ['order_id' => $order_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 设置支付后开票信息
     * @param string $mchid	微信支付商户号
     * @param string $s_pappid	开票平台id，需要找开票平台提供
     * @return array
     */
    public function setPayMch(string $mchid, string $s_pappid)
    {
        $url = "https://api.weixin.qq.com/card/invoice/setbizattr?action=set_pay_mch&access_token=ACCESS_TOKEN";
        $params = [
            'paymch_info' => [
                'mchid' => $mchid,
                's_pappid' => $s_pappid
            ]
        ];

        return $this->callPostApi($url, $params);
    }

    /**
     * 查询支付后开票信息
     * @return array
     */
    public function getPayMch()
    {
        $url = "https://api.weixin.qq.com/card/invoice/setbizattr?action=get_pay_mch&access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, []);
    }

    /**
     * 设置授权页字段信息
     * @param array $user_field
     * @param array $biz_field
     * @return array
     */
    public function setAuthField(array $user_field, array $biz_field)
    {
        $params = [
            'auth_field' => [
                'user_field' => $user_field,
                'biz_field' => $biz_field
            ]
        ];
        $url = "https://api.weixin.qq.com/card/invoice/setbizattr?action=set_auth_field&access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询授权页字段信息
     * @return array
     */
    public function getAuthField()
    {
        $url = "https://api.weixin.qq.com/card/invoice/setbizattr?action=get_auth_field&access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, []);
    }

    /**
     * 查询开票信息
     * @param string $order_id 发票order_id
     * @param string $s_appid 发票平台的身份id
     * @return array
     */
    public function getAuthData(string $order_id,string $s_appid)
    {
        $url = "https://api.weixin.qq.com/card/invoice/getauthdata?access_token=ACCESS_TOKEN";
        $params = [
            'order_id' => $order_id,
            's_appid' => $s_appid,
        ];
        return $this->callPostApi($url, $params);
    }
}
