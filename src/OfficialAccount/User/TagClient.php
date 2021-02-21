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

namespace eMingFeng\OfficialAccount\User;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 用户标签管理
 * Class TagClient
 * @package eMingFeng\OfficialAccount\User
 * @officialAccount doc https://developers.weixin.qq.com/doc/offiaccount/User_Management/User_Tag_Management.html
 */

class TagClient extends BaseClient
{
    /**
     * 创建标签
     * @param string $name
     * @return array
     */
    public function create(string $name)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/tags/create?access_token=ACCESS_TOKEN";
        $params = ['tag' => ['name' => $name]];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取公众号已创建的标签
     * @return array
     */
    public function get()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/tags/get?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }


    /**
     * 修改标签信息
     * @param int $tagId
     * @param string $name
     * @return array
     */
    public function update(int $tagId, string $name)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/tags/update?access_token=ACCESS_TOKEN";
        $params =  ['tag' => ['name' => $name, 'id' => $tagId]];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除标签
     * @param int $tagId 标签ID
     * @return array
     */
    public function delete(int $tagId)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/tags/delete?access_token=ACCESS_TOKEN";
        $params = ['tag' => ['id' => $tagId]];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取标签下粉丝列表
     * @param int $tagId 标签ID
     * @param string $next_openid 第一个拉取的OPENID
     * @return array
     */
    public function getTagUsers(int $tagId, string $next_openid = '')
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token=ACCESS_TOKEN";
        $params = ['tagid' => $tagId, 'next_openid' => $next_openid];
        return $this->callPostApi($url, $params);
    }

    /**
     * 批量为用户添加标签
     * @param array $openids
     * @param int $tagId
     * @return array
     */
    public function tagUsers(array $openids, int $tagId)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=ACCESS_TOKEN";
        $params =  ['openid_list' => $openids, 'tagid' => $tagId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 批量为用户移除标签
     * @param array $openids
     * @param int $tagId
     * @return array
     */
    public function untagUsers(array $openids, int $tagId)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token=ACCESS_TOKEN";
        $params =  ['openid_list' => $openids, 'tagid' => $tagId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取用户身上的标签列表
     * @param string $openid
     * @return array
     */
    public function getidList(string $openid)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/tags/getidlist?access_token=ACCESS_TOKEN";
        $params = ['openid' => $openid];
        return $this->callPostApi($url, $params);
    }
}