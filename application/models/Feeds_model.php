<?php

Class Feeds_model extends CI_Model
{


    public function __construct() {
        parent::__construct();
    }


    public function get_feeds($uid,$data)
    {

        $q = $this->db->query('SELECT * FROM followers_stats where user_id ="'.$uid.'"');


        $this->db->select('f.`id` as feed_id,f.`poster_id`,f.`description`,f.`image`,f.`created_at`,u.`id`,u.`first_name`,u.`last_name`,u.`agent_type`,u.`picture`');
        $this->db->from('feeds as f');
        $this->db->join('users as u', 'f.poster_id = u.id', 'left');
        $this->db->where('u.user_type', 'Agent');


        if ( $q->num_rows() > 0 )
        {
            $result = $q->result();
            $users = trim($result[0]->following,",");
            $following =  explode(',', $users);
            $this->db->where_in('f.poster_id', $following);

        }

        $this->db->or_where('f.poster_id', $uid);

        $this->db->order_by('f.id', 'DESC');

        $this->db->limit($data['page'],$data['start']);

        $q = $this->db->get();
       // echo $this->db->last_query();
        return $q->result();



    }

    public function agent_related_listings($agent_id) {

        $this->db->select('l.`id`,l.`listing_name`,l.`slug`,l.`bedrooms`,l.`bathrooms`,l.`pieces`,l.`sqrft`,l.`preview_image_url`,l.`price`');
        $this->db->from('listing l');
        $this->db->where('l.user_id !=', $agent_id);
        $this->db->order_by('l.id', 'DESC');
        $this->db->limit(3);
        return $this->db->get()->result();

    }


    public function following($id) {

        $this->db->select('f.*');
        $this->db->from('followers_stats f');
        $this->db->where('f.user_id', $id);
        return $this->db->get()->result();

    }


    public function follow_agent_suggestions($user_id) {

        $session_data_user = $this->session->userdata('logged_in');
        $city = $session_data_user['city'];
        $state = $session_data_user['state'];
        $zip = $session_data_user['zip'];


        $q = $this->db->get('followers_stats');

        // Update user stats
        if ( $q->num_rows() > 0 )
        {

            $result = $q->result();
            $users = trim($result[0]->following,",");
            $following =  explode(',', $users);

            array_push($following, $user_id);

            $this->db->select('u.`id`,u.`first_name`,u.`last_name`,u.`agent_type`,u.`picture`');
            $this->db->from('users u');

            $this->db->where_not_in('u.id', $following);
            $this->db->where("(`city` LIKE '%$city%'");
            $this->db->or_where("`state` LIKE '%$state%'");
            $this->db->or_where("`zip` LIKE '%$zip%')");

            $this->db->order_by('rand()');
            $this->db->limit(3);
            $result = $this->db->get()->result();

            if(count($result) == 0){

                $this->db->select('u.`id`,u.`first_name`,u.`last_name`,u.`agent_type`,u.`picture`');
                $this->db->from('users u');
                $this->db->where_not_in('u.id', $following);
                $this->db->order_by('rand()');
                $this->db->limit(3);
                $result = $this->db->get()->result();
            }
            //echo $this->db->last_query();
            return $result;

        }

        // user status doesn't exists.
        else{

            $this->db->select('u.`id`,u.`first_name`,u.`last_name`,u.`agent_type`,u.`picture`');
            $this->db->from('users u');
            $this->db->where('u.id !=', $user_id);
            $this->db->order_by('u.id', 'DESC');
            $this->db->limit(3);
            return $this->db->get()->result();

        }

    }


    public function user_following_stats($user_id,$id){

        $this->db->where('user_id',$user_id);
        $q = $this->db->get('followers_stats');

        $set_data['user_id '] = $user_id;
        $set_data['following'] = $id;


        if ( $q->num_rows() > 0 )
        {
            $result = $q->result();
            $following =  $result[0]->following.','.$id;
            $this->db->where('user_id',$user_id);
            $this->db->set('following', $following);
            $this->db->update('followers_stats');

        } else {

            $this->db->insert('followers_stats',$set_data);
        }

    }


    public function update_stats($user_id,$id)
    {
        $this->db->where('user_id',$user_id);
        $q = $this->db->get('followers_stats');

        $result = $q->result();
        $following =  explode(',', $result[0]->following);

        pr($following);

        if (($key = array_search($id, $following)) !== false) {
            unset($following[$key]);
        }

        $str = implode (", ", $following);

        $this->db->where('user_id',$user_id);
        $this->db->set('following', $str);
        $this->db->update('followers_stats');

    }


    // Created for cron
    public function check_feed_status()
    {
        $session_data_user = $this->session->userdata('logged_in');
        $uid = $session_data_user['id'];

        $q = $this->db->query('SELECT * FROM followers_stats where user_id ="'.$uid.'"');


        if ( $q->num_rows() > 0 ) {

            $result = $q->result();
            $users = trim($result[0]->following, ",");
            $following = explode(',', $users);

            $foll = array_push($following, $uid);


        }
    }




}