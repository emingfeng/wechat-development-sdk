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
 * 子商户
 * Class SubMerchant
 * @package eMingFeng\OfficialAccount\Card
 * @officialAccount doc https://developers.weixin.qq.com/doc/offiaccount/Cards_and_Offer/Third-party_developer_mode.html
 */

class SubMerchant extends BaseClient
{
    /**
     * 卡券开放类目查询
     * @return array
     */
    public function getApplyProtocol()
    {
        $url = "https://api.weixin.qq.com/card/getapplyprotocol?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 创建子商户
     * @param string $app_id 子商户的公众号app_id，配置后子商户卡券券面上的app_id为该app_id。注意：该app_id须经过认证
     * @param string $brand_name 子商户名称（12个汉字内），该名称将在制券时填入并显示在卡券页面上
     * @param string $logo_url  子商户logo，可通过 上传图片接口 获取。该logo将在制券时填入并显示在卡券页面上
     * @param string $protocol	 授权函ID，即通过 上传临时素材接口 上传授权函后获得的media_id
     * @param int $end_time 授权函有效期截止时间（东八区时间，单位为秒），需要与提交的扫描件一致
     * @param int $primary_category_id 一级类目id,可以通过本文档中接口查询
     * @param int $secondary_category_id 二级类目id，可以通过本文档中接口查询
     * @param string $agreement_media_id 营业执照或个体工商户营业执照彩照或扫描件
     * @param string $operator_media_id 营业执照内登记的经营者身份证彩照或扫描件
     * @return array
     */
    public function create(
        string $app_id = '',
        string $brand_name, 
        string $logo_url, 
        string $protocol, 
        int $end_time, 
        int $primary_category_id, 
        int $secondary_category_id, 
        string $agreement_media_id = '',
        string $operator_media_id = ''
    ){
        $url = "https://api.weixin.qq.com/card/submerchant/submit?access_token=ACCESS_TOKEN";
        $params = [
            'info' => [
                'app_id' => $app_id,
                'brand_name' => $brand_name,
                'logo_url' => $logo_url,
                'protocol' => $protocol,
                'end_time' => $end_time,
                'primary_category_id' => $primary_category_id,
                'secondary_category_id' => $secondary_category_id,
                'agreement_media_id' => $agreement_media_id,
                'operator_media_id' => $operator_media_id
            ]
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 更新子商户
     * @param string $merchant_id 子商户id，一个母商户公众号下唯一。
     * @param string $app_id 子商户的公众号app_id，配置后子商户卡券券面上的app_id为该app_id。注意：该app_id须经过认证
     * @param string $brand_name 子商户名称（12个汉字内），该名称将在制券时填入并显示在卡券页面上
     * @param string $logo_url  子商户logo，可通过 上传图片接口 获取。该logo将在制券时填入并显示在卡券页面上
     * @param string $protocol	 授权函ID，即通过 上传临时素材接口 上传授权函后获得的media_id
     * @param int $end_time 授权函有效期截止时间（东八区时间，单位为秒），需要与提交的扫描件一致
     * @param int $primary_category_id 一级类目id,可以通过本文档中接口查询
     * @param int $secondary_category_id 二级类目id，可以通过本文档中接口查询
     * @param string $agreement_media_id 营业执照或个体工商户营业执照彩照或扫描件
     * @param string $operator_media_id 营业执照内登记的经营者身份证彩照或扫描件
     * @return array
     */
    public function update(
        string $merchant_id,
        string $app_id = '',
        string $brand_name,
        string $logo_url,
        string $protocol,
        int $end_time,
        int $primary_category_id,
        int $secondary_category_id,
        string $agreement_media_id = '',
        string $operator_media_id = ''
    ){

        $url = "https://api.weixin.qq.com/card/submerchant/update?access_token=ACCESS_TOKEN";
        $params = [
            'info' => [
                'merchant_id' => $merchant_id,
                'app_id' => $app_id,
                'brand_name' => $brand_name,
                'logo_url' => $logo_url,
                'protocol' => $protocol,
                'end_time' => $end_time,
                'primary_category_id' => $primary_category_id,
                'secondary_category_id' => $secondary_category_id,
                'agreement_media_id' => $agreement_media_id,
                'operator_media_id' => $operator_media_id
            ]
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 拉取单个子商户信息
     * @param string $merchant_id 子商户id，一个母商户公众号下唯一。
     * @return array
     */
    public function get(string $merchant_id)
    {
        $url = "https://api.weixin.qq.com/card/submerchant/get?access_token=ACCESS_TOKEN";
        $params = ['merchant_id' => $merchant_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 批量拉取子商户信息
     * @param string $begin_id 起始的子商户id，一个母商户公众号下唯一
     * @param string $limit 拉取的子商户的个数，最大值为100
     * @param string $status 子商户审核状态，填入后，只会拉出当前状态的子商户 "CHECKING" 审核中, "APPROVED" , 已通过；"REJECTED"被驳回, "EXPIRED"协议已过期
     * @return array
     */
    public function batchGet(string $begin_id, int $limit, string $status)
    {
        $url = "https://api.weixin.qq.com/card/submerchant/batchget?access_token=ACCESS_TOKEN";
        $params = ['begin_id' => $begin_id, 'limit' => $limit, 'status' => $status];
        return $this->callPostApi($url, $params);
    }
}
