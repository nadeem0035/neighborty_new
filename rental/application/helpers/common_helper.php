<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


function PkrFormat($value) {


    $lenth = strlen(round($value));

    if($lenth == 3) {
        return 'PKR '.round($value);
    } elseif ($lenth == 4) {
        return 'PKR '.round($value);
    } elseif ($lenth == 5) {
        return 'PKR '.round($value);
    } elseif ($lenth == 6) {
        if(substr($value,1,2) != 0){
            return 'PKR '.substr($value,0,1).'.'.substr($value,1,2).' Lac';
        } else {
            return substr($value,0,1).' Lac';
        }
    } elseif ($lenth == 7) {
        if(substr($value,2,2) != 0){
            return 'PKR '.substr($value,0,2).'.'.substr($value,2,2).' Lac';
        } else {
            return 'PKR '.substr($value,0,1).' Lac';
        }
    } elseif ($lenth == 8) {
        if(substr($value,1,2) != 0){
            return 'PKR '.substr($value,0,1).'.'.substr($value,1,2).' Crore';
        } else {
            return 'PKR '.substr($value,0,1).' Crore';
        }
    } elseif ($lenth == 9) {
        if(substr($value,2,2) != 0){
            return 'PKR '.substr($value,0,2).'.'.substr($value,2,2).' Crore';
        } else {
            return 'PKR '.substr($value,0,1).' Crore';
        }
    }

}



if (!function_exists('messages_in_header')) {

    function messages_in_header() {
        $CI = & get_instance();
        $CI->load->model('Inbox_model');
        $CI->load->helper('my_date');

        if ($CI->session->userdata('logged_in')) {

            $session_data = $CI->session->userdata('logged_in');
            $uid = $session_data['id'];

            $data = $CI->Inbox_model->GetInboxreservation($uid);
            if ($data) {
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}

if (!function_exists('users_avatar')) {

    function users_avatar() {
        $CI = & get_instance();
        return $CI->config->item('users_avatar');
    }

}

if (!function_exists('messages_count')) {

    function messages_count() {
        $CI = & get_instance();
        $CI->load->model('Inbox_model');
        $session_data = $CI->session->userdata('logged_in');
        $uid = $session_data['id'];
        return $CI->Inbox_model->UnreadMessageReservation($uid);
    }

}

if (!function_exists('get_notification')) {

    function get_notification() {
        $CI = & get_instance();
        $CI->load->model('Inbox_model');
        $CI->load->helper('my_date');
        $session_data = $CI->session->userdata('logged_in');
        $uid = $session_data['id'];
        return $CI->Inbox_model->get_notification($uid);
    }

}

if (!function_exists('unread_notification_count')) {

    function unread_notification_count() {
        $CI = & get_instance();
        $CI->load->model('Inbox_model');
        $CI->load->helper('my_date');
        $session_data = $CI->session->userdata('logged_in');
        $uid = $session_data['id'];
        return $CI->Inbox_model->unread_notification_count($uid);
    }

}


if (!function_exists('dateRange')) {

    function dateRange($first, $last, $step = '+1 day', $output_format = 'Y-m-d') {

        $dates = array();
        $intfirst = strtotime($first);
        $current = strtotime($first);
        $last = strtotime($last);

        while ($current < $last) {
            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }

}

if (!function_exists('SeoDetail')) {

    function SeoDetail($type) {
        $CI = & get_instance();

        if ($type == 'Title') {
            echo $CI->seo->GetValues('Title');
        }
        if ($type == 'Description') {
            echo $CI->seo->GetValues('Description');
        }
    }

}

if (!function_exists('sendEmail')) {

    function sendEmail($to, $subject, $user_data, $view) {

        $config = array('charset' => 'utf-8', 'wordwrap' => TRUE, 'mailtype' => 'html');

        $CI = & get_instance();
        $CI->load->library('email');
        $CI->email->initialize($config);
        $CI->email->set_newline("\r\n");
        $CI->email->from('info@stayluxus.com', 'Stayluxus');
        $CI->email->to($to);
        $CI->email->subject($subject);

        if ($view && $view != NULL) {
            $message = $CI->load->view('email_templates/' . $view, $user_data, true);
        } else {
            if (is_array($user_data)) {
                $message = $user_data[0];
            } else {
                $message = $user_data;
            }
        }

        $CI->email->message($message);
        $CI->email->send();
    }

}

if (!function_exists('HavingMyTrips')) {

    function HavingMyTrips($uid) {
        $CI = & get_instance();
        $CI->load->model('Listings_model');
        return $CI->Listings_model->MyTrips($uid);
    }

}

if (!function_exists('HavingReviews')) {

    function HavingReviews($uid) {
        $CI = & get_instance();
        $CI->load->model('Reviews_model');
        if ($CI->Reviews_model->reviews_about_you($uid) || $CI->Reviews_model->reviews_by_you($uid)) {
            return true;
        } else {
            return false;
        }
    }

}


if (!function_exists('HavingReservationRequests')) {

    function HavingReservationRequests($uid) {
        $CI = & get_instance();
        $CI->load->model('Booking_model');
        if ($CI->Booking_model->reservation_requests($uid)) {
            return true;
        } else {
            return false;
        }
    }

}


if (!function_exists('HavingTransactions')) {

    function HavingTransactions($uid) {
        $CI = & get_instance();
        $CI->load->model('Users_model');
        if ($CI->Users_model->transactions($uid)) {
            return true;
        } else {
            return false;
        }
    }

}


if (!function_exists('HavingListings')) {

    function HavingListings($uid) {
        $CI = & get_instance();
        $CI->load->model('Listings_model');
        if ($CI->Listings_model->UserListing($uid)) {
            return true;
        } else {
            return false;
        }
    }

}

if (!function_exists('SendDefaultMessage')) {

    function SendDefaultMessage($uid, $subject, $message, $headermessage) {
        $CI = & get_instance();
        //Send mail
        $CI->load->model('Users_model');
        $MailUser = $CI->Users_model->get_user($uid);

        $UserData['first_name'] = ucfirst($MailUser->first_name);
        $UserData['headermessage'] = $headermessage;
        $UserData['description'] = $message;
        sendEmail($MailUser->email, $subject, $UserData, 'general');
    }

}

if (!function_exists('ContactUsMail')) {

    function ContactUsMail($message) {
        $UserData['first_name'] = 'Admin';
        $UserData['headermessage'] = 'Contact US';
        $UserData['description'] = $message;
        sendEmail('info@stayluxus.com,nadeem0035@gmail.com', 'Contact US', $UserData, 'general');
    }

}

if (!function_exists('CalculateRating')) {

    function CalculateRating($listing_id) {
        $CI = & get_instance();
        $CI->load->model('Listings_model');
        $result = $CI->Listings_model->get_listing_review($listing_id);
        if($result){
           return $result->rating;
        }else{
           return 0;
        }

    }

}
 
