<?php

Class Agents_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_model', 'common', true);
    }



    public function getAgentsList() {

        $this->db->select('u.*,AVG(r.knowledge+r.expertise+r.responsiveness+r.negotiation_skills)/4 as rating');
        $this->db->from('users u');
        $this->db->join('reviews as r', 'r.agent_id = u.id', 'left');
        $this->db->group_by('u.id');
        $this->db->where('u.user_type', 'Agent');
        $this->db->where('u.is_admin', 0);
        $this->db->or_where('u.user_type', 'Both');
        $this->db->order_by('rating', 'DESC');
        $this->db->order_by('registered_date', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function soldCount($uid)
    {

        $this->db->select('id')
            ->from('listing')
            ->where('status', 'sold')
            ->where('user_id', $uid);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return 0;
        }

    }

    public function saleCount($uid)
    {
        $this->db->select('id')
            ->from('listing')
            ->where('status', 'available')
            ->where('user_id', $uid);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return 0;
        }

    }

    public function reviewCount($uid)
    {
        $this->db->select('id')
            ->from('reviews')
            ->where('agent_id', $uid);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return 0;
        }

    }


    public function recommendation_count($uid)
    {
        $this->db->select('id')
            ->from('recommendations')
            ->where('status', '1')
            ->where('agent_id', $uid);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return 0;
        }

    }


    public function count_review_rating($id) {

        $this->db->select('SUM(knowledge + expertise + responsiveness + negotiation_skills) as rating');
        $this->db->from('reviews');
        $this->db->where('agent_id',$id);
        $query = $this->db->get();

        //echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }

    }




    public function getAgentDetail($id) {
        $this->db->select('u.*,t.balance as topup');
        $this->db->from('users as u');
        $this->db->join('topup_balance as t', 't.agent_id = u.id', 'left');
        $this->db->where('u.id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
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



           // echo $this->db->last_query();
            //Update booking table status
            // $this->db->where('id', $reviews['agent_id']);
            // $this->db->update('booking', array('status' => 'complete'));
            return true;
        }
    }
    function GetLetestReviews()
    {
        $this->db->select('r.*,u.`id`,u.`first_name`,u.`first_name`,u.`last_name`,u.`picture`,(r.knowledge+r.expertise+r.responsiveness+r.negotiation_skills)/4 as rating');
        $this->db->from('reviews as r');
        $this->db->join('users as u', 'r.reviews_by = u.id', 'left');
        $this->db->order_by('r.id', 'DESC');
        $this->db->limit(2);
        // $query = $this->db->get();
        // echo $this->db->last_query();
        return $this->db->get()->result();

    }


    public function get_user_bookings($id) {

        $this->db->select('*');
        $this->db->from('booking');
        $this->db->where('user_id', $id);
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();

    }


    function ContactPropertyAgent($data) {

        $values = array_values($data);
        $this->db->select('id');
        $this->db->from('listing_applications');
        $this->db->where('applicant_id', $values[2]);
        $this->db->where('listing_id',$values[1]);
        $this->db->limit(1);
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return false;
        } else {
            $this->db->insert('listing_applications', $data);
           
            $rid = $values[0];
            $lid = $values[1];
            $sid = $values[2];
            $msg = $values[5];
            $sql = "INSERT INTO messages (receiver_id,sender_id,type,message,listing_id,read_status) " .
                "VALUES ('{$rid}','{$sid}','Applied','{$msg}','{$lid}',0)";
            $this->db->query($sql);

            return true;
        }
    }

    function getJoinedAgentListings($type,$uid,$property_type,$params = array())
    {

        $this->db->select('l.*,u.`first_name`,u.`last_name`,u.`phone,count(p.id) as photos,w.id as wishlistId,w.user_id as wUserId');
        $this->db->from('listing as l');
        $this->db->join('users as u', 'l.user_id = u.id', 'left');
        $this->db->join('listing_pictures as p', 'p.listing_id = l.id','left');
        $this->db->join('wishlists as w', 'w.listing_id = l.id');
        $this->db->where('l.user_id', $uid);
        $this->db->where('l.status', 'Publish');
        $this->db->or_where('l.status', 'Review');
        $this->db->or_where('l.status', 'Sold');
       // $this->db->or_where('l.status' != 'Pending');

        if($type !='all'){

            $this->db->where('l.property_type', $type);

        }

        if($property_type == 'rent' || $property_type == 'sale'){

            $this->db->where('l.property_type', $property_type);
        }

        $this->db->group_by(' l.id ');


        $query = $this->db->get();

        //echo $this->db->last_query();
        return $query;

    }

    function getAgentListings($type,$uid,$property_type,$params = array())
    {

        $this->db->select('l.*,u.`first_name`,u.`last_name`,u.`phone,count(p.id) as photos,w.id as wishlistId,w.user_id as wUserId');
        $this->db->from('listing as l');
        $this->db->join('users as u', 'l.user_id = u.id', 'left');
        $this->db->join('listing_pictures as p', 'p.listing_id = l.id','left');
        $this->db->join('wishlists as w', 'w.listing_id = l.id','left');
        $this->db->where('l.user_id', $uid);
        $this->db->where('l.status', 'Publish');
        $this->db->or_where('l.status', 'Review');
        $this->db->or_where('l.status', 'Sold');
        // $this->db->or_where('l.status' != 'Pending');

        if($type !='all'){

            $this->db->where('l.property_type', $type);

        }

        if($property_type == 'rent' || $property_type == 'sale'){

            $this->db->where('l.property_type', $property_type);
        }

        $this->db->group_by(' l.id ');


        $query = $this->db->get();

        //echo $this->db->last_query();
        return $query;

    }




    function getAgentSaleListings($uid){

        $categories = array('Publish','Review');

        $this->db->select('id');
        $this->db->from('listing');
        $this->db->where('user_id', $uid);
        $this->db->where('purpose', 'sale');
        $this->db->where_in('status', $categories);
        //echo $this->db->last_query();
        $query = $this->db->get();
        return $query;

    }


    function getAgentRentListings($uid){
        $categories = array('Publish','Review');
        $this->db->select('id');
        $this->db->from('listing');
        $this->db->where('user_id', $uid);
        $this->db->where('purpose', 'rent');
        $this->db->where_in('status', $categories);
        $query = $this->db->get();
        return $query;

    }

    function getAgentSoldListings($uid){
       // $categories = array('Publish','Review');
        $this->db->select('id');
        $this->db->from('listing');
        $this->db->where('user_id', $uid);
        $this->db->where('status', 'Sold');
        $this->db->or_where('status', 'Rented');
     //   $this->db->where_in('status', $categories);
        $query = $this->db->get();

        return $query;

    }

    function getAgentListing($uid) {

        $this->db->select('*');
        $this->db->from('listing');
        $this->db->where('user_id', $uid);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


    function agentsSearch($params = array(),$data)

    {

        $condition = '';
        $condition .= "(`u.active` = '1')";
        $location = addslashes(urldecode($this->input->get('agent_location')));
        $street = addslashes(urldecode($this->input->get('street')));
        $city = addslashes(urldecode($this->input->get('city')));
        $state = addslashes(urldecode($this->input->get('state')));
        $country = $this->input->get('country');
        $name = $this->input->get('name');
        $languages = $this->input->get('languages');
        $looking_for = $this->input->get('type');
        $home_type = $this->input->get('home_type');
        $min = $this->input->get('price_min');
        $max = $this->input->get('price_max');

        if(isset($min) && isset($max)) {

            $min = ltrim(preg_replace('/[^0-9]/', '', $min), "Rs ");
            $max = ltrim(preg_replace('/[^0-9]/', '', $max), "Rs ");
        }

        //$this->db->select('u.`id`,u.`first_name`,u.`first_name`,u.`last_name`,u.`picture`,u.`city`,u.`country`,(r.knowledge+r.expertise+r.responsiveness+r.negotiation_skills)/4 as rating,count(r.agent_id) as total');

        //    sum(case when rec.status = "1" then 1 else 0 end) as recommendations,
        //r.knowledge,r.expertise,r.responsiveness,r.negotiation_skills,r.id as rid,r.review_title,
        $this->db->select('u.id,u.first_name,u.last_name,u.email,u.phone,u.languages,u.agent_type,u.address,u.city,u.zip,u.country,u.picture,u.registered_date,count(l.id) as total,
        sum(r.knowledge+r.expertise+r.responsiveness+r.negotiation_skills)/count(r.id) as max_rev,
        sum(case when l.property_type = "rent" then 1 else 0 end) as rented,
        sum(case when l.property_type = "sale" then 1 else 0 end) as forsale,
        sum((case when l.property_type = "rent" then 1 else 0 end)+(case when l.property_type = "sale" then 1 else 0 end)) as SubTotal, 
        sum(case when l.status = "Sold" then 1 else 0 end) as sold,l.home_type,l.price');


        if (!empty($city)) {
            $condition .= " AND (`city` = '" . $city . "')";
        }

        if (!empty($state) && !empty($state_code)) {
            $condition .= " AND (`u.state` = '" . $state . "' OR `u.state` = '" . $state_code . "')";
        } else if (!empty($state_code)) {
            $condition .= " AND (`u.zip` = '" . $state_code . "')";
        } else if (!empty($state)) {
            $condition .= " AND (`u.state` = '" . $state . "')";
        }
        if (!empty($street)) {
            $condition .= " AND (`address` like '%" . $street . "%')";
           // $condition .= " AND (`u.address` like '%" . $street . "%')";
        }
        if (!empty($country)) {
            $condition .= " AND (`u.country` = '" . $country . "')";
        }

        if (!empty($name)) {

            $condition.= "AND CONCAT(first_name,' ', last_name) like '%" . $name . "%'";
        }
        if (!empty($languages)) {

            $condition .= " AND (`languages` like '%" . $languages . "%')";
        }

        if (isset($min) && $min!="") {
            if ($min > 0) {
                $condition .= " AND (`l.price` >= '" . $min . "')";
            }
        } else {
            if (isset($max) && $max!="") {
                $min = 0;
            }
        }

        if (isset($max) && $max!="") {
            if ($max > $min) {
                $condition .= " AND (`l.price` <= '" . $max . "')";
            }
        }

        if (isset($max) && $max!="") {
            if ($max == $min) {
                $condition .= " AND (`l.price` = '" . $max . "')";
            }
        }

        if (isset($home_type)) {

            if($home_type != ''){

                $condition .= " AND (`home_type` like '%" . $home_type . "%')";
            }

        }

        $this->db->where($condition);
        $this->db->where('user_type','Agent');
        $this->db->or_where('user_type','Both');
        $this->db->where('u.is_admin', 0);

        //$this->db->distinct();

        $this->db->from('users u');
        $this->db->join('listing as l', 'l.user_id = u.id', 'left');
        $this->db->join('reviews as r', 'r.agent_id = u.id', 'left');
        //$this->db->join('recommendations as rec', 'rec.agent_id = u.id', 'left');
        $this->db->join('user_stats as s', 's.user_id = u.id', 'left');

       // $rating =round($reviews_total_rating/$avg*20,2);


        $this->db->order_by('max_rev','DESC');
        $this->db->group_by('u.id ');

        //          if ($looking_for == 'rent') {
        //
        //             $this->db->having('rented >', 0);
        //          }
        //
        //          else if ($looking_for == 'sale') {
        //
        //               $this->db->having('forsale >', 0,false);
        //           }
        //           else{
        //
        //               $this->db->having('SubTotal >', 0,false);
        //           }

        if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit']);
        }


        $query = $this->db->get();

       // echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }
    function agentsSearchBySpecility($value){
        $condition = '';
        $this->db->select('u.id,u.first_name,u.last_name,u.email,u.phone,u.user_specialities,u.agent_type,u.address,u.city,u.zip,u.country,u.picture,u.registered_date,s.user_id,s.sales,s.rental,s.reviews,s.recommendation,s.rating,s.sold,(s.rental + s.sales + s.sold ) as total ,l.id as listid,l.home_type,l.price');
        if (!empty($value)) {

            $condition .= "(`user_specialities` like '%" . $value . "%')";
        }
        $this->db->where($condition);
        $this->db->where('user_type','Agent');
        //$this->db->distinct();
        $this->db->order_by('total','DESC');
        $this->db->group_by('u.id ');
        $this->db->from('users u');
        $this->db->join('listing as l', 'l.user_id = u.id','left');
        // $this->db->join('reviews as r', 'r.agent_id = u.id', 'left');
        $this->db->join('user_stats as s', 's.user_id = u.id', 'left');
        $query = $this->db->get();

        //echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }

    function createAgent($data)
    {
        if ($this->db->insert('users', $data)) {
            return true;
        } else {
            return false;
        }

    }

    function getAllMembersByAgentId($id)
    {
        $this->db->select('id,first_name,last_name,email,user_type,agent_type,picture,about,location,registered_date,experience,phone,active');
        $this->db->from('users');
        $this->db->where('pid', $id);

        return $this->db->get()->result();

    }
    function getAllMembersForTeam($uid)
    {
        $this->db->select('id,first_name,last_name');
        $this->db->from('users');
        $this->db->where('pid', null);
        $this->db->where('id !=', $uid);
        return $this->db->get()->result();

    }

    function getFeaturedAgents()
    {
        $this->db->select('id,first_name,last_name,picture,city,country');
        $this->db->from('users');
        $this->db->where('featured', 1);
        $this->db->where('user_type', 'Agent');
        return $this->db->get()->result();

    }
    function getFeaturedAgentsRating()
    {
        $this->db->select('u.`id`,u.`first_name`,u.`first_name`,u.`last_name`,u.`picture`,u.`city`,u.`country`,(r.knowledge+r.expertise+r.responsiveness+r.negotiation_skills)/count(r.id) as rating,count(r.agent_id) as total');
        $this->db->from('users as u');
        $this->db->join('reviews as r', 'r.agent_id = u.id', 'left');
        $this->db->where('u.featured', 1);
        $this->db->where('u.user_type', 'Agent');
        $this->db->where('u.is_admin',0);
        $this->db->order_by('rating', 'DESC');
        $this->db->group_by('u.id', 'DESC');


        // $query = $this->db->get();
        // echo $this->db->last_query();
        return $this->db->get()->result();

    }



    function getFeaturedAgentsByLocation($location)
    {
        $location = addslashes(urldecode($location));
        
        $this->db->select('id,first_name,last_name,picture');
        $this->db->from('users');
        $this->db->where('featured', 1);
        $this->db->where('user_type', 'Agent');

       // $this->db->or_like(array('address' => $location, 'city' => $location,'state'=>$location,'zip'=>$location,'country'=>$location,'location'=>$location));


        $this->db->where('(`address` LIKE \'%'.$location.'%\' OR `city` LIKE \'%'.$location.'%\' OR `state` LIKE \'%'.$location.'%\' OR `location` LIKE \'%'.$location.'%\')', NULL, FALSE);

       // $this->db->or_where('user_type', 'Both');
       // $this->db->like('address',$location);
        //$this->db->or_like('city',$location);
        //$this->db->or_like('state',$location);
        //$this->db->or_like('zip',$location);
        //$this->db->or_like('country',$location);
        //$this->db->or_like('location',$location);


        //echo $this->db->last_query();


        return $this->db->get()->result();

    }



    public function delete_agent($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
        return $this->db->affected_rows() > 1 ? true:false;
    }

    public function updateAgentStatus($id,$status)
    {
        $active = ($status == 1 ? 0 : 1);
        $this->db->where('id',$id);
        $this->db->update('users', array('active' => $active));
        return true;
    }


    public function get_agent_review($id) {

        $this->db->select('AVG(knowledge+expertise+responsiveness+negotiation_skills)/4 as rating, count(id) as total');
        $this->db->from('reviews');
        $this->db->where('agent_id', $id);
        $this->db->group_by('agent_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    public function get_agent_reviews_all($id) {

        $this->db->select('r.*,u.`first_name`,u.`last_name`,u.`picture`');
        $this->db->from('reviews as r');
        $this->db->join('users as u', 'r.reviews_by = u.id', 'left');
        $this->db->where('r.agent_id', $id);
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();
    }

    public function insertRecommendation($data)
    {
        if ($this->db->insert('recommendations', $data)) {

                $this->db->where('user_id',$data['agent_id']);
                $q = $this->db->get('user_stats');

                if ( $q->num_rows() > 0 )
                {

                    $this->db->set('recommendation', 'recommendation+1', FALSE);
                    $this->db->update('user_stats');
                }

            return true;
        } else {
            return false;
        }

    }

    public function getAgentRecommendations($id) {
        $this->db->select('*');
        $this->db->from('recommendations');
        $this->db->where('agent_id', $id);
        return $this->db->get()->result();
    }



    public function agent_topup_update($id)
    {
        $this->db->set('views', 'views+1', FALSE);
        $this->db->set('balance','balance-0.25', FALSE);
        $this->db->where('agent_id', $id, FALSE);
        $this->db->update('topup_balance');
        return true;

    }
    public function add_new_member($uid,$member_id)
    {
            $this->db->set('pid', $uid, FALSE);
            $this->db->where('id', $member_id, FALSE);
            $this->db->update('users');
        return true;

    }

    function remainingTopUpBalance($id)
    {
        $this->db->select('*');
        $this->db->from('topup_balance');
        $this->db->where('agent_id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        $ret = $query->row();
        return $ret->balance;

    }


    function contactAgent($data)
    {
        if ($this->db->insert('contact_agents', $data)) {
            return true;
        } else {
            return false;
        }

    }





}

?>