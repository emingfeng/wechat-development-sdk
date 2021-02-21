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

namespace eMingFeng\OpenPlatform\FastRegister;

use eMingFeng\OpenPlatform\Base\Client as Base;
use eMingFeng\Kernel\core\BaseClient;

/**
 * Class Room
 * @package eMingFeng\OpenPlatform\Register
 * @miniprogram  doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/Register_Mini_Programs/fast_registration_of_mini_program.html
 * @openplatform doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/Register_Mini_Programs/Fast_Registration_Interface_document.html
 */

class Client extends Base
{
    /**
     * 创建小程序接口
     * @param string $name			        	企业名（需与工商部门登记信息一致）
     * @param string $code			            企业代码
     * @param int    $code_type			        企业代码类型 1：统一社会信用代码（18 位） 2：组织机构代码（9 位 xxxxxxxx-x） 3：营业执照注册号(15 位)
     * @param string $legal_persona_wechat		法人微信号
     * @param string $legal_persona_name		法人姓名（绑定银行卡）
     * @param string $component_phone			第三方联系电话
     * @return array
     */
    public function fastRegisterWeapp( string $name, string $code,int $code_type, string $legal_persona_wechat, string $legal_persona_name, string $component_phone)
    {
        $component_access_token = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/component/fastregisterweapp?action=create&component_access_token={$component_access_token}";
        $data = [
            'name' => $name,
            'code_type' => $code_type,
            'legal_persona_wechat' => $legal_persona_wechat,
            'legal_persona_name' => $legal_persona_name,
            'component_phone' => $component_phone
        ];
        return $this->callPostApi($url, $data);
    }

    /**
     * 查询创建任务状态
     * @param string $companyName
     * @param string $legalPersonaWechat
     * @param string $legalPersonaName
     * @return array
     */
    public function getStatus(string $companyName, string $legalPersonaWechat, string $legalPersonaName)
    {
        $component_access_token = $this->getComponentAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/component/fastregisterweapp?action=search&component_access_token={$component_access_token}";
        $params = [
            'name' => $companyName,
            'legal_persona_wechat' => $legalPersonaWechat,
            'legal_persona_name' => $legalPersonaName,
        ];
        return $this->callPostApi($url, $params);

    }

    /**
     * 获取复用公众号资质注册小程序授权URL
     * @param string $authorizerAppid 公众号的appid
     * @param int $copyWxVerify 是否复用公众号的资质进行微信认证(1:申请复用资质进行微信 认证 0:不申请)
     * @param string $redirectUri 用户扫码授权后，MP 扫码页面将跳转到该地址(注:1.链接需 urlencode 2.Host 需和第三方平台在微信开放平台上面填写的登 录授权的发起页域名一致)
     * @return string
     */
    public function getCopyRegisterUrl(string $authorizerAppid, int $copyWxVerify, string $redirectUri)
    {
        $redirectUri = urlencode($redirectUri);
        $componentAppid = $this->config->get('component_appid');
        return "https://mp.weixin.qq.com/cgi-bin/fastregisterauth?appid={$authorizerAppid}&component_appid={$componentAppid}&amp;copy_wx_verify={$copyWxVerify}&redirect_uri={$redirectUri}";
    }

    /**
     * 复用公众号资质快速注册小程序
     * @param string $ticket
     * @return array
     */
    public function fastRegister(string $ticket){
        $url = "https://api.weixin.qq.com/cgi-bin/account/fastregister?access_token=ACCESS_TOKEN";
        $data = ['ticket' => $ticket];
        return $this->callPostApi($url, $data, true);
    }

    /**
     * 获取换绑管理员授权URL
     * @param string $authorizerAppid 公众号的 appid
     * @param string $redirectUri 新管理员信息填写完成点击提交后，将跳转到该地址
     * @return string
     */
    public function getReBindAdminUrl(string $authorizerAppid, string $redirectUri)
    {
        $redirectUri = urlencode($redirectUri);
        $componentAppid = $this->config->get('component_appid');
        return "https://mp.weixin.qq.com/wxopen/componentrebindadmin?appid={$authorizerAppid}&component_appid={$componentAppid}&redirect_uri={$redirectUri}";
    }

    /**
     * 管理员换绑
     * @param string $taskid
     * @return array
     */
    public function reBindAdmin(string $taskid){
        $url = "https://api.weixin.qq.com/cgi-bin/account/componentrebindadmin?access_token=ACCESS_TOKEN";
        $data = ['taskid' => $taskid];
        return $this->callPostApi($url, $data, true);
    }
}