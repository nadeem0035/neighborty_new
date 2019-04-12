<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model {

    // ::::::::::::::::::::::::::::::::::::::::::::::::::
    function commonSave($table, $data) {
        $result = $this->db->insert($table, $data);
        return $result;
    }

    // ::::::::::::::::::::::::::::::::::::::::::::::::::
    function commonUpdate($table, $data, $col, $val) {
        $result = $this->db->where($col, $val);
        $result = $this->db->update($table, $data);
        return $result;
    }

    function commonUpdateStation($table, $data, $where = array()) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $result = $this->db->update($table, $data);
        return $result;
    }


    function get_result($table, $field, $data) {
        $this->db->select("*");
        $this->db->where($field, $data);
        return $this->db->get($table)->result();
    }



    public function get_row($table, $field, $data) {

        $this->db->select("*");
        $this->db->where($field, $data);
        return $this->db->get($table)->row();
    }

    public function get_latest_recrod($table) {

        $this->db->select("*");
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $this->db->from($table);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


    public function get_latest_row_by_id($data, $table,$field) {

        $this->db->select($data);
        $this->db->where($field, $data);

        return $this->db->get($table)->row();
    }

    public function get_latest_row_column_by_id($data, $table,$match,$field) {

        $this->db->select($data);
        $this->db->where($match, $field);

        return $this->db->get($table)->row();
    }



    public function get_row_with_specific_data($data, $table, $field, $id) {

        $this->db->select($data);
        if($field == '' && $id == ''){

        }else{
           $this->db->where($field, $id);
        }
        //echo $this->db->last_query();
        return $this->db->get($table)->row();
    }

    public function getAllContent($data, $table){

        $this->db->select($data);
        $this->db->from($table);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getContentById($data, $table, $field, $id){

        $this->db->select($data);
        if($field == '' && $id == ''){

        }else{
            $this->db->where($field, $id);
        }
        $this->db->from($table);
        $query = $this->db->get();
        //echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }

    // ::::::::::::::::::::::::::::::::::::::::::::::::::

    public function countries() {

        $this->db->select('id,country_name,country_code');
        $this->db->from('countries');
       // $this->db->where('active', 1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }



    public function delete_data($table, $fieldName, $fieldValue) {

        $this->db->where($fieldName, (int) $fieldValue);

        if ($this->db->delete($table)) {
            return true;
        } else {
            return false;
        }
    }

    public function send_contact_form($data) {

        if ($this->db->insert('inquiries', $data)) {
            return true;
        } else {
            return false;
        }
    }


    function delete_row($table,$field,$id)
    {
        $this->db->where($field, $id);
        $this->db->delete($table);
    }


    public function incr_counter($uid)
    {
        $this->db->where('id', $uid);
        $this->db->set('followers_count', 'followers_count+1', FALSE);
        $this->db->update('users');

    }

    public function desc_counter($uid)
    {
        $this->db->where('id', $uid);
        $this->db->set('followers_count', 'followers_count-1', FALSE);
        $this->db->update('users');

    }

    public function getHttpVars() {
        $superglobs = array(
            '_POST',
            '_REQUEST',
            '_GET',
            '_FILES',
            'HTTP_POST_VARS',
            'HTTP_GET_VARS');
        $httpvars = array();
        // extract the right array
        foreach ($superglobs as $glob) {
            global $$glob;
            if (isset($$glob) && is_array($$glob)) {
                $httpvars = $$glob;
            }
            if (count($httpvars) > 0)
                break;
        }
        return $httpvars;
    }

    public function d($d) {
        echo '<pre>';
        print_r($d);
        echo '</pre>';
    }

}