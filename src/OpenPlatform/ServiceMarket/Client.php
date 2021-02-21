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

namespace eMingFeng\OpenPlatform\ServiceMarket;

use eMingFeng\Kernel\core\BaseClient;
use eMingFeng\OpenPlatform\Base\Client as Base;

/**
 * 服务市场
 * Class Room
 * @package eMingFeng\MiniProgram\ServiceMarket
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/service-market/serviceMarket.invokeService.html
 * @openplatform doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/servicemarket/serviceMarket.invokeService.html
 */

class Client extends BaseClient
{
    /**
     * 调用服务平台提供的服务
     * @param string $service 服务 ID
     * @param string $api 接口名
     * @param string $data 服务提供方接口定义的 JSON 格式的数据
     * @param string $client_msg_id 随机字符串 ID，调用方请求的唯一标识
     * @return array
     */
    public function serviceMarket(string $service, string $api, array $data, string $client_msg_id)
    {
        $url = "https://api.weixin.qq.com/wxa/servicemarket?access_token=ACCESS_TOKEN";
        $params = ['service' => $service, 'api' => $api, 'data' => $data, 'client_msg_id' => $client_msg_id];

        return $this->callPostApi($url, $params);
    }
}