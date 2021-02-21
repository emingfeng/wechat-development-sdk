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
 * 会员卡专区
 * Class Membership
 * @package eMingFeng\OfficialAccount\Card
 * @officialAccount doc https://developers.weixin.qq.com/doc/offiaccount/Cards_and_Offer/Membership_Cards/introduction.html
 */

class Membership extends BaseClient
{
    /**
     * 创建会员卡
     * @param array $data 基本的卡券数据
     * @param string $background_pic_url 背景图片
     * @return array
     */
    public function createMemberCard(array $data = [], string $background_pic_url)
    {
        $url = "https://api.weixin.qq.com/card/create?access_token=ACCESS_TOKEN";

        $params = [
            'card' => [
                'card_type' => 'MEMBER_CARD',
                'member_card' => $data
            ]
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 激活会员卡 - 接口激活
     * @param string $membership_number 会员卡编号，由开发者填入，作为序列号显示在用户的卡包里。可与Code码保持等值。
     * @param string $code 领取会员卡用户获得的code
     * @param string $card_id 卡券ID,自定义code卡券必填
     * @param string $background_pic_url 商家自定义会员卡背景图，须 先调用 上传图片接口 将背景图上传至CDN，否则报错， 卡面设计请遵循 微信会员卡自定义背景设计规范
     * @param string $activate_begin_time 激活后的有效起始时间。若不填写默认以创建时的 data_info 为准。Unix时间戳格式。
     * @param string $activate_end_time 激活后的有效截至时间。若不填写默认以创建时的 data_info 为准。Unix时间戳格式。
     * @param int $init_bonus 初始积分，不填为0。
     * @param string $init_bonus_record 积分同步说明。
     * @param int $init_balance 初始余额，不填为0。
     * @param string $init_custom_field_value1 创建时字段custom_field1定义类型的初始值，限制为4个汉字，12字节。
     * @param string $init_custom_field_value2 创建时字段custom_field2定义类型的初始值，限制为4个汉字，12字节。
     * @param string $init_custom_field_value3 创建时字段custom_field3定义类型的初始值，限制为4个汉字，12字节。
     * @return array
     */
    public function activate(
        string $membership_number,
        string $code,
        string $card_id = null,
        string $background_pic_url,
        string $activate_begin_time = null,
        string $activate_end_time,
        int $init_bonus = 0,
        string $init_bonus_record = null,
        int $init_balance = 0,
        string $init_custom_field_value1 = null,
        string $init_custom_field_value2 = null,
        string $init_custom_field_value3 = null
    ){
        $url = "https://api.weixin.qq.com/card/membercard/activate?access_token=ACCESS_TOKEN";
        $data = [
            "membership_number" => $membership_number,
            "code" => $code,
            "card_id" => $card_id,
            "background_pic_url" => $background_pic_url,
            "activate_begin_time" => $activate_begin_time,
            "activate_end_time" => $activate_end_time,
            "init_bonus" => $init_bonus,
            "init_bonus_record" => $init_bonus_record,
            "init_balance" => $init_balance,
            "init_custom_field_value1" => $init_custom_field_value1,
            "init_custom_field_value2" => $init_custom_field_value2,
            "init_custom_field_value3" => $init_custom_field_value3
        ];
        return $this->callPostApi($url, $data);
    }

    /**
     * 设置开卡字段
     * @param array $data
     * @return array
     */
    public function setActivateUserForm(array $data)
    {
        $url = "https://api.weixin.qq.com/card/membercard/activateuserform/set?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 拉取会员信息
     * @param string $card_id 查询会员卡的cardid
     * @param string $code 	所查询用户领取到的code值
     * @return array
     */
    public function getUserinfo(string $card_id, string $code)
    {
        $url = "https://api.weixin.qq.com/card/membercard/userinfo/get?access_token=ACCESS_TOKEN";
        $params = ['card_id' => $card_id, 'code' => $code];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取用户提交资料
     * @param string $activate_ticket
     * @return array
     */
    public function getActivateTempInfo(string $activate_ticket)
    {
        $url = "https://api.weixin.qq.com/card/membercard/activatetempinfo/get?access_token=ACCESS_TOKEN";
        $params = ['activate_ticket' => $activate_ticket];
        return $this->callPostApi($url, $params);
    }

    /**
     * 更新会员信息
     * @param array $data
     * @return array
     */
    public function updateUser(array $data)
    {
        $url = "https://api.weixin.qq.com/card/membercard/updateuser?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 设置支付后投放卡券
     * @param array $data
     * @return array
     */
    public function addPayGiftCard(array $data)
    {
        $url = "https://api.weixin.qq.com/card/paygiftcard/add?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 删除支付后投放卡券规则
     * @param string $rule_id 支付即会员的规则名称
     * @return array
     */
    public function delPayGiftCard(string $rule_id)
    {
        $url = "https://api.weixin.qq.com/card/paygiftcard/delete?access_token=ACCESS_TOKEN";
        $params = ['rule_id' => $rule_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询支付后投放卡券规则详情
     * @param string $rule_id 	要查询规则id
     * @return array
     */
    public function getPayGiftCardById(string $rule_id)
    {
        $url = "https://api.weixin.qq.com/card/paygiftcard/getbyid?access_token=ACCESS_TOKEN";
        $params = ['rule_id' => $rule_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 批量查询支付后投放卡券规则
     * @param bool $effective 是否仅查询生效的规则
     * @param int $offset 	起始偏移量
     * @param int $count 查询的数量
     * @return array
     */
    public function batchGetPayGiftCard(bool $effective, int $offset = 0 , int $count = 10)
    {
        $url = "https://api.weixin.qq.com/card/paygiftcard/batchget?access_token=ACCESS_TOKEN";
        $params = ['type' => 'RULE_TYPE_PAY_MEMBER_CARD', 'effective' => $effective, 'offset' => $offset, 'count' => $count];
        return $this->callPostApi($url, $params);
    }
}
