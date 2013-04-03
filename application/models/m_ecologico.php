<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_ecologico extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_poligonos(){
        $query = $this->db->select("*")
                            ->from("wc_ecologico_poligonos")
                            ->join("wc_ecologico_coordenadas", 
                                "wc_ecologico_poligonos.entry = wc_ecologico_coordenadas.idPoligono", 
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