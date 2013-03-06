<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Capas extends CI_Controller {

	private function comprimir($data){

		$supportsGzip = strpos( $_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip' ) !== false;

		if ( $supportsGzip ) {
	        $content = gzencode( trim( preg_replace( '/\s+/', ' ', $data ) ), 9);
	    } else {
	        $content = $data;
	    }

	    $offset = 60 * 60;

	    $expire = "expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";

	    header('Content-Encoding: gzip');
	    header("content-type: text/html; charset: UTF-8");
	    header("cache-control: must-revalidate");
	    header( $expire );
	    header( 'Content-Length: ' . strlen( $content ) );
	    header('Vary: Accept-Encoding');

	    return $content;
	}

	public function comunidades(){
		$this->load->model("m_comunidades");

		echo $this->comprimir(json_encode($this->m_comunidades->get_comunidades()));
	}

	public function provincias(){
		$this->load->model("m_provincias");

		echo $this->comprimir(json_encode($this->m_provincias->get_provincias()));
	}

	public function distritos(){
		$this->load->model("m_distritos");

		echo $this->comprimir(json_encode($this->m_distritos->get_distritos()));
	}

	public function hidrografia(){
		$this->load->model("m_hidrografia");

		echo $this->comprimir(json_encode($this->m_hidrografia->get_hidrografia_test()));
	}

	public function vias(){
		$this->load->model("m_vias");

			echo $this->comprimir(json_encode($this->m_vias->get_vias()));
		}

	public function ecologico(){
		$this->load->model("m_ecologico");

		echo $this->comprimir(json_encode($this->m_ecologico->get_poligonos()));
	}

	public function bosques(){
		$this->load->model("m_bosques");

		echo $this->comprimir(json_encode($this->m_bosques->get_bosques()));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */