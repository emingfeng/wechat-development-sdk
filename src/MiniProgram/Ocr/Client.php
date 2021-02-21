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

namespace eMingFeng\MiniProgram\Ocr;
use eMingFeng\Kernel\core\BaseClient;

/**
 * Ocr
 * Class Room
 * @package eMingFeng\MiniProgram\Analysis
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/ocr/ocr.bankcard.html
 */

class Client extends BaseClient
{
    /**
     * 本接口提供基于小程序的身份证 OCR 识别
     * @param string $img_url 要检测的图片 url，传这个则不用传 img 参数。
     * @param string $img form-data 中媒体文件标识，有filename、filelength、content-type等信息，传这个则不用传 img_url
     * @return array
     */
    public function idcard(string $img_url = null, string $img = null)
    {
        if($img_url){
            $url = "https://api.weixin.qq.com/cv/ocr/idcard?img_url={$img_url}&access_token=ACCESS_TOKEN";
            return $this->callPostApi($url,[]);
        }else{
            $url = "https://api.weixin.qq.com/cv/ocr/idcard?access_token=ACCESS_TOKEN";
            return $this->callUploadApi($url, $img, 'img');
        }
    }


    /**
     * 本接口提供基于小程序的银行卡 OCR 识别
     * @param array $data
     * @return array
     */
    public function bankcard(string $img_url = null, string $img = null)
    {
        if($img_url){
            $url = "https://api.weixin.qq.com/cv/ocr/bankcard?img_url={$img_url}&access_token=ACCESS_TOKEN";
            return $this->callPostApi($url,[]);
        }else{
            $url = "https://api.weixin.qq.com/cv/ocr/bankcard?access_token=ACCESS_TOKEN";
            return $this->callUploadApi($url, $img, 'img');
        }
    }

    /**
     * 本接口提供基于小程序的驾驶证 OCR 识别
     * @param string $img_url 要检测的图片 url，传这个则不用传 img 参数。
     * @param string $img form-data 中媒体文件标识，有filename、filelength、content-type等信息，传这个则不用传 img_url
     * @return array
     */
    public function driverLicense(string $img_url = null, string $img = null)
    {
        if($img_url){
            $url = "https://api.weixin.qq.com/cv/ocr/drivinglicense?img_url={$img_url}&access_token=ACCESS_TOKEN";
            return $this->callPostApi($url,[]);
        }else{
            $url = "https://api.weixin.qq.com/cv/ocr/drivinglicense?access_token=ACCESS_TOKEN";
            return $this->callUploadApi($url, $img, 'img');
        }
    }

    /**
     * 本接口提供基于小程序的行驶证 OCR 识别
     * @param string $img_url 要检测的图片 url，传这个则不用传 img 参数。
     * @param string $img form-data 中媒体文件标识，有filename、filelength、content-type等信息，传这个则不用传 img_url
     * @param string $type 图片识别模式，photo（拍照模式）或 scan（扫描模式）
     * @return array
     */
    public function vehicleLicense(string $img_url = null, string $img = null)
    {
        if($img_url){
            $url = "https://api.weixin.qq.com/cv/ocr/driving?img_url={$img_url}&access_token=ACCESS_TOKEN";
            return $this->callPostApi($url,[]);
        }else{
            $url = "https://api.weixin.qq.com/cv/ocr/driving?access_token=ACCESS_TOKEN";
            return $this->callUploadApi($url, $img, 'img');
        }

    }


    /**
     * 本接口提供基于小程序的营业执照 OCR 识别
     * @param string $img_url 要检测的图片 url，传这个则不用传 img 参数。
     * @param string $img form-data 中媒体文件标识，有filename、filelength、content-type等信息，传这个则不用传 img_url
     * @return array
     */
    public function businessLicense(string $img_url = null, string $img = null)
    {
        if($img_url){
            $url = "https://api.weixin.qq.com/cv/ocr/bizlicense?img_url={$img_url}&access_token=ACCESS_TOKEN";
            return $this->callPostApi($url,[]);
        }else{
            $url = "https://api.weixin.qq.com/cv/ocr/bizlicense?access_token=ACCESS_TOKEN";
            return $this->callUploadApi($url, $img, 'img');
        }
    }


    /**
     * 本接口提供基于小程序的通用印刷体 OCR 识别
     * @param string $img_url 要检测的图片 url，传这个则不用传 img 参数。
     * @param string $img form-data 中媒体文件标识，有filename、filelength、content-type等信息，传这个则不用传 img_url
     * @return array
     */
    public function printedText(string $img_url = null, string $img = null)
    {
        if($img_url){
            $url = "https://api.weixin.qq.com/cv/ocr/comm?img_url={$img_url}&access_token=ACCESS_TOKEN";
            return $this->callPostApi($url,[]);
        }else{
            $url = "https://api.weixin.qq.com/cv/ocr/comm?access_token=ACCESS_TOKEN";
            return $this->callUploadApi($url, $img, 'img');
        }
    }

    /**
     * 车牌OCR识别接口
     * @param string $img_url 要检测的图片 url，传这个则不用传 img 参数。
     * @param string $img form-data 中媒体文件标识，有filename、filelength、content-type等信息，传这个则不用传 img_url
     * @return array
     */
    public function platenum(string $img_url = null, string $img = null)
    {

        if($img_url){
            $url = "https://api.weixin.qq.com/cv/ocr/platenum?img_url={$img_url}&access_token=ACCESS_TOKEN";
            return $this->callPostApi($url,[]);
        }else{
            $url = "https://api.weixin.qq.com/cv/ocr/platenum?access_token=ACCESS_TOKEN";
            return $this->callUploadApi($url, $img, 'img');
        }
    }
}