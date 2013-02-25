<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_vias extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_vias(){
        $query = $this->db->select("*")
                            ->from("wc_vias_polilineas")
                            ->join("wc_vias_coordenadas", "wc_vias_polilineas.entry = wc_vias_coordenadas.idPolilinea", "left")
                            ->get();

        $result = $query->result();

        $retorno = array();

        foreach($result as $row){

            $retorno[] = array(
                "entry" => $row->entry,
                //"nombre" => $row->nombre,
                //"size" => $row->size,
                "coordinates" => $this->get_lat_lang($row->coordinates)
            );
        }

        return $retorno;
    }

    function get_lat_lang($coordinates){

        $coord_xy = array();

        $coordenadas = explode(" ", trim($coordinates));

        foreach($coordenadas as $lat_lng){
            $coord_xy[] = explode(",", trim($lat_lng));
        }

        return $coord_xy;
    }

}