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

namespace eMingFeng\MiniProgram\SubscribeMessage;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 订阅消息
 * Class Room
 * @package eMingFeng\MiniProgram\SubscribeMessage
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/subscribe-message/subscribeMessage.addTemplate.html
 * @openplatform doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/Mini_Programs/subscribe_template/get_category.html
 */

class Client extends BaseClient
{
    /**
     * 获取小程序账号的类目
     * @return array
     */
    public function getCategory()
    {
        $url = "https://api.weixin.qq.com/wxaapi/newtmpl/getcategory?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 获取模板标题列表
     * @param array $ids 类目 id，多个用逗号隔开
     * @param int   $start 用于分页，表示从 start 开始。从 0 开始计数。
     * @param int   $limit 用于分页，表示拉取 limit 条记录。最大为 30。
     * @return array
     */
    public function getPubTemplateTitleList(array $ids, int $start = 0, int $limit = 30)
    {
        /**
        $ids = \implode(',', $ids);
        $query = \compact('ids', 'start', 'limit');
         */
        $url = "https://api.weixin.qq.com/wxaapi/newtmpl/getpubtemplatetitles?access_token=ACCESS_TOKEN";
        $url .= '&' . http_build_query(['ids' => $ids, 'start' => $start, 'limit' => $limit]);
        return $this->callGetApi($url);
    }

    /**
     * 获取模板标题下的关键词库
     * @param string $tid 模板标题 id，可通过接口获取
     * @return array
     */
    public function getPubTemplateKeyWordsById(string $tid)
    {
        //return $this->httpGet('wxaapi/newtmpl/getpubtemplatekeywords', compact('tid'));
        $url = "https://api.weixin.qq.com/wxaapi/newtmpl/getpubtemplatekeywords?access_token=ACCESS_TOKEN";
        $url .= '&' . http_build_query(['tid' => $tid]);
        return $this->callGetApi($url);
    }

    /**
     * 组合模板并添加至帐号下的个人模板库
     * @param string $tid 模板标题 id，可通过接口获取，也可登录小程序后台查看获取
     * @param array $kidList 开发者自行组合好的模板关键词列表，关键词顺序可以自由搭配（例如 [3,5,4] 或 [4,5,3]），最多支持5个，最少2个关键词组合
     * @param string $sceneDesc 服务场景描述，15个字以内
     * @return array
     */
    public function addTemplate(string $tid, array $kidList, string $sceneDesc = null)
    {
        $url = "https://api.weixin.qq.com/wxaapi/newtmpl/addtemplate?access_token=ACCESS_TOKEN";

        $sceneDesc = $sceneDesc ?? '';
        $data = \compact('tid', 'kidList', 'sceneDesc');

        //['tid' => $tid, 'kidList' => $kidList, 'sceneDesc' => $sceneDesc]

        return $this->callPostApi($url, $data, false);
    }

    /**
     * 获取当前帐号下的个人模板列表
     * @return array
     */
    public function getTemplateList()
    {
        $url = "https://api.weixin.qq.com/wxaapi/newtmpl/gettemplate?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 删除帐号下的个人模板
     * @param string $priTmplId 要删除的模板id
     * @return array
     */
    public function delTemplate(string $priTmplId)
    {
        $url = "https://api.weixin.qq.com/wxaapi/newtmpl/deltemplate?access_token=ACCESS_TOKEN";
        $params = ['priTmplId' => $priTmplId];
        return $this->callPostApi($url, $params, true);
    }

    /**
     * 发送订阅消息
     * @param array $data 发送的消息对象数组
     * @return array
     */
    public function send(array $data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data, true);
    }
}