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

namespace eMingFeng\MiniProgram\Soter;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 生物认证
 * Class Room
 * @package eMingFeng\MiniProgram\Soter
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/soter/soter.verifySignature.html
 */

class Client extends BaseClient
{
    /**
     * SOTER 生物认证秘钥签名验证
     * @param array $data
     * @return array
     */
    public function verifySignature(string $openid, string $json_string, string $json_signature)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/soter/verify_signature?access_token=ACCESS_TOKEN";
        $params = ['openid' => $openid, 'json_string' => $json_string, 'json_signature' => $json_signature];
        return $this->callPostApi($url, $params, true);
    }
}