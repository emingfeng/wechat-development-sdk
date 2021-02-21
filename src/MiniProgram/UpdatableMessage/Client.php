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

namespace eMingFeng\MiniProgram\UpdatableMessage;

use eMingFeng\Kernel\core\BaseClient;
use eMingFeng\Kernel\Exceptions\InvalidArgumentException;

/**
 * 动态消息
 * Class Room
 * @package eMingFeng\MiniProgram\UpdatableMessage
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/updatable-message/updatableMessage.createActivityId.html
 */

class Client extends BaseClient
{
    /**
     * 创建被分享动态消息或私密消息的 activity_id
     * @param string $unionid
     * @param string $openid
     * @return array
     */
    public function createActivityId(string $unionid = null, string $openid = null)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/message/wxopen/activityid/create?access_token=ACCESS_TOKEN";
        if (is_null($openid)) $url .= "&openid={$openid}";
        if (is_null($unionid)) $url .= "&unionid={$unionid}";
        return $this->callGetApi($url);
    }

    /**
     * 修改被分享的动态消息
     * @param string $activity_id 动态消息的 ID，通过 updatableMessage.createActivityId 接口获取
     * @param int $target_state 动态消息修改后的状态 0 未开始 1已开始
     * @param array $template_info 动态消息对应的模板信息
     * @return array
     * @throws \eMingFeng\Kernel\Exceptions\InvalidArgumentException
     */
    public function setUpdatableMsg(string $activity_id, int $target_state = 0, array $template_info = [])
    {
        if (!in_array($target_state, [0, 1], true)) {
            throw new InvalidArgumentException('"state" should be "0" or "1".');
        }

        $params = $this->formatParameters($template_info);

        $params = [
            'activity_id' => $activity_id,
            'target_state' => $target_state,
            'template_info' => ['parameter_list' => $params],
        ];
        $url = "https://api.weixin.qq.com/cgi-bin/message/wxopen/updatablemsg/send?access_token=ACCESS_TOKEN";

        return $this->callPostApi($url, $params, true);
    }

    /**
     * formatParameters
     * @return array
     * @throws \eMingFeng\Kernel\Exceptions\InvalidArgumentException
     */
    protected function formatParameters(array $params)
    {
        $formatted = [];

        foreach ($params as $name => $value) {
            if (!in_array($name, ['member_count', 'room_limit', 'path', 'version_type'], true)) {
                continue;
            }

            if ('version_type' === $name && !in_array($value, ['develop', 'trial', 'release'], true)) {
                throw new InvalidArgumentException('Invalid value of attribute "version_type".');
            }
            $formatted[] = [
                'name' => $name,
                'value' => strval($value),
            ];
        }
        return $formatted;
    }
}