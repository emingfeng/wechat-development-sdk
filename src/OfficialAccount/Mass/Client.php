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

namespace eMingFeng\OfficialAccount\Mass;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 群发
 * Class Client
 * @package eMingFeng\OfficialAccount\Mass
 * @officialaccount doc https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Batch_Sends_and_Originality_Checks.html
 */
class Client extends BaseClient
{
    /**
     * 根据标签进行群发【订阅号与服务号认证后均可用】
     * @param array $data
     * @return array
     */
    public function sendAll(array $data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 根据OpenID列表群发【订阅号不可用，服务号认证后可用】
     * @param array $data
     * @return array
     */
    public function send(array $data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 删除群发【订阅号与服务号认证后均可用】
     * @param integer $msg_id 发送出去的消息ID
     * @param string $article_idx 要删除的文章在图文消息中的位置，第一篇编号为1，该字段不填或填0会删除全部文章
     * @return array
     */
    public function delete($msg_id, $article_idx = null)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/delete?access_token=ACCESS_TOKEN";
        $data = ['msg_id' => $msg_id];
        is_null($article_idx) || $data['article_idx'] = $article_idx;
        return $this->callPostApi($url, $data);
    }

    /**
     * 预览接口【订阅号与服务号认证后均可用】
     * @param array $data
     * @return array
     */
    public function preview(array $data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 查询群发消息发送状态【订阅号与服务号认证后均可用】
     * @param integer $msg_id 群发消息后返回的消息id
     * @return array
     */
    public function get($msg_id)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/get?access_token=ACCESS_TOKEN";
        $params =  ['msg_id' => $msg_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取群发速度
     * @return array
     */
    public function getSpeed()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/speed/get?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, []);
    }

    /**
     * 设置群发速度
     * @param integer $speed 群发速度的级别
     * @return array
     */
    public function setSpeed($speed)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/speed/set?access_token=ACCESS_TOKEN";
        $params = ['speed' => $speed];
        return $this->callPostApi($url, $params);
    }
}