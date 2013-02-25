<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_bosques extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_bosques(){
        $query = $this->db->select("*")
                            ->from("wc_bosques")
                            ->get();

        $result = $query->result();

        foreach($result as $row){
            $row->points = $this->get_coordenadas($row->entry);
        }

        return $result;
    }

    function get_coordenadas($idBosque){
        $query = $this->db->select("latitude, longitude")
                            ->from("wc_bosques_coordenadas")
                            ->where("idBosque", $idBosque)
                            ->get();

        return $query->result();
    }

}