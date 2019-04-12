<?php

Class References_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function references_about_you($uid) {

        $this->db->select('r.review,r.relation,r.date_time,u.first_name,u.last_name,u.picture');
        $this->db->from('references as r, users as u');
        $this->db->where('r.reviews_by = u.id');
        $this->db->where('r.reviews_to', $uid);
        $this->db->where('r.active', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function references_by_you($uid) {

        $this->db->select('r.review,r.relation,r.date_time,u.first_name,u.last_name,u.picture');
        $this->db->from('references as r, users as u');
        $this->db->where('r.reviews_to = u.id');
        $this->db->where('r.reviews_by', $uid);
        $this->db->where('r.active', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}

?>