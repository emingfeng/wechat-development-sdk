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

namespace eMingFeng\OfficialAccount\Menu;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 微信开放平台帐号管理
 * Class Room
 * @package eMingFeng\OfficialAccount\Menu
 * @officialaccount doc https://developers.weixin.qq.com/doc/offiaccount/Custom_Menus/Creating_Custom-Defined_Menu.html
 */

class Client extends BaseClient
{
    /**
     * 自定义菜单创建
     * @param array $data
     * @return array
     */
    public function create(array $data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=ACCESS_TOKEN";
        $params = ['button' => $data];
        return $this->callPostApi($url, $params);
    }

    /**
     * 菜单删除接口
     * @param int $menuId 删除个性化菜单时填写
     * @return array
     */
    public function delete($menuId = null)
    {
        if(is_null($menuId)){
            $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=ACCESS_TOKEN";
            return $this->callGetApi($url);
        }
        $url = "https://api.weixin.qq.com/cgi-bin/menu/delconditional?access_token=ACCESS_TOKEN";
        $params = ['menuid' => $menuId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 通用菜单查询接口
     * @return array
     */
    public function get()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 自定义菜单查询接口
     * @return array
     */
    public function getCurrentSelfMenuInfo()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 创建个性化菜单
     * @param array $data
     * @return array
     */
    public function addConditional(array $data, array $matchRule = [])
    {
        $url = "https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=ACCESS_TOKEN";
        $params = [
            'button' => $data,
            'matchrule' => $matchRule,
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 测试个性化菜单匹配结果
     * @param string $user_id 可以是openid，也可以是微信号
     * @return array
     */
    public function tryMatch($user_id)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/menu/trymatch?access_token=ACCESS_TOKEN";
        $params = ['user_id' => $user_id];
        return $this->callPostApi($url, $params);
    }

}