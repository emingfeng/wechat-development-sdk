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
 * 数据分析 - 图文分析
 * Class Room
 * @package eMingFeng\OfficialAccount\Anlysis
 * @officialAccount  doc https://developers.weixin.qq.com/doc/offiaccount/Analytics/Graphic_Analysis_Data_Interface.html
 */

class GraphicClient extends Base
{
    /**
     * 获取图文群发每日数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度1天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @return array
     */
    public function getArticleSummary(string $begin_date, string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getarticlesummary?access_token=ACCESS_TOKEN";
        return $this->analysis($url, $begin_date, $end_date);
    }

    /**
     * 获取图文群发总数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度1天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @return array
     */
    public function getArticleTotal(string $begin_date, string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getarticletotal?access_token=ACCESS_TOKEN";
        return $this->analysis($url, $begin_date, $end_date);
    }

    /**
     * 获取图文统计数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度3天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @return array
     */
    public function getUserRead(string $begin_date, string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getuserread?access_token=ACCESS_TOKEN";
        return $this->analysis($url, $begin_date, $end_date);
    }

    /**
     * 获取图文统计分时数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度1天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @return array
     */
    public function getUserReadHour(string $begin_date, string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getuserreadhour?access_token=ACCESS_TOKEN";
        return $this->analysis($url, $begin_date, $end_date);
    }

    /**
     * 获取图文分享转发数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度7天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @return array
     */
    public function getUserShare(string $begin_date, string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getusershare?access_token=ACCESS_TOKEN";
        return $this->analysis($url, $begin_date, $end_date);
    }

    /**
     * 获取图文分享转发分时数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度1天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @return array
     */
    public function getUserShareHour(string $begin_date, string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getusersharehour?access_token=ACCESS_TOKEN";
        return $this->analysis($url, $begin_date, $end_date);
    }
}