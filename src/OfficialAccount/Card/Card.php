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
use eMingFeng\Kernel\Exceptions\InvalidArgumentException;
use eMingFeng\Kernel\Contracts\Tools;

/**
 * Class Card.
 * @property \EmingFeng\OfficialAccount\Card\Client             $card               创建卡券
 * @property \EmingFeng\OfficialAccount\Card\Distributing       $distributing       投放卡券
 * @property \EmingFeng\OfficialAccount\Card\Redeeming          $redeeming          核销卡券
 * @property \EmingFeng\OfficialAccount\Card\Managing           $managing           管理卡券
 * @property \EmingFeng\OfficialAccount\Card\Membership         $membership         会员卡专区
 * @property \EmingFeng\OfficialAccount\Card\SpecialTicket      $specialticket      特殊票券
 * @property \EmingFeng\OfficialAccount\Card\SubMerchant        $submerchant        子商户
 */
class Card extends Client
{
    public function __get($property)
    {
        return $this->app["card.{$property}"];
    }
}

