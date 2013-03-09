<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_control extends CI_Model{
	var $entry 			= null;
	var $email 			= '';
	var $nombre 		= '';

	var $user_lvl 		= 0;

	var $is_admin = FALSE;
	var $logeado = FALSE;
	var $llave= 67657567657;
	var $now;

	var $usuario = null;

	var $cookie_name = 'gmaps_cookie';

	var $user_table = "wc_usuarios";
	
	public function __construct(){
		parent::__construct();
		// Debug end
		
		$this->eval_session_cookie();
	}
	
	
	public function eval_session_cookie(){
		$this->now = time();
		
		$cookie = $this->input->cookie( $this->cookie_name );
		
		if($cookie){

			$ar = unserialize($cookie);

			if(!isset($ar["type"])){
				$ar["type"] = "fb";
			}

			if($ar['entry']){
				$entry = intval($ar['entry']);
				$query= $this->db->query("SELECT SQL_CACHE * FROM " . $this->user_table . " where entry = '" . $entry . "' LIMIT 1");
				$row = $query->row();
				
		
				
				$key = md5($this->llave.$ar['entry']);	
				if($query->num_rows() == 0 or ($this->now - intval($ar['now'])) > 864000 or $key != $ar['key']){
					$this->Logout();
					return;
				}
				
				return $this->wc_login($row);
			}
		}
			
		return false;
	}
	
	public function wc_Auth($email, $passwd, $guardar=true){
		$passwd = trim($passwd);
		
		$passwd = md5($email.'::'.$passwd);

		if(!$email and !$passwd) {
			return FALSE;
		}
		
		$query= $this->db->query("SELECT * FROM " . $this->user_table . " where email='".$email."'");

		$row = $query->row();
		

		if($query->num_rows() == 0) {
			return FALSE;
		}
		
		if (($row->entry > 0) and ($row->password == $passwd)) {
			$this->wc_login($row);
			return $this->set_session_cookie(1, "wc", $guardar);
		}
		return FALSE;
	}
	
	public function wc_login($row){

		$this->entry 			= $row->entry;
		$this->email 			= $row->email;
		$this->nombre 			= $row->nombre;

		$this->user_lvl 		= $row->user_lvl;
		
		$this->logeado 					= TRUE;
		
		return true;
	}

	public function wc_logout(){
		return $this->set_session_cookie(0, "wc", $guardar);
	}
	
	public function set_session_cookie($action, $type, $save = true){
		
		switch ($action) {
		case '0': // Borrar cookie
				$strCookie = "";
				$time = $this->now - 3600;
			break;
		case '1': //guardar cookie
			if($save){ 
				$time = time() + 2520000; // Valido por 1000 horas.
			}else{
				$time = 0;
			}
				
			$ar['entry'] = $this->entry;
			$ar['key'] = md5($this->llave.$this->entry);
			$ar['now'] = $this->now;
			$ar['type'] = $type;
			$strCookie = serialize($ar);
			break;
		}
		return setcookie( $this->cookie_name ,$strCookie,$time,"/");
	}

}























