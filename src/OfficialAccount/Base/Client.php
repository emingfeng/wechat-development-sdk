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

namespace eMingFeng\OfficialAccount\Base;

use eMingFeng\Kernel\core\BaseClient;
use eMingFeng\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Room
 * @package eMingFeng\OfficialAccount\Basic
 * doc https://developers.weixin.qq.com/doc/offiaccount/Basic_Information/Get_the_WeChat_server_IP_address.html
 */

class Client extends BaseClient
{
    /**
     * 公众号调用或第三方平台帮公众号调用对公众号的所有api调用（包括第三方帮其调用）次数进行清零
     * @return array
     */
    public function clearQuota()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/clear_quota?access_token=ACCESS_TOKEN";
        $params = ['appid' => $this->config->get('appid')];
        return $this->callPostApi($url, $params);
    }

    /**
     * 网络检测
     * @param string $action 执行的检测动作
     * @param string $operator 指定平台从某个运营商进行检测
     * @return array
     */
    public function check(string $action = 'all',string $operator = 'DEFAULT')
    {
        $url = "https://api.weixin.qq.com/cgi-bin/callback/check?access_token=ACCESS_TOKEN";
        if (!in_array($action, ['dns', 'ping', 'all'], true)) {
            throw new InvalidArgumentException('The action must be dns, ping, all.');
        }

        $operator = strtoupper($operator);

        if (!in_array($operator, ['CHINANET', 'UNICOM', 'CAP', 'DEFAULT'], true)) {
            throw new InvalidArgumentException('The operator must be CHINANET, UNICOM, CAP, DEFAULT.');
        }

        $params = [
            'action' => $action,
            'check_operator' => $operator,
        ];
        return $this->callPostApi($url, $params);
    }


    /**
     * 获取微信API接口 IP地址
     * @return array
     */
    public function getApiDomainIp()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/get_api_domain_ip?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 获取微信callback IP地址
     * @return array
     */
    public function getCallbackIp()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }
}