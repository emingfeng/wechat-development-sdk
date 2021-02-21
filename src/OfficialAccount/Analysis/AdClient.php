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

namespace eMingFeng\OfficialAccount\Analysis;

use eMingFeng\OfficialAccount\Analysis\Base;

/**
 * 数据分析 - 广告分析
 * Class Room
 * @package eMingFeng\OfficialAccount\Anlysis
 * @officialAccount  doc https://developers.weixin.qq.com/doc/offiaccount/Analytics/Ad_Analysis.html
 */

class AdClient extends Base
{
    /**
     * 获取接口分析数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度90天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @param int $page 返回第几页数据
     * @param int $page_size 当页返回数据条数，最大90
     * @param string $ad_slot 广告位类型名称
     * @return array
     */
    public function adposStat(
        string $begin_date,
        string $end_date,
        int $page = 1,
        int $page_size = 90,
        string $ad_slot = null
    ){
        $url = "https://api.weixin.qq.com/publisher/stat?action=publisher_adpos_general&access_token=ACCESS_TOKEN";
        $ext = ['page' => $page, 'page_size' => $page_size, 'ad_slot' => $ad_slot];
        return $this->getAnalysis($url, $begin_date, $end_date, $ext);
    }

    /**
     * 获取公众号返佣商品数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度60天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @param int $page 返回第几页数据
     * @param int $page_size 当页返回数据条数，最大90
     * @return array
     */
    public function cpsStat(
        string $begin_date,
        string $end_date,
        int $page = 1,
        int $page_size = 90
    ){
        $url = "https://api.weixin.qq.com/publisher/stat?action=publisher_cps_general&access_token=ACCESS_TOKEN";
        $ext = ['page' => $page, 'page_size' => $page_size];
        return $this->getAnalysis($url, $begin_date, $end_date, $ext);
    }

    /**
     * 获取公众号结算收入数据及结算主体信息
     * @param string $begin_date 获取数据的起始日期
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @param int $page 返回第几页数据
     * @param int $page_size 当页返回数据条数，最大90
     * @return array
     */
    public function settlement(
        string $begin_date,
        string $end_date,
        int $page = 1,
        int $page_size = 90
    ){
        $url = "https://api.weixin.qq.com/publisher/stat?action=publisher_settlement&access_token=ACCESS_TOKEN";
        $ext = ['page' => $page, 'page_size' => $page_size];
        return $this->getAnalysis($url, $begin_date, $end_date, $ext);
    }
}