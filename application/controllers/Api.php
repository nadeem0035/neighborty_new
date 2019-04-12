 <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class Api extends CI_Controller {


    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model('Api_model', 'api', true);
        $this->load->model('Agents_model', 'agents', true);
        $this->load->model('Users_model', 'user', true);
        $this->load->model('Listings_model', 'listing', true);
        $this->load->model('Common_model', 'common', true);
        $this->load->library('facebook/Facebook');
        $this->load->library('googleplus/Googleplus');
        $this->load->library('linkedin/LinkedIn');
        $this->load->model('Wishlists_model', 'wishlist', true);
        $this->load->model('Inbox_model', 'inbox', true);
        $this->load->library('form_validation');

    }

    public function signup_user() {
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', array('is_unique' => 'This Email already exists. Please login.'));
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('phone_num', 'Phone NUmber', 'trim|required');
        $this->form_validation->set_rules('user_type', 'User Type', 'trim|required');

        if ($this->form_validation->run() === false) {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Validation errors';
             $data['result'] = validation_errors();
            echo json_encode($data);
            return;

        } else {
            $password = $this->input->post('password');
        $user = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'password' => MD5($password),
                'phone' => $this->input->post('phone_num'),
                'user_type' => $this->input->post('user_type'),
                'active' => 0,
                'hash' =>  mt_rand(1000,9999),
            );

            $result = $this->db->insert('users', $user);
                    $user_id = $this->db->insert_id();
            $response = $this->api->get_user($user_id);
            if ($response) {
               $data['Status'] = 'Success';
                $data['Massage'] = 'User signup Successfully';
                $data['result'] = $response;
                echo json_encode($data);

               $url = site_url("users/verify/" . $user['hash']);
                $user_data['hash'] = $user['hash'];
                $to = $user['email'];
                $subject = 'Please confirm your e-mail address';
                $user_data['receiver_name'] = ucfirst($user['first_name']) . ' ' . $user['last_name'];
                $user_data['url'] = $url;
                $view = 'app-user-confirmation';
                sendEmail($to, $subject, $user_data, $view);
                return;

            } else {
                 $data['Status'] = 'Error';
                $data['Massage'] = 'Some thing Worng';
                echo json_encode($data);
                return;

            }
        }
    }

    public function login_user() {

        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Validation errors';
            $data['result'] = validation_errors();
            echo json_encode($data);
            return;

        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->api->login($email, $password);
            if ($user) {
                $data['Status'] = 'Success';
                $data['Massage'] = 'Log in successfully';
                $data['result'] = $user;
                echo json_encode($data);
                return;

            } else {
                $data['Status'] = 'Error';
                $data['Massage'] = 'Login faild';
                echo json_encode($data);
                return;

            }
        }
    }

    function confirmByCode() {

        $this->form_validation->set_rules('code', 'Code', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Validation errors';
            $data['result'] = validation_errors();
            echo json_encode($data);
            return;


        }else{

            $code = $this->input->post('code');
            $result = $this->api->verifyEmailAddress($code);

            if($result){
                $data['Status'] = 'Success';
                $data['Massage'] = 'Account Verified Successfully.Please login ';
                $data['result'] = $result;
                echo json_encode($data);

                $to = $result->email;
                $subject = 'Welcome to Zoney';
                $user_data = array();
                $user_data['receiver_name'] = $result->first_name;
                $view = 'app-welcome';
                sendEmail($to, $subject, $user_data, $view);

                return;

            }else{
                $data['Status'] = 'Error';
                $data['Massage'] = 'Sorry Unable to Verify Your Account!';
                echo json_encode($data);
                return;
            }

        }
    }

    public function forget() {

        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Validation errors';
            $data['result'] = validation_errors();
            echo json_encode($data);
            return;

        } else {
            $email = $this->input->post('email');
            $user_id = $this->api->forgetpassword($email);
            if ($user_id) {
                $hash = mt_rand(1000,9999);
                $update = $this->api->update_user_hash($user_id, $hash);
                if ($update) {
                    $user_data = array();
                    $user_data['first_name'] = ucfirst($this->api->get_user($user_id)->first_name);
                    $user_data['url'] = $hash;
                    $to = $email;
                    $subject = 'Password Reset';
                    $view = 'app-forgot';
                    sendEmail($to, $subject, $user_data, $view);

                    $data['Status'] = 'Success';
                    $data['Massage'] = 'Kindly check your email to reset password';
                    echo json_encode($data);
                    return;

                } else {
                    $data['Status'] = 'Error';
                    $data['Massage'] = 'Some thing Wrong.';
                    echo json_encode($data);
                    return;
                }
            } else {
                $data['Status'] = 'Error';
                $data['Massage'] = 'Wrong e-mail address, Please use correct email.';
                echo json_encode($data);
                return;
            }
        }
    }

    function forgetConfirmByCode() {

        $this->form_validation->set_rules('hash', 'Code', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Validation errors';
            $data['result'] = validation_errors();
            echo json_encode($data);
            return;


        }else{
            $code = $this->input->post('hash');
            $result = $this->api->verifyEmailAddress($code);

            if($result){
                $data['Status'] = 'Success';
                $data['Massage'] = 'Account Verified Successfully.Please reset your password ';
                $data['result'] = $result;
                echo json_encode($data);
                return;

            }else{
                $data['Status'] = 'Error';
                $data['Massage'] = 'Sorry Unable to Verify Your Account!';
                echo json_encode($data);
                return;
            }

        }
    }

    function update_password() {
        $this->form_validation->set_rules('user_id', 'User ', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('rpassword', 'Confirm Password', 'trim|required|min_length[8]|matches[password]');

        if ($this->form_validation->run() == false) {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Validation errors';
            $data['result'] = validation_errors();
            echo json_encode($data);
            return;

        } else {

            $password = $this->input->post('password');
            $user_id = $this->input->post('user_id');

            if ($user_id && $password) {

                $update = $this->api->update_password($user_id, md5($password));
                if ($update) {

                    $data['Status'] = 'Success';
                    $data['Massage'] = 'Password Update successfully';
                    $data['result'] = 'Password Update successfully. Please login';
                    echo json_encode($data);
                    return;

                } else {
                    $data['Status'] = 'Error';
                    $data['Massage'] = 'Some thing Wrong.';
                    $data['result'] = 'Some thing Wrong.';
                    echo json_encode($data);
                    return;
                }
            } else {
                $data['Status'] = 'Error';
                $data['Massage'] = 'Some thing Wrong.';
                $data['result'] = 'You are not Able to update password.';
                echo json_encode($data);
                return;

            }
        }
    }

    public function getallcities() {
        $data_city = $this->common->getAllContent("*", 'cities');
        $data['Status'] = 'Success';
        $data['Massage'] = 'All cities';
        $data['result'] = $data_city;
        echo json_encode($data);
        return;

    }

    function cityAreas(){
        $id = $this->input->get_post('id');
        $result =  $this->listing->getAllCityAreas($id);
        $data['Status'] = 'Success';
        $data['Massage'] = 'All cities';
        $data['result'] = $result;
        echo json_encode($data);
        return;

    }

    function get_areabyareaid(){

        $id = $this->input->get_post('id');
        $result =  $this->listing->city_areas($id);
        echo json_encode($result);


    }

    public function getUserDetail() {
        $this->form_validation->set_rules('user_id', 'User ', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Validation errors';
            $data['result'] = validation_errors();
            echo json_encode($data);
            return;
        } else {

            $user_id = $this->input->post('user_id');
            $user_detail = $this->api->get_user($user_id);
            if($user_detail){
                $data['Status'] = 'Success';
                $data['Massage'] = 'User detail';
                $data['result'] = $user_detail;
                echo json_encode($data);
                return;
            } else {
                $data['Status'] = 'Error';
                $data['Massage'] = 'Some thing Wrong.';
                $data['result'] = 'You are not Able to get user detail.';
                echo json_encode($data);
                return;
            }


        }

    }

    public function getAgentDetail() {

        $this->form_validation->set_rules('user_id', 'User ', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Validation errors';
            $data['result'] = validation_errors();
            echo json_encode($data);
            return;
        } else {

            $agent_id = $this->input->post('user_id');
            $agent_detail = $this->api->get_user($agent_id);
            $agent_listing_detail = $this->api->getAgentListings($agent_id)->result();
            $review =  $this->agents->get_agent_review($agent_id);
            $reviews_all = $this->agents->get_agent_reviews_all((int) $agent_id);
            $recommendations = $this->agents->getAgentRecommendations((int) $agent_id);
            if ($review) {
                $rating = round($review->rating, 2) * 20;
                $total = $review->total;
            } else {
                $rating = 0;
                $total = 0;
            }
            if($agent_detail){
                $data['Status'] = 'Success';
                $data['Massage'] = 'User detail';
                $data['agent_detail'] = $agent_detail;
                $data['rating'] = $rating;
                $data['total'] = $total;
                $data['agent_listings'] = $agent_listing_detail;
                $data['reviews'] = $reviews_all;
                $data['recommendations'] = $recommendations;
                echo json_encode($data);
                return;
            } else {
                $data['Status'] = 'Error';
                $data['Massage'] = 'Some thing Wrong.';
                $data['result'] = 'You are not Able to get user detail.';
                echo json_encode($data);
                return;
            }


        }

    }

    function edit_profile_image() {
        $this->form_validation->set_rules('user_id', 'User id', 'trim|required');
        $this->form_validation->set_rules('user_image', 'Image', 'required');

        if ($this->form_validation->run() == false) {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Validation errors';
            $data['result'] = validation_errors();
            echo json_encode($data);
            return;

        } else {

            $user_id = $this->input->post('user_id');
            $user_img = $this->input->post('user_image');

            $uploaded_file = base64_to_image($user_img);
            $filename = randomStrNum(6) . '.jpg';
            $filepath = upload_path('users_avatar/');
            $filepath_full = $filepath . $filename;


            if (file_put_contents($filepath_full, $uploaded_file)) {
                $user_data = array(
                    'picture' => $filename,

                );
                $user_query = $this->api->edit_profile($user_data, $user_id);
                if ($user_query) {
                    $user = $this->api->get_user($user_id);
                    $data['Status'] = 'Success';
                    $data['Massage'] = 'Profile Updated Successfully';
                    $data['result'] = $user;
                    echo json_encode($data);


                } else {
                    $data['Status'] = 'Error';
                    $data['Massage'] = 'Some thing Wrong.';
                    $data['result'] = 'Some thing Wrong';
                    echo json_encode($data);

                }
            }


            if (file_exists($filepath_full)) {

                $this->load->library('image_lib');
                $config = array(
                    'image_library' => 'gd2',
                    'source_image' => $filepath_full,
                    'new_image' => upload_path('users_avatar/crop/') . $filename,
                    'quality' => '100%',
                    'maintain_ratio' => false,
                    'width' => 150,
                    'height' => 150
                );

                $this->image_lib->initialize($config);
                $this->image_lib->resize();


                $config = array(
                    'image_library' => 'gd2',
                    'source_image' => $filepath_full,
                    'new_image' => upload_path('users_avatar/medium/') . $filename,
                    'quality' => '100%',
                    'maintain_ratio' => false,
                    'width' => 225,
                    'height' => 225
                );

                $this->image_lib->initialize($config);
                $this->image_lib->resize();

                /* generating small size image */
                $config = array(
                    'image_library' => 'gd2',
                    'source_image' => $filepath_full,
                    'new_image' => upload_path('users_avatar/small/') . $filename,
                    'quality' => '100%',
                    'maintain_ratio' => false,
                    'width' => 100,
                    'height' => 100
                );

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
            }

        }


    }

    function edit_profile() {

        $this->form_validation->set_rules('user_id', 'User', 'trim|required');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]');
            $this->form_validation->set_rules('phone_no', 'Phone', 'trim|required');

            if( $this->form_validation->run() == false ) {

                $data['Status'] = 'Error';
                $data['Massage'] = 'Validation errors';
                $data['result'] = validation_errors();
                echo json_encode($data);
                return;

            } else {
                $user_id = $this->input->post('user_id');
                $phone_no = $this->input->post('phone_no');
                if (substr($phone_no, 0, 3) === '+92') {
                    $phone = $phone_no;
                }else {
                    $phone = phone_formatting($phone_no);
                }
                $user_data = array(
                    'first_name'=>$this->input->post('first_name'),
                    'last_name'=> $this->input->post('last_name'),
                    'phone'=> $phone,
                    'city'=> $this->input->post('user_city'),
                    'area'=> $this->input->post('user_area'),
                );

                $user_query = $this->api->edit_profile($user_data, $user_id);
                if( $user_query )
                {
                    $user = $this->api->get_user($user_id);
                    $data['Status'] = 'Success';
                    $data['Massage'] = 'Profile Updated Successfully';
                    $data['result'] = $user;
                    echo json_encode($data);
                    return;

                }
                else
                {
                    $user = $this->api->get_user($user_id);
                    $data['Status'] = 'Error';
                    $data['Massage'] = 'Some thing Wrong.';
                    $data['result'] = $user;
                    echo json_encode($data);
                    return;
                }

            }

    }

    function addProperty() {

                $this->form_validation->set_rules('user_id','User id','trim|required');
                $this->form_validation->set_rules('purpose','purpose','trim|required');
                $this->form_validation->set_rules('property_type','Property Type','trim|required');
                $this->form_validation->set_rules('property_sub_type','Property Sub Type','trim|required');
                $this->form_validation->set_rules('property_city','City','trim|required');
                $this->form_validation->set_rules('property_area','Area','trim|required');
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
                $this->form_validation->set_rules('expires','Expire date','trim|required');

                if($this->form_validation->run() == false){
                    $data['Status'] = 'Error';
                    $data['Massage'] = 'Validation errors';
                    $data['result'] = validation_errors();
                    echo json_encode($data);
                    return;

                } else {

                    $areaType = $this->input->get_post('unit_id');
                    $area = $this->input->get_post('land_area');
                    $areaArray = area_converter($areaType, $area);

                    $myString = $this->input->get_post('listing_files');
                    $list_files = explode(',', $myString);

                    //pre($list_files);




                    $location_data = array(
                        'sub_sub_area' => $this->input->post('sub_sub_area'),
                        'sub_area' => $this->input->post('sub_area'),
                        'area_location' => $this->input->post('area_location'),
                        'city' => $this->input->post('city'),
                        'state_province' => $this->input->post('state_province'),
                        'country' => $this->input->post('country'),
                    );

                    $t = implode(' , ', $location_data);
                    $composed_location = trim($t," , ");

                    $data = array(
                        'user_id' => $this->input->get_post('user_id'),
                        'house_number' => $this->input->get_post('house_number'),
                        'property_street' => $this->input->get_post('property_street'),
                        'purpose' => $this->input->get_post('purpose'),
                        'property_type' => $this->input->get_post('property_type'),
                        'property_sub_type' => $this->input->get_post('property_sub_type'),
                        'city' => ($this->input->get_post('property_city')),
                        'area' => ($this->input->get_post('property_area')),
                        'property_location'=>$composed_location,
                        'area_sqrft' => $areaArray['square_feet'],
                        'area_sqyard' => $areaArray['square_yards'],
                        'area_sqmeter' => $areaArray['square_metres'],
                        'area_marla' => $areaArray['area_marla'],
                        'area_kanal' => $areaArray['area_kanal'],
                        'area_actre' => $areaArray['area_acre'],
                        'sectors' => ($this->input->get_post('property_sub_area')),
                        'state_province' => ($this->input->get_post('state_province')),
                        'country' => ($this->input->get_post('country')),
                        'latitude' => $this->input->get_post('lat'),
                        'longitude' => $this->input->get_post('lng'),
                        'title' => ($this->input->get_post('property_title')),
                        'slug' => slugit($this->input->get_post('property_title')),
                        'summary' => ($this->input->get_post('summary')),
                        'land_area' => $this->input->get_post('land_area'),
                        'unit_id' => $this->input->get_post('unit_id'),
                        'bedrooms' => $this->input->get_post('bed'),
                        'bathrooms' => $this->input->get_post('bath'),
                        'price' => $this->input->get_post('price'),
                        'expires' => $this->input->get_post('expires'),
                        'video' => $this->input->get_post('video'),
                        'contact_primary' => $this->input->get_post('contact_primary'),
                        'contact_secondary' => $this->input->get_post('contact_secondary'),
                        'status' => 'pending',

                    );
                    //pre($data);

                    $result = $this->db->insert('listing', $data);
                    $insert_id = $this->db->insert_id();
                    $file_title = 'zoney_pk-'.slugit($this->input->get_post('property_title'));

                    foreach ($list_files as $file) {
                        $unique_no = randomStrNum(10);
                        $uploaded_file = base64_to_image($file);
                        $filename = randomStrNum(6) . '.jpg';
                        $filename2 = $file_title.'-'.$unique_no.'-'.$filename;
                        $filepath = upload_path('properties/thumbs/');
                        $filepath_full = $filepath . $filename2;
                        if (file_put_contents($filepath_full, $uploaded_file)) {
                            $listing_file[] = $filename2;

                        }
                       if (file_exists($filepath_full)) {

                            $this->load->library('image_lib');
                            $config = array(
                                'image_library' => 'gd2',
                                'source_image' => $filepath_full,
                                'new_image' => upload_path('properties/small/') . $filename2,
                                'quality' => '100%',
                                'maintain_ratio' => false,
                                'width' => 400,
                                'height' => 267
                            );
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();

                            $config = array(
                                'image_library' => 'gd2',
                                'source_image' => $filepath_full,
                                'new_image' => upload_path('listings/') . $filename2,
                                'quality' => '100%',
                                'maintain_ratio' => false,
                                'width' => 780,
                                'height' => 400
                            );
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();

                        }
                    }
                    //pre($listing_file);

                    $this->saveFileNames($listing_file,$insert_id);
                    $amenities = $_POST['amenities'];
                    $this->addAmenities($amenities,$insert_id);

                    if($result){

                        $data['Status'] = 'Success';
                        $data['Massage'] = 'Property added successfully';
                        $data['result'] = 'Property has been added successfully.';
                        echo json_encode($data);
                        return;
                    }
                }


    }

    function getPropertyDetail (){
            $lid = $this->input->post('listing_id');
            $data = $this->listing->get_list($lid);
        $data_pic = $this->listing->listing_gallery_by_id($lid);

        if($data){
            $datalist['Status'] = 'Success';
            $datalist['Massage'] = 'Listing detail';
            $datalist['result'] = $data;
            $datalist['list_pic'] = $data_pic;
            echo json_encode($datalist);
            return;
        } else {
            $datalist['Status'] = 'Error';
            $datalist['Massage'] = 'Some thing Wrong.';
            $datalist['result'] = 'You are not Able to get listing detail.';
            echo json_encode($datalist);
            return;
        }



    }

    function updateProperty(){

        $this->form_validation->set_rules('user_id','User id','trim|required');
        $this->form_validation->set_rules('purpose','purpose','trim|required');
        $this->form_validation->set_rules('property_type','Property Type','trim|required');
        $this->form_validation->set_rules('property_sub_type','Property Sub Type','trim|required');
        $this->form_validation->set_rules('property_city','City','trim|required');
        $this->form_validation->set_rules('property_area','Area','trim|required');
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
        $this->form_validation->set_rules('expires','Expire date','trim|required');

        if($this->form_validation->run() == false){
            $data['Status'] = 'Error';
            $data['Massage'] = 'Validation errors';
            $data['result'] = validation_errors();
            echo json_encode($data);
            return;

        } else {
             $listing_id = $this->input->get_post('id');
            $areaType = $this->input->get_post('unit_id');
            $area = $this->input->get_post('land_area');
            $areaArray = area_converter($areaType, $area);

            $list_files = $this->input->get_post('listing_files');
            //pre($list_files);




            $location_data = array(
                'sub_sub_area' => $this->input->post('sub_sub_area'),
                'sub_area' => $this->input->post('sub_area'),
                'area_location' => $this->input->post('area_location'),
                'city' => $this->input->post('city'),
                'state_province' => $this->input->post('state_province'),
                'country' => $this->input->post('country'),
            );

            $t = implode(' , ', $location_data);
            $composed_location = trim($t," , ");

            $data = array(
                'user_id' => $this->input->get_post('user_id'),
                'house_number' => $this->input->get_post('house_number'),
                'property_street' => $this->input->get_post('property_street'),
                'purpose' => $this->input->get_post('purpose'),
                'property_type' => $this->input->get_post('property_type'),
                'property_sub_type' => $this->input->get_post('property_sub_type'),
                'city' => ($this->input->get_post('property_city')),
                'area' => ($this->input->get_post('property_area')),
                'property_location'=>$composed_location,
                'area_sqrft' => $areaArray['square_feet'],
                'area_sqyard' => $areaArray['square_yards'],
                'area_sqmeter' => $areaArray['square_metres'],
                'area_marla' => $areaArray['area_marla'],
                'area_kanal' => $areaArray['area_kanal'],
                'area_actre' => $areaArray['area_acre'],
                'sectors' => ($this->input->get_post('property_sub_area')),
                'state_province' => ($this->input->get_post('state_province')),
                'country' => ($this->input->get_post('country')),
                'latitude' => $this->input->get_post('lat'),
                'longitude' => $this->input->get_post('lng'),
                'title' => ($this->input->get_post('property_title')),
                'slug' => slugit($this->input->get_post('property_title')),
                'summary' => ($this->input->get_post('summary')),
                'land_area' => $this->input->get_post('land_area'),
                'unit_id' => $this->input->get_post('unit_id'),
                'bedrooms' => $this->input->get_post('bed'),
                'bathrooms' => $this->input->get_post('bath'),
                'price' => $this->input->get_post('price'),
                'expires' => $this->input->get_post('expires'),
                'video' => $this->input->get_post('video'),
                'contact_primary' => $this->input->get_post('contact_primary'),
                'contact_secondary' => $this->input->get_post('contact_secondary'),
                'status' => 'pending',

            );
            //pre($data);
            $this->db->where('id', $listing_id);
            $result = $this->db->update('listing', $data);
            $insert_id = $listing_id;
            $file_title = 'zoney_pk-'.slugit($this->input->get_post('property_title'));

            foreach ($list_files as $file) {
                $unique_no = randomStrNum(10);
                $uploaded_file = base64_to_image($file);
                $filename = randomStrNum(6) . '.jpg';
                $filename2 = $file_title.'-'.$unique_no.'-'.$filename;
                $filepath = upload_path('properties/thumbs/');
                $filepath_full = $filepath . $filename2;

                if (file_put_contents($filepath_full, $uploaded_file)) {
                    $listing_file[] = $filename2;

                }
                if (file_exists($filepath_full)) {

                    $this->load->library('image_lib');
                    $config = array(
                        'image_library' => 'gd2',
                        'source_image' => $filepath_full,
                        'new_image' => upload_path('properties/small/') . $filename,
                        'quality' => '100%',
                        'maintain_ratio' => false,
                        'width' => 400,
                        'height' => 200
                    );
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();

                    $config = array(
                        'image_library' => 'gd2',
                        'source_image' => $filepath_full,
                        'new_image' => upload_path('listings/') . $filename,
                        'quality' => '100%',
                        'maintain_ratio' => false,
                        'width' => 780,
                        'height' => 400
                    );
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();

                }
            }
            $this->db->where('listing_id', $insert_id);
            $this->db->delete('listing_pictures');
            $this->saveFileNames($listing_file,$insert_id);
            $this->db->where('listing_id', $insert_id);
            $this->db->delete('listing_amenities');
            $amenities = $_POST['amenities'];
            $this->addAmenities($amenities,$insert_id);

            if($result){
                $data['Status'] = 'Success';
                $data['Massage'] = 'Property updated successfully';
                $data['result'] = 'Property has been updated successfully.';
                echo json_encode($data);
                return;
            }
        }
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

    function selectAmenities()
    {
        $cat_type = strtolower($this->input->post('cat_type'));
        $parent_id = $this->input->post('parent_id');
        $result_amenities = $this->listing->amenities_by_category($parent_id,$cat_type);
        if($result_amenities){
            $data['Status'] = 'Success';
            $data['Massage'] = 'Amenities founded';
            $data['result'] = $result_amenities;
            echo json_encode($data);
            return;
        } else {
            $data['Status'] = 'Error';
            $data['Massage'] = 'No Amenities found.';
            $data['result'] = 'No Amenities found.';
            echo json_encode($data);
            return;
        }

    }

    function saveFileNames($listing_file,$insert_id) {
        if( $listing_file != ''){
            foreach($listing_file as $key => $val){
                $ext = pathinfo($val, PATHINFO_EXTENSION);
                $filename =pathinfo($val, PATHINFO_FILENAME);
                if($key == 0){
                    $this->common->commonUpdate('listing', array('preview_image_url'=>$filename.'.'.$ext),'id',$insert_id );
                }
                $data = array('listing_id' =>$insert_id,'picture'=>$filename.'.'.$ext,'sort'=>$key);

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
                    pre($key);


                    if($key == 0){
                        $this->common->commonUpdate('listing', array('preview_image_url'=>$filename.'.'.$ext),'id',$insert_id );
                    }
                    $data = array('listing_id' =>$insert_id,'picture'=>$filename.'.'.$ext,'sort'=>$key);

                    $this->db->insert('listing_pictures', $data);

                } else {
                    pre($key);

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

    function getUserListings() {

            $uid = $this->input->post("user_id");
            $data = array();
            $Listings_data = $this->api->get_user_listing($uid);
            //$data['application'] = $this->common->get_result('rental_application','user_id',$uid);
        if( $Listings_data ) {
            $data['Status'] = 'Success';
            $data['Massage'] = 'Listing founded success';
            $data['result'] = $Listings_data;
            echo json_encode($data);
            return;

        } else {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Some thing Wrong.';
            $data['result'] = 'You are not posted any listings yet.';
            echo json_encode($data);
            return;
        }

    }

    public function addToFavourite() {
        $uid = $this->input->post('user_id');
        $note = $this->input->post('note_text');
        $listing_id = $this->input->post('listing_id');
        $name = $this->input->post('first_name');

        $result = $this->api->getWishlistCategories($uid);
        if (empty($result)) {
            $user_data = array('created_by' => $uid, 'name' => $name."'".'s Wishlist', 'status' => 1);
             $res = $this->db->insert('wishlist_categories', $user_data);
            $cat_id = $this->db->insert_id();

        } else {
            $cat_id = $result[0]->id;
        }

        $wishlist_categories = $cat_id;
        $wishlist_data = array('user_id' => $uid, 'wishlist_categories' => $wishlist_categories, 'listing_id' => $listing_id, 'note' => $note, 'status' => '1');
        $result = $this->api->createWishlist($wishlist_data);
        if ($result == 'true') {
            $data['Status'] = 'Success';
            $data['Massage'] = 'Add to favourite successfully.';
            $data['result'] = 'Add to favourite successfully.';
            echo json_encode($data);

        } else {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Some thing Wrong.';
            $data['result'] = 'Some thing Wrong';
            echo json_encode($data);

        }

    }

    public function remove_favourite()
    {

        $uid = $this->input->post('user_id');
        $listing_id = $this->input->post('listing_id');
        $result = $this->wishlist->removeWishlist($listing_id, $uid);
        if($result){
            $data['Status'] = 'Success';
            $data['Massage'] = 'Wishlists removed';
            $data['result'] = $result;
            echo json_encode($data);
            return;
        } else {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Some thing Wrong.';
            $data['result'] = 'Some thing Wrong';
            echo json_encode($data);
            return;
        }

    }

    public function get_favourite_listing()
    {
        $uid = $this->input->post('user_id');
        $result = $this->api->getWishlistsByUserId($uid);
        if($result){
            $data['Status'] = 'Success';
            $data['Massage'] = 'Wishlists founded';
            $data['result'] = $result;
            echo json_encode($data);
            return;
        } else {
            $data['Status'] = 'Error';
            $data['Massage'] = 'No favroit property found.';
            $data['result'] = 'No favroit property found.';
            echo json_encode($data);
            return;
        }


    }

    public function get_user_wishlist()
    {
        $uid = $this->input->post('user_id');
       // $result = $this->api->getWishlistCategories($uid);
        $result = $this->api->wishlistDetails($uid);
        if($result){
            $data['Status'] = 'Success';
            $data['Massage'] = 'Wishlists founded';
            $data['result'] = $result;
            echo json_encode($data);
            return;
        } else {
            $data['Status'] = 'Error';
            $data['Massage'] = 'No favroit property found.';
            $data['result'] = 'No favroit property found.';
            echo json_encode($data);
            return;
        }


    }


    public function searachListings() {

        //$totalRec = $this->api->get_listing_for_search_page()->num_rows();
        $search_results = $this->api->get_listing_for_search_page()->result();
        if(empty($search_results)){
            $data_listings = $this->api->get_popular_listing_for_search_page()->result();
            $massage = 'Popular Properties';
        } else {
            $data_listings = $search_results;
              $massage = 'Properties found Success';

        }
        $login_user_id = $this->input->post('user_id');
        if($login_user_id){
            $wishlist = $this->api->getWishlistsByUserId($login_user_id);
            if(count($wishlist) > 0){
                $wishlists = $wishlist;
            } else {
                $wishlists = array();
            }

        }

        if ($data_listings) {
            $data['Status'] = 'Success';
            $data['Massage'] = $massage;
            $data['result'] = $data_listings;
            $data['wishlists'] = $wishlists;
            //$data['total_count'] = $totalRec;
            echo json_encode($data);

        } else {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Some thing Wrong.';
            $data['result'] = 'No property find against your search.';
            echo json_encode($data);

        }



    }

    public function listings_gallery_by_id(){

            $listing_id = $this->input->post('listid');
            $data_listing = $this->api->listing_gallery_by_listings_id($listing_id);
            if($data_listing){
                $data['Status'] = 'Success';
                $data['Massage'] = 'detail';
                $data['listing_result'] = $data_listing;
                echo json_encode($data);
                return;
            } else {
                $data['Status'] = 'Error';
                $data['Massage'] = 'Some thing Wrong.';
                $data['listing_result'] = 'No picture found.';
                echo json_encode($data);
                return;
            }


        }


    public function fbLogin() {

      /*  $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('oauth_uid', 'Oauth id', 'required');
        if ($this->form_validation->run() === false) {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Validation errors';
            $data['result'] = validation_errors();
            echo json_encode($data);
            return;

        } else {*/
            $user = array(
                'email' => $this->input->post('email'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'address' => $this->input->post('location'),
                'city' => $this->input->post('hometown'),
                'oauth_provider' => 'Facebook',
                'oauth_uid' => $this->input->post('oauth_uid'),
                'about' => $this->input->post('about'),
                'active' => 1,
            );
            $user_id = $this->api->register($user);

            $user_img = $this->input->post('user_image');
            $uploaded_file = base64_to_image($user_img);
            $filename = randomStrNum(6) . '.jpg';
            $filepath = upload_path('users_avatar/');
            $filepath_full = $filepath . $filename;


            if (file_put_contents($filepath_full, $uploaded_file)) {
                $user_data = array(
                    'picture' => $filename,

                );

            }
            $user_query = $this->api->edit_profile($user_data, $user_id);
            if($user_query){
                /*if ($user_id) {*/

                    $user_record = $this->api->social_login($user);
                    if($user_record){

                        $data['Status'] = 'Success';
                        $data['Massage'] = 'User login Successfully';
                        $data['result'] = $user_record;
                        echo json_encode($data);

                    } else {
                        $data['Status'] = 'Error';
                        $data['Massage'] = 'Some thing Worng';
                        $data['result'] = 'Unable to login';
                        echo json_encode($data);

                    }
                /*} else {
                    $data['Status'] = 'Error';
                    $data['Massage'] = 'Some thing Worng';
                    echo json_encode($data);


                }*/

            if (file_exists($filepath_full)) {

                $this->load->library('image_lib');
                $config = array(
                    'image_library' => 'gd2',
                    'source_image' => $filepath_full,
                    'new_image' => upload_path('users_avatar/crop/') . $filename,
                    'quality' => '100%',
                    'maintain_ratio' => false,
                    'width' => 150,
                    'height' => 150
                );

                $this->image_lib->initialize($config);
                $this->image_lib->resize();


                $config = array(
                    'image_library' => 'gd2',
                    'source_image' => $filepath_full,
                    'new_image' => upload_path('users_avatar/medium/') . $filename,
                    'quality' => '100%',
                    'maintain_ratio' => false,
                    'width' => 225,
                    'height' => 225
                );

                $this->image_lib->initialize($config);
                $this->image_lib->resize();

                /* generating small size image */
                $config = array(
                    'image_library' => 'gd2',
                    'source_image' => $filepath_full,
                    'new_image' => upload_path('users_avatar/small/') . $filename,
                    'quality' => '100%',
                    'maintain_ratio' => false,
                    'width' => 100,
                    'height' => 100
                );

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
            }
            }

        //}
    }

    public  function get_detail_user_with_property(){

            $user_id = $this->input->post('user_id');
            $listing_id = $this->input->post('listid');
            $user_detail = $this->api->get_user($user_id);
            $data_listing = $this->api->listing_gallery_by_listings_id($listing_id);
            if($user_detail){
                $data['Status'] = 'Success';
                $data['Massage'] = 'detail';
                $data['user_result'] = $user_detail;
                $data['listing_result'] = $data_listing;
                echo json_encode($data);
                return;
            } else {
                $data['Status'] = 'Error';
                $data['Massage'] = 'Some thing Wrong.';
                $data['listing_result'] = 'You are not Able to get user detail.';
                echo json_encode($data);
                return;
            }


    }

    function contact_us_form() {
        $UserData = array();
        $subject ='New Message From Zoney.pk';
        $UserData['poster_name'] = $this->input->post('fullname');
        $UserData['poster_email'] = $this->input->post('email');
        $UserData['poster_phone'] = $this->input->post('phone');
        //$UserData['poster_country'] = $this->input->post('country');
        //$UserData['poster_reason_of_inq'] = $this->input->post('reason_of_inq');
        // $UserData['subject'] = $this->input->post('subject');
        $UserData['poster_message'] = $this->input->post('message');
        $to = $this->input->post('email');
        $subject = 'New message from Zoney';
        $view = 'contact-form-submission-user';
        sendEmail($to, $subject, $UserData, $view);
        $UserData = array();
        $subject ='New Message From Zoney.pk';
        $UserData['poster_name'] = $this->input->post('fullname');
        $UserData['poster_email'] = $this->input->post('email');
        $UserData['poster_phone'] = $this->input->post('phone');
        //$UserData['poster_country'] = $this->input->post('country');
        //$UserData['poster_reason_of_inq'] = $this->input->post('reason_of_inq');
        // $UserData['subject'] = $this->input->post('subject');
        $UserData['poster_message'] = $this->input->post('message');
        $to = 'arshjilani@gmail.com ';
        $subject = 'New message from Zoney';
        $view = 'contact-form-submission';
        sendEmail($to, $subject, $UserData, $view);

        if (!empty($UserData)) {
                $data['Status'] = 'Success';
                $data['Massage'] = 'Email sent Successfully';
                $data['result'] = 'Email sent Successfully, admin will respond you soon.';
                echo json_encode($data);

            } else {
                $data['Status'] = 'Error';
                $data['Massage'] = 'Some thing Worng';
                $data['result'] = 'Unable to send email';
                echo json_encode($data);

            }
    }

    function quick_contact() {

        $sender_id = $this->input->post('sender_id');
        if ($sender_id != ''){
            $rec_id = $this->input->post('receiver_id');
            $data = array(
                'receiver_id' => $this->input->post('receiver_id'),
                'sender_id' => $sender_id,
                'type' => 'Inbox',
                'message' => $this->input->post('message'),
                'listing_id' => 0,
                'guest' => "",
                'read_status' => 0,
            );


            $user = $this->user->get_user($sender_id);
            $user_to = $this->user->get_user($rec_id);
            $user_data = array();
            $user_data['poster_name'] = $user->first_name. ' ' .$user->last_name;
            $user_data['message'] = $this->input->post('message');
            $user_data['poster_email'] = $user->email;
            $user_data['poster_phone'] = $user->phone;
            $user_data['receiver_name'] = $user_to->first_name. ' ' .$user_to->last_name;
            $user_data['url'] = site_url("inbox");
            $to = $user_to->email;
            $subject = 'Message From User';
            $view = 'quick-contact';
            sendEmail($to, $subject, $user_data, $view);

            if ($this->inbox->send_message($data))
            {
                $msg_data = array(
                    'receiver_id' => $rec_id,
                    'sender_id' => $sender_id,
                    'message' => $this->input->post('message'),
                    'receiver_name' => $user_to->first_name. ' ' .$user_to->last_name,
                    'sender_name' => $user->first_name. ' ' .$user->last_name,
                    'sender_email' => $user->email,
                    'sender_phone' => $user->phone
                );
                $this->inbox->add_msg_record($msg_data);

                $array_data = array(
                    'user_id' => $sender_id,
                    'agent_id' => $rec_id,
                    'notification' => 'You have received new message',
                    'notify_type' => 'inbox'
                );
                $this->inbox->add_notifcation($array_data);


                    $dataRes['Status'] = 'Success';
                $dataRes['Massage'] = 'Messaged sent Successfully';
                $dataRes['result'] = 'You successfully messaged your selected agent. Expect a response soon!';
                    echo json_encode($dataRes);

                } else {
                $dataRes['Status'] = 'Error';
                $dataRes['Massage'] = 'Some thing Worng';
                $dataRes['result'] = 'Something wrong.Please try again.';
                    echo json_encode($dataRes);

                }
        }else {
            $array_data = array(
                'user_id' => '0',
                'agent_id' => $this->input->post('receiver_id'),
                'notification' => 'Some one wants to contact you',
                'notify_type' => 'inbox'
            );

            $this->inbox->add_notifcation($array_data);
            $user_id = $this->input->post('receiver_id');
            $msg_info = $this->user->get_user($user_id);
            $msg_data = array(
                'receiver_id' => $this->input->post('receiver_id'),
                'sender_id' => '0',
                'message' => $this->input->post('message'),
                'receiver_name' => $msg_info->first_name. ' ' .$msg_info->last_name,
                'sender_name' => $this->input->post('fullname'),
                'sender_email' => $this->input->post('email'),
                'sender_phone' => $this->input->post('phone')
            );

            $this->inbox->add_msg_record($msg_data);


            $user_id = $this->input->post('receiver_id');
            $MailUser = $this->user->get_user($user_id);
            $to = $MailUser->email;
            $subject ='Message For Contact';
            $UserData['receiver_name'] = $MailUser->first_name .' '. $MailUser->last_name;
            $UserData['poster_name'] = $this->input->post('fullname');
            $UserData['poster_email'] = $this->input->post('email');
            $UserData['poster_phone'] = $this->input->post('phone');
            $UserData['message'] = $this->input->post('message');
            $user_data['url'] = site_url("inbox");

            sendEmail($to, $subject, $UserData, 'quick-contact');

            $dataRes['Status'] = 'Success';
            $dataRes['Massage'] = 'Messaged sent Successfully';
            $dataRes['result'] = 'You successfully messaged your selected agent. Expect a response soon!';
            echo json_encode($dataRes);
        }
    }

    function AddReviews() {

        $this->form_validation->set_rules('agent_id','Agent id','trim|required');
        $this->form_validation->set_rules('reviews_by','User id','trim|required');
        $this->form_validation->set_rules('review_title','Title','trim|required');
        $this->form_validation->set_rules('review','Review','trim|required');
        $this->form_validation->set_rules('address','Address','trim|required');

        if($this->form_validation->run() == false){
            $data['Status'] = 'Error';
            $data['Massage'] = 'Validation errors';
            $data['result'] = validation_errors();
            echo json_encode($data);
            return;

        } else {
            $reviews = array(
                'agent_id' => $this->input->get_post('agent_id'),
                'reviews_by' => $this->input->get_post('reviews_by'),
                'review_title' => $this->input->get_post('review_title'),
                'review' => $this->input->get_post('review'),
                'knowledge' => $this->input->get_post('knowledge'),
                'expertise' => $this->input->get_post('expertise'),
                'responsiveness' => $this->input->get_post('responsiveness'),
                'negotiation_skills' => $this->input->get_post('negotiation_skills'),
                'value' => $this->input->get_post('value'),
                'service_provided' => $this->input->get_post('service_provided'),
                'address' => $this->input->get_post('address'),
            );

            if ($this->api->AddAgentReviews($reviews)) {

                 $userId= $this->input->get_post('reviews_by');

                $user = $this->user->get_user($userId);
                $rec_id = $this->input->post('agent_id');
                $array_data = array(
                    'user_id' => $userId,
                    'agent_id' => $rec_id,
                    'notification' => 'You have received review',
                    'notify_type' => 'reviews'
                );
                $this->inbox->add_notifcation($array_data);

                $user_to = $this->user->get_user($rec_id);
                $user_data = array();
                $user_data['poster_name'] = $user->first_name. ' ' .$user->last_name;
                $user_data['message'] = $this->input->post('review');
                $user_data['review_title'] = $this->input->post('review_title');
                $user_data['receiver_name'] = $user_to->first_name. ' ' .$user_to->last_name;
                $user_data['url'] = site_url("dashboard");
                $to = $user_to->email;
                $subject = 'Review recived';
                $view = 'write-review';
                sendEmail($to, $subject, $user_data, $view);

                $userto = $user->email;
                $subjectu = 'Review Published';
                $viewu = 'write-review-user';
                sendEmail($userto, $subjectu, $user_data, $viewu);

                $dataRes['Status'] = 'Success';
                $dataRes['Massage'] = 'Comment Published Successfully';
                $dataRes['result'] = 'Comment Published Successfully';
                echo json_encode($dataRes);
            } else {
                $dataRes['Status'] = 'Error';
                $dataRes['Massage'] = 'Some thing Worng while Comment Published.';
                $dataRes['result'] = 'Something wrong.Please try again.';
                echo json_encode($dataRes);

            }
        }
    }

    function addRecommendation() {

        $this->form_validation->set_rules('poster_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('poster_name', 'First Name', 'required|min_length[3]');
        $this->form_validation->set_rules('recommendation', 'Last Name', 'required|min_length[3]');

        if ($this->form_validation->run() == FALSE) {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Validation errors';
            $data['result'] = validation_errors();
            echo json_encode($data);
            return;
        } else {

            $data = array(
                'name' => $this->input->post('poster_name'),
                'email' => $this->input->post('poster_email'),
                'recommendation' => $this->input->post('recommendation'),
                'agent_id' => $this->input->post('agent_id'),
                'status' => 1
            );

            if($this->agents->insertRecommendation($data)){
                $rec_id = $this->input->post('agent_id');
                $user_to = $this->user->get_user($rec_id);
                $user_data = array();
                $user_data['receiver_name'] = $user_to->first_name. ' ' .$user_to->last_name;
                $user_data['url'] = site_url("dashboard");
                $to = $user_to->email;
                $subject = 'You have recived recommendation';
                $view = 'recommendation';
                sendEmail($to, $subject, $user_data, $view);

                $dataRes['Status'] = 'Success';
                $dataRes['Massage'] = 'You successfully submitted your recommendation.';
                $dataRes['result'] = 'You successfully submitted your recommendation.';
                echo json_encode($dataRes);
            } else {
                $dataRes['Status'] = 'Error';
                $dataRes['Massage'] = 'Some thing Worng while recommendation  Published.';
                $dataRes['result'] = 'Something wrong.Please try again.';
                echo json_encode($dataRes);

            }


        }




    }

    function contact_agent() {

        $this->form_validation->set_rules('poster_name', 'First name', 'required|min_length[3]');
        $this->form_validation->set_rules('poster_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('poster_phone', 'Phone', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Validation errors';
            $data['result'] = validation_errors();
            echo json_encode($data);
            return;
        } else {
            $agent_id = $this->input->post('agent_id');
            $data['agent_id '] = $agent_id;
            $data['poster_name '] = $this->input->post('poster_name');
            $data['poster_email '] = $this->input->post('poster_email');
            $data['poster_phone '] = $this->input->post('poster_phone');
            $data['reason_to_contact '] = $this->input->post('reason_to_contact');
            $data['message '] = $this->input->post('message');

            if ($this->api->contactAgent($data)) {
                $user_data = array();
                $user_data['poster_name'] = $this->input->post('poster_name');
                $user_data['poster_email'] = $this->input->post('poster_email');
                $user_data['poster_phone'] =  $this->input->post('poster_phone');
                $user_data['receiver_name'] = $this->input->post('agent_name');
                $user_data['message'] =  $this->input->post('message');
                $to = $this->input->post('agent_email');
                $subject = 'Contact inquiry from ' . $this->input->post('poster_name');
                $view = 'contact_agent';
                sendEmail($to, $subject, $user_data, $view);


                $dataRes['Status'] = 'Success';
                $dataRes['Massage'] = 'Contact inquiry from sent successfully.';
                $dataRes['result'] = 'Contact inquiry from sent successfully.';
                echo json_encode($dataRes);
            } else {
                $dataRes['Status'] = 'Error';
                $dataRes['Massage'] = 'Some thing Worng while Contact inquiry from sending.';
                $dataRes['result'] = 'Some thing Worng while Contact inquiry from sending.';
                echo json_encode($dataRes);

            }

        }
    }

    function listingsCount(){

        $data_listings = $this->api->getAllListingCount();
        $data['Status'] = 'Success';
        $data['Massage'] = 'All listings';
        $data['result'] = $data_listings;
        echo json_encode($data);
        return;

    }

    function saveSearchLog(){
        $logs = array(
            'user_id' => $this->input->post('user_id'),
            'log_date' => $this->input->post('log_date'),
            'log_detail' => $this->input->post('log_detail'),

        );
         $this->db->insert('search_logs', $logs);
        $id = $this->db->insert_id();
        $response = $this->api->get_search_log($id);
        if ($response) {
            $data['Status'] = 'Success';
            $data['Massage'] = 'log added Successfully';
            $data['result'] = $response;
            echo json_encode($data);


        } else {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Some thing Worng';
            echo json_encode($data);
            return;

        }

    }

    function getUserSearchLog(){

            $user_id = $this->input->post('user_id');
            $response = $this->api->get_user_search_log($user_id);
            if ($response) {
            $data['Status'] = 'Success';
            $data['Massage'] = 'log data Successfully';
            $data['result'] = $response;
            echo json_encode($data);

            } else {
            $data['Status'] = 'Error';
            $data['Massage'] = 'Some thing Worng';
            echo json_encode($data);
            return;

        }

    }
















    /*public function index() {

        redirect('/');
    }*/


    function user_profile() {


        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) { $data['topmenu'] = "session_topmenu";}
        add_css(array('jquery.raty.css', 'light.css'));
        add_js(array('jquery.slimscroll.min.js', 'moment.min.js', 'jquery.raty.js','jquery.validate.min.js','general.js','share.js','dashboard.js','jquery.sticky.js'));
        set_extra_js("$('#knowledge').raty({ scoreName: 'reviews[knowledge]' });$('#expertise').raty({ scoreName: 'reviews[expertise]' });$('#responsiveness').raty({ scoreName: 'reviews[responsiveness]' });$('#negotiation_skills').raty({ scoreName: 'reviews[negotiation_skills]' });");
        set_extra_js("
                $('.close_legend').click(function(){
                    $('#timeline-map-legend').toggle();
                });
        ");

        $type = $this->input->get('type');
        $slug = $this->uri->segment(3);
        $sortby = $this->input->get('sortby');
        $id = explode('-', $slug);
        $agent_id = $id[count($id) - 1];
        $data['users_avatar']  = $this->config->item('users_avatar');
        $data['agent'] = $this->agents->getAgentDetail($agent_id);
        $sorting = $this->input->post('sorttype');
        $property_type = $this->input->post('ptype');
        $type='all';

        $data['listings'] = $this->agents->getAgentListings($type,$agent_id,$property_type,$sorting)->result();
        $total =  count($data['listings']);
        $data['sale'] = $this->agents->getAgentSaleListings($agent_id)->result();
        $data['rent'] = $this->agents->getAgentRentListings($agent_id)->result();
        $data['sold'] = $this->agents->getAgentSoldListings($agent_id)->result();

        //https://www.aspsnippets.com/Articles/Google-Maps-V3-Display-Colored-Markers-for-particular-type-of-location.aspx
        $i=0;
        $positions = array();

        foreach ($data['listings'] as $key => $listing) {

            $result[$key] = $listing->price;

            if ($i == 0) {
                $positions = array($listing->id . "," . $listing->latitude . "," . $listing->longitude . "," . restyle_number($listing->price). "," . $listing->property_type. "," . $listing->active);
            } else {
                array_push($positions, $listing->id . "," . $listing->latitude . "," . $listing->longitude . "," . restyle_number($listing->price). "," . $listing->property_type. "," . $listing->active);
            }
            $i++;
        }

        $data['min'] = min($result);
        $data['max'] = max($result);
        $data['positions']=$positions;
        //$data['listings']->preview_image_url;
        $data['slug'] = $slug;
        $data['type'] = $type;
        $data['search_img'] = $this->config->item('search_img');
        $data['abs_path'] = $this->config->item('abs_path');
        //$data['featured']  = $this->listing->FeaturedListings(3);

        set_extra_js('$("#listing").click(function() {
    $(\'html, body\').animate({
        scrollTop: $("#listing").offset().top
    }, 2000);
});');

        set_extra_js('$("#listing").click(function() {
    $(\'html, body\').animate({
        scrollTop: $("#listing").offset().top
    }, 2000);
});');

        set_extra_js('$("#team").click(function() {
    $(\'html, body\').animate({
        scrollTop: $("#team").offset().top
    }, 2000);
});');

        set_extra_js('$("#reviews-section").click(function() {
    $(\'html, body\').animate({
        scrollTop: $("#reviews-section").offset().top
    }, 2000);
});');

        set_extra_js('$("#recommend-section").click(function() {
    $(\'html, body\').animate({
        scrollTop: $("#recommend-section").offset().top
    }, 2000);
});');



        set_extra_js('$("a[href^=\'#\']").click(function(e) {
                e.preventDefault();
            
                var position = $($(this).attr("href")).offset().top;
            
                $("body, html").animate({
                    scrollTop: position
                } /* speed */ );
            });
        ');
        set_extra_js("$('#myList li.list:lt(9)').show();
                            $('#showLess').hide();
                            var items =  $total;
                            var shown =  9;
                            $('#loadMore').click(function () {
                                $('#showLess').show();
                                shown = $('#myList li.list:visible').size()+6;
                                if(shown< items) { $('#myList li.list:lt('+shown+')').show();}
                                else { $('#myList li.list:lt('+items+')').show();
                                     $('#loadMore').hide();
                                }
                               
                            });
                            ");
        set_extra_js("$('#list_sale li.list:lt(9)').show();
                            $('#showLess').hide();
                            var items =  $total;
                            var shown =  9;
                            $('#loadMore').click(function () {
                                $('#showLess').show();
                                shown = $('#list_sale li.list:visible').size()+6;
                                if(shown< items) { $('#list_sale li.list:lt('+shown+')').show();}
                                else { $('#list_sale li.list:lt('+items+')').show();
                                     $('#loadMore').hide();
                                }
                               
                            });
                            ");
        set_extra_js("$('#list_rent li.list:lt(9)').show();
                            $('#showLess').hide();
                            var items =  $total;
                            var shown =  9;
                            $('#loadMore').click(function () {
                                $('#showLess').show();
                                shown = $('#list_rent li.list:visible').size()+6;
                                if(shown< items) { $('#list_rent li.list:lt('+shown+')').show();}
                                else { $('#list_rent li.list:lt('+items+')').show();
                                     $('#loadMore').hide();
                                }
                               
                            });
                            ");

        $data['teams']  =  $this->agents->getAllMembersByAgentId($agent_id);
        $review =  $this->agents->get_agent_review($agent_id);
        $data['reviews_all'] = $this->agents->get_agent_reviews_all((int) $agent_id);
        $data['recommendations'] = $this->agents->getAgentRecommendations((int) $agent_id);

        if ($review) {
            $data['rating'] = round($review->rating, 2) * 20;
            $data['total'] = $review->total;
        } else {
            $data['rating'] = 0;
            $data['total'] = 0;
        }

        $this->seo->SetValues('OgImg', base_url('assets/media/users_avatar/medium/'.$data['agent']->picture));
        $this->seo->SetValues('Title',  $data['agent']->first_name .' '.$data['agent']->last_name .' '.$data['agent']->agent_type.' ' .$data['agent']->city .' '.$data['agent']->state );
        $this->seo->SetValues('Address',  $data['agent']->city .' '.$data['agent']->state );
        $this->seo->SetValues('Description', ucfirst(substr($data['agent']->about, 0, 140)));

        $this->load->view('templates/header');
        $this->load->view('users/user_detail', $data);
        $this->load->view('templates/footer');

    }



    public function user_referral()
    {
        if(isset($_GET["code"]))
        {
             $_SESSION["referral"]=($_GET["code"]);
             redirect('signup');die();
        }


    }

    public function show($uid = NULL) {

       /* if ($this->session->userdata('logged_in')) {*/

            $this->load->model('Reviews_model');
            $this->load->model('References_model');
            $this->load->model('Listings_model');
            $this->load->model('Wishlists_model');
            $this->load->model('Common_model', 'common', true);
            $data = new stdClass();
            $user_detail = $this->Users_model->get_user($uid);


            if (empty($user_detail)) {
                redirect('/404_override');
            } else {
                $data->user = $user_detail;
            }

            add_css(array('light.css', 'bootstrap-wysihtml5.css', 'jquery.fancybox.css', 'inbox.css'));
            add_js(array('jquery.slimscroll.min.js', 'jquery.fancybox.pack.js', 'wysihtml5-0.3.0.js', 'bootstrap-wysihtml5.js', 'inbox.js'));

            $session_data = $this->session->userdata('logged_in');
            $suid = $session_data['id'];
            if ($uid == $suid) {
                $data->edit_profile = true;
            } else {
                $data->edit_profile = false;
            }
            $data->users_avatar = $this->config->item('users_avatar');
            //$data->reviews_to = $this->Reviews_model->reviews_about_you($uid);
            $data->reviews_by = $this->Reviews_model->reviews_by_you($uid);
            $data->search_img = $this->config->item('search_img');
            $data->abs_path = $this->config->item('abs_path');
            $data->wishlists = $this->Wishlists_model->renterwishlistDetails($uid);
            $data->listings = $this->agents->getJoinedAgentListings('all',$uid,'all','')->result();

            //Title and meta description
            $this->seo->SetValues('Title', $data->user->first_name . " " . $data->user->last_name . '\'Profile - Zoney');
            $this->seo->SetValues('Description', $data->user->first_name . " " . $data->user->last_name . " has been a member of zoney since " . date("F j, Y", strtotime($data->user->registered_date)));

            $this->load->view('templates/header');
            $this->load->view('users/view_profile', $data);
            $this->load->view('templates/footer');
       /* } else {
            redirect('/');
        }*/
    }

    public function signup_status() {

        if ($this->session->userdata('logged_in') != TRUE) {
            $this->load->library('user_agent');  // load user agent library
            $this->session->set_userdata('last_page', $this->agent->referrer());
            redirect(site_url('signup'));
        }
    }

    public function user_login_session($user) {

        $users_avatar = $this->config->item('users_avatar');
        $session_array = array(
            'id' => (int) $user->id,
            'first_name' => (string) $user->first_name,
            'last_name' => (string) $user->last_name,
     //       'location' => (string) $user->location,
            'city' => (string) $user->city,
            'state' => (string) $user->state,
            'zip' => (string) $user->zip,
       //     'country' => (string) $user->country,
      //      'state_code' => (string) $user->state_code,
 //           'street' => (string) $user->street,
            'agent_type' => (string) $user->agent_type,
            'about' => (string) $user->about,
            'full_name' => (string) $user->first_name . " " . $user->last_name,
            'email' => (string) $user->email,
            'active' => (string) $user->active,
            'user_type' => (string) $user->user_type,
            'picture' => (string) $users_avatar . "medium/" . $user->picture,
            'thumb' => (string) $users_avatar . "small/" . $user->picture,
            'cropped' => (string) $users_avatar . "crop/" . $user->picture,
            'pic'=>$user->picture,
            'phone'=>$user->phone,
            'logged_in' => (bool) true,
        );


        //pre($session_array);



        $this->session->set_userdata('logged_in', $session_array);

        // user is authenticated, lets see if there is a redirect:
        if ($this->session->userdata('last_page')!== site_url('signup')) {


            $redirect_url = $this->session->userdata('last_page');  // grab value and put into a temp variable so we unset the session value
            $this->session->unset_userdata('last_page');

            redirect($redirect_url);
        } else {

            redirect(site_url('dashboard'));
        }
    }



    public function register() {

        $referral =  $this->session->userdata('referral');

        set_extra_js("Login.init();");

        add_css(array('style.css','login-soft.css','prism.css','intlTelInput.css','isValidNumber.css','tooltipster.min.css'));
        add_js(array('jquery.validate.min.js','custom_maps.js','prism.js','intlTelInput.js','isValidNumber.js','general.js','login-soft.js'));

        set_extra_js("$('.login-form').validate();");
        $data = new stdClass();
        $data->login_hs = 'Form_hide';
        $data->signup_hs = 'Form_show';
        $data->forget_hs = 'Form_hide';
        $data->reset_hs = 'Form_hide';
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->helper('cookie');
        $this->form_validation->set_rules('user[email]', 'Email', 'trim|xss_clean|required|valid_email|is_unique[users.email]', array('is_unique' => 'This Email already exists. Please login.'));
        $this->form_validation->set_rules('user[first_name]', 'First Name', 'trim|xss_clean|required|min_length[2]');
        $this->form_validation->set_rules('user[last_name]', 'Last Name', 'trim|xss_clean|required|min_length[2]');
        $this->form_validation->set_rules('user[password]', 'Password', 'trim|xss_clean|required|min_length[6]');
        $this->form_validation->set_rules('user[rpassword]', 'Confirm Password', 'trim|xss_clean|required|min_length[6]|matches[user[password]]');

        $data->fb_login_url = $this->facebook->getLoginUrl(array('redirect_uri' => site_url('Users/fblogin'),
            'scope' => array("email,public_profile")));
        $data->google_login_url = $this->googleplus->loginURL();
        $data->linkedin_login_url = $this->linkedin->getLoginUrl();

        if(isset($referral)){

            $user = $this->common->getContentById('id','users','referral',$referral);
            $referred_id = $user[0]->id;

        }
        if ($this->form_validation->run() === false) {

            $this->load->view('templates/header');
            $this->load->view('users/register', $data);
        } else {

            $user = $this->input->post('user');
            $phone = phone_formatting($this->input->post('phone'));
            $user['phone'] = $phone;
            $user['password'] = MD5($user['password']);
           // $user['hash'] = MD5(uniqid(rand(), true));
            $user['hash'] =  mt_rand(1000,9999);
            $user['oauth_provider'] = 'E-mail';
            $user['active'] = 0;
            $user['picture'] = 'default.png';
            if(isset($referral)){
                $user['referral_string']  = $referral;
                $user['referral'] = substr(md5(time()), 0, 10);
                $user['referred_by'] = $referred_id;
            }

            unset($user["rpassword"]);
            $cookie_name = "ci_user";
            $user_id = $this->Users_model->register($user);
            $cookie_value = $user_id;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            $cookie_pass = "ci_pass";
            $cookie_passval = $this->input->post('user[password]');
            setcookie($cookie_pass, $cookie_passval, time() + (86400 * 30), "/");
            $cookie_email = "ci_emai";
            $cookie_emval = $this->input->post('user[email]');
            setcookie($cookie_email, $cookie_emval, time() + (86400 * 30), "/");


            if ($user_id) {

                $url = site_url("users/verify/" . $user['hash']);
                $user_data['hash'] = $user['hash'];
                $to = $user['email'];
                $subject = 'Please confirm your e-mail address';
                $user_data['receiver_name'] = ucfirst($user['first_name']) . ' ' . $user['last_name'];
                $user_data['url'] = $url;
                $view = 'confirmation';

                sendEmail($to, $subject, $user_data, $view);

                /*if(isset($referral)){

                    $referral_data['user_id '] = $user_id;
                    $referral_data['referred_string ']  = $referral;
                    $referral_data['referred_by '] = $referred_id;
                    $this->common->commonSave('user_referrals',$referral_data);
                }*/

                $bdata['agent_id '] = $user_id;
                $bdata['balance ']  = 5;
                $bdata['views '] = 0;

                if($user['user_type'] == 'Agent'){

                    $this->common->commonSave('topup_balance',$bdata);
                }

                $this->session->set_flashdata('register_success','Code is sent to you by Email ');
                redirect(site_url('verification'));
            } else {
                $data->error = 'There was a problem creating your new account. Please try again.';
                $this->load->view('templates/header');
                $this->load->view('users/login', $data);
            }
        }
    }


    public function confirmation()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        add_css(array('style.css','login-soft.css','prism.css','intlTelInput.css','isValidNumber.css','tooltipster.min.css'));
        add_js(array('jquery.validate.min.js','custom_maps.js','prism.js','intlTelInput.js','isValidNumber.js','general.js','login-soft.js'));
        set_extra_js("$('.login-form').validate();");


        $data = new stdClass();
        $data->login_hs = 'Form_show';
        $this->load->view('templates/header');
        $this->load->view('users/code_confirmation',$data);


    }

    function reSendCode()
    {
        if ($this->session->userdata('logged_in')) { $this->logout(); }

        $cookie_name = "ci_user";
        if(isset($_COOKIE[$cookie_name])) {
            $hash = mt_rand(1000,9999);
            $attempts = $this->db->where('id', $_COOKIE[$cookie_name])->get('users')->row()->attempts;


            if($attempts < 3){
                $result = $this->Users_model->update_hash_on_resendCode($_COOKIE[$cookie_name],$hash,'is_hash' );
                if($result){

                    $user = $this->Users_model->get_user($_COOKIE['ci_user']);
                    $url = site_url("users/verify/" . $hash);
                    $user_data['hash'] = $hash;
                    $to = $user->email;
                    $subject = 'Please confirm your e-mail address';
                    $user_data['receiver_name'] = $user->first_name . ' ' . $user->last_name;
                    $user_data['url'] = $url;
                    $view = 'confirmation';
                    sendEmail($to, $subject, $user_data, $view);

                    echo json_encode(array("res" => "success", "msg" =>'Code resent successfully'));

                }else{
                    echo json_encode(array("res" => "error", "msg" =>'Something went wrong,please try again later'));
                }
            }else{
                echo json_encode(array("res" => "error", "msg" =>'Attempts Limit exceeds','query'=>$attempts));
            }
        } else {
            echo json_encode(array("res" => "error", "msg" =>'You are not authorized for this action'));
        }









    }


    function verify($hash = NULL) {


        if ($this->session->userdata('logged_in')) { $this->logout(); }

        if ($hash == NULL) { redirect('/'); }

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        // create the data object
        $data = new stdClass();

        $result = $this->Users_model->verifyEmailAddress($hash);

        $total_referrals = $result->total_referrals;

        if($result->referral){
            $user_id = $result->referred_by;
            $this->db->where('id', $user_id);
            $this->db->set('total_referrals', 'total_referrals+1', FALSE);
            $this->db->update('users');

            $this->load->helper('common_helper');
            $to = $result->email;
            $subject = 'Congrats someone used your referral code';
            $user_data = array();
            $user_data['receiver_name'] = $result->first_name;
            $view = 'referral-code';
            sendEmail($to, $subject, $user_data, $view);



        }

        if($total_referrals <= 10) {

            $user_id = $result->referred_by;
            $this->db->where('agent_id', $user_id);
            $this->db->set('balance', 'balance+5', FALSE);
            $this->db->update('topup_balance');
        }

        // pre($result);
        if ($result) {

            if($result->user_type == 'Agent'){
                $this->load->helper('common_helper');
                $to = $result->email;
                $subject = 'Welcome to Zoney';
                $user_data = array();
                $user_data['receiver_name'] = $result->first_name;
                $user_data['receiver_email'] = $_COOKIE['ci_emai'];
                $user_data['receiver_pass'] = $_COOKIE['ci_pass'];
                $view = 'welcome';
                sendEmail($to, $subject, $user_data, $view);
            }

            if($result->user_type == 'Renter'){
                $this->load->helper('common_helper');
                $to = $result->email;
                $subject = 'Welcome to Zoney';
                $user_data = array();
                $user_data['receiver_name'] = $result->first_name;
                $user_data['receiver_email'] = $_COOKIE['ci_emai'];
                $user_data['receiver_pass'] = $_COOKIE['ci_pass'];
                $view = 'welcome-user';
                sendEmail($to, $subject, $user_data, $view);
            }

            $data->success = 'E-mail Verified Successfully. Login Below';

        } else {
            $data->error = 'Email Already Verified.Please Login';
        }

        $data->fb_login_url = $this->facebook->getLoginUrl(array('redirect_uri' => site_url('Users/fblogin'),
            'scope' => array("email,public_profile")));
        $data->google_login_url = $this->googleplus->loginURL();
        $data->linkedin_login_url= $this->linkedin->getLoginUrl();
        $data->login_hs = 'Form_show';
        $data->signup_hs = 'Form_hide';
        $data->forget_hs = 'Form_hide';
        $data->reset_hs = 'Form_hide';


        $this->load->view('templates/header');
        $this->load->view('users/login', $data);
        /*$this->load->view('templates/footer');*/
    }




    public function login_status() {

        if ($this->session->userdata('logged_in') != TRUE) {
            $this->load->library('user_agent');
            $this->session->set_userdata('last_page', $this->agent->referrer());
            redirect(site_url('login'));
        }else{
            redirect(site_url('dashboard'));
        }
    }



    public function googlelogin() {

        if ($this->input->get('code')) {



            try {
                $this->googleplus->getAuthenticate();
                $guser = $this->googleplus->getUserInfo();
                $GuserID = $guser['id'];
            } catch (Exception $e) {
                $GuserID = false;
            }

            if ($GuserID) {

                $users_avatar = $this->config->item('users_avatar');
                $picture = 'g-' . $GuserID . '.jpg';

                $user = array(
                    'email' => $guser['email'],
                    'first_name' => @$guser['given_name'] ? @$guser['given_name'] : '',
                    'last_name' => @$guser['family_name'] ? @$guser['family_name'] : '',
                    'oauth_provider' => 'Google',
                    'oauth_uid' => $GuserID,
                    'active' => 1,
                    'gender' => @$guser['gender'] ? ucfirst(@$guser['gender']) : 'Male'
                );

                $user_record = $this->Users_model->social_login($user);

                if ($user_record) {
                    $this->user_login_session($user_record);
                } else {

                    $user_id = $this->Users_model->register($user);

                    if ($user_id) {

                        $bdata['agent_id '] = $user_id;
                        $bdata['balance ']  = 5;
                        $bdata['views '] = 0;

                        $this->common->commonSave('topup_balance',$bdata);

                        //Save picture

                        $file = $users_avatar . '/' . $picture;
                        //file_put_contents($file, file_get_contents($guser['picture']));
                        if (copy($guser['picture'], $file)) {


                            $this->load->library('image_lib');

                            // to re-size for thumbnail images
                            $config = array(
                                'source_image' => $file,
                                'new_image' => $users_avatar . 'small',
                                'quality' => '100%',
                                'maintain_ratio' => false,
                                'width' => 100,
                                'height' => 100
                            );

                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();

                            // to re-size for thumbnail images
                            $config = array(
                                'source_image' => $file,
                                'new_image' => $users_avatar . 'medium',
                                'quality' => '100%',
                                'maintain_ratio' => false,
                                'width' => 225,
                                'height' => 225
                            );

                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();

                            $this->Users_model->edit_profile(array('picture' => $picture), $this->Users_model->social_login($user)->id);
                            $this->user_login_session($this->Users_model->social_login($user));
                        } else {
                            $this->user_login_session($this->Users_model->social_login($user));
                        }
                    }
                }
            }
        }

        // create the data object
        $data = new stdClass();

        $data->login_hs = 'Form_show';
        $data->signup_hs = 'Form_hide';
        $data->forget_hs = 'Form_hide';
        $data->reset_hs = 'Form_hide';

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data->fb_login_url = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('users/fblogin'),
            'scope' => array("email,public_profile") // permissions here
        ));
        $data->google_login_url = $this->googleplus->loginURL();
        $data->linkedin_login_url= $this->linkedin->getLoginUrl();

        $data->error = 'Something wrong please try again';
        $this->load->view('templates/header');
        $this->load->view('users/login', $data);
        $this->load->view('templates/footer');
    }

    public function fbhhhhlogin() {

        // create the data object
        $data = new stdClass();

        $data->login_hs = 'Form_show';
        $data->signup_hs = 'Form_hide';
        $data->forget_hs = 'Form_hide';
        $data->reset_hs = 'Form_hide';

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data->fb_login_url = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('api/fblogin'),
            'scope' => array("email,public_profile") // permissions here
        ));
        $data->google_login_url = $this->googleplus->loginURL();
        $data->linkedin_login_url= $this->linkedin->getLoginUrl();


        $userID = $this->facebook->getUser();

        if ($userID) {
            try {
                $fbuser = $this->facebook->api('/' . $userID . '?fields=email');
            } catch (FacebookApiException $e) {
                $fbuser = false;
            }
        }
        if ($userID && $fbuser && $fbuser['email'] != NULL) {

            $users_avatar = $this->config->item('users_avatar');

            $user = array(
                'email' => $fbuser['email'],
                'first_name' => @$fbuser['first_name'] ? @$fbuser['first_name'] : '',
                'last_name' => @$fbuser['last_name'] ? @$fbuser['last_name'] : '',
                'address' => @$fbuser['location'] ? @$fbuser['location'] : '',
                'city' => @$fbuser['hometown'] ? @$fbuser['hometown'] : '',
                'oauth_provider' => 'Facebook',
                'oauth_uid' => $fbuser['id'],
                'about' => @$fbuser['about'] ? @$fbuser['about'] : '',
                'active' => 1,
                'gender' => @$fbuser['gender'] ? ucfirst(@$fbuser['gender']) : 'Male'
            );
            pre($user);

            $user_record = $this->api->social_login($user);

            if ($user_record) {
                $this->user_login_session($user_record);
            } else {
                $user_id = $this->api->register($user);
                if ($user_id) {
                    $bdata['agent_id '] = $user_id;
                    $bdata['balance ']  = 5;
                    $bdata['views '] = 0;
                    $this->common->commonSave('topup_balance',$bdata);

                    $file = $users_avatar . '/' . $userID . '.jpg';
                    //file_put_contents($file, file_get_contents('https://graph.facebook.com/' . $userID . '/picture?type=large'));
                    if (copy("http://graph.facebook.com/" . $userID . "/picture?width=9999&height=9999", $file)) {

                        $this->load->library('image_lib');

                        // to re-size for thumbnail images
                        $config = array(
                            'source_image' => $file,
                            'new_image' => $users_avatar . 'small',
                            'quality' => '100%',
                            'maintain_ratio' => false,
                            'width' => 100,
                            'height' => 100
                        );

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        // to re-size for thumbnail images
                        $config = array(
                            'source_image' => $file,
                            'new_image' => $users_avatar . 'medium',
                            'quality' => '100%',
                            'maintain_ratio' => false,
                            'width' => 225,
                            'height' => 225
                        );

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->Users_model->edit_profile(array('picture' => $userID . '.jpg'), $this->Users_model->social_login($user)->id);
                        $this->user_login_session($this->api->social_login($user));
                    } else {
                        $this->user_login_session($this->api->social_login($user));
                    }
                }
            }
        }


        $data->error = 'There is problems with your facebook account.';
        $this->load->view('templates/header');
        $this->load->view('users/login', $data);
        $this->load->view('templates/footer');
    }

    public function linkedinlogin(){
        $userData = array();

        //Get status and user info from session
        $oauthStatus = $this->session->userdata('oauth_status');
        $sessUserData = $this->session->userdata('userData');

        if(isset($oauthStatus) && $oauthStatus == 'verified' && isset($userData['oauth_uid'])){
            //User info from session
            $userData = $sessUserData;

        }elseif($this->input->get('oauth_init') || $this->input->get('code') || ($this->input->get('oauth_token') && $this->input->get('oauth_verifier'))) {

            try {
                $this->linkedin->getAuthenticate();
                $userinfo = $this->linkedin->getUserInfo();
                 //print_r($this->linkedin->userinfo);

                //Preparing data for database insertion
                $first_name = !empty($userinfo->firstName) ? $userinfo->firstName : '';
                $last_name = !empty($userinfo->lastName) ? $userinfo->lastName : '';
                $userData = array(
                    'oauth_provider' => 'linkedin',
                    'oauth_uid' => $userinfo->id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $userinfo->emailAddress,
                    'locale' => $userinfo->location->name,
                    'profile_url' => $userinfo->publicProfileUrl,
                    'picture_url' => $userinfo->pictureUrl
                );
                // echo '<pre>';print_r($userData);die('here');
                //Insert or update user data
                // $userID = $this->user->checkUser($userData);

                //Store status and user profile info into session
                $this->session->set_userdata('oauth_status', 'verified');
                $this->session->set_userdata('userData', $userData);


            } catch (Exception $e) {
                print_r($e);

            }


        }
if($userData['email']){
                $users_avatar = $this->config->item('users_avatar');
                $picture = 'li-' . $userData['oauth_uid'] . '.jpg';

                $user = array(
                    'email' => $userData['email'],
                    'first_name' => $userData['first_name'],
                    'last_name' => $userData['last_name'],
                    'oauth_provider' => $userData['oauth_provider'],
                    'oauth_uid' => $userData['oauth_uid'],
                    'active' => 1,
                    'location' => $userData['locale']
                );

                $user_record = $this->Users_model->social_login($user);

                if ($user_record) {
                    $this->user_login_session($user_record);
                } else {

                    $user_id = $this->Users_model->register($user);

                    if ($user_id) {

                        $bdata['agent_id '] = $user_id;
                        $bdata['balance ']  = 5;
                        $bdata['views '] = 0;

                        $this->common->commonSave('topup_balance',$bdata);

                        //Save picture

                        $file = $users_avatar . '/' . $picture;
                        //file_put_contents($file, file_get_contents($guser['picture']));
                        if (copy($userData['picture_url'], $file)) {


                            $this->load->library('image_lib');

                            // to re-size for thumbnail images
                            $config = array(
                                'source_image' => $file,
                                'new_image' => $users_avatar . 'small',
                                'quality' => '100%',
                                'maintain_ratio' => false,
                                'width' => 100,
                                'height' => 100
                            );

                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();

                            // to re-size for thumbnail images
                            $config = array(
                                'source_image' => $file,
                                'new_image' => $users_avatar . 'medium',
                                'quality' => '100%',
                                'maintain_ratio' => false,
                                'width' => 225,
                                'height' => 225
                            );

                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();

                            $this->Users_model->edit_profile(array('picture' => $picture), $this->Users_model->social_login($user)->id);
                            $this->user_login_session($this->Users_model->social_login($user));
                        } else {
                            $this->user_login_session($this->Users_model->social_login($user));
                        }
                    }
                }
            }



        // create the data object
        $data = new stdClass();

        $data->login_hs = 'Form_show';
        $data->signup_hs = 'Form_hide';
        $data->forget_hs = 'Form_hide';
        $data->reset_hs = 'Form_hide';

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data->fb_login_url = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('users/fblogin'),
            'scope' => array("email,public_profile") // permissions here
        ));
        $data->google_login_url = $this->googleplus->loginURL();
        $data->linkedin_login_url= $this->linkedin->getLoginUrl();

        $data->error = 'Something wrong please try again';
        $this->load->view('templates/header');
        $this->load->view('users/login', $data);
        $this->load->view('templates/footer');
    }

    public function logout() {

        add_css(array('login-soft.css','prism.css','intlTelInput.css','isValidNumber.css','tooltipster.min.css'));
        add_js(array('jquery.validate.min.js','custom_maps.js','prism.js','intlTelInput.js','isValidNumber.js','general.js','login-soft.js'));

        // create the data object
        $data = new stdClass();

        $data->login_hs = 'Form_show';
        $data->signup_hs = 'Form_hide';
        $data->forget_hs = 'Form_hide';
        $data->reset_hs = 'Form_hide';

        //session_destroy();
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('listing');

        $this->session->unset_userdata('oauth_status');
        $this->session->unset_userdata('userData');


        $data->fb_login_url = $this->facebook->getLoginUrl(array('redirect_uri' => site_url('Users/fblogin'),
            'scope' => array("email,public_profile")));
        $data->google_login_url = $this->googleplus->loginURL();
        $data->linkedin_login_url= $this->linkedin->getLoginUrl();

        $this->load->helper('form');
        $this->load->view('templates/header');
        $this->load->view('users/login', $data);
        /* $this->load->view('templates/footer');*/
    }

    function password($hash = NULL) {

        if ($hash == NULL) {

            redirect('/');
        }

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        // create the data object
        $data = new stdClass();

        $id = $this->Users_model->CheckEmailAddress($hash);

        if ($id) {

            $data->login_hs = 'Form_hide';
            $data->signup_hs = 'Form_hide';
            $data->forget_hs = 'Form_hide';
            $data->reset_hs = 'Form_show';

            $data->hashvalue = $hash;


            $this->load->view('templates/header');
            $this->load->view('users/reset_password', $data);
            //$this->load->view('templates/footer');
        } else {

            $data->error = 'Sorry Unable to reset your password!';

            $data->login_hs = 'Form_hide';
            $data->signup_hs = 'Form_hide';
            $data->forget_hs = 'Form_show';
            $data->reset_hs = 'Form_hide';


            $this->load->view('templates/header');
            $this->load->view('users/forget', $data);
           /* $this->load->view('templates/footer');*/
        }
    }


    function verification() {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));

            // load form helper and validation library
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('verification[country]', 'Country', 'trim|required');
            $this->form_validation->set_rules('verification[document_type]', 'Document Type', 'trim|required');
            if (empty($_FILES['document_front']['name'])) {
                $this->form_validation->set_rules('document_front', 'Document Front Side', 'trim|required');
            } if (empty($_FILES['document_back']['name'])) {
                $this->form_validation->set_rules('document_back', 'Document Back Side', 'trim|required');
            }

            // create the data object
            $data = new stdClass();

            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];
            $data->VerificationStatus = $this->Users_model->VerificationStatus($uid);

            $this->seo->SetValues('Title', "Verify Your ID - Zoney");

            if ($this->form_validation->run() == false) {

                $this->load->view('templates/header');
                $this->load->view('users/verification', $data);
                $this->load->view('templates/footer');
            } else {

                $verification = $this->input->post('verification');

                $config['upload_path'] = 'assets/media/verification/';
                $config['allowed_types'] = 'jpeg|jpg|png|pdf|doc|docx';
                $config['encrypt_name'] = true;

                if (isset($_FILES['document_front']) && $_FILES['document_front']['size'] > 0) {

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('document_front')) {

                        $upload_data = $this->upload->data();
                        $verification['document_front'] = $upload_data['file_name'];
                    } else {
                        $data->error = $this->upload->display_errors();
                    }
                }

                if (isset($_FILES['document_back']) && $_FILES['document_back']['size'] > 0) {

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('document_back')) {

                        $upload_data = $this->upload->data();
                        $verification['document_back'] = $upload_data['file_name'];
                    } else {
                        $data->error = $this->upload->display_errors();
                    }
                }

                $verification['status'] = 'pending';
                $verification['user_id'] = $uid;

                if ($this->Users_model->TrustVerification($verification)) {
                    $data->success = 'Form Submitted successfully';
                    $this->form_validation->resetpostdata(true);
                } else {
                    $data->error = 'Some thing wrong! Please try again';
                }

                $data->VerificationStatus = $this->Users_model->VerificationStatus($uid);

                $this->load->view('templates/header');
                $this->load->view('users/verification', $data);
                $this->load->view('templates/footer');
            }
        } else {
            redirect('/');
        }
    }

    function notifications() {

        if ($this->session->userdata('logged_in')) {

            $this->load->model('Inbox_model');

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));

            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];

            $this->seo->SetValues('Title', $session_data['full_name'] . "'s Notifications - Zoney");

            // create the data object
            $data = new stdClass();
            $this->Inbox_model->UpdateNotificationsStatus($uid); //Update status
            $data->notifications = $this->Inbox_model->get_notification($uid);

            $this->load->view('templates/header');
            $this->load->view('users/notifications', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function payment_methods() {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));

            // create the data object
            $data = new stdClass();
            //$data->extra_js = 'Inbox.init();';

            $this->load->view('templates/header');
            $this->load->view('users/payment_methods', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function preferences() {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));

            // create the data object
            $data = new stdClass();
            //$data->extra_js = 'Inbox.init();';

            $this->load->view('templates/header');
            $this->load->view('users/preferences', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function transactions() {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js', 'general.js'));

            // create the data object
            $data = new stdClass();
            $session_data = $this->session->userdata('logged_in');

            $this->seo->SetValues('Title', $session_data['full_name'] . "'s Transaction History - Zoney");

            $data->transactions = $this->Users_model->transactions($session_data['id']);
            $data->funds = $this->Users_model->all_funds($session_data['id'], date('Y-m-d'));

            $this->load->view('templates/header');
            $this->load->view('users/transactions', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function get_tranactions_by_date() {

        $date = $this->input->post('id');
        $data = new stdClass();

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $data->transactions = $this->Users_model->getTransactionsByDate($date, $session_data['id']);
            $this->load->view('users/transaction_partial', $data);
        }
    }

    function privacy() {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));

            // create the data object
            $data = new stdClass();
            //$data->extra_js = 'Inbox.init();';

            $this->load->view('templates/header');
            $this->load->view('users/privacy', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }

    function password_update() {

        if ($this->session->userdata('logged_in')) {
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));
            $data = new stdClass();
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->seo->SetValues('Title', "Password Update - Zoney");

            $this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('rpassword', 'Confirm Password', 'trim|required|min_length[8]|matches[password]');

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header');
                $this->load->view('users/passwordupdate', $data);
                $this->load->view('templates/footer');
            } else {

                $oldpassword = $this->input->post('oldpassword');
                $newpassword = $this->input->post('password');
                $session_data = $this->session->userdata('logged_in');

                if ($this->Users_model->UpdateOldPassword($session_data['id'], MD5($oldpassword), MD5($newpassword))) {
                    // echo $this->db->last_query();
                    $data->success_password = 'Password Updated successfully.';
                    $this->load->library('Form_validation');
                    $this->form_validation->resetpostdata(true);
                    $this->load->view('templates/header');
                    $this->load->view('users/edit_profile', $data);
                    $this->load->view('templates/footer');
                } else {

                    //login failed
                    $data->error = 'Wrong old Password!';
                    $this->load->view('templates/header');
                    $this->load->view('users/edit_profile', $data);
                    $this->load->view('templates/footer');
                }
            }
        } else {
            redirect('/');
        }
    }

    function settings() {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));

            // create the data object
            $data = new stdClass();
            //$data->extra_js = 'Inbox.init();';

            $this->load->view('templates/header');
            $this->load->view('users/settings', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('/');
        }
    }



    function avatar()
    {

        if (!($this->session->userdata('logged_in')))
        {
            redirect('/');
        }

        $this->load->helper('form');
        //Add Js/Css
        add_css(array('light.css', 'jquery.fileupload.css', 'jquery.fileupload-ui.css', 'jquery.cropbox.css'));
        add_js(array('jquery.slimscroll.min.js', 'jquery.mousewheel.min.js', 'jquery.cropbox.js'));

        // create the data object
        $data = new stdClass();



        $session_data = $this->session->userdata('logged_in');


        $uid = $session_data['id'];
        $data->profile_medium_thumbnail = $session_data['picture'];
        $data->profile_picture = $session_data['thumb'];
        $users_avatar = $this->config->item('users_avatar');
        $data->users_avatar = $users_avatar;

        $this->seo->SetValues('Title', $session_data['full_name'] . "'s Profile - Zoney");




        if( isset($_FILES['userfile']) && $_FILES['userfile']['size'] > 0 )
        {

            $config['upload_path'] = $users_avatar;
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['encrypt_name'] = true;
            $config['max_size'] = 0;
            $config['max_width'] = 0;
            $config['max_height'] = 0;

            $this->load->library('upload', $config);
            $this->load->library('image_lib');

            if( $this->upload->do_upload() )
            {
                $upload_data = $this->upload->data();
                $picture_name = $upload_data['file_name'];
                // Store Cropped Image Thumb
                If (strlen($this->input->post('image_info')) > 2) {
                    $cropped_thumb = $this->input->post('image_info');
                    $cropped = json_decode($cropped_thumb, true);
                    $base64_string = str_replace('data:image/png;base64', '', $cropped[0]['image']);
                    $filename_path = md5(time() . uniqid()) . ".jpg";

                    $decoded = base64_decode($base64_string);
                    file_put_contents($users_avatar . "/crop/" . $picture_name, $decoded);

                    $config = array(
                        'source_image' => $upload_data['file_path'] . "crop/" . $picture_name,
                        'new_image' => $users_avatar . 'crop',
                        'quality' => '100%',
                        'maintain_ratio' => false,
                        'width' => 150,
                        'height' => 150
                    );

                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }


                // to re-size for thumbnail images
                $config = array(
                    'source_image' => $upload_data['file_path'] . "crop/" . $picture_name,
                    'new_image' => $users_avatar . 'small',
                    'quality' => '100%',
                    'maintain_ratio' => false,
                    'width' => 100,
                    'height' => 100
                );

                $this->image_lib->initialize($config);
                $this->image_lib->resize();

                // to re-size for thumbnail images
                $config = array(
                    'source_image' => $upload_data['full_path'],
                    'new_image' => $users_avatar . 'medium',
                    'quality' => '100%',
                    'maintain_ratio' => false,
                    'width' => 225,
                    'height' => 225
                );

                $this->image_lib->initialize($config);
                $this->image_lib->resize();

                $response = $this->Users_model->edit_profile(array('picture' => $picture_name), $uid);
                if ($response) {
                    $logged_in = $this->session->userdata('logged_in');
                    $logged_in['picture'] = $users_avatar . "medium/" . $picture_name;
                    $logged_in['thumb'] = $users_avatar . "small/" . $picture_name;
                    $logged_in['cropped'] = $users_avatar . "crop/" . $picture_name;
                    $this->session->set_userdata('logged_in', $logged_in);

                    $user = $this->Users_model->get_user($session_data['id']);

                    $data->user = $user;
                    $logged_in = $this->session->userdata('logged_in');
                    $logged_in['first_name'] = (string) $user->first_name;
                    $logged_in['last_name'] = (string) $user->last_name;
                    $logged_in['full_name'] = (string) $user->first_name . " " . $user->last_name;
                    $this->session->set_userdata('logged_in', $logged_in);

                    $to = $user->email;
                    $subject = 'Avatar Update successfully';

                    $user_data = array();
                    $user_data['first_name'] = $user->first_name;
                    $user_data['update_date'] = date('M d, Y');
                    $user_data['update_time'] = date('h:i a');
                    $user_data['flag'] = 'avatar';
                    $view = 'profile_update';
                    $data->profile_medium_thumbnail = $users_avatar . "crop/" . $picture_name;

                    sendEmail($to, $subject, $user_data, $view);
                    $data->success = 'Profile Picture Update successfully.';
                } else {
                    $data->error = 'Some thing Wrong.';
                }

                $session_data = $this->session->userdata('logged_in');
                $data->profile_picture = $session_data['thumb'];

                $this->load->view('templates/header');
                $this->load->view('users/avatar', $data);
                $this->load->view('templates/footer');
            } else {

                $data->error = $this->upload->display_errors();
                $this->load->view('templates/header');
                $this->load->view('users/avatar', $data);
                $this->load->view('templates/footer');
            }
        } else {

            $this->load->view('templates/header');
            $this->load->view('users/avatar', $data);
            $this->load->view('templates/footer');
        }
    }

    function widthdraw_funds() {

        $session_data = $this->session->userdata('logged_in');
        $uid = $session_data['id'];
        $amount = $this->input->post('withdraw_amount');
        $account_email = $this->input->post('recipient_email');
        $description = $this->input->post('message_box');
        $status = 'initiate';
        $data = array('uid' => $uid, 'amount' => $amount, 'paypal_email' => $account_email, 'description' => $description, 'status' => $status);
        $result = $this->Users_model->widthdrawFunds($data);
        $transactions_data = array('user_id' => $uid, 'booking_id' => $result, 'transaction_type' => 'Debit', 'description' => 'Your Withdrawal request has been initiated', 'amount' => $amount, 'status' => 'ok', 'process_date' => date('Y-m-d'));
        $this->Users_model->add_withdraw_transaction($transactions_data);
        echo $result;
    }

    function verify_funds_amount() {
        $data = new stdClass();
        $session_data = $this->session->userdata('logged_in');
        $data->funds = $this->Users_model->all_funds($session_data['id'], date('Y-m-d'));
        foreach ($data->funds as $funds) {
            echo $availble_amount = ($funds->a_credits - $funds->a_debits);
        }
    }

}
