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

namespace eMingFeng\MiniProgram\RiskControl;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 安全风控
 * Class Room
 * @package eMingFeng\MiniProgram\RiskControl
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/safety-control-capability/riskControl.getUserRiskRank.html
 */

class Client extends BaseClient
{
    /**
     * 根据提交的用户信息数据获取用户的安全等级 risk_rank，无需用户授权
     * @param string $appid 小程序appid
     * @param string $openid 用户的openid
     * @param int $scene 场景值，0:注册，1:营销作弊
     * @param string $mobile_no 用户手机号
     * @param string $client_ip 用户访问源ip
     * @param string $email_address 用户邮箱地址
     * @param string $extended_info 额外补充信息
     * @param bool $is_test false：正式调用，true：测试调用
     */
    public function getUserRiskRank(
        string $openid = null,
        int $scene = 0,
        string $mobile_no = null,
        string $client_ip = null,
        string $email_address = null,
        string $extended_info = null,
        bool $is_test = false
    ){
        $url = "https://api.weixin.qq.com/wxa/getuserriskrank?access_token=ACCESS_TOKEN";
        $params = [
            'appid' => $this->config->get('appid') ,
            'openid' => $openid,
            'scene' => $scene,
            'mobile_no' => $mobile_no,
            'client_ip' => $client_ip,
            'email_address' => $email_address,
            'extended_info' => $extended_info,
            'is_test' => $is_test
        ];
        return $this->callPostApi($url, $params);
    }
}