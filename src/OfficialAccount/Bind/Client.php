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

namespace eMingFeng\OfficialAccount\Bind;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 微信开放平台帐号管理
 * Class Room
 * @package eMingFeng\OfficialAccount\Bind
 * @openplatform doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/api/account/create.html
 */

class Client extends BaseClient
{
    /**
     * 创建开放平台帐号并绑定公众号
     * @return array
     */
    public function create()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/open/create?access_token=ACCESS_TOKEN";
        $params = ['appid' => $this->config->get('appid')];
        return $this->callPostApi($url, $params);
    }

    /**
     * 将公众号绑定到开放平台帐号下
     * @param string $openAppId 开放平台帐号APPID
     * @return array
     */
    public function bind(string $openAppId)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/open/bind?access_token=ACCESS_TOKEN";
        $params = ['appid' => $this->config->get('appid'), 'open_appid' => $openAppId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 将公众号从开放平台帐号下解绑
     * @param string $openidAppid 开放平台帐号APPID
     * @return array
     */
    public function unbind(string $openAppId)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/open/unbind?access_token=ACCESS_TOKEN";
        $params = ['appid' => $this->config->get('appid'), 'open_appid' => $openAppId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取公众号所绑定的开放平台帐号
     * @return array
     */
    public function get()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/open/get?access_token=ACCESS_TOKEN";
        $params = ['appid' => $this->config->get('appid')];
        return $this->callPostApi($url, $params);
    }
}