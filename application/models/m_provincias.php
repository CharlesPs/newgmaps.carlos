<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_provincias extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_provincias(){
        $query = $this->db->select("*")
                            ->from("wc_provincias")
                            ->get();

        $result = $query->result();

        foreach($result as $row){
            $row->points = $this->get_coordenadas($row->entry);
        }

        return $result;
    }

    function get_coordenadas($idProvincia){
        $query = $this->db->select("latitude, longitude")
                            ->from("wc_provincias_coordenadas")
                            ->where("idProvincia", $idProvincia)
                            ->get();

        return $query->result();
    }

}