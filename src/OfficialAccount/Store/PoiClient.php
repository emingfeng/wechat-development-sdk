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
 * 微信门店
 * Class PoiClient
 * @package eMingFeng\OfficialAccount\Store
 * @officialaccount doc https://developers.weixin.qq.com/doc/offiaccount/WeChat_Stores/WeChat_Store_Interface.html
 */

class PoiClient extends BaseClient
{
    /**
     * 门店类目表
     * @return array
     */
    public function getWxCategory()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/poi/getwxcategory?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 创建门店
     * @param array $baseInfo
     * @return array
     */
    public function addPoi(array $baseInfo)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/poi/addpoi?access_token=ACCESS_TOKEN";
        $params = [
            'business' => [
                'base_info' => $baseInfo,
            ],
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 修改门店
     * @param array $baseInfo
     * @return array
     */
    public function updatePoi(array $baseInfo)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/poi/updatepoi?access_token=ACCESS_TOKEN";
        $params = [
            'business' => [
                'base_info' => $baseInfo,
            ],
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询门店列表
     * @param int $begin 开始位置，0 即为从第一条开始查询
     * @param int $limit 返回数据条数，最大允许50，默认为20
     * @return array
     */
    public function listPoi(int $begin = 0, int $limit = 20)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/poi/getpoilist?access_token=ACCESS_TOKEN";
        $params = ['begin' => $begin, 'limit' => $limit];
        return $this->callPostApi($url, $params);

    }

    /**
     * 查询门店信息
     * @param string $poi_id 门店ID
     * @return array
     */

    public function getPoi(string $poi_id)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/poi/getpoi?access_token=ACCESS_TOKEN";
        $params = ['poi_id' => $poi_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除门店
     * @param string $poi_id 门店ID
     * @return array
     */
    public function deletePoi(string $poi_id)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/poi/delpoi?access_token=ACCESS_TOKEN";
        $params = ['poi_id' => $poi_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取门店小程序配置的卡券
     * @param string $poi_id 门店ID
     * @return array
     */
    public function getCard(string $poi_id)
    {
        $url = "https://api.weixin.qq.com/card/storewxa/get?access_token=ACCESS_TOKEN";
        $params = ['poi_id' => $poi_id];
        return $this->callPostApi($url, $params);

    }

    /**
     * 设置门店小程序配置的卡券
     * @param string $poi_id 门店ID
     * @param string $card_id 微信卡券id
     * @return array
     */
    public function setCard(string $poiId, string $cardId)
    {
        $url = "https://api.weixin.qq.com/card/storewxa/set?access_token=ACCESS_TOKEN";
        $params = ['poi_id' => $poi_id, 'card_id' => $card_id];
        return $this->callPostApi($url, $params);
    }
}
