<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_control extends CI_Controller {

	function __construct(){
		parent::__construct();

		if($this->m_control->user_lvl > 0){
			redirect(base_url() . "admin");
		}
	}

	function set_output(){
		$output = array();

		return $output;
	}

	public function index(){

		$output = $this->set_output();

		$output["body_class"] = "control";

		$output["web_content"] = $this->load->view("back/v_control", $output, true);

		$this->load->view('back/v_website', $output);
	}

	public function login(){

		$email = $this->input->post("email");
		$pass = $this->input->post("pass");

		$save = $this->input->post("save");

		echo $this->m_control->wc_Auth($email, $pass, $save);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */