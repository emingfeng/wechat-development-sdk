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

namespace eMingFeng\MiniProgram\UniformMessage;

use eMingFeng\Kernel\core\BaseClient;
use eMingFeng\Kernel\Exceptions\InvalidArgumentException;

/**
 * 统一服务消息
 * Class Room
 * @package eMingFeng\MiniProgram\UniformMessage
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/uniform-message/uniformMessage.send.html
 */

class Client extends BaseClient
{

    /**
     * {@inheritdoc}.
     *
     * @var array
     */
    protected $message = [
        'touser' => '',
    ];
    /**
     * Weapp Attributes.
     *
     * @var array
     */
    protected $weappMessage = [
        'template_id' => '',
        'page' => '',
        'form_id' => '',
        'data' => [],
        'emphasis_keyword' => '',
    ];

    /**
     * Official account attributes.
     *
     * @var array
     */
    protected $mpMessage = [
        'appid' => '',
        'template_id' => '',
        'url' => '',
        'miniprogram' => [],
        'data' => [],
    ];

    /**
     * Required attributes.
     *
     * @var array
     */
    protected $required = ['touser', 'template_id', 'form_id', 'miniprogram', 'appid'];

    /**
     * 下发小程序和公众号统一服务消息

     * @param array $message
     * @return array
     */
    public function send(array $message)
    {

        $url = "https://api.weixin.qq.com/cgi-bin/message/wxopen/template/uniform_send?access_token=ACCESS_TOKEN";

        $params = $this->formatMessage($message);



        return $this->callPostApi($url, $params, true);
    }

    protected function formatMessage(array $data = [])
    {
        $params = array_merge($this->message, $data);

        if (empty($params['touser'])) {
            throw new InvalidArgumentException(sprintf('Attribute "touser" can not be empty!'));
        }

        if (!empty($params['weapp_template_msg'])) {
            $params['weapp_template_msg'] = $this->formatWeappMessage($params['weapp_template_msg']);
        }

        if (!empty($params['mp_template_msg'])) {
            $params['mp_template_msg'] = $this->formatMpMessage($params['mp_template_msg']);
        }

        return $params;
    }

    /**
     * @return array
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     */
    protected function formatWeappMessage(array $data = [])
    {
        $params = $this->baseFormat($data, $this->weappMessage);

        $params['data'] = $this->formatData($params['data'] ?? []);

        return $params;
    }

    /**
     * @return array
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     */
    protected function formatMpMessage(array $data = [])
    {
        $params = $this->baseFormat($data, $this->mpMessage);

        if (empty($params['miniprogram']['appid'])) {
            $params['miniprogram']['appid'] = $this->app['config']['app_id'];
        }

        $params['data'] = $this->formatData($params['data'] ?? []);

        return $params;
    }

    /**
     * @param array $data
     * @param array $default
     * @return array
     */
    protected function baseFormat($data = [], $default = [])
    {
        $params = array_merge($default, $data);
        foreach ($params as $key => $value) {
            if (in_array($key, $this->required, true) && empty($value) && empty($default[$key])) {
                throw new InvalidArgumentException(sprintf('Attribute "%s" can not be empty!', $key));
            }

            $params[$key] = empty($value) ? $default[$key] : $value;
        }

        return $params;
    }

    /**
     * @return array
     */
    protected function formatData(array $data)
    {
        $formatted = [];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if (\array_key_exists('value', $value)) {
                    $formatted[$key] = $value;

                    continue;
                }

                if (count($value) >= 2) {
                    $value = [
                        'value' => $value[0],
                        'color' => $value[1],
                    ];
                }
            } else {
                $value = [
                    'value' => strval($value),
                ];
            }

            $formatted[$key] = $value;
        }

        return $formatted;
    }
}