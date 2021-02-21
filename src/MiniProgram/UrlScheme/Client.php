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

namespace eMingFeng\MiniProgram\UrlScheme;

use eMingFeng\Kernel\core\BaseClient;
use eMingFeng\Kernel\Exceptions\InvalidArgumentException;

/**
 * Url Sheme
 * Class Room
 * @package eMingFeng\MiniProgram\UrlScheme
 * @miniprogram  doc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/url-scheme/urlscheme.generate.html
 */

class Client extends BaseClient
{
    /**
     * 获取小程序scheme码
     * @param array $jump_wxa 跳转到的目标小程序信息。例：["path" => "通过scheme码进入的小程序页面路径，必须是已经发布的小程序存在的页面，不可携带query。path为空时会跳转小程序主页。","query" => "通过scheme码进入小程序时的query，最大128个字符，只支持数字，大小写英文以及部分特殊字符：!#$&'()*+,/:;=?@-._~"]
     * @param bool $is_expire 生成的scheme码类型，到期失效：true，永久有效：false。
     * @param int $expire_time 到期失效的scheme码的失效时间，为Unix时间戳。生成的到期失效scheme码在该时间前有效。生成到期失效的scheme时必填。
     * @return array
     */
    public function generate(array $jump_wxa, bool $is_expire = false, int $expire_time = 0)
    {
        $url = "https://api.weixin.qq.com/wxa/generatescheme?access_token=ACCESS_TOKEN";
        if($is_expire && !$expire_time){
            throw new InvalidArgumentException('need expire_time');
        }
        $params = [
            'jump_wxa' => $jump_wxa,
            'is_expire' => $is_expire,
            'expire_time' => $expire_time];
        return $this->callPostApi($url, $params);
    }
}