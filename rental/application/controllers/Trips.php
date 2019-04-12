<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Trips extends CI_Controller {

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct() {

        parent::__construct();
        $this->load->model('Trips_model');
    }

    function index() {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));

            // create the data object
            $data = new stdClass();
            //$data->extra_js = 'Inbox.init();';

            $this->load->view('templates/header');
            $this->load->view('trips/your_trips.php', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function previous() {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));

            // create the data object
            $data = new stdClass();
            //$data->extra_js = 'Inbox.init();';

            $this->load->view('templates/header');
            $this->load->view('trips/previous_trips.php', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

}
