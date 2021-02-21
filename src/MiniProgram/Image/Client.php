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

namespace eMingFeng\MiniProgram\Image;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 图像处理
 * Class Room
 * @package eMingFeng\MiniProgram\Image
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/img/img.superresolution.html
 * @officialAccount doc https://developers.weixin.qq.com/doc/offiaccount/Intelligent_Interface/Img_Proc.html
 */

class Client extends BaseClient
{
    /**
     * 本接口提供基于小程序的图片智能裁剪能力
     * @param string $img_url 要检测的图片 url，传这个则不用传 img 参数。
     * @param string $img form-data 中媒体文件标识，有filename、filelength、content-type等信息，传这个则不用传 img_url
     * @return array
     */
    public function aiCrop(string $img_url = null, string $img = null)
    {
        if($img_url){
            $url = "https://api.weixin.qq.com/cv/img/aicrop?img_url={$img_url}&access_token=ACCESS_TOKEN";
            return $this->callPostApi($url,[]);
        }else{
            $url = "https://api.weixin.qq.com/cv/img/aicrop?access_token=ACCESS_TOKEN";

            return $this->callUploadApi($url, $img, 'img');
        }
    }

    /**
     * 本接口提供基于小程序的条码/二维码识别的API
     * @param string $img_url 要检测的图片 url，传这个则不用传 img 参数。
     * @param string $img form-data 中媒体文件标识，有filename、filelength、content-type等信息，传这个则不用传 img_url
     * @return array
     */
    public function scanQRCode(string $img_url = null, $img = null)
    {
        if($img_url){
            $url = "https://api.weixin.qq.com/cv/img/qrcode?img_url={$img_url}&access_token=ACCESS_TOKEN";
            return $this->callPostApi($url,[]);
        }else{
            $url = "https://api.weixin.qq.com/cv/img/qrcode?access_token=ACCESS_TOKEN";

            return $this->callUploadApi($url, $img, 'img');
        }
    }

    /**
     * 本接口提供基于小程序的图片高清化能力
     * @param string $img_url 要检测的图片 url，传这个则不用传 img 参数
     * @param string $img form-data 中媒体文件标识，有filename、filelength、content-type等信息，传这个则不用传 img_url
     * @return array
     */
    public function superresolution(string $img_url = null, string $img = null)
    {

        if($img_url){
            $url = "https://api.weixin.qq.com/cv/img/superresolution?img_url={$img_url}&access_token=ACCESS_TOKEN";
            return $this->callPostApi($url,[]);
        }else{
            $url = "https://api.weixin.qq.com/cv/img/superresolution?access_token=ACCESS_TOKEN";

            return $this->callUploadApi($url, $img, 'img');
        }
    }
}