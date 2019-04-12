<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Package extends CI_Controller {

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
            }
            $this->load->view('templates/header');
            $this->load->view('front_end/package', $data);
            $this->load->view('templates/footer');

    }

    function confirm_package() {
        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) {
            $data['topmenu'] = "session_topmenu";
        }
        $this->load->view('templates/header');
        $this->load->view('front_end/packages_payments', $data);
        $this->load->view('templates/footer');

    }

}
