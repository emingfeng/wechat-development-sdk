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

namespace eMingFeng\OpenPlatform\MiniProgram\Records;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 违规和申诉管理
 * Class Room
 * @package eMingFeng\OpenPlatform\MiniProgram\Records
 * @miniprogram  doc
 * @openplatform doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/Mini_Programs/records/getillegalrecords.html
 */

class Client extends BaseClient
{
    /**
     * 获取小程序违规处罚记录
     * @param int $start_time	查询时间段的开始时间，如果不填，则表示end_time之前90天内的记录
     * @param int $end_time	查询时间段的结束时间，如果不填，则表示start_time之后90天内的记录
     * @return array
     */
    public function getIllegalRecords(int $start_time = 0, int $end_time = 0)
    {
        $url = "https://api.weixin.qq.com/wxa/getillegalrecords?access_token=ACCESS_TOKEN";
        $params = ['start_time' => $start_time, 'end_time' => $end_time];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取小程序申诉记录
     * @param string $illegal_record_id 违规处罚记录id（通过getillegalrecords接口返回的记录id）
     * @return array
     */
    public function getAppealRecords(string $illegal_record_id)
    {
        $url = "https://api.weixin.qq.com/wxa/getappealrecords?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $params);
    }

}