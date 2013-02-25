<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_distritos extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_distritos(){
        $query = $this->db->select("*")
                            ->from("wc_distritos")
                            ->get();

        $result = $query->result();

        foreach($result as $row){
            $row->points = $this->get_coordenadas($row->entry);
        }

        return $result;
    }

    function get_coordenadas($idDistrito){
        $query = $this->db->select("latitude, longitude")
                            ->from("wc_distritos_coordenadas")
                            ->where("idDistrito", $idDistrito)
                            ->get();

        return $query->result();
    }

}