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

namespace eMingFeng\OfficialAccount\Server;

use eMingFeng\Kernel\core\BasePushEvent as Receive;

/**
 * Class Server
 * @package eMingFeng\OfficialAccount\Server
 */
class Client extends Receive
{

    /**
     * 处理公众平台推送的事件
     * @return array
     */
    public function __construct($app)
    {
        parent::__construct($app->options);

    }

    /**
     * 转发多客服消息
     * @param string $account
     * @return $this
     */
    public function transferCustomerService($account = '')
    {
        $this->message = [
            'CreateTime'   => time(),
            'ToUserName'   => $this->getOpenid(),
            'FromUserName' => $this->getToOpenid(),
            'MsgType'      => 'transfer_customer_service',
        ];
        empty($account) || $this->message['TransInfo'] = ['KfAccount' => $account];
        return $this;
    }

    /**
     * 设置文本消息
     * @param string $content 文本内容
     * @return $this
     */
    public function text(string $content = '')
    {
        $this->message = [
            'MsgType'      => 'text',
            'CreateTime'   => time(),
            'Content'      => $content,
            'ToUserName'   => $this->getOpenid(),
            'FromUserName' => $this->getToOpenid(),
        ];
        return $this;
    }

    /**
     * 设置回复图文
     * @param array $articles
     * @return $this
     */
    public function news(array $articles = [])
    {
        $this->message = [
            'CreateTime'   => time(),
            'MsgType'      => 'news',
            'Articles'     => $articles,
            'ToUserName'   => $this->getOpenid(),
            'FromUserName' => $this->getToOpenid(),
            'ArticleCount' => count($articles),
        ];
        return $this;
    }

    /**
     * 设置图片消息
     * @param string $mediaId 图片媒体ID
     * @return $this
     */
    public function image(string $mediaId = '')
    {
        $this->message = [
            'MsgType'      => 'image',
            'CreateTime'   => time(),
            'ToUserName'   => $this->getOpenid(),
            'FromUserName' => $this->getToOpenid(),
            'Image'        => ['MediaId' => $mediaId],
        ];
        return $this;
    }

    /**
     * 设置语音回复消息
     * @param string $mediaId 语音媒体ID
     * @return $this
     */
    public function voice(string $mediaId = '')
    {
        $this->message = [
            'CreateTime'   => time(),
            'MsgType'      => 'voice',
            'ToUserName'   => $this->getOpenid(),
            'FromUserName' => $this->getToOpenid(),
            'Voice'        => ['MediaId' => $mediaId],
        ];
        return $this;
    }

    /**
     * 设置视频回复消息
     * @param string $mediaid 视频媒体ID
     * @param string $title 视频标题
     * @param string $description 视频描述
     * @return $this
     */
    public function video(string $mediaId = '', string $title = '', string $description = '')
    {
        $this->message = [
            'CreateTime'   => time(),
            'MsgType'      => 'video',
            'ToUserName'   => $this->getOpenid(),
            'FromUserName' => $this->getToOpenid(),
            'Video'        => [
                'Title'       => $title,
                'MediaId'     => $mediaId,
                'Description' => $description,
            ],
        ];
        return $this;
    }

    /**
     * 设置音乐回复消息
     * @param string $title 音乐标题
     * @param string $desc 音乐描述
     * @param string $musicurl 音乐地址
     * @param string $hgmusicurl 高清音乐地址
     * @param string $thumbmediaid 音乐图片缩略图的媒体id（可选）
     * @return $this
     */
    public function music(string $title, string $desc, string $musicUrl, string $hQMusicUrl = '', string $thumbMediaId = '')
    {
        $this->message = [
            'CreateTime'   => time(),
            'MsgType'      => 'music',
            'ToUserName'   => $this->getOpenid(),
            'FromUserName' => $this->getToOpenid(),
            'Music'        => [
                'Title'       => $title,
                'Description' => $desc,
                'MusicUrl'    => $musicUrl,
                'HQMusicUrl'  => $hQMusicUrl,
            ],
        ];

        if ($thumbMediaId) {
            $this->message['Music']['ThumbMediaId'] = $thumbMediaId;
        }
        return $this;
    }
}