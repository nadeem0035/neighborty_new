<?php

Class Listings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_model', 'common', true);
    }


    public function city_stats($type)
    {
        $this->db->select('*');
        $this->db->from('city_stats');
        $this->db->order_by($type,'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }

    function getFeaturedListings($limit) {
        $status_array = array('publish');
        $this->db->select('*');
        $this->db->from('listing');
        $this->db->where('is_featured',1);
        $this->db->where_in('status', $status_array);
        $this->db->order_by('id', 'ASC');
        $this->db->limit($limit);
        $query = $this->db->get();

        return $query;
    }



    public function amenities_by_category($parent,$cat) {

        $this->db->where('type', $parent);
        $query = $this->db->get('amenities_category');

        $return = array();

        foreach ($query->result() as $category)
        {
            $return[$category->id] = $category;
            $return[$category->id]->subs = $this->get_sub_categories($category->id,$cat);
        }

        return $return;

    }




    public function get_sub_categories($category_id,$cat)
    {

        $this->db->like('property_type', $cat);
        $this->db->where('category', $category_id);
        $query = $this->db->get('amenities');
       // echo $this->db->last_query();
        return $query->result();
    }


    public function isAmenityExists($id,$list_id)
    {
        $this->db->select('*');
        $this->db->where('amenities_id', $id);
        $this->db->where('listing_id', $list_id);

        $query = $this->db->get('listing_amenities');
        return $query->row();

    }



    public function amenities_by_category_list($cat,$list_id = null) {

        $this->db->where('type', $cat);
        $query = $this->db->get('amenities_category');
        //return $query->result();

        $return = array();

        foreach ($query->result() as $category)
        {

            $return[$category->id] = $category;
            $return[$category->id]->subs = $this->get_sub_categories_with_list($category->id,$list_id);

        }
        //return 'dsjfjsdjhgjhg';
        return $return;

    }


    public function get_sub_categories_with_list($category_id,$list_id)
    {

        $this->db->select('a.*,l.listing_value,l.amenities_id');
        $this->db->from('amenities a');
        $this->db->join('listing_amenities as l', 'l.amenities_id = a.id','left');
        $this->db->where('a.category', $category_id);
        $this->db->where('l.listing_id', $list_id);
        $query =  $this->db->get();

       // echo $this->db->last_query();
        return $query->result();

    }





    public function edit_amenities_by_category($cat,$lid) {

        $this->db->where('type', $cat);
        $query = $this->db->get('amenities_category');
        $return = array();

        foreach ($query->result() as $category)
        {
            $return[$category->id] = $category;
            $return[$category->id]->subs = $this->get_sub_categories_edit($lid);
        }
        return $return;
    }

    function listing_amenities($lid)
    {
        $this->db->select('*');
        $this->db->where('listing_id', $lid);
        $query = $this->db->get('listing_amenities');
        //$query =  $this->db->get();
       // return $query->result();
        //echo $this->db->last_query();
        $return = array();
        foreach ($query->result() as $category)
        {
            $amenitity_id =  $category->amenities_id;
            //$return[$category->amenities_id];
            $return[$category->amenities_id]->subs = $this->listing_amenities_categories($amenitity_id);
        }
        return $return;

    }


    function listing_amenities_categories($amenitity_id)
    {
        $this->db->where('category', $amenitity_id);
        $query = $this->db->get('amenities');
        return $query->result();


//        $this->db->select('*');
//        $this->db->from('amenities_category');
//        $this->db->where('id', $amenitity_id);
//        $query =  $this->db->get();
//        return $query->result();

    }

    public function get_sub_categories_edit($lid)
    {


        $this->db->select('a.*,l.listing_value,l.amenities_id');
        $this->db->from('amenities a');
        $this->db->join('listing_amenities as l', 'l.amenities_id = a.id','left');
        $this->db->where('a.category', $category_id);
        $this->db->where('l.listing_id', $lid);
        $query =  $this->db->get();

       echo $this->db->last_query();
        return $query->result();
    }

    /*public function edit_amenities_by_listing($listing_id)
    {
        $this->db->where('listing_id', $listing_id);
        $query = $this->db->get('listing_amenities');
        return $query->result();
    }*/





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

    /*public function room_types_search() {

        $this->db->select('id,name,active');
        $this->db->from('room_type');
        $this->db->where('active', 1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }*/

    public function getAllCityAreas($id)
    {
        $this->db->select('id,area_name AS value');
        $this->db->from('areas');
        $this->db->where('city_id', $id);
        $this->db->order_by('area_name');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function city_areas($id) {

        $this->db->select('*');
        $this->db->from('areas');
        $this->db->where('city_id', $id);
        $this->db->where('parent_id', 0);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }



    public function area_sectors($id) {

        $this->db->select('*');
        $this->db->from('areas');
        $this->db->where('parent_id', $id);

        $query = $this->db->get();
       // echo $this->db->last_query();

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

    public function save_data($data)
    {
       // echo $data['listing_id'].$data['title'];
       // die;
        $query = $this->db->query("SELECT * FROM listing_documents WHERE listing_id = '{$data['listing_id']}' and title ='{$data['title']}' ");
        $result = $query->result_array();
        $count = count($result);

        if (empty($count)) {

            $this->db->insert('listing_documents', $data);
        }
        elseif ($count == 1) {
            $this->db->where('id', $data['id']);
            $this->db->update('listing_documents', $data);
        }
    }




    public function add_floor_plans($dataSet)
    {
        $this->db->insert_batch('listing_documents', $dataSet);
        return $this->db->insert_id();

    }


    public function add_documents($dataSet,$id)
    {
        $this->db->where('user_id',$id);
        $q = $this->db->get('profile');

        if ( $q->num_rows() > 0 )
        {
            $this->db->where('user_id',$id);
            $this->db->update('profile',$dataSet);
        } else {
            $this->db->set('user_id', $id);
            $this->db->insert('profile',$dataSet);
        }



        $this->db->insert_batch('listing_documents', $dataSet);
        return $this->db->insert_id();

    }

    public function add_appointment($data)
    {

        $this->db->insert('appointments', $data);
        $last_id = $this->db->insert_id();
        if ($last_id) {
            return $last_id;
        } else {
            return false;
        }


    }


    public function set_appointment($data)
    {

        $this->db->insert('user_appointments', $data);
        $last_id = $this->db->insert_id();
        if ($last_id) {
            return $last_id;
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


    public function featured_listings_by_type($type) {

        //echo detectUserLocation();

        $this->db->select('l.*,w.id as wishlistId,w.user_id as wUserId');
        $this->db->distinct();
        $this->db->from('listing as l');
        $this->db->join('wishlists as w', 'w.listing_id = l.id','left');
        $this->db->where('l.status', 'Publish');
        $this->db->where('l.is_featured', 1);
        $this->db->where('l.purpose', $type);
        $this->db->group_by('l.id');
        $this->db->order_by('l.id', 'rand');
        $this->db->limit(12);
        $query = $this->db->get();

       //
        // echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }





    public function appointments($id) {

        $this->db->select('*');
        $this->db->from('appointments');
        $this->db->where('agent_id',$id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


    public function amenities() {

        $this->db->select('id,name');
        $this->db->from('amenities');
       // $this->db->where('active', 1);

        $query = $this->db->get();

        //echo $this->db->last_query();

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
        $this->db->where('status','Publish');
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


    public function get_list_documents($lid) {

        $this->db->select('*');
        $this->db->from('listing_documents');
        $this->db->where('listing_id', $lid);
        $this->db->where('type','property_doc');
        //$query = $this->db->get();

        return $this->db->get()->result();
    }


    public function get_list_plans($lid) {

        $this->db->select('*');
        $this->db->from('listing_documents');
        $this->db->where('listing_id', $lid);
        $this->db->where('type','floor_plan');
       // $query = $this->db->get();

        return $this->db->get()->result();
    }


    public function get_list_amenities($lid) {
        $this->db->select('amenities_id');
        $this->db->from('listing_amenities');
        $this->db->where('listing_id', $lid);
        $query = $this->db->get();

        //echo $this->db->last_query();

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


    public function get_amenity_value($lid,$id)
    {
        $this->db->select('listing_value');
        $this->db->from('listing_amenities');
        $this->db->where('listing_id', $lid,false);
        $this->db->where('amenities_id', $id,false);
        $query = $this->db->get();

        //echo $this->db->last_query();
        return $query->row()->listing_value;


    }

    public function get_all_cats()
    {


        $this->db->select('*');
        $this->db->from('amenities_category');
        return $this->db->get()->result();




    }


    public function get_list_amenities_name($lid) {

        $this->db->select('l.*,c.category,c.name,c.icon');
        $this->db->from('listing_amenities l');
        $this->db->join('amenities as c', 'l.amenities_id = c.id','left');
        $this->db->where('listing_id', $lid);

        return $this->db->get()->result_array();




        $this->db->select('id,amenities_id,listing_value');
        $this->db->from('listing_amenities');
        $this->db->where('listing_id', $lid);
        $query = $this->db->get();
        return $newdata = $query->result();

      //  echo $this->db->last_query();

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


    public function agent_related_listings($agent_id,$listing_id) {

        $this->db->select('l.*,w.id as wishlistId,w.user_id as wUserId');
        $this->db->from('listing l');
        $this->db->join('wishlists as w', 'w.listing_id = l.id','left');
        $this->db->where('l.user_id', $agent_id);
        $this->db->where_not_in('l.id', $listing_id);
        $this->db->order_by('l.id', 'DESC');

        $this->db->limit(3);
        return $this->db->get()->result();

    }


    public function get_listing_detail($listing_id) {

        $this->db->select('l.*,w.id as wishlistId,w.user_id as wUserId');
        $this->db->from('listing l');
        $this->db->join('wishlists as w', 'w.listing_id = l.id','left');
        $this->db->where('l.id', $listing_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }



    }







    public function get_listing_floor_plans($id) {

        $this->db->select('*');
        $this->db->from('listing_documents');
        $this->db->where('listing_id', $id);
        $this->db->where('type', 'floor_plan');
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();

    }


    public function get_listing_documents($id) {

        $this->db->select('*');
        $this->db->from('listing_documents');
        $this->db->where('listing_id', $id);
        $this->db->where('type', 'property_doc');
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();

    }





    public function delete_floor_plan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('listing_documents');
        return $this->db->affected_rows() > 1 ? true:false;
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

    public function get_user_all_listings($uid)
    {
        $this->db->select('id,user_id');
        $this->db->from('listing');
        $this->db->where('user_id', $uid);
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();

    }

    public function get_user_listing($uid) {

        $this->db->select('l.id,l.user_id,l.title,l.purpose,l.slug,l.price,l.preview_image_url,l.property_location,l.property_street,l.status,pr.listing_id as prId,pr.status as prStatus,pr.end_date as endDate');
        $this->db->from('listing l');

        $this->db->join('premium_requests as pr', 'pr.listing_id = l.id', 'left');
        $this->db->where('l.user_id', $uid);
       // $this->db->where('status',$status);
        $this->db->order_by('l.id', 'DESC');
        return $this->db->get()->result();
    }


    public function getPremiumListings() {

        $this->db->select('l.*,pr.listing_id as prId,pr.status as prStatus,pr.end_date as endDate');
        $this->db->from('listing l');

        $this->db->join('premium_requests as pr', 'pr.listing_id = l.id', 'left');

         $this->db->where('pr.status','Active');
        $this->db->order_by('l.id', 'RANDOM');
        return $this->db->get()->result();
    }



    public function get_user_listing_with_applicants($uid,$status) {

        $this->db->select('l.*,lp.applicant_id,u.first_name, u.last_name, u.email, u.phone, u.id AS user_id, u.picture');
        $this->db->from('listing as l');
        $this->db->join('listing_applications as lp', 'lp.listing_id = l.id', 'left');
        $this->db->join('users as u', 'lp.applicant_id = u.id', 'left');
        $this->db->where('user_id', $uid);
        $this->db->where('l.status',$status);
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();
    }


    public function userApplications($uid)
    {

        $this->db->select('lp.*,l.*');
        $this->db->from('listing_applications lp');
        $this->db->join('listing as l', 'l.id = lp.listing_id', 'left');
        $this->db->where('applicant_id', $uid);
        $this->db->order_by('l.id', 'DESC');

        return $this->db->get()->result();

    }


    public function userAppointments($uid)
    {

        $this->db->select('ua.*,l.*,u.id,u.first_name,u.last_name,u.email,u.phone,u.picture,a.start as timeslot,ua.appointment_start_time,ua.appointment_end_time');
        $this->db->from('user_appointments ua');
        $this->db->join('listing as l', 'l.id = ua.listing_id', 'left');
        $this->db->join('users as u', 'u.id = ua.agent_id', 'left');
        $this->db->join('availabalities as a', 'a.id = ua.availability_id', 'left');
        $this->db->where('ua.user_id', $uid);
        $this->db->order_by('l.id', 'DESC');
        return $this->db->get()->result();

    }



    public function get_agent_appointments($uid) {

        $this->db->select('ua.id as uaid,ua.availability_id,ua.listing_id as ualid,ua.appointment_start_time,ua.appointment_end_time,ua.message,ua.app_status,l.*,u.id as usid,u.first_name,u.last_name,u.email,u.phone,u.picture,a.start as timeform,a.end as timeto,a.start');
        $this->db->from('user_appointments ua');
        $this->db->join('listing as l', 'l.id = ua.listing_id', 'left');
        $this->db->join('users as u', 'u.id = ua.user_id', 'left');
        $this->db->join('availabalities as a', 'a.id = ua.availability_id', 'left');
        $this->db->where('ua.agent_id', $uid);
        $this->db->order_by('l.id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
       // return $this->db->get()->result();
    }


    public function agents_available_slots($lid) {

        $this->db->select('id,title,time_from,time_to,appointment_date,date_created');
        $this->db->from('appointments');
        $this->db->where('agent_id', $lid);
        return $this->db->get()->result();
       // echo $this->db->last_query();

    }


    public function ActivecalendarAppointments($id)
    {
        header("Content-Type: application/json");
        $this->db->select('id,date(start) as date,title');
        $this->db->where('user_id',$id);
        $this->db->where('start >=', date('Y-m-d'));
        $this->db->from('availabalities');
        $query = $this->db->get();
         //echo $this->db->last_query();
        return json_encode($query->result());

    }

    public function get_hours($date,$id)
    {
        $this->db->select('id as avail_id,start,end');
        $this->db->from('availabalities');
        $this->db->where('date(start)',$date);
        $this->db->where('user_id',$id);
       return $this->db->get()->result();
       // echo $this->db->last_query();


    }

    public function get_appointment_time($availability_id)
    {
        $this->db->select('availability_id,appointment_start_time,appointment_end_time');
        $this->db->from('user_appointments');
        $this->db->where('app_status','Confirm');
        $this->db->where('availability_id',$availability_id);
        return $this->db->get()->result();


    }
    public function get_pending_appointments($availability_id,$uid)
    {
        $this->db->select('availability_id,appointment_start_time,appointment_end_time,app_status');
        $this->db->from('user_appointments');
        $this->db->where('app_status','Pending');
        $this->db->where('user_id',$uid);
        $this->db->where('availability_id',$availability_id);
        return $this->db->get()->result();

    }





    public function GetTripsBooking($uid) {

        $this->db->select('b.*,b.id as bid,l.title,l.id as lid, l.slug,u.id as uid, u.first_name,u.last_name,u.picture');
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

        $this->db->select('expertise as rating, count(id) as total');
        $this->db->from('reviews');
        $this->db->where('agent_id', $lid);
        $this->db->group_by('agent_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    public function get_listing_agent($uid) {

        $this->db->select('id, first_name, last_name');
        $this->db->from('users');
        $this->db->where('id', $uid);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_listing_detail_review($lid) {

        $this->db->select('(id) AS acc');
        $this->db->from('reviews');
        $this->db->where('agent_id', $lid);
        $this->db->group_by('agent_id');
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
        $this->db->where('r.agent_id', $lid);

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

        $this->db->select('title,price,preview_image_url as image');
        $this->db->order_by('id', 'rand');
        $this->db->limit(6);
        return $this->db->get('listing')->result();
    }

    public function sort_listings($filters = array())
    {
        $limit      = $filters['limit'];
        $city       = $filters['city'];
        $state =  $filters['state'];
        $state_code =$filters['state_code'];
        $country =  $filters['country'];
        $location =  $filters['location'];
        $type       = $filters['property_type'];
        $sorting    = $filters['sorting'];
        $sql = " `listing`.`id` as listid,`listing`.`status`,`title`, `user_id`, `slug`,`property_status`, `listing`.`price`,`price_type`,`measurement_type`,`preview_image_url` AS `image`, `summary`, `latitude`, `longitude`,`property_location`,`address_line_2`, `city`, `state_province`,`zip_postal_code`,`property_street`,`home_type`,`property_type`,`sqrft`,`bedrooms`,`pieces`,`toilets`,`bathrooms`,`date_created`";
        $this->db->select($sql);
        $condition = '';
        $condition .= "(`listing.status` = 'Publish')";
        if (!empty($city)) {
            $condition .= " AND (`city` = '" . $city . "')";
        }
        if (!empty($state) && !empty($state_code)) {
            $condition .= " AND (`state_province` = '" . $state . "' OR `state_province` = '" . $state_code . "')";
        } else if (!empty($state_code)) {
            $condition .= " AND (`state_province` = '" . $state_code . "')";
        } else if (!empty($state)) {
            $condition .= " AND (`state_province` = '" . $state . "')";
        }
        if (!empty($street)) {
            $condition .= " AND (`property_location` like '%" . $street . "%')";
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


        if (!empty($location)) {
            if (is_numeric($location)) {
                $condition .= " AND (`zip_postal_code` >= '" . $location . "')";
            }
        }

        if (!empty($type_listing) && $type_listing!="any") {
            $condition .= " AND (`property_type` = '". $type_listing . "')";
        }

        //$this->db->limit($limit);

        $condition .= "  AND (`user_id` != '0')";
        if($type == 'rent' || $type == 'sale'){
            $this->db->where('listing.property_type', $type);
        }

        if($sorting == 'date-posted')
        {
            $order_by = ' `listing.id` ASC';
        }
        elseif ($sorting == 'low-to-high')
        {
            $order_by = ' `listing.price` ASC';
        }
        elseif ($sorting == 'high-to-low')
        {
            $order_by = ' `listing.price` DESC';
        }
        else
        {
            $order_by = ' `listing.id` ASC';
        }

        $this->db->from('listing');
        //$this->db->join('listing_pictures as p', 'p.listing_id = listing.id');
        $this->db->where($condition);
        $this->db->distinct();
        $this->db->order_by($order_by);
        $this->db->group_by('listing.id ');
        $query = $this->db->get();

        echo $this->db->last_query();

        return $query; // exit;



    }

    public function InsertListing($data)
    {
        if ($this->db->insert('listing', $data)) {

            return true;
        } else {
            return false;
        }

    }



    public function get_listings_for_markers()
    {
        $stack             = array();
        $GET = $this->input->get(NULL, TRUE);

        $sql = " `listing`.`id` as listid,`latitude`,`longitude`,`price`,`property_type`,`title`,`summary`, `slug`,`preview_image_url`,`pieces`,`bedrooms`,`sqrft`,`unit_id`,`area`,`land_area`,`status`";
        $this->db->select($sql);
        $street = addslashes(urldecode($this->input->get_post('street')));
        $city = addslashes(urldecode($this->input->get_post('city')));
        $state = addslashes(urldecode($this->input->get_post('state')));
        $country = addslashes(urldecode($this->input->get_post('country')));
        $type_listing= $this->input->get_post('type');
        $property_type = $this->input->get_post('property_type');
     //   $is_moved= $this->input->get_post('move');
        $location = addslashes(urldecode($this->input->get_post('location')));
        //FOR SEARCH BY MAP
        $search_by_map = $this->input->get_post('search_by_map');


        $sw_lat = $this->input->get_post('sw_lat');
        $sw_lng = $this->input->get_post('sw_lng');
        $ne_lat = $this->input->get_post('ne_lat');
        $ne_lng = $this->input->get_post('ne_lng');



        $condition = '';
       // $location = $this->input->get('location');
        $pieces = explode(",", $location);
        $len = count($pieces);

        $condition .= "(`listing.status` = 'Publish')";

        //INCASE IF WE DO SEARCH WITH REPSECT TO MAP
        if ($search_by_map == 'true') {

            $condition .= "AND (`latitude` BETWEEN $sw_lat AND $ne_lat) AND (`longitude` BETWEEN $sw_lng AND $ne_lng)";

        } else {

            if (!is_numeric($location)) {
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

                        $condition .= "`property_street`  LIKE '%" . trim($address) . "%' " . $and;

                        if ($i == $len)
                            $condition .= ")";

                        $i++;
                    }
                }
            }
        }


        if(!empty($stack))
        {
            $condition .= " AND (`id` NOT IN(".implode(',',$stack)."))";
        }

        if ($search_by_map != 'true') {

            if (!empty($property_type)){

                $condition .= " AND (`property_type` = '" . $property_type . "')";

            }
            if (!empty($city)) {
                $condition .= " AND (`city` = '" . $city . "')";
            }
            if (!empty($location)) {
                if (is_numeric($location)) {
                    $condition .= " AND (`zip_postal_code` >= '" . $location . "')";
                }
            }
            if (!empty($state)) {
                $condition .= " AND (`state_province` = '" . $state . "')";
            }
            if (!empty($street)) {
                $condition .= " AND (`property_location` like '%" . $street . "%')";
            }
            if (!empty($country)) {
                $condition .= " AND (`country` = '" . $country . "')";
            }
        }

        if (!empty($type_listing) && $type_listing != "any") {
            $condition .= " AND (`property_type` = '". $type_listing . "')";
        }

        //FINAL QUERY
        $condition .= "  AND (`listing.user_id` != '0')";
        $condition .= "  AND (`listing.latitude` != '0.00000000')";
        $condition .= "  AND (`listing.longitude` != '0.00000000')";
        $this->db->from('listing');
        $this->db->where($condition);
        $this->db->distinct();
        $this->db->group_by('listing.id ');
        $query = $this->db->get();



      //  echo $this->db->last_query();

        return $query; // exit;
    }


    public function get_listing_for_search_page($params = array(),$sorting=null,$status=null,$lat=null,$lng =null)
    {

        //echo $lat.'=='.$lng;
        $stack = array();
        $GET = $this->input->get(NULL, TRUE);
        $sql = " `listing`.`id` as listid,`listing`.`status`,`listing`.`unit_id`,`listing`.`area`,`listing`.`land_area`,`title`, `purpose`,`listing.user_id`, `slug`, `listing`.`price`,`preview_image_url` AS `image`, `summary`, `latitude`, `longitude`,`property_location`, `city`, `state_province`, `area_marla`, `area_kanal`, `area_actre`, `area_sqrft`, `area_sqmeter`, `area_sqyard`,`country`,`property_street`,`property_type`,`bedrooms`,`bathrooms`,`date_created`,w.id as wishlistId,w.user_id as wUserId";

        if(!empty($lat) && !empty($lng)){
            $sql = $sql.", ACOS( SIN( RADIANS( `latitude` ) ) * SIN( RADIANS( $lat ) ) + COS( RADIANS( `latitude` ) )* COS( RADIANS( $lat )) * COS( RADIANS( `longitude` ) - RADIANS( $lng )) ) * 6380 AS `distance`";

        }

        $this->db->select($sql);

        //Google HIDDNEN SEARCH VALUES

        $street = $this->input->get_post('street');
        $city = $this->input->get_post('city');
        $city_area = $this->input->get_post('sub_area');
        $state = $this->input->get_post('state');
        $state_code = $this->input->get_post('state_code');
        $country = $this->input->get_post('country');

        //FOR SEARCH BY MAP
        $search_by_map = $this->input->get_post('search_by_map');
        $sw_lat = $this->input->get_post('sw_lat');
        $sw_lng = $this->input->get_post('sw_lng');
        $ne_lat = $this->input->get_post('ne_lat');
        $ne_lng = $this->input->get_post('ne_lng');
        $status_ajax = $this->input->get_post('status_ajax');

        $type_listing = $this->input->get_post('type');
        $is_moved = $this->input->get_post('move');

        if ($is_moved == 'yes') {
            $type_listing = $this->input->get_post('list_type');
        } else {
            $type_listing = $this->input->get_post('type');
        }

        $property_type = $this->input->get_post('property_type');
        $listing_type = $this->input->get_post('listing_type');

        $user_types = $this->input->get_post('user_type');
        $area = $this->input->get_post('area');

        $home_types = $this->input->get_post('home_types');

        //FROM SLIDER
        $min = $this->input->get_post('min_price');
        $max = $this->input->get_post('max_price');
        if (isset($min) && isset($max)) {

            $min = ltrim(preg_replace('/[^0-9]/', '', $min), "$ ");
            $max = ltrim(preg_replace('/[^0-9]/', '', $max), "$ ");
        }

        //FOR SIZE
        $min_bedrooms = $this->input->get_post('bedrooms');
        $min_bathrooms = $this->input->get_post('bathrooms');
        $min_area = $this->input->get_post('min_area');
        $max_area = $this->input->get_post('max_area');
        $price_min = $this->input->get_post('price_min');
        $price_max = $this->input->get_post('price_max');
        $is_ajax= $this->input->get_post('ajax');
        $ajax_value= $this->input->get_post('ajax_value');
        $sort_type = $this->input->get_post('sort_type');
        //AMENITIES ARRAY
        $hosting_amenities = $this->input->get_post('amenities');

        $sort = $this->input->get_post('sort');
        if (empty($sort)) {
            $sort = 1;
        }

        $condition = '';

        $location = $this->input->get_post('location');
        $pieces = explode(",", $location);
        $len = count($pieces);

        $today =date('Y-m-d');

        if($status =='publish' | $status_ajax =='publish'){
            $condition .= "(`listing.status` = 'publish')";
        }
        if($status == 'premium'){
            if($is_ajax == 1 && $ajax_value != 1){
                $condition .= " AND ";
            }
              $condition .= "(`listing.status` = 'premium' AND `listing.end_date` >= '$today' )";
        }

      //  $condition .= " OR ";
      //  $condition .= "(`listing.status` = 'premium' AND `listing.end_date` >= '$today' )";

        if(!empty($lat) && !empty($lng)) {
            $condition .= " AND (ACOS( SIN( RADIANS( `latitude` ) ) * SIN( RADIANS( $lat ) ) + COS( RADIANS( `latitude` ) )* COS( RADIANS( $lat )) * COS( RADIANS( `longitude` ) - RADIANS( $lng )) ) * 6380 < 10)";
        }

        if ($search_by_map == 'true') {

            $condition .= "AND (`latitude` BETWEEN $sw_lat AND $ne_lat) AND (`longitude` BETWEEN '".$this->input->get_post('sw_lng')."' AND $ne_lng)";

        } else {

            if (!is_numeric($location)) {
                if ($location != '' && $country == '') {
                    $i = 1;
                    foreach ($pieces as $address) {
                        $this->db->flush_cache();
                        $address = $this->db->escape_like_str($address);

                        if ($i == $len)
                            $and = "";
                        else
                            $and = " OR ";

                        if ($i == 1)
                            $condition .= " AND (";

                        $condition .= "`property_street`  LIKE '%" . trim($address) . "%' " . $and;

                        if ($i == $len)
                            $condition .= ")";

                        $i++;
                    }
                }
            }
        }

        if (!empty($property_type) && ($property_type[0] == "rent" || $property_type[0] == "sale")) {



            if($listing_type && $listing_type == 'sale' || $listing_type == 'rent'){
                $condition .= " AND (`listing.purpose` = '". $listing_type . "')";
            }
            elseif ($listing_type && $listing_type == 'all'){

                $condition .= " AND (`listing.purpose` = 'rent') OR (`listing.purpose` = 'sale')";
            }
            else{
                $condition .= " AND (`listing.purpose` = '". $property_type[0] . "')";
            }


        }

       /*if (!empty($property_type)) {
            if (is_array($property_type)) {
                if (count($property_type) > 0) {
                    $i = 1;
                    foreach ($property_type as $property) {

                        if ($i == count($property_type)) {
                            $and = "";
                        } else {
                            $and = " OR ";
                        }

                        if ($i == 1)
                            $condition .= " AND (";

                        $condition .= "`listing.purpose` = '" . $property . "'" . $and;

                        if ($i == count($property_type))
                            $condition .= ")";

                        $i++;
                    }
                }
            }
        }*/

        if (!empty($user_types)) {
            if (is_array($user_types)) {
                if (count($user_types) > 0) {
                    $i = 1;
                    foreach ($user_types as $user) {
                        if ($i == count($user_types)) {
                            $and = "";
                        } else {
                            $and = " OR ";
                        }

                        if ($i == 1)
                            $condition .= " AND (";

                        $condition .= "`listing.listing_owner` = '" . $user . "'" . $and;

                        if ($i == count($user_types))
                            $condition .= ")";

                        $i++;
                    }
                }
            }
        }

        if (!empty($type_listing) && ($type_listing == "rent" || $type_listing == "sale")) {

            if($listing_type && $listing_type == 'sale' || $listing_type == 'rent'){
                $condition .= " AND (`listing.purpose` = '". $listing_type . "')";
            }
            elseif ($listing_type && $listing_type == 'all'){

                $condition .= " AND (`listing.purpose` = 'rent') OR (`listing.purpose` = 'sale')";
            }


            else{
                $condition .= " AND (`listing.purpose` = '". $type_listing . "')";
            }


        }


        //INCASE IF WE DO SEARCH WITH REPSECT TO MAP

        if(!empty($stack))
        {
            $condition .= " AND (`id` NOT IN(".implode(',',$stack)."))";
        }

        if (!empty($min_bedrooms)) {

            $condition .= " AND (`listing.bedrooms` >= '". $min_bedrooms . "')";
        }

        if (!empty($min_bathrooms)) {

            $condition .= " AND (`listing.bathrooms` >= '". $min_bathrooms . "')";
        }
        if ($home_types[0] == '') {
            $home_types = 'homes';
        }


        if (!empty($home_types)) {

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

                        $condition .= "`listing.property_type` = '" . $home_type . "'" . $and;

                        if ($i == count($home_types))
                            $condition .= ")";

                        $i++;
                    }
                }
            }
        }

        if ($search_by_map != 'true' && empty($lat) && empty($lng)) {
            if (!empty($city)) {
                $condition .= " AND (`listing.city` = '" . $city . "')";
            }

            if (!empty($city_area)) {
                $condition .= " AND (`listing.area` = '" . $city_area . "')";
            }

            if (!empty($country)) {
                $condition .= " AND (`listing.country` = '" . $country . "')";
            }
        }

        if(!empty($area)){

           // $condition .= " AND (`listing.unit_id` = '" . $area . "')";

        }

        if (isset($min_area) && $min_area!="") {
            if ($min_area > 0) {
                if(!empty($area)){

                    if($area == 'Square Feet'){
                        $condition .= " AND (`listing.area_sqrft` >=  $min_area )";
                    }

                    if($area == 'Square Yards'){
                        $condition .= " AND (`listing.area_sqyard` >=  $min_area )";
                    }

                    if($area == 'Square Meters'){
                        $condition .= " AND (`listing.area_sqmeter` >= $min_area )";
                    }

                    if($area == 'Marla'){
                        $condition .= " AND (`listing.area_marla` >= $min_area )";
                    }

                    if($area == 'Kanal'){
                        $condition .= " AND (`listing.area_kanal` >= $min_area )";
                    }

                }
                else{
                    $condition .= "AND  (`listing.area_sqrft` >= $min_area ) OR (`listing.area_sqyard` >= $min_area ) OR (`listing.area_sqmeter` >=  $min_area ) OR (`listing.area_marla` >= $min_area ) OR (`listing.area_kanal` >=  $min_area )";
                }
               // $condition .= " AND (`listing.area` >= '" . $min_area . "')";
            }
        } else {
            if (isset($max_area) && $max_area!="") {
                $min_area = 0;
            }
        }

        if (isset($max_area) && $max_area!="") {
            if ($max_area > $min_area) {

                if(!empty($area)){

                    if($area == 'Square Feet'){
                        $condition .= " AND (`listing.area_sqrft` <=  $max_area )";
                    }

                    if($area == 'Square Yards'){
                        $condition .= " AND (`listing.area_sqyard` <=  $max_area )";
                    }

                    if($area == 'Square Meters'){
                        $condition .= " AND (`listing.area_sqmeter` <= $max_area )";
                    }

                    if($area == 'Marla'){
                        $condition .= " AND (`listing.area_marla` <= $max_area )";
                    }

                    if($area == 'Kanal'){
                        $condition .= " AND (`listing.area_kanal` <= $max_area )";
                    }

                }
                else{
                    $condition .= "AND  (`listing.area_sqrft` <=  $max_area ) OR (`listing.area_sqyard` <=  $max_area ) OR (`listing.area_sqmeter` <= $max_area ) OR (`listing.area_marla` <= $max_area ) OR (`listing.area_kanal` <= $max_area )";
                }
                //$condition .= " AND (`listing.area` <= '" . $max_area . "')";
            }
        }

        if (isset($max_area) && $max_area!="") {
            if ($min_area == $max_area) {


                if(!empty($area)){

                    if($area == 'Square Feet'){
                        $condition .= " AND (`listing.area_sqrft` = '" . $max_area . "')";
                    }

                    if($area == 'Square Yards'){
                        $condition .= " AND (`listing.area_sqyard` = '" . $max_area . "')";
                    }

                    if($area == 'Square Meters'){
                        $condition .= " AND (`listing.area_sqmeter` = '" . $max_area . "')";
                    }

                    if($area == 'Marla'){
                        $condition .= " AND (`listing.area_marla` = '" . $max_area . "')";
                    }

                    if($area == 'Kanal'){
                        $condition .= " AND (`listing.area_kanal` = '" . $max_area . "')";
                    }

                }
                else{
                    $condition .= "AND  (`listing.area_sqrft` = '" . $max_area . "') OR (`listing.area_sqyard` = '" . $max_area . "') OR (`listing.area_sqmeter` = '" . $max_area . "') OR (`listing.area_marla` = '" . $max_area . "') OR (`listing.area_kanal` = '" . $max_area . "')";
                }



               // $condition .= " AND (`listing.area` = '" . $max_area . "')";
            }
        }

        $amenities_str = "";

        if (is_array($hosting_amenities)) {
            if (count($hosting_amenities) > 0) {
                $amenities_str = implode(',', $hosting_amenities);
            }
        }
        if (isset($min) && $min!="") {
            if ($min > 0) {
                $condition .= " AND (`listing.price` >= '" . $min . "')";
            }
        } else {
            if (isset($max) && $max!="") {
                $min = 0;
            }
        }

        if (isset($max) && $max!="") {
            if ($max > $min) {
                $condition .= " AND (`listing.price` <= '" . $max . "')";
            }
        }

        if (isset($max) && $max!="") {

            if ($max == $min) {
                 $condition .= " AND (`listing.price` = '" . $max . "')";
            }
        }


        if($sorting == 'date-posted')
        {
            $order_by = ' `listing.id` ASC';
        }
        elseif ($sorting == 'low-to-high')
        {
            $order_by = ' `listing.price` ASC';
        }
        elseif ($sorting == 'high-to-low')
        {
            $order_by = ' `listing.price` DESC';
        }

        else
        {
            $order_by = ' `listing.id` ASC';
        }

        $this->db->from('listing');
       // $this->db->join('listing_pictures as p', 'p.listing_id = listing.id');
        $this->db->join('wishlists as w', 'w.listing_id = listing.id','left');
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

        if($status == 'publish'){

            $this->db->order_by($order_by);

        }else{

            $this->db->order_by('listing.id', 'RANDOM');
        }

        $this->db->group_by('listing.id ');
        $query = $this->db->get();

        //echo $this->db->last_query();
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
        $this->db->select('b.*,l.title,l.slug,u.id as uid, u.first_name,u.last_name,u.picture');
        $this->db->from('booking as b, listing as l, users as u');
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

        $this->db->select('b.*,l.title,l.slug,l.id as lid,u.id as uid, u.first_name,u.last_name');
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
        $this->db->select('b.*,l.title,l.slug,u.id as uid, u.first_name,u.last_name,u.picture');
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

        $this->db->select('b.*,b.id as bid,l.title,l.id as lid, l.slug,u.id as uid, u.first_name,u.last_name,u.picture');
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

        $this->db->select('b.*,l.title,l.slug,l.id as lid,u.id as uid, u.first_name,u.last_name');
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
        $this->db->where('agent_id', $reviews['agent_id']);
        $this->db->limit(1);
        $query = $this->db->get();
       // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return false;
        } else {
            $this->db->insert('reviews', $reviews);
            //Update booking table status
           // $this->db->where('id', $reviews['agent_id']);
           // $this->db->update('booking', array('status' => 'complete'));
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

    function FeaturedListings($limit) {
        $status_array = array('publish');
        $this->db->select('*');
        $this->db->from('listing');
        $this->db->where('is_featured',1);
        $this->db->where_in('status', $status_array);
        $this->db->order_by('id', 'ASC');
        $this->db->limit($limit);
        $query = $this->db->get();

        //echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function AppliedListings($id,$uid) {

        $this->db->select('id,listing_id,applicant_id');
        $this->db->from('listing_applications');
        $this->db->where('listing_id',$id);
        $this->db->where('applicant_id',$uid);
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }


    function is_listing_owner($listing_id,$uid)
    {
        $this->db->select('id,property_type,status');
        $this->db->from('listing');
        $this->db->where('id',$listing_id);
        $this->db->where('user_id',$uid);
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
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
       
       $data  = array('status'=>'deleted');
       if ($this->db->update('listing', $data, array('id' => $listing_id))) {
             return 'success';
        } else {
            return false;
        }

    }

    public function updatelistingStatus($id)
    {
        $active = 'deleted';
        $this->db->where('id',$id);
        $this->db->set('status',$active);
        $this->db->update('listing');
        return true;
    }

    public function updateViews($id)
    {
        $this->db->where('id',$id);
        $this->db->set('views','views + 1', FALSE);
        $this->db->update('listing');
        //echo $this->db->last_query();die;
        return true;
    }



    public function SoldlistingStatus($id)
    {
        $active = 'Sold';
        $this->db->where('id',$id);
        $this->db->set('status',$active);
        $this->db->update('listing');
        return true;
    }
    public function appstatuscancel($id)
    {
        $app_status = 'Cancel';
        $this->db->where('id',$id);
        $this->db->set('app_status',$app_status);
        $this->db->update('user_appointments');
        //echo $this->db->last_query();die;
        return true;
    }
    public function appuserstatuscancel($id,$lid)
    {
        $app_status = 'Cancel';
        $this->db->where('appointment_id',$id);
        $this->db->where('listing_id',$lid);
        $this->db->set('app_status',$app_status);
        $this->db->update('user_appointments');
        //echo $this->db->last_query();die;
        return true;
    }
    public function appstatusconfirm($id)
    {
        $app_status = 'Confirm';
        $this->db->where('id',$id);
        $this->db->set('app_status',$app_status);
        $this->db->update('user_appointments');
        //echo $this->db->last_query();die;
        return true;
    }


    public function listing_gallery_by_id($id)
    {

        $this->db->select('id,listing_id,picture');
        $this->db->from('listing_pictures');
        $this->db->where('listing_id',$id);
        $this->db->where('active',1);

        return $this->db->get()->result();
       /* if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }*/

    }


    public function search_countries_metrix($country)
    {
        $this->db->select('symbol,measurement');
        $this->db->from('countries_metrics');
        $this->db->where('country',$country);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }


    }

    public function getTopListingsByAgent($uid){
        $this->db->select('id,title,slug,property_type,bedrooms,preview_image_url,full_address,property_location,address_line_2,city,country,zip_postal_code,price,views');
        $this->db->from('listing');
        $this->db->where('user_id',$uid);
        $this->db->order_by('views', 'DESC');
        $this->db->limit(5);

        return $this->db->get()->result_array();
        //return $this->db->get()->result();



    }
    public function get_all_agent(){
        $this->db->select('id,first_name,email');
        $this->db->from('users');
        $this->db->where('user_type','Agent');
        return $this->db->get()->result();

    }
    public function update_ufeature_status($uid){
        $feature_status = '1';
        $this->db->where('id',$uid);
        $this->db->set('featured',$feature_status);
        $this->db->update('users');
        //echo $this->db->last_query();die;
        return true;

    }


    public function listing_with_user($id){

        $this->db->select('l.id,l.listing_name,l.slug,u.email,u.first_name,u.last_name');
        $this->db->from('listing l');
        $this->db->join('users as u', 'u.id = l.user_id', 'left');
        $this->db->where('l.id',$id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();

    }



}

?>