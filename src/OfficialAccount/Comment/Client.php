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

namespace eMingFeng\OfficialAccount\Comment;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 图文消息留言管理
 * Class Room
 * @package eMingFeng\OfficialAccount\Comment
 * @officialaccount doc https://developers.weixin.qq.com/doc/offiaccount/Comments_management/Image_Comments_Management_Interface.html
 */

class Client extends BaseClient
{
    /**
     * 打开已群发文章评论（新增接口）
     * @param string $msgDataId 群发返回的msg_data_id
     * @param int|null $index 多图文时，用来指定第几篇图文，从0开始，不带默认操作该msg_data_id的第一篇图文
     */
    public function open(string $msgDataId, int $index = null)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/comment/open?access_token=ACCESS_TOKEN";
        $params = [
            'msg_data_id' => $msgDataId,
            'index' => $index,
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 关闭已群发文章评论（新增接口）
     * @param string $msgDataId 群发返回的msg_data_id
     * @param int|null $index 多图文时，用来指定第几篇图文，从0开始，不带默认操作该msg_data_id的第一篇图文
     */
    public function close(string $msgDataId, int $index = null)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/comment/close?access_token=ACCESS_TOKEN";
        $params = [
            'msg_data_id' => $msgDataId,
            'index' => $index,
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查看指定文章的评论数据（新增接口）
     * @param string $msgDataId 群发返回的msg_data_id
     * @param int $index 多图文时，用来指定第几篇图文，从0开始，不带默认返回该msg_data_id的第一篇图文
     * @param int $begin 起始位置
     * @param int $count 获取数目（>=50会被拒绝）
     * @param int $type type=0 普通评论&精选评论 type=1 普通评论 type=2 精选评论
     */
    public function list(string $msgDataId, int $index = null, int $begin, int $count, int $type = 0)
    {
        $params = [
            'msg_data_id' => $msgDataId,
            'index' => $index,
            'begin' => $begin,
            'count' => $count,
            'type' => $type,
        ];
        $url = "https://api.weixin.qq.com/cgi-bin/comment/list?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $params);
    }

    /**
     * 将评论标记精选（新增接口）
     * @param string $msgDataId 群发返回的msg_data_id
     * @param int $index 多图文时，用来指定第几篇图文，从0开始，不带默认操作该msg_data_id的第一篇图文
     * @param int $userCommentId 用户评论id
     */
    public function mark(string $msgDataId, int $index = null, int $userCommentId)
    {
        $params = [
            'msg_data_id' => $msgDataId,
            'index' => $index,
            'user_comment_id' => $userCommentId,
        ];
        $url = "https://api.weixin.qq.com/cgi-bin/comment/markelect?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $params);
    }

    /**
     * 将评论取消精选
     * @param string $msgDataId 群发返回的msg_data_id
     * @param int $index 多图文时，用来指定第几篇图文，从0开始，不带默认操作该msg_data_id的第一篇图文
     * @param int $userCommentId 用户评论id
     */
    public function unmark(string $msgDataId, int $index = null, int $userCommentId)
    {
        $params = [
            'msg_data_id' => $msgDataId,
            'index' => $index,
            'user_comment_id' => $userCommentId,
        ];
        $url = "https://api.weixin.qq.com/cgi-bin/comment/unmarkelect?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除评论（新增接口）
     * @param string $msgDataId 群发返回的msg_data_id
     * @param int $index 多图文时，用来指定第几篇图文，从0开始，不带默认操作该msg_data_id的第一篇图文
     * @param int $userCommentId 评论id
     */
    public function deleteComment(string $msgDataId, int $index = null, int $userCommentId)
    {
        $params = [
            'msg_data_id' => $msgDataId,
            'index' => $index,
            'user_comment_id' => $userCommentId,
        ];
        $url = "https://api.weixin.qq.com/cgi-bin/comment/delete?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $params);
    }

    /**
     * 回复评论（新增接口）
     * @param string $msgDataId 群发返回的msg_data_id
     * @param int $index 多图文时，用来指定第几篇图文，从0开始，不带默认操作该msg_data_id的第一篇图文
     * @param int $commentId 评论id
     * @param string $content 回复内容
     */
    public function reply(string $msgId, int $index = null, int $commentId, string $content)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/comment/reply/add?access_token=ACCESS_TOKEN";
        $params = [
            'msg_data_id' => $msgId,
            'index' => $index,
            'user_comment_id' => $commentId,
            'content' => $content,
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除回复（新增接口）
     * @param string $msgDataId  群发返回的msg_data_id
     * @param int $index 多图文时，用来指定第几篇图文，从0开始，不带默认操作该msg_data_id的第一篇图文
     * @param int $commentId 评论id
     */
    public function deleteReply(string $msgDataId, int $index = null, int $commentId)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/comment/reply/delete?access_token=ACCESS_TOKEN";
        $params = [
            'msg_data_id' => $msgDataId,
            'index' => $index,
            'user_comment_id' => $commentId,
        ];
        return $this->callPostApi($url, $params);

    }
}
