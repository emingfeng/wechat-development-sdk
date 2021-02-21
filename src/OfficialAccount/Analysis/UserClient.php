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
 * 数据分析 - 用户分析
 * Class Room
 * @package eMingFeng\OfficialAccount\Anlysis
 * @officialAccount  doc https://developers.weixin.qq.com/doc/offiaccount/Analytics/User_Analysis_Data_Interface.html
 */

class UserClient extends Base
{
    /**
     * 获取用户增减数据
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度7天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @return array
     */
    public function getUserSummary(string $begin_date, string $end_date){

        $url = "https://api.weixin.qq.com/datacube/getusersummary?access_token=ACCESS_TOKEN";
        return $this->analysis($url, $begin_date, $end_date);
    }

    /**
     * 获取用户累计数据，最大时间跨度7天
     * @param string $begin_date 获取数据的起始日期，begin_date和end_date的最大时间跨度7天
     * @param string $end_date 获取数据的结束日期，end_date允许设置的最大值为昨日
     * @return array
     */
    public function getUserCumulate(string $begin_date, string $end_date){
        $url = "https://api.weixin.qq.com/datacube/getusercumulate?access_token=ACCESS_TOKEN";
        return $this->analysis($url, $begin_date, $end_date);
    }
}