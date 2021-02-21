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

namespace eMingFeng\OfficialAccount;

use eMingFeng\Kernel\core\ContainerBase;

/**
 * Class Application
 * @package eMingFeng\OfficialAccount
 *
 * @property \eMingFeng\MiniProgram\Ocr\Client                     $ocr                        Ocr
 * @property \eMingFeng\MiniProgram\Image\Client                   $image                      素材管理
 *

 * @property \eMingFeng\OfficialAccount\Base\Client                 $base                       Basic
 * @property \eMingFeng\OfficialAccount\Card\Card                   $card                       微信卡券
 * @property \eMingFeng\OfficialAccount\User\TagClient              $user_tag                   用户标签管理
 * @property \eMingFeng\OfficialAccount\User\UserClient             $user                       用户管理
 * @property \eMingFeng\OfficialAccount\Mass\Client                 $mass                       群发
 * @property \eMingFeng\OfficialAccount\Menu\Client                 $menu                       自定义菜单
 * @property \eMingFeng\OfficialAccount\Asset\Client                $asset                      素材管理

 * @property \eMingFeng\OfficialAccount\Guide\GuideAccount          $guide_account              对话能力 - 顾问管理
 * @property \eMingFeng\OfficialAccount\Guide\BuyerAccount          $buyer_account              对话能力 - 客户管理
 * @property \eMingFeng\OfficialAccount\Guide\TagAccount            $tag_account                对话能力 - 标签管理
 * @property \eMingFeng\OfficialAccount\Guide\ModelAccount          $model_account              对话能力 - 素材管理
 * @property \eMingFeng\OfficialAccount\Guide\TaskAccount           $task_account               对话能力 - 群发任务管理
 *
 * @property \eMingFeng\OfficialAccount\Store\PoiClient             $poi                        微信门店
 * @property \eMingFeng\OfficialAccount\Store\StoreClient           $store                      微信门店小程序
 * @property \eMingFeng\OfficialAccount\Store\Merchant              $merchant                   微信小店
 * @property \eMingFeng\OfficialAccount\Oauth\Client                $oauth                      网页授权
 * @property \eMingFeng\OfficialAccount\Jssdk\Client                $jssdk                      Jssdk
 * @property \eMingFeng\OfficialAccount\Server\Client               $server                     事件服务
 * @property \eMingFeng\OfficialAccount\Qrcode\Client               $qrcode                     Qrcode
 * @property \eMingFeng\OfficialAccount\Comment\Client              $comment                    图文消息留言管理
 * @property \eMingFeng\OfficialAccount\Semantic\Client             $semantic                   语义理解
 *
 * @property \eMingFeng\OfficialAccount\Analysis\AdClient           $ad_analysis                数据分析 - 广告分析
 * @property \eMingFeng\OfficialAccount\Analysis\MsgClient          $msg_analysis               数据分析 - 消息分析
 * @property \eMingFeng\OfficialAccount\Analysis\UserClient         $user_analysis              数据分析 - 用户分析
 * @property \eMingFeng\OfficialAccount\Analysis\GraphicClient      $graphic_analysis           数据分析 - 图文分析
 * @property \eMingFeng\OfficialAccount\Analysis\InterfaceClient    $interface_analysis         数据分析 - 接口分析
 *
 * @property \eMingFeng\OfficialAccount\CustomerService\Client      $customer_service           客服管理
 * @property \eMingFeng\OfficialAccount\CustomerService\Session     $customer_service_session   会话控制
 */

class Application extends ContainerBase
{
    protected $provider = [
        Ocr\ServiceProvider::class,
        Base\ServiceProvider::class,
        Card\ServiceProvider::class,
        User\ServiceProvider::class,
        Bind\ServiceProvider::class,
        Mass\ServiceProvider::class,
        Menu\ServiceProvider::class,
        Image\ServiceProvider::class,
        Asset\ServiceProvider::class,
        Guide\ServiceProvider::class,
        Store\ServiceProvider::class,
        Jssdk\ServiceProvider::class,
        Oauth\ServiceProvider::class,
        Server\ServiceProvider::class,
        Qrcode\ServiceProvider::class,
        Comment\ServiceProvider::class,
        Semantic\ServiceProvider::class,
        Analysis\ServiceProvider::class,
        CustomerService\ServiceProvider::class
    ];

    public function __call($method, $args)
    {
        return $this->$method(...$args);
    }
}