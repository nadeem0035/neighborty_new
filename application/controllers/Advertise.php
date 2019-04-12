<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class Advertise extends CI_Controller
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
       // $this->load->model('Listings_model');
    }

    function index()
    {

        $data = new stdClass();
        $data->topmenu = "index_menu";
        if ($this->session->userdata('logged_in')) {
            $data->topmenu = "index_account_menu";
        }

        $this->seo->SetValues('Title', 'The most complete real estate platform in Pakistan');
        $this->seo->SetValues('Description', "Apartment for rent, Rent apartment, house, find house for sale, find real estate agent, go real estate agent, build your rental record, buy a house or apartment");

        $this->load->view('templates/header');
        $this->load->view('advertise/index');
        $this->load->view('templates/footer');
    }


    function banner($name)
    {

        $data = new stdClass();
        $data->topmenu = "index_menu";
        if ($this->session->userdata('logged_in')) {

            $data->topmenu = "index_account_menu";
        }
        add_css(array('jquery.toast.css'));
        add_js(array('jquery.validate.min.js','jquery.toast.js','general.js'));
        $data->name = $name;

        $this->seo->SetValues('Title', 'The most complete real estate platform in Pakistan');
        $this->seo->SetValues('Description', "Apartment for rent, Rent apartment, house, find house for sale, find real estate agent, go real estate agent, build your rental record, buy a house or apartment");

        $this->load->view('templates/header');
        $this->load->view('advertise/advertise',$data);
        $this->load->view('templates/footer');

    }



    function saveAdvertiseRequest()
    {


            $this->load->helper('form');
            $this->load->library('form_validation');
            $data = new stdClass();
            $data->title = 'Advertise with zoney';

            if ($this->input->is_ajax_request()) {


                $this->form_validation->set_rules('name','Name','trim|required');
                $this->form_validation->set_rules('ad_type','Ad Type','trim|required');
                $this->form_validation->set_rules('email','Email','trim|required|valid_email');
                $this->form_validation->set_rules('phone','Phone','trim|required');
                $this->form_validation->set_rules('subject','Subject','trim|required');
                $this->form_validation->set_rules('message','Message','trim|required');

                if($this->form_validation->run() == false){

                    $response = array('status' => '400', 'message' => validation_errors(), 'response' =>'error');
                    echo json_encode($response);

                } else {

                    $data = array(

                        'name' => $this->input->get_post('name', false),
                        'type' => $this->input->get_post('ad_type', false),
                        'email' => $this->input->get_post('email', false),
                        'phone' => $this->input->get_post('phone', false),
                        'subject' => $this->input->get_post('subject', false),
                        'message' => $this->input->get_post('message', false)
                    );

                    $result = $this->db->insert('ad_requests', $data);

                    if($result){
                        $response = array('status' => '200', 'message' => 'success','response' =>'success');
                        echo json_encode($response);
                    }
                }
            }


    }


}
