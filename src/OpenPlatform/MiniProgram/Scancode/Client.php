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

namespace eMingFeng\OpenPlatform\MiniProgram\Scancode;

use eMingFeng\Kernel\core\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取展示的公众号信息
     * @return array
     */
    public function getShowwxaitem(){
        $url = "https://api.weixin.qq.com/wxa/getshowwxaitem?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 获取可以用来设置的公众号列表.
     * @param int $page
     * @param int $num
     * @return array
     */
    public function getWxamplinkforshow(int $page = 0 , int $num = 20)
    {

        $url = "https://api.weixin.qq.com/wxa/getwxamplinkforshow?access_token=ACCESS_TOKEN&page={$page}&num={$num}";
        return $this->callGetApi($url);
    }

    /**
     * 设置展示的公众号.
     * @param string $appid
     * @return array
     */
    public function updateShowwxaitem($appid = null)
    {
        $url = "https://api.weixin.qq.com/wxa/updateshowwxaitem?access_token=ACCESS_TOKEN";
        $params = [
            'appid' => $appid ?: null,
            'wxa_subscribe_biz_flag' => $appid ? 1 : 0,
        ];
        return $this->callPostApi($url, $params);
    }
}