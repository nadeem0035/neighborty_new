<?php

Class Inbox_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_inbox($uid) {

        $this->db->select('m.*, l.title,u.id as uid, u.first_name,u.last_name,u.picture')
            ->from('messages AS m, listing AS l, users AS u')
            ->where('u.id = m.sender_id')
            //  ->where('l.id = m.listing_id')
            ->where('m.receiver_id', $uid)
            ->where('m.type', 'Inbox')
            ->group_by('m.id')
            ->order_by("m.date_time", "DESC")
            ->limit(50);

        $query = $this->db->get();

        //echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


    public function GetInboxreservation($uid)
    {

        $this->db->select('m.*, l.title,u.id as uid, u.first_name,u.last_name,u.picture')
            ->from('messages AS m, listing AS l, users AS u')
            ->where('u.id = m.sender_id')
            ->where('l.id = m.listing_id')
            ->where('m.receiver_id', $uid)
            ->order_by("m.date_time", "DESC")
            ->limit(50);

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }

    }

    public function get_message($mid)
    {

        $this->db->select('id,receiver_id,sender_id,type,listing_id,check_in,check_out')
            ->from('messages')
            ->where('id', $mid)
            ->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_application($uid) {

        $this->db->select('m.*, l.title, u.first_name,u.last_name')
            ->from('messages AS m, listing AS l, users AS u')
            ->where('u.id = m.sender_id')
            ->where('l.id = m.listing_id')
            ->where('m.receiver_id', $uid)
            ->where('m.type', 'Applied')
            ->order_by("m.date_time", "DESC")
            ->limit(50);

        $query = $this->db->get();
        //echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function UnreadMessageReservation($uid)
    {

        $this->db->select('id')
            ->from('messages')
            ->where('read_status', 0)
            ->where('receiver_id', $uid);

        $query = $this->db->get();
        // pre($query);

        if ($query->num_rows() > 0)
        {
            // pre($query->num_rows());
            return $query->num_rows();
        }
        else
        {
            return 0;
        }

    }

    public function unread_message_count($uid) {

        $this->db->select('id')
            ->from('messages')
            ->where('read_status', 0)
            ->where('type', 'Inbox')
            ->where('receiver_id', $uid);

        $query = $this->db->get();

        //echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }


    public function UnreadApplicationCount($uid)
    {

        $this->db->select('id')
            ->from('messages')
            ->where('read_status', 0)
            ->where('type', 'Application')
            ->where('receiver_id', $uid);

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->num_rows();
        } else {
            return 0;
        }
    }


    public function UnreadAppointmentCount($uid)
    {

        $this->db->select('id')
            ->from('messages')
            ->where('read_status', 0)
            ->where('type', 'Appointment')
            ->where('receiver_id', $uid);

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->num_rows();
        } else {
            return 0;
        }
    }



    public function update_view_status($mid) {
        $data = array(
            'read_status' => 1
        );
        $this->db->where('id', $mid);

        if ($this->db->update('messages', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_receive_message($id, $uid)
    {

        $this->db->select('m.*, l.title, u.first_name,u.last_name,u.picture')
            ->from('messages AS m, listing AS l, users AS u')
            ->where('u.id = m.sender_id')
            // ->where('l.id = m.listing_id')
            ->where('m.receiver_id', $uid)
            ->where('m.type', 'Inbox')
            ->where('m.id', $id)
            ->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1)
        {
            return $query->row();
        }
        else
        {
            return false;
        }

    }

    public function get_sent_message($id, $uid)
    {

        $this->db->select('m.*, l.title, u.first_name,u.last_name,u.picture')
            ->from('messages AS m, listing AS l, users AS u')
            ->where('u.id = m.receiver_id')
            //  ->where('l.id = m.listing_id')
            ->where('m.sender_id', $uid)
            //->where('m.type', 'Inbox')
            //  ->where('m.id', $id)
            ->limit(1);

        $query = $this->db->get();
        // echo $this->db->last_query();

        if( $query->num_rows() == 1)
        {
            return $query->row();
        }
        else
        {
            return false;
        }
    }

    public function get_application_message($id, $uid)
    {

        $this->db->select('m.*, l.title, u.first_name,u.last_name,u.picture')
            ->from('messages AS m, listing AS l, users AS u')
            ->where('u.id = m.sender_id')
            // ->where('l.id = m.listing_id')
            ->where('m.receiver_id', $uid)
            ->where('m.type', 'Application')
            ->where('m.id', $id)
            ->limit(1);

        $query = $this->db->get();

        if( $query->num_rows() == 1 )
        {
            return $query->row();
        }
        else
        {
            return false;
        }
    }

    public function get_appointment($uid)
    {

        $this->db->select('m.*, l.title, u.first_name,u.last_name')
            ->from('messages AS m, listing AS l, users AS u')
            ->where('u.id = m.sender_id')
            //->where('l.id = m.listing_id')
            ->where('m.receiver_id', $uid)
            ->where('m.type', 'Appointment')
            // ->where('date_time < DATE_SUB(NOW(), INTERVAL 45 DAY)')
            ->order_by("m.date_time", "DESC")
            ->limit(50);

        $query = $this->db->get();

        if( $query->num_rows() > 0 )
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    public function get_appointment_message($id, $uid) {

        $this->db->select('m.*, l.title, u.first_name,u.last_name,u.picture')
            ->from('messages AS m, listing AS l, users AS u')
            ->where('u.id = m.sender_id')
            // ->where('l.id = m.listing_id')
            ->where('m.receiver_id', $uid)
            ->where('m.type', 'Appointment')
            ->where('m.id', $id)
            ->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_sent($uid) {

        $this->db->select('m.*, l.title, u.id,u.first_name,u.last_name,u.picture')
            ->from('messages AS m, listing AS l, users AS u')
            ->where('u.id = m.sender_id')
            // ->where('l.id = m.listing_id')
            //  ->where('m.type', 'Inbox')
            ->where('m.sender_id', $uid)
            ->group_by('m.id')
            ->order_by("m.date_time", "DESC")
            ->limit(50);


        $query = $this->db->get();
        //echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function send_reply($data) {

        if ($this->db->insert('messages', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function send_message($data) {

        if ($this->db->insert('messages', $data)) {
            echo $this->db->last_query();
            return true;
        } else {
            return false;
        }
    }
    public function add_msg_record($data)
    {
        $this->db->insert('messages_detail', $data);
        $last_id = $this->db->insert_id();
        if ($last_id) {
            return true;
        } else {
            return false;
        }

    }


    public function add_notifcation($data)
    {
        $this->db->insert('notification', $data);
        $last_id = $this->db->insert_id();
        if ($last_id) {
            return true;
        } else {
            return false;
        }

    }

    public function get_notification($uid)
    {

        $this->db->select('notification,read_status,date_time,notify_type')
            ->from('notification')
            ->where('agent_id', $uid)
            ->order_by("date_time", "DESC")
            ->limit(30);

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return 0;
        }

    }

    public function unread_notification_count($uid) {

        $this->db->select('id')
            ->from('notification')
            ->where('read_status', 0)
            ->where('agent_id', $uid);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function UpdateNotificationsStatus($uid) {
        $data = array(
            'read_status' => 1
        );
        $this->db->where('agent_id', $uid);

        if ($this->db->update('notification', $data)) {
            return true;
        } else {
            return false;
        }
    }

}

?>