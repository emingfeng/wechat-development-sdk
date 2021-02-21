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

namespace eMingFeng\OpenPlatform\Beta;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 试用小程序
 * Class Room
 * @package eMingFeng\OpenPlatform\Beta
 * @openplatform doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/Register_Mini_Programs/beta_mp/fastregister.html
 */

class Client extends BaseClient
{
    /**
     * 创建小程序接口
     * @param string $name 小程序名称，昵称半自动设定，强制后缀“的体验小程序”
     * @param string $openid
     * @return array
     */
    public function regBeta(string $name, string $openid)
    {
        $component_access_token = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/wxa/component/fastregisterbetaweapp?access_token={$component_access_token}";
        $data = ['name' => $name, 'openid' => $openid];
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 修改试用小程序名称
     * @param string $name
     * @return array
     */
    public function setName(string $name){
        $url = "https://api.weixin.qq.com/wxa/setbetaweappnickname?access_token=ACCESS_TOKEN";
        $params = ['name' => $name];
        return $this->callPostApi($url, $params);
    }

    /**
     * 试用小程序快速认证
     * @param array $verify_info
     * @return array
     */
    public function verify(array $verify_info){
        $url = "https://api.weixin.qq.com/wxa/verifybetaweapp?access_token=ACCESS_TOKEN";
        $params = ['verify_info' => $verify_info];
        return $this->callPostApi($url, $params);
    }
}