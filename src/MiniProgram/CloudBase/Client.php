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

namespace eMingFeng\MiniProgram\CloudBase;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 云开发
 * Class Room
 * @package eMingFeng\MiniProgram\CloudBase
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/cloudbase/cloudbase.getOpenData.html
 */

class Client extends BaseClient
{
    /**
     * 换取 cloudID 对应的开放数据
     * @param array $cloudid_list CloudID 列表
     * @return array
     */
    public function getOpenData($cloudid_list)
    {
        $url = "https://api.weixin.qq.com/wxa/getopendata?openid=OPENID&access_token=ACCESS_TOKEN";
        $params = ['cloudid_list' => $cloudid_list];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取实时语音签名
     * @param string $groud_id 游戏房间的标识
     * @param string $nonce 随机字符串，长度应小于 128
     * @param string $timetamp 生成这个随机字符串的 UNIX 时间戳（精确到秒）
     * @return array
     */
    public function getVoIPSign($groud_id, $nonce, $timestamp)
    {
        $url = "https://api.weixin.qq.com/wxa/getvoipsign?openid=OPENID&access_token=ACCESS_TOKEN";
        $params = ['groud_id' => $groud_id, 'nonce' => $nonce, 'timestamp' => $timestamp];
        return $this->callPostApi($url, $params);
    }

    /**
     * 发送支持打开云开发静态网站的短信
     * @param string $env 环境 ID
     * @param array $phone_number_list 手机号列表，单次请求最多支持 1000 个境内手机号，手机号必须以+86开头
     * @param string $content 自定义短信内容，最长支持 30 个字符
     * @param string $path 云开发静态网站 path，不需要指定域名，例如/index.html
     */
    public function sendSms(string $env, array $phone_number_list, string $content, string $path)
    {
        $url = "https://api.weixin.qq.com/tcb/sendsms?access_token=ACCESS_TOKEN";
        $params = ['env' => $env, 'phone_number_list' => $phone_number_list, 'content' => $content, 'path' => $path];
        return $this->callPostApi($url, $params);
    }
}
