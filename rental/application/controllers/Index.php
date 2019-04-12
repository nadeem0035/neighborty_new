<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Index class.
 * 
 * @extends CI_Controller
 */
class Index extends CI_Controller {

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct() {

        parent::__construct();
        //define('DEFAULT_LAYOUT','front_end');
        $this->load->model('Listings_model', 'listing', true);
        $this->load->model('Home_model', 'home', true);
        set_extra_js("ComponentsPickers.init();");
    }

    public function index() {
        $data = new stdClass();
        $data->topmenu = "topmenu";
        if ($this->session->userdata('logged_in')) {
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));
            $data->topmenu = "session_topmenu";
       }
        add_css(array('owl.carousel.css', 'jquery.mb.YTPlayer.min.css', 'style.css', 'demo.css', 'set2.css', 'smoothDivScroll.css'));
        add_js(array('owl.carousel.min.js', 'general.js', 'parallax.min.js', 'jquery.nicescroll.js', 'jquery.ui.touch-punch.min.js', 'jquery.mb.YTPlayer.min.js', 'SmoothScroll.js', 'home-script.js', 'jquery.smoothdivscroll-1.3-min.js', 'jquery.mousewheel.min.js'));
        set_extra_js("loadPlacesMap()");
        $this->load->view('templates/header');
        $data->preview_img = $this->config->item('listing_images');
        $data->ins_img = $this->config->item('ins_img');
       // $data->testimonials = $this->home->testimonials();
        $data->top_deals = $this->home->top_vacation_deals();
        $data->top_inspirations = $this->home->top_travel_inspirations();
        $data->instagram_feeds = $this->home->display_instagram_feed();
		
	//echo '<div style="margin: 20% auto 0px 40%;"><h2>NOT AVAILABLE</h2></div>';
        $this->load->view('front_end/index', $data);
        $this->load->view('templates/footer');
    }

    public function contact() {
        $this->load->model('common_model', 'common', true);
        $data = new stdClass();
        $data->topmenu = "topmenu";
        if ($this->session->userdata('logged_in')) {
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));
            $data->topmenu = "session_topmenu";
        }
        add_css(array('owl.carousel.css', 'jquery.mb.YTPlayer.min.css', 'style.css', 'demo.css', 'set2.css'));
        add_js(array('owl.carousel.min.js', 'general.js', 'parallax.min.js', 'jquery.nicescroll.js', 'jquery.ui.touch-punch.min.js', 'jquery.mb.YTPlayer.min.js', 'SmoothScroll.js', 'script.js'));
        
        $this->seo->SetValues('Title', "Contact Us - luxus");
        $data->countries = $this->common->countries();
        
        $this->load->view('templates/header');
        $this->load->view('front_end/contactus', $data);
        $this->load->view('templates/footer');
    }

    function contact_form() {
        $data = array(
            'name' => $this->input->post('fullname'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'country' => $this->input->post('country'),
            'reason_of_inquiry' => $this->input->post('reason_of_inq'),
            'subject' => $this->input->post('subject'),
            'message' => $this->input->post('message'),
        );
        
        $message = '<table style="width:100%">
                    <tr>
                      <th style="text-align: left;width: 120px;">Full Name:</th>
                      <td>'.$data['name'].'</td>
                    </tr>
                    <tr>
                      <th style="text-align: left;width: 120px;">E-Mail:</th>
                      <td>'.$data['email'].'</td>
                    </tr>
                    <tr>
                      <th style="text-align: left;width: 120px;">Telephone:</th>
                      <td>'.$data['phone'].'</td>
                    </tr>
                     <tr>
                      <th style="text-align: left;width: 120px;">Country:</th>
                      <td>'.$data['country'].'</td>
                    </tr>
                     <tr>
                      <th style="text-align: left;width: 120px;">Reason:</th>
                      <td>'.$data['reason_of_inquiry'].'</td>
                    </tr>
                     <tr>
                      <th style="text-align: left;width: 120px;">Subject:</th>
                      <td>'.$data['subject'].'</td>
                    </tr>
                     <tr>
                      <th style="text-align: left;width: 120px;">Message:</th>
                      <td>'.$data['message'].'</td>
                    </tr>
                  </table>';

        ContactUsMail($message);

        if ($this->common->send_contact_form($data)) {
            echo true;
        } else {
            echo false;
        }
    }

}
