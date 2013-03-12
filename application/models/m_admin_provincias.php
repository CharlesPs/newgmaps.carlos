<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_admin_provincias extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_result($offset = 0){
        $query = $this->db->select("*")
                            ->from("wc_provincias")
                            ->limit(20, $offset)
                            ->get();

        return $query->result();
    }

    function get_row($entry){
        $query = $this->db->select("*")
                            ->from("wc_provincias")
                            ->where("entry", $entry)
                            ->get();

        return $query->row();
    }

    function get_total_rows(){
        $query = $this->db->select("*")
                            ->from("wc_provincias")
                            ->get();

        return $query->num_rows();
    }

}