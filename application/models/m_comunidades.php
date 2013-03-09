<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_comunidades extends CI_Model {

    /*var $title   = '';
    var $content = '';
    var $date    = '';*/

    function __construct(){
        parent::__construct();
    }

    function get_comunidades(){
        $query = $this->db->select("NOMCP as nombre, YGD as lat, XGD as lng")
                            ->from("comunidades")
                            ->where("YGD !=", 0)
                            ->where("XGD !=", 0)
                            ->get();

        /*$result = array();
        foreach($query->result_array() as $row){
            $result[] = array($row["lat"], $row["lng"]);
        }*/

        //return $result;
        return $query->result();
    }

}