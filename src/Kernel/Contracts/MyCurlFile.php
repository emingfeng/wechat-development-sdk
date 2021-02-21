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

namespace eMingFeng\Kernel\Contracts;

/**
 * 自定义CURL文件类
 * Class MyCurlFile
 * @package eMingFeng\Kernel\Contracts
 */

class MyCurlFile extends \stdClass
{
    /**
     * 当前数据类型
     * @var string
     */
    public $datatype = 'MY_CURL_FILE';

    /**
     * MyCurlFile constructor.
     * @param string|array $filename
     * @param string $mimetype
     * @param string $postname
     */
    public function __construct($filename, $mimetype = '', $postname = '')
    {
        if (is_array($filename)) {
            foreach ($filename as $k => $v) $this->{$k} = $v;
        } else {
            $this->mimetype = $mimetype;
            $this->postname = $postname;
            $this->extension = pathinfo($filename, PATHINFO_EXTENSION);
            if (empty($this->extension)) $this->extension = 'tmp';
            if (empty($this->mimetype)) $this->mimetype = Tools::getExtMine($this->extension);
            if (empty($this->postname)) $this->postname = pathinfo($filename, PATHINFO_BASENAME);
            $this->content = base64_encode(file_get_contents($filename));
            $this->tempname = md5($this->content) . ".{$this->extension}";
        }
    }

    /**
     * 获取文件上传信息
     * @return \CURLFile|string
     */
    public function get()
    {
        $this->filename = Tools::pushFile($this->tempname, base64_decode($this->content));
        if (class_exists('CURLFile')) {
            return new \CURLFile($this->filename, $this->mimetype, $this->postname);
        } else {
            return "@{$this->tempname};filename={$this->postname};type={$this->mimetype}";
        }
    }

    /**
     * 通用销毁函数清理缓存文件
     * 提前删除过期因此放到了网络请求之后
     */
    public function __destruct()
    {
    }
}