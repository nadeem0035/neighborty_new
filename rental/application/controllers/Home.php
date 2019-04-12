<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
            
           // $this->load->helper('CssJs');
            //add_js('jamshid.js');
            $data = array();
            $session_data = $this->session->userdata('logged_in');
            $data['logged_in'] = $session_data['logged_in'];
            $this->load->view('templates/header', $data);
            $this->load->view('pages/home', $data);
            $this->load->view('templates/footer', $data);
	   
	}
}
