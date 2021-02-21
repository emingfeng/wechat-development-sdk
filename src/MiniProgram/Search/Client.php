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

namespace eMingFeng\MiniProgram\Search;

use eMingFeng\Kernel\core\BaseClient;
use eMingFeng\Kernel\Exceptions\InvalidArgumentException;

/**
 * 小程序搜索
 * Class Room
 * @package eMingFeng\MiniProgram\Search
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/search/search.imageSearch.html
 */

class Client extends BaseClient
{
    /**
     * 提交小程序页面url及参数信息
     * @param array $pages
     * @return array
     */
    public function submitPages(array $pages){
        $url = "https://api.weixin.qq.com/wxa/search/wxaapi_submitpages?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $pages);
    }

    /**
     * 小程序内部搜索API提供针对页面的查询能力
     * @param string|null $keyword
     * @param string|null $next_page_info
     * @return array
     */
    public function siteSearch(string $keyword , string $next_page_info = null){
        $url = "https://api.weixin.qq.com/wxa/sitesearch?access_token=ACCESS_TOKEN";
        $params = ['keyword' => $keyword, 'next_page_info' => $next_page_info];
        return $this->callPostApi($url, $params);
    }

    /**
     * 本接口提供基于小程序的站内搜商品图片搜索能力
     * @param string $file 本地图片绝对路径
     * @return array
     */
    public function imageSearch(string $file){
        $url = "https://api.weixin.qq.com/wxa/sitesearch?access_token=ACCESS_TOKEN";
        return $this->callUploadApi($url, $file, 'img');
    }

}