<?php
if( !defined('BASEPATH') ) exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class Dashboard extends CI_Controller
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
        $this->load->model('Dashboard_model');
        $this->load->model('Home_model', 'home', true);
        $this->load->model('Listings_model');
        $this->load->model('Reviews_model');
        $session_data = $this->session->userdata('logged_in');
        $this->seo->SetValues('Title', ucfirst($session_data['full_name']) . "'s Dashboard");
    }

    function index()
    {

        if ($this->session->userdata('logged_in'))
        {

            $this->load->model('Inbox_model');
            $this->load->model('Reviews_model');
            $this->load->model('Wishlists_model');
            $this->load->helper('my_date');
            $this->load->library('chart/Chartphp');

            $data = new stdClass();
            $utmp = array();
            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];
            $utype = $session_data['user_type'];

            add_css(array('set2.css','light.css', 'chartphp.css'));
            add_js(array('jquery.validate.min.js','custom_maps.js','autocomplete_map.js','jquery.slimscroll.min.js', 'chartphp.js', 'dashboard.js', 'general.js'));
            //set_extra_js("Metronic.initSlimScroll('.slimScrollDiv');");

            $data->search_img = $this->config->item('search_img');
            $data->map_img = $this->config->item('map_img');
            $data->abs_path = $this->config->item('abs_path');


            $data->messages_count = $this->Inbox_model->unread_message_count($uid);
           // $data->reviews_to = $this->Reviews_model->reviews_about_you($uid);
         //   $data->count_reviews = $this->Reviews_model->count_reviews_about_you($uid);
            $data->users_avatar = $this->config->item('users_avatar');
            $data->folder = 'small';
            $data->recent_chats = $this->Inbox_model->get_inbox($uid);
            $data->sales = $this->Dashboard_model->sales($uid);
            $data->month_revenue = $this->Dashboard_model->month_revenue($uid, date("Y-m-d"));
            $data->totalWishlists = $this->Wishlists_model->getUserWishlistscount($uid);
            $data->BookingDetails = $this->Dashboard_model->BookingDetails($uid);
            $data->uid = $uid;

//            $chart = new chartphp();
//            $chart->data = array($this->chartData($uid));
//            $chart->chart_type = "bar";
//            $chart->options["axes"]["yaxis"]["tickOptions"]["prefix"] = '$';
//            $chart->title = " ";
//            $chart->xlabel = " ";
//            $chart->ylabel = " ";
//            $chart->options["legend"]["show"] = true;
//            $chart->series_label = array('Q1', 'Q2', 'Q3', 'Q4');
//            $chart->color = "#9d7f48";
//            $chart->export = false;
//            $data->chart = $chart->render('c1');

            $this->load->view('templates/header');

            if($utype == 'Agent'){

                $data->reviews_to = $this->Reviews_model->reviews_about_you($uid);
                $data->reviews_by = $this->Reviews_model->reviews_by_you($uid);
                $data->latest_home= $this->home->latest_listings_by_agent($uid);
                //$data->latest_home= $this->home->latest_viewed_listings_by_renter($uid);
                $data->appointments = $this->Listings_model->get_agent_appointments($uid);
                $this->load->view('dashboard/agent_dashboard', $data);


            }elseif ($utype == 'Renter'){
                $data->latest_veiwed= $this->home->latest_viewed_listings_by_renter($uid);
                //$data->latest_home= $this->home->latest_homes();
                $data->reviews_by = $this->Reviews_model->reviews_by_you($uid);
                $data->appointments = $this->Listings_model->userAppointments($uid);
                $this->load->view('dashboard/renter_dashboard', $data);


            }else{

                $data->reviews_to = $this->Reviews_model->reviews_about_you($uid);
                $data->reviews_by = $this->Reviews_model->reviews_by_you($uid);
                $data->latest_home= $this->home->latest_viewed_listings_by_renter($uid);
                $data->appointments = $this->Listings_model->get_agent_appointments($uid);

                //$data->latest_home= $this->home->latest_homes();
                $this->load->view('dashboard/dashboard', $data);

            }


            $this->load->view('templates/footer');
            $this->load->view('dashboard/upcoming_trips', $utmp);
        }
        else
        {
            redirect('/');
        }

    }






    function chartData($uid)
    {

        for ($i = 8; $i >= 0; $i--)
        {
            $date = date("Y-m-01", time() - $i * 31 * 3600 * 24);
            $dataArray[] = array(date('M', strtotime($date)), intval($this->Dashboard_model->month_revenue($uid, $date)));
        }
        return $dataArray;
    }

    public function contactHost()
    {
        $this->load->model('Common_model', 'common', true);
        $data = new stdClass;
        $bid = $this->input->post('bid');
        $data->booking = $this->common->get_row_with_specific_data("id,listing_id,check_in,check_out,total_guest", 'booking', 'id', (int) $bid);
        $data->users_avatar = $this->config->item('users_avatar');
        $data->listing = $this->common->get_row_with_specific_data("*", 'listing', 'id', (int) $data->booking->listing_id);
        $data->userdetail = $this->common->get_row_with_specific_data("*", 'users', 'id', (int) $data->listing->user_id);
        $this->load->view('dashboard/contacthostdashboardmodel', $data);
    }


}
