<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Cron class.
 * 
 * @extends CI_Controller
 */
class Cron extends CI_Controller {

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    
    public function __construct() {

        parent::__construct();
        if (!$this->input->is_cli_request()) show_error('Direct access is not allowed');
        $this->load->model(array('Cron_model','Listings_model'));

    }

    public function index() {

        $this->Cron_model->alter_transaction_status();
        $result = $this->Cron_model->set_feedback_status();
        
        if(!empty($result)){
            foreach($result as $row){
                $listing = $this->Listings_model->get_list($row->listing_id);

                $data = array(
                          'receiver_id'=>$row->guest_id,
                          'sender_id' =>$row->host_id,
                          'type'=>'Inbox',
                          'message' =>'Please leave a feedback regarding your listing ' .ucfirst($listing->listing_name),
                          'listing_id' =>$row->listing_id,
                          'check_in'=>$row->check_in,
                          'check_out'=>$row->check_out,
                          'guest'=>$row->total_guest,
                          'read_status' =>0,
                    );

                $this->Cron_model->saveMessage($data);
                SendDefaultMessage($row->guest_id, 'Please Leave Feeback', 'Please leave a feedback regarding your listing ' .ucfirst($listing->listing_name), 'Leave Feedback');

            }
        }
       
    }
   
}
