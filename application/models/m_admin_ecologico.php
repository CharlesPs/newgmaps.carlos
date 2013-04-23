<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_admin_ecologico extends CI_Model {

    function __construct(){
        parent::__construct();

        $this->main_table = "wc_ecologico";
        $this->coord_table = "wc_ecologico_poligonos";
    }

    function get_result($offset = 0){
        $query = $this->db->select("*")
                            ->from($this->main_table)
                            ->limit(20, $offset)
                            ->get();

        return $query->result();
    }

    function get_row($entry){
        $query = $this->db->select("*")
                            ->from($this->main_table)
                            ->where("entry", $entry)
                            ->get();

        return $query->row();
    }

    function get_total_rows(){
        $query = $this->db->select("*")
                            ->from($this->main_table)
                            ->get();

        return $query->num_rows();
    }

    function save($data){

        $entry = $data->entry;
        unset($data->entry);

        if($entry){
            $this->db->where("entry",$entry);
            
            return $this->db->update($this->main_table, $data);
        }else{
            return $this->db->insert($this->main_table, $data);
        }

    }

    /*

    */

    function get_provincia($entry){
        $query = $this->db->select("*")
                            ->from("wc_provincias")
                            ->where("entry", $entry)
                            ->get();

        return $query->row();
    }

    /*

    */

    function get_coordenadas($idTipo){
        $query = $this->db->select("coordinates")
                            ->from($this->coord_table)
                            ->where("idTipo", $idTipo)
                            ->get();

        $result = $query->result();

        $poligonos = array();

        foreach($result as $row){

            $poligono = array();

            $coord_rows = explode(" ", $row->coordinates);

            foreach($coord_rows as $coord_row){
                $lat_lng = explode(",", $coord_row);
                $poligono[] = array(trim($lat_lng[1]), trim($lat_lng[0]));
            }

            $poligonos[] = $poligono;

        }

        return $poligonos;

    }

    /*

    */

    /*function get_c_poblados($idDistrito, $offset = 0){
        $query = $this->db->select("*")
                            ->from("wc_distritos")
                            ->where("idProvincia", $idProvincia)
                            ->limit(20, $offset)
                            ->get();

        return $query->result();
    }*/

}