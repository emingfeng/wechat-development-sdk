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

namespace eMingFeng\MiniProgram\Plugin;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 插件管理
 * Class Room
 * @package eMingFeng\MiniProgram\Plugin
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/plugin-management/pluginManager.applyPlugin.html
 * @openplatform doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/Mini_Programs/Plug-ins_Management.html
 */

class Client extends BaseClient
{
    /**
     * 申请使用插件
     * @param string $plugin_appid 插件appid
     * @return array
     */
    public function applyPlugin(string $plugin_appid)
    {
        $url = "https://api.weixin.qq.com/wxa/plugin?access_token=ACCESS_TOKEN";
        $params = ['action' => 'apply', 'plugin_appid' => $plugin_appid];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询已添加的插件
     * @return array
     */
    public function getPluginList()
    {
        $url = "https://api.weixin.qq.com/wxa/plugin?access_token=ACCESS_TOKEN";
        $params = ['action' => 'list'];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除已添加的插件
     * @param string $plugin_appid 插件appid
     * @return array
     */
    public function unbindPlugin(string $plugin_appid)
    {
        $url = "https://api.weixin.qq.com/wxa/plugin?access_token=ACCESS_TOKEN";
        $params = ['action' => 'unbind', 'plugin_appid' => $plugin_appid];
        return $this->callPostApi($url, $params);
    }

    /**
     * 快速更新插件版本号
     * @param string $plugin_appid 插件appid
     * @param string $user_version 升级至版本号，要求此插件版本支持快速更新
     * @return array
     */
    public function update(string $plugin_appid , string $user_version)
    {
        $url = "https://api.weixin.qq.com/wxa/plugin?access_token=ACCESS_TOKEN";
        $params = ['action' => 'update', 'plugin_appid' => $plugin_appid, 'user_version' => $user_version];
        return $this->callPostApi($url, $params);
    }
}