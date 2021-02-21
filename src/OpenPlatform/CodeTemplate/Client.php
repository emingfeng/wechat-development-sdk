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

namespace eMingFeng\OpenPlatform\CodeTemplate;

use eMingFeng\Kernel\core\BaseClient;
use eMingFeng\OpenPlatform\Base\Client as Base;
class Client extends Base
{
    /**
     * 获取草稿箱内的所有临时代码草稿
     * @return array
     */
    public function getTemplateDraftList()
    {
        $component_access_token = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/wxa/gettemplatedraftlist?access_token={$component_access_token}";
        return $this->httpGetForJson($url);
    }

    /**
     * 将草稿箱的草稿选为小程序代码模版
     * @param int $draftId
     * @return array
     */
    public function addToTemplate($draftId)
    {
        $component_access_token = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/wxa/addtotemplate?access_token={$component_access_token}";
        return $this->httpPostForJson($url, ['draft_id' => $draftId]);
    }

    /**
     * 获取代码模版库中的所有小程序代码模版
     * @return array
     */
    public function list()
    {
        $component_access_token = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/wxa/gettemplatelist?access_token={$component_access_token}";
        return $this->httpGetForJson($url);
    }

    /**
     * 删除指定小程序代码模版
     * @param string $templateId
     * @return array
     */
    public function delete(string $templateId)
    {
        $component_access_token = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/wxa/deletetemplate?access_token={$component_access_token}";
        return $this->httpPostForJson($url, ['template_id' => $templateId]);
    }
}