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
use eMingFeng\Kernel\Exceptions\InvalidArgumentException;
use eMingFeng\Kernel\Contracts\Tools;

/**
 * Class Live.
 * @property \EmingFeng\MiniProgram\Live\Room       $room
 * @property \EmingFeng\MiniProgram\Live\Goods       $goods
 * @property \EmingFeng\MiniProgram\Live\Role       $role
 * @property \EmingFeng\MiniProgram\Live\Subscribe       $subscribe
 */
class Live extends Room
{
    public function __get($property)
    {
        return $this->app["live.{$property}"];
    }
}

