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
        $this->load->model('common_model', 'common', true);
        $this->load->model('Listings_model', 'listing', true);
        $this->load->model('Home_model', 'home', true);
        $this->load->model('Agents_model', 'agents', true);
       // $this->load->model('Blog_model', 'blog', true);
        setlocale(LC_MONETARY,"en_US");
        //set_extra_js("ComponentsPickers.init();");

    }




    public function index() {

        $data = new stdClass();
        $data->topmenu = "index_menu";
        if ($this->session->userdata('logged_in')) {
            add_css(array());
            add_js(array());
            $data->topmenu = "index_account_menu";
        }
        add_css(array());
        add_js(array('jquery.validate.min.js','custom_maps.js','general.js'));
        set_extra_js(" $('#search_city').select2().val(3).trigger('change.select2') ");
       /* $this->seo->SetValues('Title', 'The most complete real estate platform in Pakistan - zoney.pk');
        $this->seo->SetValues('Description', "Apartment for rent, Rent apartment, house, find house for sale, find real estate agent, go real estate agent, build your rental record, buy a house or apartment");
    */    $this->load->view('templates/header');
        $data->preview_img = $this->config->item('listing_images');
        $data->ins_img = $this->config->item('ins_img');


        $data->cities = $this->common->getAllContent("*", 'cities');

        $data->featured_sale = $this->listing->featured_listings_by_type('sale');
        $data->featured_rent = $this->listing->featured_listings_by_type('rent');
        $data->premium_listings = $this->listing->getPremiumListings();


       // $data->blogs = $this->blog->getPosts();
        $data->seo_text = $this->common->getAllContent('*', 'seo_text');


        $data->rent_stats = $this->listing->city_stats('rent');
        $data->sales_stats = $this->listing->city_stats('sale');

        $data->users_avatar   = $this->config->item('users_avatar');
       // pre($data);
        $this->load->view('front_end/index', $data);
        $this->load->view('templates/footer');
    }

    public function rent(){
        $data = new stdClass();
        $data->topmenu = "index_menu";
        if ($this->session->userdata('logged_in')) {
            add_css(array());
            add_js(array());
            $data->topmenu = "index_account_menu";
        }


        add_css(array());
        add_js(array('jquery.validate.min.js','custom_maps.js','general.js'));



        $data->preview_img = $this->config->item('listing_images');
        $data->ins_img = $this->config->item('ins_img');
        $data->featured_rental = $this->listing->featured_listings_by_type('rent');
        $data->featured_sale = $this->listing->featured_listings_by_type('sale');
        $data->users_avatar   = $this->config->item('users_avatar');
        if ($this->uri->segment(1) == 'rent'){
            $this->seo->SetValues('Title', "Rent - Neighborty");
        }else{
            $this->seo->SetValues('Title', "Buy - Neighborty");
        }
        $this->load->view('templates/header');
        $this->load->view('front_end/rent_buy', $data);
        $this->load->view('templates/footer');
    }

    public function contact() {


        $data = new stdClass();
        $data->topmenu = "topmenu";
        if ($this->session->userdata('logged_in')) {
            add_css(array(''));
            add_js(array(''));
            $data->topmenu = "session_topmenu";
        }
        add_css(array('select2.min.css'));
        //add_js(array());
        add_js(array('select2.min.js','jquery.validate.min.js','general.js'));
        set_extra_js("$(\"#contactus_form\").validate({
    focusInvalid: false,
    submitHandler: function (form) {
        var data = $('#contactus_form').serialize();
        var url = site_url + 'Index/contact_form/';
        $.ajax({
            type: \"POST\",
            cache: false,
            url: url,
            data: data,
            success: function (result) {
                if (result) {
                    $(\"#res_mesg\").html('<div class=\"alert alert-success\"><button class=\"close\" data-dismiss=\"alert\"></button> Your Message sent successfully.</div>');
                    // $('#contactus_form').trigger(\"reset\");
                } else {
                    $(\"#res_mesg\").html('<div class=\"alert alert-danger\"><button class=\"close\" data-dismiss=\"alert\"></button> Something wrong.Please try again.</div>');
                }
            },
            async: true
        });
        return false;
    }
});
");
        $data->home_types = $this->listing->home_types_search();
        $data->amenities  = $this->listing->amenities();


        $this->seo->SetValues('Title', "Contact Us - Neighborty");
        $data->countries = $this->common->countries();
        $this->load->view('templates/header');
        $this->load->view('front_end/contactus', $data);
        $this->load->view('templates/footer');
    }



    function contact_form() {
        $UserData = array();
        $subject ='New Message From Zoney.pk';
        $UserData['poster_name'] = $this->input->post('fullname');
        $UserData['poster_email'] = $this->input->post('email');
        $UserData['poster_phone'] = $this->input->post('phone');
        $UserData['poster_country'] = $this->input->post('country');
        $UserData['poster_reason_of_inq'] = $this->input->post('reason_of_inq');
        // $UserData['subject'] = $this->input->post('subject');
        $UserData['poster_message'] = $this->input->post('message');
        $to = $this->input->post('email');
        $subject = 'New message from Zoney';
        $view = 'contact-form-submission-user';
        sendEmail($to, $subject, $UserData, $view);

        $UserData = array();
        $subject ='New Message From Zoney.pk';
        $UserData['poster_name'] = $this->input->post('fullname');
        $UserData['poster_email'] = $this->input->post('email');
        $UserData['poster_phone'] = $this->input->post('phone');
        $UserData['poster_country'] = $this->input->post('country');
        $UserData['poster_reason_of_inq'] = $this->input->post('reason_of_inq');
       // $UserData['subject'] = $this->input->post('subject');
        $UserData['poster_message'] = $this->input->post('message');
        $to = 'info@zoney.pk';
        $subject = 'New message from Zoney';
        $view = 'contact-form-submission';
        if (sendEmail($to, $subject, $UserData, $view)) {
             echo 1;
         } else {
             echo 0;
         }
    }


    public function contact_renter() {


        $data = new stdClass();
        $data->topmenu = "topmenu";
        if ($this->session->userdata('logged_in')) {
            add_css(array(''));
            add_js(array(''));
            $data->topmenu = "session_topmenu";
        }
        add_css(array());
        //add_js(array());
        add_js(array('jquery.slimscroll.min.js','jquery.validate.min.js','general.js'));
        $data->home_types = $this->listing->home_types_search();
        $data->amenities  = $this->listing->amenities();


        $this->seo->SetValues('Title', "Contact Us - Neighborty");
        $data->countries = $this->common->countries();
        $this->load->view('templates/header');
        $this->load->view('front_end/contact_renter', $data);
        $this->load->view('templates/footer');
    }

    public function contact_agents() {


        $data = new stdClass();
        $data->topmenu = "topmenu";
        if ($this->session->userdata('logged_in')) {
            add_css(array(''));
            add_js(array(''));
            $data->topmenu = "session_topmenu";
        }
        add_css(array());
        //add_js(array());
        add_js(array('jquery.slimscroll.min.js','jquery.validate.min.js','general.js'));
        $data->home_types = $this->listing->home_types_search();
        $data->amenities  = $this->listing->amenities();


        $this->seo->SetValues('Title', "Contact Us - Neighborty");
        $data->countries = $this->common->countries();
        $this->load->view('templates/header');
        $this->load->view('front_end/contact_agents', $data);
        $this->load->view('templates/footer');
    }


    function press() {
        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) {

            $data['topmenu'] = "session_topmenu";

            //} else {
            //    redirect('/login');
        }
        $this->seo->SetValues('Title', "Press Release - Neighborty");
        $this->load->view('templates/header');
        $this->load->view('front_end/press_release', $data);
        $this->load->view('templates/footer');
    }

    function pr_detail() {
        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) {

            $data['topmenu'] = "session_topmenu";

            //} else {
            //    redirect('/login');
        }
        $this->seo->SetValues('Title', "Press Release - Neighborty");
        $this->load->view('templates/header');
        $this->load->view('front_end/pr_detail', $data);
        $this->load->view('templates/footer');
    }



}
