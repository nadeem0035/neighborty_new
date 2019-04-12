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
    public function __construct() {

        parent::__construct();
        $this->load->model('Users_model');
        $this->load->library('facebook/Facebook');
        $this->load->library('googleplus/Googleplus');
        $this->load->model('Wishlists_model', 'wishlist', true);
        set_extra_js("Login.init();");
        add_css(array('login-soft.css'));
        add_js(array('login-soft.js'));

        //Title and meta description
        $this->seo->SetValues('Title', 'Log In / Sign Up to luxus');
        $this->seo->SetValues('Description', "Browse and book, or list your space. It's easy!");
    }

    public function index() {

        redirect('/');
    }

    public function show($uid = NULL) {

        if ($this->session->userdata('logged_in')) {

            $this->load->model('Reviews_model');
            $this->load->model('References_model');
            $this->load->model('Listings_model');

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
            $data->reviews_to = $this->Reviews_model->reviews_about_you($uid);
            $data->reviews_by = $this->Reviews_model->reviews_by_you($uid);
            $data->references_to = $this->References_model->references_about_you($uid);
            $data->user_listings = $this->Listings_model->get_user_listing($uid, 'Publish');

            //Title and meta description
            $this->seo->SetValues('Title', $data->user->first_name . " " . $data->user->last_name . '\'Profile - luxus');
            $this->seo->SetValues('Description', $data->user->first_name . " " . $data->user->last_name . " has been a member of luxus since " . date("F j, Y", strtotime($data->user->registered_date)));

            $this->load->view('templates/header');
            $this->load->view('users/view_profile', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    /**
     * register function.
     * 
     * @access public
     * @return void
     */
    public function register() {

        // create the data object
        $data = new stdClass();


        $data->login_hs = 'Form_hide';
        $data->signup_hs = 'Form_show';
        $data->forget_hs = 'Form_hide';
        $data->reset_hs = 'Form_hide';

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('security');

        // set validation rules
        $this->form_validation->set_rules('user[email]', 'Email', 'trim|xss_clean|required|valid_email|is_unique[users.email]', array('is_unique' => 'This Email already exists. Please login.'));
        $this->form_validation->set_rules('user[first_name]', 'First Name', 'trim|xss_clean|required|min_length[4]');
        $this->form_validation->set_rules('user[last_name]', 'Last Name', 'trim|xss_clean|required|min_length[4]');
        $this->form_validation->set_rules('user[password]', 'Password', 'trim|xss_clean|required|min_length[8]');
        $this->form_validation->set_rules('user[rpassword]', 'Confirm Password', 'trim|xss_clean|required|min_length[8]|matches[user[password]]');

        $data->fb_login_url = $this->facebook->getLoginUrl(array('redirect_uri' => site_url('Users/fblogin'),
            'scope' => array("email,public_profile")));
        $data->google_login_url = $this->googleplus->loginURL();

        if ($this->form_validation->run() === false) {

            // validation not ok, send validation errors to the view

            $this->load->view('templates/header');
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');
        } else {

            // set variables from the form
            $user = $this->input->post('user');
            $user['password'] = MD5($user['password']);
            $user['hash'] = md5(uniqid(rand(), true));
            $user['oauth_provider'] = 'E-mail';
            $user['active'] = 0;
            unset($user["rpassword"]);

            if ($this->Users_model->register($user)) {


                $url = site_url("users/verify/" . $user['hash']);
                $to = $user['email'];
                $subject = 'Please confirm your e-mail address';

                $user_data = array();
                $user_data['first_name'] = ucfirst($user['first_name']) . ' ' . $user['last_name'];
                $user_data['url'] = $url;
                $view = 'confirmation';

                sendEmail($to, $subject, $user_data, $view);

                $data->success = 'Account created successfully. Check your email for confirmation';
                // user creation ok
                $this->load->library('Form_validation');
                $this->form_validation->resetpostdata(true);
                $this->load->view('templates/header');
                $this->load->view('users/login', $data);
                $this->load->view('templates/footer');
            } else {

                // user creation failed, this should never happen
                $data->error = 'There was a problem creating your new account. Please try again.';
                // send error to the view
                $this->load->view('templates/header');
                $this->load->view('users/login', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    public function login_status() {

        if ($this->session->userdata('logged_in') != TRUE) {
            $this->load->library('user_agent');  // load user agent library
            $this->session->set_userdata('last_page', $this->agent->referrer());
            redirect(site_url('login'));
        }
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
            'full_name' => (string) $user->first_name . " " . $user->last_name,
            'email' => (string) $user->email,
            'user_type' => (string) $user->user_type,
            'picture' => (string) $users_avatar . "medium/" . $user->picture,
            'thumb' => (string) $users_avatar . "small/" . $user->picture,
            'cropped' => (string) $users_avatar . "crop/" . $user->picture,
            'logged_in' => (bool) true,
        );
        $this->session->set_userdata('logged_in', $session_array);


        // user is authenticated, lets see if there is a redirect:
        if ($this->session->userdata('last_page')) {
            $redirect_url = $this->session->userdata('last_page');  // grab value and put into a temp variable so we unset the session value
            $this->session->unset_userdata('last_page');
            redirect($redirect_url);
        } else {
            redirect(site_url('dashboard'));
        }
    }

    /**
     * login function.
     * 
     * @access public
     * @return void
     */
    public function login() {

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

        if ($this->form_validation->run() == false) {

            // validation not ok, send validation errors to the view

            $this->load->view('templates/header');
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');
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
                $this->load->view('templates/footer');
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

                    if ($this->Users_model->register($user)) {
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

        $userID = $this->facebook->getUser();

        if ($userID) {
            try {
                $fbuser = $this->facebook->api('/' . $userID . '?fields=email,first_name,gender,hometown,last_name,location,about');
            } catch (FacebookApiException $e) {
                $fbuser = false;
            }
        }
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

                if ($this->Users_model->register($user)) {
                    //Save picture

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

    public function logout() {

        // create the data object
        $data = new stdClass();

        $data->login_hs = 'Form_show';
        $data->signup_hs = 'Form_hide';
        $data->forget_hs = 'Form_hide';
        $data->reset_hs = 'Form_hide';

        //session_destroy();
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('listing');

        $data->fb_login_url = $this->facebook->getLoginUrl(array('redirect_uri' => site_url('Users/fblogin'),
            'scope' => array("email,public_profile")));
        $data->google_login_url = $this->googleplus->loginURL();

        $this->load->helper('form');
        redirect('/');
        //$this->load->view('templates/header');
        //$this->load->view('users/login', $data);
        //$this->load->view('templates/footer');
    }

    public function forget() {

        if ($this->session->userdata('logged_in')) {
            redirect('/');
        }

        // create the data object
        $data = new stdClass();

        $data->login_hs = 'Form_hide';
        $data->signup_hs = 'Form_hide';
        $data->forget_hs = 'Form_show';
        $data->reset_hs = 'Form_hide';

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        // set validation rules
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {

            // validation not ok, send validation errors to the view

            $this->load->view('templates/header');
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');
        } else {

            // set variables from the form
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

                    $data->success = 'E-mail send successfully. Check your email to reset password';
                    // user creation ok
                    $this->load->library('Form_validation');
                    $this->form_validation->resetpostdata(true);
                    $this->load->view('templates/header');
                    $this->load->view('users/login', $data);
                    $this->load->view('templates/footer');
                } else {
                    // login failed
                    $data->error = 'Some thing Wrong.';

                    // send error to the view
                    $this->load->view('templates/header');
                    $this->load->view('users/login', $data);
                    $this->load->view('templates/footer');
                }
            } else {

                // login failed
                $data->error = 'Wrong e-mail address.';

                // send error to the view
                $this->load->view('templates/header');
                $this->load->view('users/login', $data);
                $this->load->view('templates/footer');
            }
        }
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
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');
        } else {

            $data->error = 'Sorry Unable to reset your password!';

            $data->login_hs = 'Form_hide';
            $data->signup_hs = 'Form_hide';
            $data->forget_hs = 'Form_show';
            $data->reset_hs = 'Form_hide';


            $this->load->view('templates/header');
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');
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
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');
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
                    $this->load->view('templates/footer');
                } else {
                    // login failed
                    $data->error = 'Some thing Wrong.';

                    // send error to the view
                    $this->load->view('templates/header');
                    $this->load->view('users/login', $data);
                    $this->load->view('templates/footer');
                }
            } else {

                // login failed
                $data->error = 'Some thing Wrong.';

                // send error to the view
                $this->load->view('templates/header');
                $this->load->view('users/login', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    function verify($hash = NULL) {

        if ($hash == NULL) {

            redirect('/');
        }

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        // create the data object
        $data = new stdClass();

        $result = $this->Users_model->verifyEmailAddress($hash);

        if ($result) {

            $this->load->helper('common_helper');
            $to = $result->email;
            $subject = 'Welcome to Luxus';

            $user_data = array();
            $user_data['first_name'] = $result->first_name;
            $view = 'welcome';

            sendEmail($to, $subject, $user_data, $view);

            $data->success = 'Email Verified Successfully! Please login';
        } else {
            $data->error = 'Sorry Unable to Verify Your Email!';
        }

        $data->fb_login_url = $this->facebook->getLoginUrl(array('redirect_uri' => site_url('Users/fblogin'),
            'scope' => array("email,public_profile")));
        $data->google_login_url = $this->googleplus->loginURL();

        $data->login_hs = 'Form_show';
        $data->signup_hs = 'Form_hide';
        $data->forget_hs = 'Form_hide';
        $data->reset_hs = 'Form_hide';


        $this->load->view('templates/header');
        $this->load->view('users/login', $data);
        $this->load->view('templates/footer');
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

            $this->seo->SetValues('Title', "Verify Your ID - luxus");

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

            $this->seo->SetValues('Title', $session_data['full_name'] . "'s Notifications - luxus");

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

            $this->seo->SetValues('Title', $session_data['full_name'] . "'s Transaction History - luxus");

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

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));

            // create the data object
            $data = new stdClass();

            // load form helper and validation library
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->seo->SetValues('Title', "Password Update - luxus");


            // set validation rules
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

                if ($this->Users_model->UpdateOldPassword($session_data['id'], md5($oldpassword), md5($newpassword))) {
                    echo $this->db->last_query();
                    $data->success = 'Password Updated successfully.';
                    $this->load->library('Form_validation');
                    $this->form_validation->resetpostdata(true);
                    $this->load->view('templates/header');
                    $this->load->view('users/passwordupdate', $data);
                    $this->load->view('templates/footer');
                } else {
                    // login failed
                    $data->error = 'Wrong old Password!';
                    $this->load->view('templates/header');
                    $this->load->view('users/passwordupdate', $data);
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

    function edit_profile() {

        if (!($this->session->userdata('logged_in'))) {
            redirect('/');
        }

        //Add Js/Css
        add_css(array('light.css'));
        add_js(array('jquery.slimscroll.min.js'));
        set_extra_js('ComponentsPickers.init()');

        // create the data object
        $data = new stdClass();

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('user[first_name]', 'First Name', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('user[last_name]', 'Last Name', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('user[gender]', 'Gender', 'trim|required');
        $this->form_validation->set_rules('user[birth_date]', 'Birth date', 'trim|required');
        $this->form_validation->set_rules('user[phone]', 'Phone', 'trim|required');
        $this->form_validation->set_rules('user[address]', 'Address', 'trim|required');
        $this->form_validation->set_rules('user[city]', 'City', 'trim|required');
        $this->form_validation->set_rules('user[state]', 'State', 'trim|required');

        $this->form_validation->set_rules('user[zip]', 'Zip', 'trim|required');
        $this->form_validation->set_rules('user[country]', 'Country', 'trim|required');
        $this->form_validation->set_rules('user[about]', 'About', 'trim|required');

        $session_data = $this->session->userdata('logged_in');
        $this->seo->SetValues('Title', $session_data['full_name'] . "'s profile - luxus");


        if ($this->form_validation->run() == false) {


            $data->user = $this->Users_model->get_user($session_data['id']);

            //echo '<pre>';print_r($data->user);die;
            // validation not ok, send validation errors to the view
            $this->load->view('templates/header');
            $this->load->view('users/edit_profile', $data);
            $this->load->view('templates/footer');
        } else {

            echo 'eles';die;

            $user_query = $this->Users_model->edit_profile($this->input->post('user'), $session_data['id']);

            if ($user_query) {

                $user = $this->Users_model->get_user($session_data['id']);
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

                sendEmail($to, $subject, $user_data, $view);


                $data->success = 'Profile Update successfully.';

                // user creation ok
                $this->load->view('templates/header');
                $this->load->view('users/edit_profile', $data);
                $this->load->view('templates/footer');
            } else {

                // login failed
                $data->error = 'Some thing Wrong.';
                $data->user = $this->Users_model->get_user($session_data['id']);

                // send error to the view
                $this->load->view('templates/header');
                $this->load->view('users/edit_profile', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    function avatar() {

        if (!($this->session->userdata('logged_in'))) {
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

        $this->seo->SetValues('Title', $session_data['full_name'] . "'s Profile - luxus");




        if (isset($_FILES['userfile']) && $_FILES['userfile']['size'] > 0) {

            $config['upload_path'] = $users_avatar;
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['encrypt_name'] = true;
            $config['max_size'] = 0;
            $config['max_width'] = 0;
            $config['max_height'] = 0;

            $this->load->library('upload', $config);
            $this->load->library('image_lib');

            if ($this->upload->do_upload()) {
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

    public function widthdraw_funds() {

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

    public function verify_funds_amount() {
        $data = new stdClass();
        $session_data = $this->session->userdata('logged_in');
        $data->funds = $this->Users_model->all_funds($session_data['id'], date('Y-m-d'));
        foreach ($data->funds as $funds) {
            echo $availble_amount = ($funds->a_credits - $funds->a_debits);
        }
    }

}
