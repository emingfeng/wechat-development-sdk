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

namespace eMingFeng\MiniProgram\Express;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 物流助手
 * Class Room
 * @package eMingFeng\MiniProgram\Express
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/express/by-business/logistics.addOrder.html
 * @openplatform doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/Mini_Programs/Logistics_Assistant.html
 * todo logistics.onBindResultUpdate 绑定商户审核结果更新事件。收到事件之后，回复success或者空串即可。
 * todo logistics.onPathUpdate       运单轨迹更新事件。当运单轨迹有更新时，会产生如下数据包。收到事件之后，回复success或者空串即可
 */

class Client extends BaseClient
{
    /**
     * 生成运单
     * @param array $data
     * @return array
     */
    public function addOrder(array $data = [])
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/business/order/add?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data, true);
    }


    /**
     * 批量获取运单数据
     * @param array $data
     * @return array
     */
    public function batchGetOrder($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/business/order/batchget?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data, true);
    }

    /**
     * 绑定物流账号
     * @param string $biz_id 快递公司客户编码
     * @param string $delivery_id 快递公司ID
     * @param string $password 快递公司客户密码, ems，顺丰，京东非必填
     * @param string $remark_content 备注内容（提交EMS审核需要）
     * @return array
     */
    public function bindAccount(
        string $biz_id,
        string $delivery_id ,
        string $password = '',
        string $remark_content = ''
    ){
        $url = "https://api.weixin.qq.com/cgi-bin/express/business/account/bind?access_token=ACCESS_TOKEN";
        $params = ['biz_id' => $biz_id, 'type' => 'bind', 'password' => $password, 'remark_content' => $remark_content];
        return $this->callPostApi($url, $params, true);
    }

    /**
     * 解绑物流账号
     * @param string $biz_id 快递公司客户编码
     * @param string $delivery_id 快递公司ID
     * @param string $password 快递公司客户密码, ems，顺丰，京东非必填
     * @param string $remark_content 备注内容（提交EMS审核需要）
     * @return array
     */
    public function unbindAccount(
        string $biz_id,
        string $delivery_id ,
        string $password = '',
        string $remark_content = ''
    ){
        $url = "https://api.weixin.qq.com/cgi-bin/express/business/account/bind?access_token=ACCESS_TOKEN";
        $params = ['biz_id' => $biz_id, 'type' => 'unbind', 'password' => $password, 'remark_content' => $remark_content];
        return $this->callPostApi($url, $params, true);
    }

    /**
     * 取消运单
     * @param string $order_id 订单 ID，需保证全局唯一
     * @param string $openid 用户openid，当add_source=2时无需填写（不发送物流服务通知）
     * @param string $delivery_id 快递公司ID，参见getAllDelivery
     * @param string $waybill_id 运单ID
     * @return array
     */
    public function cancelOrder(string $order_id, string $openid, string $delivery_id, string $waybill_id)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/business/order/cancel?access_token=ACCESS_TOKEN";
        $params = [
            'order_id' => $order_id,
            'openid' => $openid,
            'delivery_id' => $delivery_id,
            'waybill_id' => $waybill_id
        ];
        return $this->callPostApi($url, $params, true);
    }

    /**
     * 获取所有绑定的物流账号
     */
    public function getAllAccount()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/business/account/getall?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 获取支持的快递公司列表
     * @return array
     */
    public function getAllDelivery()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/business/delivery/getall?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 获取运单数据
     * @param string $order_id 订单 ID，需保证全局唯一
     * @param string $openid 用户openid，当add_source=2时无需填写（不发送物流服务通知）
     * @param string $delivery_id 快递公司ID，参见getAllDelivery
     * @param string $waybill_id 运单ID
     * @return array
     */
    public function getOrder(string $order_id, string $openid, string $delivery_id, string $waybill_id)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/business/order/get?access_token=ACCESS_TOKEN";
        $params = [
            'order_id' => $order_id,
            'openid' => $openid,
            'delivery_id' => $delivery_id,
            'waybill_id' => $waybill_id
        ];
        return $this->callPostApi($url, $params, true);
    }

    /**
     * 查询运单轨迹
     * @param string $order_id 订单 ID，需保证全局唯一
     * @param string $openid 用户openid，当add_source=2时无需填写（不发送物流服务通知）
     * @param string $delivery_id 快递公司ID，参见getAllDelivery
     * @param string $waybill_id 运单ID
     * @return array
     */
    public function getPath(string $order_id, string $openid, string $delivery_id, string $waybill_id)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/business/path/get?access_token=ACCESS_TOKEN";
        $params = [
            'order_id' => $order_id,
            'openid' => $openid,
            'delivery_id' => $delivery_id,
            'waybill_id' => $waybill_id
        ];
        return $this->callPostApi($url, $params, true);
    }

    /**
     * 获取打印员。若需要使用微信打单 PC 软件，才需要调用
     * @return array
     */
    public function getPrinter()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/business/printer/getall?access_token=ACCESS_TOKEN";
        return $this->callGetApi($url);
    }

    /**
     * 获取电子面单余额。仅在使用加盟类快递公司时，才可以调用
     * @param string $delivery_id 	快递公司ID，参见getAllDelivery
     * @param string $biz_id 快递公司客户编码
     * @return array
     */
    public function getQuota(string $delivery_id, string $biz_id)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/business/quota/get?access_token=ACCESS_TOKEN";
        $params = ['delivery_id' => $delivery_id, 'biz_id' => $biz_id];
        return $this->callPostApi($url, $params, true);
    }


    /**
     * 模拟快递公司更新订单状态, 该接口只能用户测试
     * @param array $data
     * @return array
     */
    public function testUpdateOrder($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/business/test_update_order?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $data, true);
    }

    /**
     * 绑定面单打印员，若需要使用微信打单 PC 软件，才需要调用
     * @param string $openid 打印员 openid

     * @param string $tagid_list 用于平台型小程序设置入驻方的打印员面单打印权限，同一打印员最多支持10个tagid，使用半角逗号分隔，中间不加空格，如填写123,456，表示该打印员可以拉取到tagid为123和456的下的单，非平台型小程序无需填写该字段
     * @return array
     */
    public function bindPrinter(string $openid, string $tagid_list = '')
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/business/printer/update?access_token=ACCESS_TOKEN";
        $params = ['opendid' => $openid, 'update_type' => 'bind', 'tagid_list' => $tagid_list];
        return $this->callPostApi($url, $params, true);
    }

    /**
     * 解绑面单打印员，若需要使用微信打单 PC 软件，才需要调用
     * @param string $openid
     * @param string $tagid_list
     * @return array
     */
    public function unbindPrinter(string $openid, string $tagid_list = '')
    {
        $url = "https://api.weixin.qq.com/cgi-bin/express/business/printer/update?access_token=ACCESS_TOKEN";
        $params = ['opendid' => $openid, 'update_type' => 'unbind', 'tagid_list' => $tagid_list];
        return $this->callPostApi($url, $params, true);
    }
}