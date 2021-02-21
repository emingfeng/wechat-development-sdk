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

namespace eMingFeng\MiniProgram\CustomerMessage;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 客服消息
 * Class Room
 * @package eMingFeng\MiniProgram\CustomerMessage
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/customer-message/customerServiceMessage.send.html
 */

class Client extends BaseClient
{
    /**
     * 发送客服消息给用户
     * @param string $openid 用户的 OpenID
     * @param string $msgtype 消息类型
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
     * 客服输入状态 (重复)
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

    /**
     * 获取临时素材 (重复)
     * @param string $media_id
     * @return array
     */
    public function getMedia(string $media_id)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=ACCESS_TOKEN&media_id={$media_id}";
        return $this->callGetApi($url);
    }

    /**
     * 上传图文消息内的图片获取URL（重复）
     * @param string $file
     * @return array
     */
    public function uploadImg($file)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=ACCESS_TOKEN";
        return $this->callUploadApi($url, $file, 'image');
    }
}