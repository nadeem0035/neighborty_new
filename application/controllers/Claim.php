<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class Claim extends CI_Controller {

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */

    public function __construct() {

        parent::__construct();
        $this->load->model('Users_model','users',true);
        $this->load->model('Common_model','common',true);


    }



    function claim_user($id)
    {
        echo $id;
    }


    // Claim User

    function index($id) {


        $data['topmenu'] = "topmenu";
        $id = encryptor('decrypt',$id);

       if (!empty($id)){

            if ($this->session->userdata('logged_in')) {

               $data['topmenu'] = "session_topmenu";

            }
            add_js(array('jquery.validate.min.js'));
            $data['id'] = $id;

            $this->seo->SetValues('Title', "About Us - Neighborty");
            $this->load->view('templates/header');
            $this->load->view('includes/claim/claim-form', $data);
            $this->load->view('templates/footer');
       }
       else{

           redirect($_SERVER['HTTP_REFERER']);

       }

    }






    function claim_varification()
    {

        $arr = array('email'=> $this->input->post('working_email'),'first_name' => $this->input->post('first_name'),'last_name'=> $this->input->post('last_name'),'phone'=> $this->input->post('phone'),'agent_id'=>$this->input->post('agent_id'),'claim_type'=>'Agent','status'=>0);


        $this->common->commonSave('claims',$arr);

        $id = $this->input->post('agent_id');
        $email = $this->input->post('working_email');


        if (isset($id) && !empty($id)) {

            $user = $this->users->get_user($id);
            $data['name'] = $user->first_name.' '.$user->last_name;


            // Email to user who is claiming this
            $user_data = array();
            $user_data['name'] = $user->first_name. ' ' .$user->last_name;

            //$to = 'asim.shahzad20@gmail.com';
            $to = $email;
            $subject = 'Claim Confirmation';
            $view = 'claim_confirmation';

            sendEmail($to, $subject, $user_data, $view);


        }

            // Email to Admin

            $user_data = array();
            $user_data['name'] = $user->first_name. ' ' .$user->last_name;

            $to = 'asim.shahzad20@gmail.com';
            $subject = 'You have got a new claim';
            $view = 'claim_admin';

            sendEmail($to, $subject, $user_data, $view);

            $data['agent_name'] = $user->first_name.' '.$user->last_name;
            $data['city'] = $user->city;
            $data['state'] = $user->state;
            $data['picture'] = $user->picture;
            $data['agent_type'] = $user->agent_type;


            $this->claim_confirmation_view($data);
           // redirect('claim/claim_confirmation_view',$data);


    }

    function claim_confirmation_view($data)
    {
        $data['topmenu'] = "topmenu";

         if ($this->session->userdata('logged_in')) {

               $data['topmenu'] = "session_topmenu";
        }


        $data['agent_name'] = $data['agent_name'];
        $data['city'] = $data['city'];
        $data['state'] = $data['state'];
        $data['picture'] = $data['picture'];
        $data['agent_type'] = $data['agent_type'];
        $this->seo->SetValues('Title', "Claim Confirmation - Neighborty");
        $this->load->view('templates/header');
        $this->load->view('includes/claim/verify', $data);
        $this->load->view('templates/footer');

    }



}
