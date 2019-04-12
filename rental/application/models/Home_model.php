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

    public function top_vacation_deals() {

        $this->db->select('id, price, city_town, state_province, country, slug, preview_image_url');
        $this->db->from('listing');
        $this->db->where('active', 'Publish');
        $this->db->where('is_featured', 1);

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
        $url = "https://api.instagram.com/v1/users/1946297287/media/recent/?access_token=2243281707.b0bfb4e.75e723a16be74b7b95a1df23086075e1&count=".$count;
	 
        
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