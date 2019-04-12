<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class References extends CI_Controller {

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct() {

        parent::__construct();
        $this->load->model('References_model');
    }

    function index() {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));
            // create the data object
            $data = new stdClass();

            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];
            $data->users_avatar = $this->config->item('users_avatar');
            $data->references_to = $this->References_model->references_about_you($uid);
            $data->references_by = $this->References_model->references_by_you($uid);
            //echo $this->db->last_query();

            $this->load->view('templates/header');
            $this->load->view('references/references', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

}
