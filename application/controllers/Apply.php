<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class Apply extends CI_Controller
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
                $this->load->model('Common_model', 'common', true);

	}

	public function index()
	{
		$data['topmenu'] = "topmenu";
		if ($this->session->userdata('logged_in'))
		{
			$data['topmenu'] = "session_topmenu";
		}
		else
		{
			redirect('/login');
		}
        add_js(array('jquery.slimscroll.min.js','jquery.validate.min.js','applications.js','general.js'));
		$user_id = $_SESSION['logged_in']['id'];
		$data['application'] = $this->common->get_result('rental_application','user_id',$user_id);

		$this->load->view('front_end/apply', $data);
	}

	public function save_do()
	{
		// sleep(5);
		// pre($_SESSION);
		if( !isset($_SESSION['logged_in']['id']) || $_SESSION['logged_in']['id'] == NULL || $_SESSION['logged_in']['id'] == 0 )
			return msg_danger('You have logged out. Please relogin to save changes.');


		$table = 'rental_application';
		$what_to_do = array(
						'table' => $table,
						'field' => 'user_id',
						'value' => $_SESSION['logged_in']['id'],
						);




		$what_to_do = $this->crud_model->finalizeInsertUpdate($what_to_do);
		// vde($what_to_do);
		if( $what_to_do == 'do_insert' )
		{
			$content = json_encode($_POST);
			$data = array(
						'user_id' => $_SESSION['logged_in']['id'],
						'content' => $content,
						'timestamp' => 'yes',
					);

			$processed_query = post_query($data, $table);
			 //pre($processed_query);
			$result = $this->crud_model->add( array('query'=>$processed_query) );
			echo $result;
		}

		if( $what_to_do == 'do_update' )
		{
			$content = json_encode($_POST);
			$data = array(
						'content' => $content,
						'timestamp' => 'yes',
					);

			$processed_query = update_query($data, $table, 'user_id = '.$_SESSION['logged_in']['id']);
			// pre($processed_query);

			$result = $this->crud_model->update( array('query'=>$processed_query) );
			echo $result;
		}


	}

    function upload_document() {

        $upath = $this->config->item('bank_document');
        $config['upload_path'] = $upath;
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = TRUE;




        if (isset($_FILES['file']['name'])) {



            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload' . $_FILES['file']['error'];
            } else {
                if (file_exists('uploads/' . $_FILES['file']['name'])) {
                    echo 'File already exists : uploads/' . $_FILES['file_payslip']['name'];
                } else {
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('file')) {
                        echo $this->upload->display_errors();
                    } else {
                        $upload_data = $this->upload->data();
                        echo $file_name = $upload_data['file_name'];
                    }
                }
            }


        } else {
            echo 'Please choose a file';
        }



    }

    public function view($id)
	{
        if( empty( $this->uri->segment(3) ) )
			exit('Invalid Request');

		$id = $this->uri->segment(3);
		$data['application'] =  $this->common->get_result('rental_application','user_id',$id);
		// pre($data['application']);

		$this->load->view('front_end/apply_view_applicant', $data);

	}
    public function update_count()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data_user = $this->session->userdata('logged_in');
            $user_id = $session_data_user['id'];
            $totalcount = $this->input->get_post('count');
            $data = array('iscomplete'=>$totalcount);
            $result = $this->common->commonUpdate('rental_application', $data,'user_id',$user_id );
            if($result){
                echo 1;
            }else{
                echo 0;
            }

        }

    }

}
