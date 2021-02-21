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
 * Class Role
 * @package eMingFeng\MiniProgram\Live
 * @miniProgram doc https://developers.weixin.qq.com/miniprogram/dev/framework/liveplayer/role-manage.html
 */

class Role extends BaseClient
{
    /**
     * 设置成员角色
     * @param string $username 用户的微信号
     * @param int $role 设置用户的角色(取值[1-管理员，2-主播，3-运营者]，设置超级管理员将无效)
     * @return array
     */
    public function add(string $username, int $role)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/role/addrole?access_token=ACCESS_TOKEN";
        $params = ['username' => $username, 'role' => $role];
        return $this->callPostApi($url, $params);
    }

    /**
     * 解除成员角色
     * @param string $username 用户的微信号
     * @param int $role 删除用户的角色
     * @return array
     */
    public function delete(string $username, int $role)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/role/deleterole?access_token=ACCESS_TOKEN";
        $params = ['username' => $username, 'role' => $role];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询成员列表
     * @param int $role 查询的用户角色，取值 [-1-所有成员， 0-超级管理员，1-管理员，2-主播，3-运营者]，默认-1
     * @param int $offset 起始偏移量, 默认0
     * @param int $limit 查询个数，最大30，默认10
     * @param String $keyword 搜索的微信号或昵称，不传则返回全部
     * @return array
     */
    public function list( int $role = 1, int $offset =0, int $limit = 10, string $keyword = null)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/role/getrolelist?access_token=ACCESS_TOKEN";
        $params = ['offset' => $offset, 'role' => $role, 'limit' => $limit, 'keyword' => $keyword];
        return $this->callPostApi($url, $params);
    }

}
