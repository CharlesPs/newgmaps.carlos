<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_provincias extends CI_Controller {

	function __construct(){
		parent::__construct();

		if($this->m_control->user_lvl < 3){
			redirect(base_url() . "admin/control");
		}

		$this->main_model_name = "m_admin_provincias";
	}

	function set_output(){
		$output = array();

		return $output;
	}

	public function index(){

		$output = $this->set_output();

		$output["body_class"] = "";

		$output["web_content"] = "";

		$output["mod_title"] = "Provincias";

		$output["left_active"] = 2;
		$output["web_leftbar"] = $this->load->view("back/v_leftbar", $output, true);

		$this->load->model($this->main_model_name, "main_model");

		$offset = $this->uri->segment(3);

		$output["result"] = $this->main_model->get_result($offset);

		//***************************************************
		$this->load->model("m_paginator");

		$data = new M_object();

		$data->uri_segment 	= 3;
		$data->base_url 	= base_url()."admin/provincias/";
		$data->total_rows 	= $this->main_model->get_total_rows();
		$data->per_page 	= 20;

		$output["paginator"] = $this->m_paginator->create($data);
		//***************************************************

		$output["web_content"] .= $this->load->view("back/v_header", $output, true);
		$output["web_content"] .= $this->load->view("back/v_provincias", $output, true);
		$output["web_content"] .= $this->load->view("back/v_footer", $output, true);

		$this->load->view('back/v_website', $output);
	}

	public function edit(){

		$output = $this->set_output();

		$output["body_class"] = "";

		$output["web_content"] = "";

		$output["mod_title"] = "Editar Provincia";

		$output["left_active"] = 2;
		$output["web_leftbar"] = $this->load->view("back/v_leftbar", $output, true);

		$this->load->model($this->main_model_name, "main_model");

		$entry = $this->uri->segment(4);

		$output["row"] = $this->main_model->get_row($entry);

		$output["web_content"] .= $this->load->view("back/v_header", $output, true);
		$output["web_content"] .= $this->load->view("back/v_provincias_edit", $output, true);
		$output["web_content"] .= $this->load->view("back/v_footer", $output, true);

		$this->load->view('back/v_website', $output);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */