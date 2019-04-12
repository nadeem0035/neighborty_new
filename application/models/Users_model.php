<?php

Class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function login($email, $password) {

        $this->db->select('id,city,state,zip,first_name,phone, last_name,email,rental_status,user_type,agent_type,picture,about, active');
        $this->db->from('users');
        $this->db->group_start() ;
        $this->db->where('email', $email);
        $this->db->or_where('phone', $email);
        $this->db ->group_end();
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

    public function social_login($user) {

        $this->db->select('id, first_name, last_name,email,user_type,picture, active');
        $this->db->from('users');
        $this->db->where('email', $user['email']);
        $this->db->where('oauth_provider', $user['oauth_provider']);
        $this->db->where('oauth_uid', $user['oauth_uid']);
        //$this->db->where('active', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function verifyEmailAddress($hash) {

        $this->db->select('id,claimed,email,password,first_name,user_type,referral,referral_string,referred_by,total_referrals');
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

        // pre($user);
        if( $this->db->update('users', $user, array('id' => $uid)) )
        {
            // pr( $this->db->last_query() );
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

    public function get_user($id)
    {

        $this->db->select('id,referral,first_name,last_name,email,phone,location,address,user_type,languages,user_specialities,picture,birth_date,address,city,state,zip,country,active,registered_date,gender,about,real_estate_license,phone_secondary,state_code,street,area');
        $this->db->from('users');
        $this->db->where('id', $id);

        return $this->db->get()->row();
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






}

?>