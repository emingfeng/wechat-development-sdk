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

namespace eMingFeng\MiniProgram\Analysis;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 数据分析
 * Class Room
 * @package eMingFeng\MiniProgram\Analysis
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/data-analysis/visit-retain/analysis.getDailyRetain.html
 * @openplatform doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/Mini_Programs/data_analysis/analysis.getDailySummary.html
 */

class Client extends BaseClient
{
    /**
     * 获取用户访问小程序日留存
     * @param string $begin_date
     * @param string $end_date 结束日期，限定查询1天数据，允许设置的最大值为昨日
     * @return array
     */
    public function getDailyRetain(string $begin_date ,string $end_date)
    {
        $url = "https://api.weixin.qq.com/datacube/getweanalysisappiddailyretaininfo?access_token=ACCESS_TOKEN";
        $params = ['begin_date' => $begin_date, 'end_date' => $end_date];
        return $this->callPostApi($url, $params, true);
    }

    /**
     * 获取用户访问小程序月留存
     * @param string $begin_date 开始日期，为自然月第一天
     * @param string $end_date 结束日期，为自然月最后一天，限定查询一个月数据
     * @return array
     */
    public function getMonthlyRetain(string $begin_date ,string $end_date)
    {
        $url = "https://api.weixin.qq.com/datacube/getweanalysisappidmonthlyretaininfo?access_token=ACCESS_TOKEN";
        $params = ['begin_date' => $begin_date, 'end_date' => $end_date];
        return $this->callPostApi($url, $params, true);
    }

    /**
     * 获取用户访问小程序周留存
     * @param string $begin_date 开始日期，为周一日期
     * @param string $end_date 结束日期，为周日日期，限定查询一周数据
     * @return array
     */
    public function getWeeklyRetain(string $begin_date ,string $end_date)
    {
        $url = "https://api.weixin.qq.com/datacube/getweanalysisappidweeklyretaininfo?access_token=ACCESS_TOKEN";
        $params = ['begin_date' => $begin_date, 'end_date' => $end_date];
        return $this->callPostApi($url, $params, true);
    }

    /**
     * 获取用户访问小程序数据概况
     * @param string $begin_date
     * @param string $end_date 结束日期，限定查询1天数据，允许设置的最大值为昨日
     * @return array
     */
    public function getDailySummary(string $begin_date ,string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getweanalysisappiddailysummarytrend?access_token=ACCESS_TOKEN";
        $params = ['begin_date' => $begin_date, 'end_date' => $end_date];
        return $this->callPostApi($url, $params, true);

    }

    /**
     * 获取用户访问小程序数据日趋势
     * @param string $begin_date
     * @param string $end_date 结束日期，限定查询1天数据，允许设置的最大值为昨日
     * @return array
     */
    public function getDailyVisitTrend(string $begin_date ,string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getweanalysisappiddailyvisittrend?access_token=ACCESS_TOKEN";
        $params = ['begin_date' => $begin_date, 'end_date' => $end_date];
        return $this->callPostApi($url, $params, true);

    }

    /**
     * 获取用户访问小程序数据月趋势
     * @param string $begin_date 开始日期，为自然月第一天
     * @param string $end_date 结束日期，为自然月最后一天，限定查询一个月的数据
     * @return array
     */
    public function getMonthlyVisitTrend(string $begin_date ,string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getweanalysisappidmonthlyvisittrend?access_token=ACCESS_TOKEN";
        $params = ['begin_date' => $begin_date, 'end_date' => $end_date];
        return $this->callPostApi($url, $params, true);

    }

    /**
     * 获取用户访问小程序数据周趋势
     * @param string $begin_date 开始日期，为周一日期
     * @param string $end_date 结束日期，为周日日期，限定查询一周数据
     * @return array
     */
    public function getWeeklyVisitTrend(string $begin_date ,string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getweanalysisappidweeklyvisittrend?access_token=ACCESS_TOKEN";
        $params = ['begin_date' => $begin_date, 'end_date' => $end_date];
        return $this->callPostApi($url, $params, true);

    }

    /**
     * 获取小程序用户画像数据
     * @param string $begin_date
     * @param string $end_date 结束日期，开始日期与结束日期相差的天数限定为0/6/29，分别表示查询最近1/7/30天数据，允许设置的最大值为昨日
     * @return array
     */
    public function getUserPortrait(string $begin_date ,string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getweanalysisappiduserportrait?access_token=ACCESS_TOKEN";
        $params = ['begin_date' => $begin_date, 'end_date' => $end_date];
        return $this->callPostApi($url, $params, true);

    }

    /**
     * 获取小程序访问分布数据
     * @param string $begin_date
     * @param string $end_date 结束日期，限定查询 1 天数据，允许设置的最大值为昨日
     * @return array
     */
    public function getVisitDistribution(string $begin_date ,string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getweanalysisappidvisitdistribution?access_token=ACCESS_TOKEN";
        $params = ['begin_date' => $begin_date, 'end_date' => $end_date];
        return $this->callPostApi($url, $params, true);

    }

    /**
     * 访问页面
     * @param string $begin_date
     * @param string $end_date 结束日期，限定查询7天内数据，允许设置的最大值为昨日
     * @return array
     */
    public function getVisitPage(string $begin_date ,string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getweanalysisappidvisitpage?access_token=ACCESS_TOKEN";
        $params = ['begin_date' => $begin_date, 'end_date' => $end_date];
        return $this->callPostApi($url, $params, true);

    }

    /**
     * 获取小程序启动性能，运行性能等数据
     * @param string $end_timestamp 结束日期时间戳
     * @param string $begin_timestamp 开始日期时间戳
     * @param string $module 参照官方文档
     * @param string $params 参照官方文档
     */
    public function getPerformanceData(
        string $begin_timestamp,
        string $end_timestamp,
        string $module,
        string $params
    ){

        $url = "https://api.weixin.qq.com/datacube/getweanalysisappidvisitpage?access_token=ACCESS_TOKEN";
        $data = [
            'time' => [
                'end_timestamp' => $end_timestamp,
                'begin_timestamp' => $begin_timestamp
            ],
            'module' => $module,
            'params' => $params
        ];
        return $this->callPostApi($url, $data);
    }
}