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
 * 数据分析 - 接口分析
 * Class Room
 * @package eMingFeng\OfficialAccount\Anlysis
 * @officialAccount  doc https://developers.weixin.qq.com/doc/offiaccount/Analytics/Analytics_API.html
 */

class InterfaceClient extends Base
{
    /**
     * 获取接口分析数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度30天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @return array
     */
    public function getInterfaceSummary(string $begin_date, string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getinterfacesummary?access_token=ACCESS_TOKEN";
        return $this->analysis($url, $begin_date, $end_date);
    }

    /**
     * 获取接口分析分时数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度1天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @return array
     */
    public function getInterfaceSummaryHour(string $begin_date, string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getinterfacesummaryhour?access_token=ACCESS_TOKEN";
        return $this->analysis($url, $begin_date, $end_date);
    }
}