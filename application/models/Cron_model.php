<?php
Class Cron_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function alter_transaction_status(){
        $this->db->where('process_date', 'CURDATE()',FALSE);
        $this->db->update('transaction', array('status' => 'ok'));
    }
    public function set_feedback_status(){
        $this->db->select('guest_id,host_id,listing_id,check_in,check_out,total_guest');
        $this->db->from('booking');
        $this->db->where('check_out <', 'CURDATE()',FALSE);
        $this->db->where('status','approved');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->db->where('check_out <', 'CURDATE()',FALSE);
            $this->db->where('status','approved');
            $this->db->update('booking', array('status' => 'leave_feedback'));
            return $query->result();
        } else {
            return false;
        }
    }
    public function saveMessage($data){
        if ($this->db->insert('messages', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function low_credit_agents() {


        $this->db->select('t.*,l.`user_id`,l.`sent_time`,l.`id` as lid,l.`total_emails`,u.`email`,u.`first_name`,u.`last_name`');
        $this->db->from('topup_balance as t');
        $this->db->join('email_logs as l', 't.agent_id = l.user_id', 'left');
        $this->db->join('users as u', 't.agent_id = u.id', 'left');
        $this->db->where('t.balance <= ',1);
        $this->db->where('t.balance > ',0);
        return $this->db->get()->result();

    }

    function zero_credit_agents() {


        $this->db->select('t.*,l.`user_id`,l.`sent_time`,l.`id` as lid,l.`total_emails`,u.`email`,u.`first_name`,u.`last_name`');
        $this->db->from('topup_balance as t');
        $this->db->join('email_logs as l', 't.agent_id = l.user_id', 'left');
        $this->db->join('users as u', 't.agent_id = u.id', 'left');
        $this->db->where('t.balance',0);
        return $this->db->get()->result();

    }


}
