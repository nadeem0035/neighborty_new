<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Listings extends CI_Controller {

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct() {

        parent::__construct();
        $this->load->model('Listings_model');
    }

    function index() {

        if ($this->session->userdata('logged_in')) {
            $this->load->helper('text');
            //Add Js/Css
            add_css(array('light.css', 'search.css'));
            add_js(array('jquery.slimscroll.min.js','listing.js'));

            // create the data object
            $data = array();
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];

            $data['publish_listings'] = $this->Listings_model->get_user_listing($uid,'Publish');
            $data['pending_listings'] = $this->Listings_model->get_user_listing($uid,'Pending');
            $data['review_listings'] = $this->Listings_model->get_user_listing($uid,'Review');

            //Title and meta description
            $this->seo->SetValues('Title', 'My  Listings - luxus');
            $this->seo->SetValues('Description', "Rent out your room, house or apartment on luxus. Join thousands already renting out their space to people all over the world. Listing your space is free!");

            $this->load->view('templates/header');
            $this->load->view('listings/listings', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function your_reservations() {

        if ($this->session->userdata('logged_in')) {

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

    function add_listing() {

        $session_data_listing = $this->session->userdata('listing');
        $listing_id = $session_data_listing['id'];

        if (isset($listing_id)) { //If user in edit listing mode 
            redirect("/listings/edit/$listing_id");
        }

        if ($this->session->userdata('logged_in')) {

            $this->load->helper('form');
            //Add Js/Css
            add_css(array('light.css',
                'blueimp-gallery.min.css',
                'jquery.fileupload.css',
                'jquery.fileupload-ui.css',
                'jquery.dop.Select.css',
                'jquery.dop.FrontendBookingCalendarPRO.css',
                'jquery.dop.BackendBookingCalendarPRO.css'));

            add_js(array('jquery.slimscroll.min.js',
                'additional-methods.min.js',
                'form-wizard.js',
                'jquery.bootstrap.wizard.min.js',
                'jquery.geocomplete.js',
                'google-map.js',
                'jquery.fancybox.pack.js',
                'jquery.ui.widget.js',
                'tmpl.min.js',
                'load-image.min.js',
                'canvas-to-blob.min.js',
                'jquery.blueimp-gallery.min.js',
                'jquery.iframe-transport.js',
                'jquery.fileupload.js',
                'jquery.fileupload-process.js',
                'jquery.fileupload-image.js',
                'jquery.fileupload-validate.js',
                'jquery.fileupload-ui.js',
                'form-fileupload.js',
                'jquery.dop.Select.js',
                'dop-prototypes.js',
                'jquery.dop.BackendBookingCalendarPRO.js',
                'dashboard.js'));
            $string = 'FormWizard.init();FormFileUpload.init();';
            set_extra_js($string);

            // create the data object
            $data = new stdClass();
            //$data->extra_js = 'Inbox.init();';
            $data->home_types = $this->Listings_model->home_types();
            $data->room_types = $this->Listings_model->room_types();
            $data->amenities = $this->Listings_model->amenities();

            $data->title = 'Add New Listing';
            $data->listing = array();

            //Title and meta description
            $this->seo->SetValues('Title', 'Rent Out Your Room, House or Apartment on luxus');
            $this->seo->SetValues('Description', "Rent out your room, house or apartment on luxus. Join thousands already renting out their space to people all over the world. Listing your space is free!");

            $this->load->view('templates/header');
            $this->load->view('listings/add_listing', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/login');
        }
    }

    function edit($lid = NULL) {

        if ($this->session->userdata('logged_in')) {

            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];

            if (is_numeric($lid) && $this->Listings_model->validate_user_listing($uid, $lid)) {

                $listing_array = array(
                    'id' => (int) $lid,
                    'edit_status' => (bool) true,
                );

                $this->session->set_userdata('listing', $listing_array);



                $this->load->helper('form');
                //Add Js/Css
                add_css(array('light.css',
                    'blueimp-gallery.min.css',
                    'jquery.fileupload.css',
                    'jquery.fileupload-ui.css',
                    'jquery.dop.Select.css',
                    'jquery.dop.FrontendBookingCalendarPRO.css',
                    'jquery.dop.BackendBookingCalendarPRO.css'));

                add_js(array('jquery.slimscroll.min.js',
                    'additional-methods.min.js',
                    'edit-form-wizard.js',
                    'jquery.bootstrap.wizard.min.js',
                    'jquery.geocomplete2.js',
                    'google-map.js',
                    'jquery.fancybox.pack.js',
                    'jquery.ui.widget.js',
                    'tmpl.min.js',
                    'load-image.min.js',
                    'canvas-to-blob.min.js',
                    'jquery.blueimp-gallery.min.js',
                    'jquery.iframe-transport.js',
                    'jquery.fileupload.js',
                    'jquery.fileupload-process.js',
                    'jquery.fileupload-image.js',
                    'jquery.fileupload-validate.js',
                    'jquery.fileupload-ui.js',
                    'form-fileupload.js',
                    'jquery.dop.Select.js',
                    'dop-prototypes.js',
                    'jquery.dop.BackendBookingCalendarPRO.js',
                    'dashboard.js'));
                remove_js('bootstrap-datepicker.js');
                $string = 'FormWizard.init();FormFileUpload.init();';
                set_extra_js($string);

                // create the data object
                $data = new stdClass();
                //$data->extra_js = 'Inbox.init();';
                $data->home_types = $this->Listings_model->home_types();
                $data->room_types = $this->Listings_model->room_types();
                $data->amenities = $this->Listings_model->amenities();

                $data->title = 'Edit Listing';
                $data->listing = $this->Listings_model->get_list($lid);
                $data->old_amenities = $this->Listings_model->get_list_amenities($lid);

                //Title and meta description
                $this->seo->SetValues('Title', 'Rent Out Your Room, House or Apartment on luxus');
                $this->seo->SetValues('Description', "Rent out your room, house or apartment on luxus. Join thousands already renting out their space to people all over the world. Listing your space is free!");



                $this->load->view('templates/header');
                $this->load->view('listings/add_listing', $data);
                $this->load->view('templates/footer');
            } else {
                redirect('/');
            }
        } else {
            redirect('/');
        }
    }

    function create_new_listing() {

        if ($this->session->userdata('logged_in')) {

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

            if ($address_line_2) {
                $full_address = $address_line_1 . "," . $address_line_2 . "," . $city_town . "," . $state_province . "," . $zip_postal_code . "," . $country;
            } else {
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
            );

            if ($edit_status) { //If users is in middle of add listing
                $slug = url_title($this->input->post('listing_name'), 'dash', TRUE);
                $form_data['slug'] = $slug . "-" . $listing_id;
                $listing = $this->Listings_model->update_listing($form_data, $listing_id);
                if ($listing) {
                    echo $listing_id;
                } else {
                    echo false;
                }
            } else {

                $listing_id = $this->Listings_model->create_listing($form_data);

                if ($listing_id) {
                    $listing_array = array(
                        'id' => (int) $listing_id,
                        'edit_status' => (bool) true,
                    );
                    $this->session->set_userdata('listing', $listing_array);


                    //Update user type to host at adding first time listing
                    if ($this->Listings_model->UserExistingListingStatus($uid)) {
                        $this->load->model('Users_model');
                        $this->Users_model->edit_profile(array('user_type' => 'Host'), $uid);
                        $logged_in = $this->session->userdata('logged_in');
                        $logged_in['user_type'] = 'Host';
                        $this->session->set_userdata('logged_in', $logged_in);
                    }

                    $slug = url_title($this->input->post('listing_name'), 'dash', TRUE);
                    $form_data = array();
                    $form_data['slug'] = $slug . "-" . $listing_id;

                    if ($this->Listings_model->update_listing($form_data, $listing_id)) {
                        echo $listing_id;
                    }
                } else {
                    echo false;
                }
            }
        } else {
            echo false;
        }
    }

    function listing_images_upload() {

        $this->load->helper('form');

        $listing_images = $this->config->item('listing_images');
        $info = new stdClass();

        if (isset($_FILES['userfile']) && $_FILES['userfile']['size'] > 0) {

            $config['upload_path'] = $listing_images;
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['encrypt_name'] = true;
            $config['max_size'] = 0;
            $config['max_width'] = 0;
            $config['max_height'] = 0;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload()) {

                $this->load->library('image_lib');

                $data = $this->upload->data();

                $session_data_listing = $this->session->userdata('listing');
                $listing_id = $session_data_listing['id'];
                $form_data = array('listing_id' => $listing_id, 'picture' => $data['file_name']);
                if ($this->Listings_model->add_listing_pictures($form_data)) {

                    // to re-size for thumbnail images
                    $config = array(
                        'source_image' => $data['full_path'],
                        'new_image' => $listing_images . 'listing_thumbs',
                        'quality' => '100%',
                        'maintain_ratio' => false,
                        'width' => 112,
                        'height' => 75
                    );

                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();

                    // to re-size for thumbnail images
                    $config = array(
                        'source_image' => $data['full_path'],
                        'new_image' => $listing_images . 'listings',
                        'quality' => '100%',
                        'maintain_ratio' => false,
                        'width' => 720,
                        'height' => 480
                    );

                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();

                    //set the data for the json array   
                    $info->name = $data['file_name'];
                    $info->size = $data['file_size'] * 1024;
                    $info->type = $data['file_type'];
                    $info->url = base_url() . $listing_images . $data['file_name'];
                    $info->thumbnailUrl = base_url() . $listing_images . 'listing_thumbs/' . $data['file_name'];
                    $info->deleteUrl = site_url('listings/deleteimage/' . $data['file_name']);
                    $info->deleteType = 'DELETE';
                    $files[] = $info;
                    echo json_encode(array("files" => $files));
                }
            }
        }
    }

    function view_existing_listing_calendar() {
        if ($this->session->userdata('logged_in')) {
            $session_data_listing = $this->session->userdata('listing');
            $listing_id = $session_data_listing['id'];
            if ($listing_id) {
                $listing = $this->Listings_model->get_list($listing_id);
                $response = explode(date('Y-m-d'), $listing->availability_calendar);
                if (isset($response[1])) {
                    echo '{"' . date('Y-m-d') . $response[1];
                }
            }
        }
    }

    function AvalaibleBookCallenderDates() {
        if ($this->input->post('dopbcp_calendar_id')) {
            $listingid = $this->input->post('dopbcp_calendar_id');
            $listing = $this->Listings_model->get_list($listingid);
            $already_booked = $this->Listings_model->already_booked($listingid); //Remove booked or issue dates
            $ac_data = json_decode($listing->availability_calendar);
            if ($ac_data) {
                if ($already_booked) {
                    foreach ($already_booked as $already_book) {
                        $already_dates = dateRange($already_book->check_in, $already_book->check_out);
                        foreach ($ac_data as $key => $value) {
                            if ((in_array($key, $already_dates))) {
                                $ac_data->$key->status = 'booked';
                            }
                        }
                    }
                    return json_encode($ac_data);
                } else {
                    return json_encode($ac_data);
                }
            }
        }
    }

    function detail_existing_listing_calendar() {

        echo $this->AvalaibleBookCallenderDates();
    }

    function AlreadyBookedDays() {
        $bookavaibles = json_decode($this->AvalaibleBookCallenderDates());
        $results = null;
        if ($bookavaibles) {
            foreach ($bookavaibles as $key => $value) {
                if ($value->status == 'booked') {
                    $DatesArray[] = $key;
                }
            }
            $results = implode(",", $DatesArray);
        }

        echo "[" . $results . "]";
    }

    function add_listing_calendar() {
        if ($this->session->userdata('logged_in')) {
            $session_data_listing = $this->session->userdata('listing');
            $availability_calendar = $this->input->post('dopbcp_schedule');
            $response = explode(date('Y-m-d'), $availability_calendar);
            if (isset($response[1])) {
                $availability_calendar = '{"' . date('Y-m-d') . $response[1];
            }
            $acdata = json_decode($availability_calendar);
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

    function listing_preview_image_upload() {

        $this->load->helper('form');
        $listing_images = $this->config->item('listing_images');

        if (isset($_FILES['listingfile']) && $_FILES['listingfile']['size'] > 0) {

            $config['upload_path'] = $listing_images;
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['encrypt_name'] = true;
            $config['max_size'] = 0;
            $config['max_width'] = 0;
            $config['max_height'] = 0;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('listingfile')) {

                $this->load->library('image_lib');

                $data = $this->upload->data();

                $session_data_listing = $this->session->userdata('listing');
                $listing_id = $session_data_listing['id'];
                $form_data = array();
                $form_data['preview_image_url'] = $data['file_name'];

                if ($this->Listings_model->update_listing($form_data, $listing_id)) {
                    // to re-size for thumbnail images
                    $config = array(
                        'source_image' => $data['full_path'],
                        'new_image' => $listing_images . 'listing_thumbs',
                        'quality' => '100%',
                        'maintain_ratio' => false,
                        'width' => 112,
                        'height' => 75
                    );

                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();

                    // to re-size for thumbnail images
                    $config = array(
                        'source_image' => $data['full_path'],
                        'new_image' => $listing_images . 'listings',
                        'quality' => '100%',
                        'maintain_ratio' => false,
                        'width' => 720,
                        'height' => 480
                    );

                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();

                    // to re-size for thumbnail images
                    $config = array(
                        'source_image' => $data['full_path'],
                        'new_image' => $listing_images . 'search_thumbs',
                        'quality' => '100%',
                        'maintain_ratio' => false,
                        'width' => 225,
                        'height' => 150
                    );

                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    echo true;
                } else {
                    echo false;
                }
            } else {
                echo false;
            }
        } else {
           echo false; 
        }
    }

    function deleteimage($file) {//gets the job done but you might want to add error checking and security
        if ($this->Listings_model->delete_listing_pictures($file)) {


            $success = @unlink(FCPATH . 'assets/media/listings/listings/' . $file);
            $success = @unlink(FCPATH . 'assets/media/listings/listing_thumbs/' . $file);
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

    function my_trips($bid = NULL) {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('jquery.raty.css', 'light.css', 'fullcalendar.min.css'));
            add_js(array('jquery.slimscroll.min.js', 'fullcalendar.min.js', 'moment.min.js', 'calendar.js', 'jquery.raty.js', 'dashboard.js'));
            set_extra_js("$('#Accuracy').raty({ scoreName: 'reviews[Accuracy]' });$('#Communication').raty({ scoreName: 'reviews[Communication]' });$('#Cleanliness').raty({ scoreName: 'reviews[Cleanliness]' });");
            set_extra_js("Calendar.init('my_trips');$('#Location').raty({ scoreName: 'reviews[Location]' });$('#check_in').raty({ scoreName: 'reviews[check_in]' });$('#Value').raty({ scoreName: 'reviews[Value]' });");

            // create the data object
            $data = new stdClass();
            $session_data_user = $this->session->userdata('logged_in');

            if ($bid) {
                $data->detailview = true;
                $data->MyTrip = $this->Listings_model->MyTrip($session_data_user['id'], $bid);
            } else {
                $data->detailview = false;
                $data->MyTrips = $this->Listings_model->MyTrips($session_data_user['id']);
            }

            //Title and meta description
            $this->seo->SetValues('Title', 'My Trips - luxus');
            $this->seo->SetValues('Description', "Reservations your room, house or apartment on luxus. Visit thousands places over the world. Book your space now!");

            $this->load->view('templates/header');
            $this->load->view('listings/my_trips', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function my_reservations($bid = NULL) {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('jquery.raty.css', 'light.css', 'fullcalendar.min.css'));
            add_js(array('jquery.slimscroll.min.js', 'fullcalendar.min.js', 'moment.min.js', 'calendar.js', 'jquery.raty.js', 'dashboard.js'));
            set_extra_js("$('#Accuracy').raty({ scoreName: 'reviews[Accuracy]' });$('#Communication').raty({ scoreName: 'reviews[Communication]' });$('#Cleanliness').raty({ scoreName: 'reviews[Cleanliness]' });");
            set_extra_js("Calendar.init('my_reservations');$('#Location').raty({ scoreName: 'reviews[Location]' });$('#check_in').raty({ scoreName: 'reviews[check_in]' });$('#Value').raty({ scoreName: 'reviews[Value]' });");

            // create the data object
            $data = new stdClass();
            $session_data_user = $this->session->userdata('logged_in');

            if ($bid) {
                $data->detailview = true;
                $data->MyReservation = $this->Listings_model->MyReservation($session_data_user['id'], $bid);
            } else {
                $data->detailview = false;
                $data->MyReservations = $this->Listings_model->MyReservations($session_data_user['id']);
            }

            //Title and meta description
            $this->seo->SetValues('Title', 'My Reservations - luxus');
            $this->seo->SetValues('Description', "Reservations your room, house or apartment on luxus. Visit thousands places over the world. Book your space now!");

            $this->load->view('templates/header');
            $this->load->view('listings/my_reservations', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function reservations_calendar_data() {

        if ($this->session->userdata('logged_in')) {

            $data = new stdClass();
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            $data->listings = $this->Listings_model->GetreservationsBooking($uid);
            // echo $this->db->last_query();
            $this->load->view('listings/reservations_calendar_data', $data);
        } else {
            redirect('/');
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

    function trips_calendar_data() {

        if ($this->session->userdata('logged_in')) {

            $data = new stdClass();
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            $data->listings = $this->Listings_model->GetTripsBooking($uid);
            $this->load->view('listings/trips_calendar_data', $data);
        } else {
            redirect('/');
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

    function check_listing_booking_status(){

        $session_data_user = $this->session->userdata('logged_in');
        $uid = $session_data_user['id'];

        $data = new stdClass();
        $listing_id  = $this->input->post('listing_id');
        $data =  $this->Listings_model->checkListingBookingStatus($listing_id,$uid);

        if($data == 'success'){
            echo json_encode(array("success" => "success"));

        }else{

            $checkout_date = strtotime($data->check_out);
            $current_date = strtotime(date('Y-m-d'));

            if($checkout_date > $current_date){

               echo json_encode(array("res" => "failure", "checkout" => $data->check_out));

            }else{

                $this->Listings_model->setListingFlag($listing_id);
                echo json_encode(array("success" => "success"));

            }

        }

        


    }

}
