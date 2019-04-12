<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Controller
 */
class Listings extends CI_Controller
{
    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Listings_model');
        $this->load->model('Packages_model');
        $this->load->model('Common_model', 'common', true);
        $this->load->library('image_lib');
        $this->load->library('manipulate_img');
    }


    function index()
    {
        //Add Js/Css
        add_css(array('iziToast.css','jquery.toast.css'));
        add_js(array('jquery.validate.min.js','autocomplete_map.js','jquery.toast.js','iziToast.min.js','dashboard.js','custom_maps.js'));
        set_extra_js("loadAgentMap()");

        if( $this->session->userdata('logged_in') )
        {
            $this->load->helper('text');
            //Add Js/Css
            add_css(array('light.css'));
            // add_css(array('light.css', 'search.css'));
            add_js(array('jquery.slimscroll.min.js','jquery.validate.min.js', 'general.js','listing.js'));
            $string = '
            $(document).on("click",".modal-body li",function()
            {
                tab = $(this).attr("id");
                   // alert(tab);
                $("div.apply_tab").each(function()
                {
                    $(this).removeClass("in");
                    $(this).removeClass("active");
                });
                $("div.apply_tab#"+tab).addClass("in");
                $("div.apply_tab#"+tab).addClass("active");
            });
            ';
            set_extra_js($string);
            // create the data object
            $data = array();
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            $package = $this->Packages_model->get_package_detail($uid);
            if(!empty($package)){
                $transit_id = $package[0]->transaction_id;
                $data['package_stats'] = $this->Packages_model->get_package_stat($uid,$transit_id);
            }



            $data['package'] = $this->Packages_model->get_package_detail($uid);
            $data['pakage_detail'] = $this->Packages_model->get_user_package($uid);
            $data['listings'] = $this->Listings_model->get_user_listing($uid);
            $data['application'] = $this->common->get_result('rental_application','user_id',$uid);
            $data['packages'] = $this->common->getAllContent('*','premium_packages');
            //Title and meta description
            $this->seo->SetValues('Title', 'My  Listings - Zoney');
            $this->seo->SetValues('Description', "Rent out your room, house or apartment on Zoney. Join thousands already renting out their space to people all over the world. Listing your space is free!");
            $this->load->view('templates/header');
            $this->load->view('listings/listings', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            redirect('/');
        }
    }

    function your_reservations()
    {
        if( $this->session->userdata('logged_in') )
        {
            //Add Js/Css
            add_css(array('light.css', 'search.css'));
            add_js(array('jquery.slimscroll.min.js'));
            // create the data object
            $data = new stdClass();
            //$data->extra_js = 'Inbox.init();';
            $this->load->view('templates/header');
            $this->load->view('listings/reservations', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function detect_listing_location()
    {
        $country = $this->input->get_post('country');

        $result = $this->Listings_model->search_countries_metrix($country);

        if($result){

            echo $result->symbol .','.$result->measurement;

        }
        else{

            echo '$' .','.'sqft';
        }


    }

    function selectAmenities()
    {
        $data = new stdClass();
        $cat_type = strtolower($this->input->post('cat_type'));
        $parent_id = $this->input->post('parent_id');
        $data->amenities = $this->Listings_model->amenities_by_category($parent_id,$cat_type);
        $this->load->view('listings/amenities', $data);
    }
    function editAmenities()
    {
        $data = new stdClass();
        $cat_type = strtolower($this->input->post('cat_type'));
        $parent_id = $this->input->post('parent_id');
        $data->amenities = $this->Listings_model->amenities_by_category($parent_id,$cat_type);
        $this->load->view('listings/amenities', $data);
    }



    function selectEditAmenities()
    {
        $data = new stdClass();
        $cat_type = $this->input->post('cat_type');
        $list_id = $this->input->post('list_id');
        $data->list_id = $list_id;
        $parent_id = $this->input->post('parent_id');
        $data->amenities = $this->Listings_model->amenities_by_category($parent_id,$cat_type);
        $data->list_amenities = $this->Listings_model->amenities_by_category_list($parent_id,$list_id);

//        pre($data);

        $this->load->view('listings/edit_amenities', $data);

    }

    function add_property()
    {
        $session_data_listing = $this->session->userdata('listing');
         if ($this->session->userdata('logged_in'))
         {
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            $this->load->helper('form');
            $this->load->library('form_validation');
            add_css(
                array(
                    'light.css',
                    'dropzone.css',
                    'jquery.toast.css',
                )
            );
            add_js(
                array(

                )
            );
            $data = new stdClass();
            $pakage_detail = $this->Packages_model->get_package_detail($uid);
            $data->cities = $this->common->getAllContent('*','cities');

            if(!empty($pakage_detail)){
                $transit_id = $pakage_detail[0]->transaction_id;
                $data->package_stats = $this->Packages_model->get_package_stat($uid,$transit_id);
            }

            //pre($data);
            $data->home_types = $this->Listings_model->home_types();
            $data->amenities = $this->Listings_model->amenities();

            $data->title = 'Add New Listing';
            $data->step = isset( $_GET['step'] ) ? $_GET['step'] : 1;

            if( isset($_POST['listing_name']) && !empty($_POST['listing_name']))
            {
                $this->form_validation->set_rules('geocomplete','Location','trim|required');
                $this->form_validation->set_rules('route','Address','trim|required');
                $this->form_validation->set_rules('locality','city','trim|required');
                $this->form_validation->set_rules('administrative_area_level_1','Province','trim|required');
                $this->form_validation->set_rules('country','Country','trim|required');
                $this->form_validation->set_rules('listing_name','Property name','trim|required');
                $this->form_validation->set_rules('summary','Description','trim|required');
                $this->form_validation->set_rules('bedrooms','Bed rooms','trim|required');
                $this->form_validation->set_rules('bathrooms','Bath rooms','trim|required');
                $this->form_validation->set_rules('pieces','Rooms','trim|required');
                $this->form_validation->set_rules('price','Price','trim|required');
                $this->form_validation->set_rules('area','Area','trim|required');
                if($this->form_validation->run() == false){
                    //$this->session->set_flashdata('name','Your message');
                    $error = validation_errors();
                    $this->session->set_flashdata('listError',$error);
                    redirect($_SERVER['HTTP_REFERER']);


                }
                else {

                    $id = $_POST['id'];
                    unset($_POST['id']);
                    $areaType = $_POST['unit'];
                    $area = $_POST['area'];
                    $areaArray = area_converter($areaType, $area);

                    //Storing property type in session for image renaming purposes
                    $property_type = $this->session->set_userdata('property_type', $this->input->get_post('property_type', false));
                    $this->session->set_userdata($property_type);


                    $data = array(
                        'user_id' => $uid,
                        'listing_name' => $this->input->get_post('listing_name', false),
                        'slug' => slugit($this->input->get_post('listing_name')),
                        'typed_address' => $this->input->get_post('geocomplete', false),
                        'address_line_1' => $this->input->get_post('street_address', false),
                        'address_line_2' => $this->input->get_post('route', false),
                        'city_town' => $this->input->get_post('locality', false),
                        'state_province' => $this->input->get_post('administrative_area_level_1', false),
                        'country' => $this->input->get_post('country', false),
                        'zip_postal_code' => $this->input->get_post('postal_code', false),
                        'latitude' => $this->input->get_post('lat', false),
                        'longitude' => $this->input->get_post('lng', false),
                        'summary' => $this->input->get_post('summary', false),
                        'status' => ($this->input->get_post('status', false)),
                        'home_type' => ($this->input->get_post('home_type', false)),
                        'unit' => ($this->input->get_post('unit', false)),
                        'area' => ($this->input->get_post('area', false)),
                        'area_sqrft' => $areaArray['square_feet'],
                        'area_sqyard' => $areaArray['square_yards'],
                        'area_sqmeter' => $areaArray['square_metres'],
                        'area_marla' => $areaArray['area_marla'],
                        'area_kanal' => $areaArray['area_kanal'],
                        'listing_owner' => ($this->input->get_post('listing_owner', false)),
                        'bedrooms' => ($this->input->get_post('bedrooms', false)),
                        'bathrooms' => ($this->input->get_post('bathrooms', false)),
                        'pieces' => ($this->input->get_post('pieces', false)),
                        'kitchen' => ($this->input->get_post('kitchen', false)),
                        'property_type' => ($this->input->get_post('property_type', false)),
                        'price' => ($this->input->get_post('price', false)),
                        'reference' => ($this->input->get_post('reference', false)),
                        //'req_qualify' => $this->input->get_post('req_qua',false),
                        'video' => $this->input->get_post('video', false),
                        'active' => 'Pending',
                    );

                    $result = $this->db->insert('listing', $data);
                    $insert_id = $this->db->insert_id();
                    if ($_POST['property_type'] == 'sale') {

                        $this->db->where('user_id', $uid);
                        $q = $this->db->get('user_stats');

                        if ($q->num_rows() > 0) {
                            $this->db->where('user_id', $uid);
                            $this->db->set('sales', 'sales+1', FALSE);
                            $this->db->update('user_stats');
                        } else {

                            $data = array('user_id' => $uid, 'sales' => 1, 'sold' => 0, 'rental' => 0, 'reviews' => 0, 'recommendation' => 0, 'rating' => 0);
                            $this->db->insert('user_stats', $data);

                        }

                    }
                    if ($_POST['property_type'] == 'rent') {

                        $this->db->where('user_id', $uid);
                        $q = $this->db->get('user_stats');

                        if ($q->num_rows() > 0) {
                            $this->db->where('user_id', $uid);
                            $this->db->set('rental', 'rental+1', FALSE);
                            $this->db->update('user_stats');
                        } else {

                            $data = array('user_id' => $uid, 'sales' => 0, 'sold' => 0, 'rental' => 1, 'reviews' => 0, 'recommendation' => 0, 'rating' => 0);
                            $this->db->insert('user_stats', $data);
                        }

                    }
                    if ($_POST['is_featured'] == 'featured') {
                        $this->db->where('agent_id', $uid);
                        $q = $this->db->get('package_stats');

                        if ($q->num_rows() > 0) {
                            $this->db->set('featured', 'featured-1', FALSE);
                            $this->db->update('package_stats');
                        }
                    }
                    else {
                        $this->db->where('agent_id', $uid);
                        $q = $this->db->get('package_stats');

                        if ($q->num_rows() > 0) {
                            $this->db->set('avilable_listings', 'avilable_listings-1', FALSE);
                            $this->db->update('package_stats');
                        }

                    }


                    $name = $_POST['amenities'];

                    if(!empty($name)){

                        $result = $this->crud_model->delete(array('where' => 'listing_id = ' . $insert_id, 'table' => 'listing_amenities'));
                    }


                    foreach( $name as $key => $n ) {

                        $val = explode("_-",$n);
                        if (strpos($n, '_-') !== false) {

                            $data = array('listing_id' => $insert_id, 'amenities_id' => $val[0], 'listing_value' => $val[1]);

                        }else{

                            $data = array('listing_id' => $insert_id, 'amenities_id' => $val[0] );

                        }
                        $processed_query = post_query($data, 'listing_amenities', 'listing_id = ' . $insert_id . '') . '';
                        $result = $this->crud_model->query(array('query' => $processed_query));




                    }

                    unset($_POST['amenities']);
                    unset($_POST['listing_value']);
                    $data->msg = $result;
                    redirect(site_url('listings/edit/' . $insert_id . '?step=2'));
                }
            }
            $this->seo->SetValues('Title', 'Rent Out Your Room, House or Apartment on Zoney');
            $this->seo->SetValues('Description', "Rent out your room, house or apartment on Zoney. Join thousands already renting out their space to people all over the world. Listing your space is free!");
           // $this->load->view('templates/header');
            $this->load->view('listings/add_listing', $data);
           // $this->load->view('templates/footer');
        }
        else
        {
            redirect('/login');
        }
    }

    function postProperty()
    {

        $session_data_listing = $this->session->userdata('listing');
        if ($this->session->userdata('logged_in'))
        {
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            $this->load->helper('form');
            $this->load->library('form_validation');
            $data = new stdClass();
            $data->title = 'Add New Property';

            if ($this->input->is_ajax_request()) {

                $this->form_validation->set_rules('purpose','purpose','trim|required');
                $this->form_validation->set_rules('property_type','Property Type','trim|required');
                $this->form_validation->set_rules('property_sub_type','Property Sub Type','trim|required');
                $this->form_validation->set_rules('property_city','City','trim|required');
                //$this->form_validation->set_rules('property_area','Area','trim|required');
                $this->form_validation->set_rules('state_province','State','trim|required');
                $this->form_validation->set_rules('country','Country','trim|required');
                $this->form_validation->set_rules('lat','Latitude','trim|required');
                $this->form_validation->set_rules('lng','Longitude','trim|required');
                $this->form_validation->set_rules('property_title','Property name','trim|required');
                $this->form_validation->set_rules('summary','Description','trim|required');
                $this->form_validation->set_rules('land_area','Land Ara','trim|required');
                $this->form_validation->set_rules('unit_id','Land Unit','trim|required');
                $this->form_validation->set_rules('price','Price','trim|required');
                $this->form_validation->set_rules('property_title','Property Title','trim|required');

                if($this->form_validation->run() == false){

                    $response = array(
                        'status' => '400',
                        'message' => validation_errors(),
                        'response' =>'error'

                    );

                    echo json_encode($response);

                } else {

                    $areaType = $this->input->get_post('unit_id');
                    $area = $this->input->get_post('land_area');
                    $areaArray = area_converter($areaType, $area);

                    $list_files = $this->input->get_post('listing_files');


                    $location_data = array(

                        'sub_sub_area' => $this->input->post('sub_sub_area',false),
                        'sub_area' => $this->input->post('sub_area',false),
                        'area_location' => $this->input->post('area_location',false),
                        'city' => $this->input->post('city',false),
                        'state_province' => $this->input->post('state_province',false),
                        'country' => $this->input->post('country',false),
                    );

                    $t = implode(' , ', $location_data);
                    $composed_location = trim($t," , ");

                    $data = array(

                        'user_id' => $uid,
                        'house_number' => $this->input->get_post('house_number', false),
                        'property_street' => $this->input->get_post('property_street', false),
                        'purpose' => $this->input->get_post('purpose', false),
                        'property_type' => $this->input->get_post('property_type', false),
                        'property_sub_type' => $this->input->get_post('property_sub_type', false),
                        'city' => ($this->input->get_post('property_city', false)),
                        'area' => ($this->input->get_post('property_area', false)),
                        'property_location'=>$composed_location,
                        'area_sqrft' => $areaArray['square_feet'],
                        'area_sqyard' => $areaArray['square_yards'],
                        'area_sqmeter' => $areaArray['square_metres'],
                        'area_marla' => $areaArray['area_marla'],
                        'area_kanal' => $areaArray['area_kanal'],
                        'area_actre' => $areaArray['area_acre'],
                        'sectors' => ($this->input->get_post('property_sub_area', false)),
                        'state_province' => ($this->input->get_post('state_province', false)),
                        'country' => ($this->input->get_post('country', false)),
                        'latitude' => $this->input->get_post('lat', false),
                        'longitude' => $this->input->get_post('lng', false),
                        'title' => ($this->input->get_post('property_title', false)),
                        'slug' => slugit($this->input->get_post('property_title')),
                        'summary' => ($this->input->get_post('summary', false)),
                        'land_area' => $this->input->get_post('land_area', false),
                        'unit_id' => $this->input->get_post('unit_id', false),
                        'bedrooms' => $this->input->get_post('bedrooms',false),
                        'bathrooms' => $this->input->get_post('bathrooms', false),
                        'price' => $this->input->get_post('price', false),
                        'expires' => $this->input->get_post('expires', false),
                        'video' => $this->input->get_post('video', false),
                        'contact_primary' => $this->input->get_post('contact_primary', false),
                        'contact_secondary' => $this->input->get_post('contact_secondary', false),
                        'status' => 'pending',

                    );

                    $result = $this->db->insert('listing', $data);
                    $insert_id = $this->db->insert_id();
                    $file_title = 'zoney_pk-'.slugit($this->input->get_post('property_title'));
                    $unique_no = $this->input->get_post('unique_no');
                    $this->saveFileNames($list_files,$insert_id,$file_title,$unique_no);
                    $amenities = $_POST['amenities'];
                    $this->addAmenities($amenities,$insert_id);

                    if($result){



                        $city_id = $this->input->post('property_city',false);
                        $city = $this->input->post('city',false);
                        $purpose = $this->input->get_post('purpose', false);


                        $this->statsUpdates($city_id,$city,$purpose);


                        $response = array(
                            'status' => '200',
                            'message' => 'success',
                            'response' =>'success'
                        );

                        echo json_encode($response);
                    }
                }
            }

        }else{

            redirect('/login');
        }
    }


    function statsUpdates($city_id,$city,$purpose)
    {

        $this->db->where('city_id',$city_id);
        $q = $this->db->get('city_stats');

        $post_data = array('city_id'=> $city_id,'city'=>$city);

        if ( $q->num_rows() > 0 )
        {

            $this->db->where('city_id',$city_id);

            if($purpose == 'sale'){
                $this->db->set('sale', 'sale+1',FALSE);
            }else{
                $this->db->set('rent', 'rent+1',FALSE);
            }

            return $this->db->update('city_stats',$post_data);

        } else {

            $this->db->set('city_id', $city_id);
            if($purpose == 'sale'){
                $this->db->set('sale', 'sale+1',FALSE);
            }else{
                $this->db->set('rent', 'rent+1',FALSE);
            }

            return $this->db->insert('city_stats',$post_data);
        }



    }

    function edit_property($lid = NULL){

        if ($this->session->userdata('logged_in')) {
            $this->load->helper('form');
            $this->load->library('form_validation');
            add_css(
                array(
                    'light.css',
                    'dropzone.css',
                    'jquery.toast.css',
                )
            );
            add_js(
                array()
            );

            $data = new stdClass();
            $data->cities = $this->common->getAllContent('*','cities');
            $data->title = 'Edit Listing';
            $data->listing = $this->Listings_model->get_list($lid);
        $result = $this->Listings_model->get_list_images($lid);
       // pr($result);

        foreach($result as $row){


            $data->pic_str .=  $row->picture.',';
        }

            $this->load->view('listings/edit_property', $data);
      } else {
            redirect('/login');
        }
    }

    function postEditProperty(){

        if ($this->session->userdata('logged_in'))
        {
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];

            $this->load->helper('form');
            $this->load->library('form_validation');
            $data = new stdClass();
            $data->title = 'Edit Property';

            if ($this->input->is_ajax_request()) {

                $this->form_validation->set_rules('purpose','purpose','trim|required');
                $this->form_validation->set_rules('property_type','Property Type','trim|required');
                $this->form_validation->set_rules('property_sub_type','Property Sub Type','trim|required');
                $this->form_validation->set_rules('property_city','City','trim|required');
                $this->form_validation->set_rules('state_province','State','trim|required');
                $this->form_validation->set_rules('country','Country','trim|required');
                $this->form_validation->set_rules('lat','Latitude','trim|required');
                $this->form_validation->set_rules('lng','Longitude','trim|required');
                $this->form_validation->set_rules('summary','Description','trim|required');
                $this->form_validation->set_rules('land_area','Land Ara','trim|required');
                $this->form_validation->set_rules('unit_id','Land Unit','trim|required');
                $this->form_validation->set_rules('price','Price','trim|required');

                if($this->form_validation->run() == false){

                    $response = array(
                        'status' => '400',
                        'message' => validation_errors(),
                        'response' =>'error'

                    );

                    echo json_encode($response);

                } else {

                    $areaType = $this->input->get_post('unit_id');
                    $area = $this->input->get_post('land_area');
                    $areaArray = area_converter($areaType, $area);

                    $list_files = $this->input->get_post('listing_files');
                    $listing_id = $this->input->get_post('id');
                    $property_locate    = $this->input->post('property_loc');
                    $property_area    = $this->input->post('property_area');
                    if($property_area == ''){

                        $composed_location = $property_locate;

                    } else {

                        $location_data = array(
                            'sub_sub_area' => $this->input->post('sub_sub_area', false),
                            'sub_area' => $this->input->post('sub_area', false),
                            'area_location' => $this->input->post('area_location', false),
                            'city' => $this->input->post('city', false),
                            'state_province' => $this->input->post('state_province', false),
                            'country' => $this->input->post('country', false),
                        );
                        $t = implode(' , ', $location_data);
                        $composed_location = trim($t, " , ");
                    }

                    $data = array(

                        'user_id' => $uid,
                        'house_number' => $this->input->get_post('house_number', false),
                        'property_street' => $this->input->get_post('property_street', false),
                        'purpose' => $this->input->get_post('purpose', false),
                        'property_type' => $this->input->get_post('property_type', false),
                        'property_sub_type' => $this->input->get_post('property_sub_type', false),
                        'city' => ($this->input->get_post('property_city', false)),
                        'area' => ($this->input->get_post('property_area', false)),
                        'property_location'=>$composed_location,
                        'area_sqrft' => $areaArray['square_feet'],
                        'area_sqyard' => $areaArray['square_yards'],
                        'area_sqmeter' => $areaArray['square_metres'],
                        'area_marla' => $areaArray['area_marla'],
                        'area_kanal' => $areaArray['area_kanal'],
                        'sectors' => ($this->input->get_post('property_sub_area', false)),
                        'state_province' => ($this->input->get_post('state_province', false)),
                        'country' => ($this->input->get_post('country', false)),
                        'latitude' => $this->input->get_post('lat', false),
                        'longitude' => $this->input->get_post('lng', false),
                        'title' => ($this->input->get_post('property_title', false)),
                        'slug' => slugit($this->input->get_post('property_title')),
                        'summary' => ($this->input->get_post('summary', false)),
                        'land_area' => $this->input->get_post('land_area', false),
                        'unit_id' => $this->input->get_post('unit_id', false),
                        'bedrooms' => $this->input->get_post('bedrooms',false),
                        'bathrooms' => $this->input->get_post('bathrooms', false),
                        'price' => $this->input->get_post('price', false),
                        'expires' => $this->input->get_post('expires', false),
                        'video' => $this->input->get_post('video', false),
                        'contact_primary' => $this->input->get_post('contact_primary', false),
                        'contact_secondary' => $this->input->get_post('contact_secondary', false),
                        'status' => 'pending',

                    );
                    $this->db->where('id', $listing_id);
                    $result = $this->db->update('listing', $data);
                   $insert_id = $listing_id;
                    $file_title = 'zoney_pk-'.slugit($this->input->get_post('property_title'));
                    if($list_files !== ''){
                        $this->db->where('listing_id', $insert_id);
                        $this->db->delete('listing_pictures');
                        $unique_no = $this->input->get_post('unique_no');
                        $this->updateFileNames($list_files,$insert_id,$file_title,$unique_no);
                    }
                    $this->db->where('listing_id', $insert_id);
                    $this->db->delete('listing_amenities');
                    $amenities = $_POST['amenities'];
                    $this->addAmenities($amenities,$insert_id);

                    if($result){
                        $response = array(
                            'status' => '200',
                            'message' => 'success',
                            'response' =>'success'
                        );

                        echo json_encode($response);
                    }
               }
            }

        } else {

            redirect('/login');
        }

    }


    function composePropertyLocation($data)
    {
        $location ='';
        if($data['sector_sub_area'] != ''){
            $location += $data['sector_sub_area'];
        }
        if($data['area_sub_location'] != ''){
            $location += $data['area_sub_location'];
        }

        if($data['area_location'] != ''){
            $location += $data['area_location'];
        }

        if($data['city'] != ''){
            $location += $data['city'];
        }

        if($data['state_province'] != ''){
             $location += $data['state_province'];
        }

        if($data['country'] != ''){
            $location += $data['country'];
        }

       return $location;

    }

    function addAmenities($name,$insert_id)
    {
        if(!empty($name)){

            $result = $this->crud_model->delete(array('where' => 'listing_id = ' . $insert_id, 'table' => 'listing_amenities'));
        }

        foreach( $name as $key => $n ) {

            $val = explode("_-",$n);
            if (strpos($n, '_-') !== false) {

                $data = array('listing_id' => $insert_id, 'amenities_id' => $val[0], 'listing_value' => $val[1]);

            }else{

                $data = array('listing_id' => $insert_id, 'amenities_id' => $val[0] );

            }
            $processed_query = post_query($data, 'listing_amenities', 'listing_id = ' . $insert_id . '') . '';
            $result = $this->crud_model->query(array('query' => $processed_query));
        }

        unset($_POST['amenities']);


    }

    function saveFileNames($list_files,$insert_id,$title,$unique_no)
    {


        if( $list_files != ''){
            $str =  rtrim($list_files,',');
            $arr = explode(',',$str);
            foreach($arr as $key => $val){
                $ext = pathinfo($val, PATHINFO_EXTENSION);
                $filename =pathinfo($val, PATHINFO_FILENAME);
                if($key == 0){
                    $this->common->commonUpdate('listing', array('preview_image_url'=>$title.'-'.slugit($filename).'-'.$unique_no.'.'.$ext),'id',$insert_id );
                }
                $data = array('listing_id' =>$insert_id,'picture'=>$title.'-'.slugit($filename).'-'.$unique_no.'.'.$ext,'sort'=>$key);

                $this->db->insert('listing_pictures', $data);
            }

            $this->session->unset_userdata('unique_no');

        }
    }

    function updateFileNames($list_files,$insert_id,$title,$unique_no)
    {



        if( $list_files != ''){
            $str =  rtrim($list_files,',');
            $arr = explode(',',$str);

            foreach($arr as $key => $val){
                $ext = pathinfo($val, PATHINFO_EXTENSION);
                $filename =pathinfo($val, PATHINFO_FILENAME);
                if (strpos($filename, 'zoney_pk-') !== false) {

                    if($key == 0){
                        $this->common->commonUpdate('listing', array('preview_image_url'=>$filename.'.'.$ext),'id',$insert_id );
                    }
                    $data = array('listing_id' =>$insert_id,'picture'=>$filename.'.'.$ext,'sort'=>$key);

                    $this->db->insert('listing_pictures', $data);

                } else {

                    if($key == 0){
                        $this->common->commonUpdate('listing', array('preview_image_url'=>$title.'-'.slugit($filename).'-'.$unique_no.'.'.$ext),'id',$insert_id );
                    }
                    $data = array('listing_id' =>$insert_id,'picture'=>$title.'-'.slugit($filename).'-'.$unique_no.'.'.$ext,'sort'=>$key);

                    $this->db->insert('listing_pictures', $data);

                }


            }

            $this->session->unset_userdata('unique_no');

        }
    }

    function listing_preview_image_upload()
    {

        $title = 'zoney.pk-'.slugit($this->input->get_post('key'));
        $unique_no = $this->input->get_post('code');
        $this->load->helper('form');
        $listing_images = $this->config->item('listing_images');
        $property_images = $this->config->item('property_images');

        if(!empty($_FILES['file']['name'])){

            $config['upload_path'] = $listing_images;
            $config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG';
            $file_ext = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
            $file_name = pathinfo($_FILES["file"]["name"],PATHINFO_FILENAME);
            $filename = slugit($file_name);
            $config['file_name'] = $title.'-'.$filename.'-'.$unique_no.'.'.$file_ext;
            $this->load->library('upload', $config);

            if( $this->upload->do_upload('file') )
            {
                $data = $this->upload->data();
                $session_data_listing = $this->session->userdata('listing');
                $listing_id = $session_data_listing['id'];
                $form_data = array();
                $form_data['preview_image_url'] = $_FILES["file"]['name'].'.'.$unique_no;

                if( $this->Listings_model->update_listing($form_data, $listing_id) )
                {
                    $this->manipulate_img->watermark($data['full_path']);
                    $this->manipulate_img->resize($data['full_path'],$property_images.'thumbs',780,400);
                    $this->manipulate_img->watermark($data['full_path']);
                    $this->manipulate_img->resize($data['full_path'],$property_images.'small',400,200);
                    $this->manipulate_img->watermark($data['full_path']);
                    $this->manipulate_img->resize($data['full_path'],$property_images.'tiny',20,20);

                   // echo
                    echo json_encode(array("msg" => "success"));
                }
                else
                {
                    echo json_encode(array("msg" => 'error'));
                }
            }
            else
            {
                echo  json_encode(array("msg" => 'error','error'=> $this->upload->display_errors()) );
            }
        }
    }


    function cityAreas(){

        $id = $this->input->get_post('id');
        $result =  $this->Listings_model->getAllCityAreas($id);
        echo json_encode($result);


    }


    function areasByCityId(){

         $id = $this->input->get_post('id');
         $result =  $this->Listings_model->city_areas($id);
         echo json_encode($result);


    }

    function areasSectors()
    {
        $id = $this->input->get_post('id');
        $result =  $this->Listings_model->area_sectors($id);
        echo json_encode($result);

    }

    function edit($lid = NULL)
    {
        if ($this->session->userdata('logged_in')) {
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            if (is_numeric($lid) && $this->Listings_model->validate_user_listing($uid, $lid)) {
                $step = $this->input->get('step');
                $_SESSION['listing']['id'] = $lid;
                $this->load->helper('form');
                $this->load->library('upload');
                //Add Js/Css
                add_css(
                    array(
                        'light.css',
                        'blueimp-gallery.min.css',
                        'jquery.fileupload.css',
                        'jquery.fileupload-ui.css',
                        'simditor.css',
                        'dropzone.css',
                    )
                );
                add_js(
                    array(
                        'jquery.min.js',
                        'jquery-migrate.min.js',
                        'jquery-ui.min.js',
                        'jquery.validate.min.js',
                        'dropzone.js',
                        //'jquery.slimscroll.min.js',
                        //'additional-methods.min.js',
                        //'jquery.geocomplete2.js',
                        //'google-map.js',
                        //'jquery.ui.widget.js',
                        //'tmpl.min.js',
                        //'load-image.min.js',
                        //'canvas-to-blob.min.js',
                        //'jquery.blueimp-gallery.min.js',
                        //'jquery.iframe-transport.js',
                        //'jquery.fileupload.js',
                        //'jquery.fileupload-process.js',
                        //'jquery.fileupload-image.js',
                        //'jquery.fileupload-validate.js',
                        //'jquery.fileupload-ui.js',
                        //'form-fileupload.js',
                        //'simpleUpload.min.js',
                        'general.js',
                        'dashboard.js',
                        //'mobilecheck.js',
                        //'module.js',
                        //'hotkeys.js',

                    )
                );
                if($step == 2 || $step == 3){ add_js();
                }
                else { add_js(array('simditor.js', 'editor.js',)); }

                remove_js('bootstrap-datepicker.js');
                $string = 'FormFileUpload.init();';
                set_extra_js($string);
                $data = new stdClass();
                $data->home_types = $this->Listings_model->home_types();
                $data->amenities = $this->Listings_model->amenities();
                $data->title = 'Edit Listing';
                $data->listing = $this->Listings_model->get_list($lid);
                $data->status = 'edit';
                $data->step = isset($_GET['step']) ? $_GET['step'] : 1;

                if (isset($_POST['listing_name']) && !empty(trim($_POST['listing_name']))) {

                    $id = $_POST['id'];
                    unset($_POST['id']);

                    $_POST['user_id'] = $_SESSION['logged_in']['id'];

                    $listing_data = array(

                        'listing_name' => addslashes($this->input->get_post('listing_name',false)),
                        'slug' => slugit($this->input->get_post('listing_name')),
                        'typed_address' => addslashes($this->input->get_post('geocomplete',false)),
                        'address_line_1' => addslashes($this->input->get_post('street_address',false)),
                        'address_line_2' => addslashes($this->input->get_post('route',false)),
                        'city_town' => addslashes($this->input->get_post('locality',false)),
                        'state_province' => addslashes($this->input->get_post('administrative_area_level_1',false)),
                        'country' => addslashes($this->input->get_post('country',false)),
                        'zip_postal_code' => addslashes($this->input->get_post('postal_code',false)),
                        'latitude' => $this->input->get_post('lat',false),
                        'longitude' => $this->input->get_post('lng',false),
                        'summary' => strip_tags(addslashes($this->input->get_post('summary',false))),
                        'status' => ($this->input->get_post('status',false)),
                        'home_type' => ($this->input->get_post('home_type',false)),
                        'bedrooms' => ($this->input->get_post('bedrooms',false)),
                        'bathrooms' => ($this->input->get_post('bathrooms',false)),
                        'pieces' => ($this->input->get_post('pieces',false)),
                        'toilets' => ($this->input->get_post('toilets',false)),
                        'property_type' => ($this->input->get_post('property_type',false)),
                        'price' => ($this->input->get_post('price',false)),
                        'reference' => ($this->input->get_post('reference',false)),
                        'req_qualify' => addslashes($this->input->get_post('req_qua',false)),
                        'video' => addslashes($this->input->get_post('video',false)),
                        'active' => 'Pending',
                    );


                    $this->db->where('id', $id);
                    $result = $this->db->update('listing', $listing_data);


                    $name = $_POST['amenities'];




                    if(!empty($name)){

                        $result = $this->crud_model->delete(array('where' => 'listing_id = ' . $id, 'table' => 'listing_amenities'));
                    }


                    foreach( $name as $key => $n ) {

                        $val = explode("_-",$n);
                        if (strpos($n, '_-') !== false) {

                            $data_new = array('listing_id' => $id, 'amenities_id' => $val[0],'listing_value' => $val[1]);

                        }else{

                            $data_new = array('listing_id' => $id, 'amenities_id' => $val[0]);

                        }
                        $processed_query = post_query($data_new, 'listing_amenities', 'listing_id = ' . $id . '') . '';
                        $result = $this->crud_model->query(array('query' => $processed_query));

                    }

                    unset($_POST['amenities']);
                    unset($_POST['listing_value']);
                    $data->msg = $result;
                    redirect(site_url('listings/edit/' . $id . '?step=2'));
                }
                $this->seo->SetValues('Title', 'Rent Out Your Room, House or Apartment on Zoney');
                $this->seo->SetValues('Description', "Rent out your room, house or apartment on Zoney. Join thousands already renting out their space to people all over the world. Listing your space is free!");
                $this->load->view('templates/header');
                $this->load->view('listings/edit', $data);

            } else {
                redirect('/');
            }
        }
        else
        {
            redirect('/');
        }
    }

    function delete_floor_plan(){
        $id = $this->input->post('id');
        if($this->Listings_model->delete_floor_plan($id)){
            echo '1';
        }else{
            echo '0';
        }
    }

    function set_upload_options()
    {
        $listing_images = $this->config->item('listing_images');
        $config = array();
        $config['upload_path'] = $listing_images.'floor';
        $config['remove_spaces']=TRUE;
        $config['encrypt_name'] = TRUE; // for encrypting the name
        $config['allowed_types'] = 'gif|jpg|png';
        //  $config['max_size'] = '78000';
        $config['overwrite'] = FALSE;
        return $config;
    }

    function do_upload()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|zip|rar|pdf';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['quality'] = 70;

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('upload_form', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $this->load->view('upload_success', $data);
        }
    }

    function create_new_listing()
    {
        if ($this->session->userdata('logged_in'))
        {
            $session_data_user = $this->session->userdata('logged_in');
            $session_data_listing = $this->session->userdata('listing');
            $uid = $session_data_user['id'];
            $listing_id = $session_data_listing['id'];
            $edit_status = $session_data_listing['edit_status'];
            // create the data object
            $data = new stdClass();
            $address_line_1 = $this->input->post('route');
            $address_line_2 = $this->input->post('street_address');
            $city_town = $this->input->post('locality');
            $state_province = $this->input->post('administrative_area_level_1');
            $zip_postal_code = $this->input->post('postal_code');
            $country = $this->input->post('country');
            if ($address_line_2)
            {
                $full_address = $address_line_1 . "," . $address_line_2 . "," . $city_town . "," . $state_province . "," . $zip_postal_code . "," . $country;
            }
            else
            {
                $full_address = $address_line_1 . "," . $city_town . "," . $state_province . "," . $zip_postal_code . "," . $country;
            }
            $form_data = array(
                'user_id' => $uid,
                'listing_name' => $this->input->post('listing_name'),
                'summary' => $this->input->post('summary'),
                'home_type' => $this->input->post('home_type'),
                'room_type' => $this->input->post('room_type'),
                'accommodates' => $this->input->post('accommodates'),
                'bedrooms' => $this->input->post('bedrooms'),
                'beds' => $this->input->post('beds'),
                'bathrooms' => $this->input->post('bathrooms'),
                'country' => $country,
                'typed_address' => $this->input->post('geocomplete'),
                'address_line_1' => $address_line_1,
                'address_line_2' => $address_line_2,
                'city_town' => $city_town,
                'state_province' => $state_province,
                'zip_postal_code' => $zip_postal_code,
                'full_address' => $full_address,
                'latitude' => $this->input->post('lat'),
                'longitude' => $this->input->post('lng'),
                'req_qualify' => $this->input->post('req_qua'),
            );
            //If users is in middle of add listing
            if ($edit_status)
            {
                $slug = url_title($this->input->post('listing_name'), 'dash', TRUE);
                $form_data['slug'] = $slug . "-" . $listing_id;
                $listing = $this->Listings_model->update_listing($form_data, $listing_id);
                if ($listing)
                {
                    echo $listing_id;
                }
                else
                {
                    echo false;
                }
            }
            else
            {
                $listing_id = $this->Listings_model->create_listing($form_data);
                if ($listing_id)
                {
                    $listing_array = array(
                        'id' => (int) $listing_id,
                        'edit_status' => (bool) true,
                    );
                    $this->session->set_userdata('listing', $listing_array);
                    //Update user type to host at adding first time listing
                    if ($this->Listings_model->UserExistingListingStatus($uid))
                    {
                        $this->load->model('Users_model');
                        $this->Users_model->edit_profile(array('user_type' => 'Host'), $uid);
                        $logged_in = $this->session->userdata('logged_in');
                        $logged_in['user_type'] = 'Host';
                        $this->session->set_userdata('logged_in', $logged_in);
                    }
                    $slug = url_title($this->input->post('listing_name'), 'dash', TRUE);
                    $form_data = array();
                    $form_data['slug'] = $slug . "-" . $listing_id;
                    if ($this->Listings_model->update_listing($form_data, $listing_id))
                    {
                        echo $listing_id;
                    }
                }
                else
                {
                    echo false;
                }
            }
        }
        else
        {
            echo false;
        }
    }

    function view_existing_listing_calendar()
    {
        if ($this->session->userdata('logged_in'))
        {
            $session_data_listing = $this->session->userdata('listing');
            $listing_id = $session_data_listing['id'];
            if ($listing_id)
            {
                $listing = $this->Listings_model->get_list($listing_id);
                $response = explode(date('Y-m-d'), $listing->availability_calendar);
                if (isset($response[1]))
                {
                    echo '{"' . date('Y-m-d') . $response[1];
                }
            }
        }
    }

    function AvalaibleBookCallenderDates()
    {
        if ($this->input->post('dopbcp_calendar_id'))
        {
            $listingid = $this->input->post('dopbcp_calendar_id');
            $listing = $this->Listings_model->get_list($listingid);
            $already_booked = $this->Listings_model->already_booked($listingid); //Remove booked or issue dates
            $ac_data = json_decode($listing->availability_calendar);
            if ($ac_data)
            {
                if ($already_booked)
                {
                    foreach ($already_booked as $already_book)
                    {
                        $already_dates = dateRange($already_book->check_in, $already_book->check_out);
                        foreach ($ac_data as $key => $value)
                        {
                            if ((in_array($key, $already_dates)))
                            {
                                $ac_data->$key->status = 'booked';
                            }
                        }
                    }
                    return json_encode($ac_data);
                }
                else
                {
                    return json_encode($ac_data);
                }
            }
        }
    }

    function detail_existing_listing_calendar()
    {
        echo $this->AvalaibleBookCallenderDates();
    }

    function AlreadyBookedDays()
    {
        $bookavaibles = json_decode($this->AvalaibleBookCallenderDates());
        $results = null;
        if ($bookavaibles)
        {
            foreach ($bookavaibles as $key => $value)
            {
                if ($value->status == 'booked')
                {
                    $DatesArray[] = $key;
                }
            }
            $results = implode(",", $DatesArray);
        }
        echo "[" . $results . "]";
    }

    function add_listing_calendar()
    {
        if ($this->session->userdata('logged_in'))
        {
            $session_data_listing = $this->session->userdata('listing');
            $availability_calendar = $this->input->post('dopbcp_schedule');
            $response = explode(date('Y-m-d'), $availability_calendar);
            if (isset($response[1]))
            {
                $availability_calendar = '{"' . date('Y-m-d') . $response[1];
            }
            $acdata = json_decode($availability_calendar);
            $dates = array();
            $price = array();
            foreach ($acdata as $key => $value)
            {
                if ($value->status == 'available')
                {
                    $dates[] = $key;
                    $price[] = $value->price;
                }
            }
            sort($price);
            sort($dates);
            $form_data = array(
                'available_from' => date('Y-m-d', strtotime(reset($dates))),
                'available_to' => date('Y-m-d', strtotime(end($dates))),
                'availability_calendar' => $availability_calendar,
                'date_edited' => date('Y-m-d H:i:s'),
                'price' => reset($price)
            );
            echo $this->Listings_model->update_listing($form_data, $session_data_listing['id']);
        }
    }

    function view_existing_listing_images() {
        $this->load->helper('form');
        $listing_images = $this->config->item('listing_images');
        $session_data_listing = $this->session->userdata('listing');
        $listing_id = $session_data_listing['id'];
        if ($listing_id) {
            $list_images = $this->Listings_model->get_list_images($listing_id);
            if ($list_images) {
                $files = array();
                foreach ($list_images as $list_image) {
                    //set the data for the json array
                    $info = new stdClass();
                    $file_name = $list_image->picture;
                    $info->name = $file_name;
                    $info->size = 6 * 1024;
                    $info->type = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), file_get_contents(base_url() . $listing_images . 'listing_thumbs/' . $file_name));
                    $info->url = base_url() . $listing_images . $file_name;
                    $info->thumbnailUrl = base_url() . $listing_images . 'listing_thumbs/' . $file_name;
                    $info->deleteUrl = site_url('listings/deleteimage/' . $file_name);
                    $info->deleteType = 'DELETE';
                    $files[] = $info;
                }
                echo json_encode(array("files" => $files));
            }
        }
    }

     function images_upload_status() {
        if ($this->session->userdata('logged_in')) {
            $session_data_listing = $this->session->userdata('listing');
            $listing_id = $session_data_listing['id'];
            $preview = $this->Listings_model->preview_image_status($listing_id);
            $other = $this->Listings_model->other_iamges_status($listing_id);
            if ($preview && $other) {
                echo true;
            } else {
                echo false;
            }
        } else {
            echo false;
        }
    }

    function update_new_listing() {
        if ($this->session->userdata('logged_in')) {
            $session_data_listing = $this->session->userdata('listing');
            $listing_id = $session_data_listing['id'];
            if ($this->input->post('availability_through') == 'Manual') {
                $listing_price = $this->input->post('listing_price');
                $availability_month = "+" . $this->input->post('availability_month') . " month";
                $date_ranges = dateRange(date('Y-m-d'), date('Y-m-d', strtotime($availability_month)));
                foreach ($date_ranges as $date_range) {
                    $callender_array[] = '"' . $date_range . '":{"bind":0,"price":' . $listing_price . ',"promo":0,"status":"available"}';
                }
                $callender_string = "{" . implode(",", $callender_array) . "}";
                $acdata = json_decode($callender_string);
                $dates = array();
                $price = array();
                foreach ($acdata as $key => $value) {
                    if ($value->status == 'available') {
                        $dates[] = $key;
                        $price[] = $value->price;
                    }
                }
                sort($price);
                sort($dates);
                $form_data = array(
                    'additional_note' => $this->input->post('additional_note'),
                    'availability_calendar' => $callender_string,
                    'available_from' => date('Y-m-d', strtotime(reset($dates))),
                    'available_to' => date('Y-m-d', strtotime(end($dates))),
                    'date_edited' => date('Y-m-d H:i:s'),
                    'price' => reset($price)
                );
            } else {
                $form_data = array(
                    'additional_note' => $this->input->post('additional_note')
                );
            }
            $amenities = $this->input->post('amenities');
            foreach ($amenities as $amenitie) {
                $data = array('amenities_id' => $amenitie, 'listing_id' => $listing_id);
                $this->Listings_model->add_amenities($data);
            }
            $listing = $this->Listings_model->update_listing($form_data, $listing_id);
            if ($listing) {
                echo true;
            } else {
                echo false;
            }
        }
    }

    function finish_new_listing() {
        if ($this->session->userdata('logged_in')) {
            $session_data_listing = $this->session->userdata('listing');
            $session_data = $this->session->userdata('logged_in');
            $list = $this->Listings_model->get_list($session_data_listing['id']);
            $to = $session_data['email'];
            $subject = 'Listing Status';
            $user_data = array();
            $user_data['first_name'] = ucfirst($session_data['first_name']);
            $user_data['update_date'] = date('M d, Y');
            $user_data['update_time'] = date('h:i a');
            $user_data['listing_name'] = $list->listing_name;
            $view = 'listing_success';
            sendEmail($to, $subject, $user_data, $view);
            //Sendding Tip email for first time
            if ($this->Listings_model->UserExistingListingStatus($session_data['id'])) {
                $subject = 'Tips for new hosts';
                $view = 'tips';
                sendEmail($to, $subject, $user_data, $view);
            }
            if ($list->active == 'Review') {
                $status = 'Review';
            } else {
                $status = $this->input->post('active');
            }
            $form_data = array(
                'active' => $status
            );
            if ($this->Listings_model->update_listing($form_data, $session_data_listing['id'])) {
                $this->session->unset_userdata('listing');
                echo true;
            } else {
                echo false;
            }
        }
    }

    function listing_images_upload() {

        $this->load->helper('form');
        $listing_images = $this->config->item('listing_images');
        $property_images = $this->config->item('property_images');
        $info = new stdClass();
        if (isset($_FILES['userfile']) && $_FILES['userfile']['size'] > 0) {
            $config['upload_path'] = $listing_images;
            $config['allowed_types'] = 'jpeg|jpg|png';
            //$config['encrypt_name'] = true;
            $config['max_size'] = 2048;
            $config['min_width'] = 720;
            $config['min_height'] = 480;
            $config['max_width'] = 2048;
            $config['max_height'] =2000;
            $type = $this->session->userdata('property_type');
            $new_name = 'zoney.pk_for_'.$type.'_'.$_FILES["userfile"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload()) {

                $data = $this->upload->data();
                $session_data_listing = $this->session->userdata('listing');
                $listing_id = $session_data_listing['id'];
                $form_data = array('listing_id' => $listing_id, 'picture' => $data['file_name']);
                if ($this->Listings_model->add_listing_pictures($form_data)) {
                    $this->manipulate_img->watermark($data['full_path']);
                    $this->manipulate_img->resize($data['full_path'],$property_images.'gallery',780,400);
                    //set the data for the json array
                    $info->name = $data['file_name'];
                    $info->size = $data['file_size'] * 1024;
                    $info->type = $data['file_type'];
                    $info->url = base_url() . $listing_images . $data['file_name'];
                    $info->thumbnailUrl = base_url() . $property_images . 'gallery/' . $data['file_name'];
                    $info->deleteUrl = site_url('listings/deleteimage/' . $data['file_name']);
                    $info->deleteType = 'DELETE';
                    $files[] = $info;
                    echo json_encode(array("msg" => 'success',"files" => $files));
                }

            }else
            {
                echo  json_encode(array("msg" => 'error','error'=> $this->upload->display_errors()) );
            }

        }else{
            echo  json_encode(array("msg" => 'error','error'=> 'Something went wrong,please try again later!' ));
        }
    }


    function deleteimage()
    {
        $file = $this->input->post('name');
        $type = $this->session->userdata('property_type');
        $file = 'zoney.pk_for_'.$type.'_'.$file;

        //gets the job done but you might want to add error checking and security
        if( $this->Listings_model->delete_listing_pictures($file) )
        {
            $success = @unlink(FCPATH . 'assets/media/properties/thumbs/' . $file);
            $success = @unlink(FCPATH . 'assets/media/properties/gallery/'. $file);
            $success = @unlink(FCPATH . 'assets/media/listings/' . $file);
            //info to see if it is doing what it is supposed to
            $info = new StdClass;
            $info->sucess = $success;
            $info->path = base_url() . 'assets/media/listings/' . $file;
            $info->file = is_file(FCPATH . 'assets/media/listings/' . $file);
            //I don't think it matters if this is set but good for error checking in the console/firebug
            echo json_encode(array($info));
        }
    }

    function AddReviews() {
        if ($this->session->userdata('logged_in')) {
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            $reviews = $this->input->post('reviews');
            $reviews['reviews_by'] = $uid;
            if ($this->Listings_model->AddListingReviews($reviews)) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    function requirements() {
        if ($this->session->userdata('logged_in')) {
            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));
            // create the data object
            $data = new stdClass();
            //$data->extra_js = 'Inbox.init();';
            $this->load->view('templates/header');
            $this->load->view('listings/reservation_requirements', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function remove_listing()
    {
        $session_data_user = $this->session->userdata('logged_in');
        $uid = $session_data_user['id'];
        $data = new stdClass();
        $listing_id  = $this->input->post('listing_id');


        //check if user is owner of this listing
        $owner = $this->Listings_model->is_listing_owner($listing_id,$uid);


        if($owner[0]->property_type == 'rent'){
            $this->db->where('user_id',$uid);
            $q = $this->db->get('user_stats');

            if ( $q->num_rows() > 0 ) {
                $this->db->where('user_id',$uid);
                $this->db->set('rental', 'rental-1', FALSE);
                $this->db->update('user_stats');
            }
        }

        if($owner[0]->property_type == 'sale'){
            $this->db->where('user_id',$uid);
            $q = $this->db->get('user_stats');

            if ( $q->num_rows() > 0 ) {
                $this->db->where('user_id',$uid);
                $this->db->set('sales', 'sales-1', FALSE);
                $this->db->update('user_stats');
            }
        }

        if($owner[0]->active == 'sold'){
            $this->db->where('user_id',$uid);
            $q = $this->db->get('user_stats');
            if ( $q->num_rows() > 0 ) {
                $this->db->where('user_id',$uid);
                $this->db->set('sold', 'sold-1', FALSE);
                $this->db->update('user_stats');
            }
        }

        if(count($owner)){
            // good to go
            $is_removed =  $this->common->delete_data('listing','id',$listing_id);

            if($is_removed == true){


                echo 'success';

            }

        }else{
            // unauthorized to do this action
            echo 'unauthorized';
        }

    }

    function delete_listing_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        if($this->Listings_model->updatelistingStatus($id,$status)){
            echo '1';
        }
        else{
            echo '0';
        }
    }

    function sold_listing_status()
    {

        if ($this->session->userdata('logged_in')) {
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];

            $id = $this->input->post('id');
            if ($this->Listings_model->SoldlistingStatus($id)) {

                $this->db->where('user_id', $uid);
                $q = $this->db->get('user_stats');

                if ($q->num_rows() > 0) {
                    $this->db->where('user_id', $uid);
                    $this->db->set('sold', 'sold+1', FALSE);
                    $this->db->update('user_stats');
                }


                echo '1';
            } else {
                echo '0';
            }
        }

    }

    function listing_images()
    {
        $id =  $this->input->get_post('gallery');

        $gallery = $this->Listings_model->listing_gallery_by_id($id);

        if(!empty($gallery)){

            foreach($gallery as $img){

                echo '<a class="fancybox_gallery" rel="gallery1" href="'.base_url().'assets/media/properties/thumbs/'.$img->picture.'"><img src="'.base_url().'assets/media/properties/thumbs/'.$img->picture.'"  /></a>';

            }
        }


    }

    function publish_listing_notice(){
        $listing_id  = $this->input->post('id');
        $action = $this->input->post('action');
       // echo 'success and Action >> '.$action.">> Listing  ID : ".$listing_id;
       if ($action == 'Publish'){
           $listing = $this->Listings_model->listing_with_user($listing_id);
           $user_data = array();
           $user_data['listing_name'] = $listing->listing_name;
           $user_data['name'] = $listing->first_name. ' ' .$listing->last_name;
           $user_data['url'] = site_url('property/'.$listing->slug.'-'. $listing->id);
           $subject = 'Listing published successfully';
           $view = 'listing_published';
           $to = $listing->email;
           sendEmail($to, $subject, $user_data, $view);
           echo 'successfully published';
       }
       else if($action == 'block') {

           $listing = $this->Listings_model->listing_with_user($listing_id);
           $user_data = array();
           $user_data['listing_name'] = $listing->listing_name;
           $user_data['name'] = $listing->first_name . ' ' . $listing->last_name;
           $user_data['url'] = site_url('property/' . $listing->slug . '-' . $listing->id);
           $subject = 'Listing block successfully';
           $view = 'listing_published';
           $to = $listing->email;
           sendEmail($to, $subject, $user_data, $view);

           echo 'successfully blocked';

       }

    }


    function premiumListingRequest()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data = new stdClass();
        $data->title = 'Premium listing request';


        if ($this->session->userdata('logged_in')) {
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];

            if ($this->input->is_ajax_request()) {


                $this->form_validation->set_rules('listing_id', 'Listing ID', 'trim|required');
                $this->form_validation->set_rules('package', 'Package', 'trim|required');
                $this->form_validation->set_rules('message', 'Message', 'trim|required');

                if ($this->form_validation->run() == false) {

                    $response = array('status' => '400', 'message' => validation_errors(), 'response' => 'error');
                    echo json_encode($response);

                } else {

                    $data = array(

                        'listing_id' => $this->input->get_post('listing_id', false),
                        'package_id' => $this->input->get_post('package', false),
                        'message' => $this->input->get_post('message', false),
                        'user_id'=> $uid
                    );

                    $result = $this->db->insert('premium_requests', $data);

                    if ($result) {
                        $response = array('status' => '200', 'message' => 'success', 'response' => 'success');
                        echo json_encode($response);
                    }
                }
            }
        }

    }

}
