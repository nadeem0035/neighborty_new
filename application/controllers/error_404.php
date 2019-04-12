<?php
class Error_404 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        add_css(array('owl.carousel.css', 'jquery.mb.YTPlayer.min.css', 'style.css', 'demo.css', 'set2.css'));
        $this->load->view('templates/header');
        $this->output->set_status_header('404');
        $this->load->view('templates/error_404');//loading in custom error view
    }
}
