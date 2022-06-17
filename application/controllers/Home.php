<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_pelanggan');
		
		
		
		$this->load->model('M_agen');
		$this->load->model('M_layanan');
	}

	public function index() {
		$data['jml_pelanggan'] 	= $this->M_pelanggan->total_rows();
		$data['jml_agen'] 	= $this->M_agen->total_rows();
		$data['jml_layanan'] 	= $this->M_layanan->total_rows();
		
		$data['userdata'] 		= $this->userdata;

		$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
		
		
		$index = 0;
		
		
		$index = 0;
		

		
		

		$data['page'] 			= "home";
		$data['judul'] 			= "Beranda";
		$data['deskripsi'] 		= "SiRajaBersih";
		$this->template->views('home', $data);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */