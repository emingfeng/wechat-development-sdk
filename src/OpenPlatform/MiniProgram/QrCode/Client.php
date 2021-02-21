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

namespace eMingFeng\OpenPlatform\MiniProgram\QrCode;

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
    /**
     * 获取已设置的二维码规则
     * @return array
     */
    public function get()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxopen/qrcodejumpget?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, []);
    }

    /**
     * 获取校验文件名称及内容
     * @return array
     */
    public function download()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxopen/qrcodejumpdownload?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, []);
    }

    /**
     * 增加或修改二维码规则
     * @param string $prefix 二维码规则
     * @param int $permit_sub_rule 是否独占符合二维码前缀匹配规则的所有子规 1 为不占用，2 为占用;
     * @param string $path 小程序功能页面
     * @param int $open_version 测试范围 1、开发版（配置只对开发者生效）2、体验版（配置对管理员、体验者生效) 3、正式版（配置对开发者、管理员和体验者生效）     
     * @param string $is_edit 编辑标志位，0 表示新增二维码规则，1 表示修改已有二维码规则
     * @param string $debug_url 测试链接，至多 5 个用于测试的二维码完整链接，此链接必须符合已填写的二维码规则。
     * @return array
     */
    public function add(string $prefix, int $permit_sub_rule, string $path, int $open_version, string $is_edit, array $debug_url = [])
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxopen/qrcodejumpadd?access_token=ACCESS_TOKEN";
        $params = [
            'prefix' => $prefix,
            'permit_sub_rule' => $permit_sub_rule,
            'path' => $path,
            'open_version' => $open_version,
            'is_edit' => $is_edit,
            'debug_url' => $debug_url
        ];

        print_r($params);die;
        return $this->callPostApi($url, $params);
    }

    /**
     * 发布已设置的二维码规则
     * @param string $prefix 二维码规则
     * @return array
     */
    public function publish(string $prefix)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxopen/qrcodejumppublish?access_token=ACCESS_TOKEN";
        $params = ['prefix' => $prefix];
        return $this->callPostApi($url, $params );
    }

    /**
     * 删除已设置的二维码规则
     * @param string $prefix 二维码规则
     * @return array
     */
    public function delete($prefix)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxopen/qrcodejumpdelete?access_token=ACCESS_TOKEN";
        $params = ['prefix' => $prefix];
        return $this->callPostApi($url, $params );
    }

    /**
     * 长链接转短链接接口
     * @param string $longUrl 需要转换的长链接
     * @return array
     */
    public function shortUrl($longUrl)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/shorturl?access_token=ACCESS_TOKEN";
        $params = ['action' => 'long2short', 'long_url' => $longUrl];
        return $this->httpPostForJson($url, $params);
    }
}