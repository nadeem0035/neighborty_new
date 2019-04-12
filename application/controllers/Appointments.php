<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class Appointments extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model('Listings_model');
        $this->load->model('Common_model');
        $this->load->model('Inbox_model');

    }

    function index()
    {

        if( $this->session->userdata('logged_in') )
        {
            //add_css(array('fullcalendar.min.css', 'iziToast.css'));
            //add_js(array('fullcalendar.min.js', 'jquery.validate.min.js', 'general.js', 'iziToast.min.js', 'dashboard.js', 'datetimepicker.js','custom_maps.js','autocomplete_map.js'));
            //set_extra_js("$().FullCalendarExt({calendarSelector: '#calendar',lang: 'fr'});");

            //add_css(array('fullcalendar.css', 'spectrum.css','jquery-ui-timepicker-addon.css','iziToast.css'));
           // add_js(array('fullcalendar.js','jquery.calendar.js','spectrum.js','jquery-ui-sliderAccess.js','jquery-ui-timepicker-addon.min.js', 'jquery.validate.min.js', 'general.js', 'iziToast.min.js', 'dashboard.js','custom_maps.js','autocomplete_map.js'));

            add_css(array('av-calendar.min.css'));
            add_js(array('dashboard.js','av-calendar.js'));
            set_extra_js("$().FullCalendarExt({calendarSelector: '#calendar',lang: 'en'});");



            $this->load->helper('text');
            $data = array();
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            $usertype = $session_data_user['user_type'];
            $this->seo->SetValues('Title', 'My Appointments - Zoney');
            $this->seo->SetValues('Description', "Rent out your room, house or apartment on Zoney. Join thousands already renting out their space to people all over the world. Listing your space is free!");
            $this->load->view('templates/header');


            if($usertype == 'Agent'){

                $data['appointments'] = $this->Listings_model->get_agent_appointments($uid);
                $data['availablity'] = $this->Listings_model->agents_available_slots($uid);
                $data['user_appoint'] = $this->Listings_model->userAppointments($uid);
                //pre($data);

                $this->load->view('appointments/agent', $data);
            }
            elseif($usertype == 'Renter'){
                $data['appointments'] = $this->Listings_model->userAppointments($uid);
                $this->load->view('appointments/renter', $data);
            }
            else{
                $data['appointments'] = $this->Listings_model->userAppointments($uid);
                $data['availablity'] = $this->Listings_model->agents_available_slots($uid);
                $this->load->view('appointments/home', $data);
            }

            $this->load->view('templates/dashboard_footer');
        }
        else
        {
            redirect('/');
        }
    }

    public function AgentAppointments()
    {
        if( $this->session->userdata('logged_in') ){
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            $data['appointments'] = $this->Listings_model->get_agent_appointments($uid);
            echo $this->load->view('includes/agent_appointments');

        }else{
            echo  'not logged in';
        }
    }


    public function add_availability()
    {
        if ($this->session->userdata('logged_in'))
        {
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            $timef = $this->input->post('time_from');
            $timet = $this->input->post('time_to');
            $time_from = date("H:i", strtotime($timef));
            $time_to = date("H:i", strtotime($timet));
                $form_data = array(
                    'agent_id' => $uid,
                    'title' => $this->input->post('title'),
                    'appointment_date'=>$this->input->post('appointment_date'),
                    'time_from' => $time_from,
                    'time_to' => $time_to,
                );

                if ($this->Listings_model->add_appointment($form_data)) {
                    echo 1;
                }else {
                    echo 0;
                }

        }else {
            redirect('/');
        }

    }


    public function set_appointment()
    {
        if ($this->session->userdata('logged_in'))
        {
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            if (isset($_POST['appointment_time'])) {
                $dayszz = $_POST['appointment_time'];

                foreach ($dayszz as $key=> $days) {
                    $value = explode('/', $days);
                    $variable1= $value[0];
                    $lastE= $value[1];
                   /* $lastEl = end($days);
                    $firstEl = reset($days);
                    $lastE = trim(substr($lastEl, strpos($lastEl, '/') + 1));
                    $variable1 = array_shift(explode('/', $firstEl));*/
                    $form_data = array(
                        'user_id' => $this->input->post('applicant_id'),
                        'availability_id' => $this->input->post('availabilityid'),
                        'listing_id' => $this->input->post('listing_id'),
                        'agent_id' => $this->input->post('agent_id'),
                        'message' => $this->input->post('note_text'),
                        'appointment_start_time' => $variable1,
                        'appointment_end_time' => $lastE
                    );

                    if ($this->Listings_model->set_appointment($form_data)) {

                        $array_data = array(
                              'user_id' => $session_data_user['id'],
                              'agent_id' => $this->input->post('agent_id'),
                              'notification' => 'You have received Appointment',
                              'notify_type' => 'appointments'
                          );
                          $this->Inbox_model->add_notifcation($array_data);

                        $session_data_user = $this->session->userdata('logged_in');
                         $agentid = $session_data_user['id'];
                         $agentdata = $this->Common_model->get_result('users', 'id', $agentid);
                         $listings = $this->Common_model->get_result('listing', 'id', $this->input->post('listing_id'));
                         $udata = $this->Common_model->get_result('users', 'id', $this->input->post('agent_id'));
                         $user_data = array();
                         $user_data['listing_name'] = $listings[0]->listing_name;
                         $user_data['listing_address'] = $listings[0]->address_line_1 . ' ' . $listings[0]->address_line_2 . ' ' . $listings[0]->city_town . ' ' . $listings[0]->state_province . ' ' . $listings[0]->zip_postal_code;
                         $user_data['listing_pictue'] = site_url('assets/media/properties/thumbs/' . $listings[0]->preview_image_url);
                         $user_data['listing_url'] = site_url('property/' . $listings[0]->slug . '-' . $listings[0]->id);

                         $user_data['app_url'] = site_url('appointments');
                         $user_data['msg_url'] = site_url('inbox');
                         $user_data['agent_name'] = $agentdata[0]->first_name . ' ' . $agentdata[0]->last_name;
                         $user_data['agent_phone'] = $agentdata[0]->phone;
                         $user_data['agent_email'] = $agentdata[0]->email;
                         $user_data['agent_picture'] = site_url('assets/media/users_avatar/small/' . $agentdata[0]->picture);
                         $user_data['agent_url'] = site_url('agent/profile/' . $agentdata[0]->id);
                         $user_data['reciver_name'] = $udata[0]->first_name . ' ' . $udata[0]->last_name;
                         $user_data['reciver_mail'] = $udata[0]->email;
                         $to = $udata[0]->email;
                         $subject = 'Set Appointment';
                         $view = 'set-appointment';
                         sendEmail($to, $subject, $user_data, $view);
                        /* $user_to = $session_data_user['email'];
                         $subject_agent = 'Set Appointment';
                         $view_agent = 'set-appointment';
                         sendEmail($user_to, $subject_agent, $user_data, $view_agent);*/

                        echo 1;

                    } else {
                        echo 0;
                    }
                }
            }

        }else {
            redirect('/');
        }

    }

    function app_status_cancel(){
        if ($this->session->userdata('logged_in')) {

            $id = $this->input->post('id');
            $lid = $this->input->post('ualid');
            $user_id = $this->input->post('usid');
         /*   $app_time = $this->input->post('appointment_time');*/
            if ($this->Listings_model->appstatuscancel($id)) {


                $session_data_user = $this->session->userdata('logged_in');
                $agentid= $session_data_user['id'];
                $agentdata = $this->Common_model->get_result('users','id',$agentid);
                $listings = $this->Common_model->get_result('listing','id',$lid);
                $udata = $this->Common_model->get_result('users','id',$user_id);
                $user_data = array();
                $user_data['listing_name'] = $listings[0]->listing_name;
                $user_data['listing_address'] = $listings[0]->address_line_1. ' ' .$listings[0]->address_line_2. ' ' .$listings[0]->city_town. ' ' .$listings[0]->state_province. ' ' .$listings[0]->zip_postal_code;
                $user_data['listing_pictue'] = site_url('assets/media/properties/thumbs/'.$listings[0]->preview_image_url);
                $user_data['listing_url'] = site_url('property/'.$listings[0]->slug.'-'.$listings[0]->id);

                $user_data['app_url'] = site_url('appointments');
                $user_data['msg_url'] = site_url('inbox');
                $user_data['agent_name'] = $agentdata[0]->first_name. ' ' .$agentdata[0]->last_name;
                $user_data['agent_phone'] = $agentdata[0]->phone;
                $user_data['agent_email']= $agentdata[0]->email;
                $user_data['agent_picture']= site_url('assets/media/users_avatar/small/'.$agentdata[0]->picture);
                $user_data['agent_url']= site_url('agent/profile/'.$agentdata[0]->id);
                $user_data['reciver_name']= $udata[0]->first_name. ' ' .$udata[0]->last_name;
                $user_data['reciver_mail']= $udata[0]->email;
                /*$user_data['appointment_time']= $app_time;*/
                $to = $udata[0]->email;
                $subject = 'Appointment Canceled';
                $view = 'appointment-cancellation-user';
                sendEmail($to, $subject, $user_data, $view);

                $user_to = $session_data_user['email'];
                $subject_agent = 'Appointment Canceled';
                $view_agent = 'appointment-cancellation-agent';
                sendEmail($user_to, $subject_agent, $user_data, $view_agent);

                echo '1';

            } else {
                echo '0';
            }
        }

    }

    function app_userstatus_cancel(){
        if ($this->session->userdata('logged_in')) {

            $id = $this->input->post('id');
            $lid = $this->input->post('listing_id');
            if ($this->Listings_model->appuserstatuscancel($id,$lid)) {

                echo '1';

            } else {
                echo '0';
            }
        }

    }

    function app_status_confirm(){
        if ($this->session->userdata('logged_in')) {

            $id = $this->input->post('id');
            $lid = $this->input->post('ualid');
            $user_id = $this->input->post('usid');
            $app_time = $this->input->post('appointment_time');
            if ($this->Listings_model->appstatusconfirm($id)) {


                $session_data_user = $this->session->userdata('logged_in');
                $agentid= $session_data_user['id'];
                $agentdata = $this->Common_model->get_result('users','id',$agentid);
                $listings = $this->Common_model->get_result('listing','id',$lid);
                $udata = $this->Common_model->get_result('users','id',$user_id);
                $user_data = array();
                $user_data['listing_name'] = $listings[0]->listing_name;
                $user_data['listing_address'] = $listings[0]->address_line_1. ' ' .$listings[0]->address_line_2. ' ' .$listings[0]->city_town. ' ' .$listings[0]->state_province. ' ' .$listings[0]->zip_postal_code;
                $user_data['listing_pictue'] = site_url('assets/media/properties/thumbs/'.$listings[0]->preview_image_url);
                $user_data['listing_url'] = site_url('property/'.$listings[0]->slug.'-'.$listings[0]->id);
                $user_data['app_url'] = site_url('appointments');
                $user_data['msg_url'] = site_url('inbox');
                $user_data['appointment_time']= $app_time;
                $user_data['agent_name'] = $agentdata[0]->first_name. ' ' .$agentdata[0]->last_name;
                $user_data['agent_phone'] = $agentdata[0]->phone;
                $user_data['agent_email']= $agentdata[0]->email;
                $user_data['agent_picture']= site_url('assets/media/users_avatar/small/'.$agentdata[0]->picture);
                $user_data['agent_url']= site_url('agent/profile/'.$agentdata[0]->id);
                $user_data['reciver_name']= $udata[0]->first_name. ' ' .$udata[0]->last_name;
                $user_data['reciver_mail']= $udata[0]->email;
                $to = $udata[0]->email;
                $subject = 'Appointment Confirmation';
                $view = 'appointment-confirmation-user';
                sendEmail($to, $subject, $user_data, $view);

                $user_to = $session_data_user['email'];
                $subject_agent = 'Appointment Confirmation';
                $view_agent = 'appointment-confirmation-agent';
                sendEmail($user_to, $subject_agent, $user_data, $view_agent);

                echo '1';

            } else {
                echo '0';
            }
        }

    }




}
