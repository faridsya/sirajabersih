<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_pegawai');
		$this->load->model('M_posisi');
		$this->load->model('M_kota');
	}

	public function index() {
		
		$sql="select tanggal_akhir from setting order by id desc limit 1";
		$queryawal = $this->db->query($sql);
		$tanggal_akhir=$queryawal->row()->tanggal_akhir;
		$tanggal_akhir=date('Y-m-d\TH:i:s', strtotime($tanggal_akhir));
		$data['tanggal'] = $tanggal_akhir;
		$data['userdata'] = $this->userdata;
		$data['page'] = "setting";
		$this->template->views('setting/setting', $data);
	}

	

	
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */