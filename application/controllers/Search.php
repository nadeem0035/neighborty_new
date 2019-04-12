<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Search class.
 *
 * @extends CI_Controller
 */
class Search extends CI_Controller
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
        $this->load->model('Listings_model', 'listing', true);
        $this->load->model('Common_model', 'cities', true);
        $this->load->helper('my_date_helper');
        $this->load->library('Ajax_pagination');

        if (($_COOKIE['sw'] >= 1140 && $_COOKIE['sw'] <= 1600)) { $this->perPage = 20;}else{$this->perPage = 20;}



       // $this->output->enable_profiler(FALSE);
    }

    public function index()
    {


        $data = array();
        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) {
            add_css(array('light.css'));
            $data['topmenu'] = "session_topmenu";
        }

        // $this->benchmark->mark('search_start');

        $data['search_img'] = $this->config->item('search_img');
        $data['abs_path'] = $this->config->item('abs_path');

        add_css('select2.min.css');
        add_js(array('custom_maps.js','jquery.validate.min.js','general.js','CustomGoogleMapMarker.js'));
        $city =  $this->input->get_post('city');
        if($city){
            set_extra_js("$('#search_city').select2().val($city).trigger('change.select2') ");
        }else{
            set_extra_js("$('#search_city').select2().val(3).trigger('change.select2') ");
        }
        $data['cities'] = $this->common->getAllContent("*", 'cities');
        $type_listing= $this->input->get_post('type');
        $is_ajax= $this->input->get_post('ajax');
        $sorting = $this->input->get_post('sort_type');
        $totalRec = $this->listing->get_listing_for_search_page(array(),null,'publish')->num_rows();
      //  $totalRec = 100;
        $config['first_link']  = 'FIRST';
        $config['div']         = 'search_results';
        $config['base_url']    = site_url('search/results');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['cur_page']    = 1;
        $this->ajax_pagination->initialize($config);
        $data['links'] = $this->ajax_pagination->create_links();
        $data['listings'] = $this->listing->get_listing_for_search_page(array('limit'=>$this->perPage),$sorting,'publish',null,null)->result();

        if(empty($data['listings'])){

            //echo 'PODdsad';die;

            $lat = $_COOKIE['lat'];
            $lng = $_COOKIE['lng'];
            $data['listings'] = $this->listing->get_listing_for_search_page(array('limit'=>$this->perPage),$sorting,'publish',$lat,$lng)->result();

            if(empty($data['listings'])){
                $data['listings'] = $this->listing->getFeaturedListings(20)->result();

            }

        }

        $minprice = array(5);
        $minprice = min($minprice);
        $data['search_img'] = $this->config->item('property_images');
        $data['abs_path'] = $this->config->item('abs_path');
        $data['map_img'] = $this->config->item('map_img');
        $data['home_types'] = $this->listing->home_types_search();
        $data['amenities']  = $this->listing->amenities();
        $data['page_view'] = $this->input->get_post('page_view');
        $data['total_listings'] = $totalRec;
        $data['type']=$type_listing;

       // $data['premium_listings'] = $this->listing->getPremiumListings();
        $data['premium_listings'] = $this->listing->get_listing_for_search_page(array('limit'=>5),$sorting,'premium')->result();

        $location = ucwords($this->input->get_post('location'));
        if ($location != NULL) {
            $this->seo->SetValues('Title', "$location Vacation Rentals & Short Term Rentals - zoney.pk");
            $this->seo->SetValues('Description', "Rent from people in $location from $minprice. Find unique places to stay with local hosts in 190 countries. Belong anywhere with Zoney.pk");
        }
        else {
            $this->seo->SetValues('Title', 'Search results');
            $this->seo->SetValues('Description', "Find the perfect place to stay at an amazing price in 190 countries. Belong anywhere with zoney.pk");
        }

        if($is_ajax == 1){

            return $this->load->view('includes/search_partial', $data);

        }
        else{

           // echo 'dadadfafsd';
            $this->load->view('templates/header');
            $this->load->view('front_end/search_list', $data);
            $this->load->view('templates/footer');
            //  $this->benchmark->mark('search_end');
        }

    }

    public function results()
    {
        // echo $this->input->get_post('sort_type');
       // echo 'back to results';
       // die;
        $data = array();
        // add_css('select2.min.css');

        $page = $this->input->get_post('page');

        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        $totalRec = $this->listing->get_listing_for_search_page(array(),null)->num_rows();

        $config['div']         = 'search_results'; //parent div tag id
        $config['base_url']    = site_url('search/results');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['cur_page']    = 2;

        $this->ajax_pagination->initialize($config);

        $data['listings']  = $this->listing->get_listing_for_search_page(array('start'=>$offset,'limit'=>$this->perPage),null)->result();

        $this->session->set_userdata('some_name', $data['positions']);
        $data['search_img'] = $this->config->item('search_img');
        $data['abs_path'] = $this->config->item('abs_path');
        $data['map_img'] = $this->config->item('map_img');
        $data['amenities']  = $this->listing->amenities();
        $data['links'] = $this->ajax_pagination->create_links();


        if($this->input->get_post('ajax')) {

            $data['type']=$this->input->get_post('listing_type');
            $data['page_view'] = $this->input->get('page_view');
            $this->load->view('includes/search_partial', $data);

        }else{

            $this->load->view('templates/header');
            $this->load->view('front_end/search_results', $data);
            $this->load->view('templates/footer');
        }
    }



    public function listingsWithMap()
    {


        $data = array();
        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) {
            add_css(array('light.css'));
            $data['topmenu'] = "session_topmenu";
        }

       // $this->benchmark->mark('search_start');

        $data['search_img'] = $this->config->item('search_img');
        $data['abs_path'] = $this->config->item('abs_path');

        add_css('select2.min.css');
        add_js(array('custom_maps.js','jquery.validate.min.js','general.js','CustomGoogleMapMarker.js'));
        set_extra_js("    loadSearchMap()");

        $data['cities'] = $this->common->getAllContent("*", 'cities');
        $type_listing= $this->input->get_post('type');
        $flag= $this->input->get_post('flag');
        $is_ajax= $this->input->get_post('ajax');
        $sorting = $this->input->get_post('sort_type');
        $i=0;
        $positions = array();

        $totalRec = $this->listing->get_listing_for_search_page(array(),null,'publish')->num_rows();


        $config['first_link']  = 'FIRST';
        $config['div']         = 'search_results';
        $config['base_url']    = site_url('search/results');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['cur_page']    = 1;
        $this->ajax_pagination->initialize($config);
        $data['links'] = $this->ajax_pagination->create_links();

        $data['listings'] = $this->listing->get_listing_for_search_page(array('limit'=>$this->perPage),$sorting,'publish')->result();
        $data['premium_listings'] = $this->listing->get_listing_for_search_page(array('limit'=>5),$sorting,'premium')->result();
        foreach ($data['listings'] as $key => $listing) {

            $result[$key] = $listing->price;
            if ($i == 0) {
                $positions = array($listing->listid . "," . $listing->latitude . "," . $listing->longitude . "," . restyle_number($listing->price). "," . $listing->property_type. "," . $listing->active);
            } else {
                array_push($positions, $listing->listid . "," . $listing->latitude . "," . $listing->longitude . "," . restyle_number($listing->price). "," . $listing->property_type ."," . $listing->active);
            }
            $i++;
            $data['min'] = min($result);
            $data['max'] = max($result);
            $minprice[] = $listing->price;
        }


        //pr($positions);

        $minprice = array(5);

        $data['positions']=$positions;

        $minprice = min($minprice);

        $data['search_img'] = $this->config->item('property_images');
        $data['abs_path'] = $this->config->item('abs_path');
        $data['map_img'] = $this->config->item('map_img');
        $data['home_types'] = $this->listing->home_types_search();
        $data['amenities']  = $this->listing->amenities();
        $data['page_view'] = $this->input->get_post('page_view');
        $data['total_listings'] = $totalRec;
        $data['type']=$type_listing;
        $data['flag']=$flag;
        $location = ucwords($this->input->get_post('location'));
        if ($location != NULL) {
            $this->seo->SetValues('Title', "$location Vacation Rentals & Short Term Rentals - zoney.pk");
            $this->seo->SetValues('Description', "Rent from people in $location from $minprice. Find unique places to stay with local hosts in 190 countries. Belong anywhere with Zoney.pk");
        }
        else {
            $this->seo->SetValues('Title', 'Search results');
            $this->seo->SetValues('Description', "Find the perfect place to stay at an amazing price in 190 countries. Belong anywhere with zoney.pk");
        }

       if($is_ajax == 1){

          // $this->load->view('templates/header');
           $this->load->view('front_end/search_with_map', $data);
          // $this->load->view('templates/footer');

            //return $this->load->view('includes/search_partial', $data);
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('front_end/search', $data);
            $this->load->view('templates/footer');
          //  $this->benchmark->mark('search_end');
        }




    }

    public function listWithMapsAjax()
    {

       // echo 'listWithMapsAjax';

        $data = array();
        add_css(array(
            'light.css','set2.css','jquery.fancybox.css',
            'owl.carousel.css',
            'jquery.mb.YTPlayer.min.css',
            'style.css',
            'demo.css',
            'set2.css',
            'bootstrap-select.css'
        ));
        add_js(array(
            'jquery.fancybox.js',
            'owl.carousel.min.js',
            'general.js',
            'parallax.min.js',
            'jquery.nicescroll.js',
            'jquery.ui.touch-punch.min.js',
            'jquery.mb.YTPlayer.min.js',
            'SmoothScroll.js',
            'script.js',
            'custom_maps.js',
            'components-jqueryui-sliders.js',
            'bootstrap-select.js',
            'jquery.slimscroll.min.js'
        ));
        set_extra_js("$(\"body\").on(\"click\", \".fancybox\",function() {
            var id = $(this).attr('id');
           // alert(id);
            $(\"#ajaxFancyBox\").load(site_url + \"listings/listing_images?gallery=\"+id, function() {
                $(\".fancybox_gallery\").fancybox({
                    'padding': 0,
                    helpers : {
                        title   : {
                            type: 'outside'
                        },
                        thumbs  : {
                            width   : 50,
                            height  : 50
                        }
                    }
                });
                $(\".fancybox_gallery\").first().trigger('click');
            });// load
            return false;
            $.fancybox(this); // << CHANGED THIS
        });

");

        $page = $this->input->get_post('page');

       // echo $page;

        if(!$page || $page == 0){
            $offset = 0;
        }else{
            $offset = $page;
        }
        $sorting = $this->input->get_post('sort_type');
       // $totalRec =$this->listing->get_listing_for_search_page()->num_rows();
        //$totalRec=200;
        $totalRec = $this->listing->get_listing_for_search_page(array(),null)->num_rows();

        $config['div']         = 'search_results'; //parent div tag id
        $config['base_url']    = site_url('search/listWithMapsAjax');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['cur_page']    = 2;

        $this->ajax_pagination->initialize($config);

        $data['listings']  = $this->listing->get_listing_for_search_page(array('start'=>$offset,'limit'=>$this->perPage),$sorting)->result();


        $i=0;
        $positions = array();

        foreach ($data['listings'] as $listing){
            if($i==0){

                $positions = array($listing->listid."," . $listing->latitude . "," . $listing->longitude . "," . restyle_number($listing->price). "," . $listing->property_type. "," . $listing->active);

            }else{
                array_push($positions, $listing->listid . "," . $listing->latitude . "," . $listing->longitude . "," . restyle_number($listing->price). "," . $listing->property_type. "," . $listing->active);
            }

            $i++;
        }


        $data['positions']=$positions;
        $data['search_img'] = $this->config->item('search_img');
        $data['abs_path'] = $this->config->item('abs_path');
        $data['map_img'] = $this->config->item('map_img');
        //$data['home_types'] = $this->listing->home_types_search();
        $data['amenities']  = $this->listing->amenities();
        $data['links'] = $this->ajax_pagination->create_links();



        if($this->input->get_post('ajax')) {

           // echo 'ajax';

            $data['type']=$this->input->get_post('listing_type');
            $data['page_view'] = $this->input->get('page_view');
           // $this->load->view('front_end/filtered_search_results', $data);
          $this->load->view('includes/list_with_maps_partial', $data);

        }else{

           // echo 'non';
            $this->load->view('templates/header');
            $this->load->view('front_end/search_results', $data);
            $this->load->view('templates/footer');
        }
    }



    function results_map() {
        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) {
            add_css(array(
                'light.css'
            ));
            add_js(array(
                'custom_maps.js',
                'jquery.slimscroll.min.js'
            ));

        }

        set_extra_js("$(\"body\").on(\"click\", \".fancybox\",function() {
            var id = $(this).attr('id');
           // alert(id);
            $(\"#ajaxFancyBox\").load(site_url + \"listings/listing_images?gallery=\"+id, function() {
                $(\".fancybox_gallery\").fancybox({
                    'padding': 0,
                    helpers : {
                        title   : {
                            type: 'outside'
                        },
                        thumbs  : {
                            width   : 50,
                            height  : 50
                        }
                    }
                });
                $(\".fancybox_gallery\").first().trigger('click');
            });// load
            return false;
            $.fancybox(this); // << CHANGED THIS
        });

");


        $page = $this->input->get('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        //total rows count
        $totalRec =$this->listing->get_listing_for_search_page()->num_rows();

        //pagination configuration
        $config['first_link']  = 'FIRST';
        $config['div']         = 'results_map'; //parent div tag id
        $config['base_url']    = site_url('search/results_map');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['cur_page']    = 2;

        $this->ajax_pagination->initialize($config);

        //get the posts data
        $data['listings']           = $this->listing->get_listing_for_search_page(array('start'=>$offset,'limit'=>$this->perPage))->result();
        //echo $this->db->last_query();



        $i=0;
        $positions = array();
        $listing_review = array();
        foreach ($data['listings'] as $listing){
            if($i==0){
                $positions = array($listing->listid.",".$listing->latitude.",".$listing->longitude.",".$listing->price);
            }else{
                array_push($positions, $listing->listid.",".$listing->latitude.",".$listing->longitude.",".$listing->price);
            }
            //$data['positions'].=$listing->latitude.",".$listing->longitude;
            $review= $this->listing->get_listing_review($listing->listid);
            //echo $this->db->last_query();
            if($review){
                $listing_review[$listing->listid]['rating']=round($review->rating, 2)*20;
                $listing_review[$listing->listid]['total']=$review->total;
            }else{
                $listing_review[$listing->listid]['rating']=0;
                $listing_review[$listing->listid]['total']=0;

            }
            $i++;

        }
        $data['reviews']=$listing_review;
        $data['positions']=$positions;

        $data['mapjs']=true;

        $data['links'] = $this->ajax_pagination->create_links();
        $data['search_img'] = $this->config->item('search_img');
        $data['map_img'] = $this->config->item('map_img');
        $data['abs_path'] = $this->config->item('abs_path');

        $data['home_types'] = $this->listing->home_types_search();
        // $data['room_types'] = $this->listing->room_types_search();
        $data['amenities']  = $this->listing->amenities();

        $this->load->view('templates/header');
        $this->load->view('front_end/results_map', $data);
        $this->load->view('templates/footer');
    }

    public function sort_listing()
    {
        $type_listing= $this->input->get('type');
        $sorting = $this->input->post('sorttype');
        //  $property_type = $this->input->post('ptype');

        if($sorting != ''){

            $data['listings'] = $this->listing->sort_listings($sorting)->result();
            $data = $this->load->view('includes/search_partial', $data);
            echo $data;

        }


    }

}
