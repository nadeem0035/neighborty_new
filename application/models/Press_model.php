<?php

Class Press_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getPressRalease(){
        $this->db->select('*');
        $this->db->from('press');
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function getPressDetail($id){
        $this->db->select('*');
        $this->db->from('press');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }

}

?>