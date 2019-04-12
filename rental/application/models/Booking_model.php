<?php

Class Booking_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function booking($data) {
        $query = $this->db->insert('booking', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function reservation_requests($host_id) {
        $this->db->select('b.id as id,b.check_in,b.check_out,b.total_charges,b.listing_charges,b.total_guest,b.status,b.book_date,l.listing_name,u.first_name,u.last_name');
        $this->db->from('booking as b, listing as l, users as u');
        $this->db->where('b.listing_id = l.id');
        $this->db->where('b.guest_id = u.id');
        $this->db->where('b.host_id', $host_id);
        $this->db->order_by("b.id", "DESC");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function reservation_request($host_id, $bid) {
        $this->db->select('b.*,l.listing_name,u.id as uid, u.first_name,u.last_name');
        $this->db->from('booking as b, listing as l, users as u');
        $this->db->where('b.listing_id = l.id');
        $this->db->where('b.guest_id = u.id');
        $this->db->where('b.host_id', $host_id);
        $this->db->where('b.id', $bid);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function update_reservation_status($bid, $host_id, $data) {

        $this->db->select('id');
        $this->db->from('booking');
        $this->db->where('id', $bid);
        $this->db->where('host_id', $host_id);
        $this->db->where('status', 'pending');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {

            $this->db->where('id', $bid);
            $this->db->where('host_id', $host_id);

            if ($this->db->update('booking', $data)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function final_update_reservation_status($bid, $host_id, $status) {

        $this->db->select('id');
        $this->db->from('booking');
        $this->db->where('id', $bid);
        $this->db->where('host_id', $host_id);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {

            $this->db->where('id', $bid);
            $this->db->where('host_id', $host_id);

            if ($this->db->update('booking', array('status' => $status))) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_booking($bid) {

        $this->db->select('b.*,l.listing_name, l.id as lid,l.city_town');
        $this->db->from('booking as b, listing as l');
        $this->db->where('b.listing_id = l.id');
        $this->db->where('b.id', $bid);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function transaction($data) {
        $query = $this->db->insert('transaction', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function isNewUser($host_id){

        $this->db->select('host_id');
        $this->db->from('booking');
        $where = "host_id= $host_id AND status='pending' OR status='cancel'";
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return true;
        } else {
            return false;
        }


    }

}

?>