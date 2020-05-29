<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 상품 관리
 */

$config['shop_page_menu']['product'] =
    array(
        '__config'          => array('상품관리', 'icon-default icon-product'),
        'menu'              => array(
            'store' => array('매장상품', ''),
            'bargain' => array('특가상품', ''),
            'plan' => array('기획상품', ''),
        ),
    );