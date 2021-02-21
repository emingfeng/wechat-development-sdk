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

namespace eMingFeng\MiniProgram\Live;

use eMingFeng\Kernel\core\BaseClient;

/**
 *
 * Class Goods
 * @package eMingFeng\MiniProgram\Live
 * @miniProgram doc https://developers.weixin.qq.com/miniprogram/dev/framework/liveplayer/commodity-api.html
 */

class Goods extends BaseClient
{
    /**
     * 商品添加并提审
     * @param array $goodsData 商品信息
     * @return array
     */
    public function add($goodsData)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/goods/add?access_token=ACCESS_TOKEN";
        $params = ['goodsInfo' => $goodsData];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除商品
     * @param int $goodsId 商品ID
     * @return array
     */
    public function delete(int $goodsId)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/goods/delete?access_token=ACCESS_TOKEN";
        $params = ['goodsId' => $goodsId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 更新商品
     * @param array $goodsData 商品信息
     * @return array
     */
    public function update($goodsData)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/goods/update?access_token=ACCESS_TOKEN";
        $params = ['goodsInfo' => $goodsData];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取商品列表
     * @param int $offset		分页条数起点
     * @param int $limit		分页大小，默认30，不超过100
     * @param int $status		商品状态，0：未审核。1：审核中，2：审核通过，3：审核驳回
     * @return array
     */
    public function getAppRoved(int $offset, int $limit, int $status)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/goods/getapproved?access_token=ACCESS_TOKEN";
        $params = ['offset' => $offset, 'limit' => $limit, 'status' => $status];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取商品状态
     * @param array $goods_ids
     * @return array
     */
    public function getGoodsWarehouse(array $goods_ids)
    {
        $url = "https://api.weixin.qq.com/wxa/business/getgoodswarehouse?access_token=ACCESS_TOKEN";
        $params = ['goods_ids' => $goods_ids];
        return $this->callPostApi($url, $params);
    }

    /**
     * 撤回审核
     * @param int $goodsId 商品ID
     * @param int $auditId 审核单ID
     * @return array
     */
    public function resetAudit(int $goodsId, int $auditId)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/goods/resetaudit?access_token=ACCESS_TOKEN";
        $params = ['goodsId' => $goodsId, 'auditId' =>$auditId];
        return $this->callPostApi($url, $params);
    }

    /**
     * 重新提交审核
     * @param int $goodsId 商品ID
     * @return array
     */
    public function audit(int $goodsId)
    {
        $url = "https://api.weixin.qq.com/wxaapi/broadcast/goods/audit?access_token=ACCESS_TOKEN";
        $params = ['goodsId' => $goodsId];
        return $this->callPostApi($url, $params);
    }


}
