<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class About extends CI_Controller {

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct() {

        parent::__construct();

    }

    function index() {
        $data['topmenu'] = "topmenu";
       if ($this->session->userdata('logged_in')) {

            $data['topmenu'] = "session_topmenu";

        //} else {
        //    redirect('/login');
       }
        $this->seo->SetValues('Title', "About Us - Neighborty");
        $this->load->view('templates/header');
        $this->load->view('front_end/about_us', $data);
        $this->load->view('templates/footer');
    }


}
