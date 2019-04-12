<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class Users extends CI_Controller {


    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Agents_model', 'agents', true);
        $this->load->model('Common_model', 'common', true);
        $this->load->model('Listings_model', 'listings', true);
        $this->load->library('facebook/Facebook');
        $this->load->library('googleplus/Googleplus');
        $this->load->library('linkedin/LinkedIn');
        $this->load->model('Wishlists_model', 'wishlist', true);
        $this->load->model('Agents_model', 'agents', true);
        $this->seo->SetValues('Title', 'Log In / Sign Up to Zoney');
        $this->seo->SetValues('Description', "Browse and book, or list your space. It's easy!");

    }

    public function index() {

        redirect('/');
    }


    function user_profile() {


        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) { $data['topmenu'] = "session_topmenu";}
        add_css(array('jquery.raty.css', 'light.css'));
        add_js(array('jquery.slimscroll.min.js', 'moment.min.js', 'jquery.raty.js','jquery.validate.min.js','general.js','share.js','dashboard.js','jquery.sticky.js'));
        set_extra_js("$('#knowledge').raty({ scoreName: 'reviews[knowledge]' });$('#expertise').raty({ scoreName: 'reviews[expertise]' });$('#responsiveness').raty({ scoreName: 'reviews[responsiveness]' });$('#negotiation_skills').raty({ scoreName: 'reviews[negotiation_skills]' });");
        set_extra_js("
                $('.close_legend').click(function(){
                    $('#timeline-map-legend').toggle();
                });
        ");

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

        $data['min'] = min($result);
        $data['max'] = max($result);
        $data['positions']=$positions;
        //$data['listings']->preview_image_url;
        $data['slug'] = $slug;
        $data['type'] = $type;
        $data['search_img'] = $this->config->item('search_img');
        $data['abs_path'] = $this->config->item('abs_path');
        //$data['featured']  = $this->listing->FeaturedListings(3);

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
        $this->load->view('users/user_detail', $data);
        $this->load->view('templates/footer');

    }



    public function user_referral()
    {
        if(isset($_GET["code"]))
        {
             $_SESSION["referral"]=($_GET["code"]);
             redirect('signup');die();
        }


    }

    public function show($uid = NULL) {

       /* if ($this->session->userdata('logged_in')) {*/

            $this->load->model('Reviews_model');
            $this->load->model('References_model');
            $this->load->model('Listings_model');
            $this->load->model('Wishlists_model');
            $this->load->model('Common_model', 'common', true);
            $data = new stdClass();
            $user_detail = $this->Users_model->get_user($uid);


            if (empty($user_detail)) {
                redirect('/404_override');
            } else {
                $data->user = $user_detail;
            }

            add_css(array('light.css', 'bootstrap-wysihtml5.css', 'jquery.fancybox.css', 'inbox.css'));
            add_js(array('jquery.slimscroll.min.js', 'jquery.fancybox.pack.js', 'wysihtml5-0.3.0.js', 'bootstrap-wysihtml5.js', 'inbox.js'));

            $session_data = $this->session->userdata('logged_in');
            $suid = $session_data['id'];
            if ($uid == $suid) {
                $data->edit_profile = true;
            } else {
                $data->edit_profile = false;
            }
            $data->users_avatar = $this->config->item('users_avatar');
            //$data->reviews_to = $this->Reviews_model->reviews_about_you($uid);
            $data->reviews_by = $this->Reviews_model->reviews_by_you($uid);
            $data->search_img = $this->config->item('search_img');
            $data->abs_path = $this->config->item('abs_path');
            $data->wishlists = $this->Wishlists_model->renterwishlistDetails($uid);
            $data->listings = $this->agents->getJoinedAgentListings('all',$uid,'all','')->result();

            //Title and meta description
            $this->seo->SetValues('Title', $data->user->first_name . " " . $data->user->last_name . '\'Profile - Zoney');
            $this->seo->SetValues('Description', $data->user->first_name . " " . $data->user->last_name . " has been a member of zoney since " . date("F j, Y", strtotime($data->user->registered_date)));

            $this->load->view('templates/header');
            $this->load->view('users/view_profile', $data);
            $this->load->view('templates/footer');
       /* } else {
            redirect('/');
        }*/
    }

    public function signup_status() {

        if ($this->session->userdata('logged_in') != TRUE) {
            $this->load->library('user_agent');  // load user agent library
            $this->session->set_userdata('last_page', $this->agent->referrer());
            redirect(site_url('signup'));
        }
    }

    public function user_login_session($user) {

        $users_avatar = $this->config->item('users_avatar');
        $session_array = array(
            'id' => (int) $user->id,
            'first_name' => (string) $user->first_name,
            'last_name' => (string) $user->last_name,
     //       'location' => (string) $user->location,
            'city' => (string) $user->city,
            'state' => (string) $user->state,
            'zip' => (string) $user->zip,
       //     'country' => (string) $user->country,
      //      'state_code' => (string) $user->state_code,
 //           'street' => (string) $user->street,
            'agent_type' => (string) $user->agent_type,
            'about' => (string) $user->about,
            'full_name' => (string) $user->first_name . " " . $user->last_name,
            'email' => (string) $user->email,
            'active' => (string) $user->active,
            'user_type' => (string) $user->user_type,
            'picture' => (string) $users_avatar . "medium/" . $user->picture,
            'thumb' => (string) $users_avatar . "small/" . $user->picture,
            'cropped' => (string) $users_avatar . "crop/" . $user->picture,
            'pic'=>$user->picture,
            'phone'=>$user->phone,
            'logged_in' => (bool) true,
        );


        //pre($session_array);



        $this->session->set_userdata('logged_in', $session_array);


        // user is authenticated, lets see if there is a redirect:
        if ($this->session->userdata('last_page')!== site_url('signup')) {


            $redirect_url = $this->session->userdata('last_page');  // grab value and put into a temp variable so we unset the session value
            $this->session->unset_userdata('last_page');

            redirect($redirect_url);
        } else {

            redirect(site_url('dashboard'));
        }
    }

    public function forget() {

        if ($this->session->userdata('logged_in')) {
            redirect('/');
        }

        // create the data object and remove footer
        $data = new stdClass();

        set_extra_js("Login.init();");
        add_css(array('login-soft.css'));
        add_js(array('jquery.validate.min.js','login-soft.js'));

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        // set validation rules
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('users/forget', $data);
        } else {
            $email = $this->input->post('email');
            $user_id = $this->Users_model->forgetpassword($email);
            if ($user_id) {
                $hash = md5($email . uniqid(rand(), true));
                $update = $this->Users_model->update_user_hash($user_id, $hash);
                if ($update) {

                    $user_data = array();
                    $user_data['first_name'] = ucfirst($this->Users_model->get_user($user_id)->first_name);
                    $user_data['url'] = site_url("users/password/" . $hash);
                    $to = $email;
                    $subject = 'Password Reset';
                    $view = 'forgot';

                    sendEmail($to, $subject, $user_data, $view);

                    $data->success = 'Kindly check your email to reset password';
                    // user creation ok
                    $this->load->library('Form_validation');
                    $this->form_validation->resetpostdata(true);
                    $this->load->view('templates/header');
                    $this->load->view('users/forget', $data);
                    //$this->load->view('templates/footer');
                } else {
                    // login failed
                    $data->error = 'Some thing Wrong.';

                    // send error to the view
                    $this->load->view('templates/header');
                    $this->load->view('users/forget', $data);
                    //$this->load->view('templates/footer');
                }
            } else {

                // login failed
                $data->error = 'Wrong e-mail address.';

                // send error to the view
                $this->load->view('templates/header');
                $this->load->view('users/forget', $data);
                //$this->load->view('templates/footer');
            }
        }
    }

    public function register() {

        $referral =  $this->session->userdata('referral');

        set_extra_js("Login.init();");

        add_css(array('style.css','login-soft.css','prism.css','intlTelInput.css','isValidNumber.css','tooltipster.min.css'));
        add_js(array('jquery.validate.min.js','custom_maps.js','prism.js','intlTelInput.js','isValidNumber.js','general.js','login-soft.js'));

        set_extra_js("$('.login-form').validate();");
        $data = new stdClass();
        $data->login_hs = 'Form_hide';
        $data->signup_hs = 'Form_show';
        $data->forget_hs = 'Form_hide';
        $data->reset_hs = 'Form_hide';
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->helper('cookie');
        $this->form_validation->set_rules('user[email]', 'Email', 'trim|xss_clean|required|valid_email|is_unique[users.email]', array('is_unique' => 'This Email already exists. Please login.'));
        $this->form_validation->set_rules('user[first_name]', 'First Name', 'trim|xss_clean|required|min_length[2]');
        $this->form_validation->set_rules('user[last_name]', 'Last Name', 'trim|xss_clean|required|min_length[2]');
        $this->form_validation->set_rules('user[password]', 'Password', 'trim|xss_clean|required|min_length[6]');
        $this->form_validation->set_rules('user[rpassword]', 'Confirm Password', 'trim|xss_clean|required|min_length[6]|matches[user[password]]');

        $data->fb_login_url = $this->facebook->getLoginUrl(array('redirect_uri' => site_url('Users/fblogin'),
            'scope' => array("email,public_profile")));
        $data->google_login_url = $this->googleplus->loginURL();
        $data->linkedin_login_url = $this->linkedin->getLoginUrl();

        if(isset($referral)){

            $user = $this->common->getContentById('id','users','referral',$referral);
            $referred_id = $user[0]->id;

        }
        if ($this->form_validation->run() === false) {

            $this->load->view('templates/header');
            $this->load->view('users/register', $data);
        } else {

            $user = $this->input->post('user');
            $phone = phone_formatting($this->input->post('phone'));
            $user['phone'] = $phone;
            $user['password'] = MD5($user['password']);
           // $user['hash'] = MD5(uniqid(rand(), true));
            $user['hash'] =  mt_rand(1000,9999);
            $user['oauth_provider'] = 'E-mail';
            $user['active'] = 0;
            $user['picture'] = 'default.png';
            if(isset($referral)){
                $user['referral_string']  = $referral;
                $user['referral'] = substr(md5(time()), 0, 10);
                $user['referred_by'] = $referred_id;
            }

            unset($user["rpassword"]);
            $cookie_name = "ci_user";
            $user_id = $this->Users_model->register($user);
            $cookie_value = $user_id;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            $cookie_pass = "ci_pass";
            $cookie_passval = $this->input->post('user[password]');
            setcookie($cookie_pass, $cookie_passval, time() + (86400 * 30), "/");
            $cookie_email = "ci_emai";
            $cookie_emval = $this->input->post('user[email]');
            setcookie($cookie_email, $cookie_emval, time() + (86400 * 30), "/");


            if ($user_id) {

                $url = site_url("users/verify/" . $user['hash']);
                $user_data['hash'] = $user['hash'];
                $to = $user['email'];
                $subject = 'Please confirm your e-mail address';
                $user_data['receiver_name'] = ucfirst($user['first_name']) . ' ' . $user['last_name'];
                $user_data['url'] = $url;
                $view = 'confirmation';

                sendEmail($to, $subject, $user_data, $view);

                /*if(isset($referral)){

                    $referral_data['user_id '] = $user_id;
                    $referral_data['referred_string ']  = $referral;
                    $referral_data['referred_by '] = $referred_id;
                    $this->common->commonSave('user_referrals',$referral_data);
                }*/

                $bdata['agent_id '] = $user_id;
                $bdata['balance ']  = 5;
                $bdata['views '] = 0;

                if($user['user_type'] == 'Agent'){

                    $this->common->commonSave('topup_balance',$bdata);
                }

                $this->session->set_flashdata('register_success','Code is sent to you by Email ');
                redirect(site_url('verification'));
            } else {
                $data->error = 'There was a problem creating your new account. Please try again.';
                $this->load->view('templates/header');
                $this->load->view('users/login', $data);
            }
        }
    }


    public function confirmation()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        add_css(array('style.css','login-soft.css','prism.css','intlTelInput.css','isValidNumber.css','tooltipster.min.css'));
        add_js(array('jquery.validate.min.js','custom_maps.js','prism.js','intlTelInput.js','isValidNumber.js','general.js','login-soft.js'));
        set_extra_js("$('.login-form').validate();");


        $data = new stdClass();
        $data->login_hs = 'Form_show';
        $this->load->view('templates/header');
        $this->load->view('users/code_confirmation',$data);


    }


    function confirmByCode()
    {


        if ($this->session->userdata('logged_in')) { $this->logout(); }

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('code', 'Code', 'trim|required');

        if ($this->form_validation->run() == false) {

            echo 'false';


        }else{

            $code = $this->input->post('code');
            $result = $this->Users_model->verifyEmailAddress($code);

            if($result){
                $this->session->set_flashdata('register_success','Account Verified Successfully. Login Below ');
                //redirect(site_url('login'));
                echo 'success';


            }else{

              echo 'Sorry Unable to Verify Your Account!';
            }

        }




    }


    function reSendCode()
    {
        if ($this->session->userdata('logged_in')) { $this->logout(); }

        $cookie_name = "ci_user";
        if(isset($_COOKIE[$cookie_name])) {
            $hash = mt_rand(1000,9999);
            $attempts = $this->db->where('id', $_COOKIE[$cookie_name])->get('users')->row()->attempts;


            if($attempts < 3){
                $result = $this->Users_model->update_hash_on_resendCode($_COOKIE[$cookie_name],$hash,'is_hash' );
                if($result){

                    $user = $this->Users_model->get_user($_COOKIE['ci_user']);
                    $url = site_url("users/verify/" . $hash);
                    $user_data['hash'] = $hash;
                    $to = $user->email;
                    $subject = 'Please confirm your e-mail address';
                    $user_data['receiver_name'] = $user->first_name . ' ' . $user->last_name;
                    $user_data['url'] = $url;
                    $view = 'confirmation';
                    sendEmail($to, $subject, $user_data, $view);

                    echo json_encode(array("res" => "success", "msg" =>'Code resent successfully'));

                }else{
                    echo json_encode(array("res" => "error", "msg" =>'Something went wrong,please try again later'));
                }
            }else{
                echo json_encode(array("res" => "error", "msg" =>'Attempts Limit exceeds','query'=>$attempts));
            }
        } else {
            echo json_encode(array("res" => "error", "msg" =>'You are not authorized for this action'));
        }









    }


    function verify($hash = NULL) {


        if ($this->session->userdata('logged_in')) { $this->logout(); }

        if ($hash == NULL) { redirect('/'); }

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        // create the data object
        $data = new stdClass();

        $result = $this->Users_model->verifyEmailAddress($hash);

        $total_referrals = $result->total_referrals;

        if($result->referral){
            $user_id = $result->referred_by;
            $this->db->where('id', $user_id);
            $this->db->set('total_referrals', 'total_referrals+1', FALSE);
            $this->db->update('users');

            $this->load->helper('common_helper');
            $to = $result->email;
            $subject = 'Congrats someone used your referral code';
            $user_data = array();
            $user_data['receiver_name'] = $result->first_name;
            $view = 'referral-code';
            sendEmail($to, $subject, $user_data, $view);



        }

        if($total_referrals <= 10) {

            $user_id = $result->referred_by;
            $this->db->where('agent_id', $user_id);
            $this->db->set('balance', 'balance+5', FALSE);
            $this->db->update('topup_balance');
        }

        // pre($result);
        if ($result) {

            if($result->user_type == 'Agent'){
                $this->load->helper('common_helper');
                $to = $result->email;
                $subject = 'Welcome to Zoney';
                $user_data = array();
                $user_data['receiver_name'] = $result->first_name;
                $user_data['receiver_email'] = $_COOKIE['ci_emai'];
                $user_data['receiver_pass'] = $_COOKIE['ci_pass'];
                $view = 'welcome';
                sendEmail($to, $subject, $user_data, $view);
            }

            if($result->user_type == 'Renter'){
                $this->load->helper('common_helper');
                $to = $result->email;
                $subject = 'Welcome to Zoney';
                $user_data = array();
                $user_data['receiver_name'] = $result->first_name;
                $user_data['receiver_email'] = $_COOKIE['ci_emai'];
                $user_data['receiver_pass'] = $_COOKIE['ci_pass'];
                $view = 'welcome-user';
                sendEmail($to, $subject, $user_data, $view);
            }

            $data->success = 'E-mail Verified Successfully. Login Below';

        } else {
            $data->error = 'Email Already Verified.Please Login';
        }

        $data->fb_login_url = $this->facebook->getLoginUrl(array('redirect_uri' => site_url('Users/fblogin'),
            'scope' => array("email,public_profile")));
        $data->google_login_url = $this->googleplus->loginURL();
        $data->linkedin_login_url= $this->linkedin->getLoginUrl();
        $data->login_hs = 'Form_show';
        $data->signup_hs = 'Form_hide';
        $data->forget_hs = 'Form_hide';
        $data->reset_hs = 'Form_hide';


        $this->load->view('templates/header');
        $this->load->view('users/login', $data);
        /*$this->load->view('templates/footer');*/
    }




    public function login_status() {

        if ($this->session->userdata('logged_in') != TRUE) {
            $this->load->library('user_agent');
            $this->session->set_userdata('last_page', $this->agent->referrer());
            redirect(site_url('login'));
        }else{
            redirect(site_url('dashboard'));
        }
    }

    public function login() {



        set_extra_js("Login.init();");

        add_css(array('login-soft.css','prism.css','intlTelInput.css','isValidNumber.css','tooltipster.min.css'));
        add_js(array('jquery.validate.min.js','custom_maps.js','prism.js','intlTelInput.js','general.js','login-soft.js'));

        if ($this->session->userdata('logged_in')) {

            // user is authenticated, lets see if there is a redirect:
            if ($this->session->userdata('last_page')) {
                $redirect_url = $this->session->userdata('last_page');  // grab value and put into a temp variable so we unset the session value
                $this->session->unset_userdata('last_page');
                redirect($redirect_url);
            } else {
                redirect('/dashboard');
            }
        }

        // create the data object
        $data = new stdClass();

        $data->login_hs = 'Form_show';
        $data->signup_hs = 'Form_hide';
        $data->forget_hs = 'Form_hide';
        $data->reset_hs = 'Form_hide';

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        // set validation rules
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $data->fb_login_url = $this->facebook->getLoginUrl(array('redirect_uri' => site_url('Users/fblogin'),
            'scope' => array("email,public_profile")));
        $data->google_login_url = $this->googleplus->loginURL();
       $data->linkedin_login_url = $this->linkedin->getLoginUrl();

        if ($this->form_validation->run() == false) {

            // validation not ok, send validation errors to the view

            $this->load->view('templates/header');
            $this->load->view('users/login', $data);
            // $this->load->view('templates/footer');
        } else {

            // set variables from the form
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->Users_model->login($email, $password);

            if ($user) {
                $this->user_login_session($user);
            } else {

                // login failed
                $data->error = 'Wrong username or password.';

                // send error to the view
                $this->load->view('templates/header');
                $this->load->view('users/login', $data);
                // $this->load->view('templates/footer');
            }
        }
    }

    public function googlelogin() {

        if ($this->input->get('code')) {



            try {
                $this->googleplus->getAuthenticate();
                $guser = $this->googleplus->getUserInfo();
                $GuserID = $guser['id'];
            } catch (Exception $e) {
                $GuserID = false;
            }

            if ($GuserID) {

                $users_avatar = $this->config->item('users_avatar');
                $picture = 'g-' . $GuserID . '.jpg';

                $user = array(
                    'email' => $guser['email'],
                    'first_name' => @$guser['given_name'] ? @$guser['given_name'] : '',
                    'last_name' => @$guser['family_name'] ? @$guser['family_name'] : '',
                    'oauth_provider' => 'Google',
                    'oauth_uid' => $GuserID,
                    'active' => 1,
                    'gender' => @$guser['gender'] ? ucfirst(@$guser['gender']) : 'Male'
                );

                $user_record = $this->Users_model->social_login($user);

                if ($user_record) {
                    $this->user_login_session($user_record);
                } else {

                    $user_id = $this->Users_model->register($user);

                    if ($user_id) {

                        $bdata['agent_id '] = $user_id;
                        $bdata['balance ']  = 5;
                        $bdata['views '] = 0;

                        $this->common->commonSave('topup_balance',$bdata);

                        //Save picture

                        $file = $users_avatar . '/' . $picture;
                        //file_put_contents($file, file_get_contents($guser['picture']));
                        if (copy($guser['picture'], $file)) {


                            $this->load->library('image_lib');

                            // to re-size for thumbnail images
                            $config = array(
                                'source_image' => $file,
                                'new_image' => $users_avatar . 'small',
                                'quality' => '100%',
                                'maintain_ratio' => false,
                                'width' => 100,
                                'height' => 100
                            );

                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();

                            // to re-size for thumbnail images
                            $config = array(
                                'source_image' => $file,
                                'new_image' => $users_avatar . 'medium',
                                'quality' => '100%',
                                'maintain_ratio' => false,
                                'width' => 225,
                                'height' => 225
                            );

                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();

                            $this->Users_model->edit_profile(array('picture' => $picture), $this->Users_model->social_login($user)->id);
                            $this->user_login_session($this->Users_model->social_login($user));
                        } else {
                            $this->user_login_session($this->Users_model->social_login($user));
                        }
                    }
                }
            }
        }

        // create the data object
        $data = new stdClass();

        $data->login_hs = 'Form_show';
        $data->signup_hs = 'Form_hide';
        $data->forget_hs = 'Form_hide';
        $data->reset_hs = 'Form_hide';

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data->fb_login_url = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('users/fblogin'),
            'scope' => array("email,public_profile") // permissions here
        ));
        $data->google_login_url = $this->googleplus->loginURL();
        $data->linkedin_login_url= $this->linkedin->getLoginUrl();

        $data->error = 'Something wrong please try again';
        $this->load->view('templates/header');
        $this->load->view('users/login', $data);
        $this->load->view('templates/footer');
    }

    public function fblogin() {



        // create the data object
        $data = new stdClass();

        $data->login_hs = 'Form_show';
        $data->signup_hs = 'Form_hide';
        $data->forget_hs = 'Form_hide';
        $data->reset_hs = 'Form_hide';

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data->fb_login_url = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('users/fblogin'),
            'scope' => array("email,public_profile") // permissions here
        ));
        $data->google_login_url = $this->googleplus->loginURL();
        $data->linkedin_login_url= $this->linkedin->getLoginUrl();


        $userID = $this->facebook->getUser();

        if ($userID) {
            try {
                $fbuser = $this->facebook->api('/' . $userID . '?fields=email,first_name,gender,hometown,last_name,location,about');
            } catch (FacebookApiException $e) {
                $fbuser = false;
            }
        }

      //   echo '<pre>';print_r($userID);
      //  echo '<-------------->';
      //  echo '<pre>';print_r($fbuser);die;



        if ($userID && $fbuser && $fbuser['email'] != NULL) {

            $users_avatar = $this->config->item('users_avatar');

            $user = array(
                'email' => $fbuser['email'],
                'first_name' => @$fbuser['first_name'] ? @$fbuser['first_name'] : '',
                'last_name' => @$fbuser['last_name'] ? @$fbuser['last_name'] : '',
                'address' => @$fbuser['location'] ? @$fbuser['location'] : '',
                'city' => @$fbuser['hometown'] ? @$fbuser['hometown'] : '',
                'oauth_provider' => 'Facebook',
                'oauth_uid' => $fbuser['id'],
                'about' => @$fbuser['about'] ? @$fbuser['about'] : '',
                'active' => 1,
                'gender' => @$fbuser['gender'] ? ucfirst(@$fbuser['gender']) : 'Male'
            );

            $user_record = $this->Users_model->social_login($user);

            if ($user_record) {
                $this->user_login_session($user_record);
            } else {
                $user_id = $this->Users_model->register($user);
                if ($user_id) {
                    $bdata['agent_id '] = $user_id;
                    $bdata['balance ']  = 5;
                    $bdata['views '] = 0;
                    $this->common->commonSave('topup_balance',$bdata);

                    $file = $users_avatar . '/' . $userID . '.jpg';
                    //file_put_contents($file, file_get_contents('https://graph.facebook.com/' . $userID . '/picture?type=large'));
                    if (copy("http://graph.facebook.com/" . $userID . "/picture?width=9999&height=9999", $file)) {

                        $this->load->library('image_lib');

                        // to re-size for thumbnail images
                        $config = array(
                            'source_image' => $file,
                            'new_image' => $users_avatar . 'small',
                            'quality' => '100%',
                            'maintain_ratio' => false,
                            'width' => 100,
                            'height' => 100
                        );

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        // to re-size for thumbnail images
                        $config = array(
                            'source_image' => $file,
                            'new_image' => $users_avatar . 'medium',
                            'quality' => '100%',
                            'maintain_ratio' => false,
                            'width' => 225,
                            'height' => 225
                        );

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->Users_model->edit_profile(array('picture' => $userID . '.jpg'), $this->Users_model->social_login($user)->id);
                        $this->user_login_session($this->Users_model->social_login($user));
                    } else {
                        $this->user_login_session($this->Users_model->social_login($user));
                    }
                }
            }
        }


        $data->error = 'There is problems with your facebook account.';
        $this->load->view('templates/header');
        $this->load->view('users/login', $data);
        $this->load->view('templates/footer');
    }

    public function linkedinlogin(){
        $userData = array();

        //Get status and user info from session
        $oauthStatus = $this->session->userdata('oauth_status');
        $sessUserData = $this->session->userdata('userData');

        if(isset($oauthStatus) && $oauthStatus == 'verified' && isset($userData['oauth_uid'])){
            //User info from session
            $userData = $sessUserData;

        }elseif($this->input->get('oauth_init') || $this->input->get('code') || ($this->input->get('oauth_token') && $this->input->get('oauth_verifier'))) {

            try {
                $this->linkedin->getAuthenticate();
                $userinfo = $this->linkedin->getUserInfo();
                 //print_r($this->linkedin->userinfo);

                //Preparing data for database insertion
                $first_name = !empty($userinfo->firstName) ? $userinfo->firstName : '';
                $last_name = !empty($userinfo->lastName) ? $userinfo->lastName : '';
                $userData = array(
                    'oauth_provider' => 'linkedin',
                    'oauth_uid' => $userinfo->id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $userinfo->emailAddress,
                    'locale' => $userinfo->location->name,
                    'profile_url' => $userinfo->publicProfileUrl,
                    'picture_url' => $userinfo->pictureUrl
                );
                // echo '<pre>';print_r($userData);die('here');
                //Insert or update user data
                // $userID = $this->user->checkUser($userData);

                //Store status and user profile info into session
                $this->session->set_userdata('oauth_status', 'verified');
                $this->session->set_userdata('userData', $userData);


            } catch (Exception $e) {
                print_r($e);

            }


        }
if($userData['email']){
                $users_avatar = $this->config->item('users_avatar');
                $picture = 'li-' . $userData['oauth_uid'] . '.jpg';

                $user = array(
                    'email' => $userData['email'],
                    'first_name' => $userData['first_name'],
                    'last_name' => $userData['last_name'],
                    'oauth_provider' => $userData['oauth_provider'],
                    'oauth_uid' => $userData['oauth_uid'],
                    'active' => 1,
                    'location' => $userData['locale']
                );

                $user_record = $this->Users_model->social_login($user);

                if ($user_record) {
                    $this->user_login_session($user_record);
                } else {

                    $user_id = $this->Users_model->register($user);

                    if ($user_id) {

                        $bdata['agent_id '] = $user_id;
                        $bdata['balance ']  = 5;
                        $bdata['views '] = 0;

                        $this->common->commonSave('topup_balance',$bdata);

                        //Save picture

                        $file = $users_avatar . '/' . $picture;
                        //file_put_contents($file, file_get_contents($guser['picture']));
                        if (copy($userData['picture_url'], $file)) {


                            $this->load->library('image_lib');

                            // to re-size for thumbnail images
                            $config = array(
                                'source_image' => $file,
                                'new_image' => $users_avatar . 'small',
                                'quality' => '100%',
                                'maintain_ratio' => false,
                                'width' => 100,
                                'height' => 100
                            );

                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();

                            // to re-size for thumbnail images
                            $config = array(
                                'source_image' => $file,
                                'new_image' => $users_avatar . 'medium',
                                'quality' => '100%',
                                'maintain_ratio' => false,
                                'width' => 225,
                                'height' => 225
                            );

                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();

                            $this->Users_model->edit_profile(array('picture' => $picture), $this->Users_model->social_login($user)->id);
                            $this->user_login_session($this->Users_model->social_login($user));
                        } else {
                            $this->user_login_session($this->Users_model->social_login($user));
                        }
                    }
                }
            }



        // create the data object
        $data = new stdClass();

        $data->login_hs = 'Form_show';
        $data->signup_hs = 'Form_hide';
        $data->forget_hs = 'Form_hide';
        $data->reset_hs = 'Form_hide';

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data->fb_login_url = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('users/fblogin'),
            'scope' => array("email,public_profile") // permissions here
        ));
        $data->google_login_url = $this->googleplus->loginURL();
        $data->linkedin_login_url= $this->linkedin->getLoginUrl();

        $data->error = 'Something wrong please try again';
        $this->load->view('templates/header');
        $this->load->view('users/login', $data);
        $this->load->view('templates/footer');
    }

    public function logout() {

        add_css(array('login-soft.css','prism.css','intlTelInput.css','isValidNumber.css','tooltipster.min.css'));
        add_js(array('jquery.validate.min.js','custom_maps.js','prism.js','intlTelInput.js','isValidNumber.js','general.js','login-soft.js'));


        // create the data object
        $data = new stdClass();

        $data->login_hs = 'Form_show';
        $data->signup_hs = 'Form_hide';
        $data->forget_hs = 'Form_hide';
        $data->reset_hs = 'Form_hide';

        //session_destroy();
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('listing');

        $this->session->unset_userdata('oauth_status');
        $this->session->unset_userdata('userData');


        $data->fb_login_url = $this->facebook->getLoginUrl(array('redirect_uri' => site_url('Users/fblogin'),
            'scope' => array("email,public_profile")));
        $data->google_login_url = $this->googleplus->loginURL();
        $data->linkedin_login_url= $this->linkedin->getLoginUrl();

        $this->load->helper('form');
        $this->load->view('templates/header');
        $this->load->view('users/login', $data);
        /* $this->load->view('templates/footer');*/
    }

    function password($hash = NULL) {

        if ($hash == NULL) {

            redirect('/');
        }

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        // create the data object
        $data = new stdClass();

        $id = $this->Users_model->CheckEmailAddress($hash);

        if ($id) {

            $data->login_hs = 'Form_hide';
            $data->signup_hs = 'Form_hide';
            $data->forget_hs = 'Form_hide';
            $data->reset_hs = 'Form_show';

            $data->hashvalue = $hash;


            $this->load->view('templates/header');
            $this->load->view('users/reset_password', $data);
            //$this->load->view('templates/footer');
        } else {

            $data->error = 'Sorry Unable to reset your password!';

            $data->login_hs = 'Form_hide';
            $data->signup_hs = 'Form_hide';
            $data->forget_hs = 'Form_show';
            $data->reset_hs = 'Form_hide';


            $this->load->view('templates/header');
            $this->load->view('users/forget', $data);
           /* $this->load->view('templates/footer');*/
        }
    }

    function update_password() {

        if ($this->session->userdata('logged_in')) {
            redirect('/');
        }

        // create the data object
        $data = new stdClass();

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        // set validation rules
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('rpassword', 'Confirm Password', 'trim|required|min_length[8]|matches[password]');

        $data->fb_login_url = $this->facebook->getLoginUrl(array('redirect_uri' => site_url('Users/fblogin'),
            'scope' => array("email,public_profile")));
        $data->google_login_url = $this->googleplus->loginURL();
        $data->linkedin_login_url= $this->linkedin->getLoginUrl();
        $data->login_hs = 'Form_show';
        $data->signup_hs = 'Form_hide';
        $data->forget_hs = 'Form_hide';
        $data->reset_hs = 'Form_hide';

        if ($this->form_validation->run() == false) {

            // validation not ok, send validation errors to the view

            $data->login_hs = 'Form_hide';
            $data->signup_hs = 'Form_hide';
            $data->forget_hs = 'Form_hide';
            $data->reset_hs = 'Form_show';

            $this->load->view('templates/header');
            $this->load->view('users/forget', $data);
           /* $this->load->view('templates/footer');*/
        } else {

            // set variables from the form
            $password = $this->input->post('password');
            $hash = $this->input->post('hash');
            $user_id = $this->Users_model->CheckEmailAddress($hash);
            if ($user_id && $hash) {

                $update = $this->Users_model->update_password($user_id, md5($password));
                if ($update) {

                    $data->success = 'Password Update successfully. Please login';
                    // user creation ok
                    $this->load->library('Form_validation');
                    $this->form_validation->resetpostdata(true);
                    $this->load->view('templates/header');
                    $this->load->view('users/login', $data);
                    //$this->load->view('templates/footer');
                } else {
                    // login failed
                    $data->error = 'Some thing Wrong.';

                    // send error to the view
                    $this->load->view('templates/header');
                    $this->load->view('users/reset_password', $data);
                   /* $this->load->view('templates/footer');*/
                }
            } else {

                // login failed
                $data->error = 'Some thing Wrong.';

                // send error to the view
                $this->load->view('templates/header');
                $this->load->view('users/reset_password', $data);
               /* $this->load->view('templates/footer');*/
            }
        }
    }



    function verification() {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));

            // load form helper and validation library
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('verification[country]', 'Country', 'trim|required');
            $this->form_validation->set_rules('verification[document_type]', 'Document Type', 'trim|required');
            if (empty($_FILES['document_front']['name'])) {
                $this->form_validation->set_rules('document_front', 'Document Front Side', 'trim|required');
            } if (empty($_FILES['document_back']['name'])) {
                $this->form_validation->set_rules('document_back', 'Document Back Side', 'trim|required');
            }

            // create the data object
            $data = new stdClass();

            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];
            $data->VerificationStatus = $this->Users_model->VerificationStatus($uid);

            $this->seo->SetValues('Title', "Verify Your ID - Zoney");

            if ($this->form_validation->run() == false) {

                $this->load->view('templates/header');
                $this->load->view('users/verification', $data);
                $this->load->view('templates/footer');
            } else {

                $verification = $this->input->post('verification');

                $config['upload_path'] = 'assets/media/verification/';
                $config['allowed_types'] = 'jpeg|jpg|png|pdf|doc|docx';
                $config['encrypt_name'] = true;

                if (isset($_FILES['document_front']) && $_FILES['document_front']['size'] > 0) {

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('document_front')) {

                        $upload_data = $this->upload->data();
                        $verification['document_front'] = $upload_data['file_name'];
                    } else {
                        $data->error = $this->upload->display_errors();
                    }
                }

                if (isset($_FILES['document_back']) && $_FILES['document_back']['size'] > 0) {

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('document_back')) {

                        $upload_data = $this->upload->data();
                        $verification['document_back'] = $upload_data['file_name'];
                    } else {
                        $data->error = $this->upload->display_errors();
                    }
                }

                $verification['status'] = 'pending';
                $verification['user_id'] = $uid;

                if ($this->Users_model->TrustVerification($verification)) {
                    $data->success = 'Form Submitted successfully';
                    $this->form_validation->resetpostdata(true);
                } else {
                    $data->error = 'Some thing wrong! Please try again';
                }

                $data->VerificationStatus = $this->Users_model->VerificationStatus($uid);

                $this->load->view('templates/header');
                $this->load->view('users/verification', $data);
                $this->load->view('templates/footer');
            }
        } else {
            redirect('/');
        }
    }

    function notifications() {

        if ($this->session->userdata('logged_in')) {

            $this->load->model('Inbox_model');

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));

            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];

            $this->seo->SetValues('Title', $session_data['full_name'] . "'s Notifications - Zoney");

            // create the data object
            $data = new stdClass();
            $this->Inbox_model->UpdateNotificationsStatus($uid); //Update status
            $data->notifications = $this->Inbox_model->get_notification($uid);

            $this->load->view('templates/header');
            $this->load->view('users/notifications', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function payment_methods() {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));

            // create the data object
            $data = new stdClass();
            //$data->extra_js = 'Inbox.init();';

            $this->load->view('templates/header');
            $this->load->view('users/payment_methods', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function preferences() {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));

            // create the data object
            $data = new stdClass();
            //$data->extra_js = 'Inbox.init();';

            $this->load->view('templates/header');
            $this->load->view('users/preferences', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function transactions() {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js', 'general.js'));

            // create the data object
            $data = new stdClass();
            $session_data = $this->session->userdata('logged_in');

            $this->seo->SetValues('Title', $session_data['full_name'] . "'s Transaction History - Zoney");

            $data->transactions = $this->Users_model->transactions($session_data['id']);
            $data->funds = $this->Users_model->all_funds($session_data['id'], date('Y-m-d'));

            $this->load->view('templates/header');
            $this->load->view('users/transactions', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function get_tranactions_by_date() {

        $date = $this->input->post('id');
        $data = new stdClass();

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $data->transactions = $this->Users_model->getTransactionsByDate($date, $session_data['id']);
            $this->load->view('users/transaction_partial', $data);
        }
    }

    function privacy() {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));

            // create the data object
            $data = new stdClass();
            //$data->extra_js = 'Inbox.init();';

            $this->load->view('templates/header');
            $this->load->view('users/privacy', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function password_update() {

        if ($this->session->userdata('logged_in')) {
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));
            $data = new stdClass();
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->seo->SetValues('Title', "Password Update - Zoney");

            $this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('rpassword', 'Confirm Password', 'trim|required|min_length[8]|matches[password]');

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header');
                $this->load->view('users/passwordupdate', $data);
                $this->load->view('templates/footer');
            } else {

                $oldpassword = $this->input->post('oldpassword');
                $newpassword = $this->input->post('password');
                $session_data = $this->session->userdata('logged_in');

                if ($this->Users_model->UpdateOldPassword($session_data['id'], MD5($oldpassword), MD5($newpassword))) {
                    // echo $this->db->last_query();
                    $data->success_password = 'Password Updated successfully.';
                    $this->load->library('Form_validation');
                    $this->form_validation->resetpostdata(true);
                    $this->load->view('templates/header');
                    $this->load->view('users/edit_profile', $data);
                    $this->load->view('templates/footer');
                } else {

                    //login failed
                    $data->error = 'Wrong old Password!';
                    $this->load->view('templates/header');
                    $this->load->view('users/edit_profile', $data);
                    $this->load->view('templates/footer');
                }
            }
        } else {
            redirect('/');
        }
    }

    function settings() {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));

            // create the data object
            $data = new stdClass();
            //$data->extra_js = 'Inbox.init();';

            $this->load->view('templates/header');
            $this->load->view('users/settings', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function edit_profile()
    {

        $this->session->userdata('logged_in')['user_type'];

        if (!($this->session->userdata('logged_in')))
        {
            redirect('/');
        }
        add_css(array('light.css', 'iEdit.css','bootstrap-tagsinput.css'));
        add_js(array('jquery.validate.min.js','custom_maps.js','autocomplete_map.js','login-soft.js','iEdit.js','general.js','bootstrap-tagsinput.min.js'));
        $data = new stdClass();
        $this->load->helper('form');
        $this->load->library('form_validation');

        set_extra_js('$("#edit_profile").validate({ errorPlacement: function(error, element) {} });');

        set_extra_js('$(function() {
              $(\'.copy-to-clipboard\').click(function() {
                $(\'.referral_link\').focus();
                $(\'.referral_link\').select();
                document.execCommand(\'copy\');
                $(".copy-to-clipboard").text("Copied");
              });
            });');


        // If user is Renter
        if($this->session->userdata('logged_in')['user_type'] == 'Renter')
        {

            $this->form_validation->set_rules('user[first_name]', 'First Name', 'trim|required|min_length[2]');
            $this->form_validation->set_rules('user[last_name]', 'Last Name', 'trim|required|min_length[2]');
            $session_data = $this->session->userdata('logged_in');
            $this->seo->SetValues('Title', $session_data['full_name'] . "'s profile");
            if( $this->form_validation->run() == false )
            {
                $data->cities = $this->common->getAllContent('*','cities');
                $data->user_areas = $this->listings->city_areas($data->user->city);
                $data->user = $this->Users_model->get_user($session_data['id']);
                $this->load->view('templates/header');
                $this->load->view('users/edit_profile', $data);
            }
            else
            {
                if( isset($_POST['croped_image']) && !empty($_POST['croped_image']) )
                {
                    $uploaded_file = base64_to_image($_POST['croped_image']);
                    $filename = randomStrNum(6).'.jpg';
                    $filepath = upload_path('users_avatar/');
                    $filepath_full = $filepath.$filename;

                    if( file_put_contents($filepath_full, $uploaded_file) )
                    {
                        $_POST['user']['picture'] = $filename;
                    }

                    if( file_exists($filepath_full) )
                    {
                        $_SESSION['logged_in']['picture'] = 'assets/media/users_avatar/medium/'.$filename;
                        $_SESSION['logged_in']['thumb'] = 'assets/media/users_avatar/small/'.$filename;
                        $_SESSION['logged_in']['cropped'] = 'assets/media/users_avatar/crop/'.$filename;

                        $this->load->library('image_lib');

                        /* generating croped image */
                        $config = array(
                            'image_library' => 'gd2',
                            'source_image' => $filepath_full,
                            'new_image' => upload_path('users_avatar/crop/').$filename,
                            'quality' => '80%',
                            'maintain_ratio' => false,
                            'width' => 150,
                            'height' => 150
                        );

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        // pre($config);


                        /* generating medium size image */
                        $config = array(
                            'image_library' => 'gd2',
                            'source_image' => $filepath_full,
                            'new_image' => upload_path('users_avatar/medium/').$filename,
                            'quality' => '80%',
                            'maintain_ratio' => false,
                            'width' => 225,
                            'height' => 225
                        );

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        /* generating small size image */
                        $config = array(
                            'image_library' => 'gd2',
                            'source_image' => $filepath_full,
                            'new_image' => upload_path('users_avatar/small/').$filename,
                            'quality' => '80%',
                            'maintain_ratio' => false,
                            'width' => 100,
                            'height' => 100
                        );

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }

                    if( file_exists($filepath.$_POST['old_image']) )
                    {
                        @unlink($filepath.$_POST['old_image']);
                        @unlink(upload_path('users_avatar/crop/').$_POST['old_image']);
                        @unlink(upload_path('users_avatar/medium/').$_POST['old_image']);
                        @unlink(upload_path('users_avatar/small/').$_POST['old_image']);
                    }

                }

                $posted_lngs = $this->input->post('user[languages]');
                $lngs = implode(",",$posted_lngs);

                $user_speciailties = $this->input->post('user[specialties]');
                $speciailties = implode(",",$user_speciailties);
                $phone_no = $this->input->post('user[phone]');
                if (substr($phone_no, 0, 3) === '+92') {
                    $phone = $phone_no;
                }else {
                    $phone = phone_formatting($phone_no);
                }
                $user_data = array(

                    'first_name'=>$this->input->post('user[first_name]'),
                    'last_name'=> $this->input->post('user[last_name]'),
                    'phone'=> $phone,
                    'phone_secondary'=> $this->input->post('user[phone_secondary]'),
                    'birth_date'=> $this->input->post('user[birth_date]'),
                    'languages'=> $lngs,
                    'user_specialities'=> $speciailties,
                    'real_estate_license'=> $this->input->post('user[real_estate_license]'),
                    'about'=> $this->input->post('user[about]'),
                    'city'=> $this->input->post('user[city]'),
                    'state'=> $this->input->post('user[state]'),
                    'country'=> $this->input->post('user[country]'),
                    'zip'=> $this->input->post('user[zip]'),
                    'location'=> $this->input->post('user[location]'),
                    'address'=> $this->input->post('user[location]'),
                    'state_code'=> $this->input->post('user[state_code]'),
                    'street'=> $this->input->post('user[street]'),



                );

                if( isset($_POST['upload_userfile']) && !empty($_POST['upload_userfile']) )
                {

                    $pic = array(
                        'picture' => $filename
                    );

                    $user_data = array_merge($user_data, $pic);

                }
                $user_query = $this->Users_model->edit_profile($user_data, $session_data['id']);
                if( $user_query )
                {
                    $data->cities = $this->common->getAllContent('*','cities');

                    $user = $this->Users_model->get_user($session_data['id']);
                    $data->user_areas = $this->listings->city_areas($user->city);
                    $logged_in = $this->session->userdata('logged_in');
                    $logged_in['first_name'] = (string) $user->first_name;
                    $logged_in['last_name'] = (string) $user->last_name;
                    $logged_in['full_name'] = (string) $user->first_name . " " . $user->last_name;
                    $this->session->set_userdata('logged_in', $logged_in);

                    $to = $user->email;
                    $subject = 'Profile Update successfully';
                    $data->user = $user;
                    $user_data = array();
                    $user_data['first_name'] = ucfirst($user->first_name);
                    $user_data['update_date'] = date('M d, Y');
                    $user_data['update_time'] = date('h:i a');
                    $user_data['flag'] = 'Edit profile';
                    $view = 'profile_update';
                    $data->success = 'Profile Update successfully.';


                    // user creation ok
                    $this->load->view('templates/header');
                    $this->load->view('users/edit_profile', $data);
                    // $this->load->view('templates/footer');
                }
                else
                {

                    // login failed
                    $data->error = 'Some thing Wrong.';
                    $data->cities = $this->common->getAllContent('*','cities');
                    $data->user = $this->Users_model->get_user($session_data['id']);
                    $data->user_areas = $this->listings->city_areas($data->user->city);

                    // send error to the view
                    $this->load->view('templates/header');
                    $this->load->view('users/edit_profile', $data);
                    // $this->load->view('templates/footer');
                }

            }

        }


        else{

            $this->form_validation->set_rules('user[first_name]', 'First Name', 'trim|required|min_length[2]');
            $this->form_validation->set_rules('user[last_name]', 'Last Name', 'trim|required|min_length[2]');
            $this->form_validation->set_rules('user[phone]', 'Phone', 'trim|required');
            /*$this->form_validation->set_rules('user[location]', 'Location', 'trim|required');*/
            $session_data = $this->session->userdata('logged_in');
            $this->seo->SetValues('Title', $session_data['full_name'] . "'s profile");
            if( $this->form_validation->run() == false )
            {
                $data->user = $this->Users_model->get_user($session_data['id']);
                $data->cities = $this->common->getAllContent('*','cities');
                $data->user_areas = $this->listings->city_areas($data->user->city);
                $this->load->view('templates/header');
                $this->load->view('users/edit_profile', $data);
            }
            else
            {
                if( isset($_POST['croped_image']) && !empty($_POST['croped_image']) )
                {
                    $uploaded_file = base64_to_image($_POST['croped_image']);
                    $filename = randomStrNum(6).'.jpg';
                    $filepath = upload_path('users_avatar/');
                    $filepath_full = $filepath.$filename;

                    if( file_put_contents($filepath_full, $uploaded_file) )
                    {
                        $_POST['user']['picture'] = $filename;
                    }

                    if( file_exists($filepath_full) )
                    {
                        $_SESSION['logged_in']['picture'] = 'assets/media/users_avatar/medium/'.$filename;
                        $_SESSION['logged_in']['thumb'] = 'assets/media/users_avatar/small/'.$filename;
                        $_SESSION['logged_in']['cropped'] = 'assets/media/users_avatar/crop/'.$filename;

                        $this->load->library('image_lib');

                        /* generating croped image */
                        $config = array(
                            'image_library' => 'gd2',
                            'source_image' => $filepath_full,
                            'new_image' => upload_path('users_avatar/crop/').$filename,
                            'quality' => '80%',
                            'maintain_ratio' => false,
                            'width' => 150,
                            'height' => 150
                        );

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        // pre($config);


                        /* generating medium size image */
                        $config = array(
                            'image_library' => 'gd2',
                            'source_image' => $filepath_full,
                            'new_image' => upload_path('users_avatar/medium/').$filename,
                            'quality' => '80%',
                            'maintain_ratio' => false,
                            'width' => 225,
                            'height' => 225
                        );

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        /* generating small size image */
                        $config = array(
                            'image_library' => 'gd2',
                            'source_image' => $filepath_full,
                            'new_image' => upload_path('users_avatar/small/').$filename,
                            'quality' => '80%',
                            'maintain_ratio' => false,
                            'width' => 100,
                            'height' => 100
                        );

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }

                    if( file_exists($filepath.$_POST['old_image']) )
                    {
                        @unlink($filepath.$_POST['old_image']);
                        @unlink(upload_path('users_avatar/crop/').$_POST['old_image']);
                        @unlink(upload_path('users_avatar/medium/').$_POST['old_image']);
                        @unlink(upload_path('users_avatar/small/').$_POST['old_image']);
                    }

                }

                $posted_lngs = $this->input->post('user[languages]');
                $lngs = implode(",",$posted_lngs);

                $user_speciailties = $this->input->post('user[specialties]');
                $speciailties = implode(",",$user_speciailties);

                $phone_no = $this->input->post('user[phone]');
                if (substr($phone_no, 0, 3) === '+92') {
                    $phone = $phone_no;
                }else {
                    $phone = phone_formatting($phone_no);
                }

                $user_data = array(

                    'first_name'=>$this->input->post('user[first_name]'),
                    'last_name'=> $this->input->post('user[last_name]'),
                    'phone'=> $phone,
                    'phone_secondary'=> $this->input->post('user[phone_secondary]'),
                    'birth_date'=> $this->input->post('user[birth_date]'),
                    'languages'=> $lngs,
                    'user_specialities'=> $speciailties,
                    'real_estate_license'=> $this->input->post('user[real_estate_license]'),
                    'about'=> $this->input->post('user[about]'),
                    'city'=> $this->input->post('user_city'),
                    'area'=> $this->input->post('user_area'),

                    /*'state'=> $this->input->post('user[state]'),
                    'country'=> $this->input->post('user[country]'),
                   'zip'=> $this->input->post('user[zip]'),
                   'location'=> $this->input->post('user[location]'),
                   'address'=> $this->input->post('user[location]'),
                   'state_code'=> $this->input->post('user[state_code]'),
                   'street'=> $this->input->post('user[street]'),*/



                );

                if( isset($_POST['upload_userfile']) && !empty($_POST['upload_userfile']) )
                {

                    $pic = array(
                        'picture' => $filename
                    );

                    $user_data = array_merge($user_data, $pic);

                }
                //pre($user_data);
                $user_query = $this->Users_model->edit_profile($user_data, $session_data['id']);
                if( $user_query )
                {
                    $data->cities = $this->common->getAllContent('*','cities');
                    $user = $this->Users_model->get_user($session_data['id']);
                    $data->user_areas = $this->listings->city_areas($user->city);
                    $logged_in = $this->session->userdata('logged_in');
                    $logged_in['first_name'] = (string) $user->first_name;
                    $logged_in['last_name'] = (string) $user->last_name;
                    $logged_in['full_name'] = (string) $user->first_name . " " . $user->last_name;
                    $this->session->set_userdata('logged_in', $logged_in);

                    $to = $user->email;
                    $subject = 'Profile Update successfully';
                    $data->user = $user;
                    $user_data = array();
                    $user_data['first_name'] = ucfirst($user->first_name);
                    $user_data['update_date'] = date('M d, Y');
                    $user_data['update_time'] = date('h:i a');
                    $user_data['flag'] = 'Edit profile';
                    $view = 'profile_update';
                    $data->success = 'Profile Update successfully.';

                    // user creation ok
                    $this->load->view('templates/header');
                    $this->load->view('users/edit_profile', $data);
                    // $this->load->view('templates/footer');
                }
                else
                {

                    // login failed
                    $data->error = 'Some thing Wrong.';
                    $data->cities = $this->common->getAllContent('*','cities');
                    $data->user = $this->Users_model->get_user($session_data['id']);
                    $data->user_areas = $this->listings->city_areas($data->user->city);

                    // send error to the view
                    $this->load->view('templates/header');
                    $this->load->view('users/edit_profile', $data);
                    // $this->load->view('templates/footer');
                }

            }
        }



    }

    function avatar()
    {

        if (!($this->session->userdata('logged_in')))
        {
            redirect('/');
        }

        $this->load->helper('form');
        //Add Js/Css
        add_css(array('light.css', 'jquery.fileupload.css', 'jquery.fileupload-ui.css', 'jquery.cropbox.css'));
        add_js(array('jquery.slimscroll.min.js', 'jquery.mousewheel.min.js', 'jquery.cropbox.js'));

        // create the data object
        $data = new stdClass();



        $session_data = $this->session->userdata('logged_in');


        $uid = $session_data['id'];
        $data->profile_medium_thumbnail = $session_data['picture'];
        $data->profile_picture = $session_data['thumb'];
        $users_avatar = $this->config->item('users_avatar');
        $data->users_avatar = $users_avatar;

        $this->seo->SetValues('Title', $session_data['full_name'] . "'s Profile - Zoney");




        if( isset($_FILES['userfile']) && $_FILES['userfile']['size'] > 0 )
        {

            $config['upload_path'] = $users_avatar;
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['encrypt_name'] = true;
            $config['max_size'] = 0;
            $config['max_width'] = 0;
            $config['max_height'] = 0;

            $this->load->library('upload', $config);
            $this->load->library('image_lib');

            if( $this->upload->do_upload() )
            {
                $upload_data = $this->upload->data();
                $picture_name = $upload_data['file_name'];
                // Store Cropped Image Thumb
                If (strlen($this->input->post('image_info')) > 2) {
                    $cropped_thumb = $this->input->post('image_info');
                    $cropped = json_decode($cropped_thumb, true);
                    $base64_string = str_replace('data:image/png;base64', '', $cropped[0]['image']);
                    $filename_path = md5(time() . uniqid()) . ".jpg";

                    $decoded = base64_decode($base64_string);
                    file_put_contents($users_avatar . "/crop/" . $picture_name, $decoded);

                    $config = array(
                        'source_image' => $upload_data['file_path'] . "crop/" . $picture_name,
                        'new_image' => $users_avatar . 'crop',
                        'quality' => '100%',
                        'maintain_ratio' => false,
                        'width' => 150,
                        'height' => 150
                    );

                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }


                // to re-size for thumbnail images
                $config = array(
                    'source_image' => $upload_data['file_path'] . "crop/" . $picture_name,
                    'new_image' => $users_avatar . 'small',
                    'quality' => '100%',
                    'maintain_ratio' => false,
                    'width' => 100,
                    'height' => 100
                );

                $this->image_lib->initialize($config);
                $this->image_lib->resize();

                // to re-size for thumbnail images
                $config = array(
                    'source_image' => $upload_data['full_path'],
                    'new_image' => $users_avatar . 'medium',
                    'quality' => '100%',
                    'maintain_ratio' => false,
                    'width' => 225,
                    'height' => 225
                );

                $this->image_lib->initialize($config);
                $this->image_lib->resize();

                $response = $this->Users_model->edit_profile(array('picture' => $picture_name), $uid);
                if ($response) {
                    $logged_in = $this->session->userdata('logged_in');
                    $logged_in['picture'] = $users_avatar . "medium/" . $picture_name;
                    $logged_in['thumb'] = $users_avatar . "small/" . $picture_name;
                    $logged_in['cropped'] = $users_avatar . "crop/" . $picture_name;
                    $this->session->set_userdata('logged_in', $logged_in);

                    $user = $this->Users_model->get_user($session_data['id']);

                    $data->user = $user;
                    $logged_in = $this->session->userdata('logged_in');
                    $logged_in['first_name'] = (string) $user->first_name;
                    $logged_in['last_name'] = (string) $user->last_name;
                    $logged_in['full_name'] = (string) $user->first_name . " " . $user->last_name;
                    $this->session->set_userdata('logged_in', $logged_in);

                    $to = $user->email;
                    $subject = 'Avatar Update successfully';

                    $user_data = array();
                    $user_data['first_name'] = $user->first_name;
                    $user_data['update_date'] = date('M d, Y');
                    $user_data['update_time'] = date('h:i a');
                    $user_data['flag'] = 'avatar';
                    $view = 'profile_update';
                    $data->profile_medium_thumbnail = $users_avatar . "crop/" . $picture_name;

                    sendEmail($to, $subject, $user_data, $view);
                    $data->success = 'Profile Picture Update successfully.';
                } else {
                    $data->error = 'Some thing Wrong.';
                }

                $session_data = $this->session->userdata('logged_in');
                $data->profile_picture = $session_data['thumb'];

                $this->load->view('templates/header');
                $this->load->view('users/avatar', $data);
                $this->load->view('templates/footer');
            } else {

                $data->error = $this->upload->display_errors();
                $this->load->view('templates/header');
                $this->load->view('users/avatar', $data);
                $this->load->view('templates/footer');
            }
        } else {

            $this->load->view('templates/header');
            $this->load->view('users/avatar', $data);
            $this->load->view('templates/footer');
        }
    }

    function widthdraw_funds() {

        $session_data = $this->session->userdata('logged_in');
        $uid = $session_data['id'];
        $amount = $this->input->post('withdraw_amount');
        $account_email = $this->input->post('recipient_email');
        $description = $this->input->post('message_box');
        $status = 'initiate';
        $data = array('uid' => $uid, 'amount' => $amount, 'paypal_email' => $account_email, 'description' => $description, 'status' => $status);
        $result = $this->Users_model->widthdrawFunds($data);
        $transactions_data = array('user_id' => $uid, 'booking_id' => $result, 'transaction_type' => 'Debit', 'description' => 'Your Withdrawal request has been initiated', 'amount' => $amount, 'status' => 'ok', 'process_date' => date('Y-m-d'));
        $this->Users_model->add_withdraw_transaction($transactions_data);
        echo $result;
    }

    function verify_funds_amount() {
        $data = new stdClass();
        $session_data = $this->session->userdata('logged_in');
        $data->funds = $this->Users_model->all_funds($session_data['id'], date('Y-m-d'));
        foreach ($data->funds as $funds) {
            echo $availble_amount = ($funds->a_credits - $funds->a_debits);
        }
    }

}
