<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_hidrografia extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_hidrografia(){
        $query = $this->db->select("*")
                            ->from("wc_hidrografia_polilineas")
                            ->get();

        $result = $query->result();

        foreach($result as $row){
            $row->points = $this->get_coordenadas($row->entry);
        }

        return $result;
    }

    function get_coordenadas($idPolilinea){
        $query = $this->db->select("latitude, longitude")
                            ->from("wc_hidrografia_coordenadas")
                            ->where("idPolilinea", $idPolilinea)
                            ->get();

        return $query->result();
    }

    // test
    function get_hidrografia_test(){
        $query = $this->db->select("*")
                            ->from("wc_hidrografia_polilineas_test")
                            ->get();

        $result = $query->result();

        $resultados = array();

        foreach($result as $row){

            $resultados[] = array(
                "entry" => $row->entry,
                "points" => $this->get_coordenadas_test($row->coordinates)
            );

            /*$resultados->entry = $row->entry;
            $resultados->points = $this->get_coordenadas_test($row->coordinates);*/
        }

        return $resultados;
    }

    function get_coordenadas_test($coordinates){

        $coord_xy = array();

        $coordenadas = explode(" ", trim($coordinates));

        foreach($coordenadas as $lat_lng){
            $coord_xy[] = explode(",", trim($lat_lng));
        }

        return $coord_xy;
    }

}