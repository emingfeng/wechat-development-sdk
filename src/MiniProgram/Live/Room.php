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

namespace eMingFeng\MiniProgram\Live;

use eMingFeng\Kernel\core\BaseClient;

/**
 *
 * Class Room
 * @package eMingFeng\MiniProgram\Live
 * @miniProgram doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/Mini_Programs/live_player/studio-api.html#1
 */

class Room extends BaseClient
{
    /**
     * 创建直播间
     * @param array $roomData 直播间信息
     * @return array
     */
    public function createRoom($roomData)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/create?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $roomData);
    }

    /**
     * 删除直播间
     * @param int $id 房间ID
     * @return array
     */
    public function deleteRoom(int $id)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/deleteroom?access_token=ACCESS_TOKEN";
        $params = ['id' => $id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 编辑直播间
     * @param array $roomData 直播间信息
     * @return array
     */
    public function editRoom($roomData)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/editroom?access_token=ACCESS_TOKEN";
    }

    /**
     * 获取直播间列表
     * @param int $start 起始房间，0表示从第1个房间开始拉取
     * @param int $number 每次拉取的房间数量，建议100以内
     */
    public function getList(int $start, int $number)
    {
        $url = "https://api.weixin.qq.com/wxa/business/getliveinfo?access_token=ACCESS_TOKEN";
        $params = ['start' => $start, 'number' => $number];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取直播间回放
     * @param string $action		获取回放
     * @param Number $room_id		直播间ID
     * @param Number $start			起始拉取视频，0表示从第一个视频片段开始拉取
     * @param Number $limit			每次拉取的数量，建议100以内
     */
    public function getReply(int $room_id, int $start, int $number)
    {
        $url = "https://api.weixin.qq.com/wxa/business/getliveinfo?access_token=ACCESS_TOKEN";
        $params = ['action' => 'get_reply', 'room_id' => $room_id, 'start' => $start, 'number' => $number];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取直播间推流地址
     * @param int $roomId		直播间ID
     */
    public function getPushUrl(int $roomId)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/getpushurl?access_token=ACCESS_TOKEN";
        $params = ['roomId' => $roomId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取直播间分享二维码
     * @param int $roomId 房间ID
     * @param string $custom_params 自定义参数
     * @return array
     */
    public function getSharedCode(int $roomId, string $custom_params)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/getsharedcode?access_token=ACCESS_TOKEN";
        $params = ['roomId' => $roomId, 'params' => $custom_params];
        return $this->callPostApi($url, $params);
    }

    /**
     * 添加管理直播间小助手
     * @param int $roomId 房间ID
     * @param array $users 用户数组
     * @param string $username 用户微信号
     * @param string $nickname 用户昵称
     * @return array
     */
    public function addAssistant(int $roomId, array $users, string $username, string $nickname)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/addassistant?access_token=ACCESS_TOKEN";
        $params = [
            'roomId' => $roomId,
            'users' => $users,
            'username' => $username,
            'nickname' => $nickname
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 修改管理直播间小助手
     * @param int $roomId 房间ID
     * @param string $username 用户微信号
     * @param string $nickname 用户昵称
     * @return array
     */
    public function modifyAssistant(int $roomId, string $username, string $nickname)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/modifyassistant?access_token=ACCESS_TOKEN";
        $params = [
            'roomId' => $roomId,
            'username' => $username,
            'nickname' => $nickname
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除管理直播间小助手
     * @param int $roomId 房间ID
     * @param string $username 用户微信号
     * @return array
     */
    public function removeAssistant(int $roomId, string $username)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/removeassistant?access_token=ACCESS_TOKEN";
        $params = [
            'roomId' => $roomId,
            'username' => $username
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询管理直播间小助手
     * @param int $roomId 房间ID
     * @return array
     */
    public function getAssistant(int $roomId)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/getassistantlist?access_token=ACCESS_TOKEN";
        $params = [
            'roomId' => $roomId
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 添加主播副号
     * @param int $roomId 房间ID
     * @param string $username 用户微信号
     * @return array
     */
    public function addSubAnchor(int $roomId, string $username)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/addsubanchor?access_token=ACCESS_TOKEN";
        $params = [
            'roomId' => $roomId,
            'username' => $username
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 修改主播副号
     * @param int $roomId 房间ID
     * @param string $username 用户微信号
     * @return array
     */
    public function modifySubAnchor(int $roomId, string $username)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/modifysubanchor?access_token=ACCESS_TOKEN";
        $params = [
            'roomId' => $roomId,
            'username' => $username
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除主播副号
     * @param int $roomId 房间ID
     * @return array
     */
    public function deleteSubAnchor(int $roomId)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/deletesubanchor?access_token=ACCESS_TOKEN";
        $params = [
            'roomId' => $roomId
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取主播副号
     * @param int $roomId 房间ID
     * @return array
     */
    public function getSubAnchor(int $roomId)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/getsubanchor?access_token=ACCESS_TOKEN";
        $params = [
            'roomId' => $roomId
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 开启/关闭直播间官方收录
     * @param int $roomId 房间ID
     * @param int $isFeedsPublic 是否开启官方收录 【1: 开启，0：关闭】
     * @return array
     */
    public function updateFeedPublic(int $roomId, int $isFeedsPublic)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/updatefeedpublic?access_token=ACCESS_TOKEN";
        $params = [
            'roomId' => $roomId,
            'isFeedsPublic' => $isFeedsPublic
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 开启/关闭回放功能
     * @param int $roomId 房间ID
     * @param int $closeReplay 是否关闭回放 【0：开启，1：关闭】
     * @return array
     */
    public function updateReplay(int $roomId, int $closeReplay)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/updatereplay?access_token=ACCESS_TOKEN";
        $params = [
            'roomId' => $roomId,
            'closeReplay' => $closeReplay
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 开启/关闭客服功能
     * @param int $roomId 房间ID
     * @param int $closeKf 是否关闭客服 【0：开启，1：关闭】
     * @return array
     */
    public function updateKf(int $roomId, int $closeKf)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/updatekf?access_token=ACCESS_TOKEN";
        $params = [
            'roomId' => $roomId,
            'closeKf' => $closeKf
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 开启/关闭直播间全局禁言
     * @param int $roomId 房间ID
     * @param int $banComment 是否关闭禁言 【0：开启，1：关闭】
     * @return array
     */
    public function updateComment(int $roomId, int $banComment)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/updatecomment?access_token=ACCESS_TOKEN";
        $params = [
            'roomId' => $roomId,
            'banComment' => $banComment
        ];
        return $this->callPostApi($url, $params);
    }


    /**
     * 上下架商品
     * @param int $roomId 房间ID
     * @param int $goodsId 商品ID
     * @param int $onSale 上下架 【0：下架，1：上架】
     * @return array
     */
    public function onSaleGoods(int $roomId, int $goodsId, int $onSale)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/goods/onsale?access_token=ACCESS_TOKEN";
        $params = [
            'roomId' => $roomId,
            'goodsId' => $goodsId,
            'onSale' => $onSale
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除商品
     * @param int $roomId 房间ID
     * @param int $goodsId 商品ID
     * @return array
     */
    public function deleteGoods(int $roomId, int $goodsId)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/goods/deleteInRoom?access_token=ACCESS_TOKEN";
        $params = [
            'roomId' => $roomId,
            'goodsId' => $goodsId
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 推送商品
     * @param int $roomId 房间ID
     * @param int $goodsId 商品ID
     * @return array
     */
    public function pushGoods(int $roomId, int $goodsId)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/goods/push?access_token=ACCESS_TOKEN";
        $params = [
            'roomId' => $roomId,
            'goodsId' => $goodsId
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 商品排序
     * @param int $roomId 房间ID
     * @param array $goodsId 商品ID
     * @return array
     */
    public function sortGoods(int $roomId, array $goods)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/goods/sort?access_token=ACCESS_TOKEN";
        $params = [
            'roomId' => $roomId,
            'goods' => $goods
        ];
        return $this->callPostApi($url, $params);
    }


    /**
     * 下载商品讲解视频
     * @param int $roomId 房间ID
     * @param int $goodsId 商品ID
     * @return array
     */
    public function getVideo(int $roomId, int $goodsId)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/goods/getVideo?access_token=ACCESS_TOKEN";
        $params = [
            'roomId' => $roomId,
            'goodsId' => $goodsId
        ];
        return $this->callPostApi($url, $params);
    }


    /**
     * 直播间导入商品
     * @param array $ids 数组列表，可传入多个，里面填写 商品 ID
     * @param int $roomId 房间ID
     * @return array
     */
    public function addGoods(array $ids, int $roomId)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/room/addgoods?access_token=ACCESS_TOKEN";
        $params = ['ids' => $ids, 'roomId' => $roomId];
        return $this->callPostApi($url, $params);
    }

}
