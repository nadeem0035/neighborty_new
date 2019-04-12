<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class Agents extends CI_Controller {

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct() {

        parent::__construct();
        $this->load->model('Agents_model', 'agents', true);
        $this->load->model('Listings_model', 'listing', true);
        $this->load->model('Common_model', 'common', true);
        $this->load->model('Users_model', 'users', true);
        $this->load->model('Inbox_model', 'inbox', true);
        $this->load->helper('my_date_helper');
        $this->load->helper('text');
        $this->load->library('Ajax_pagination');
        $this->perPage = 20;
        $this->output->enable_profiler(FALSE);

    }

    function index() {

        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) {

            $data['topmenu'] = "session_topmenu";
        }

        $custom_js = 'loadAgentMap()';
        set_extra_js($custom_js);
        add_js(array('jquery.validate.min.js','general.js'));

        $data['home_types'] = $this->listing->home_types_search();
        $data['amenities']  = $this->listing->amenities();
        $data['users_avatar']  = $this->config->item('users_avatar');
        $data['agents'] = $this->agents->getAgentsList();
        $data['search_img'] = $this->config->item('search_img');
        $data['abs_path'] = $this->config->item('abs_path');
        $data['featured']  = $this->listing->FeaturedListings(3);
        $data['let_reviews'] = $this->agents->GetLetestReviews();

        $this->load->view('templates/header');
        $this->load->view('front_end/agents', $data);
        $this->load->view('templates/footer');
    }

    public function agent_finder()
    {
        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) {

            $data['topmenu'] = "session_topmenu";
        }

        add_css(array('select2.min.css'));
        add_js(array('select2.min.js','jquery.validate.min.js','custom_maps.js','general.js'));
        set_extra_js("$('.lng_agent').select2();");
        set_extra_js("$('.looking_for').select2();");
        set_extra_js('$("#find_professional_agents").find("a").click(function(e) {
                            e.preventDefault();
                            var section = $(this).attr("href");
                            $("html, body").animate({
                                scrollTop: $(section).offset().top
                            });
                        });');

        $this->load->view('templates/header');
        $this->load->view('front_end/agents-landing',$data);
        $this->load->view('templates/footer');
    }

    function AddReviews() {

        if ($this->session->userdata('logged_in')) {
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            $reviews = $this->input->post('reviews');
            $reviews['reviews_by'] = $uid;
            // $reviews['agent_id'] = $this->input->post('agent');

            if ($this->agents->AddAgentReviews($reviews)) {

                $user = $this->users->get_user($session_data_user['id']);
                $rec_id = $this->input->post('reviews[agent_id]');
                $array_data = array(
                    'user_id' => $session_data_user['id'],
                    'agent_id' => $rec_id,
                    'notification' => 'You have received review',
                    'notify_type' => 'reviews'
                );
                $this->inbox->add_notifcation($array_data);

                $user_to = $this->users->get_user($rec_id);
                $user_data = array();
                $user_data['poster_name'] = $user->first_name. ' ' .$user->last_name;
                $user_data['message'] = $this->input->post('reviews[review]');
                $user_data['review_title'] = $this->input->post('reviews[review_title]');
                $user_data['receiver_name'] = $user_to->first_name. ' ' .$user_to->last_name;
                $user_data['url'] = site_url("dashboard");
                $to = $user_to->email;
                $subject = 'Review recived';
                $view = 'write-review';
                sendEmail($to, $subject, $user_data, $view);

                $userto = $user->email;
                $subjectu = 'Review Published';
                $viewu = 'write-review-user';
                sendEmail($userto, $subjectu, $user_data, $viewu);

                echo 1;
            } else {
                echo 0;
            }
        }
    }

    function ApplyProperty() {

        if ($this->session->userdata('logged_in')) {


            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            $agent_id =$this->input->post('agent_id');

            $data['agent_id '] = $agent_id;
            $data['listing_id '] = $this->input->post('listing_id');
            $data['applicant_id '] = $this->input->post('applicant_id');
            $data['applicant_type '] = $this->input->post('applicant_type');
            $data['message '] = $this->input->post('message');
            $data['note_text '] = $this->input->post('note_text');

            if ($this->agents->ContactPropertyAgent($data)) {

                $array_data = array(
                    'user_id' => $session_data_user['id'],
                    'agent_id' => $this->input->post('agent_id'),
                    'notification' => 'You have received Application',
                    'notify_type' => 'applications'
                );
                $this->inbox->add_notifcation($array_data);


                $listde = $this->listing->get_list($this->input->post('listing_id'));
                $user = $this->users->get_user($session_data_user['id']);
                $rec_id = $this->input->post('agent_id');
                $user_to = $this->users->get_user($rec_id);
                $user_data = array();
                $user_data['list_id'] = $this->input->post('listing_id');
                $user_data['poster_name'] = $user->first_name. ' ' .$user->last_name;
                $user_data['receiver_name'] = $user_to->first_name. ' ' .$user_to->last_name;
                $user_data['slug'] = $listde->slug;
                $user_data['listing_name'] = $listde->listing_name;
                $to = $user_to->email;
                $subject = 'Application received from '.$user->first_name. ' ' .$user->last_name;
                $view = 'receive-application';
                sendEmail($to, $subject, $user_data, $view);

                $listde = $this->listing->get_list($this->input->post('listing_id'));
                $user = $this->users->get_user($session_data_user['id']);
                $user_data = array();
                $user_data['list_id'] = $this->input->post('listing_id');
                $user_data['poster_name'] = $user->first_name. ' ' .$user->last_name;
                $user_data['listing_name'] = $listde->listing_name;
                $user_data['slug'] = $listde->slug;
                $to = $user->email;
                $subject = 'Application Submitted';
                $view = 'submit-application';
                sendEmail($to, $subject, $user_data, $view);

                echo 1;
            }
            else {

                echo 0;
            }

        }
    }


    function detail() {


        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) { $data['topmenu'] = "session_topmenu";}
        add_css(array('jquery.raty.css', 'light.css'));
        add_js(array('jquery.slimscroll.min.js', 'moment.min.js', 'jquery.raty.js','jquery.validate.min.js','general.js','share.js','dashboard.js','CustomGoogleMapMarker.js','jquery.sticky.js'));
        set_extra_js("$('#knowledge').raty({ scoreName: 'reviews[knowledge]' });$('#expertise').raty({ scoreName: 'reviews[expertise]' });$('#responsiveness').raty({ scoreName: 'reviews[responsiveness]' });$('#negotiation_skills').raty({ scoreName: 'reviews[negotiation_skills]' });");

        set_extra_js('$("#listing").click(function() {
    $(\'html, body\').animate({
        scrollTop: $("#listing").offset().top
    }, 2000);
});');

        set_extra_js('$("#listing").click(function() {
    $(\'html, body\').animate({
        scrollTop: $("#listing").offset().top
    }, 2000);
});');

        set_extra_js('$("#team").click(function() {
    $(\'html, body\').animate({
        scrollTop: $("#team").offset().top
    }, 2000);
});');

        set_extra_js('$("#reviews-section").click(function() {
    $(\'html, body\').animate({
        scrollTop: $("#reviews-section").offset().top
    }, 2000);
});');

        set_extra_js('$("#recommend-section").click(function() {
    $(\'html, body\').animate({
        scrollTop: $("#recommend-section").offset().top
    }, 2000);
});');

        set_extra_js("
                $('.close_legend').click(function(){
                    $('#timeline-map-legend').toggle();
                });
        ");
        set_extra_js("google.maps.event.addDomListener(window, 'load', loadSearchMap);");
        set_extra_js("google.maps.event.addDomListener(window, 'load', loadSaleMap);");
        set_extra_js("google.maps.event.addDomListener(window, 'load', loadRentMap);");
        set_extra_js("google.maps.event.addDomListener(window, 'load', loadSoldMap);");

        $type = $this->input->get('type');
        $slug = $this->uri->segment(3);
        $sortby = $this->input->get('sortby');
        $id = explode('-', $slug);
        $agent_id = $id[count($id) - 1];
        $data['users_avatar']  = $this->config->item('users_avatar');
        $data['agent'] = $this->agents->getAgentDetail($agent_id);
        $sorting = $this->input->post('sorttype');
        $property_type = $this->input->post('ptype');
        $type='all';

        $data['listings'] = $this->agents->getAgentListings($type,$agent_id,$property_type,$sorting)->result();
        $total =  count($data['listings']);
        $data['sale'] = $this->agents->getAgentSaleListings($agent_id)->result();
        $data['rent'] = $this->agents->getAgentRentListings($agent_id)->result();
        $data['sold'] = $this->agents->getAgentSoldListings($agent_id)->result();

        //https://www.aspsnippets.com/Articles/Google-Maps-V3-Display-Colored-Markers-for-particular-type-of-location.aspx
        $i=0;
        $positions = array();

        foreach ($data['listings'] as $key => $listing) {

            $result[$key] = $listing->price;

            if ($i == 0) {
                $positions = array($listing->id . "," . $listing->latitude . "," . $listing->longitude . "," . restyle_number($listing->price). "," . $listing->property_type. "," . $listing->active);
            } else {
                array_push($positions, $listing->id . "," . $listing->latitude . "," . $listing->longitude . "," . restyle_number($listing->price). "," . $listing->property_type. "," . $listing->active);
            }
            $i++;
        }

        //setlocale(LC_MONETARY, 'en_IN');
        $data['min'] = min($result);
        $data['max'] = max($result);
        $data['positions']=$positions;
        $data['listings']->preview_image_url;
        $data['slug'] = $slug;
        $data['type'] = $type;
        $data['search_img'] = $this->config->item('search_img');
        $data['abs_path'] = $this->config->item('abs_path');
        $data['featured']  = $this->listing->FeaturedListings(3);

        set_extra_js('$("a[href^=\'#\']").click(function(e) {
                e.preventDefault();
            
                var position = $($(this).attr("href")).offset().top;
            
                $("body, html").animate({
                    scrollTop: position
                } /* speed */ );
            });
        ');
        set_extra_js("$('#myList li.list:lt(9)').show();
                            $('#showLess').hide();
                            var items =  $total;
                            var shown =  9;
                            $('#loadMore').click(function () {
                                $('#showLess').show();
                                shown = $('#myList li.list:visible').size()+6;
                                if(shown< items) { $('#myList li.list:lt('+shown+')').show();}
                                else { $('#myList li.list:lt('+items+')').show();
                                     $('#loadMore').hide();
                                }
                               
                            });
                            ");
        set_extra_js("$('#list_sale li.list:lt(9)').show();
                            $('#showLess').hide();
                            var items =  $total;
                            var shown =  9;
                            $('#loadMore').click(function () {
                                $('#showLess').show();
                                shown = $('#list_sale li.list:visible').size()+6;
                                if(shown< items) { $('#list_sale li.list:lt('+shown+')').show();}
                                else { $('#list_sale li.list:lt('+items+')').show();
                                     $('#loadMore').hide();
                                }
                               
                            });
                            ");
        set_extra_js("$('#list_rent li.list:lt(9)').show();
                            $('#showLess').hide();
                            var items =  $total;
                            var shown =  9;
                            $('#loadMore').click(function () {
                                $('#showLess').show();
                                shown = $('#list_rent li.list:visible').size()+6;
                                if(shown< items) { $('#list_rent li.list:lt('+shown+')').show();}
                                else { $('#list_rent li.list:lt('+items+')').show();
                                     $('#loadMore').hide();
                                }
                               
                            });
                            ");

        $data['teams']  =  $this->agents->getAllMembersByAgentId($agent_id);
        $review =  $this->agents->get_agent_review($agent_id);
        $data['reviews_all'] = $this->agents->get_agent_reviews_all((int) $agent_id);
        $data['recommendations'] = $this->agents->getAgentRecommendations((int) $agent_id);

        if ($review) {
            $data['rating'] = round($review->rating, 2) * 20;
            $data['total'] = $review->total;
        } else {
            $data['rating'] = 0;
            $data['total'] = 0;
        }

        $this->seo->SetValues('OgImg', base_url('assets/media/users_avatar/medium/'.$data['agent']->picture));
        $this->seo->SetValues('Title',  $data['agent']->first_name .' '.$data['agent']->last_name .' '.$data['agent']->agent_type.' ' .$data['agent']->city .' '.$data['agent']->state );
        $this->seo->SetValues('Address',  $data['agent']->city .' '.$data['agent']->state );
        $this->seo->SetValues('Description', ucfirst(substr($data['agent']->about, 0, 140)));


        $this->load->view('templates/header');
        $this->load->view('front_end/agent_detail', $data);
        $this->load->view('templates/footer');

    }



    public function propertiesFilter()
    {
        add_js(array('general.js','dashboard.js','CustomGoogleMapMarker.js'));

        $type =$this->input->post('ptype');
        $agent_id =$this->input->post('agent_id');

        $data['search_img'] = $this->config->item('search_img');
        $data['abs_path'] = $this->config->item('abs_path');

        $data['listings'] = $this->agents->getJoinedAgentListings($type,$agent_id,$type)->result();

        $i=0;
        $positions = array();

        foreach ($data['listings'] as $listing) {
            if ($i == 0) {
                $positions = array($listing->id . "," . $listing->latitude . "," . $listing->longitude . "," . $listing->price);
            } else {
                array_push($positions, $listing->id . "," . $listing->latitude . "," . $listing->longitude . "," . $listing->price);
            }
            $i++;
        }
        set_extra_js("$('#myList li.list:lt(9)').show();
                            $('#showLess').hide();
                            var items =  $total;
                            var shown =  9;
                            $('#loadMore').click(function () {
                                $('#showLess').show();
                                shown = $('#myList li.list:visible').size()+6;
                                if(shown< items) { $('#myList li.list:lt('+shown+')').show();}
                                else { $('#myList li.list:lt('+items+')').show();
                                     $('#loadMore').hide();
                                }
                               
                            });
                            ");
        $data['positions']=$positions;

        return $this->load->view('includes/agents/properties_filter',$data);

    }


    function searchByFilters($specil= null){

        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) {

            $data['topmenu'] = "session_topmenu";
        }

        $this->benchmark->mark('search_start');

        if ($specil == null) {

            add_js(array('jquery.validate.min.js', 'custom_maps.js', 'general.js'));
            $data['users_avatar'] = $this->config->item('users_avatar');
            $data['search_img'] = $this->config->item('search_img');
            $data['abs_path'] = $this->config->item('abs_path');
            $data['let_reviews'] = $this->agents->GetLetestReviews();
            $meta = array(
                'agent_location' => $this->input->get('agent_location'),
                'name' => $this->input->get('name'),
                'languages' => $this->input->get('languages'),
                'looking_for' => $this->input->get('type'),
                'home_type' => $this->input->get('home_type'),
                'price_min' => $this->input->get('price_min'),
                'price_max' => $this->input->get('price_max'),
                'street' => $this->input->get('street'),
                'city' => $this->input->get('city'),
                'state' => $this->input->get('state'),
                'state_code' => $this->input->get('state_code'),
                'country' => $this->input->get('country'),
                'zipcode' => $this->input->get('zipcode'),
            );

           // echo '<pre>';print_r($meta);
            $totalRec = count($this->agents->agentsSearch(array(),$meta));
            $config['first_link']  = 'FIRST';
            $config['div']         = 'agent_listing'; //parent div tag id
            $config['base_url']    = site_url('agents/results');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['cur_page']    = 1;
            $this->ajax_pagination->initialize($config);
            $data['agents'] =$this->agents->agentsSearch(array('limit'=>$this->perPage),$meta);
            $data['links'] = $this->ajax_pagination->create_links();
            $data['search_count'] = $totalRec;
            $data['advertisement'] = $this->common->get_latest_recrod('advertisements');
            $this->load->view('templates/header');
            $this->load->view('includes/agents/agent_search_results', $data);
            $this->load->view('templates/footer');

        } else {

            $data['agents'] = $this->agents->agentsSearchBySpecility($specil);
            $data['agents_count'] =  count($data['agents']);
            $data['featured_agents'] = $this->agents->getFeaturedAgents();
            $data['advertisement'] = $this->common->get_latest_recrod('advertisements');
            $this->load->view('templates/header');
            $this->load->view('includes/agents/agent_search_results', $data);
            $this->load->view('templates/footer');


        }
        $this->benchmark->mark('search_end');

    }

    function results()
    {
        $data = array();
        add_js(array('jquery.validate.min.js', 'custom_maps.js', 'general.js'));
        $data['users_avatar'] = $this->config->item('users_avatar');
        $data['search_img'] = $this->config->item('search_img');
        $data['abs_path'] = $this->config->item('abs_path');
        $meta = array(
            'agent_location' => $this->input->get('agent_location'),
            'name' => $this->input->get('name'),
            'languages' => $this->input->get('languages'),
            'looking_for' => $this->input->get('looking_for'),
            'home_type' => $this->input->get('home_type'),
            'price_min' => $this->input->get('price_min'),
            'price_max' => $this->input->get('price_max'),
            'street' => $this->input->get('street'),
            'city' => $this->input->get('city'),
            'state' => $this->input->get('state'),
            'state_code' => $this->input->get('state_code'),
            'country' => $this->input->get('country'),
            'zipcode' => $this->input->get('zipcode'),
        );
        $page = $this->input->get_post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        $totalRec = $this->agents->agentsSearch(array(),$meta);

       // $config['first_link']  = 'FIRST';
        $config['div']         = 'agent_listing'; //parent div tag id
        $config['base_url']    = site_url('agents/results');
        $config['total_rows']  = count($totalRec);
        $config['per_page']    = $this->perPage;
        $config['cur_page']    = 1;
        $this->ajax_pagination->initialize($config);


        $data['agents'] =$this->agents->agentsSearch(array('start'=>$offset,'limit'=>$this->perPage),$meta);

        //$data['agents'] =$this->agents->agentsSearch(array('limit'=>$this->perPage),$meta);


        $data['links'] = $this->ajax_pagination->create_links();
        $this->load->view('includes/agents/filtered_agents', $data);


    }

    public function teams()
    {

        if ($this->session->userdata('logged_in')) {

            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            $data = new stdClass();

            add_css(array('iziToast.css'));
            add_js(array('jquery.validate.min.js','autocomplete_map.js','iziToast.min.js','dashboard.js','custom_maps.js'));
            set_extra_js("loadAgentMap()");

            $data->members = $this->agents->getAllMembersByAgentId($uid);
            $data->for_team_members = $this->agents->getAllMembersForTeam($uid);
            $this->seo->SetValues('Title',  ' My team');
            $this->load->view('templates/header');
            $this->load->view('includes/agents/teams',$data);
            $this->load->view('templates/footer');
        }

        else{

            redirect(site_url('login'));
        }

    }

    public function postAgents()
    {
        if ($this->session->userdata('logged_in')) {

            $this->load->library('form_validation');
            $this->load->helper('security');

            $this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required|valid_email|is_unique[users.email]', array('is_unique' => 'This Email already exists. Please login.'));
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|xss_clean|required|min_length[4]');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|xss_clean|required|min_length[4]');
            $this->form_validation->set_rules('location', 'Location', 'trim|xss_clean|required');
            $this->form_validation->set_rules('designation', 'Designation', 'trim|xss_clean|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required|min_length[8]');

            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            }

            else{

                $session_data_user = $this->session->userdata('logged_in');
                $uid = $session_data_user['id'];

                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $username = ucfirst($this->input->post('first_name') .' '.$this->input->post('last_name'));

                $data = array(
                    'pid'=>$uid,
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'location' => $this->input->post('location'),
                    'agent_type' => $this->input->post('designation'),
                    'user_type' => 'Agent',
                    'active' => '1',
                    'password' => md5($this->input->post('password')),
                    'hash' => md5(uniqid(rand(), true))
                );

                if($this->agents->createAgent($data)){

                    $to = $email;
                    $subject = 'You have been added as a team member on Zoney.pk';
                    $user_data['name'] = $username;
                    $user_data['email'] = $email;
                    $user_data['password'] = $password;
                    $view = 'add_team';

                    sendEmail($to, $subject, $user_data, $view);

                    echo 'success';

                }else{

                    echo 'error';
                }

            }

        }
        else{

            redirect(site_url('login'));
        }

    }

    public function AddExistingTeamMember()
    {
        if ($this->session->userdata('logged_in')) {


            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];

            $member_id = $this->input->post('member_id');

            if($this->agents->add_new_member($uid,$member_id)){

                echo 'success';

            }else{

                echo 'error';
            }


        }
        else{

            redirect(site_url('login'));
        }

    }

    function all_agents() {
        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) {
            $data['topmenu'] = "session_topmenu";
        }
        $this->load->view('templates/header');
        $this->load->view('includes/agents/all_agents', $data);
        $this->load->view('templates/footer');
    }

    function getAgentMembers()
    {
        $data = new stdClass();


        if ($this->session->userdata('logged_in')) {

            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];

            $data->members = $this->agents->getAllMembersByAgentId($uid);

            $response = $this->load->view('includes/agents/agent_team',$data,TRUE);
            echo $response;



        }
    }

    function deleteAgent(){

        $session_data_user = $this->session->userdata('logged_in');
        $uid = $session_data_user['id'];
        $id = $this->input->post('id');
        $listings= $this->listing->get_user_all_listings($id);

        foreach ($listings as $list) {
            $data[] = array(
                'id' => $list->id,
                'user_id'=> $uid
            );
        }

        if($this->db->update_batch('listing', $data, 'id')){

            $this->agents->delete_agent($id);
            echo 'success';
        }


    }

    function updateAgentStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        if($this->agents->updateAgentStatus($id,$status)){
            echo 'success';
        }
        else{
            echo 'error';
        }
    }

    function userRecommendation()
    {

        $this->load->library('form_validation');
        $this->load->helper('security');

        $this->form_validation->set_rules('poster_email', 'Email', 'trim|xss_clean|required|valid_email');
        $this->form_validation->set_rules('poster_name', 'First Name', 'trim|xss_clean|required|min_length[3]');
        $this->form_validation->set_rules('recommendation', 'Last Name', 'trim|xss_clean|required|min_length[3]');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        }
        else {

            $agent_id = $this->input->post('agent_id');
            $data = array(
                'name' => $this->input->post('poster_name'),
                'email' => $this->input->post('poster_email'),
                'recommendation' => $this->input->post('recommendation'),
                'agent_id' => $this->input->post('agent_id'),
                'status' => 1
            );

            if($this->agents->insertRecommendation($data)){
                $rec_id = $this->input->post('agent_id');
                $user_to = $this->users->get_user($rec_id);
                $user_data = array();
                $user_data['receiver_name'] = $user_to->first_name. ' ' .$user_to->last_name;
                $user_data['url'] = site_url("dashboard");
                $to = $user_to->email;
                $subject = 'You have recived recommendation';
                $view = 'recommendation';
                sendEmail($to, $subject, $user_data, $view);
                echo '1';
            }else {
                echo '0';
            }


        }




    }

    public function payment()
    {

        if ($this->session->userdata('logged_in')) {

            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            //$data = new stdClass();
            add_js(array('jquery.validate.min.js','general.js','custom_maps.js','autocomplete_map.js'));
            $data['balance'] =  $this->common->get_row_with_specific_data('balance','topup_balance','agent_id',$uid);
            // $data['bookings'] = $this->common->getContentById('*','booking','user_id',$uid);

            $data['bookings'] = $this->agents->get_user_bookings($uid);



            $where = array('user_id' => $uid, 'package_type' => 'package');

            $data['latest'] = $this->common->get_latest_row_by_id('*','booking',$where);

            if(count($data['latest']) > 0){

                $id =$data['latest']->package_id;

                $data['current'] = $this->common->get_row_with_specific_data('*','packages','id',$id);

            }
            $this->seo->SetValues('Title', "Payment - Zoney");
            $this->load->view('templates/header');
            $this->load->view('includes/agents/payment',$data);
            $this->load->view('templates/footer');
        }

        else{

            redirect(site_url('login'));
        }

    }

    public function update_topup_balance()
    {
        $id =  $this->input->post('id');
        $data =  $this->agents->remainingTopUpBalance($id);

        if($this->agents->agent_topup_update($id)){

            if($data > 0){

                echo 'info';

            }else{

                echo 'owner';
            }
        }
        else{
            echo '0';
        }

    }

    public function showPhoneNumber()
    {
        $id = $this->input->post('id');
        $balance =  $this->agents->remainingTopUpBalance($id);


        if($balance <= 0){

            echo '<i class="fa fa-phone"></i> Neighborty.com';

        }
        else{

            $data = $this->common->get_row_with_specific_data('phone', 'users', 'id', $id);
            $this->agents->agent_topup_update($id);
            echo '<i class="fa fa-phone"></i>'.$data->phone;

            //Trigger low credit email when balance is $1

            if ($balance <= 1){



            }

        }

    }

    function agent_has_low_credit($id)
    {
        $user_to = $this->users->get_user($id);
        $user_data = array();
        $user_data['receiver_name'] = $user_to->first_name. ' ' .$user_to->last_name;
        $user_data['url'] = site_url("agents/payment");
        $to = $user_to->email;
        $subject = 'Credit limit email';
        $view = 'low-credit';
        sendEmail($to, $subject, $user_data, $view);

    }

    function agent_has_zero_crdit($id)
    {
        $user_to = $this->users->get_user($id);
        $user_data = array();
        $user_data['receiver_name'] = $user_to->first_name. ' ' .$user_to->last_name;
        $user_data['url'] = site_url("agents/payment");
        $to = $user_to->email;
        $subject = 'Low Credit email';
        $view = 'zero-credit';
        sendEmail($to, $subject, $user_data, $view);

    }

    function contant_agent()
    {
        if ($this->session->userdata('logged_in')) {

            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            $agent_id = $this->input->post('agent_id');

            $data['agent_id '] = $agent_id;
            $data['poster_name '] = $this->input->post('poster_name');
            $data['poster_email '] = $this->input->post('poster_email');
            $data['poster_phone '] = $this->input->post('poster_phone');
            $data['reason_to_contact '] = $this->input->post('reason_to_contact');
            $data['message '] = $this->input->post('message');


            if ($this->agents->contactAgent($data)) {

                $user_data = array();
                $user_data['poster_name'] = $this->input->post('poster_name');
                $user_data['poster_email'] = $this->input->post('poster_email');
                $user_data['poster_phone'] =  $this->input->post('poster_phone');
                $user_data['receiver_name'] = $this->input->post('agent_name');
                $user_data['message'] =  $this->input->post('message');

                //echo '<pre>';print_r($user_data);

                $to = $this->input->post('email');
                $subject = 'Contact inquiry from ' . $this->input->post('poster_name');
                $view = 'contact_agent';
                sendEmail($to, $subject, $user_data, $view);

                echo 'sent';

            } else {

                echo 'error';
            }

        }
    }

}
