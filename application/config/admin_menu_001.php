<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 상점 관리
 */

$config['admin_page_menu']['shop'] =
    array(
        '__config'          => array('상점관리', 'icon-default admin-shop'),
        'menu'              => array(
            'register' => array('상점등록', ''),
            'lists' => array('상점목록', ''),
        ),
    );