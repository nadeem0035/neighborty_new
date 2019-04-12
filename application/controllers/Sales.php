<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Sales extends CI_Controller {

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
        $this->load->view('templates/header');
        $this->load->view('front_end/sales', $data);
        $this->load->view('templates/footer');
    }

    function detail() {
        $data['topmenu'] = "topmenu";
       if ($this->session->userdata('logged_in')) {

            $data['topmenu'] = "session_topmenu";

        //} else {
        //    redirect('/login');
       }
        $this->load->view('templates/header');
        $this->load->view('front_end/sale_detail', $data);
        $this->load->view('templates/footer');
    }

}
