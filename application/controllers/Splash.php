<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Splash extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     */
    public function index()
    {

        // $this->load->helper('CssJs');
        add_css('https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css');
        //add_js('jamshid.js');
        $data = array();

        $this->load->view('templates/header', $data);
        $this->load->view('front_end/splash-image', $data);
        //$this->load->view('templates/footer', $data);

    }
}
