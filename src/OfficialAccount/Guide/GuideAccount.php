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
 * 对话能力 - 顾问管理
 * Class Room
 * @package eMingFeng\OfficialAccount\Guide
 * @officialaccount doc https://developers.weixin.qq.com/doc/offiaccount/Shopping_Guide/guide-account/shopping-guide.addGuideAcct.html
 */

class GuideAccount extends BaseClient
{
    /**
     * 添加顾问
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一，若同时请求，默认为guide_account）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param string $guide_headimgurl 顾问头像，头像url只能用《上传图文消息内的图片获取URL》，默认：微信头像
     * @param string $guide_nickname 顾问昵称，默认微信昵称
     * @return array
     */
    public function addGuideAcct(string $guide_account = null, string $guide_openid = null, string $guide_headimgurl = null, string $guide_nickname = null)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/addguideacct?access_token=ACCESS_TOKEN";
        $params = ["guide_account" => $guide_account, "guide_openid" => $guide_openid, "guide_headimgurl" => $guide_headimgurl, "guide_nickname" => $guide_nickname];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取顾问信息
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一，若同时请求，默认为guide_account）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @return array
     */
    public function getGuideAcct(string $guide_account = null, string $guide_openid = null)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getguideacct?access_token=ACCESS_TOKEN";
        $params = ["guide_account" => $guide_account, "guide_openid" => $guide_openid];
        return $this->callPostApi($url, $params);
    }

    /**
     * 修改顾问的昵称或头像
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一，若同时请求，默认为guide_account）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param string $guide_headimgurl 顾问头像，头像url只能用《上传图文消息内的图片获取URL》，默认：微信头像
     * @param string $guide_nickname 顾问昵称，默认微信昵称
     * @return array
     */
    public function updateGuideAcct(string $guide_account = null, string $guide_openid = null, string $guide_headimgurl = null, string $guide_nickname = null)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/updateguideacct?access_token=ACCESS_TOKEN";
        $params = ["guide_account" => $guide_account, "guide_openid" => $guide_openid, "guide_headimgurl" => $guide_headimgurl, "guide_nickname" => $guide_nickname];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除顾问
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一，若同时请求，默认为guide_account）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @return array
     */
    public function delGuideAcct(string $guide_account = null, string $guide_openid = null)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/delguideacct?access_token=ACCESS_TOKEN";
        $params = ["guide_account" => $guide_account, "guide_openid" => $guide_openid];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取服务号顾问列表
     * @param int $page 分页页数，从0开始
     * @param int $num 每页数量
     * @return array
     */
    public function getGuideAcctList(int $page = 0, int $num = 100)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getguideacctlist?access_token=ACCESS_TOKEN";
        $parmas = ['page' => $page, 'num' => $num];
        return $this->callPostApi($url, $parmas);
    }

    /**
     * 生成顾问二维码
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一，若同时请求，默认为guide_account）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param string $qrcode_info 额外参数，用于事件推送
     * @return array
     */
    public function guideCreateQrCode(string $guide_account = null, string $guide_openid = null, string $qrcode_info = null)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/guidecreateqrcode?access_token=ACCESS_TOKEN";
        $params = ["guide_account" => $guide_account, "guide_openid" => $guide_openid, "qrcode_info" => $qrcode_info];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取顾问聊天记录。 支持拉取该顾问近 30 天的聊天记录。begin_time 与 end_time 同时非0情况下，该参数才会生效，否则为默认值。
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一，若同时请求，默认为guide_account）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param string $openid 若不填，则拉取该顾问所有客户的聊天记录。若填写，则拉取顾问与某一个客户的聊天记录。
     * @param int $begin_time 消息的起始UNIX时间戳，如果不填，默认当前时间的前30天(仅支持30天范围内的查询)
     * @param int $end_time 消息的截止UNIX时间戳，如果不填，默认当前时间。
     * @param int $page 分页页数，从0开始
     * @param int $num 每页数量
     * @return array
     */
    public function getGuideBuyerChatRecord(
        string $guide_account = null,
        string $guide_openid = null,
        string $openid = null,
        int $begin_time = 0,
        int $end_time = 0,
        int $page = 0,
        int $num = 20
    ){
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getguidebuyerchatrecord?access_token=ACCESS_TOKEN";
        $params = [
            "guide_account" => $guide_account,
            "guide_openid" => $guide_openid,
            "openid" => $openid,
            "begin_time" => $begin_time,
            "end_time" => $end_time,
            "page" => $page,
            "num" => $num,
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 设置快捷回复与关注自动回复
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一，若同时请求，默认为guide_account）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param bool $is_delete 操作类型，false表示添加 true表示删除
     * @param array $guide_fast_reply_list	快捷回复列表
     * @param array $guide_auto_reply 第一条新客户关注自动回复
     * @param array $guide_auto_reply_plus 第二条新客户关注自动回复
     * @return array
     */
    public function setGuideConfig(
        string $guide_account = null,
        string $guide_openid = null,
        bool $is_delete = false,
        array $guide_fast_reply_list = [],
        array $guide_auto_reply = [],
        array $guide_auto_reply_plus = []
    ){
        $url = "https://api.weixin.qq.com/cgi-bin/guide/setguideconfig?access_token=ACCESS_TOKEN";
        $params = [
            "guide_account" => $guide_account,
            "guide_openid" => $guide_openid,
            "is_delete" => $is_delete,
            "guide_fast_reply_list" => $guide_fast_reply_list,
            "guide_auto_reply" => $guide_auto_reply,
            "guide_auto_reply_plus" => $guide_auto_reply_plus,
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取快捷回复与关注自动回复
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一，若同时请求，默认为guide_account）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @return array
     */
    public function getGuideConfig(string $guide_account = null, string $guide_openid = null)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getguideconfig?access_token=ACCESS_TOKEN";
        $params = ["guide_account" => $guide_account, "guide_openid" => $guide_openid];
        return $this->callPostApi($url, $params);
    }

    /**
     * 为服务号设置敏感词与离线自动回复
     * @param bool $is_delete 操作类型，false表示添加 true表示删除
     * @param array $black_keyword 敏感词，每次全量更新覆盖原来数据（如果不设置就不传black_keyword字段）
     * @param array $guide_auto_reply 离线自动回复（如果不设置就不传guide_auto_reply字段）
     * @return array
     */
    public function setGuideAcctConfig( bool $is_delete = false, array $black_keyword = [], array $guide_auto_reply = [])
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/setguideacctconfig?access_token=ACCESS_TOKEN";
        $params = ["is_delete" => $is_delete, "black_keyword" => $black_keyword, "guide_auto_reply" => $guide_auto_reply];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取离线自动回复与敏感词
     * @return array
     */
    public function getGuideAcctConfig()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getguideacctconfig?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, []);
    }

    /**
     * 允许微信用户复制小程序页面路径
     * @param string $wxa_appid 小程序appid，暂时只支持小程序，不支持小游戏
     * @param string $wx_username 关注该公众号的微信号
     * @return array
     */
    public function pushShowWxaPathMenu( string $wxa_appid, string $wx_username )
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/pushshowwxapathmenu?access_token=ACCESS_TOKEN";
        $params = ["wxa_appid" => $wxa_appid, "wx_username" => $wx_username];
        return $this->callPostApi($url, $params);
    }

    /**
     * 新建顾问分组
     * @param string $group_name 顾问分组名称
     * @return array
     */
    public function newGuideGroup($group_name)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/newguidegroup?access_token=ACCESS_TOKEN";
        $params = ['group_name' => $group_name];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取服务号下所有顾问分组的列表
     * @return array
     */
    public function getGuideGroupList()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getguidegrouplist?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, []);
    }

    /**
     * 获取指定顾问分组信息，以及分组内顾问信息
     * @param string $group_id 顾问群组ID
     * @param int $page 分页页数，从0开始，用于组内顾问分页获取
     * @param int $num 每页数量
     * @return array
     */
    public function getGroupInfo(string $group_id, int $page = 0 , $num = 10)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getgroupinfo?access_token=ACCESS_TOKEN";
        $params = ["group_id" => $group_id, "page" => $page, "num" => $num];
        return $this->callPostApi($url, $params);
    }

    /**
     * 分组内添加顾问
     * @param string $group_id 顾问群组ID
     * @param string $group_account 顾问微信号
     * @return array
     */
    public function addGuide2GuideGroup(string $group_id, string $group_account)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/addguide2guidegroup?access_token=ACCESS_TOKEN";
        $params = ["group_id" => $group_id, "group_account" => $group_account];
        return $this->callPostApi($url, $params);
    }

    /**
     * 分组内添加顾问
     * @param string $group_id 顾问群组ID
     * @param string $group_account 顾问微信号
     * @return array
     */
    public function delGuide2GuideGroup(string $group_id, string $group_account)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/delguide2guidegroup?access_token=ACCESS_TOKEN";
        $params = ["group_id" => $group_id, "group_account" => $group_account];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取顾问所在分组
     * @param string $group_account 顾问微信号
     * @return array
     */
    public function getGroupByGuide(string $group_account)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getgroupbyguide?access_token=ACCESS_TOKEN";
        $params = ["group_account" => $group_account];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除指定顾问分组
     * @param string $group_id 顾问群组ID
     * @return array
     */
    public function delGuideGroup(string $group_id)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/delguidegroup?access_token=ACCESS_TOKEN";
        $params = ["group_id" => $group_id];
        return $this->callPostApi($url, $params);
    }
}
