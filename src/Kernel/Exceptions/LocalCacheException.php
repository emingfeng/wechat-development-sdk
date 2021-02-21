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

namespace eMingFeng\Kernel\Exceptions;

/***
 * 本地缓存异常
 * Class LocalCacheException
 * @package OfficialAccount\
 */
class LocalCacheException extends \Exception
{

    /**
     * @var array
     */
    public $raw = [];

    /**
     * LocalCacheException constructor.
     * @param string $message
     * @param int $code
     * @param array $raw
     */
    public function __construct($message, $code = 0, $raw = [])
    {
        parent::__construct($message, intval($code));
        $this->raw = $raw;
    }

}