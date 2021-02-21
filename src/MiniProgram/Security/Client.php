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

namespace eMingFeng\MiniProgram\Security;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 内容安全
 * Class Room
 * @package eMingFeng\MiniProgram\Security
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/sec-check/security.msgSecCheck.html
 * @openplatform doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/Mini_Programs/Security/security.imgSecCheck.html
 */

class Client extends BaseClient
{
    /**
     * 校验一张图片是否含有违法违规内容
     * @param string $media 要检测的图片文件，格式支持PNG、JPEG、JPG、GIF，图片尺寸不超过 750px x 1334px
     * @return array
     */
    public function imgSecCheck($media)
    {
        $url = "https://api.weixin.qq.com/wxa/img_sec_check?access_token=ACCESS_TOKEN";
        return $this->callUploadApi($url, $media, 'media');
    }

    /**
     * 检查一段文本是否含有违法违规内容
     * @param string $content
     * @return array
     */
    public function msgSecCheck($content)
    {
        $url = "https://api.weixin.qq.com/wxa/msg_sec_check?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, ['content' => $content], true);
    }

    /**
     * 异步校验图片/音频是否含有违法违规内容
     * @param string $media_url
     * @param string $media_type
     * @return array
     */
    public function mediaCheckAsync($media_url, $media_type)
    {
        $url = "https://api.weixin.qq.com/wxa/media_check_async?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, ['media_url' => $media_url, 'media_type' => $media_type], true);
    }
}