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
 * 对话能力 - 素材管理
 * Class Room
 * @package eMingFeng\OfficialAccount\Guide
 * @officialaccount doc https://developers.weixin.qq.com/doc/offiaccount/Shopping_Guide/buyer-account/shopping-guide.addGuideBuyerRelation.html
 */

class ModelAccount extends BaseClient
{
    /**
     * 添加小程序卡片素材
     * @param string $media_id 图片素材
     * @param int $type 操作类型，填0，表示服务号素材
     * @param string $title 小程序卡片名字
     * @param string $path 小程序路径
     * @param string $appid 必须填小程序的appid
     * @return array
     */
    public function setGuideCardMaterial(string $media_id, int $type = 0, string $title, string $path, string $appid)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/setguidecardmaterial?access_token=ACCESS_TOKEN";
        $params = ['media_id' => $media_id, 'type' => $type, 'title' => $title, 'path' => $path, 'appid' => $appid];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询小程序卡片素材
     * @return array
     */
    public function getGuideCardMaterial()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getguidecardmaterial?access_token=ACCESS_TOKEN";
        $params = ['type' => 0];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除小程序卡片素材
     * @param string $media_id 图片素材
     * @param int $type 操作类型，填0，表示服务号素材
     * @param string $title 小程序卡片名字
     * @param string $path 小程序路径
     * @param string $appid 必须填小程序的appid
     * @return array
     */
    public function delGuideCardMaterial(string $media_id, int $type = 0, string $title, string $path, string $appid)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/delguidecardmaterial?access_token=ACCESS_TOKEN";
        $params = ['media_id' => $media_id, 'type' => $type, 'title' => $title, 'path' => $path, 'appid' => $appid];
        return $this->callPostApi($url, $params);
    }

    /**
     * 添加图片素材
     * @param string $media_id 图片素材
     * @return array
     */
    public function setGuideImageMaterial(string $media_id)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/setguideimagematerial?access_token=ACCESS_TOKEN";
        $params = ['media_id' => $media_id, 'type' => 0];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询图片素材
     * @param int $start 分页查询，起始位置
     * @param int $num 分页查询，查询个数
     * @return array
     */
    public function getGuideImageMaterial(int $start = 0, int $num = 20)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getguideimagematerial?access_token=ACCESS_TOKEN";
        $params = ['start' => $start, 'num' => $num, 'type' => 0];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除图片素材
     * @param string $picurl 图片素材内容
     * @return array
     */
    public function delGuideImageMaterial(string $picurl)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/delguideimagematerial?access_token=ACCESS_TOKEN";
        $params = ['picurl' => $picurl, 'type' => 0];
        return $this->callPostApi($url, $params);
    }

    /**
     * 添加文字素材
     * @param string $word 文字素材内容
     * @return array
     */
    public function setGuideWordMaterial(string $word)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/setguidewordmaterial?access_token=ACCESS_TOKEN";
        $params = ['word' => $word, 'type' => 0];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询文字素材
     * @param int $start 分页查询，起始位置
     * @param int $num 分页查询，查询个数
     * @return array
     */
    public function getGuideWordMaterial(int $start, int $num)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getguidewordmaterial?access_token=ACCESS_TOKEN";
        $params = ['start' => $start, 'num' => $num, 'type' => 0];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除文字素材
     * @param string $word 文字素材内容
     * @return array
     */
    public function delGuideWordMaterial(string $word)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/delguidewordmaterial?access_token=ACCESS_TOKEN";
        $params = ['word' => $word, 'type' => 0];
        return $this->callPostApi($url, $params);
    }
}
