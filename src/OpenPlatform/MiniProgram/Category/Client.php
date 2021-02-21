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

namespace eMingFeng\OpenPlatform\MiniProgram\Category;

use eMingFeng\Kernel\core\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取账号可以设置的所有类目
     * @return array
     */
    public function getAllCategories()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxopen/getallcategories?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, []);
    }

    /**
     * 获取账号已经设置的所有类目
     * @return array
     */
    public function getCategories()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxopen/getcategory?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 获取不同主体类型的类目
     * @param string $verify_type 如果不填，默认传0；个人主体是0；企业主体是1；政府是2；媒体是3；其他组织是4
     * @return array
     */
    public function getCategoriesByType($verify_type)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxopen/getcategoriesbytype?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, []);
    }

    /**
     * 添加类目
     * @param array $categories
     * @return array
     */
    public function addCategories(array $categories)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxopen/addcategory?access_token=ACCESS_TOKEN";
        $params = ['categories' => $categories];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除类目
     * @param int $firstId 一级类目ID
     * @param int $secondId 二级类目ID
     * @return array
     */
    public function deleteCategories(int $firstId, int $secondId)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxopen/deletecategory?access_token=ACCESS_TOKEN";
        $params = ['first' => $firstId, 'second' => $secondId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 修改类目
     * @param string $first 一级类目ID
     * @param string $second 二级类目ID
     * @param array $certicates [资质信息]列表
     * @return array
     */
    public function modifyCategory(int $firstId, int $secondId, array $certicates)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/wxopen/modifycategory?access_token=ACCESS_TOKEN";
        $params = ['first' => $firstId, 'second' => $secondId, 'certicates' => $certicates];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取审核时可填写的类目信息
     * @return array
     */
    public function getCategory()
    {
        $url = "https://api.weixin.qq.com/wxa/get_category?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

}