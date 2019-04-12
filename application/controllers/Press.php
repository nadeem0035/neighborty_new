<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Press extends CI_Controller {

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct() {

        parent::__construct();
        $this->load->model('Press_model');

    }

    function index() {
        $data['topmenu'] = "topmenu";
       if ($this->session->userdata('logged_in')) {
            $data['topmenu'] = "session_topmenu";
       }
        $data['press_release'] = $this->Press_model->getPressRalease();
        $this->seo->SetValues('Title', "Press - Neighborty");
        $this->load->view('templates/header');
        $this->load->view('front_end/press_release', $data);
        $this->load->view('templates/footer');
    }

    function PressDetail($id) {
        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) {

            $data['topmenu'] = "session_topmenu";

        }
        $data['press_detail'] = $this->Press_model->getPressDetail($id);
        $data['press_rel'] = $this->Press_model->getPressRalease();


        $this->seo->SetValues('Title', "Press Release - Neighborty");
        $this->load->view('templates/header');
        $this->load->view('front_end/pr_detail', $data);
        $this->load->view('templates/footer');
    }


}
