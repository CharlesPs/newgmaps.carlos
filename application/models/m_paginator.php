<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_paginator extends CI_Model{
	
	
	function __construct(){
		// Call the Model constructor
		parent::__construct();
	}
	
	function create($data){

		$this->load->library('pagination');

		$config['uri_segment'] =  $data->uri_segment;
		$config['base_url'] = $data->base_url;
		$config['total_rows'] = $data->total_rows;
		$config['per_page'] = $data->per_page; 

		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';

		$config['num_tag_open'] = "<li>";
		$config['num_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="disabled"><a>';
		$config['cur_tag_close'] = '</a></li>';

		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['prev_link'] = 'Anterior';

		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['next_link'] = 'Siguiente';

		$this->pagination->initialize($config); 

		return $this->pagination->create_links();
	}

}