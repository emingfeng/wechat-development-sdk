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

namespace eMingFeng\OfficialAccount\Jssdk;

use eMingFeng\Kernel\Contracts\Tools;
use eMingFeng\Kernel\core\BaseClient;
use eMingFeng\Kernel\Exceptions\InvalidResponseException;
/**
 * Jssdk
 * Class Jssdk
 * @package eMingFeng\OfficialAccount\Menu
 * @officialaccount doc https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/JS-SDK.html
 */

class Client extends BaseClient
{
    /**
     * 删除ticket
     * @param string $type ticket类型，wx_card ；jsapi
     */
    public function delTicket(string $type = 'jsapi')
    {
        $appid = $this->config->get('appid');
        $cache_name = "{$appid}_ticket_{$type}";
        Tools::delCache($cache_name);
    }

    /**
     * 获取ticket
     * @param string $type ticket类型，wx_card ；jsapi
     */
    public function getTicket(string $type = 'jsapi')
    {
        $appid = $this->config->get('appid');
        $cache_name = "{$appid}_ticket_{$type}";
        $ticket = Tools::getCache($cache_name);
        if (empty($ticket)) {
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=ACCESS_TOKEN&type={$type}";
            $result = $this->callGetApi($url);

            if (empty($result['ticket'])) {
                throw new InvalidResponseException('Invalid Resoponse Ticket.', '0');
            }
            $ticket = $result['ticket'];
            Tools::setCache($cache_name, $ticket, 5000);
        }
        return $ticket;
    }

    /**
     * 获取JsApi配置信息
     * @param string $type ticket类型，wx_card ；jsapi
     * @param array $jsApiList 接口列表
     * @param bool $debug 调试开关
     * @param bool $json 输出类型
     * @return array|false|string
     */
    public function getJsConfig(string $type, array $jsApiList = [], bool $debug = false, bool $json = true)
    {
        list($url,) = explode('#',Tools::getCurrentUrl());
        $ticket = $this->getTicket($type);
        $appid = $this->config->get('appid');
        $data = [
            "url" => $url,
            "timestamp" => '' . time(),
            "jsapi_ticket" => $ticket,
            "noncestr" => Tools::createNoncestr(16)
        ];
        $result = [
            'debug'     => $debug,
            "appId"     => $appid,
            "nonceStr"  => $data['noncestr'],
            "timestamp" => $data['timestamp'],
            "signature" => $this->makeSignature($data, 'sha1'),
            'jsApiList' => $jsApiList,
        ];
        return $json ? json_encode($result) : $result;
    }

    /**
     * 数据生成签名
     * @param array $data 签名数组
     * @param string $method 签名方法
     * @param array $params 签名参数
     */
    protected function makeSignature(array $data, string $method = "sha1", array $params = [])
    {
        ksort($data);
        if (!function_exists($method)) return false;
        foreach ($data as $k => $v) array_push($params, "{$k}={$v}");
        return $method(join('&', $params));
    }
}