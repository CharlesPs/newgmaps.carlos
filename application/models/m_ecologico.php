<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_ecologico extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_poligonos(){
        $query = $this->db->select("*")
                            ->from("wc_ecologico_poligonos")
                            ->join("wc_ecologico_tipos", "wc_ecologico_poligonos.tipo = wc_ecologico_tipos.entry", "left")
                            ->get();

        $result = $query->result();

        foreach($result as $row){
            $row->points = $this->get_coordenadas($row->entry);
        }

        return $result;
    }

    function get_coordenadas($idPoligono){
        $query = $this->db->select("latitude, longitude")
                            ->from("wc_ecologico_coordenadas")
                            ->where("idPoligono", $idPoligono)
                            ->get();

        return $query->result();
    }

}