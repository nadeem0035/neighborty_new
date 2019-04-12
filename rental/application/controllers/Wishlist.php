<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Wishlist class.
 * 
 * @extends CI_Controller
 */
class Wishlist extends CI_Controller {

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct() {

        parent::__construct();
        $this->load->model('Wishlists_model', 'wishlist', true);
        $this->load->helper('text');
        $session_data = $this->session->userdata('logged_in');
        $this->seo->SetValues('Title', $session_data['full_name']."'s Wish Lists - luxus");
    }

    public function index() {
        //$this->load->helper('form');
        add_css(array('light.css'));
        add_js(array('jquery.slimscroll.min.js', 'general.js'));
        $id = $this->input->post('listing_id');
        $data['deal'] = $this->wishlist->get_list($id);
		
		//echo '<pre>';print_r($data['deal']);die;
        $data['wishlist_categoris'] = $this->wishlist->getWishlistCategories();
		$data['wishlists'] = $this->wishlist->getWishlistsByUserId();
				//echo '<pre>';print_r($data['wishlist_categoris']);die;
        $this->load->view('templates/wishlist', $data);
    }

    function wishlist() {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js', 'general.js'));

            // create the data object
            $data = new stdClass();
            $data->wishlists = $this->wishlist->getWishlistsByUserId();
			
			//echo '<pre>';print_r($data->wishlists);die;
			
            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];
            $this->load->view('templates/header');
            $this->load->view('users/wishlist', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    public function addWishlistCategories() {

        $session_data = $this->session->userdata('logged_in');
        $uid = $session_data['id']; // Current logged in userid
        $name = $this->input->post('name');
        $visibility = $this->input->post('visibility');
        $data = array('created_by' => $uid, 'name' => $name, 'visibality' => $visibility, 'status' => '1');
        $result = $this->wishlist->create_wishlist_category($data);
        echo $result;
    }

    public function wishlistCategories() {

        $data['categoris'] = $this->wishlist->getWishlistCategories();
        foreach ($data['categoris'] as $category) {
            echo '<div class="form-field field-input col-md-12">
                                <span style="display:inline-block;margin-right: 10px;">
                                    <input type="checkbox" class="checkbox" name="wishlist_category[]" value=' . $category->id . ' /></span>   
                                    <span>' . ucwords(trim($category->name)) . '</span>
                            </div>';
        }
    }

    public function createWishlist() {

        $note = $this->input->post('note_text');
        $listing_id = $this->input->post('listing_id');
        $session_data = $this->session->userdata('logged_in');
        $uid = $session_data['id']; // Current logged in userid
        $wishlist_categories = implode(",", $_POST['wishlist_category']);
        $status = '1';
        $wishlist_data = array('user_id' => $uid, 'wishlist_categories' => $wishlist_categories, 'listing_id' => $listing_id, 'note' => $note, 'status' => $status);
        $result = $this->wishlist->createWishlist($wishlist_data);

        echo $result;
    }

    public function wishlists() {

        if ($this->session->userdata('logged_in')) {

            $data = new stdClass();
            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];
            //Add Js/Css
            add_css(array('light.css', 'style.css'));
            add_js(array('jquery.slimscroll.min.js'));
            $data->wishlists = $this->wishlist->getWishlistsByUserId();
            $this->load->view('templates/header');
            $this->load->view('users/wishlist_details', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    public function wishlist_detail($id) {


        if ($this->session->userdata('logged_in')) {
            $data = array();
            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];
            $data['wishlists'] = '';
            //Add Js/Css
            add_css(array('light.css', 'set2.css'));
            add_js(array('jquery.slimscroll.min.js', 'general.js', 'CustomGoogleMapMarker.js'));
            $this->load->model('Listings_model');
            $data['result'] = $this->wishlist->findCategoryWishlist($id);

            if ($data['result'] == false) {

                $data['Wishcat'] = $this->wishlist->getWishlistCategoryById($id);
            } else {

                $data['Wishcat'] = $this->wishlist->getWishlistCategoryById($id);
                $listing_id = $data['result']->listing_id;
                $data['wishlists'] = $this->wishlist->wishlistDetails($id);

                $i = 0;
                $positions = array();
                if($data['wishlists']) {
                foreach ($data['wishlists'] as $listing) {
                    if ($i == 0) {
                        $positions = array($listing->listingid . "," . $listing->latitude . "," . $listing->longitude . "," . $listing->price);
                    } else {
                        array_push($positions, $listing->listingid . "," . $listing->latitude . "," . $listing->longitude . "," . $listing->price);
                    }
                    $i++;
                }
                }
                $data['positions'] = $positions;
                $data['abs_path'] = $this->config->item('abs_path');
            }

            $this->load->view('templates/header');
            $this->load->view('users/wishlist_details', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    public function category_details() {

        $id = $this->input->post('id');
        $data = new stdClass();
        $data->Wishcat = $this->wishlist->catDetails($id);
        $this->load->view('users/update_wishlist', $data);
    }

    public function remove_wishlist() {

        $session_data = $this->session->userdata('logged_in');
        $uid = $session_data['id'];

        $listing_id = $this->input->post('listing_id');
        $result = $this->wishlist->removeWishlist($listing_id, $uid);
        echo $result;
    }

    public function update_Wishlist_category() {

        $cat_id = $this->input->post('cat_id');
        $name = $this->input->post('name');
        $visibility = $this->input->post('visibality');
        $data = array('name' => $name, 'visibality' => $visibility);
        $result = $this->wishlist->updateCategory($cat_id, $data);
        echo $result;
    }

    public function update_note() {

        $id = $this->input->post('id');
        $note = $this->input->post('note');
        echo $result = $this->wishlist->update_user_note($id, $note);
    }

    public function get_updated_note() {

        $id = $this->input->post('id');
        $result = $this->wishlist->fetch_updated_note($id);

        echo $result->note;
    }

    public function get_listing_images($listing_id) {

        $this->load->model('Listings_model', 'listing', true);

        $list_images = $this->Listings_model->get_list_images($listing_id);
    }

    public function remove_wishlist_category() {

        $id = $this->input->post('id');
        $result = $this->wishlist->removeWishlistCategory($id);
        echo $result;
    }


}
