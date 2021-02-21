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
 * 投放卡券
 * Class Distributing
 * @package eMingFeng\OfficialAccount\Card
 * @officialAccount doc https://developers.weixin.qq.com/doc/offiaccount/Cards_and_Offer/Distributing_Coupons_Vouchers_and_Cards.html
 */

class Distributing extends BaseClient
{
    /**
     * 创建二维码
     * @param array $card
     * @return array
     */
    public function createQrcode(array $card)
    {
        $url = "https://api.weixin.qq.com/card/qrcode/create?access_token=ACCESS_TOKEN";
        return $this->callPostApi($url, $card);
    }

    /**
     * 创建货架
     * @param string $banner	页面的banner图片链接，须调用，建议尺寸为640*300
     * @param string $title	页面的title
     * @param bool $can_share	页面是否可以分享,填入true/false
     * @param string $scene	投放页面的场景值； SCENE_NEAR_BY 附近 SCENE_MENU 自定义菜单 SCENE_QRCODE 二维码 SCENE_ARTICLE 公众号文章 SCENE_H5 h5页面 SCENE_IVR 自动回复 SCENE_CARD_CUSTOM_CELL 卡券自定义cell
     * @param array $card_list	卡券列表，每个item有两个字段 ['card_id' => '所要在页面投放的card_id', 'thumb_url' => '缩略图']
     * @return array
     */
    public function createLandingPage(string $banner, string $title, bool $can_share, string $scene, array $card_list)
    {
        $url = "https://api.weixin.qq.com/card/landingpage/create?access_token=ACCESS_TOKEN";
        $params = [
            'banner' => $banner,
            'title' => $title,
            'can_share' => $can_share,
            'scene' => $scene,
            'card_list' => $card_list
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 导入code
     * @param string $card_id 需要进行导入code的卡券ID。
     * @param array $code 需导入微信卡券后台的自定义code，上限为100个。
     * @return array
     */
    public function depositCode(string $card_id, array $code)
    {
        $url = "https://api.weixin.qq.com/card/code/deposit?access_token=ACCESS_TOKEN";
        $params = ['card_id' => $card_id, 'code' => $code];
        return $this->callPostApi($url, $params);
    }

    /**
     * 查询导入code数目
     * @param string $card_id 进行导入code的卡券ID。
     * @return array
     */
    public function getDepositCountCode(string $card_id)
    {
        $url = "http://api.weixin.qq.com/card/code/getdepositcount?access_token=ACCESS_TOKEN";
        $params = ['card_id' => $card_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 核查code
     * @param string $card_id 需要进行导入code的卡券ID。
     * @param array $code 已经微信卡券后台的自定义code，上限为100个。
     * @return array
     */
    public function checkCode(string $card_id, array $code)
    {
        $url = "http://api.weixin.qq.com/card/code/checkcode?access_token=ACCESS_TOKEN";
        $params = ['card_id' => $card_id, 'code' => $code];
        return $this->callPostApi($url, $params);
    }

    /**
     * 图文消息群发卡券
     * @param string $card_id 卡券ID
     * @return array
     */
    public function getHtml(string $card_id)
    {
        $url = "https://api.weixin.qq.com/card/mpnews/gethtml?access_token=ACCESS_TOKEN";
        $params = ['card_id' => $card_id];
        return $this->callPostApi($url, $params);
    }

    /**
     * 设置测试白名单
     * @param array $openid 测试的openid列表。
     * @param array $username 测试的微信号列表。
     * @return array
     */
    public function setTestWhiteList(array $openid, array $username)
    {
        $url = "https://api.weixin.qq.com/card/testwhitelist/set?access_token=ACCESS_TOKEN";
        $params = ['openid' => $openid, 'username' => $username];
        return $this->callPostApi($url, $params);
    }
}

