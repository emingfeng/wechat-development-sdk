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

namespace eMingFeng\OfficialAccount\Qrcode;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 二维码
 * Class Room
 * @package eMingFeng\OfficialAccount\Qrcode
 * @officialaccount doc https://developers.weixin.qq.com/doc/offiaccount/Account_Management/Generating_a_Parametric_QR_Code.html
 */

class Client extends BaseClient
{
    /**
     * 创建临时二维码
     * @param $sceneValue 场景值id
     * @param $expireSeconds 二维码过期时间
     * @return array
     */
    public function createTemp($sceneValue, $expireSeconds){
        if (is_int($sceneValue) && $sceneValue > 0 && $sceneValue < 100000) {
            $actionName = "QR_LIMIT_SCENE";
            $sceneKey = 'scene_id';
        } else {
            $actionName = "QR_LIMIT_STR_SCENE";
            $sceneKey = 'scene_str';
        }

        $scene = [$sceneKey => $sceneValue];

        null !== $expireSeconds || $expireSeconds = 7 * 86400;


        $params = [
            'action_name' => $actionName,
            'action_info' => ['scene' => $scene],
        ];

        $params['expire_seconds'] = min($expireSeconds, 30 * 86400);

        return $this->create($params);
    }

    /**
     * 创建永久二维码
     * @param $sceneValue 场景值id
     * @return array
     */

    public function createNever($sceneValue){

        if (is_int($sceneValue) && $sceneValue > 0) {
            $actionName = "QR_SCENE";
            $sceneKey = 'scene_id';
        } else {
            $actionName = "QR_STR_SCENE";
            $sceneKey = 'scene_str';
        }
        $scene = [$sceneKey => $sceneValue];

        $params = [
            'action_name' => $actionName,
            'action_info' => ['scene' => $scene],
        ];
        return $this->create($params);

    }

    public function create($params)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=ACCESS_TOKEN";

        return $this->callPostApi($url, $params);
    }

    /**
     * 通过ticket换取二维码
     * @param string $ticket 获取的二维码ticket，凭借此ticket可以在有效时间内换取二维码。
     * @return string
     */
    public function showQrcode($ticket)
    {
        $ticket = urlencode($ticket);
        return "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket={$ticket}";
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
        return $this->callPostApi($url, $params);
    }


}