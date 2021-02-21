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

namespace eMingFeng\OfficialAccount\CustomerService;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 客服管理 - 会话控制
 * Class Room
 * @package eMingFeng\OfficialAccount\CustomService
 * @officialaccount doc https://developers.weixin.qq.com/doc/offiaccount/Customer_Service/Session_control.html
 */

class Session extends BaseClient
{
    /**
     * 创建会话
     * @param string $account 完整客服帐号，格式为：帐号前缀@公众号微信号
     * @param string $openid 粉丝的openid
     * @return array
     */
    public function create(string $account, string $openid)
    {
        $url = "https://api.weixin.qq.com/customservice/kfsession/create?access_token=ACCESS_TOKEN";
        $params = ['kf_account' => $account, 'openid' => $openid];
        return $this->callPostApi($url, $params);
    }

    /**
     * 关闭会话
     * @param string $account 完整客服帐号，格式为：帐号前缀@公众号微信号
     * @param string $openid 粉丝的openid
     * @return array
     */
    public function close(string $account, string $openid)
    {
        $url = "https://api.weixin.qq.com/customservice/kfsession/close?access_token=ACCESS_TOKEN";
        $params = ['kf_account' => $account, 'openid' => $openid];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取客户会话状态
     * @param string $openid 粉丝的openid
     * @return array
     */
    public function getSession(string $openid)
    {
        $url = "https://api.weixin.qq.com/customservice/kfsession/getsession?access_token=ACCESS_TOKEN&openid={$openid}";
        return $this->callGetApi($url);
    }

    /**
     * 获取客服会话列表
     * @param string $account 完整客服帐号，格式为：帐号前缀@公众号微信号
     * @return array
     */
    public function getSessionList(string $account)
    {
        $url = "https://api.weixin.qq.com/customservice/kfsession/getsessionlist?access_token=ACCESS_TOKEN&kf_account={$account}";
        return $this->callGetApi($url);
    }

    /**
     * 获取未接入会话列表
     * @return array
     */
    public function getWaitCase()
    {
        $url = "https://api.weixin.qq.com/customservice/kfsession/getwaitcase?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }
}
