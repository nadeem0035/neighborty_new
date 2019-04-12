<?php

Class Reviews_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function reviews_about_you($uid) {

        //$this->db->select('r.reviews_by,r.title,r.review,r.date_time,r.accuracy,r.communication,r.cleanliness,r.location,r.check_in,r.value,(r.accuracy+r.communication+r.cleanliness+r.location+r.check_in+r.value)/6 as rating,l.slug,l.listing_name,l.state_province,l.country,u.id as uid, u.first_name,u.last_name,u.picture');

        $this->db->select('r.review,r.date_time,r.knowledge,r.expertise,r.responsiveness,r.negotiation_skills,(r.knowledge+r.expertise+r.responsiveness+r.negotiation_skills)/4 as rating,u.id as uid, u.first_name,u.last_name,u.picture');
        $this->db->from('reviews as r, users as u');
       // $this->db->where('r.listing_id = l.id');
        $this->db->where('r.reviews_by = u.id');
        $this->db->where('r.agent_id', $uid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function reviews_by_you($uid) {

        $this->db->select('r.agent_id,r.reviews_by,r.review,r.date_time,r.knowledge,r.expertise,r.responsiveness,r.negotiation_skills,(r.knowledge+r.expertise+r.responsiveness+r.negotiation_skills)/4 as rating,u.first_name,u.last_name,u.picture');
        $this->db->from('reviews as r, users as u');
       /* $this->db->where('r.id = l.id');*/
        $this->db->where('r.agent_id = u.id');
        $this->db->where('r.reviews_by', $uid);
        $query = $this->db->get();
     //   echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    
        public function count_reviews_about_you($uid) {

        $this->db->select('r.reviews_by,r.review,r.date_time,(r.knowledge+r.expertise+r.responsiveness+r.negotiation_skills)/4 as rating,u.first_name,u.last_name,u.picture');
        $this->db->from('reviews as r, users as u');
        $this->db->where('r.agent_id = l.id');
        $this->db->where('r.reviews_by = u.id');
        $this->db->where('r.agent_id', $uid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

}

?>