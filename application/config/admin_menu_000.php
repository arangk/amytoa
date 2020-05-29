<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 회원 관리
 */

$config['admin_page_menu']['member'] =
    array(
        '__config'          => array('회원관리', 'icon-default admin-users'),
        'menu'              => array(
            'register' => array('회원등록', ''),
            'lists' => array('회원목록', ''),
        ),
    );