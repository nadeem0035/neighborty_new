<?php

Class Packages_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model', 'common', true);
    }


    public function GetPublishPackage($slug) {

        $this->db->select('*');
        $this->db->from('packages');
        $this->db->where('slug', $slug);
        $this->db->where('status','1');
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    public function get_user_package($uid){
        $this->db->select('b.package_id, p.name,pd.id,pd.total_listings,pd.featured_available');
        $this->db->from('booking as b');
        $this->db->join('packages as p', 'p.id = b.package_id');
        $this->db->join('package_detail as pd', 'pd.package_id = b.package_id');
        $this->db->where('b.user_id',$uid);
        $this->db->where('p.status','1');
        return $this->db->get()->result();
       //echo $this->db->last_query();

    }

    public function get_package_detail($uid){
        $this->db->select('p.package_id as packageid,p.agent_id,b.package_id,b.transaction_id,pd.*');
        $this->db->from('package_stats as p');
        $this->db->join('booking as b', 'b.package_id = p.package_id');
        $this->db->join('package_detail as pd', 'pd.package_id = p.package_id');
        $this->db->where('p.agent_id',$uid);
        $this->db->order_by('b.package_id', 'DESC');
        $this->db->limit(1);
        return $this->db->get()->result();
        //echo $this->db->last_query();

    }
    public function get_package_stat($uid,$transit_id){
        $this->db->select('featured,avilable_listings as list');
        $this->db->from('package_stats');
        $this->db->where('agent_id',$uid);
        $this->db->where('transaction_id',$transit_id);
        return $this->db->get()->result();
        //echo $this->db->last_query();

    }





}