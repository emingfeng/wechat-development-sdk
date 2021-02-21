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

namespace eMingFeng\OpenPlatform\MiniProgram\Tester;

use eMingFeng\Kernel\core\BaseClient;

/**
 * Class Room
 * @package eMingFeng\OpenPlatform\MiniProgram\Tester
 * @miniprogram  doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/Mini_Programs/Admin.html
 */

class Client extends BaseClient
{
    /**
     * 绑定微信用户为小程序体验者
     * @param string $wechatId 微信号
     * @return array
     */
    public function bind($wechatId)
    {
        $url = "https://api.weixin.qq.com/wxa/bind_tester?access_token=ACCESS_TOKEN";
        $params = ['wechatid' => $wechatId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 解除绑定小程序的体验者
     * @param string $wechatId 微信号
     * @return array
     */
    public function unbind($wechatId)
    {
        $url = "https://api.weixin.qq.com/wxa/unbind_tester?access_token=ACCESS_TOKEN";
        $params = ['wechatid' => $wechatId];
        return $this->callPostApi($url, $params, true);
    }

    /**
     * 获取体验者列表
     * @return array
     */
    public function list()
    {
        $url = "https://api.weixin.qq.com/wxa/memberauth?access_token=ACCESS_TOKEN";
        $params = ['action' => 'get_experiencer'];
        return $this->callPostApi($url, $params);
    }
}