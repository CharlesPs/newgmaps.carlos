<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Capas extends CI_Controller {

	public function comunidades(){
		$this->load->model("m_comunidades");

		echo json_encode($this->m_comunidades->get_comunidades());
	}

	public function provincias(){
		$this->load->model("m_provincias");

		echo json_encode($this->m_provincias->get_provincias());
	}

	public function distritos(){
		$this->load->model("m_distritos");

		echo json_encode($this->m_distritos->get_distritos());
	}

	public function hidrografia(){
		$this->load->model("m_hidrografia");

		echo json_encode($this->m_hidrografia->get_hidrografia_test());
	}

	public function vias(){
		$this->load->model("m_vias");

		echo json_encode($this->m_vias->get_vias());
	}

	public function ecologico(){
		$this->load->model("m_ecologico");

		echo json_encode($this->m_ecologico->get_poligonos());
	}

	public function bosques(){
		$this->load->model("m_bosques");

		echo json_encode($this->m_bosques->get_bosques());
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */