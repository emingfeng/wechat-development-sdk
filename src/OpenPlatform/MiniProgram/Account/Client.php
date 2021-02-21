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

namespace eMingFeng\OpenPlatform\MiniProgram\Account;

use eMingFeng\Kernel\core\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取帐号基本信息
     * @return array
     */
    public function getAccountBasicinfo()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/account/getaccountbasicinfo?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 修改头像
     * @param string  $head_img_media_id 头像素材mediaId
     * @param string  $x1    剪裁框左上角x坐标（取值范围：[0, 1]）
     * @param string  $y1     剪裁框左上角y坐标（取值范围：[0, 1]）
     * @param string  $x2   剪裁框右下角x坐标（取值范围：[0, 1]）
     * @param string  $y2  剪裁框右下角y坐标（取值范围：[0, 1]）
     * @return array
     */
    public function updateAvatar(
        string $head_img_media_id,
        string $x1 = '0',
        string $y1 = '0',
        string $x2 = '1',
        string $y2 = '1'
    ){
        $params = [
            'head_img_media_id' => $head_img_media_id,
            'x1' => $x1, 'y1' => $y, 'x2' => $x2, 'y2' => $y2,
        ];
        $url = "https://api.weixin.qq.com/cgi-bin/account/modifyheadimage?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $params);
    }

    /**
     * 修改功能介绍
     * @param string $signature 功能介绍（简介）
     * @return array
     */
    public function updateSignature(string $signature)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/account/modifysignature?access_token=ACCESS_TOKEN";
        $params = ['signature' => $signature];
        return $this->callPostApi($url, $params);
    }
}