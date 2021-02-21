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

namespace eMingFeng\MiniProgram\AppCode;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 小程序码
 * Class Room
 * @package eMingFeng\MiniProgram\AppCode
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/qr-code/wxacode.createQRCode.html
 * @openplatform doc
 */

class Client extends BaseClient
{
    /**
     * 获取小程序码（永久有效） 接口A: 适用于需要的码数量较少的业务场景
     * @param string $path 不能为空，最大长度 128 字节
     * @param int $width 二维码的宽度，单位 px。最小 280px，最大 1280px
     * @param bool $auto_color 自动配置线条颜色，如果颜色依然是黑色，则说明不建议配置主色调
     * @param array $line_color auto_color 为 false 时生效
     * @param bool $is_hyaline 是否需要透明底色
     * @return array|string
     */
    public function getwxacode(
        string $path,
        int $width = 430,
        bool $auto_color = false,
        array $line_color = ["r" => "0", "g" => "0", "b" => "0"],
        bool $is_hyaline = true
    ){
        $url = "https://api.weixin.qq.com/wxa/getwxacode?access_token=ACCESS_TOKEN";

        return $this->callDownloadApi($url,[ 'width' => $width, 'auto_color' => $auto_color, 'path' => $path, 'line_color' => $line_color, 'is_hyaline' => $is_hyaline],false);

    }

    /**
     * 获取小程序码（永久有效） 接口B：适用于需要的码数量极多的业务场景
     * @param string $page 必须是已经发布的小程序存在的页面
     * @param string $scene 最大32个可见字符，只支持数字
     * @param int $width 二维码的宽度
     * @param bool $auto_color 自动配置线条颜色，如果颜色依然是黑色，则说明不建议配置主色调
     * @param array $line_color auto_color 为 false 时生效
     * @param bool $is_hyaline 是否需要透明底色
     * @return array|string
     */
    public function getUnlimited(
        string $page,
        string $scene,
        int $width = 430,
        bool $auto_color = false,
        array $line_color = ["r" => "0", "g" => "0", "b" => "0"],
        bool $is_hyaline = true
    ){
        $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=ACCESS_TOKEN";

        return $this->callDownloadApi($url,['scene' => $scene, 'width' => $width, 'auto_color' => $auto_color, 'page' => $page, 'line_color' => $line_color, 'is_hyaline' => $is_hyaline],false);

    }

    /**
     * 获取小程序二维码
     * @param string $path 不能为空，最大长度 128 字节
     * @param int $width 二维码的宽度
     * @return array|string
     * @example 获取小程序二维码（永久有效）
     */
    public function createQRCode($path, $width = 430)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxaapp/createwxaqrcode?access_token=ACCESS_TOKEN";

        return $this->callDownloadApi($url,['path' => $path, 'width' => $width],false);

    }
}