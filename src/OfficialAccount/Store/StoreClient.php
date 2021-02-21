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

namespace eMingFeng\OfficialAccount\Store;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 微信门店小程序
 * Class StoreClient
 * @package eMingFeng\OfficialAccount\Store
 * @officialaccount doc https://developers.weixin.qq.com/doc/offiaccount/WeChat_Stores/WeChat_Shop_Miniprogram_Interface.html
 */

class StoreClient extends BaseClient
{
    /**
     * 拉取门店小程序类目
     * @return array
     */
    public function getMerchantCategory()
    {
        $url = "https://api.weixin.qq.com/wxa/get_merchant_category?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 创建门店小程序
     * @param array $params
     * @return array
     */
    public function applyMerchant(array $params)
    {
        $url = "https://api.weixin.qq.com/wxa/apply_merchant?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询门店小程序审核结果
     * @return array
     */
    public function getMechantAuditInfo()
    {
        $url = "https://api.weixin.qq.com/wxa/get_merchant_audit_info?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 修改门店小程序信息
     * @param string $mediaId 门店头像的临时素材mediaid,如果不想改，参数传空值 获取mediaid可以通过接口 https://mp.weixin.qq.com/wiki?t=t=resource/res_main&id=mp1444738726
     * @param string $intro 门店小程序的介绍,如果不想改，参数传空值
     * @return array
     */
    public function modifyMerchant(string $mediaId = null, string $intro = null)
    {
        $url = "https://api.weixin.qq.com/wxa/modify_merchant?access_token=ACCESS_TOKEN";
        $params = ['headimg_mediaid' => $mediaId, 'intro' => $intro];
        return $this->callPostApi($url, $params);
    }

    /**
     * 从腾讯地图拉取省市区信息
     * @return array
     */
    public function getDistrict()
    {
        $url = "https://api.weixin.qq.com/wxa/get_district?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 在腾讯地图中搜索门店
     * @param string $districtid 对应 拉取省市区信息接口 中的id字段
     * @param string $keyword 搜索的关键词
     * @return array
     */
    public function searchMapPoi(string $districtid, string $keyword)
    {
        $url = "https://api.weixin.qq.com/wxa/search_map_poi?access_token=ACCESS_TOKEN";
        $params = ['districtid' => $districtid, 'keyword' => $keyword];
        return $this->callPostApi($url, $params);
    }

    /**
     * 在腾讯地图中创建门店
     * @param $params
     * @return array
     */
    public function createMapPoi($params)
    {
        $url = "https://api.weixin.qq.com/wxa/create_map_poi?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $params);
    }

    /**
     * 添加门店
     * @param $params
     * @return array
     */
    public function addStore($params)
    {
        $url = " https://api.weixin.qq.com/wxa/add_store?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $params);
    }

    /**
     * 更新门店信息
     * @param string $poi_id 为门店小程序添加门店审核成功后返回的门店id
     * @param string $hour 自定义营业时间，格式为10:00-12:00
     * @param string $contract_phone 自定义联系电话
     * @param array $pic_list 门店图片，可传多张图片 pic_list 字段是一个 json
     * @param string $card_id 卡券id，如果不想修改的话，设置为空
     * @return array
     */
    public function updateStore(string $poi_id, string $hour, string $contract_phone, array $pic_list, string $card_id)
    {
        $url = "https://api.weixin.qq.com/wxa/update_store?access_token=ACCESS_TOKEN";
        $params = ['poi_id' => $poi_id, 'hour' => $hour, 'contract_phone' => $contract_phone, 'pic_list' => $pic_list, 'card_id' => $card_id];
        return $this->callPostApi($url, $params);

    }

    /**
     * 获取单个门店信息
     * @param string $poi_id
     * @return array
     */
    public function getStoreInfo(string $poi_id)
    {
        $url = "https://api.weixin.qq.com/wxa/get_store_info?access_token=ACCESS_TOKEN";
        $params = ['poi_id' => $poi_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取门店信息列表
     * @param int $offset 获取门店列表的初始偏移位置，从0开始计数
     * @param int $limit 获取门店个数
     * @return array
     */
    public function listStore(int $offset, int $limit)
    {
        $url = "https://api.weixin.qq.com/wxa/get_store_list?access_token=ACCESS_TOKEN";
        $params = ['offset' => $offset, 'limit' => $limit];
        return $this->callPostApi($url);
    }

    /**
     * 删除门店
     * @param string $poi_id 为门店小程序添加门店审核成功后返回的门店id
     * @return array
     */
    public function delStore(string $poi_id)
    {
        $url = "https://api.weixin.qq.com/wxa/del_store?access_token=ACCESS_TOKEN";
        $params = ['poi_id' => $poi_id];
        return $this->callPostApi($url, $params);
    }
}
