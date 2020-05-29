<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 가게 관리
 */

$config['shop_page_menu']['store'] =
    array(
        '__config'          => array('가게관리', 'icon-default icon-store'),
        'menu'              => array(
            'manage' => array('실시간 주문 관리', ''),
            'today' => array('오늘의 주문 / 매출내역', ''),
            /*'review' => array('리뷰 및 쿠폰 관리', ''),*/
            'review' => array('리뷰 관리', ''),
            'board' => array('공지사항 및 이벤트', ''),
        ),
    );