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
 * 对话能力 - 标签管理
 * Class Room
 * @package eMingFeng\OfficialAccount\Guide
 * @officialaccount doc https://developers.weixin.qq.com/doc/offiaccount/Shopping_Guide/tag-account/shopping-guide.newGuideTagOption.html
 */

class TagAccount extends BaseClient
{
    /**
     * 新建可查询的标签类型，最多 4 类标签类型，50 个可选值，所有的标签可选值不能有相等重复的值。
     * @param string $tag_name 标签类型的名字，不能为空
     * @param array $tag_values 标签可选值列表，可选值不能为空值，所有的标签可选值不能有相等重复的值
     * @return array
     */
    public function newGuideTagOption(string $tag_name, array $tag_values)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/newguidetagoption?access_token=ACCESS_TOKEN";
        $params = ['tag_name' => $tag_name, 'tag_values' => $tag_name];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除指定标签类型
     * @param string $tag_name 标签类型的名字
     * @return array
     */
    public function delGuideTagOption(string $tag_name)
    {
        $url = " https://api.weixin.qq.com/cgi-bin/guide/delguidetagoption?access_token=ACCESS_TOKEN";
        $params = ['tag_name' => $tag_name];
        return $this->callPostApi($url, $params);
    }

    /**
     * 为标签添加可选值
     * @param string $tag_name 标签类型的名字，不能为空
     * @param array $tag_values 标签可选值列表，可选值不能为空值，所有的标签可选值不能有相等重复的值
     * @return array
     */
    public function addGuideTagOption(string $tag_name, array $tag_values)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/addguidetagoption?access_token=ACCESS_TOKEN";
        $params = ['tag_name' => $tag_name, 'tag_values' => $tag_name];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取标签和可选值
     * @return array
     */
    public function getGuideTagOption()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getguidetagoption?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, []);
    }

    /**
     * 为客户设置标签
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param string $openid 客户openid
     * @param string $tag_value 标签的可选值，该值必须在标签的可选值集合中
     * @param array $openid_list 客户列表，不超过200，openid和openid_list二选一
     * @return array
     */
    public function addGuideBuyerTag(string $guide_account = null, string $guide_openid = null, string $openid = null, string $tag_value = null, array $openid_list = [])
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/addguidebuyertag?access_token=ACCESS_TOKEN";
        $params = ['guide_account' => $guide_account, 'guide_openid' => $guide_openid, 'openid' => $openid, 'tag_value' => $tag_value, 'openid_list' => $openid_list];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询客户标签
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param string $openid 客户openid
     * @return array
     */
    public function getGuideBuyerTag(string $guide_account = null, string $guide_openid = null, string $openid = null)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getguidebuyertag?access_token=ACCESS_TOKEN";
        $params = ['guide_account' => $guide_account, 'guide_openid' => $guide_openid, 'openid' => $openid];
        return $this->callPostApi($url, $params);
    }


    /**
     * 根据标签值筛选客户
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param int $push_count 本月还可主动发消息次数
     * @param array $tag_values 标签值，该值必须在标签可选值集合中
     * @return array
     */
    public function queryGuideBuyerByTag(string $guide_account = null, string $guide_openid = null, int $push_count = 0, array $tag_values = [])
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/queryguidebuyerbytag?access_token=ACCESS_TOKEN";
        $params = ['guide_account' => $guide_account, 'guide_openid' => $guide_openid, 'push_count' => $push_count, 'tag_values' => $tag_values];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除客户标签
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param string $openid 客户openid
     * @param string $tag_value 标签的可选值，该值必须在标签的可选值集合中
     * @param array $openid_list 客户列表，不超过200，openid和openid_list二选一
     * @return array
     */
    public function delGuideBuyerTag(string $guide_account = null, string $guide_openid = null, string $openid = null, string $tag_value = null, array $openid_list = [])
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/delguidebuyertag?access_token=ACCESS_TOKEN";
        $params = ['guide_account' => $guide_account, 'guide_openid' => $guide_openid, 'openid' => $openid, 'tag_value' => $tag_value, 'openid_list' => $openid_list];
        return $this->callPostApi($url, $params);
    }

    /**
     * 设置自定义客户信息
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param string $openid 客户openid
     * @param array $display_tag_list 自定义客户信息，全量更新，调用时传所有信息
     * @return array
     */
    public function addGuideBuyerDisplayTag(string $guide_account = null, string $guide_openid = null, string $openid = null, array $display_tag_list = [])
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/addguidebuyerdisplaytag?access_token=ACCESS_TOKEN";
        $params = ['guide_account' => $guide_account, 'guide_openid' => $guide_openid, 'openid' => $openid, 'display_tag_list' => $display_tag_list];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取自定义客户信息
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param string $openid 客户openid
     * @return array
     */
    public function getGuideBuyerDisplayTag(string $guide_account = null, string $guide_openid = null, string $openid = null)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getguidebuyerdisplaytag?access_token=ACCESS_TOKE";
        $params = ['guide_account' => $guide_account, 'guide_openid' => $guide_openid, 'openid' => $openid];
        return $this->callPostApi($url, $params);
    }
}
