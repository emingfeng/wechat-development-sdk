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
 * 客服管理
 * Class Room
 * @package eMingFeng\OfficialAccount\CustomService
 * @officialaccount doc https://developers.weixin.qq.com/doc/offiaccount/Customer_Service/Customer_Service_Management.html#0
 */

class Client extends BaseClient
{
    /**
     * 获取客服基本信息
     * @return array
     */
    public function list()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 添加客服
     * @param string $account 完整客服帐号，格式为：帐号前缀@公众号微信号
     * @param string $nickname 客服昵称
     * @return array
     */
    public function add(string $account, string $nickname)
    {
        $url = "https://api.weixin.qq.com/customservice/kfaccount/add?access_token=ACCESS_TOKEN";
        $params = ['kf_account' => $account, 'nickname' => $nickname];
        return $this->callPostApi($url, $params);
    }

    /**
     * 邀请绑定客服帐号
     * @param string $account 完整客服帐号，格式为：帐号前缀@公众号微信号
     * @param string $wechatId 接收绑定邀请的客服微信号
     * @return array
     */
    public function invite(string $account, string $wechatId)
    {
        $url = "https://api.weixin.qq.com/customservice/kfaccount/inviteworker?access_token=ACCESS_TOKEN";
        $params = ['kf_account' => $account, 'invite_wx' => $wechatId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 设置客服信息
     * @param string $account  完整客服帐号，格式为：帐号前缀@公众号微信号
     * @param string $nickname 客服昵称
     * @return array
     */
    public function update(string $account, string $nickname)
    {
        $url = "https://api.weixin.qq.com/customservice/kfaccount/update?access_token=ACCESS_TOKEN";
        $params = ['kf_account' => $account, 'nickname' => $nickname];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除客服帐号
     * @param string $account
     * @return array
     */
    public function del(string $account)
    {
        $url = "https://api.weixin.qq.com/customservice/kfaccount/del?access_token=ACCESS_TOKEN&kf_account={$account}";
        return $this->callGetApi($url);
    }

    /**
     * 上传客服头像
     * @param string $account 完整客服帐号，格式为：帐号前缀@公众号微信号
     * @param string $media 图像本地地址
     * @return array
     */
    public function uploadHeadImg(string $account,string $file)
    {
        $url = "https://api.weixin.qq.com/customservice/kfaccount/uploadheadimg?access_token=ACCESS_TOKEN&kf_account={$account}";
        return $this->callUploadApi($url, $file, 'media');
    }

    /**
     * 获取聊天记录
     * @param string $starttime 起始时间，unix时间戳
     * @param string $endtime 结束时间，unix时间戳，每次查询时段不能超过24小时
     * @param int $msgid 消息id顺序从小到大，从1开始
     * @param int $number 每次获取条数，最多10000条
     * @return array
     */
    public function getMsgList(string $starttime, string $endtime , int $msgid = 1, int $number = 1000)
    {
        $url = "https://api.weixin.qq.com/customservice/msgrecord/getmsglist?access_token=ACCESS_TOKEN";
        $params = ['stattime' => $starttime, 'endtime' => $endtime, 'msgid' => $msgid, 'number' => $number];
        return $this->callPostApi($url, $params);
    }

    /**
     * 发送客服消息给用户
     * @param string $openid
     * @param string $msgtype
     * @param array $content ['content' => '好的']
     * @return array
     */
    public function send(string $openid, string $msgtype, array $content)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=ACCESS_TOKEN";
        $params = ['touser' => $openid, 'msgtype' => $msgtype, $msgtype => $content ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 客服输入状态
     * @param string $openid 普通用户（openid）
     * @param string $command Typing:正在输入,CancelTyping:取消正在输入
     * @return array
     */
    public function typing(string $openid, string $command = 'Typing')
    {
        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/typing?access_token=ACCESS_TOKEN";
        $params = ['touser' => $openid, 'command' => $command];
        return $this->callPostApi($url, $params);
    }
}
