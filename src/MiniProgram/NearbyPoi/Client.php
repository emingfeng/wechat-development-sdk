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

namespace eMingFeng\MiniProgram\NearbyPoi;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 附近的小程序
 * Class Room
 * @package eMingFeng\MiniProgram\NearbyPoi
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/nearby-poi/nearbyPoi.add.html
 */

class Client extends BaseClient
{
    /**
     * 添加地点
     * @param array $params
     * @return array
     */
    public function add(array $params)
    {
        $url = "https://api.weixin.qq.com/wxa/addnearbypoi?access_token=ACCESS_TOKEN";
        $params = array_merge([
            'is_comm_nearby' => '1',
            'poi_id' => '',
        ], $params);
        return $this->callPostApi($url, $params, true);
    }

    /**
     * 修改地点
     * @param array $params
     * @param string $poi_id
     * @return array
     */
    public function update(array $params, string $poi_id)
    {
        $url = "https://api.weixin.qq.com/wxa/addnearbypoi?access_token=ACCESS_TOKEN";
        $params = array_merge([
            'is_comm_nearby' => '1',
            'poi_id' => $poi_id,
        ], $params);
        return $this->callPostApi($url, $params, true);
    }


    /**
     * 删除地点
     * @param $poi_id
     * @return array
     */
    public function delete($poi_id)
    {
        $url = "https://api.weixin.qq.com/wxa/delnearbypoi?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, ['poi_id' => $poi_id], true);
    }

    /**
     * 查看地点列表
     * @param int $page 起始页id（从1开始计数）
     * @param int $page_rows 每页展示个数（最多1000个）
     * @return array
     */
    public function getList(int $page , int $page_rows )
    {

        $url = "https://api.weixin.qq.com/wxa/getnearbypoilist?page={$page}&page_rows={$page_rows}&access_token=ACCESS_TOKEN";

        return $this->callGetApi($url);
    }

    /**
     * 展示/取消展示附近小程序
     * @param string $poi_id 附近地点ID
     * @param string $status 0：取消展示；1：展示
     * @return array
     */
    public function setShowStatus($poi_id, $status)
    {
        $url = "https://api.weixin.qq.com/wxa/setnearbypoishowstatus?access_token=ACCESS_TOKEN";
        $params = ['poi_id' => $poi_id, 'status' => $status];
        return $this->callPostApi($url, $params , true);
    }
}