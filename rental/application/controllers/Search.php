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
        //define('DEFAULT_LAYOUT','front_end');
        $this->load->model('Listings_model', 'listing', true);
        set_extra_js("ComponentsPickers.init();");
        set_extra_js("ComponentsjQueryUISliders.init();");
        $this->load->library('Ajax_pagination');
        $this->perPage = 4;
		
        
    }
    
    public function index()
    {

    //    echo 'index';
        $data = array();
        
        
        
        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) {
            add_css(array(
                'light.css'
            ));
            add_js(array(
                'jquery.slimscroll.min.js'
            ));
            $data['topmenu'] = "session_topmenu";
        }
        //$this->load->helper('form');
        //Pagination starts 
        add_css(array(
            'owl.carousel.css',
            'jquery.mb.YTPlayer.min.css',
            'style.css',
            'demo.css',
            'set2.css',
            'bootstrap-select.css'
        ));
        add_js(array(
            'owl.carousel.min.js',
            'general.js',
            'parallax.min.js',
            'jquery.nicescroll.js',
            'jquery.ui.touch-punch.min.js',
            'jquery.mb.YTPlayer.min.js',
            'SmoothScroll.js',
            'script.js',
            'components-jqueryui-sliders.js',
            'bootstrap-select.js',
			'CustomGoogleMapMarker.js',
			'jquery.sticky.js'
        ));
		
		
        
        //total rows count
        $totalRec = $this->listing->get_listing_for_search_page()->num_rows();
        
        //pagination configuration
        $config['first_link']  = 'FIRST';
        $config['div']         = 'search_results'; //parent div tag id
        $config['base_url']    = site_url('search/results');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['cur_page']    = 1;
		
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['listings']           = $this->listing->get_listing_for_search_page(array('limit'=>$this->perPage))->result();
      	//echo $this->db->last_query();
		$i=0;
		$positions = array();
		$listing_review = array();
                $minprice = array(5);
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
                                
                                //Geting min price from filtered results
                                $minprice[] = $listing->price;
		
		}
		$data['reviews']=$listing_review;
		$data['positions']=$positions;
                $minprice = min($minprice);
 
         $data['links'] = $this->ajax_pagination->create_links();
        //load the view
        $data['search_img'] = $this->config->item('search_img');
        $data['abs_path'] = $this->config->item('abs_path');
		
        $data['map_img'] = $this->config->item('map_img');
        $data['home_types'] = $this->listing->home_types_search();
        $data['room_types'] = $this->listing->room_types_search();
        $data['amenities']  = $this->listing->amenities();
        
        //Title and meta description 
        $location = ucwords($this->input->get_post('location'));
        if ($location != NULL) {
            $this->seo->SetValues('Title', "$location Vacation Rentals & Short Term Rentals - luxus");
            $this->seo->SetValues('Description', "Rent from people in $location from $$minprice/night. Find unique places to stay with local hosts in 190 countries. Belong anywhere with luxus");
        } else {
            $this->seo->SetValues('Title', 'luxus Search');
            $this->seo->SetValues('Description', "Find the perfect place to stay at an amazing price in 190 countries. Belong anywhere with luxus");
        }

        $this->load->view('templates/header');
        $this->load->view('front_end/search', $data);
        $this->load->view('templates/footer');
     }
    
    public function results()
    {
        
        
        $data = array();
        
        if ($this->session->userdata('logged_in')) {
            add_css(array(
                'light.css'
            ));
            add_js(array(
                'jquery.slimscroll.min.js'
            ));

        }

        add_css(array(
            'owl.carousel.css',
            'jquery.mb.YTPlayer.min.css',
            'style.css',
            'demo.css',
            'set2.css',
            'bootstrap-select.css'
        ));
        add_js(array(
            'owl.carousel.min.js',
            'general.js',
            'parallax.min.js',
            'jquery.nicescroll.js',
            'jquery.ui.touch-punch.min.js',
            'jquery.mb.YTPlayer.min.js',
            'SmoothScroll.js',
            'script.js',
            'components-jqueryui-sliders.js',
            'bootstrap-select.js'
        ));
 
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
        $config['div']         = 'search_results'; //parent div tag id
        $config['base_url']    = site_url('search/results');
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



		$data['links'] = $this->ajax_pagination->create_links();
        $data['search_img'] = $this->config->item('search_img');
        $data['map_img'] = $this->config->item('map_img');
        $data['abs_path'] = $this->config->item('abs_path');
		
        $data['home_types'] = $this->listing->home_types_search();
        $data['room_types'] = $this->listing->room_types_search();
        $data['amenities']  = $this->listing->amenities();
        
        //load the view
        if($this->input->get('ajax')) {
			$this->load->view('front_end/search_results', $data);
		}else{
			$this->load->view('templates/header');
			$this->load->view('front_end/search_results', $data);
			$this->load->view('templates/footer');
		}
     }
    
}
