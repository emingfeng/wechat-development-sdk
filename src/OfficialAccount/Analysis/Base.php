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

namespace eMingFeng\OfficialAccount\Analysis;

use eMingFeng\Kernel\core\BaseClient;

class Base extends BaseClient
{
    /**
     * 分析查询
     * @param string $url
     * @param string $begin_date
     * @param string $end_date
     * @param array $ext
     * @return array
     */
    public function analysis(string $url, string $begin_date, string $end_date, array $ext = [])
    {
        $params = array_merge([
            'begin_date' => $begin_date,
            'end_date' => $end_date,
        ], $ext);

        return $this->callPostApi($url, $params);
    }

    public function getAnalysis(string $url, string $begin_date, string $end_date, array $ext = [])
    {
        $params = array_merge([
            'begin_date' => $begin_date,
            'end_date' => $end_date,
        ], $ext);

        $url .= '&' . http_build_query($params);

        return $this->callGetApi($url);
    }
}