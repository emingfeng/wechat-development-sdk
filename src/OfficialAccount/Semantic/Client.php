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

namespace eMingFeng\OfficialAccount\Semantic;

use eMingFeng\Kernel\core\BaseClient;

class Client extends BaseClient
{
    /**
     * @param string $query
     * @param string $category
     * @param $options
     * @return array
     */
    public function search(string $query, string $category, $options)
    {

        $url = "https://api.weixin.qq.com/semantic/semproxy/search?access_token=ACCESS_TOKEN";
        $params = [
            'query' => $query,
            'appid' => $this->config['appid'],
            'category' => $category,
        ];
        $data = array_merge($params,$options);

        return $this->callPostApi($url, $data);

    }

    public function joke()
    {
        $url = "https://api.weixin.qq.com/wxa/servicemarket?access_token=ACCESS_TOKEN";
        $serviceId = 'wxcae50ba710ca29d3';
        $params = ['service' => $serviceId, 'api' => 'jokebot', 'data' => ['mode' => 1], 'client_msg_id' => 'id123'];
        return $this->callPostApi($url, $params);
    }
}