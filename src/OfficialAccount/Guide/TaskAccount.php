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
 * 对话能力 - 群发任务管理
 * Class Room
 * @package eMingFeng\OfficialAccount\Guide
 * @officialaccount doc https://developers.weixin.qq.com/doc/offiaccount/Shopping_Guide/buyer-account/shopping-guide.addGuideBuyerRelation.html
 */

class TaskAccount extends BaseClient
{
    /**
     * 添加群发任务
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param string $task_name 群发任务名称,不超过16字
     * @param string $task_remark 群发任务备注,不超过100字
     * @param int $push_time 任务下发给顾问的时间, 秒级时间戳, 范围为当前时间开始到最近一个月内
     * @param array $openid 客户openid列表
     * @param array $material 不超过3个素材
     * @return array
     */
    public function addGuideMassendJob(
        string $guide_account = null,
        string $guide_openid = null,
        string $task_name,
        string $task_remark = null,
        int $push_time,
        array $openid,
        array $material
    ){
        $url = "https://api.weixin.qq.com/cgi-bin/guide/addguidemassendjob?access_token=ACCESS_TOKEN";
        $params = [
            'guide_account' => $guide_account, 
            'guide_openid' => $guide_openid, 
            'task_name' => $task_name, 
            'task_remark' => $task_remark, 
            'push_time' => $push_time,
            'openid' => $openid,
            'material' => $material
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取群发任务列表
     * @param string $guide_account 顾问微信号（guide_account和guide_openid二选一）
     * @param string $guide_openid 顾问openid或者unionid（guide_account和guide_openid二选一）
     * @param array $task_status 获取指定状态的任务（为空则表示拉取所有状态的任务）
     * @param int $offset 偏移位置
     * @param int $limit 条数
     * @return array
     */
    public function getGuideMassendJobList(string $guide_account, string $guide_openid, array $task_status = [], int $offset = 0, int $limit = 50)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getguidemassendjoblist?access_token=ACCESS_TOKEN";
        $params = [
            'guide_account' => $guide_account,
            'guide_openid' => $guide_openid,
            'task_status' => $task_status,
            'offset' => $offset,
            'limit' => $limit
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取指定群发任务信息
     * @param string $task_id 任务id
     * @return array
     */
    public function getGuideMassendJob(string $task_id)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/getguidemassendjob?access_token=ACCESS_TOKEN";
        $params = ['task_id' => $task_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 修改群发任务
     * @param string $task_id 任务id
     * @param string $task_name 群发任务名称,不超过16字
     * @param string $task_remark 群发任务备注,不超过100字
     * @param int $push_time 下发时间, 秒级时间戳, 范围为当前时间开始到最近一个月内
     * @param array $openid 客户openid列表
     * @param array $material 不超过3个素材
     * @return array
     */
    public function updateGuideMassendJob(
        string $task_id,
        string $task_name,
        string $task_remark = null,
        int $push_time,
        array $openid,
        array $material
    ){
        $url = "https://api.weixin.qq.com/cgi-bin/guide/updateguidemassendjob?access_token=ACCESS_TOKEN";
        $params = [
            'task_id' => $task_id,
            'task_name' => $task_name,
            'task_remark' => $task_remark,
            'push_time' => $push_time,
            'openid' => $openid,
            'material' => $material
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 取消群发任务
     * @param string $task_id 任务id
     * @return array
     */
    public function cancelGuideMassendJob(string $task_id)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/guide/cancelguidemassendjob?access_token=ACCESS_TOKEN";
        $params = ['task_id' => $task_id];
        return $this->callPostApi($url, $params);
    }
}
