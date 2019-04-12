<?php

Class Listings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_model', 'common', true);
    }

//TEMPORARILY ADDED
    public function home_types_search() {

        $this->db->select('id,name,active');
        $this->db->from('home_type');
        $this->db->where('active', 1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function room_types_search() {

        $this->db->select('id,name,active');
        $this->db->from('room_type');
        $this->db->where('active', 1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function home_types() {

        $this->db->select('name,active');
        $this->db->from('home_type');
        $this->db->where('active', 1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {
                $data[$row->name] = $row->name;
            }
            return $data;
        } else {
            return false;
        }
    }

    public function room_types() {

        $this->db->select('id,name,active');
        $this->db->from('room_type');
        $this->db->where('active', 1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {
                $data[$row->name] = $row->name;
            }
            return $data;
        } else {
            return false;
        }
    }

    public function amenities() {

        $this->db->select('id,name,type');
        $this->db->from('amenities');
        $this->db->where('active', 1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_list($lid) {
        $this->db->select('*');
        $this->db->from('listing');
        $this->db->where('id', $lid);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function GetPublishlist($lid) {
        $this->db->select('*');
        $this->db->from('listing');
        $this->db->where('id', $lid);
        $this->db->where('active','Publish');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function preview_image_status($lid) {
        $this->db->select('id');
        $this->db->from('listing');
        $this->db->where('id', $lid);
        $this->db->where_not_in('preview_image_url', 'listing.jpg');
        $this->db->where("preview_image_url IS NOT NULL");
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function other_iamges_status($lid) {
        $this->db->select('id');
        $this->db->from('listing_pictures');
        $this->db->where('listing_id', $lid);
        $this->db->limit(5);
        $query = $this->db->get();

        if ($query->num_rows() > 3) {
            return true;
        } else {
            return false;
        }
    }

    public function get_list_images($lid) {
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

    public function get_list_amenities($lid) {
        $this->db->select('amenities_id');
        $this->db->from('listing_amenities');
        $this->db->where('listing_id', $lid);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {
                $data[$row->amenities_id] = $row->amenities_id;
            }
            return $data;
        } else {
            return false;
        }
    }

    public function get_list_amenities_name($lid) {
        $this->db->select('amenities_id');
        $this->db->from('listing_amenities');
        $this->db->where('listing_id', $lid);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {
                $data[$row->amenities_id] = $row->amenities_id;
            }
            //print_r($data);
            $this->db->select('id,name');
            $this->db->from('amenities');
            $dataids = implode(",", $data);
            $where = "id IN (" . $dataids . ")";
            $this->db->where($where);
            $query = $this->db->get();

            return $newdata = $query->result();
        } else {
            return false;
        }
    }

    public function create_listing($data) {
        $this->db->insert('listing', $data);
        $last_id = $this->db->insert_id();
        if ($last_id) {
            return $last_id;
        } else {
            return false;
        }
    }

    public function update_listing($data, $listing_id) {

        if ($this->db->update('listing', $data, array('id' => $listing_id))) {
            return true;
        } else {
            return false;
        }
    }

    public function add_listing_pictures($data) {
        if ($this->db->insert('listing_pictures', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function add_amenities($data) {
        if ($this->db->insert('listing_amenities', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_listing_pictures($picture) {

        if ($this->db->delete('listing_pictures', array('picture' => $picture))) {
            return true;
        } else {
            return false;
        }
    }

    public function get_user_listing($uid,$status) {

        $this->db->select('id,user_id,listing_name,slug,price,preview_image_url,address_line_1,full_address,active,purpose');
        $this->db->from('listing');
        $this->db->where('user_id', $uid);
        $this->db->where('active',$status);
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();
    }

    public function GetTripsBooking($uid) {

        $this->db->select('b.*,b.id as bid,l.listing_name,l.id as lid, l.slug,u.id as uid, u.first_name,u.last_name,u.picture');
        $this->db->from('booking as b, listing as l, users as u');
        $this->db->where('b.listing_id = l.id');
        $this->db->where('b.host_id = u.id');
        $this->db->where('b.guest_id', $uid);
        $this->db->where("(b.status = 'approved' OR b.status = 'leave_feedback' OR b.status = 'complete')");
        $this->db->order_by('b.book_date', 'ASC');
        return $this->db->get()->result();
    }


    public function get_user_listing_review($uid, $lid) {

        $this->db->select('AVG(accuracy+communication+cleanliness+location+check_in+value)/6 as rating');
        $this->db->from('reviews');
        $this->db->where('reviews_to', $uid);
        $this->db->where('listing_id', $lid);
        $this->db->group_by('listing_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_listing_review($lid) {

        $this->db->select('AVG(accuracy+communication+cleanliness+location+check_in+value)/6 as rating, count(id) as total');
        $this->db->from('reviews');
        $this->db->where('listing_id', $lid);
        $this->db->group_by('listing_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_listing_detail_review($lid) {

        $this->db->select('AVG(accuracy) AS acc, AVG(communication) AS comm, AVG(cleanliness) AS cle, AVG(location) AS loc, AVG(check_in) AS che, AVG(value) AS val');
        $this->db->from('reviews');
        $this->db->where('listing_id', $lid);
        $this->db->group_by('listing_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_list_reviews_all($lid) {

        $this->db->select('r.*,u.`first_name`,u.`last_name`,u.`picture`');
        $this->db->from('reviews as r');
        $this->db->join('users as u', 'r.reviews_by = u.id', 'left');
        $this->db->where('r.listing_id', $lid);

        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();
    }

    public function validate_user_listing($uid, $lid) {
        $this->db->select('id');
        $this->db->from('listing');
        $this->db->where('user_id', $uid);
        $this->db->where('id', $lid);
        $this->db->limit(1);
        //$this->db->where('l.active',1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function get_listing_for_index_page() {

        $this->db->select('listing_name,price,preview_image_url as image');
        $this->db->order_by('id', 'rand');
        $this->db->limit(6);
        return $this->db->get('listing')->result();
    }

    public function get_listing_for_search_page($params = array()) {
        $stack             = array();
        $GET = $this->input->get(NULL, TRUE);
        $sql = " `id` , `listing_name`, `slug`, `price`, `preview_image_url` AS `image`, `summary`, `latitude`, `longitude`,`address_line_1`,`address_line_2`, `city_town`, `state_province`,`zip_postal_code`,`typed_address`,`home_type`,`bedrooms`,`beds`,`bathrooms`,`accommodates`";
        $this->db->select($sql);
        //FOR QUICK SEARCH
        $location = $this->input->get('location');
        $checkin = $this->input->get('checkin');
        $checkout = $this->input->get('checkout');
        $nof_guest = $this->input->get('no_of_guests');

        //Google HIDDNEN SEARCH VALUES
        $street = $this->input->get('street');
        $city = $this->input->get('city');
        $state = $this->input->get('state');
        $state_code = $this->input->get('state_code');
        $country = $this->input->get('country');



        //FOR SEARCH BY MAP
        $search_by_map = $this->input->get('search_by_map');
        $sw_lat = $this->input->get('sw_lat');
        $sw_lng = $this->input->get('sw_lng');
        $ne_lat = $this->input->get('ne_lat');
        $ne_lng = $this->input->get('ne_lng');




        //FOR ADVANCED SEARCH FIELDS
        $room_types = $this->input->get('room_types');
        $home_types = $this->input->get('home_types');

        //FROM SLIDER
        $min = $this->input->get('price_min');
        $max = $this->input->get('price_max');

        //FOR SIZE
        $min_bedrooms = $this->input->get('bedrooms');
        $min_bathrooms = $this->input->get('bathrooms');
        $min_beds = $this->input->get('beds');

        //AMENITIES ARRAY
        $hosting_amenities = $this->input->get('amenities');

        $sort = $this->input->get('sort');
        if (empty($sort)) {
            $sort = 1;
        }


        $condition = '';
        $location = $this->input->get('location');
        $pieces = explode(",", $location);

        $print = "";
        $len = count($pieces);

        $condition .= "(`active` = 'Publish')";

        //INCASE IF WE DO SEARCH WITH REPSECT TO MAP
        if ($search_by_map) {
            $condition .= "AND (`latitude` BETWEEN $sw_lat AND $ne_lat) AND (`longitude` BETWEEN $sw_lng AND $ne_lng)";
        } else {
            if ($location != '' && $country == '') {
                $i = 1;
                foreach ($pieces as $address) {
                    $this->db->flush_cache();
                    $address = $this->db->escape_like_str($address);

                    if ($i == $len)
                        $and = "";
                    else
                        $and = " AND ";

                    if ($i == 1)
                        $condition .= " AND (";

                    $condition .= "`full_address`  LIKE '%" . trim($address) . "%' " . $and;

                    if ($i == $len)
                        $condition .= ")";

                    $i++;
                }
            }
        }


        //SEARCH RECORDS WITH TAKIGN CARE OF AVAILABLE LISTINGD ANG NOT BOOKED
        //	 if($checkin!='--' && $checkout!='--' && $checkin!="yy-mm-dd" && $checkout!="yy-mm-dd" )
        if(!empty($checkin) && !empty($checkout)) {
            // Specify the start date. This date can be any English textual format
            $check_in = date("Y-m-d",strtotime($checkin)); // Convert date to a UNIX timestamp

            // Specify the end date. This date can be any English textual format
            $check_out = date("Y-m-d",strtotime($checkout)); // Convert date to a UNIX timestamp
            $arr = array();
            // Loop from the start date to end date and output all dates inbetween
            for ($i=$check_in; $i<=$check_out; $i+=86400) {

                $arr[] = $i;

            }
            //
            $ans = $this->db->query("SELECT id,listing_id FROM `booking` WHERE (check_in <= '$check_in' AND check_out >= '$check_in') OR   (check_in <= '$check_out' AND check_out >= '$check_out') OR   (check_in >= '$check_in' AND check_out <= '$check_out')");

//		if($ans->num_rows()==0)
//		{
//			$ans = $this->db->where_in('booked_days',$arr)->group_by('list_id')->get('calendar');
//		}

            $a   = $ans->result();
            $this->db->flush_cache();
            // Now after the checkin is completed
            if(!empty($a))
            {
                foreach($a as $a1)
                {
                    array_push($stack, $a1->listing_id);
                }
            }

        }

        $condition .=  " AND CURDATE() BETWEEN  available_from AND  available_to AND price > 0 ";



        //SEARCH WITH HIDDEN VALUES
        if (!empty($city)) {
            $condition .= " AND (`city_town` = '" . $city . "')";
        }
        if(!empty($stack))
        {
            $condition .= " AND (`id` NOT IN(".implode(',',$stack)."))";
        }

        if (!empty($state) && !empty($state_code)) {
            $condition .= " AND (`state_province` = '" . $state . "' OR `state_province` = '" . $state_code . "')";
        } else if (!empty($state_code)) {
            $condition .= " AND (`state_province` = '" . $state_code . "')";
        } else if (!empty($state)) {
            $condition .= " AND (`state_province` = '" . $state . "')";
        }
        if (!empty($street)) {
            $condition .= " AND (`address_line_1` like '%" . $street . "%')";
        }
        if (!empty($country)) {
            $condition .= " AND (`country` = '" . $country . "')";
        }



        if (!empty($min_bedrooms)) {
            $condition .= " AND (`bedrooms` >= '" . $min_bedrooms . "')";
        }
        if (!empty($min_bathrooms)) {
            $condition .= " AND (`bathrooms` >= '" . $min_bathrooms . "')";
        }

        if (!empty($min_beds)) {
            $condition .= " AND (`beds` >= '" . $min_beds . "')";
        }


        if ($nof_guest > 1) {
            $condition .= " AND (`accommodates` >= '" . $nof_guest . "')";
        }

        if (is_array($room_types)) {
            if (count($room_types) > 0) {
                $i = 1;
                foreach ($room_types as $room_type) {
                    if ($i == count($room_types))
                        $or = "";
                    else
                        //$and = " AND ";
                        $or = " OR ";

                    if ($i == 1)
                        $condition .= " AND (";

                    $condition .= "`room_type` = '" . $room_type . "'" . $or;

                    if ($i == count($room_types))
                        $condition .= ")";

                    $i++;
                }
            }
        }
        $amenities_str = "";
        //print_r($hosting_amenities);
        if (is_array($hosting_amenities)) {
            if (count($hosting_amenities) > 0) {
                $amenities_str = implode(',', $hosting_amenities);
            }
        }

        if (isset($min)) {
            if ($min > 0) {
                $condition .= " AND (`price` >= '" . $min . "')";
            }
        } else {
            if (isset($max)) {
                $min = 0;
            }
        }

        if (isset($max)) {
            if ($max > $min) {
                $condition .= " AND (`price` <= '" . $max . "')";
            }
        }

        if (isset($max)) {
            if ($max == $min) {
                $condition .= " AND (`price` = '" . $max . "')";
            }
        }



        if (is_array($home_types)) {
            if (count($home_types) > 0) {
                $i = 1;
                foreach ($home_types as $home_type) {
                    if ($i == count($home_types)) {
                        $and = "";
                    } else {
                        $and = " OR ";
                    }

                    if ($i == 1)
                        $condition .= " AND (";

                    $condition .= "`home_type` = '" . $home_type . "'" . $and;

                    if ($i == count($home_types))
                        $condition .= ")";

                    $i++;
                }
            }
        }


        //FINAL QUERY
        $condition .= "  AND (`user_id` != '0')";

        if ($sort == 2) {
            $order = "ORDER BY price ASC";
        } else if ($sort == 3) {
            $order = "ORDER BY price DESC";
        } else if ($sort == 4) {
            $order = "ORDER BY listing.id DESC";
        } else {
            $order = "ORDER BY listing.id ASC";
        }


        $this->db->from('listing');
        $this->db->where($condition);
        $this->db->distinct();
        if (isset($hosting_amenities)) {
            $this->db->join('listing_amenities', 'listing_amenities.listing_id = listing.id');
            $this->db->where_in('listing_amenities.amenities_id', $amenities_str);
        }
        if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit']);
        }

        $this->db->order_by('listing.id', 'asc');
        $query = $this->db->get();

        //echo  $this->db->last_query();

        return $query; // exit;
    }

    public function already_booked($lid) {

        $this->db->select('check_in,check_out');
        $this->db->from('booking');
        $this->db->where("(status = 'pending' OR status = 'approved' OR status = 'issue')");
        $this->db->where('listing_id', $lid);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function MyTrips($GuestId) {
        $this->db->select('b.*,l.listing_name,l.slug,u.id as uid, u.first_name,u.last_name,u.picture');
        $this->db->from('rental_booking as b, rental_listing as l, users as u');
        $this->db->where('b.listing_id = l.id');
        $this->db->where('b.host_id = u.id');
        $this->db->where('b.guest_id', $GuestId);
        $this->db->where("(status = 'approved' OR status = 'leave_feedback' OR status = 'complete')");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function MyTrip($GuestId, $bid) {

        $this->db->select('b.*,l.listing_name,l.slug,l.id as lid,u.id as uid, u.first_name,u.last_name');
        $this->db->from('booking as b, listing as l, users as u');
        $this->db->where('b.listing_id = l.id');
        $this->db->where('b.host_id = u.id');
        $this->db->where('b.guest_id', $GuestId);
        $this->db->where('b.id', $bid);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function MyReservations($HostId) {
        $this->db->select('b.*,l.listing_name,l.slug,u.id as uid, u.first_name,u.last_name,u.picture');
        $this->db->from('booking as b, listing as l, users as u');
        $this->db->where('b.listing_id = l.id');
        $this->db->where('b.guest_id = u.id');
        $this->db->where('b.host_id', $HostId);
        $this->db->where("(b.status = 'approved' OR b.status = 'leave_feedback' OR b.status = 'complete')");
        $this->db->order_by('b.book_date', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function GetreservationsBooking($uid) {

        $this->db->select('b.*,b.id as bid,l.listing_name,l.id as lid, l.slug,u.id as uid, u.first_name,u.last_name,u.picture');
        $this->db->from('booking as b, listing as l, users as u');
        $this->db->where('b.listing_id = l.id');
        $this->db->where('b.guest_id = u.id');
        $this->db->where('b.host_id', $uid);
        $this->db->where("(b.status = 'approved' OR b.status = 'leave_feedback' OR b.status = 'complete')");
        $this->db->order_by('b.book_date', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function MyReservation($HostId, $bid) {

        $this->db->select('b.*,l.listing_name,l.slug,l.id as lid,u.id as uid, u.first_name,u.last_name');
        $this->db->from('booking as b, listing as l, users as u');
        $this->db->where('b.listing_id = l.id');
        $this->db->where('b.guest_id = u.id');
        $this->db->where('b.host_id', $HostId);
        $this->db->where('b.id', $bid);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function AddListingReviews($reviews) {

        $this->db->select('id');
        $this->db->from('reviews');
        $this->db->where('booking_id', $reviews['booking_id']);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return false;
        } else {
            $this->db->insert('reviews', $reviews);
            //Update booking table status
            $this->db->where('id', $reviews['booking_id']);
            $this->db->update('booking', array('status' => 'complete'));
            return true;
        }
    }

    function UserExistingListingStatus($uid) {

        $this->db->select('id');
        $this->db->from('listing');
        $this->db->where('user_id', $uid);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function UserListing($uid) {

        $this->db->select('id');
        $this->db->from('listing');
        $this->db->where('user_id', $uid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function checkListingBookingStatus($listing_id,$uid){

        $condition = array('listing_id',$listing_id,'host_id'=>$uid);

        $this->db->select('id');
        $this->db->from('booking');
        $this->db->where('listing_id',$listing_id);
        $this->db->where('host_id',$uid);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {

            $this->db->select_max('check_out');
            $this->db->from('booking');
            $this->db->where('listing_id',$listing_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            }

        } else {
            $this->db->where('id', $listing_id);
            $this->db->delete('listing');
            return 'success';
        }


    }
    public function setListingFlag($listing_id){

        $data  = array('active'=>'deleted');
        if ($this->db->update('listing', $data, array('id' => $listing_id))) {
            return 'success';
        } else {
            return false;
        }

    }
}

?>