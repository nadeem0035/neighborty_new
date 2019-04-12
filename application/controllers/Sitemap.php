<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sitemap extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }


    public function index() {
        $data['pages'] = $this->db->get("pages")->result();
        $data['properties'] = $this->db->get("listing")->result();

        $this->load->view('sitemap/index', $data);
    }




}