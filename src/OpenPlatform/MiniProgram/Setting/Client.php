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

namespace eMingFeng\OpenPlatform\MiniProgram\Setting;

use eMingFeng\Kernel\core\BaseClient;

class Client extends BaseClient
{
    /**
     * 小程序名称设置及改名
     * @param string $nickname       昵称
     * @param string $idCardMediaId  身份证照片素材ID
     * @param string $licenseMediaId 组织机构代码证或营业执照素材ID
     * @param array  $otherStuffs    其他证明材料素材ID
     * @return array
     */
    public function setNickname(
        string $nickname,
        string $idCardMediaId = '',
        string $licenseMediaId = '',
        array $otherStuffs = []
    ) {
        $params = [
            'nick_name' => $nickname,
            'id_card' => $idCardMediaId,
            'license' => $licenseMediaId
        ];
        for ($i = \count($otherStuffs) - 1; $i >= 0; --$i) {
            $params['naming_other_stuff_'.($i + 1)] = $otherStuffs[$i];
        }
        $url = "https://api.weixin.qq.com/wxa/setnickname?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $params);
    }

    /**
     * 小程序改名审核状态查询
     * @param string $audit_id 审核单id
     * @return array
     */
    public function getNicknameAuditStatus(string $audit_id)
    {
        $url = "https://api.weixin.qq.com/wxa/api_wxa_querynickname?access_token=ACCESS_TOKEN";
        $params = ['audit_id' => $audit_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 微信认证名称检测
     * @param string $nickname 微信认证名称
     * @return array
     */
    public function checkWxVerifyNickname($nickname)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxverify/checkwxverifynickname?access_token=ACCESS_TOKEN";
        $params = ['nick_name' => $nickname];
        return $this->callPostApi($url, $params);
    }

    /**
     * 设置小程序是否可被搜索
     * @param int $status 1表示不可搜索，0表示可搜索
     * @return array
     */

    public function setSearchStatus(int $status)
    {
        $url = "https://api.weixin.qq.com/wxa/changewxasearchstatus?access_token=ACCESS_TOKEN";
        $params = ['status' => $status];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询小程序当是否可被搜索
     * @return array
     */
    public function getSearchStatus()
    {
        $url = "https://api.weixin.qq.com/wxa/getwxasearchstatus?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }


}