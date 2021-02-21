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
 * 数据分析 - 消息分析
 * Class Room
 * @package eMingFeng\OfficialAccount\Anlysis
 * @officialAccount  doc https://developers.weixin.qq.com/doc/offiaccount/Analytics/Message_analysis_data_interface.html
 */

class MsgClient extends Base
{

    /**
     * 获取消息发送概况数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度7天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @return array
     */
    public function getUpStreamMsg(string $begin_date, string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getupstreammsg?access_token=ACCESS_TOKEN";
        return $this->analysis($url, $begin_date, $end_date);
    }

    /**
     * 获取消息分送分时数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度1天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @return array
     */
    public function getUpStreamMsgHour(string $begin_date, string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getupstreammsghour?access_token=ACCESS_TOKEN";
        return $this->analysis($url, $begin_date, $end_date);
    }

    /**
     * 获取消息发送周数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度30天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @return array
     */
    public function getUpStreamMsgWeek(string $begin_date, string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getupstreammsgweek?access_token=ACCESS_TOKEN";
        return $this->analysis($url, $begin_date, $end_date);
    }

    /**
     * 获取消息发送月数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度30天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @return array
     */
    public function getUpStreamMsgMonth(string $begin_date, string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getupstreammsgmonth?access_token=ACCESS_TOKEN";
        return $this->analysis($url, $begin_date, $end_date);
    }

    /**
     * 获取消息发送分布数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度15天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @return array
     */
    public function getUpStreamMsgDist(string $begin_date, string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getupstreammsgdist?access_token=ACCESS_TOKEN";
        return $this->analysis($url, $begin_date, $end_date);
    }

    /**
     * 获取消息发送分布周数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度30天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @return array
     */
    public function getUpStreamMsgDistWeek(string $begin_date, string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getupstreammsgdistweek?access_token=ACCESS_TOKEN";
        return $this->analysis($url, $begin_date, $end_date);
    }

    /**
     * 获取消息发送分布月数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度30天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @return array
     */
    public function getUpStreamMsgDistMonth(string $begin_date, string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getupstreammsgdistmonth?access_token=ACCESS_TOKEN";
        return $this->analysis($url, $begin_date, $end_date);
    }
}