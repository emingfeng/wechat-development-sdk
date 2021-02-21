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

namespace eMingFeng\OpenPlatform\MiniProgram\Domain;

use eMingFeng\Kernel\core\BaseClient;

class Client extends BaseClient
{
    /**
     * 设置服务器域名
     * @param string $action add添加,delete删除,set覆盖,get获取。当参数是get时不需要填四个域名字段
     * @param array $data 需要的参数的数据
     * @return array
     */
    public function modifyDomain($action, $data = [])
    {
        $data['action'] = $action;

        $url = "https://api.weixin.qq.com/wxa/modify_domain?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data, true);
    }

    /**
     * 2、设置小程序业务域名（仅供第三方代小程序调用）
     * @param string $action add添加, delete删除, set覆盖, get获取。
     *                       当参数是get时不需要填webviewdomain字段。
     *                       如果没有action字段参数，则默认见开放平台第三方登记的小程序业务域名全部添加到授权的小程序中
     * @param string $webviewdomain 小程序业务域名，当action参数是get时不需要此字段
     * @return array
     */
    public function setWebViewDomain($action, $webviewdomain = [])
    {
        $url = "https://api.weixin.qq.com/wxa/setwebviewdomain?access_token=ACCESS_TOKEN";
        $params = ['action' => $action, 'webviewdomain' => $webviewdomain];

        return $this->callPostApi($url, $params);
    }
}