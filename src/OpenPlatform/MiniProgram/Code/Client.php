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

namespace eMingFeng\OpenPlatform\MiniProgram\Code;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 代码管理
 * Class Room
 * @package eMingFeng\OpenPlatform\MiniProgram\Code
 * @miniprogram  doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/Mini_Programs/code/commit.html
 */

class Client extends BaseClient
{
    /**
     * 为已授权的小程序上传代码
     * @param string $template_id 代码库中的代码模版ID
     * @param string $extJson 第三方自定义的配置
     * @param string $user_version 代码版本号，开发者可自定义
     * @param string $user_desc 代码描述，开发者可自定义
     * @return array
     */
    public function commit(string $template_id, string $ext_json, string $user_version, string $user_desc)
    {
        $url = "https://api.weixin.qq.com/wxa/commit?access_token=ACCESS_TOKEN";
        $params = [
            'template_id'  => $template_id,
            'ext_json'     => $ext_json,
            'user_version' => $user_version,
            'user_desc'    => $user_desc,
        ];
        return $this->callPostApi($url, $params, true);
    }

    /**
     * 获取已上传的代码的页面列表
     * @return array
     */
    public function getPage()
    {
        $url = "https://api.weixin.qq.com/wxa/get_page?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 获取体验版二维码
     * @param null|string $path 指定二维码扫码后直接进入指定页面并可同时带上参数
     * @return array
     */
    public function getQrcode($path = null)
    {
        $pathStr = is_null($path) ? '' : ("&path=" . urlencode($path));
        $url = "https://api.weixin.qq.com/wxa/get_qrcode?access_token=ACCESS_TOKEN{$pathStr}";
        return $this->callGetApi($url);
    }





    /**
     * 提交审核
     * @param array $itemList 提交审核项的一个列表
     * @param string $feedbackInfo 反馈内容不超过200字
     * @param string $feedbackStuff 图片 media_id 列表
     * @return array
     */
    public function submitAudit(array $itemList, string $feedbackInfo = null, string $feedbackStuff = null)
    {
        $url = "https://api.weixin.qq.com/wxa/submit_audit?access_token=ACCESS_TOKEN";
        $params = ['item_list' => $itemList, 'feedback_info' => '', 'feedback_stuff' => $feedbackStuff];
        return $this->callPostApi($url, $params, true);
    }

    /**
     * 获取授权小程序帐号的可选类目
     * @return array
     */
    public function getCategory()
    {
        $url = "https://api.weixin.qq.com/wxa/get_category?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 查询指定版本的审核状态
     * @param string $auditId 提交审核时获得的审核id
     * @return array
     */
    public function getAuditstatus(string $auditId)
    {
        $url = "https://api.weixin.qq.com/wxa/get_auditstatus?access_token=ACCESS_TOKEN";
        $params = ['auditid' => $auditId];
        return $this->callPostApi($url, $params, true);
    }

    /**
     * 查询最新一次提交的审核状态
     * @return array
     */
    public function getLatestAuditStatus()
    {
        $url = "https://api.weixin.qq.com/wxa/get_latest_auditstatus?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 小程序审核撤回
     * @return array
     */
    public function undoCodeAudit()
    {
        $url = "https://api.weixin.qq.com/wxa/undocodeaudit?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 发布已通过审核的小程序
     * @return array
     */
    public function release()
    {
        $url = "https://api.weixin.qq.com/wxa/release?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, []);
    }



    /**
     * 小程序版本回退（仅供第三方代小程序调用）
     * @return array
     */
    public function rollbackRelease()
    {
        $url = "https://api.weixin.qq.com/wxa/revertcoderelease?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 小程序分阶段发布
     * @param int $gray_percentage 灰度的百分比，1到100的整数
     * @return array
     */
    public function grayRelease(int $gray_percentage)
    {
        $url = "https://api.weixin.qq.com/wxa/grayrelease?access_token=ACCESS_TOKEN";
        $params = ['gray_percentage' => $gray_percentage];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询当前分阶段发布详情
     * @return array
     */
    public function getGrayReleasePlan()
    {
        $url = "https://api.weixin.qq.com/wxa/getgrayreleaseplan?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 取消分阶段发布
     * @return array
     */
    public function revertGrayRelease()
    {
        $url = "https://api.weixin.qq.com/wxa/revertgrayrelease?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 修改小程序服务状态
     * @param string $action 设置可访问状态，发布后默认可访问，close为不可见，open为可见
     * @return array
     */
    public function changeVisitStatus(string $action)
    {
        $url = "https://api.weixin.qq.com/wxa/change_visitstatus?access_token=ACCESS_TOKEN";
        $params = ['action' => $action];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询当前设置的最低基础库版本及各版本用户占比
     * @return array
     */
    public function getSupportVersion()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxopen/getweappsupportversion?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, []);
    }

    /**
     * 设置最低基础库版本
     * @param string $version 版本
     * @return array
     */
    public function setSupportVersion(string $version)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxopen/setweappsupportversion?access_token=ACCESS_TOKEN";
        $params = ['version' => $version];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询服务商的当月提审限额（quota）和加急次数.
     * @return array
     */
    public function queryQuota()
    {
        $url = "https://api.weixin.qq.com/wxa/queryquota?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url, []);
    }

    /**
     * 加急审核申请
     * @param int $auditId 审核单ID
     * @return array
     */
    public function speedupAudit(int $auditId)
    {
        $url = "https://api.weixin.qq.com/wxa/speedupaudit?access_token=ACCESS_TOKEN";
        $params = ['auditid' => $auditId];
        return $this->callGetApi($url, $params);
    }
}