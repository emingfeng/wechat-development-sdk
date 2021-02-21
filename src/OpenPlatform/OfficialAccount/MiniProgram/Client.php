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

namespace eMingFeng\OpenPlatform\OfficialAccount\MiniProgram;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 小程序管理权限集
 * Class Room
 * @package eMingFeng\OpenPlatform\OfficialAccount\MIniProgram
 * @openplatform doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/Official_Accounts/Mini_Program_Management_Permission.html
 */

class Client extends BaseClient
{
    /**
     * 获取公众号关联的小程序
     * @return array
     */
    public function list()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxopen/wxamplinkget?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, []);
    }

    /**
     * 关联小程序
     * @param string $appId 小程序appid
     * @param bool $notifyUsers 是否发送模板消息通知公众号粉丝
     * @param bool $showProfile 是否展示公众号主页中
     * @return array
     */
    public function link(string $appId, bool $notifyUsers = true, bool $showProfile = false)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxopen/wxamplink?access_token=ACCESS_TOKEN";
        $params = [
            'appid'        => $appId,
            'notify_users' => $notifyUsers,
            'show_profile' => $showProfile,
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 解除已关联的小程序
     * @param string $appId 小程序appid
     * @return array
     */
    public function unlink($appId)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxopen/wxampunlink?access_token=ACCESS_TOKEN";
        $params = ['appid' => $appId];
        return $this->callPostApi($url, $params);
    }
}