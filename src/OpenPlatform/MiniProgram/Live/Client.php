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

namespace eMingFeng\OpenPlatform\MiniProgram\Live;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 普通链接二维码与小程序码
 * Class Room
 * @package eMingFeng\OpenPlatform\MiniProgram\QrCode
 * @miniprogram  doc
 * @openplatform doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/Mini_Programs/qrcode/qrcode.html
 */

class Client extends BaseClient
{

    public function applyLiveInfo()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/shorturl?access_token=ACCESS_TOKEN";
        $params = ['action' => 'apply'];
        return $this->callPostApi($url, $params);
    }
}