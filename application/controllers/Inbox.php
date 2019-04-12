<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class Inbox extends CI_Controller
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
        $this->load->model('Inbox_model');
        $this->load->model('Users_model');
        $this->load->helper('my_date');
        $this->load->model('Common_model', 'common', true);

        //Add Js/Css
        add_css(array('light.css', 'jquery.fancybox.css', 'inbox.css'));
        add_js(array('jquery.slimscroll.min.js',/* 'jquery.fancybox.pack.js',*/ 'metronic.js',/*'custom_maps.js',*/ 'layout.js', 'jquery.validate.min.js', 'general.js','inbox.js'));
        set_extra_js("Inbox.init();");

        $session_data = $this->session->userdata('logged_in');
        $this->seo->SetValues('Title', $session_data['full_name'] . "'s Inbox - Neighborty");
    }

    function index()
    {


        if ($this->session->userdata('logged_in'))
        {

            // create the data object
            $data = new stdClass();
            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];
            $data->messages_count = $this->Inbox_model->unread_message_count($uid);
            $data->ApplicationCount = $this->Inbox_model->UnreadApplicationCount($uid);
            $data->AppointmentCount = $this->Inbox_model->UnreadAppointmentCount($uid);
            //$data->balance = $this->common->get_result('topup_balance','agent_id',$uid);
            $this->load->view('templates/header');
            $this->load->view('inbox/index', $data);
            // $footer_data['custom_js'] = 'Inbox.init();';
            // $this->load->view('templates/footer', $footer_data);
            $this->load->view('templates/footer');

        }
        else
        {
            redirect('/');
        }

    }

    function inbox()
    {



        if ($this->session->userdata('logged_in'))
        {

            // create the data object
            $data = new stdClass();


            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];
            $data->messages = $this->Inbox_model->get_inbox($uid);
            $this->load->view('templates/header');
            $this->load->view('inbox/inbox', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            redirect('/');
        }
    }

    function sent()
    {
        if ($this->session->userdata('logged_in'))
        {
            $data = new stdClass();
            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];
            $data->messages = $this->Inbox_model->get_sent($uid);

            $this->load->view('templates/header');
            $this->load->view('inbox/sent', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            redirect('/');
        }
    }

    function applications()
    {

        if ($this->session->userdata('logged_in'))
        {

            $data = new stdClass();

            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];

            $data->messages = $this->Inbox_model->get_application($uid);

            $this->load->view('templates/header');
            $this->load->view('inbox/application', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            redirect('/');
        }
    }

    function appointments()
    {
        if ($this->session->userdata('logged_in'))
        {
            // create the data object
            $data = new stdClass();

            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];
            $data->messages = $this->Inbox_model->get_appointment($uid);

            $this->load->view('templates/header');
            $this->load->view('inbox/appointment', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            redirect('/');
        }

    }

    function inbox_view()
    {
        if ($this->session->userdata('logged_in'))
        {
            // create the data object
            $data = new stdClass();

            $message_id = $this->input->post('message_id');
            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];
            $this->Inbox_model->update_view_status($message_id);

            $data->users_avatar = $this->config->item('users_avatar');
            $data->message = $this->Inbox_model->get_receive_message($message_id, $uid);

            $this->load->view('templates/header');
            $this->load->view('inbox/inbox_view', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            redirect('/');
        }
    }

    function sent_view()
    {


        if ($this->session->userdata('logged_in'))
        {

            // create the data object
            $data = new stdClass();

            $message_id = $this->input->post('message_id');
            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];

            $data->users_avatar = $this->config->item('users_avatar');

            $data->message = $this->Inbox_model->get_sent_message($message_id, $uid);

            $this->load->view('templates/header');
            $this->load->view('inbox/sent_view', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            redirect('/');
        }

    }

    function application_view()
    {
        if ($this->session->userdata('logged_in'))
        {

            // create the data object
            $data = new stdClass();

            $message_id = $this->input->post('message_id');
            $this->Inbox_model->update_view_status($message_id);

            $data->users_avatar = $this->config->item('users_avatar');
            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];

            $data->message = $this->Inbox_model->get_application_message($message_id, $uid);

            $this->load->view('templates/header');
            $this->load->view('inbox/application_view', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            redirect('/');
        }
    }

    function appointment_view()
    {
        if( $this->session->userdata('logged_in') )
        {

            // create the data object
            $data = new stdClass();

            $message_id = $this->input->post('message_id');

            $data->users_avatar = $this->config->item('users_avatar');
            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];
            $data->message = $this->Inbox_model->get_appointment_message($message_id, $uid);
            $this->load->view('templates/header');
            $this->load->view('inbox/appointment_view', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            redirect('/');
        }

    }


    function contact_agent()
    {
        if ($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $rec_id = $this->input->post('receiver_id');
            $data = array(
                'receiver_id' => $this->input->post('receiver_id'),
                'sender_id' => $session_data['id'],
                'type' => 'Inbox',
                'message' => $this->input->post('message'),
                'listing_id' => $this->input->post('listing_id'),
                'guest' => "",
                'read_status' => 0,
            );

            $user = $this->Users_model->get_user($session_data['id']);
            $user_to = $this->Users_model->get_user($rec_id);
            $user_data = array();
            $user_data['poster_name'] = $user->first_name. ' ' .$user->last_name;
            $user_data['message'] = $this->input->post('message');
            $user_data['poster_email'] = $user->email;
            $user_data['poster_phone'] = $user->phone;
            $user_data['receiver_name'] = $user_to->first_name. ' ' .$user_to->last_name;
            $user_data['poster_list'] = $this->input->post('lname');
            $user_data['url'] = site_url("inbox");
            $to = $user_to->email;
            $subject = 'Message From Neighborty';
            $view = 'contact-agent';
            sendEmail($to, $subject, $user_data, $view);

            $msg_data = array(
                'receiver_id' => $rec_id,
                'sender_id' => $session_data['id'],
                'message' => $this->input->post('message'),
                'receiver_name' => $user_to->first_name. ' ' .$user_to->last_name,
                'sender_name' => $user->first_name. ' ' .$user->last_name,
                'sender_email' => $user->email,
                'sender_phone' => $user->phone
            );
            $this->Inbox_model->add_msg_record($msg_data);

            if ($this->Inbox_model->send_message($data))
            {
                $array_data = array(
                    'user_id' => $session_data['id'],
                    'agent_id' => $rec_id,
                    'notification' => 'You have received new message',
                    'notify_type' => 'inbox'
                );
                $this->Inbox_model->add_notifcation($array_data);
                echo true;
            }
            else
            {
                echo false;
            }
        }else {
            $array_data = array(
                'user_id' => '',
                'agent_id' => $this->input->post('receiver_id'),
                'notification' => 'You have received new message',
                'notify_type' => 'inbox'
            );
            $this->Inbox_model->add_notifcation($array_data);
            $user_id = $this->input->post('receiver_id');
            $msg_info = $this->Users_model->get_user($user_id);
            $msg_data = array(
                'receiver_id' => $this->input->post('receiver_id'),
                'sender_id' => '0',
                'message' => $this->input->post('message'),
                'receiver_name' => $msg_info->first_name. ' ' .$msg_info->last_name,
                'sender_name' => $this->input->post('fullname'),
                'sender_email' => $this->input->post('email'),
                'sender_phone' => $this->input->post('phone')
            );
            $this->Inbox_model->add_msg_record($msg_data);

            $user_id = $this->input->post('receiver_id');
            $MailUser = $this->Users_model->get_user($user_id);
            $to = $MailUser->email;
            $subject ='Message From Guest';
            $UserData['receiver_name'] = $MailUser->first_name .' '. $MailUser->last_name;
            $user_data['poster_list'] = $this->input->post('lname');
            $UserData['poster_name'] = $this->input->post('fullname');
            $UserData['poster_email'] = $this->input->post('email');
            $UserData['poster_phone'] = $this->input->post('phone');
            $UserData['message'] = $this->input->post('message');
            $user_data['url'] = site_url("inbox");

            sendEmail($to, $subject, $UserData, 'contact-agent');
            echo true;
        }
    }

    function quick_contact()
    {
        if ($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $rec_id = $this->input->post('receiver_id');
            $data = array(
                'receiver_id' => $this->input->post('receiver_id'),
                'sender_id' => $session_data['id'],
                'type' => 'Inbox',
                'message' => $this->input->post('message'),
                'listing_id' => $this->input->post('listing_id'),
                'guest' => "",
                'read_status' => 0,
            );


            $user = $this->Users_model->get_user($session_data['id']);
            $user_to = $this->Users_model->get_user($rec_id);
            $user_data = array();
            $user_data['poster_name'] = $user->first_name. ' ' .$user->last_name;
            $user_data['message'] = $this->input->post('message');
            $user_data['poster_email'] = $user->email;
            $user_data['poster_phone'] = $user->phone;
            $user_data['receiver_name'] = $user_to->first_name. ' ' .$user_to->last_name;
            $user_data['url'] = site_url("inbox");
            $to = $user_to->email;
            $subject = 'Message From User';
            $view = 'quick-contact';
            sendEmail($to, $subject, $user_data, $view);

            if ($this->Inbox_model->send_message($data))
            {
                $msg_data = array(
                    'receiver_id' => $rec_id,
                    'sender_id' => $session_data['id'],
                    'message' => $this->input->post('message'),
                    'receiver_name' => $user_to->first_name. ' ' .$user_to->last_name,
                    'sender_name' => $user->first_name. ' ' .$user->last_name,
                    'sender_email' => $user->email,
                    'sender_phone' => $user->phone
                );
                $this->Inbox_model->add_msg_record($msg_data);

                $array_data = array(
                    'user_id' => $session_data['id'],
                    'agent_id' => $rec_id,
                    'notification' => 'You have received new message',
                    'notify_type' => 'inbox'
                );
                $this->Inbox_model->add_notifcation($array_data);


                echo true;
            }
            else
            {
                echo false;
            }
        }else {
            $array_data = array(
                'user_id' => '',
                'agent_id' => $this->input->post('receiver_id'),
                'notification' => 'Some one wants to contact you',
                'notify_type' => 'inbox'
            );
            $this->Inbox_model->add_notifcation($array_data);
            $user_id = $this->input->post('receiver_id');
            $msg_info = $this->Users_model->get_user($user_id);
            $msg_data = array(
                'receiver_id' => $this->input->post('receiver_id'),
                'sender_id' => '0',
                'message' => $this->input->post('message'),
                'receiver_name' => $msg_info->first_name. ' ' .$msg_info->last_name,
                'sender_name' => $this->input->post('fullname'),
                'sender_email' => $this->input->post('email'),
                'sender_phone' => $this->input->post('phone')
            );
            $this->Inbox_model->add_msg_record($msg_data);


            $user_id = $this->input->post('receiver_id');
            $MailUser = $this->Users_model->get_user($user_id);
            $to = $MailUser->email;
            $subject ='Message For Contact';
            $UserData['receiver_name'] = $MailUser->first_name .' '. $MailUser->last_name;
            $UserData['poster_name'] = $this->input->post('fullname');
            $UserData['poster_email'] = $this->input->post('email');
            $UserData['poster_phone'] = $this->input->post('phone');
            $UserData['message'] = $this->input->post('message');
            $user_data['url'] = site_url("inbox");

            sendEmail($to, $subject, $UserData, 'quick-contact');
            echo true;
        }
    }

    function contact_host()
    {
        if ($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data = array(
                'receiver_id' => $this->input->post('receiver_id'),
                'sender_id' => $session_data['id'],
                'type' => 'Inbox',
                'message' => $this->input->post('message'),
                'listing_id' => $this->input->post('listing_id'),
                'check_in' => "",
                'check_out' => "",
                'guest' => "",
                'read_status' => 0,
            );

            $user = $this->Users_model->get_user($session_data['id']);
            //Send mail
            SendDefaultMessage($this->input->post('receiver_id'), 'Message From Guest', 'You have received a message on your Neighborty account:<br />
            <strong>Message From</strong>: '.$user->first_name. ' ' .$user->last_name.'<br />
            <strong>Full Message</strong>: '.$this->input->post('message').'<br />', 'New Message');

            if ($this->Inbox_model->send_message($data))
            {
                echo true;
            }
            else
            {
                echo false;
            }
        }
        else
        {
            echo false;
        }
    }



    function reply()
    {


        if ($this->session->userdata('logged_in')) {

            // create the data object
            $data = new stdClass();
            $message_id = $this->input->post('message_id');
            $data->message_id = $this->input->post('message_id');
            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];
            $data->users_avatar = $this->config->item('users_avatar');
            $data->message = $this->Inbox_model->get_receive_message($message_id, $uid);

            $this->load->view('templates/header');
            $this->load->view('inbox/reply', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function send_reply() {
        if ($this->session->userdata('logged_in')) {

            $message_id = $this->input->post('message_id');
            $reply_message = $this->input->post('message');
            $message = $this->Inbox_model->get_message($message_id);
            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];
            //Send mail

            $data = array(
                'receiver_id' => $message->sender_id,
                'sender_id' => $uid,
                'type' => $message->type,
                'message' => $reply_message,
                'listing_id' => $message->listing_id,
                'check_in' => $message->check_in,
                'check_out' => $message->check_out,
                'read_status' => 0,
            );
            $user = $this->Users_model->get_user($uid);
            $user_to = $this->Users_model->get_user($message->sender_id);


            $user_data = array();
            $user_data['poster_name'] = $user->first_name. ' ' .$user->last_name;
            $user_data['message'] = $reply_message;
            $user_data['poster_email'] = $user->email;
            $user_data['poster_phone'] = $user->phone;
            $user_data['receiver_name'] = $user_to->first_name. ' ' .$user_to->last_name;
            $user_data['url'] = site_url("inbox");
            $to = $user_to->email;
            $subject = 'Response Message';
            $view = 'contact-massege';

            sendEmail($to, $subject, $user_data, $view);

            if ($this->Inbox_model->send_reply($data)) {

                echo true;
            } else {
                echo false;
            }
        } else {
            redirect('/');
        }
    }

}
