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

namespace eMingFeng\OfficialAccount\Card;

use eMingFeng\Kernel\core\BaseClient;

/**
 * 管理卡券
 * Class Managing
 * @package eMingFeng\OfficialAccount\Card
 * @officialAccount doc https://developers.weixin.qq.com/doc/offiaccount/Cards_and_Offer/Managing_Coupons_Vouchers_and_Cards.html
 */

class Managing extends BaseClient
{
    /**
     * 查询Code
     * @param string $code 单张卡券的唯一标准。
     * @param string $card_id 卡券ID代表一类卡券。自定义code卡券必填。
     * @param bool $check_consume 是否校验code核销状态，填入true和false时的code异常状态返回数据不同。
     * @return array
     */
    public function getCode(string $code, string $card_id, bool $check_consume)
    {
        $url = "https://api.weixin.qq.com/card/code/get?access_token=ACCESS_TOKEN";
        $params = ['code' => $code, 'card_id' => $card_id, 'check_consume' => $check_consume];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取用户已领取卡券
     * @param string $openid 需要查询的用户openid
     * @param string $card_id 卡券ID。不填写时默认查询当前appid下的卡券。
     * @return array
     */
    public function getCardListofUser(string $openid, string $card_id = null)
    {
        $url = "https://api.weixin.qq.com/card/user/getcardlist?access_token=ACCESS_TOKEN";
        $params = ['card_id' => $card_id, 'openid' => $openid];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查看卡券详情
     * @param string $card_id 卡券ID。
     * @return array
     */
    public function getCard(string $card_id)
    {
        $url = "https://api.weixin.qq.com/card/get?access_token=ACCESS_TOKEN";
        $params = ['card_id' => $card_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 批量查询卡券列表
     * @param int $offset 查询卡列表的起始偏移量，从0开始，即offset: 5是指从从列表里的第六个开始读取。
     * @param int $count 需要查询的卡片的数量（数量最大50）。
     * @param string $status_list 支持开发者拉出指定状态的卡券列表 “CARD_STATUS_NOT_VERIFY”, 待审核 ； “CARD_STATUS_VERIFY_FAIL”, 审核失败； “CARD_STATUS_VERIFY_OK”， 通过审核； “CARD_STATUS_DELETE”， 卡券被商户删除； “CARD_STATUS_DISPATCH”， 在公众平台投放过的卡券；
     * @return array
     */
    public function batchGetCard(int $offset = 0, int $count = 10, string $status_list = null)
    {
        $url = "https://api.weixin.qq.com/card/batchget?access_token=ACCESS_TOKEN";
        $params = ['offset' => $offset, 'count' => $count, 'status_list' => $status_list];
        return $this->callPostApi($url, $params);
    }

    /**
     * 更改卡券信息
     * @param string $card_type
     * @param array $data
     * @return array
     */
    public function updateCard(string $card_id, string $card_type, array $data)
    {
        $url = "https://api.weixin.qq.com/card/update?access_token=ACCESS_TOKEN";

        $params = [
            'card_id' => $card_id,
            strtolower($card_type) => $data
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 修改库存
     * @param string $card_id 卡券id
     * @param int $increase_stock_value 增加多少库存，支持不填或填0。
     * @param int $reduce_stock_value 减少多少库存，可以不填或填0。
     * @return array
     */
    public function modifyStockCard(string $card_id, int $increase_stock_value = 0, int $reduce_stock_value = 0)
    {
        $url = "https://api.weixin.qq.com/card/modifystock?access_token=ACCESS_TOKEN";
        $params = ['card_id' => $card_id, 'increase_stock_value' => $increase_stock_value, 'reduce_stock_value' => $reduce_stock_value];
        return $this->callPostApi($url, $params);
    }

    /**
     * 更改Code
     * @param string $card_id 卡券ID。自定义Code码卡券为必填。
     * @param string $code 需变更的Code码。
     * @param string $new_code 变更后的有效Code码。
     * @return array
     */
    public function updateCode(string $card_id = null, string $code, string $new_code )
    {
        $url = "https://api.weixin.qq.com/card/code/update?access_token=ACCESS_TOKEN";
        $params = ['card_id' => $card_id, 'code' => $code, 'new_code' => $new_code];
        return $this->callPostApi($url, $params);
    }

    /**
     * 删除卡券
     * @param string $card_id 卡券id
     * @return array
     */
    public function delCard(string $card_id)
    {
        $url = "https://api.weixin.qq.com/card/delete?access_token=ACCESS_TOKEN";
        $params = ['card_id' => $card_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 设置卡券失效
     * @param string $card_id 卡券ID。自定义Code码卡券为必填。
     * @param string $code 设置失效的Code码。
     * @param string $reason 失效理由
     * @return array
     */
    public function unavailable(string $card_id = null, string $code, string $reason)
    {
        $url = "https://api.weixin.qq.com/card/code/unavailable?access_token=ACCESS_TOKEN";
        $params = ['card_id' => $card_id, 'code' => $code, 'reason' => $reason];
        return $this->callPostApi($url, $params);
    }

    /**
     * 拉取卡券概况数据
     * @param string $begin_date 查询数据的起始时间。
     * @param string $end_date 查询数据的截至时间。
     * @param string $cond_source 卡券来源，0为公众平台创建的卡券数据 、1是API创建的卡券数据
     * @return array
     */
    public function getCardSummary(string $begin_date, string $end_date, string $cond_source)
    {
        $url = "https://api.weixin.qq.com/datacube/getcardbizuininfo?access_token=ACCESS_TOKEN";
        $params = ['begin_date' => $begin_date, 'end_date' => $end_date, 'cond_source' => $cond_source];
        return $this->callPostApi($url, $params);
    }

    /**
     * 获取免费券数据
     * @param string $begin_date 查询数据的起始时间。
     * @param string $end_date 查询数据的截至时间。
     * @param string $cond_source 卡券来源，0为公众平台创建的卡券数据 、1是API创建的卡券数据
     * @param string $card_id 卡券ID。填写后，指定拉出该卡券的相关数据。
     * @return array
     */
    public function getFreeCardSummary(string $begin_date, string $end_date, string $cond_source, string $card_id)
    {
        $url = "https://api.weixin.qq.com/datacube/getcardcardinfo?access_token=ACCESS_TOKEN";
        $params = ['begin_date' => $begin_date, 'end_date' => $end_date, 'cond_source' => $cond_source, 'card_id' => $card_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 拉取会员卡概况数据
     * @param string $begin_date 查询数据的起始时间。
     * @param string $end_date 查询数据的截至时间。
     * @param string $cond_source 卡券来源，0为公众平台创建的卡券数据 、1是API创建的卡券数据
     * @return array
     */
    public function getMemberCardSummary(string $begin_date, string $end_date, string $cond_source)
    {
        $url = "https://api.weixin.qq.com/datacube/getcardmembercardinfo?access_token=ACCESS_TOKEN";
        $params = ['begin_date' => $begin_date, 'end_date' => $end_date, 'cond_source' => $cond_source];
        return $this->callPostApi($url, $params);
    }

    /**
     * 拉取单张会员卡数据
     * @param string $begin_date 查询数据的起始时间。
     * @param string $end_date 查询数据的截至时间。
     * @param string $card_id 卡券id
     * @return array
     */
    public function getMemberCardSummaryById(string $begin_date, string $end_date, string $card_id)
    {
        $url = "https://api.weixin.qq.com/datacube/getcardmembercarddetail?access_token=ACCESS_TOKEN";
        $params = ['begin_date' => $begin_date, 'end_date' => $end_date, 'card_id' => $card_id];
        return $this->callPostApi($url, $params);
    }
}

