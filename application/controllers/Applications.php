<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class Applications extends CI_Controller
{

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model('Listings_model');
    }

    function index()
    {

        add_js(array('jquery.validate.min.js','custom_maps.js','autocomplete_map.js'));

        if( $this->session->userdata('logged_in') )
        {
            $this->load->helper('text');
            $data = array();
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];

            $data['applications'] = $this->Listings_model->userApplications($uid);



            $this->seo->SetValues('Title', 'My Applications - Neighborty');
            $this->seo->SetValues('Description', "Rent out your room, house or apartment on Neighborty. Join thousands already renting out their space to people all over the world. Listing your space is free!");
            $this->load->view('templates/header');
            $this->load->view('applications/home', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            redirect('/');
        }
    }


}
