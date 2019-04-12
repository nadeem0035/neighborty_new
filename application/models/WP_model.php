<?php

/**
 * @since July - 2013
 * @author: Fernando Porazzi - twitter @fernandoporazzi
 * @see http://ellislab.com/codeigniter/user-guide/database/active_record.html
 */

/**
 * Set the number of posts you want to retrieve from you WP database
 * Set the amount of images for every single post
 */

class WP_model extends CI_Model {

    public function __construct(){
        parent::__construct();

        $db = $this->load->database('wordpress', TRUE);
        //$this->load->config('wordpress');
        //Database is autoloaded
      //  $this->db = $this->load->database('biginc_wrdp14', true);


    }

    private $postLimit = 2;
    private $imagesPerPost = 1;

    public function getPosts () {
        $this->db->where('wp_posts.post_parent', 0);
        $this->db->where('wp_posts.post_status', 'publish');
        $this->db->limit($this->postLimit);
        $this->db->order_by('post_date', 'DESC');

        $query = $this->db->get('wp_posts');

        $data = $query->result();

        $post = array();

        for ($i = 0; $i < count($data); $i++) {
            array_push($post,
                array(
                    'post' => $data[$i],
                    'image' => $this->getPostImages($data[$i]->ID)
                )
            );
        }

        //print_r($post);

        return $post;
    }

    private function getPostImages ($idPost) {
        $this->db->where('post_type', 'attachment');
        $this->db->where('post_parent', $idPost );

        $this->db->limit($this->imagesPerPost);
        $this->db->order_by('post_date', 'DESC');

        $image = $this->db->get('wp_posts');

        if ($this->imagesPerPost > 1) {
            return $image->result();
        } else {
            return $image->row();
        }
    }
}