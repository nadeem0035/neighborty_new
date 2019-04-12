<?php

Class Api_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_user($id)
    {
        $this->db->select('id,referral,first_name,last_name,email,phone,location,address,user_type,languages,user_specialities,picture,birth_date,address,city,state,zip,country,active,registered_date,gender,about,real_estate_license,phone_secondary,area,state_code,street');
        $this->db->from('users');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function login($email, $password) {

        $this->db->select('id,city,state,area,first_name,phone, last_name,email,user_type,agent_type,picture,about, active');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('password', MD5($password));
        $this->db->where('active', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function register($user) {
        $this->db->select('id, email');
        $this->db->from('users');
        $this->db->where('email', $user['email']);
        $this->db->where('oauth_provider', $user['oauth_provider']);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return false;
        } else {
            $this->db->insert('users', $user);
           // echo $this->db->last_query();
            //return true;
            return $this->db->insert_id();
        }
    }

    public function verifyEmailAddress($hash) {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('hash', $hash);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $user = $query->row();
            $this->remove_user_hash($user->id);
            return $user;
        } else {
            return false;
        }
    }

    public function remove_user_hash($id) {
        $data = array(
            'hash' => '',
            'active' => 1,
            'claimed'=>1
        );
        $this->db->where('id', $id);

        if ($this->db->update('users', $data)) {
            return true;
        } else {
            return false;
        }
    }


    public function social_login($user) {
        $this->db->select('id,first_name,last_name,email,user_type,picture, active');
        $this->db->from('users');
        $this->db->where('email', $user['email']);
        $this->db->where('oauth_provider', $user['oauth_provider']);
        $this->db->where('oauth_uid', $user['oauth_uid']);
        $this->db->where('active', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function CheckEmailAddress($hash) {

        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('hash', $hash);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row('id');
        } else {
            return false;
        }
    }

    public function getAllListingCount(){
        $this->db->select('id');
        $this->db->from('listing');
        $this->db->where('status', 'publish');
        $query = $this->db->get();
        $count = $query->num_rows();
        return $count;

    }




    public function update_hash_on_resendCode($id, $hash) {
        $this->db->set('hash', $hash, FALSE);
        $this->db->set('attempts','attempts+1', FALSE);
        $this->db->where('hash !=','');
        $this->db->where('id', $id, FALSE);
        $this->db->update('users');
        return true;
    }



    public function update_user_hash($id, $hash) {
        $data = array(
            'hash' => $hash
        );
        $this->db->where('id', $id);


        if ($this->db->update('users', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function forgetpassword($email) {

        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row('id');
        } else {
            return false;
        }
    }

    public function update_password($id, $password) {
        $data = array(
            'hash' => '',
            'password' => $password,
          //  'active' => 1
        );
        $this->db->where('id', $id);

        if ($this->db->update('users', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function UpdateOldPassword($id, $oldpassword, $newpassword) {

        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('password', $oldpassword);
        //$this->db->where('active', 1);
        $this->db->where('id', $id);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $this->db->where('id', $id);
            if ($this->db->update('users', array('password' => $newpassword))) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function edit_profile($user, $uid)
    {
        if( $this->db->update('users', $user, array('id' => $uid)) )
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function get_user_id_from_email($email)
    {

        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('email', $email);

        return $this->db->get()->row('id');
    }

    public function listing_gallery_by_listings_id($id)
    {

        $this->db->select('id,listing_id,picture');
        $this->db->from('listing_pictures');
        $this->db->where('listing_id',$id);
        $this->db->where('active',1);

        $query = $this->db->get();

        return $query->result();


    }

    public function get_user_listing($uid) {

        $this->db->select('id,summary,user_id,bedrooms,bathrooms,title,price,contact_primary,purpose,city,area,state_province,country,preview_image_url as image,slug,property_location,area_sqrft,property_type,property_sub_type,listing.latitude,longitude,land_area,unit_id,video,is_featured,views,expires,date_created');
        $this->db->from('listing');
        $this->db->where('user_id', $uid);
        // $this->db->where('status',$status);
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();
    }

    public function createWishlist($data)
    {
        $this->db->insert('wishlists', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }


    public function get_user_specific_detail($id, $data) {
        if (empty($data)) {
            return;
        }
        if (is_array($data)) {
            $string = rtrim(implode(',', $arr), ',');
            $this->db->select($string);
        } else {
            $this->db->select($data);
        }
        $this->db->from('users');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function transactions($uid) {

        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where('user_id', $uid);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getTransactionsByDate($date,$uid){

        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where('user_id', $uid);
        if($date != 'ALL'){

           $this->db->where('process_date > DATE_SUB(NOW(), INTERVAL 1 '.$date.')');
        }

        $this->db->order_by("id", "DESC");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }


    }

    public function VerificationStatus($uid) {
        $this->db->select('status,status_note');
        $this->db->from('trust_verification');
        $this->db->where('user_id', $uid);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function TrustVerification($verification) {
        $this->db->select('id');
        $this->db->from('trust_verification');
        $this->db->where('user_id', $verification['user_id']);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $this->db->update('trust_verification', $verification, array('id' => $query->row('id')));
            return true;
        } else {
            $this->db->insert('trust_verification', $verification);
            return true;
        }
    }

    function getAgentListings($uid){

        $categories = array('Publish','Review');
        $cate = array('sale','rent');

        $this->db->select('*');
        $this->db->from('listing');
        $this->db->where('user_id', $uid);
        $this->db->where_in('purpose', $cate);
        $this->db->where_in('status', $categories);
        //echo $this->db->last_query();
        $query = $this->db->get();
        return $query;

    }

    public function all_funds($uid, $date) {

        $this->db->select('a_debits,a_credits,p_debits,p_credits', false);
        $this->db->from("(SELECT user_id,
        SUM(case when transaction_type='Debit' AND status IN('Ok','process') then amount else 0 end) AS a_debits,
        SUM(case when transaction_type='Credit'AND status IN('Ok','process') then amount else 0 end) AS a_credits,
        SUM(case when transaction_type='Debit' AND status = 'pending' then amount else 0 end) AS p_debits,
        SUM(case when transaction_type='Credit'AND status = 'pending' then amount else 0 end) AS p_credits
        FROM transaction   GROUP BY user_id) a", false);
        $this->db->where('user_id', $uid);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function widthdrawFunds($data){

         $this->db->insert('widthdraw', $data);
         return $this->db->insert_id();

    }

    public function add_withdraw_transaction($data){

        $this->db->insert('transaction', $data);
        return true;

    }


    public function get_listing_for_search_page($params = array(),$sorting='100',$status='publish')
    {
        $stack = array();
        $GET = $this->input->get(NULL, TRUE);
        $latitude = $this->input->get_post('latitude');
        $longitude = $this->input->get_post('longitude');
        $dist = 10;
        $sql = " `listing`.`id` as listid,`listing`.`status`,`listing`.`unit_id`,`listing`.`area`,`listing`.`land_area`,`title`, `purpose`,`listing.user_id`, `slug`, `listing`.`price`,`preview_image_url` AS `image`, `summary`, `latitude`, `longitude`,`property_location`, `city`, `state_province`, `area_marla`, `area_kanal`, `area_actre`, `area_sqrft`, `area_sqmeter`, `area_sqyard`,`country`,`property_street`,`property_type`,`bedrooms`,`bathrooms`,`is_featured`,`date_created`,w.id as wishlistId,w.user_id as wUserId";

        if(!empty($latitude) && !empty($longitude)){
           $sql = $sql.", ACOS( SIN( RADIANS( `latitude` ) ) * SIN( RADIANS( $latitude ) ) + COS( RADIANS( `latitude` ) )* COS( RADIANS( $latitude )) * COS( RADIANS( `longitude` ) - RADIANS( $longitude )) ) * 6380 AS `distance`";

        }
        //pre($sql);

        $this->db->select($sql);


        //Google HIDDNEN SEARCH VALUES

        $street = $this->input->get_post('street');
        $city = $this->input->get_post('city');
        $city_area = $this->input->get_post('sub_area');
        $state = $this->input->get_post('state');
        $state_code = $this->input->get_post('state_code');
        $country = $this->input->get_post('country');

        //FOR SEARCH BY MAP
        $search_by_map = $this->input->get_post('search_by_map');
        $sw_lat = $this->input->get_post('sw_lat');
        $sw_lng = $this->input->get_post('sw_lng');
        $ne_lat = $this->input->get_post('ne_lat');
        $ne_lng = $this->input->get_post('ne_lng');
        $status_ajax = $this->input->get_post('status_ajax');

        $type_listing = $this->input->get_post('type');
        $is_moved = $this->input->get_post('move');

        if ($is_moved == 'yes') {
            $type_listing = $this->input->get_post('list_type');
        } else {
            $type_listing = $this->input->get_post('type');
        }

        $property_type = $this->input->get_post('property_type');
        //pre($property_type);

        $user_types = $this->input->get_post('user_type');
        $area = $this->input->get_post('area');


        $home_types = $this->input->get_post('home_types');

        //FROM SLIDER
        $min = $this->input->get_post('price_min');
        $max = $this->input->get_post('price_max');
        if (isset($min) && isset($max)) {

            $min = ltrim(preg_replace('/[^0-9]/', '', $min), "$ ");
            $max = ltrim(preg_replace('/[^0-9]/', '', $max), "$ ");
        }

        //FOR SIZE
        $min_bedrooms = $this->input->get_post('beds');
        $min_bathrooms = $this->input->get_post('bathrooms');
        $min_area = $this->input->get_post('min_area');
        $max_area = $this->input->get_post('max_area');
        $price_min = $this->input->get_post('price_min');
        $price_max = $this->input->get_post('price_max');
        $is_ajax= $this->input->get_post('ajax');
        $ajax_value= $this->input->get_post('ajax_value');

        //AMENITIES ARRAY
        $hosting_amenities = $this->input->get_post('amenities');

        $sort = $this->input->get_post('sort');
        if (empty($sort)) {
            $sort = 1;
        }

        $condition = '';

        $location = $this->input->get_post('location');
        $pieces = explode(",", $location);
        $len = count($pieces);


        $today =date('Y-m-d');

        if($status =='publish' | $status_ajax =='publish'){
            $condition .= "(`listing.status` = 'publish')";
        }
        if($status == 'premium'){
            if($is_ajax == 1 && $ajax_value != 1){
                $condition .= " AND ";
            }
            $condition .= "(`listing.status` = 'premium' AND `listing.end_date` >= '$today' )";
        }

        //  $condition .= " OR ";
        //  $condition .= "(`listing.status` = 'premium' AND `listing.end_date` >= '$today' )";

        if ($search_by_map == 'true') {

            $condition .= "AND (`latitude` BETWEEN $sw_lat AND $ne_lat) AND (`longitude` BETWEEN '".$this->input->get_post('sw_lng')."' AND $ne_lng)";

        } else {

            if (!is_numeric($location)) {
                if ($location != '' && $country == '') {
                    $i = 1;
                    foreach ($pieces as $address) {
                        $this->db->flush_cache();
                        $address = $this->db->escape_like_str($address);

                        if ($i == $len)
                            $and = "";
                        else
                            $and = " OR ";

                        if ($i == 1)
                            $condition .= " AND (";

                        $condition .= "`property_street`  LIKE '%" . trim($address) . "%' " . $and;

                        if ($i == $len)
                            $condition .= ")";

                        $i++;
                    }
                }
            }
        }

        if (!empty($property_type) && ($property_type == "rent" || $property_type == "sale")) {

            $condition .= " AND (`listing.purpose` = '". $property_type . "')";
        }

        /*if (!empty($property_type)) {
             if (is_array($property_type)) {
                 if (count($property_type) > 0) {
                     $i = 1;
                     foreach ($property_type as $property) {

                         if ($i == count($property_type)) {
                             $and = "";
                         } else {
                             $and = " OR ";
                         }

                         if ($i == 1)
                             $condition .= " AND (";

                         $condition .= "`listing.purpose` = '" . $property . "'" . $and;

                         if ($i == count($property_type))
                             $condition .= ")";

                         $i++;
                     }
                 }
             }
         }*/

        if (!empty($user_types)) {
            if (is_array($user_types)) {
                if (count($user_types) > 0) {
                    $i = 1;
                    foreach ($user_types as $user) {
                        if ($i == count($user_types)) {
                            $and = "";
                        } else {
                            $and = " OR ";
                        }

                        if ($i == 1)
                            $condition .= " AND (";

                        $condition .= "`listing.listing_owner` = '" . $user . "'" . $and;

                        if ($i == count($user_types))
                            $condition .= ")";

                        $i++;
                    }
                }
            }
        }

        if (!empty($type_listing) && ($type_listing == "rent" || $type_listing == "sale")) {

            $condition .= " AND (`listing.purpose` = '". $type_listing . "')";
        }


        //INCASE IF WE DO SEARCH WITH REPSECT TO MAP

        if(!empty($stack))
        {
            $condition .= " AND (`id` NOT IN(".implode(',',$stack)."))";
        }

        if (!empty($min_bedrooms)) {

            $condition .= " AND (`listing.bedrooms` >= '". $min_bedrooms . "')";
        }

        if (!empty($min_bathrooms)) {

            $condition .= " AND (`listing.bathrooms` >= '". $min_bathrooms . "')";
        }
        if ($home_types[0] == '') {
            $home_types = 'homes';
        }


        if (!empty($home_types)) {

            if (is_array($home_types)) {
                if (count($home_types) > 0) {
                    $i = 1;
                    foreach ($home_types as $home_type) {
                        if ($i == count($home_types)) {
                            $and = "";
                        } else {
                            $and = " OR ";
                        }

                        if ($i == 1)
                            $condition .= " AND (";

                        $condition .= "`listing.property_type` = '" . $home_type . "'" . $and;

                        if ($i == count($home_types))
                            $condition .= ")";

                        $i++;
                    }
                }
            }
        }

        if ($search_by_map != 'true') {
            if (!empty($city)) {
                $condition .= " AND (`listing.city` = '" . $city . "')";
            }

            if (!empty($city_area)) {
                $condition .= " AND (`listing.area` = '" . $city_area . "')";
            }

            if (!empty($country)) {
                $condition .= " AND (`listing.country` = '" . $country . "')";
            }
        }

        if(!empty($latitude) && !empty($longitude)) {
            $condition .= " AND (ACOS( SIN( RADIANS( `latitude` ) ) * SIN( RADIANS( $latitude ) ) + COS( RADIANS( `latitude` ) )* COS( RADIANS( $latitude )) * COS( RADIANS( `longitude` ) - RADIANS( $longitude )) ) * 6380 < 10)";
        }






        if(!empty($area)){

            $condition .= " AND (`listing.unit_id` = '" . $area . "')";

        }

        if (isset($min_area) && $min_area!="") {
            if ($min_area > 0) {
                if(!empty($area)){

                    if($area == 'Square Feet'){
                        $condition .= " AND (`listing.area_sqrft` >= '" . $min_area . "')";
                    }

                    if($area == 'Square Yards'){
                        $condition .= " AND (`listing.area_sqyard` >= '" . $min_area . "')";
                    }

                    if($area == 'Square Meters'){
                        $condition .= " AND (`listing.area_sqmeter` >= '" . $min_area . "')";
                    }

                    if($area == 'Marla'){
                        $condition .= " AND (`listing.area_marla` >= '" . $min_area . "')";
                    }

                    if($area == 'Kanal'){
                        $condition .= " AND (`listing.area_kanal` >= '" . $min_area . "')";
                    }

                }
                else{
                    $condition .= "AND  (`listing.area_sqrft` >= '" . $min_area . "') OR (`listing.area_sqyard` >= '" . $min_area . "') OR (`listing.area_sqmeter` >= '" . $min_area . "') OR (`listing.area_marla` >= '" . $min_area . "') OR (`listing.area_kanal` >= '" . $min_area . "')";
                }
                // $condition .= " AND (`listing.area` >= '" . $min_area . "')";
            }
        } else {
            if (isset($max_area) && $max_area!="") {
                $min_area = 0;
            }
        }

        if (isset($max_area) && $max_area!="") {
            if ($max_area > $min_area) {

                if(!empty($area)){

                    if($area == 'Square Feet'){
                        $condition .= " AND (`listing.area_sqrft` <= '" . $max_area . "')";
                    }

                    if($area == 'Square Yards'){
                        $condition .= " AND (`listing.area_sqyard` <= '" . $max_area . "')";
                    }

                    if($area == 'Square Meters'){
                        $condition .= " AND (`listing.area_sqmeter` <= '" . $max_area . "')";
                    }

                    if($area == 'Marla'){
                        $condition .= " AND (`listing.area_marla` <= '" . $max_area . "')";
                    }

                    if($area == 'Kanal'){
                        $condition .= " AND (`listing.area_kanal` <= '" . $max_area . "')";
                    }

                }
                else{
                    $condition .= "AND  (`listing.area_sqrft` <= '" . $max_area . "') OR (`listing.area_sqyard` <= '" . $max_area . "') OR (`listing.area_sqmeter` <= '" . $max_area . "') OR (`listing.area_marla` <= '" . $max_area . "') OR (`listing.area_kanal` <= '" . $max_area . "')";
                }
                //$condition .= " AND (`listing.area` <= '" . $max_area . "')";
            }
        }

        if (isset($max_area) && $max_area!="") {
            if ($min_area == $max_area) {


                if(!empty($area)){

                    if($area == 'Square Feet'){
                        $condition .= " AND (`listing.area_sqrft` = '" . $max_area . "')";
                    }

                    if($area == 'Square Yards'){
                        $condition .= " AND (`listing.area_sqyard` = '" . $max_area . "')";
                    }

                    if($area == 'Square Meters'){
                        $condition .= " AND (`listing.area_sqmeter` = '" . $max_area . "')";
                    }

                    if($area == 'Marla'){
                        $condition .= " AND (`listing.area_marla` = '" . $max_area . "')";
                    }

                    if($area == 'Kanal'){
                        $condition .= " AND (`listing.area_kanal` = '" . $max_area . "')";
                    }

                }
                else{
                    $condition .= "AND  (`listing.area_sqrft` = '" . $max_area . "') OR (`listing.area_sqyard` = '" . $max_area . "') OR (`listing.area_sqmeter` = '" . $max_area . "') OR (`listing.area_marla` = '" . $max_area . "') OR (`listing.area_kanal` = '" . $max_area . "')";
                }



                // $condition .= " AND (`listing.area` = '" . $max_area . "')";
            }
        }

        $amenities_str = "";

        if (is_array($hosting_amenities)) {
            if (count($hosting_amenities) > 0) {
                $amenities_str = implode(',', $hosting_amenities);
            }
        }
        if (isset($min) && $min!="") {
            if ($min > 0) {
                $condition .= " AND (`listing.price` >= '" . $min . "')";
            }
        } else {
            if (isset($max) && $max!="") {
                $min = 0;
            }
        }

        if (isset($max) && $max!="") {
            if ($max > $min) {
                $condition .= " AND (`listing.price` <= '" . $max . "')";
            }
        }

        if (isset($max) && $max!="") {

            if ($max == $min) {
                $condition .= " AND (`listing.price` = '" . $max . "')";
            }
        }


        if($sorting == 'date-posted')
        {
            $order_by = ' `listing.id` ASC';
        }
        elseif ($sorting == 'low-to-high')
        {
            $order_by = ' `listing.price` ASC';
        }
        elseif ($sorting == 'high-to-low')
        {
            $order_by = ' `listing.price` DESC';
        }

        else
        {
            $order_by = ' `listing.id` ASC';
        }

        $this->db->from('listing');
        // $this->db->join('listing_pictures as p', 'p.listing_id = listing.id');
        $this->db->join('wishlists as w', 'w.listing_id = listing.id','left');
        $this->db->where($condition);
        $this->db->distinct();
        if (isset($hosting_amenities)) {
            $this->db->join('listing_amenities', 'listing_amenities.listing_id = listing.id');
            $this->db->where_in('listing_amenities.amenities_id', $amenities_str);
        }

        if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit']);
        }

        if($status == 'publish'){

            $this->db->order_by($order_by);

        }else{

            $this->db->order_by('listing.id', 'RANDOM');
        }

        $this->db->group_by('listing.id ');
        $query = $this->db->get();

        //echo $this->db->last_query();
        return $query; // exit;
    }

    public function get_popular_listing_for_search_page(){

        $this->db->select("`listing`.`id` as listid,`listing`.`status`,`listing`.`unit_id`,`listing`.`area`,`listing`.`land_area`,`title`, `purpose`,`listing.user_id`, `slug`, `listing`.`price`,`preview_image_url` AS `image`, `summary`, `latitude`, `longitude`,`property_location`, `city`, `state_province`, `area_marla`, `area_kanal`, `area_actre`, `area_sqrft`, `area_sqmeter`, `area_sqyard`,`country`,`property_street`,`property_type`,`bedrooms`,`bathrooms`,`is_featured`,`views`,`date_created`,w.id as wishlistId,w.user_id as wUserId");
        $this->db->from('listing');
        $this->db->join('wishlists as w', 'w.listing_id = listing.id','left');
      /*  $this->db->where('listing.status','publish');*/
        $this->db->order_by('views','DESC');
        $this->db->limit('20');
        $query = $this->db->get();
        return $query;

    }



    public function getUserWishlists($uid)
    {
        $this->db->select('*');
        $this->db->from('wishlists');
        $this->db->where('user_id', $uid);
        $this->db->where('wishlist_categories', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {

            return null;
        }


    }

    public function getWishlistsByUserId($uid) {

        $this->db->select('wishlist_categories.id as categoryid,wishlist_categories.name,listing.id as listingid,listing.title,listing.slug,listing.property_type,listing.preview_image_url,listing.bedrooms,listing.bathrooms,listing.area_sqrft,listing.price,listing.land_area,listing.unit_id,listing.date_created,wishlists.id,count(wishlists.id) as total');
        $this->db->from('wishlist_categories');
        $this->db->where('wishlist_categories.status', '1');
        $this->db->where_in('wishlist_categories.created_by',$uid);
        $this->db->join('wishlists', 'wishlists.wishlist_categories = wishlist_categories.id','left');
        $this->db->join('listing', 'listing.id = wishlists.listing_id','left');
        $this->db->distinct();
        $this->db->group_by('categoryid');
        $query = $this->db->get();

        //echo $query->num_rows();
        // echo $this->db->last_query();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return 0;
        }

    }

    public function getWishlistCategories($uid)  {
        $this->db->select('id,name');
        $this->db->from('wishlist_categories');
        $this->db->where('status', '1');
        $this->db->where_in('created_by',$uid);
        $query = $this->db->get();
        if( $query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function setDefaultWishlist($data){
        if ($this->db->insert('wishlist_categories', $data)) {
            $cat_id = $this->db->insert_id();
            return $cat_id;
        } else {
            return false;
        }

    }

    public function wishlistDetails($id)
    {

         $this->db->select('wishlists.id,wishlists.note,wishlists.status,listing.id as listingid,listing.summary,listing.status,listing.purpose,listing.user_id,listing.bedrooms,listing.bathrooms,listing.title,listing.price,listing.preview_image_url as image,listing.slug,listing.property_location,listing.area_sqrft,listing.property_type,listing.latitude,listing.longitude,listing.is_featured,listing.land_area,listing.unit_id,listing.date_created,u.id as userid,u.email,u.phone');
        $this->db->from('listing');
        $this->db->where('wishlists.user_id', $id);
        $this->db->join('wishlists','listing.id = wishlists.listing_id','left');
        $this->db->join('users as u','u.id = listing.user_id','left');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 0;
        }

    }

    function AddAgentReviews($reviews) {
        $this->db->select('id');
        $this->db->from('reviews');
        $this->db->where('agent_id', $reviews['agent_id']);
        $this->db->where('reviews_by', $reviews['reviews_by']);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return false;
        } else {
            $this->db->insert('reviews', $reviews);

            $this->db->where('user_id',$reviews['agent_id']);
            $q = $this->db->get('user_stats');
            if ( $q->num_rows() > 0 )
            {
                $rating = $reviews['knowledge']+$reviews['expertise']+$reviews['responsiveness']+$reviews['negotiation_skills'];
                $this->db->set('rating', 'rating+'.$rating, FALSE);
                $this->db->set('reviews', 'reviews+1', FALSE);
                $this->db->update('user_stats');
            }
            return true;
        }
    }

    function contactAgent($data)
    {
        if ($this->db->insert('contact_agents', $data)) {
            return true;
        } else {
            return false;
        }

    }

    function  get_search_log($id){
        $this->db->select('*');
        $this->db->from('search_logs');
        $this->db->where('id', $id);
        return $this->db->get()->row();

    }
    function  get_user_search_log($id){
        $this->db->select('*');
        $this->db->from('search_logs');
        $this->db->where('user_id', $id);
        return $this->db->get()->result();


    }










}

?>