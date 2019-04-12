<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Content class.
 * 
 * @extends CI_Controller
 */
class Content extends CI_Controller {

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct() {

        parent::__construct();
        define('DEFAULT_LAYOUT','front_end');
        $this->load->model('common_model','common',true);
    }

    public function page() {
        
    	$data['cms']  = $this->common->get_row_with_specific_data('title,description','cms','slug');
    	$this->load->view('front_end/index',$data);
    }

}
