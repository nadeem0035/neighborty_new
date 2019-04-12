<?php

Class Wishlists_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_model', 'common', true);
    }


    public function create_wishlist_category($data) {
        $this->db->insert('wishlist_categories', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function getWishlistCategories(){

        $session_data = $this->session->userdata('logged_in');
        $uid = $session_data['id']; // Current logged in userid
        $data = array(1,$uid);
        $this->db->select('id,name');
        $this->db->from('wishlist_categories');
        $this->db->where('status', '1');
        $this->db->where_in('created_by',$data);
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function createWishlist($data){

                $this->db->insert('wishlists', $data);
                return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function getWishlistsByUserId(){

     $session_data = $this->session->userdata('logged_in');
        $uid = $session_data['id'];
        $data = array(1,$uid);
        $this->db->select('wishlist_categories.id as categoryid,wishlist_categories.name,listing.id as listingid,listing.listing_name,listing.preview_image_url,wishlists.id,count(rental_wishlists.id) as total');
        $this->db->from('wishlist_categories');
        $this->db->where('wishlist_categories.status', '1');
        $this->db->where_in('wishlist_categories.created_by',$data);
        $this->db->join('wishlists', 'wishlists.wishlist_categories = wishlist_categories.id','left');
        $this->db->join('listing', 'listing.id = wishlists.listing_id','left');

        $this->db->distinct();
        $this->db->group_by('categoryid');    
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }
    public function totalListingByCategoryId($cat_id){

            $this->db->like('wishlist_categories',$cat_id);
            $this->db->from('wishlists');
            return $this->db->count_all_results();

    }

    public function wishlistDetails($id){

/*** This code Block is just Commented For Dummy Data .When Live uncomment this Query***/

//        $this->db->select('wishlists.id,wishlists.note,wishlists.status,listing.id as listingid,listing.listing_name,listing.beds,listing.price,listing.preview_image_url,listing.slug,listing.home_type,
//            listing.room_type,listing.typed_address,listing.latitude,listing.longitude,GROUP_CONCAT(picture) AS gallery');
//        $this->db->from('listing');
//        $this->db->where('wishlists.wishlist_categories',$id);
//        $this->db->join('wishlists','listing.id = wishlists.listing_id','left');
//        $this->db->join('listing_pictures','listing_pictures.listing_id = listing.id','left');
//        $this->db->group_by('listing_pictures.listing_id');
//        $query = $this->db->get();
//        //echo $this->db->last_query();
/*** This code Block is just Commented For Dummy Data .When Live comment this Query***/

      $this->db->select('wishlists.id,wishlists.note,wishlists.status,listing.id as listingid,listing.summary,listing.bedrooms,listing.bathrooms,listing.accommodates,listing.listing_name,listing.beds,listing.price,listing.preview_image_url as image,listing.slug,listing.home_type,
           listing.room_type,listing.typed_address,listing.latitude,listing.longitude');
        $this->db->from('listing');
       // $this->db->where('wishlists.wishlist_categories',$id);
       $this->db->like('wishlists.wishlist_categories', $id);
        $this->db->join('wishlists','listing.id = wishlists.listing_id','left');

        $query = $this->db->get();
        //echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 0;
        }

    }

    public function findCategoryWishlist($id){

        $this->db->select('listing_id');
        $this->db->from('wishlists');
        $this->db->where('wishlist_categories',$id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }


    }

    public function getWishlistCategoryById($id){

        $this->db->select('*');
        $this->db->from('wishlist_categories');
        $this->db->where('id',$id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function removeWishlist($lid,$uid){

        $condition = array('listing_id' => $lid, 'user_id' => $uid);
        $this->db->where($condition);
        $this->db->delete('wishlists');
        return ($this->db->affected_rows() != 1) ? false : true;

    }

    public function catDetails($id){

        $this->db->select('wishlist_categories.id as categoryid,wishlist_categories.name,wishlist_categories.visibality,wishlists.id,count(wishlists.id) as total');
        $this->db->from('wishlist_categories');
        $this->db->where('wishlist_categories.id',$id);
        $this->db->join('wishlists', 'wishlists.wishlist_categories = wishlist_categories.id','left');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function updateCategory($id,$data){

        $this->db->where('id', $id);

        if ($this->db->update('wishlist_categories', $data)) {

            return $data['name'];
        } else {
            return false;
        }


    }

    public function update_user_note($id,$note){

         $this->db->where('id', $id);
         $data = array('note'=>$note);

        if ($this->db->update('wishlists', $data)) {

            return true;

        } else {
            return false;
        }

    }

    public function fetch_updated_note($id){

        $this->db->select('note');
        $this->db->from('wishlists');
        $this->db->where('id',$id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
           return $query->row();
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
    
        
    function getUserWishlistscount($uid) {
         
       $this->db->where('user_id',$uid);
       return $this->db->count_all_results('wishlists');
    }

    function removeWishlistCategory($id){

        $this->db->where('id',$id);
        $this->db->delete('wishlist_categories');
        return ($this->db->affected_rows() != 1) ? false : true;

    }

    
}

?>