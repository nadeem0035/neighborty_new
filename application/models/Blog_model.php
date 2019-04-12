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

class Blog_model extends CI_Model {

    public function __construct(){
        parent::__construct();

        // $blog_db = $this->load->database('wordpress', TRUE);
        //$this->load->config('wordpress');
        //Database is autoloaded
        $this->blog_db = $this->load->database('wordpress', true);


    }

    private $postLimit = 4;
    private $imagesPerPost = 1;

    public function getPosts () {
        $this->blog_db->where('wp_posts.post_parent', 0);
        $this->blog_db->where('wp_posts.post_type', 'post');
        //$this->blog_db->where('wp_posts.cat', 'blog');
        $this->blog_db->where('wp_posts.post_status', 'publish');
       // $this->blog_db->where('wp_posts.category_name',2);
        $this->blog_db->limit($this->postLimit);
        $this->blog_db->order_by('post_date', 'DESC');

        $query = $this->blog_db->get('wp_posts');

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

        return $post;
    }

    private function getPostImages ($idPost) {
        $this->blog_db->where('post_type', 'attachment');
        $this->blog_db->where('post_parent', $idPost );

        $this->blog_db->limit($this->imagesPerPost);
        $this->blog_db->order_by('post_date', 'DESC');

        $image = $this->blog_db->get('wp_posts');

        if ($this->imagesPerPost > 1) {
            return $image->result();
        } else {
            return $image->row();
        }
    }
}