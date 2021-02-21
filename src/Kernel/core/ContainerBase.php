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

namespace eMingFeng\Kernel\core;

/**
 * Class ContainerBase
 * @package eMingFeng\Kernel\core
 */

class ContainerBase extends Container
{
    protected $provider = [];

    public $options = array();

    public function __construct($options =array())
    {
        $this->options = $options;

        $provider_callback = function ($provider) {
            $obj =new $provider;
            $this->serviceRegister($obj);
        };

        array_walk($this->provider, $provider_callback);
    }

    public function __get($id)
    {
        if(!empty($this->provider[$id])){
            return $this;
        }
        return $this->offsetGet($id);
    }
}