<?php

Class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function sales($uid) {

        $this->db->select('credits,debits,credits-debits as balance', false);
        $this->db->from("(SELECT user_id,
        SUM(case when transaction_type='Debit' then amount else 0 end) AS debits, 
        SUM(case when transaction_type='Credit' then amount else 0 end) AS credits
        FROM transaction WHERE status = 'ok' GROUP BY user_id) a", false);
        $this->db->where('user_id', $uid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }

    public function month_revenue($uid, $date) {

        $this->db->select('credits-debits as balance', false);
        $this->db->from("(SELECT user_id,
        SUM(case when transaction_type='Debit' then amount else 0 end) AS debits, 
        SUM(case when transaction_type='Credit' then amount else 0 end) AS credits
        FROM transaction WHERE status = 'ok' && MONTH(process_date)= MONTH('" . $date . "') && YEAR(process_date) = YEAR('" . $date . "')  GROUP BY user_id) a", false);
        $this->db->where('user_id', $uid);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row('balance');
        } else {
            return 0;
        }
    }

    public function BookingDetails($host_id) {
        $this->db->select('b.listing_charges,b.book_date,l.listing_name, u.first_name,u.last_name,u.picture');
        $this->db->from('booking as b, listing as l, users as u');
        $this->db->where('b.listing_id = l.id');
        $this->db->where('b.guest_id = u.id');
        $this->db->where('b.host_id', $host_id);
        $this->db->where('b.status', 'approved');
        $this->db->limit(8);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function UpcomingTrips($GuestId) {
        $this->db->select('b.id as bid,b.check_in,b.check_out,b.key_exchange,l.id as lid,l.slug as slug, l.listing_name,l.latitude,l.longitude,u.id as uid, u.first_name,u.last_name');
        $this->db->from('booking as b, listing as l, users as u');
        $this->db->where('b.listing_id = l.id');
        $this->db->where('b.host_id = u.id');
        $this->db->where('b.guest_id', $GuestId);
        $this->db->where("b.check_in >= CURDATE()",'',false);
        $this->db->where("(status = 'approved')");
        $this->db->order_by("b.check_in", "ASC");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function GetListImages($lid) {
        $this->db->select('picture');
        $this->db->from('listing_pictures');
        $this->db->where('listing_id', $lid);
        $this->db->where('active', 1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}

?>