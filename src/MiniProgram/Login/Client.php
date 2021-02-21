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

namespace eMingFeng\MiniProgram\Login;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 登录
 * Class Room
 * @package eMingFeng\MiniProgram\Login
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/login/auth.code2Session.html
 */

class Client extends BaseClient
{
    /**
     * 登录凭证校验
     * @param string $code 登录时获取的 code
     * @return array
     */
    public function session($code)
    {
        $appid = $this->config->get('appid');
        $secret = $this->config->get('appsecret');
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid={$appid}&secret={$secret}&js_code={$code}&grant_type=authorization_code";
        return $this->httpGetForJson($url);
    }
}