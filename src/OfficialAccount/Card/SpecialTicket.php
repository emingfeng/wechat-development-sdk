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
 * 特殊票券
 * Class SpecialTicket
 * @package eMingFeng\OfficialAccount\Card
 * @officialAccount doc https://developers.weixin.qq.com/doc/offiaccount/Cards_and_Offer/Special_ticket.html
 */

class SpecialTicket extends BaseClient
{
    /**
     * 创建会议门票
     * @param array $data 基本的卡券数据
     * @param string $meeting_detail 会议详情。
     * @param string $map_url 	会场导览图。
     * @return array
     */
    public function createMettingTicket(array $data, string $meeting_detail, string $map_url = '')
    {
        $url = "https://api.weixin.qq.com/card/create?access_token=ACCESS_TOKEN";
        $temp = ['meeting_detail' => $meeting_detail, 'map_url' => $map_url];
        $data = array_merge($temp, $data);
        $params = [
            'card' => [
                'card_type' => 'MEETING_TICKET',
                'meeting_ticket' => $data
            ]
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 更新会议门票
     * @param string $code 卡券Code码。
     * @param string $card_id 要更新门票序列号所述的card_id，生成券时use_custom_code 填写true 时必填。
     * @param string $begin_time 开场时间，微信会在开场时间前两小时通过制票公众阿訇或者服务通知下发开场提醒，Unix时间戳格式。
     * @param string $end_time 结束时间，Unix时间戳格式。
     * @param string $zone 区域。
     * @param string $entrance 入口。
     * @param string $seat_number 座位号。
     */
    public function updateMettingTIcket(string $code,  string $card_id = '', string $begin_time = '', string $end_time = '', string $zone, string $entrance, string $seat_number)
    {
        $url = "https://api.weixin.qq.com/card/meetingticket/updateuser?access_token=ACCESS_TOKEN";
        $params = [
            'code' => $code,
            'card_id' => $card_id,
            'begin_time' => $begin_time,
            'end_time' => $end_time,
            'zone' => $zone,
            'entrance' => $entrance,
            'seat_number' => $seat_number
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 创建景区门票
     * @param array $data 基本的卡券数据
     * @param string $ticket_class 票类型，例如平日全票，套票等。
     * @param string $guide_url	导览图url
     * @return array
     */
    public function createScenicTicket(array $data, string $ticket_class, string $guide_url = '')
    {
        $url = "https://api.weixin.qq.com/card/create?access_token=ACCESS_TOKEN";
        $temp = ['ticket_class' => $ticket_class, 'guide_url' => $guide_url];
        $data = array_merge($temp, $data);
        $params = [
            'card' => [
                'card_type' => 'SCENIC_TICKET',
                'scenic_ticket' => $data
            ]
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 创建电影票
     * @param array $data 基本的卡券数据
     * @param string $detail 电影票详情
     * @return array
     */
    public function createMovieTicket(array $data, string $detail)
    {
        $url = "https://api.weixin.qq.com/card/create?access_token=ACCESS_TOKEN";
        $temp = ['detail' => $detail];
        $data = array_merge($temp, $data);
        $params = [
            'card' => [
                'card_type' => 'MOVIE_TICKET',
                'movie_ticket' => $data
            ]
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 更新电影票
     * @param string $code 卡券Code码。
     * @param string $card_id 要更新门票序列号所述的card_id，生成券时use_custom_code 填写true 时必填。
     * @param string $ticket_class 电影票的类别，如2D、3D。
     * @param string $screening_room 该场电影的影厅信息。
     * @param string $seat_number 座位号。
     * @param string $show_time 电影的放映时间，Unix时间戳格式。
     * @param int $duration 放映时长,，填写整数。
     * @return array
     */
    public function updateMovieTicket(string $code,  string $card_id = '', string $ticket_class, string $screening_room = '', string $seat_number = '', string $show_time, string $duration)
    {
        $url = "https://api.weixin.qq.com/card/movieticket/updateuser?access_token=ACCESS_TOKEN";
        $params = [
            'code' => $code,
            'card_id' => $card_id,
            'ticket_class' => $ticket_class,
            'screening_room' => $screening_room,
            'seat_number' => $seat_number,
            'show_time' => $show_time,
            'duration' => $duration
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     *  创建飞机票
     * @param array $data 基本的卡券数据
     * @param string $from 起点，上限为18个汉字。
     * @param string $to 终点，上限为18个汉字。
     * @param string $flight 航班
     * @param string $air_model 机型，上限为8个汉字。
     * @param string $departure_time 起飞时间。Unix时间戳格式。
     * @param string $landing_time 降落时间。Unix时间戳格式。
     * @param string $gate 入口，上限为4个汉字。
     * @param string $check_in_url 在线值机的链接。
     * @return array
     */
    public function createBoardingPass(
        array $data,
        string $from,
        string $to,
        string $flight,
        string $air_model,
        string $departure_time,
        string $landing_time,
        string $gate = '',
        string $check_in_url = ''
    ){
        $url = "https://api.weixin.qq.com/card/create?access_token=ACCESS_TOKEN";
        $temp = [
            'from' => $from,
            'to' => $to,
            'flight' => $flight,
            'air_model' => $air_model,
            'departure_time' => $departure_time,
            'landing_time' => $landing_time,
            'gate' => $gate,
            'check_in_url' => $check_in_url
        ];
        $data = array_merge($temp, $data);
        $params = [
            'card' => [
                'card_type' => 'BOARDING_PASS',
                'boarding_pass' => $data
            ]
        ];
        return $this->callPostApi($url, $params);
    }

    /**
     * 更新飞机票信息
     * @param string $code	卡券Code码。
     * @param string $card_id 卡券ID，自定义Code码的卡券必填。
     * @param string $etkt_bnr 电子客票号，上限为14个数字。
     * @param string $class 舱等，如头等舱等，上限为5个汉字。
     * @param string $qrcode_data 二维码数据。乘客用于值机的二维码字符串，微信会通过此数据为用户生成值机用的二维码。
     * @param string $seat 乘客座位号。
     * @param bool $is_cancel 是否取消值机。填写true或false。true代表取消，如填写true上述字段（如calss等）均不做判断，机票返回未值机状态，乘客可重新值机。默认填写false。
     * @return array
     */
    public function checkinBoardingPass( string $code, string $card_id = '', string $etkt_bnr, string $class, string $qrcode_data = '', string $seat = '', bool $is_cancel = false)
    {
        $url = "https://api.weixin.qq.com/card/boardingpass/checkin?access_token=ACCESS_TOKEN";
        $params = [
            'code' => $code,
            'card_id' => $card_id,
            'etkt_bnr' => $etkt_bnr,
            'class' => $class,
            'qrcode_data' => $qrcode_data,
            'seat' => $seat,
            'is_cancel' => $is_cancel
        ];
        return $this->callPostApi($url ,$params);
    }
}
