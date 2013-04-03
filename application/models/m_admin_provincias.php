<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_admin_provincias extends CI_Model {

    function __construct(){
        parent::__construct();

        $this->main_table = "wc_provincias";
        $this->coord_table = "wc_provincias_coordenadas";
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

    function get_coordenadas($idProvincia){
        $query = $this->db->select("latitude, longitude")
                            ->from($this->coord_table)
                            ->where("idProvincia", $idProvincia)
                            ->get();

        $result = $query->result();

        $resultados = array();

        foreach($result as $row){
            $resultados[] = array($row->latitude, $row->longitude);
        }

        return $resultados;

    }

    /*

    */

    function get_distritos($idProvincia, $offset = 0){
        $query = $this->db->select("*")
                            ->from("wc_distritos")
                            ->where("idProvincia", $idProvincia)
                            //->limit(20, $offset)
                            ->get();

        return $query->result();
    }

}