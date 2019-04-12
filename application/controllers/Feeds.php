<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Index class.
 *
 * @extends CI_Controller
 */
class Feeds extends CI_Controller {

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */

    public function __construct() {

        parent::__construct();
        $this->load->model('common_model', 'common', true);
        $this->load->model('Feeds_model', 'feeds', true);
        $this->output->enable_profiler(FALSE);



    }
    private $perPage = 10;
    public function index()
    {
      if ($this->session->userdata('logged_in')) {

          $data = new stdClass();
          $session_data_user = $this->session->userdata('logged_in');
          $uid = $session_data_user['id'];
          $data->topmenu = "topmenu";
          $this->benchmark->mark('feeds_start');
          $data->users_avatar = $this->config->item('users_avatar');
          add_js(array('agent_feeds.js', 'custom_maps.js'));

          $limit = array('start' => 0, 'page' => $this->perPage);
          $data->feeds = $this->feeds->get_feeds($uid, $limit);
          $data->listings = $this->feeds->agent_related_listings($uid);
          $data->follow = $this->feeds->follow_agent_suggestions($uid);

          $where = array('id' => $uid, 'user_type' => 'Agent');

          $data->user = $this->common->get_latest_row_by_id('id,followers_count', 'users', $where);
          $this->seo->SetValues('Title', "Agent - Feeds");

          $q = array('user_id' => $uid);
          $data->listing_stats = $this->common->get_latest_row_by_id('sales,sold,rental', 'user_stats', $q);
          $this->load->view('templates/header');
          $this->load->view('front_end/agent_home', $data);
          $this->load->view('templates/footer');

          $this->benchmark->mark('feeds_end');

      }else{
          redirect(site_url('login'));
      }
    }


    public function more_feeds()
    {
        $data = new stdClass();
        $session_data_user = $this->session->userdata('logged_in');
        $uid = $session_data_user['id'];

        if(!empty($this->input->get_post('page'))){

          $start = ceil($this->input->get_post("page") * $this->perPage);


          $limit = array('start' => $start, 'page' => $this->perPage);
          $data->feeds = $this->feeds->get_feeds($uid,$limit);

          $result = $this->load->view('includes/agents/latest_feeds', $data);

        }

    }

    public function following_user()
    {

        if ($this->session->userdata('logged_in')) {

            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];


            if (isset($_POST['follow'])) {

                $id = $_POST['follow'];
                $data['follower_id '] = $uid;
                $data['following_id ']  = $id;
                $this->common->commonSave('follow',$data);
                $this->common->incr_counter($uid);
                $this->feeds->user_following_stats($uid,$id);
            }

            if (isset($_POST['Unfollow'])) {

                $id = $_POST['Unfollow'];
                $this->common->delete_row('follow','following_id',$id);
                $this->common->desc_counter($uid);
                $this->feeds->update_stats($uid,$id);

            }
        } else{

            redirect("/login");
        }


    }

    public function submit_feed()
    {

        $session_data_listing = $this->session->userdata('listing');
        if ($this->session->userdata('logged_in'))
        {


            $this->load->helper('form');

            if (isset($_FILES['userfile']) && $_FILES['userfile']['size'] > 0) {

                $image = $this->do_upload();
            }

            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            $this->load->helper('form');
            $ip = $_SERVER['REMOTE_ADDR'];

            $data = array('description' => $this->input->post('description'),
                'poster_id' => $uid,
                'image'=>$image,
                'ip_address' => $ip
            );

            $this->common->commonSave('feeds',$data);

        }
    }

    function do_upload()
    {
        $feed_images = $this->config->item('feed_images');

        $config['upload_path']          = $feed_images;
        $config['allowed_types']        = 'gif|jpg|png|zip|rar|pdf';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload()) {
            $this->load->library('image_lib');
            $data = $this->upload->data();

            $config = array(
                'source_image' => $data['full_path'],
                'new_image' => $feed_images . 'thumbs',
                'quality' => '70%',
                'maintain_ratio' => true,
                'width' => 530

            );
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            return $thumbURL = $feed_images . 'thumbs/' . $data['file_name'];

        }
    }


    public function feeds_cron()
    {
        $this->feeds->check_feed_status();

    }


}
