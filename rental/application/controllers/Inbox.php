<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Inbox extends CI_Controller {

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct() {

        parent::__construct();
        $this->load->model('Inbox_model');
        $this->load->model('Users_model');
        $this->load->helper('my_date');

        //Add Js/Css
        add_css(array('light.css', 'jquery.fancybox.css', 'inbox.css'));
        add_js(array('jquery.slimscroll.min.js', 'jquery.fancybox.pack.js', 'inbox.js'));
        set_extra_js("Inbox.init();");

        $session_data = $this->session->userdata('logged_in');
        $this->seo->SetValues('Title', $session_data['full_name'] . "'s Inbox - luxus");
    }

    function index() {


        if ($this->session->userdata('logged_in')) {

            // create the data object
            $data = new stdClass();
            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];

            $data->messages_count = $this->Inbox_model->unread_message_count($uid);
            $data->ReservationCount = $this->Inbox_model->UnreadReservationCount($uid);
            $this->load->view('templates/header');
            $this->load->view('inbox/index', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function inbox() {


        if ($this->session->userdata('logged_in')) {

            // create the data object
            $data = new stdClass();


            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];

            $data->messages = $this->Inbox_model->get_inbox($uid);

            $this->load->view('templates/header');
            $this->load->view('inbox/inbox', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function sent() {


        if ($this->session->userdata('logged_in')) {

            // create the data object
            $data = new stdClass();


            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];

            $data->messages = $this->Inbox_model->get_sent($uid);

            $this->load->view('templates/header');
            $this->load->view('inbox/sent', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function reservation() {


        if ($this->session->userdata('logged_in')) {

            // create the data object
            $data = new stdClass();


            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];

            $data->messages = $this->Inbox_model->get_reservation($uid);

            $this->load->view('templates/header');
            $this->load->view('inbox/reservation', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function archived() {


        if ($this->session->userdata('logged_in')) {

            // create the data object
            $data = new stdClass();

            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];

            $data->messages = $this->Inbox_model->get_archived($uid);

            $this->load->view('templates/header');
            $this->load->view('inbox/archived', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function inbox_view() {


        if ($this->session->userdata('logged_in')) {

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
        } else {
            redirect('/');
        }
    }

    function sent_view() {


        if ($this->session->userdata('logged_in')) {

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
        } else {
            redirect('/');
        }
    }

    function contact_host() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data = array(
                'receiver_id' => $this->input->post('receiver_id'),
                'sender_id' => $session_data['id'],
                'type' => 'Inbox',
                'message' => $this->input->post('message'),
                'listing_id' => $this->input->post('listing_id'),
                'check_in' => date('Y-m-d', strtotime($this->input->post('checkin2'))),
                'check_out' => date('Y-m-d', strtotime($this->input->post('checkout2'))),
                'guest' => $this->input->post('noofguest'),
                'read_status' => 0,
            );

            $user = $this->Users_model->get_user($session_data['id']);

            //Send mail
            SendDefaultMessage($this->input->post('receiver_id'), 'Message From Guest', 'You have received a message on your Luxus account:<br />
            <strong>Message From</strong>: '.$user->first_name. ' ' .$user->last_name.'<br />
            <strong>Full Message</strong>: '.$this->input->post('message').'<br />', 'New Message');

            if ($this->Inbox_model->send_message($data)) {
                echo true;
            } else {
                echo false;
            }
        } else {
            echo false;
        }
    }

    function reservation_view() {


        if ($this->session->userdata('logged_in')) {

            // create the data object
            $data = new stdClass();

            $message_id = $this->input->post('message_id');
            $this->Inbox_model->update_view_status($message_id);

            $data->users_avatar = $this->config->item('users_avatar');
            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];

            $data->message = $this->Inbox_model->get_reservation_message($message_id, $uid);

            $this->load->view('templates/header');
            $this->load->view('inbox/reservation_view', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function archived_view() {


        if ($this->session->userdata('logged_in')) {

            // create the data object
            $data = new stdClass();

            $message_id = $this->input->post('message_id');

            $data->users_avatar = $this->config->item('users_avatar');
            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];

            $data->message = $this->Inbox_model->get_archived_message($message_id, $uid);


            $this->load->view('templates/header');
            $this->load->view('inbox/archived_view', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function reply() {


        if ($this->session->userdata('logged_in')) {

            // create the data object
            $data = new stdClass();
            $data->message_id = $this->input->post('message_id');

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
            
            //SendDefaultMessage($message->sender_id, 'Response Message', 'You have receive message response. Please visit website to read message', 'Response Message');

            $user = $this->Users_model->get_user($uid);
            SendDefaultMessage($this->input->post('receiver_id'), 'Response Message', 'You have received a message on your Luxus account:<br />
            <strong>Message From</strong>: '.$user->first_name. ' ' .$user->last_name.'<br />
            <strong>Full Message</strong>: '.$this->input->post('message').'<br />', 'Response Message');

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
