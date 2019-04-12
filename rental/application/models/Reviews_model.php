<?php

Class Reviews_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function reviews_about_you($uid) {

       // $this->db->prefix('rental_');
        $this->db->select('r.reviews_by,r.title,r.review,r.date_time,r.accuracy,r.communication,r.cleanliness,r.location,r.check_in,r.value,(r.accuracy+r.communication+r.cleanliness+r.location+r.check_in+r.value)/6 as rating,l.slug,l.listing_name,l.state_province,l.country,u.id as uid, u.first_name,u.last_name,u.picture');
        $this->db->from('rental_reviews as r, rental_listing as l, users as u');
        $this->db->where('r.listing_id = l.id');
        $this->db->where('r.reviews_by = u.id');
        $this->db->where('r.reviews_to', $uid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function reviews_by_you($uid) {

        $this->db->select('r.reviews_by,r.title,r.review,r.date_time,r.accuracy,r.communication,r.cleanliness,r.location,r.check_in,r.value,(r.accuracy+r.communication+r.cleanliness+r.location+r.check_in+r.value)/6 as rating,l.slug,l.listing_name,l.state_province,l.country,u.first_name,u.last_name,u.picture');
        $this->db->from('rental_reviews as r, rental_listing as l, users as u');
        $this->db->where('r.listing_id = l.id');
        $this->db->where('r.reviews_to = u.id');
        $this->db->where('r.reviews_by', $uid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    
        public function count_reviews_about_you($uid) {

        $this->db->select('r.reviews_by,r.review,r.title,r.date_time,(r.accuracy+r.communication+r.cleanliness+r.location+r.check_in+r.value)/6 as rating,l.slug,l.listing_name,l.state_province,l.country,u.first_name,u.last_name,u.picture');
        $this->db->from('reviews as r, listing as l, users as u');
        $this->db->where('r.listing_id = l.id');
        $this->db->where('r.reviews_by = u.id');
        $this->db->where('r.reviews_to', $uid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

}

?>