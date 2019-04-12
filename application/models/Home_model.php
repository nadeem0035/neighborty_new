<?php

class Home_model extends CI_Model {

    public function __construct() {
         parent::__construct();
    }
	
    public function testimonials() {

        $this->db->select('*');
        $this->db->from('testimonials');
        $this->db->where('active', 1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function top_property_agents() {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_type', 'agent');
        $this->db->limit(4);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


    public function top_vacation_deals() {

        $this->db->select('*');
        $this->db->from('listing');
        $this->db->where('status', 'Publish');
        $this->db->where('is_featured', 1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function latest_homes() {

        $this->db->select('*');
        $this->db->from('listing');
        $this->db->where('status', 'Publish');
        $this->db->order_by('id', 'desc');
        $this->db->limit(5);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function latest_listings_by_agent($id) {

        $this->db->select('*');
        $this->db->from('listing');
        $this->db->where('user_id',$id);
        $this->db->where('status', 'Publish');
        $this->db->where('user_id',$id);
        $this->db->order_by('id', 'desc');
        $this->db->limit(10);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function latest_viewed_listings_by_renter($id) {

        $this->db->select('l.*,a.id,a.user_id,a.listing_id');
        $this->db->from('listing l');
        $this->db->join('user_listing_activity a', 'a.listing_id = l.id ');
        $this->db->where('a.user_id',$id);
        $this->db->group_by('a.listing_id');
        $this->db->order_by('a.id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get();

       // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }



    public function latest_sales_home() {

        $this->db->select('*');
        $this->db->from('listing');
        $this->db->where('status', 'Publish');
        $this->db->where('property_type', 'sale');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function latest_rental_home() {

        $this->db->select('*');
        $this->db->from('listing');
        $this->db->where('status', 'Publish');
        $this->db->where('property_type', 'rent');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


    public function top_travel_inspirations() {
        $this->db->select('id, location,country, thumb_img, large_img');
        $this->db->from('top_inspiration');
        $this->db->where('active', 1);
		$this->db->limit(4);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function display_instagram_feed() {

        $count = 20; 
        //$display_size = "thumbnail"; // you can choose between "low_resolution", "thumbnail" and "standard_resolution"
        $url = "https://api.instagram.com/v1/users/1946297287/media/recent/?access_token=1946297287.1fb234f.1d5b7d3443114a68ac32c6333bc74553&count=".$count;
	 
        
        $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 2
        ));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result = json_decode($result);
    }


}

?>