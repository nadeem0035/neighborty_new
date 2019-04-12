<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');


if( !function_exists('getRemainingDays') )
{

    function getRemainingDays($date)
    {

        $today=date_create(date('Y-m-d'));
        $date=date_create($date);

        $diff=date_diff($today,$date);

        $value =  $diff->format("%R%a");

        //return $value;

        if ((int)$value > 0 ){
            return $value .'days';
        }
        else{
            return 'Expired';
        };



    }

}


if( !function_exists('getDomain') ) {
    function getDomain()
    {
        $CI =& get_instance();
        return preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/", "$1", $CI->config->slash_item('base_url'));
    }
}

if( !function_exists('isAmenityExists') )
{

    function isAmenityExists($id,$list_id)
    {
        $CI = & get_instance();
        $CI->load->model('Listings_model');
        return $CI->Listings_model->isAmenityExists($id,$list_id);

    }

}

if( !function_exists('getCityById') )
{

    function getCityById($id)
    {
        $CI = & get_instance();
        $CI->load->model('Common_model');
        return $CI->Common_model->get_latest_row_column_by_id('name','cities','id',$id)->name;

    }

}


if( !function_exists('getAreaById') )
{

    function getAreaById($id)
    {
        $CI = & get_instance();
        $CI->load->model('Common_model');
        return $CI->Common_model->get_latest_row_column_by_id('area_name','areas','id',$id)->area_name;

    }

}





if (!function_exists('stripHTMLtags')) {
    function stripHTMLtags($str)
    {
        $t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
        $t = htmlentities($t, ENT_QUOTES, "UTF-8");
        return $t;
    }
}



if (!function_exists('phone_formatting')) {

    function phone_formatting($phone) {

        if (substr($phone, 0, 1) === '0') {
            return  '+92-' . substr($phone, 1);
        }else{
            return '+92-' .($phone);
        }

    }

}


//http://www.smarttutorials.net/encrypt-and-decrypt-stringtextids-for-url-using-php/
if (!function_exists('encryptor'))
{
        function encryptor($action, $string) {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        //pls set your unique hashing key
        $secret_key = 'biginc';
        $secret_iv = 'biginc';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        //do the encyption given text/string/number
        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            //decrypt the given text/string/number
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }
}

if (!function_exists('send_sms')) {

    function send_sms() {

        // Configuration variables
        $type = "xml";
        $id = "92test5";
        $pass = "mars1234";
        $lang = "English";
        $mask = "SMS4CONNECT";

        $to = "923214117183";
        $message = "Zoney.pk";
        $message = urlencode($message);
        // Prepare data for POST request
        $data = "id=".$id."&pass=".$pass."&msg=".$message."&to=".$to."&lang=".$lang."&mask=".$mask."&type=".$type;
        // Send the POST request with cURL
        $ch = curl_init('http://www.sms4connect.com/api/sendsms.php/sendsms/url');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch); //This is the result from SMS4CONNECT
        curl_close($ch);

    }

}






if (!function_exists('messages_in_header'))
{

	function messages_in_header()
	{
		$CI = & get_instance();
		$CI->load->model('Inbox_model');
		$CI->load->helper('my_date');

		if ($CI->session->userdata('logged_in'))
		{

			$session_data = $CI->session->userdata('logged_in');
			$uid = $session_data['id'];

			$data = $CI->Inbox_model->GetInboxreservation($uid);
			if ($data)
			{
				return $data;
			}
			else
			{
				return false;
			}
		}
		else
		{
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



if (!function_exists('string_padded_with_zero')) {

    function string_padded_with_zero($val) {

        $pad_length = 3;
        $pad_char = 0;

        return str_pad($val, $pad_length, $pad_char, STR_PAD_LEFT);

    }

}



if (!function_exists('display_user_avatar')) {

    function display_user_avatar($thumb)
    {
        if (file_exists('assets/media/users_avatar/' .$thumb) == FALSE || $thumb == null) {
            $folder = "";
            $pic = 'placeholder.png';
        } else {

            $folder = "medium/";
            $pic = $thumb;
        }

        return base_url().'assets/media/users_avatar/'.$folder.$pic;

    }
}


function count_digit($number) {
    return strlen($number);
}

function divider($number_of_digits) {
    $tens="1";

    if($number_of_digits>8)
        return 10000000;

    while(($number_of_digits-1)>0)
    {
        $tens.="0";
        $number_of_digits--;
    }
    return $tens;
}

function pkrCurrencyFormat($value) {


    $lenth = strlen(floor($value));

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
            return 'PKR '.substr($value,0,2).' Lac';
        }
    } elseif ($lenth == 8) {
        if(substr($value,1,2) != 0){
            return 'PKR '.substr($value,0,1).'.'.substr($value,1,2).' Crore';
        } else {
            return 'PKR '.substr($value,0,1).' Crore';
        }
    } elseif ($lenth == 9) {
        //return $lenth;
        if(substr($value,2,2) != 0){
            return 'PKR '.substr($value,0,2).'.'.substr($value,2,2).' Crore';
        } else {
            return 'PKR '.substr($value,0,2).' Crore';
        }
    }

}



function pkrCurrencyFormat_old($num)
{

    $ext="";
    $number_of_digits = count_digit($num);
    if($number_of_digits>3)
    {
        if($number_of_digits%2!=0)
            $divider=divider($number_of_digits-1);
        else
            $divider=divider($number_of_digits);
    }
    else
        $divider=1;

    $fraction=$num/$divider;
    $fraction=number_format($fraction);
    if($number_of_digits==4 ||$number_of_digits==5)
        $ext="k";
    if($number_of_digits==6 ||$number_of_digits==7)
        $ext="Lakh";
    if($number_of_digits==8 ||$number_of_digits==9)
        $ext="Crore";
    echo "Rs: ".$fraction." ".$ext;
}




if (!function_exists('plural')) {

    function plural($amount, $singular = '', $plural = 's')
    {
        if ($amount === 1) {
            return $singular;
        }
        return $plural;
    }
}

if (!function_exists('display_listing_tiny_image')) {

    function display_listing_tiny_image($thumb)
    {
        if (file_exists('assets/media/properties/tiny/' .$thumb) == FALSE || $thumb == null) {

            $pic = 'tiny.jpg';
            return base_url().'assets/img/'.$pic;

        } else {

            $pic = $thumb;
            return base_url().'assets/media/properties/tiny/'.$pic;
        }



    }
}




if (!function_exists('display_listing_preview')) {

    function display_listing_preview($dir,$thumb)
    {
        if (file_exists('assets/media/properties/'.$dir.'/' .$thumb) == FALSE || $thumb == null) {

            $pic = 'placeholder.png';
            return base_url().'assets/img/'.$pic;

        } else {

            $pic = $thumb;
            return base_url().'assets/media/properties/'.$dir.'/'.$pic;
        }



    }
}

if (!function_exists('display_feed_preview')) {

    function display_feed_preview($image)
    {

        if (file_exists($image) == FALSE || $image == null) {

            return base_url().'assets/media/feeds/thumbs/placeholder.png';

        } else {

            return base_url().$image;
        }



    }
}




if (!function_exists('restyle_number')) {


function restyle_number($input){
    $input = number_format($input);
    $input_count = substr_count($input, ',');
    if($input_count != '0'){
        if($input_count == '1'){
            return substr($input, 0, -4).'k';
        } else if($input_count == '2'){
            return substr($input, 0, -8).'mil';
        } else if($input_count == '3'){
            return substr($input, 0,  -12).'bil';
        } else {
            return;
        }
    } else {
        return $input;
    }
}
}

if( !function_exists('messages_count') )
{

	function messages_count()
	{
		$CI = & get_instance();
		$CI->load->model('Inbox_model');
		$session_data = $CI->session->userdata('logged_in');
		$uid = $session_data['id'];
		return $CI->Inbox_model->UnreadMessageReservation($uid);
	}

}

if( !function_exists('Amenity_value') )
{

    function Amenity_value($list_id,$id)
    {
        $CI = & get_instance();
        $CI->load->model('Listings_model');
        return $CI->Listings_model->get_amenity_value($list_id,$id);

    }

}




if( !function_exists('sold_count') )
{

    function sold_count($id)
    {
        $CI = & get_instance();
        $CI->load->model('Agents_model');
        return $CI->Agents_model->soldCount($id);
    }

}

if( !function_exists('sale_count') )
{

    function sale_count($id)
    {
        $CI = & get_instance();
        $CI->load->model('Agents_model');
        return $CI->Agents_model->saleCount($id);
    }

}


if( !function_exists('reviews_count') )
{

    function reviews_count($id)
    {
        $CI = & get_instance();
        $CI->load->model('Agents_model');
        return $CI->Agents_model->reviewCount($id);
    }

}


if( !function_exists('recommendation_count') )
{

    function recommendation_count($id)
    {
        $CI = & get_instance();
        $CI->load->model('Agents_model');
        return $CI->Agents_model->recommendation_count($id);
    }

}


if( !function_exists('count_review_rating') )
{

    function count_review_rating($id)
    {
        $CI = & get_instance();
        $CI->load->model('Agents_model');
        $data = $CI->Agents_model->count_review_rating($id);
        return $data['rating'];
    }

}




if( !function_exists('listing_images') )
{

    function listing_images($id)
    {
        $CI = & get_instance();
        $CI->load->model('Listings_model');
        return $CI->Listings_model->get_list_images($id);
    }

}





if( !function_exists('get_user_avatar') )
{

    function get_user_avatar($thumb,$avatar)
    {
        echo base_url() .'assets/media/users_avatar/'.$avatar.'/'.$thumb;


    }

}



if (!function_exists('get_notification'))
{

	function get_notification()
	{
		$CI =& get_instance();
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
        if ($type == 'Keywords') {
            echo $CI->seo->GetValues('Keywords');
        }
		if ($type == 'Description') {
			echo $CI->seo->GetValues('Description');
		}
        if ($type == 'OgImg') {
            echo $CI->seo->GetValues('OgImg');
        }
        if ($type == 'Address') {
            echo $CI->seo->GetValues('Address');
        }


	}

}




if (!function_exists('shareTags')) {

    function shareTags($type) {
        $CI = & get_instance();

        if ($type == 'Title') {
            echo $CI->seo->GetValues('Title');
        }
        if ($type == 'Description') {
            echo $CI->seo->GetValues('Description');
        }
    }

}

if (!function_exists('ContactAgent')) {

    function ContactAgent($uid, $subject,$name,$message, $headermessage) {
        $CI = & get_instance();
        //Send mail
        $CI->load->model('Users_model');
        $MailUser = $CI->Users_model->get_user($uid);
        $UserData['first_name'] = ucfirst($MailUser->first_name);
        $UserData['headermessage'] = $headermessage;
        $UserData['description'] = $message;

        sendEmail($MailUser->email, $subject, $UserData, 'contact-agent');

    }

}


if (!function_exists('sendEmail')) {

    function sendEmail($to, $subject, $user_data, $view) {

        //$config = array('charset' => 'utf-8', 'wordwrap' => TRUE, 'mailtype' => 'html');

//        $config = Array(
//            'protocol' => 'smtp',
//            'smtp_host' => 'ssl://smtp.googlemail.com',
//            'smtp_port' => 465,
//            'smtp_user' => 'newshardcore@gmail.com',
//            'smtp_pass' => '@News123;',
//            'mailtype' => 'html',
//            'charset' => 'iso-8859-1',
//            'wordwrap' => TRUE
//        );



        $CI = & get_instance();
       // $CI->load->library('email',$config);
        $CI->load->library('email');
        $CI->email->set_newline("\r\n");
        $CI->email->from('noreply@zoney.pk', 'Zoney.pk');
        $CI->email->to($to);
        $CI->email->subject($subject);
        try {
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
           // echo 'success';
        } catch(Exception $e) {
            echo $e->getMessage();
        }
        //echo  $CI->email->print_debugger();

    }

}




if (!function_exists('sendEmail_mailin')) {

	function sendEmail_mailin($to, $subject, $user_data, $view) {
        $CI = & get_instance();

        if ($view && $view != NULL) {

            $message = $CI->load->view('email_templates/' . $view, $user_data, true);
        } else {
            if (is_array($user_data)) {
                $message = $user_data[0];
            } else {
                $message = $user_data;
            }
        }

        $mailin = new Mailin('asim.shahzad20@gmail.com', '8qxEJaUIkXZTnKhv');
        $mailin->
        addTo($to, '')->
        setFrom('noreply@zoney.pk', 'Zoney.pk')->
        setReplyTo('noreply@zoney.pk','Zoney.pk')->
        setSubject($subject)->
        setText('Hello')->
        setHtml($message);
        try {
            $res = $mailin->send();
        }
        catch (Exception $e) {
            echo 'Exception when calling EmailCampaignsApi->createEmailCampaign: ', $e->getMessage(), PHP_EOL;
        }


	}



}

if (!function_exists('detectUserLocation')) {

    function detectUserLocation() {
        $CI = & get_instance();
        $ip=$_SERVER['REMOTE_ADDR'];
        $user_location  = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
        $country = $user_location['geoplugin_countryName'];
        return $country;
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


if (!function_exists('user_have_wishlist')) {

    function user_have_wishlist($uid,$lid) {

        $CI = & get_instance();
        $CI->load->model('Wishlists_model');

        if ($data = $CI->Wishlists_model->is_user_has_wishlist($uid,$lid)) {

            return $data;

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


		sendEmail($MailUser->email, $subject, $UserData, 'contact-agent');

	}

}






if (!function_exists('ContactUsMail')) {

	function ContactUsMail($message) {
		$UserData['first_name'] = 'Admin';
		$UserData['headermessage'] = 'Contact US';
		$UserData['description'] = $message;
		sendEmail('arshad.jilani90@gmail.com', 'Contact US', $UserData, 'contact-form-submission');
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




if (!function_exists('time_ago_in_php')) {

    function time_ago_in_php($datetime) {

        date_default_timezone_set("Asia/Karachi");
        $time_ago        = strtotime($datetime);
        $current_time    = time();
        $time_difference = $current_time - $time_ago;
        $seconds         = $time_difference;

        $minutes = round($seconds / 60); // value 60 is seconds
        $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
        $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;
        $weeks   = round($seconds / 604800); // 7*24*60*60;
        $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
        $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60

        if ($seconds <= 60){

            return "Just Now";

        } else if ($minutes <= 60){

            if ($minutes == 1){

                return "one minute ago";

            } else {

                return "$minutes minutes ago";

            }

        } else if ($hours <= 24){

            if ($hours == 1){

                return "an hour ago";

            } else {

                return "$hours hrs ago";

            }

        } else if ($days <= 7){

            if ($days == 1){

                return "yesterday";

            } else {

                return "$days days ago";

            }

        } else if ($weeks <= 4.3){

            if ($weeks == 1){

                return "a week ago";

            } else {

                return "$weeks weeks ago";

            }

        } else if ($months <= 12){

            if ($months == 1){

                return "a month ago";

            } else {

                return "$months months ago";

            }

        } else {

            if ($years == 1){

                return "one year ago";

            } else {

                return "$years years ago";

            }
        }
    }

}






function randomNumber($length = 6)
{
	$characters = '0123456789';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++)
	{
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function randomString($length = 10)
{
	$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++)
	{
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function randomStrNum($length = 10)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++)
	{
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function upload_path($path)
{
	//var_dump(PHP_OS);
	if(PHP_OS == 'WIN32' or PHP_OS == 'WINNT' or PHP_OS == 'Windows')
		return str_ireplace('/', '\\', FCPATH.'assets/media/'.$path);
	else
		return str_ireplace('\\', '/', FCPATH.'assets/media/'.$path);
}

function base64_to_image($data='')
{
    $data = base64_decode( preg_replace('#^data:image/\w+;base64,#i', '', $data) );
    return $data;
}


/* Query Functions */
function getMaxID($table, $field, $where="")
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT MAX(".$field.") + 1 As UID FROM ".$table);
	if(!empty($where))
	{
		$query .= "";
	}

	if($query->num_rows() > 0)
	{
		$obj = $query->result();
		$obj = $obj[0];
		if ($obj->UID == NULL)
			$maxID = 1;
		else
			$maxID = $obj->UID;

		return (int) $maxID;
	}
	else
	{
		return msg_warning('There is no '.$options['name'].' yet.');
	}
}

function area_converter($areaType,$area){

    if($areaType == 'Marla'){
        $areaArray['square_feet']  = $area * 272.251;
        $areaArray['square_metres']  = $area * 25.2929;
        $areaArray['square_yards']  = $area * 30.2501;
        $areaArray['area_kanal']  = $area * 0.0500001;
        $areaArray['area_marla']  = $area;
        $areaArray['area_acre']  = $area * 0.00625001;
    }
    if($areaType == 'Square Feet'){
        $areaArray['square_feet']  = $area;
        $areaArray['square_metres']  = $area * 0.092903;
        $areaArray['square_yards']  = $area * 0.111111;
        $areaArray['area_kanal']  = $area * 0.000183655;
        $areaArray['area_marla']  = $area * 0.00367309;
        $areaArray['area_acre']  = $area * 2.29569;
    }
    if($areaType == 'Square Yards'){
        $areaArray['square_feet']  = $area * 9;
        $areaArray['square_metres']  = $area * 0.836127;
        $areaArray['square_yards']  = $area;
        $areaArray['area_kanal']  = $area * 0.00165289;
        $areaArray['area_marla']  = $area * 0.0330578;
        $areaArray['area_acre']  = $area * 0.000206612;
    }
    if($areaType == 'Square Meters'){
        $areaArray['square_feet']  = $area * 0.0395368;
        $areaArray['square_metres']  = $area;
        $areaArray['square_yards']  = $area * 1.19599;
        $areaArray['area_kanal']  = $area * 0.00197684;
        $areaArray['area_marla']  = $area * 0.0395368;
        $areaArray['area_acre']  = $area * 0.000247105;
    }
    if($areaType == 'Kanal'){
        $areaArray['square_feet']  = $area * 5445;
        $areaArray['square_metres']  = $area * 505.857;
        $areaArray['square_yards']  = $area * 605;
        $areaArray['area_kanal']  = $area;
        $areaArray['area_marla']  = $area * 20;
        $areaArray['area_acre']  = $area * 0.125 ;
    }

    if($areaType == 'Acre'){
        $areaArray['square_feet']  = $area * 43560;
        $areaArray['square_metres']  = $area * 4046.86;
        $areaArray['square_yards']  = $area * 4840;
        $areaArray['area_kanal']  = $area * 8;
        $areaArray['area_marla']  = $area * 160;
        $areaArray['area_acre']  = $area;
    }

    return $areaArray;

}





function slugit($title)
{
	$slugged = url_slug(
		"$title",
		array(
			'delimiter' => '-',
			'lowercase' => true
		)
	);
	$string = str_replace('quot-','',$slugged);
	$string = str_replace('-quot','',$string);
	$string = str_replace('-amp','',$string);
	$string = str_replace('amp-','',$string);
	return $string;
}

// function to prepare the slugging
function url_slug($str, $options = array())
{
	// Make sure string is in UTF-8 and strip invalid UTF-8 characters
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());

	$defaults = array(
		'delimiter' => '-',
		'limit' => null,
		'lowercase' => true,
		'replacements' => array(),
		'transliterate' => true,
	);

	// Merge options
	$options = array_merge($defaults, $options);

	$char_map = array(
		// Latin
		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
		'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
		'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
		'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
		'ß' => 'ss',
		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
		'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
		'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
		'ÿ' => 'y',

		// Latin symbols
		'©' => '(c)',

		// Greek
		'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
		'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
		'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
		'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
		'Ϋ' => 'Y',
		'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
		'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
		'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
		'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
		'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

		// Turkish
		'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
		'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',

		// Russian
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
		'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
		'Я' => 'Ya',
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
		'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
		'я' => 'ya',

		// Ukrainian
		'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
		'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

		// Czech
		'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
		'Ž' => 'Z',
		'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
		'ž' => 'z',

		// Polish
		'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
		'Ż' => 'Z',
		'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
		'ż' => 'z',

		// Latvian
		'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
		'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
		'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
		'š' => 's', 'ū' => 'u', 'ž' => 'z'
	);

	// Make custom replacements
	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

	// Transliterate characters to ASCII
	if ($options['transliterate']) {
		$str = str_replace(array_keys($char_map), $char_map, $str);
	}

	// Replace non-alphanumeric characters with our delimiter
	$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

	// Remove duplicate delimiters
	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

	// Truncate slug to max. characters
	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

	// Remove delimiter from ends
	$str = trim($str, $options['delimiter']);

	return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}


function post_query($content, $table)
{
	$CI =& get_instance();

	$date = date('Y-m-d H:i:s');

	if(isset($content['ajax']))
		unset($content['ajax']);
	if(isset($content['actioncall']))
		unset($content['actioncall']);

	// var_dump($content);exit();

	if( $content['timestamp'] )
	{
		$content['added_on'] = $date;
		$content['updated_on'] = $date;
		unset($content['timestamp']);
	}


	/*
	if(!isset($content['module']))
	{
		$content['added_by'] = $CI->session->userdata('username');
		$content['updated_by'] = $CI->session->userdata('username');
	}*/

	$fields = array();
	$values = array();

	foreach($content as $field => $value)
	{
		$fields[] = '`'.$field.'`';
		//$values[] = '"'.html_escape(remove_invisible_characters($CI->db->escape_str($value))).'"';
		$values[] = '"'.clean($value).'"';
	}
	// pre($fields);
	// pre($values);

	$query = "INSERT INTO `$table`";
	$query .= " (".implode(", ", $fields).") VALUES (".implode(", ", $values).")";

	// var_dump($content);exit();
	return $query;
}

function update_query($content, $table, $where)
{
	$CI =& get_instance();

	$date = date('Y-m-d H:i:s');

	if(isset($content['ajax']))
		unset($content['ajax']);
	if(isset($content['actioncall']))
		unset($content['actioncall']);

	//pre($content);

	/*if(isset($content['old_password']))
		$content['password_updated_on'] = $date;


	if( !isset($content['module']) && !isset($content['updated_by']) )
		$content['updated_by'] = $CI->session->userdata('username');

	if( isset($content['updated_by']) && $content['updated_by'] == 'skip' )
		unset($content['updated_by']);

	if( isset($content['updated_on']) && $content['updated_on'] == 'skip' )
		unset($content['updated_on']);
	else
		$content['updated_on'] = $date;*/

	if( $content['timestamp'] )
	{
		$content['added_on'] = $date;
		$content['updated_on'] = $date;
		unset($content['timestamp']);
	}

	$fields = array();
	$values = array();

	foreach($content as $field => $value)
	{
		//$data[] = '`'.$field.'` = "'.trim(html_escape(remove_invisible_characters($CI->db->escape_str($value)))).'" ';
		$data[] = '`'.$field.'` = "'.stripcslashes(clean($CI->db->escape_str($value))).'" ';
	}
	// pre($fields);
	// pre($values);

	$query = "UPDATE `$table` SET ";
	$query .= " ".implode(',', $data)." WHERE $where ";

	return $query;
}



/* Clean Functions */
function clean($str)
{
	$CI =& get_instance();
	$str = trim(html_escape(remove_invisible_characters($CI->db->escape_str(trim($str)))));
	$str = str_ireplace(';amp;amp;', ';', $str);
	$str = str_ireplace('&amp;amp;', '&amp;', $str);
	return $str;
}

function clean_output($str)
{
	$str = stripcslashes(html_entity_decode(stripcslashes($str)));
	return $str;
}

function clean_desc($string,$level='1',$chars=FALSE,$leave="")
{
	$string=preg_replace('/<script[^>]*>([\s\S]*?)<\/script[^>]*>/i', '', $string);
	switch ($level)
	{
		case  '3':
		if(empty($leave))
		{
			$search = array('@<script[^>]*?>.*?</script>@si',
							'@<[\/\!]*?[^<>]*?>@si',
							'@<style[^>]*?>.*?</style>@siU',
							'@<![\s\S]*?--[ \t\n\r]*>@'
			);
			$string = preg_replace($search, '', $string);
		}
		$string=strip_tags($string,$leave);
		if($chars)
		{
			if(phpversion() >= 5.4)
			{
				$string=htmlspecialchars($string, ENT_QUOTES | ENT_HTML5,"UTF-8");
			}
			else
			{
				$string=htmlspecialchars($string, ENT_QUOTES,"UTF-8");
			}
		}
		break;

		case  '2':
		$string=strip_tags($string,'<b><i><s><p><u><strong><span>');
		break;

		case  '1':
		$string=strip_tags($string,'<b><i><s><u><strong><a><pre><code><p><div><span>');
		break;
	}
	$string=str_replace('href=','rel="nofollow" href=', $string);
	return $string;
}



if (!function_exists('calculate_appointment_time')) {

    function calculate_appointment_time($appointment_times,$availability_times)
    {
        $time_form = $appointment_times[0]->start;
        $time_to = $appointment_times[0]->end;
        $dt = new DateTime($time_form);
        $dateslot = $dt->format('Y-m-d');
        $dt1 = new DateTime($time_to);
        $dateslot1 = $dt1->format('Y-m-d');

        $avaibilty_id = $appointment_times[0]->avail_id;
        $time1 = date("H:i",strtotime($time_form));
        $timeto = date("H:i",strtotime($time_to));
        $begin = new DateTime($time1);
        $end   = new DateTime($timeto);
        $interval = DateInterval::createFromDateString('60 min');
        $times    = new DatePeriod($begin, $interval, $end);
        foreach($times as $time) {
             $availbleslot= $time->format('H:i:s');
            $availbleslot2 = $time->add($interval)->format('H:i:s');

            echo '<div class="[ form-group col-md-6 ]">
            <input type="hidden" name="availabilityid" value="'.$avaibilty_id.'">
            <input type="checkbox" class="chekboxhide" name="appointment_time[]" value="'.$dateslot.' '.$availbleslot.'/'.$dateslot1.' '.$availbleslot2.'" id="fancy-checkbox-primary-'.$time->format('H').'" autocomplete="off" />
            <div class="[ btn-group ]">
                <label for="fancy-checkbox-primary-'.$time->format('H').'" class="[ btn btn-primary btnck ]">
                    <span class="[ glyphicon glyphicon-ok ]"></span>
                    <span> </span>
                </label>
                <label for="fancy-checkbox-primary-'.$time->format('H').'" class="[ btn btn-default btnfa active ]">';
            echo date("g:i a",strtotime($availbleslot)).'-'.date("g:i a",strtotime($availbleslot2));
            echo '</label>
                          </div>
                          </div>';

        }
        return;

    }
}


/* Clean HTML */
function cleanHTML($html)
{
	$html = stripcslashes(iconv('UTF-8', 'ASCII//TRANSLIT', html_entity_decode($html)));
	$html = str_ireplace('&nbsp;', ' ', $html);
	$html = preg_replace('/\s\s+/', ' ', $html);

	/* Removing MS Word formats */
	$html = preg_replace('/<!--\[if[^\]]*]>.*?<!\[endif\]-->/i', '', $html);
	$html = str_ireplace(array('class="MsoNormal"', 'class="MsoListParagraphCxSpFirst"', 'class="MsoListParagraphCxSpMiddle"', 'text-indent:-.25in;', '<a name="_GoBack"></a>'), '', $html);
	$html = preg_replace('#class="[^"]*"#i', '', $html);
	//$html = preg_replace('#style="[^"]*"#i', '', $html);
	//$html = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $html);
	return $html;
}

function oneLineHTML($html)
{
	// remove convert newlines and multiple spaces into 1 space
	$html = preg_replace("/\s+|\n+|\r/", ' ', $html);
	return $html;
}

/* Messages Alert */
function msg_alert($type,$text)
{
	return '<div class="alert alert-'.$type.'">'.$text.'</div>';
}

function msg_success($str, $center = 'no', $custom_id = '')
{
	if( !empty($custom_id) )
		$custom_id = 'id="'.$custom_id.'"';

	if( $center !== 'no' )
		return '<div '.$custom_id.' class="alert alert-success text-center">'.$str.'</div>';
	else
		return '<div '.$custom_id.' class="alert alert-success">'.$str.'</div>';
}

function msg_warning($str, $center = 'no', $custom_id = '')
{
	if( !empty($custom_id) )
		$custom_id = 'id="'.$custom_id.'"';

	if( $center !== 'no' )
		return '<div '.$custom_id.' class="alert alert-warning text-center">'.$str.'</div>';
	else
		return '<div '.$custom_id.' class="alert alert-warning">'.$str.'</div>';
}

function msg_info($str, $center = 'no', $custom_id = '')
{
	if( !empty($custom_id) )
		$custom_id = 'id="'.$custom_id.'"';

	if( $center !== 'no' )
		return '<div '.$custom_id.' class="alert alert-info text-center">'.$str.'</div>';
	else
		return '<div '.$custom_id.' class="alert alert-info">'.$str.'</div>';
}

function msg_danger($str, $center = 'no', $custom_id = '')
{
	if( !empty($custom_id) )
		$custom_id = 'id="'.$custom_id.'"';

	if( $center !== 'no' )
		return '<div '.$custom_id.' class="alert alert-danger text-center">'.$str.'</div>';
	else
		return '<div '.$custom_id.' class="alert alert-danger">'.$str.'</div>';
}


/* Debugging Functions */
function pr($data)
{
	echo "<pre>";print_r($data);echo "</pre>";
}

function pre($data)
{
	echo "<pre>";print_r($data);echo "</pre>";exit();
}

function vd($data)
{
	echo "<pre>";var_dump($data);echo "</pre>";
}

function vde($data)
{
	echo "<pre>";var_dump($data);echo "</pre>";exit();
}
