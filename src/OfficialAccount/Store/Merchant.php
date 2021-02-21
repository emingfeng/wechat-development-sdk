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

namespace eMingFeng\OfficialAccount\Store;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 微信小店
 * Class StoreClient
 * @package eMingFeng\OfficialAccount\Store
 * @officialaccount doc https://developers.weixin.qq.com/doc/offiaccount/Instant_Stores/WeChat_Store_Interface.html
 */

class Merchant extends BaseClient
{
    /**
     * 1.1增加商品
     * @param array $productBase 商品详情信息
     * @return array
     */
    public function create(array $productBase)
    {
        $url = "https://api.weixin.qq.com/merchant/create?access_token=ACCESS_TOKEN";
        $params = ['product_base' => $productBase];
        return $this->callPostApi($url, $params);
    }

    /**
     * 1.2删除商品
     * @param string $productId 商品ID
     * @return array
     * @return array
     */
    public function del(string $productId)
    {
        $url = "https://api.weixin.qq.com/merchant/del?access_token=ACCESS_TOKEN";
        $params = ['product_id' => $productId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 1.3修改商品
     * @param string $productId 商品ID
     * @param array $productBase 商品详情信息
     * @return array
     */
    public function update(string $productId, array $productBase)
    {
        $url = "https://api.weixin.qq.com/merchant/update?access_token=ACCESS_TOKEN";
        $params = ['product_id' => $productId, 'product_base' => $productBase];
        return $this->callPostApi($url, $params);
    }

    /**
     * 1.4查询商品
     * @param string $productId 商品ID
     * @return array
     */
    public function get(string $productId)
    {
        $url = "https://api.weixin.qq.com/merchant/get?access_token=ACCESS_TOKEN";
        $params = ['product_id' => $productId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 1.5获取指定状态的所有商品
     * @param int $status 商品状态(0-全部, 1-上架, 2-下架)
     * @return array
     */
    public function getByStatus(int $status = 0)
    {
        $url = "https://api.weixin.qq.com/merchant/getbystatus?access_token=ACCESS_TOKEN";
        $params = ['status' => $status];
        return $this->callPostApi($url, $params);
    }

    /**
     * 1.6商品上下架
     * @param string $productId 商品ID
     * @param int $status 商品上下架标识(0-下架, 1-上架)
     * @return array
     */
    public function modProductStatus(string $productId, int $status)
    {
        $url = "https://api.weixin.qq.com/merchant/modproductstatus?access_token=ACCESS_TOKEN";
        $params = ['product_id' => $productId, 'status' => $status];
        return $this->callPostApi($url, $params);
    }

    /**
     * 1.7获取指定分类的所有子分类
     * @param string $cateId 大分类ID(根节点分类id为1)
     * @return array
     */
    public function getSub(string $cateId)
    {
        $url = "https://api.weixin.qq.com/merchant/category/getsub?access_token=ACCESS_TOKEN";
        $params = ['cate_id' => $cateId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 1.8获取指定子分类的所有SKU
     * @param string $cateId 大分类ID(根节点分类id为1)
     * @return array
     */
    public function getSku(string $cateId)
    {
        $url = "https://api.weixin.qq.com/merchant/category/getsku?access_token=ACCESS_TOKEN";
        $params = ['cate_id' => $cateId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 1.9获取指定分类的所有属性
     * @param string $cateId 大分类ID(根节点分类id为1)
     * @return array
     */
    public function getProperty(string $cateId)
    {
        $url = "https://api.weixin.qq.com/merchant/category/getproperty?access_token=ACCESS_TOKEN";
        $params = ['cate_id' => $cateId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 2.1增加库存
     * @param string $productId 商品ID
     * @param string $skuInfo sku信息,格式"id1:vid1;id2:vid2",如商品为统一规格，则此处赋值为空字符串即可
     * @param int $quantity 增加的库存数量
     * @return array
     */
    public function addStock(string $productId, string $skuInfo, int $quantity)
    {
        $url = "https://api.weixin.qq.com/merchant/stock/add?access_token=ACCESS_TOKEN";
        $params = ['product_id' => $productId, 'sku_info' => $skuInfo, 'quantity' => $quantity];
        return $this->callPostApi($url, $params);
    }

    /**
     * 2.2减少库存
     * @param string $productId 商品ID
     * @param string $skuInfo sku信息,格式"id1:vid1;id2:vid2",如商品为统一规格，则此处赋值为空字符串即可
     * @param int $quantity 增加的库存数量
     * @return array
     */
    public function reduceStock(string $productId, string $skuInfo, int $quantity)
    {
        $url = "https://api.weixin.qq.com/merchant/stock/reduce?access_token=ACCESS_TOKEN";
        $params = ['product_id' => $productId, 'sku_info' => $skuInfo, 'quantity' => $quantity];
        return $this->callPostApi($url, $params);
    }


    /**
     * 3.1增加邮费模板
     * @param array $data
     * @return array
     */
    public function addExpress(array $data)
    {
        $url = "https://api.weixin.qq.com/merchant/express/add?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data);
    }

    /**
     * 3.2删除邮费模板
     * @param string $templateId 邮费模板ID
     * @return array
     */
    public function delExpress(string $templateId)
    {
        $url = "https://api.weixin.qq.com/merchant/express/del?access_token=ACCESS_TOKEN";
        $params = ['template_id' => $templateId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 3.3修改邮费模板
     * @param string $templateId 邮费模板ID
     * @param array $data
     * @return array
     */
    public function updateExpress(string $templateId, array $data)
    {
        $url = "https://api.weixin.qq.com/merchant/express/update?access_token=ACCESS_TOKEN";
        $params = ['template_id' => $templateId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 3.4获取指定ID的邮费模板
     * @param string $templateId 邮费模板ID
     * @return array
     */
    public function getByIdExpress(string $templateId)
    {
        $url = "https://api.weixin.qq.com/merchant/express/getbyid?access_token=ACCESS_TOKEN";
        $params = ['template_id' => $templateId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 3.5获取所有邮费模板
     * @return array
     */
    public function getAllExpress()
    {
        $url = "https://api.weixin.qq.com/merchant/express/getall?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 4.1增加分组
     * @param string $groupName 分组名称
     * @param array $productList 商品ID集合
     * @return array
     */
    public function addGroup(string $groupName, array $productList)
    {
        $url = "https://api.weixin.qq.com/merchant/group/add?access_token=ACCESS_TOKEN";
        $params = ["group_detail" => ["groud_name" => $groupName, "product_list" => $productList]];
        return $this->callPostApi($url, $params);
    }


    /**
     * 4.2删除分组
     * @param string $groupId 分组ID
     * @return array
     */
    public function delGroup(string $groupId)
    {
        $url = "https://api.weixin.qq.com/merchant/group/del?access_token=ACCESS_TOKEN";
        $params = ['group_id' => $groupId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 4.3修改分组属性
     * @param string $groupId 分组ID
     * @param string $groupName 分组名称
     * @return array
     */
    public function propertyModGroup(string $groupId,string $groupName)
    {
        $url = "https://api.weixin.qq.com/merchant/group/propertymod?access_token=ACCESS_TOKEN";
        $params = ['group_id' => $groupId, 'group_name' => $groupName];
        return $this->callPostApi($url, $params);
    }

    /**
     * 4.4修改分组商品
     * @param string $groupId 分组ID
     * @param array $product 分组的商品集合
     * @return array
     */
    public function productModGroup(string $groupId, array $product)
    {
        $url = "https://api.weixin.qq.com/merchant/group/productmod?access_token=ACCESS_TOKEN";
        $params = ['group_id' => $groupId, 'product' => $product];
        return $this->callPostApi($url, $params);
    }

    /**
     * 4.5获取所有分组
     * @return array
     */
    public function getAllGroup()
    {
        $url = "https://api.weixin.qq.com/merchant/group/getall?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 4.6根据分组ID获取分组信息
     * @param string $groupId 分组ID
     * @return array
     */
    public function getByIdGroup(string $groupId)
    {
        $url = "https://api.weixin.qq.com/merchant/group/getbyid?access_token=ACCESS_TOKEN";
        $params = ['group_id' => $groupId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 5.1增加货架
     * @param array $shelfData 货架详情信息
     * @return array
     */
    public function addShelf(array $shelfData)
    {
        $url = "https://api.weixin.qq.com/merchant/shelf/add?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $shelfData);
    }

    /**
     * 5.2删除货架
     * @param string $shelfId 货架ID
     * @return array
     */
    public function delShelf(string $shelfId)
    {
        $url = "https://api.weixin.qq.com/merchant/shelf/del?access_token=ACCESS_TOKEN";
        $params = ['shelf_id' => $shelfId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 5.3修改货架
     * @param string $shelfId 货架ID
     * @param array $shelfData 货架详情信息
     * @param string $shelfBanner 货架banner(图片需调用图片上传接口获得图片Url填写至此，否则修改货架失败)
     * @param string $shelfName 货架名称
     * @return array
     */
    public function modShelf(string $shelfId, array $shelfData, string $shelfBanner, string $shelfName)
    {
        $url = "https://api.weixin.qq.com/merchant/shelf/mod?access_token=ACCESS_TOKEN";
        $params = ['shelf_id' => $shelfId, 'shelf_data' => $shelfData, 'shelf_banner' => $shelfData, 'shelf_name' => $shelfName];
        return $this->callPostApi($url, $params);
    }

    /**
     * 5.4获取所有货架
     * @return array
     */
    public function getAllShelf(){
        $url = "https://api.weixin.qq.com/merchant/shelf/getall?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 5.5根据货架ID获取货架信息
     * @param string $shelfId 货架ID
     * @return array
     */
    public function getByIdShelf(string $groupId)
    {
        $url = "https://api.weixin.qq.com/merchant/shelf/getbyid?access_token=ACCESS_TOKEN";
        $params = ['group_id' => $groupId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 6.2根据订单ID获取订单详情
     * @param string $orderId 商品订单信息
     * @return array
     */
    public function getByIdOrder(string $orderId)
    {
        $url = "https://api.weixin.qq.com/merchant/order/getbyid?access_token=ACCESS_TOKEN";
        $params = ['order_id' => $orderId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 6.3根据订单状态/创建时间获取订单详情
     * @param int $status	订单状态(不带该字段-全部状态, 2-待发货, 3-已发货, 5-已完成, 8-维权中, )
     * @param string $beginTime	订单创建时间起始时间(不带该字段则不按照时间做筛选)
     * @param string $endTime	订单创建时间终止时间(不带该字段则不按照时间做筛选)
     * @return array
     */
    public function getByFilterOrder(int $status, string $beginTime = null , string $endTime = null)
    {
        $url = "https://api.weixin.qq.com/merchant/order/getbyfilter?access_token=ACCESS_TOKEN";
        $params = ['status' => $status, 'begintime' => $beginTime, 'endtime' => $endTime];
        return $this->callPostApi($url, $params);
    }

    /**
     * 6.4设置订单发货信息
     * @param string $order_id	订单ID
     * @param string $delivery_company	物流公司ID(参考《物流公司ID》；当need_delivery为0时，可不填本字段；当need_delivery为1时，该字段不能为空；当need_delivery为1且is_others为1时，本字段填写其它物流公司名称)
     * @param string $delivery_track_no	运单ID(当need_delivery为0时，可不填本字段；当need_delivery为1时，该字段不能为空；)
     * @param int $need_delivery	商品是否需要物流(0-不需要，1-需要，无该字段默认为需要物流)
     * @param int $is_others	是否为6.4.5表之外的其它物流公司(0-否，1-是，无该字段默认为不是其它物流公司)
     * @return array
     */
    public function setDeliveryOrder(string $order_id, string $delivery_company, string $delivery_track_no, int $need_delivery, int $is_others)
    {
        $url = "https://api.weixin.qq.com/merchant/order/setdelivery?access_token=ACCESS_TOKEN";
        $params = [
            'order_id' => $order_id,
            'delivery_company' => $delivery_company,
            'delivery_track_no' => $delivery_track_no,
            'need_delivery' => $need_delivery,
            'is_others' => $is_others
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 6.5关闭订单
     * @param string $orderId 商品订单信息
     * @return array
     */
    public function closeOrder(string $orderId)
    {
        $url = "https://api.weixin.qq.com/merchant/order/close?access_token=ACCESS_TOKEN";
        $params = ['order_id' => $orderId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 上传图片
     * @param $file
     * @return array
     */
    public function uploadImg($file)
    {
        $pathinfo = pathinfo($file);
        $url = "https://api.weixin.qq.com/merchant/common/upload_img?access_token=ACCESS_TOKEN&filename={$pathinfo['basename']}";
        return $this->callUploadApi($url, $file, 'image');
    }
}
