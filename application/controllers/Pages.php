<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Pages extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Listings_model', 'listing', true);
        $this->load->model('Common_model', 'common', true);
        set_extra_js("ComponentsPickers.init();");
    }

    public function view($page) {

        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) {

            $data['topmenu'] = "session_topmenu";
        }
        add_js(array('jquery.slimscroll.min.js','jquery.validate.min.js','general.js'));
        $select = "id,page_title,page_desc,slug,page_desc";
        $data['page'] = $this->common->get_row_with_specific_data($select, 'pages', 'slug', $page);

        $data['home_types'] = $this->listing->home_types_search();
        $data['amenities']  = $this->listing->amenities();


        $this->seo->SetValues('Title', ucfirst($data['page']->page_title) . " - Neighborty");
        $this->load->view('templates/header');
      

       if ($data['page']) {

            $this->load->view('pages/content', $data);
        } else {
            redirect('/404_override');
        }

        $this->load->view('templates/footer');
    }

    public function load_page_data(){

        $this->load->helper('text');

        $slug = $this->input->post('slug');

        if($slug == 'press'){

            $select = "id,title,description,created_at";

            $data['press']= $this->common->getAllContent($select, 'press');
            $this->load->view('pages/content-press',$data);

        }
        else if($slug == 'stories'){
 
            $select = "id,title,description,image";

            $data['stories']= $this->common->getAllContent($select, 'stories');
            $this->load->view('pages/content-stories',$data);
        }
        else{

            $select = "id,page_title,page_desc,slug,page_desc";
            $data['page']= $this->common->get_row_with_specific_data($select, 'pages', 'slug', $slug);
            $this->load->view('pages/ajax_content',$data);
        }


    }

    public function stories(){

        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) {

            $data['topmenu'] = "session_topmenu";

            //} else {
            //    redirect('/login');
        }

        $select = "id,title,description,image";
        $data['stories']= $this->common->getAllContent($select, 'stories');
		$data['img_path']=base_url().$this->config->item('media_url').'stories/';
        $data['home_types'] = $this->listing->home_types_search();
        $data['amenities']  = $this->listing->amenities();
        $this->load->view('templates/header');
        $this->load->view('pages/stories',$data);
        $this->load->view('templates/footer');

    }

    public function press(){
        $this->load->helper('text');

        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) {

            $data['topmenu'] = "session_topmenu";

            //} else {
            //    redirect('/login');
        }


        $select = "id,title,description,created_at";
        $data['press']= $this->common->getAllContent($select, 'press');

        $data['home_types'] = $this->listing->home_types_search();
        $data['amenities']  = $this->listing->amenities();

        $this->load->view('templates/header');
        $this->load->view('pages/press',$data);
        $this->load->view('templates/footer');



    }

}
