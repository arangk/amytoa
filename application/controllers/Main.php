<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends My_Controller {

    public function __construct()
    {
        parent::__construct();

        /**
         * 라이브러리를 로딩합니다
         */
        $this->load->library(array('form_validation', 'email'));

        /**
         * 모델로딩
         */
        $this->load->model(array('Portfolio_model'));
    }

	public function index()
	{
        $view = array();
        $view['view'] = array();

        $view['view']['layout_title'] = $this->myconfig->item('layout_title');

        $portfolio = $this->Portfolio_model->get_list();
        $view['portfolio'] = $portfolio;

        $layoutconfig = array(
            'path' => 'main',
            'layout' => 'layout',
            'skin' => 'main',
            'layout_dir' => $this->myconfig->item('layout_default'),
            'mobile_layout_dir' => $this->myconfig->item('layout_default'),
            'skin_dir' => $this->myconfig->item('skin_default'),
            'mobile_skin_dir' => $this->myconfig->item('skin_default'),
        );
        $view['layout'] = $this->managelayout->front($layoutconfig, $this->myconfig->get_device_view_type());

        $this->data = $view;
        $this->layout = element('layout_skin_file', element('layout', $view));
        $this->view = element('view_skin_file', element('layout', $view));
	}
}
