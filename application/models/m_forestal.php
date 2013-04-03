<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_forestal extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_poligonos(){
        $query = $this->db->select("*")
                            ->from("wc_forestal_poligonos")
                            ->join("wc_forestal_coordenadas", 
                                "wc_forestal_poligonos.entry = wc_forestal_coordenadas.idPoligono", 
                                "left")
                            ->get();

        $result = $query->result();

        $resultados = array();

        foreach($result as $row){

            $resultados[] = array(
                "entry" => $row->entry,
                "color" => $row->color,
                "points" => $this->get_coordenadas($row->coordinates)
            );
        }

        return $resultados;
    }

    function get_coordenadas($coordinates){

        $coord_xy = array();

        $coordenadas = explode(" ", trim($coordinates));

        foreach($coordenadas as $lat_lng){
            $coord_xy[] = explode(",", trim($lat_lng));
        }

        return $coord_xy;
    }

}