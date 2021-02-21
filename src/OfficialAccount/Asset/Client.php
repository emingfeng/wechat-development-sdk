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

namespace eMingFeng\OfficialAccount\Asset;

use eMingFeng\Kernel\core\BaseClient;
use eMingFeng\Kernel\Exceptions\InvalidResponseException;
use eMingFeng\Kernel\Contracts\Tools;

/**
 * 素材管理
 * Class Room
 * @package eMingFeng\OfficialAccount\Asset
 * @officialaccount doc https://developers.weixin.qq.com/doc/offiaccount/Asset_Management/New_temporary_materials.html
 */

class Client extends BaseClient
{
    /**
     * 新增临时素材
     * @param array $file
     * @param string $type
     * @return array
     * @throws InvalidResponseException
     */
    public function upload( $file ,$type = 'images'){
        if (!in_array($type, ['image', 'voice', 'video', 'thumb'])) {
            throw new InvalidResponseException('Invalid Media Type.', '0');
        }
        $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=ACCESS_TOKEN&type={$type}";
        return $this->callUploadApi($url,$file,'media');
    }

    /**
     * 获取临时素材
     * @param string $mediaId 媒体文件ID
     * @return array
     */
    public function getMedia($mediaId)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=ACCESS_TOKEN&media_id={$mediaId}";
        return $this->callDownloadApi($url, []);
    }

    /**
     * 高清语音素材获取
     * @param string $mediaId 媒体文件ID
     * @return array
     */
    public function getJssdkMedia($mediaId)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/media/get/jssdk?access_token=ACCESS_TOKEN&media_id={$mediaId}";
    }


    /**
     * 更新图文素材
     * @param string $mediaId 要修改的图文消息的id
     * @param int $index 要更新的文章在图文消息中的位置（多图文消息时，此字段才有意义），第一篇为0
     * @param array $news 文章内容
     * @return array
     */
    public function updateNews($mediaId, $index = 0, $news)
    {
        $params = ['media_id' => $mediaId, 'index' => $index, 'articles' => $news];
        $url = "https://api.weixin.qq.com/cgi-bin/material/update_news?access_token=ACCESS_TOKEN";
        $params = array(
            "index" => 0,
            "articles" => $news,
            "media_id" => $mediaId
        );
        return $this->callPostApi($url, $params);
    }

    /**
     * @param array $params
     * @return array
     */
    public function addNews($news = [])
    {
        $url = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=ACCESS_TOKEN";
        $params = array("articles" => [$news]);
        return $this->callPostApi($url, $params);
    }

    /**
     * 上传图文消息内的图片获取URL
     * @param string $filename
     * @return array
     */
    public function uploadImg($file, $type = 'image')
    {
        $url = "https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=ACCESS_TOKEN";
        return $this->callUploadApi($url, $file, $type);
    }

    /**
     * 新增其他类型永久素材
     * @param string $filename 文件名称
     * @param string $type 媒体文件类型(image|voice|video|thumb)
     * @param array $description 包含素材的描述信息
     * @return array
     * @throws InvalidResponseException
     */
    public function addMaterial($file, $type = 'image', $description = [])
    {
        if (!in_array($type, ['image', 'voice', 'video', 'thumb'])) {
            throw new InvalidResponseException('Invalid Media Type.', '0');
        }
        $url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=ACCESS_TOKEN&type={$type}";

        if($type == 'video')
        $description = ['description' => Tools::arr2json($description)];
        return $this->callUploadApi($url,$file,'media', $description);
    }

    /**
     * 获取永久素材
     * @param string $mediaId 要获取的素材的media_id
     * @return array|string
     */
    public function getMaterial($mediaId)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=ACCESS_TOKEN";
        $params = ['media_id' => $mediaId];
        return $this->callDownloadApi($url, $params);
    }

    /**
     * 删除永久素材
     * @param string $mediaId 要删除的素材的media_id
     * @return array
     */
    public function delMaterial($mediaId)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/material/del_material?access_token=ACCESS_TOKEN";
        $params = ['media_id' => $mediaId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取素材总数
     * @return array
     */
    public function getMaterialCount()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 获取素材列表
     * @param string $type
     * @param int $offset
     * @param int $count
     * @return array
     * @throws InvalidResponseException
     */
    public function batchGetMaterial(string $type = 'image', int $offset = 0, int $count = 20)
    {
        if (!in_array($type, ['image', 'voice', 'video', 'news'])) {
            throw new InvalidResponseException('Invalid Media Type.', '0');
        }
        $url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=ACCESS_TOKEN";
        $params = ['type' => $type, 'offset' => $offset, 'count' => $count];
        return $this->callPostApi($url, $params);
    }
}
