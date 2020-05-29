<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 기본 헬퍼
 * 2020.02.19 - ARK
 */


/**
 * 서버 연결
 */
if (!function_exists('connect_server')) {
    function connect_server($url = '', $data = '')
    {
        $CI =& get_instance();

        $ch = curl_init();

        $url .= '?access_token='. $CI->config->item('oauth_access_token');

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);

        $tmp_result = explode('{', $response);
        $tmp_s_result = '';
        foreach ($tmp_result as $key => $value) {
            if ($key != 0) {
                $tmp_s_result .= '{' . $value;
            }
        }
        $result = json_decode($tmp_s_result, true);

        return $result;

        curl_close($ch);
    }
}

/**
 * 휴대폰 번호 하이픈 넣기
 */
if (!function_exists('set_phone')) {
    function set_phone($tel, $hide = '')
    {
        $tel = preg_replace("/[^0-9]/", "", $tel);    // 숫자 이외 제거
        if (substr($tel, 0, 2) == '02')
            return preg_replace("/([0-9]{2})([0-9]{3,4})([0-9]{4})$/", "\\1-\\2-\\3", $tel);
        else if (strlen($tel) == '8' && (substr($tel, 0, 2) == '15' || substr($tel, 0, 2) == '16' || substr($tel, 0, 2) == '18'))
            // 지능망 번호이면
            return preg_replace("/([0-9]{4})([0-9]{4})$/", "\\1-\\2", $tel);
        else if ($hide == true)
            return preg_replace("/([0-9]{3})([0-9]{3,4})([0-9]{4})$/", "\\1-****-\\3", $tel);
        else
            return preg_replace("/([0-9]{3})([0-9]{3,4})([0-9]{4})$/", "\\1-\\2-\\3", $tel);
    }
}

/**
 * 랜덤 번호 발급
 */
if (!function_exists('get_random_number')){
    function get_random_number(){
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz".date('Ymdhsi');
        $str = str_shuffle($str);
        $str = substr($str, 0 , 8);

        return substr(date('Ymd'), 2, 7).$str;
    }
}

/**
 * 콤마 제거
 */
if (!function_exists('rm_comma')){
    function rm_comma($price){
        $price = str_replace(',', '', $price);

        return $price;
    }
}


/**
 * 메인 - 신규 주문요청 개수 가져오기
 */
if (!function_exists('get_new_order')) {
    function get_new_order($shop_id='')
    {
        $CI =& get_instance();
        $CI->load->model('Shop_order_model');

        $where = array(
            'shop_id' => $shop_id,
            'order_confirm' => 0,
            //'order_date >=' => date('Y-m-d')
        );
        $new_order = $CI->Shop_order_model->get_new_order_c($where);

        return $new_order;
    }
}

/**
 * 메인 - 접수된 주문 개수 가져오기
 */
if (!function_exists('get_confirmed_order')) {
    function get_confirmed_order($shop_id='')
    {
        $CI =& get_instance();
        $CI->load->model('Shop_order_model');

        $where = array(
            'shop_id' => $shop_id,
            'order_confirm' => 1,
            //'order_date >=' => date('Y-m-d')
        );
        $new_order = $CI->Shop_order_model->get_new_order_c($where);

        return $new_order;
    }
}

/**
 * 메인 - 배송중 주문 개수 가져오기
 */
if (!function_exists('get_status_order')) {
    function get_status_order($shop_id='', $status_idx='')
    {
        $CI =& get_instance();
        $CI->load->model('Shop_order_model');

        $where = array(
            'shop_id' => $shop_id,
            'order_status' => $status_idx,
            //'order_date >=' => date('Y-m-d')
        );
        $new_order = $CI->Shop_order_model->get_new_order_c($where);

        return $new_order;
    }
}

/**
 * 메인 - 신규 리뷰 개수 가져오기
 */
if (!function_exists('get_new_review')) {
    function get_new_review($shop_id='')
    {
        $CI =& get_instance();
        $CI->load->model('Shop_review_model');

        $where = array(
            'shop_id' => $shop_id,
            'reg_date >=' => date('Y-m-d')
        );
        $new_review = $CI->Shop_review_model->get_total_c($where);

        return $new_review;
    }
}

/**
 * 메인 - 공지사항 및 이벤트 개수 가져오기
 */
if (!function_exists('get_new_board')) {
    function get_new_board()
    {
        $CI =& get_instance();
        $CI->load->model('Board_model');

        $where = array(
            'reg_date >=' => date('Y-m-d H:i:s')
        );
        $new_board = $CI->Board_model->get_total_c($where);

        return $new_board;
    }
}

/**
 * 메인 - 재고관리 되는 매장상품 목록 가져오기
 */
if (!function_exists('get_stock_menu')) {
    function get_stock_menu($shop_id='')
    {
        $CI =& get_instance();
        $CI->load->model('Shop_menu_model');

        $where = array(
            'fd_shop_menu.shop_id' => $shop_id,
            'fd_shop_menu.menu_stock_use' => 1
        );
        $stock_menu = $CI->Shop_menu_model->get_list($where);

        return $stock_menu;
    }
}

/**
 * 메인 - 유통기한 관리 되는 매장상품 목록 가져오기
 */
if (!function_exists('get_expiry_menu')) {
    function get_expiry_menu($shop_id='')
    {
        $CI =& get_instance();
        $CI->load->model('Shop_menu_model');

        $where = array(
            'fd_shop_menu.shop_id' => $shop_id,
            'fd_shop_menu.menu_expiryd_use' => 1
        );
        $stock_menu = $CI->Shop_menu_model->get_list($where);

        return $stock_menu;
    }
}

/**
 * 메인 - VIP 고객 목록 가져오기
 */
if(!function_exists('get_vip_list')){
    function get_vip_list($shop_id='')
    {
        $CI =& get_instance();
        $CI->load->model('Member_model');

        $where = array(
            'fd_shop_order.shop_id' => $shop_id
        );
        $vip_list = $CI->Member_model->get_vip_list($where);

        return $vip_list;
    }
}