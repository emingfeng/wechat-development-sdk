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
 * 插件管理 （供插件开发者调用）
 * Class DevClient
 * @package eMingFeng\MiniProgram\Plugin
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/plugin-management/pluginManager.setDevPluginApplyStatus.html
 * @openplatform doc
 */

class DevClient extends BaseClient
{
    /**
     * 获取当前所有插件使用方
     * @param int $page 要拉取第几页的数据
     * @param int $num 每页的记录数
     * @return array
     */
    public function getPluginDevApplyList(int $page = 1, int $num = 10)
    {
        $url = "https://api.weixin.qq.com/wxa/devplugin?access_token=ACCESS_TOKEN";
        $data = ['action' => 'dev_apply_list', 'page' => $page, 'num' => $num];
        return $this->callPostApi($url, $data, true);
    }

    /**
     * 同意申请插件使用
     * @param string 使用者的 appid
     * @return array
     */
    public function agree(string $appid)
    {
        $url = "https://api.weixin.qq.com/wxa/devplugin?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, ['action' => 'dev_agree'], true);
    }

    /**
     * 拒绝申请插件使用
     * @param string $reason 拒绝理由
     * @return array
     */
    public function refuse(string $reason)
    {
        $url = "https://api.weixin.qq.com/wxa/devplugin?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, ['action' => 'dev_refuse'], true);
    }

    /**
     * 删除已拒绝的申请者
     * @return array
     */
    public function delete()
    {
        $url = "https://api.weixin.qq.com/wxa/devplugin?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, ['action' => 'dev_delete'], true);
    }
}