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

namespace eMingFeng\OfficialAccount\Guide;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 对话能力 - 客户管理
 * Class Room
 * @package eMingFeng\OfficialAccount\Guide
 * @officialaccount doc https://developers.weixin.qq.com/doc/offiaccount/Shopping_Guide/buyer-account/shopping-guide.addGuideBuyerRelation.html
 */

class BuyerAccount extends BaseClient
{
    /**
     * 为顾问分配客户
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param string $openid 客户openid（openid和buyer_list二选一）
     * @param string $buyer_nickname 客户openid对应的昵称
     * @param array $buyer_list 客户列表（不超过200，openid和buyer_list二选一）
     * @return array
     */
    public function addGuideBuyerRelation(string $guide_account = null, string $guide_openid = null, string $openid = null, string $buyer_nickname = null, array $buyer_list = [])
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/addguidebuyerrelation?access_token=ACCESS_TOKEN";
        $params = ['guide_account' => $guide_account, 'guide_openid' => $guide_openid, 'openid' => $openid, 'buyer_nickname' => $buyer_nickname, 'buyer_list' => $buyer_list];
        return $this->callPostApi($url, $params);
    }

    /**
     * 为顾问移除客户
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param string $openid 客户openid
     * @param array $openid_list 客户列表，不超过200（openid和openid_list二选一）
     * @return array
     */
    public function delGuideBuyerRelation(string $guide_account = null, string $guide_openid = null, string $openid = null, array $openid_list = [])
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/delguidebuyerrelation?access_token=ACCESS_TOKEN";
        $params = ['guide_account' => $guide_account, 'guide_openid' => $guide_openid, 'openid' => $openid, 'openid_list' => $openid_list];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取顾问的客户列表
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param int $page 分页页数，从0开始
     * @param int $num 每页数量
     * @return array
     */
    public function getGuideBuyerRelationList(string $guide_account = null, string $guide_openid = null, int $page = 0, int $num = 20)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getguidebuyerrelationlist?access_token=ACCESS_TOKEN";
        $params = ['guide_account' => $guide_account, 'guide_openid' => $guide_openid, 'page' => $page, 'num' => $num];
        return $this->callPostApi($url, $params);
    }

    /**
     * 为客户更换顾问
     * @param string $old_guide_account 原顾问微信号（old_guide_account和new_guide_account配套使用）
     * @param string $old_guide_openid 原顾问openid或者unionid（old_guide_openid和new_guide_openid配套使用）
     * @param string $new_guide_account 新顾问微信号（new_guide_account和new_guide_openid二选一）
     * @param string $new_guide_openid 新顾问openid或者unionid（new_guide_account和new_guide_openid二选一）
     * @param string $openid 客户openid
     * @param array $openid_list 客户列表，不超过200（openid和openid_list二选一）
     * @return array
     */
    public function rebindGuideAcctForBuyer(
        string $old_guide_account = null,
        string $old_guide_openid = null,
        string $new_guide_account = null,
        string $new_guide_openid = null,
        string $openid = null,
        array $openid_list = []
    ){
        $url = "https://api.weixin.qq.com/cgi-bin/guide/rebindguideacctforbuyer?access_token=ACCESS_TOKEN";
        $params = [
            'old_guide_account' => $old_guide_account,
            'old_guide_openid' => $old_guide_openid,
            'new_guide_account' => $new_guide_account,
            'new_guide_openid' => $new_guide_openid,
            'openid' => $openid,
            'openid_list' => $openid_list
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 修改客户昵称
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param string $openid 客户openid
     * @param string $buyer_nickname
     * @return array
     */
    public function updateGuideBuyerRelation(string $guide_account = null, string $guide_openid = null, string $openid = null, string $buyer_nickname = null)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/updateguidebuyerrelation?access_token=ACCESS_TOKEN";
        $params = ['guide_account' => $guide_account, 'guide_openid' => $guide_openid, 'openid' => $openid, 'buyer_nickname' => $buyer_nickname];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询客户所属顾问
     * @param string $openid 客户openid
     * @return array
     */
    public function getGuideBuyerRelationByBuyer(string $openid)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getguidebuyerrelationbybuyer?access_token=ACCESS_TOKEN";
        $params = ['openid' => $openid];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询指定顾问和客户的关系
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param string $openid 客户openid
     * @return array
     */
    public function getGuideBuyerRelation(string $guide_account = null, string $guide_openid = null, string $openid = null)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getguidebuyerrelation?access_token=ACCESS_TOKEN";
        $params = ['guide_account' => $guide_account, 'guide_openid' => $guide_openid, 'openid' => $openid];
        return $this->callPostApi($url, $params);
    }
}
