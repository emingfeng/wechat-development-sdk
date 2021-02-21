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
 * Class Subscribe
 * @package eMingFeng\MiniProgram\Live
 * @miniProgram doc https://developers.weixin.qq.com/miniprogram/dev/framework/liveplayer/subscribe-api.html
 */

class Subscribe extends BaseClient
{
    /**
     * 获取长期订阅用户
     * @param int $limit 获取长期订阅用户的个数限制，默认200，最大2000
     * @param int $page_break 翻页标记，获取第一页时不带，第二页开始需带上上一页返回结果中的page_break
     * @return array
     */
    public function getfollowers(int $limit = 200, int $page_break)
    {
        $url = "https://api.weixin.qq.com/wxa/business/get_wxa_followers?access_token=ACCESS_TOKEN";
        $params = ['limit' => $limit, 'page_break' => $page_break];
        return $this->callPostApi($url, $params);
    }

    /**
     * 长期订阅群发
     * @param int $room_id 直播开始事件的房间ID
     * @param array $user_openid 接收该群发开播事件的订阅用户OpenId列表
     * @return array
     */
    public function pushMessage(string $room_id, array $user_openid)
    {
        $url = "https://api.weixin.qq.com/wxa/business/push_message?access_token=ACCESS_TOKEN";
        $params = ['room_id' => $room_id, 'user_openid' => $user_openid];
        return $this->callPostApi($url, $params);
    }

}
