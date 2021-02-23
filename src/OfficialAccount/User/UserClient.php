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
 * Class UserClient
 * @package eMingFeng\OfficialAccount\User
 * @officialAccount doc https://developers.weixin.qq.com/doc/offiaccount/User_Management/Configuring_user_notes.html
 */

class UserClient extends BaseClient
{
    /**
     * 获取用户基本信息（包括UnionID机制）
     * @param string $openid
     * @param string $lang
     * @return array
     */
    public function get(string $openid, string $lang = 'zh_CN')
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=ACCESS_TOKEN&openid={$openid}&lang={$lang}";
        return $this->callGetApi($url);
    }

    /**
     * 批量获取用户基本信息,最多支持一次拉取100条
     * @param array $openids
     * @param string $lang
     * @return array
     */
    public function select(array $openids, string $lang = 'zh_CN')
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/info/batchget?access_token=ACCESS_TOKEN";
        $params = ['user_list' => []];
        foreach ($openids as $openid) {
            $params['user_list'][] = ['openid' => $openid, 'lang' => $lang];
        }
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取用户列表
     * @param string $next_openid 第一个拉取的OPENID，不填默认从头开始拉取
     * @return array
     */
    public function list(string $next_openid  = '')
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=ACCESS_TOKEN&next_openid={$next_openid }";
        return $this->callGetApi($url);
    }

    /**
     * 设置用户备注名
     * @param string $openid 用户标识
     * @param string $remark 新的备注名，长度必须小于30字符
     * @return array
     */
    public function updateremark($openid, $remark)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token=ACCESS_TOKEN";
        $params = ['openid' => $openid, 'remark' => $remark];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取公众号的黑名单列表
     * @param string $begin_openid
     * @return array
     */
    public function blacklist($begin_openid = '')
    {
        $url = "https://api.weixin.qq.com/cgi-bin/tags/members/getblacklist?access_token=ACCESS_TOKEN";
        $params = ['begin_openid' => $begin_openid];
        return $this->callPostApi($url, $params);
    }

    /**
     * 批量拉黑用户
     * @param array $openidList
     * @return array
     */
    public function block(array $openidList)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/tags/members/batchblacklist?access_token=ACCESS_TOKEN";
        $params =  ['openid_list' => $openidList];
        return $this->callPostApi($url, $params);
    }

    /**
     * 批量取消拉黑用户
     * @param array $openidList
     * @return array
     */
    public function unblock(array $openidList)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/tags/members/batchunblacklist?access_token=ACCESS_TOKEN";
        $params = ['openid_list' => $openidList];
        return $this->callPostApi($url, $params);
    }

    /**
     * https://kf.qq.com/faq/1901177NrqMr190117nqYJze.html
     * openid转换接口
     * @param string $oldAppId
     * @param array $openid_list
     * @return array
     */
    public function changeOpenid(string $from_appid, array $openid_list)
    {
        $url = "http://api.weixin.qq.com/cgi-bin/changeopenid?access_token=ACCESS_TOKEN";
        $params = ['from_appid'=>$from_appid, 'openid_list' => $openid_list];
        return $this->callPostApi($url, $params);
    }
}
