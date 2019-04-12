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
}
