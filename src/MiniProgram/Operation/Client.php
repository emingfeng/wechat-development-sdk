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

namespace eMingFeng\MiniProgram\Operation;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 运维中心
 * Class Room
 * @package eMingFeng\MiniProgram\Operation
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/operation/operation.getFeedback.html
 */

class Client extends BaseClient
{
    /**
     * 获取用户反馈列表
     * @param int $type 反馈的类型，默认拉取全部类型 1-8
     * @param int $page 页数
     * @param int $num 每页数量
     * @return array
     */
    public function getFeedback(
        int $type = 0,
        int $page = 1,
        int $num = 20
    ){
        $url = "https://api.weixin.qq.com/wxaapi/feedback/list?access_token=ACCESS_TOKEN&type={$type}&page={$page}&num={$num}";
        return $this->callGetApi($url);
    }

    /**
     * 获取 mediaId 图片
     * @param int $record_id
     * @param string $media_id
     * @return array
     */
    public function getFeedbackmedia(
        int $record_id,
        string $media_id
    ){
        $url = "https://api.weixin.qq.com/cgi-bin/media/getfeedbackmedia?access_token=ACCESS_TOKEN&record_id={$record_id}&media_id={$media_id}";
        return $this->callGetApi($url);
    }

    /**
     * 错误查询详情
     * @param $data
     * @return array
     */
    public function getJsErrDetail($data)
    {
        $url = "https://api.weixin.qq.com/wxaapi/log/jserr_detail?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 错误查询列表
     * @param $data
     * @return array
     */
    public function getJsErrList($data)
    {
        $url = "https://api.weixin.qq.com/wxaapi/log/jserr_list?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 错误查询, 接口即将废弃，请采用新接口 getJsErrList
     * @param string $errmsg_keyword 错误关键字
     * @param int $type 查询类型，1 为客户端， 2为服务直达
     * @param string $client_versio 客户端版本，可以通过 getVersionList 接口拉取, 不传或者传空代表所有版本
     * @param int $start_time 开始时间
     * @param int $end_time 结束时间
     * @param int $start 分页起始值
     * @param int $limit 一次拉取最大值
     * @return array
     */
    public function getJsErrSearch(
        string $errmsg_keyword = null,
        int $type = 1,
        string $client_version = null,
        int $start_time = 0,
        int $end_time = 0,
        int $start = 1,
        int $limit = 20
    ){
        $params = [
            'errmsg_keyword' => $errmsg_keyword ,
            'type' => $type,
            'client_version' => $client_version,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'start' => $start,
            'limit' => $limit
        ];
        $url = "https://api.weixin.qq.com/wxaapi/log/jserr_search?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $params);
    }

    /**
     * 性能监控
     * @param int $cost_time_type 可选值 1（启动总耗时）， 2（下载耗时），3（初次渲染耗时）
     * @param int $default_start_time 查询开始时间
     * @param int $default_end_time 查询结束时间
     * @param string $device 系统平台，可选值 "@_all:"（全部），1（IOS）， 2（android）
     * @param string $is_download_code 是否下载代码包，当 type 为 1 的时候才生效，可选值 "@_all:"（全部），1（是）， 2（否）
     * @param string $scene 访问来源，当 type 为 1 或者 2 的时候才生效，通过 getSceneList 接口获取
     * @param string $networktype 网络环境, 当 type 为 2 的时候才生效，可选值 "@_all:"，wifi, 4g, 3g, 2g
     * @return array
     */
    public function getPerformance(
        int $cost_time_type = 1,
        int $default_start_time = 0,
        int $default_end_time = 0,
        string $device = '@_all',
        string $is_download_code = '@_all',
        string $scene = '@_all',
        string $networktype = '@_all'
    ){
        $url = "https://api.weixin.qq.com/wxaapi/log/get_performance?access_token=ACCESS_TOKEN";
        $params = [
            'cost_time_type' =>$cost_time_type,
            'default_start_time' => $default_start_time,
            'default_end_time' => $default_end_time,
            'device' => $device,
            'is_download_code' => $is_download_code,
            'scene' => $scene,
            'networktype' => $networktype
        ];

        return $this->callPostApi($url, $params);
    }

    /**
     * 获取访问来源
     * @return array
     */
    public function getSceneList(){
        $url = "https://api.weixin.qq.com/wxaapi/log/get_scene?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 获取客户端版本
     * @return array
     */
    public function getVersionList(){
        $url = "https://api.weixin.qq.com/wxaapi/log/get_client_version?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 实时日志查询
     * @param string $date YYYYMMDD格式的日期，仅支持最近7天
     * @param int $begintime 开始时间，必须是date指定日期的时间
     * @param int $endtime 结束时间，必须是date指定日期的时间
     * @param int $start 开始返回的数据下标，用作分页，默认为0
     * @param int $limit 返回的数据条数，用作分页，默认为20
     * @param string $traceId 小程序启动的唯一ID，按TraceId查询会展示该次小程序启动过程的所有页面的日志。
     * @param string $pageurl 小程序页面路径，例如pages/index/index
     * @param string $id 用户微信号或者OpenId
     * @param string $filterMsg	开发者通过setFileterMsg/addFilterMsg指定的filterMsg字段
     * @param int $level 日志等级，返回大于等于level等级的日志，level的定义为2（Info）、4（Warn）、8（Error），如果指定为4，则返回大于等于4的日志，即返回Warn和Error日志。
     * @return array
     */
    public function realtimelogSearch($data){

        $url = "https://api.weixin.qq.com/wxaapi/userlog/userlog_search?access_token=ACCESS_TOKEN";
        $data = http_build_query($data);
        $url .= "&{$data}";
        return $this->callGetApi($url);
    }
}