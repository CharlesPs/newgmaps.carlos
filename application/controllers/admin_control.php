<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_control extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	private function check_online(){
		if($this->m_control->user_lvl > 0){
			redirect(base_url() . "admin");
		}
	}

	function set_output(){
		$output = array();

		return $output;
	}

	public function index(){

		$this->check_online();

		$output = $this->set_output();

		$output["body_class"] = "control";

		$output["web_content"] = $this->load->view("back/v_control", $output, true);

		$this->load->view('back/v_website', $output);
	}

	public function login(){

		$this->check_online();

		$email = $this->input->post("email");
		$pass = $this->input->post("pass");

		$save = $this->input->post("save");

		echo $this->m_control->wc_Auth($email, $pass, $save);
	}

	public function logout(){

		$ajax = ($this->input->get("ajax")) ? 1 : 0;

		if($this->m_control->wc_logout()){
			if($ajax){
				echo 1;
			}else{
				redirect("admin/control");
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */