<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('bnienc');
		$this->load->library('apibri');
		 $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://myjek.xyz',
            'smtp_port' => 465,
             'smtp_user' => 'nhi@myjek.xyz',
            'smtp_pass' => 'Tujuh737',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );

        $this->load->library('email', $config);
		$this->load->model('M_auth');
	}
	
	public function index() {
		$session = $this->session->userdata('status');

		if ($session == '') {
			$this->load->view('login');
		} else {
			redirect('Home');
		}
	}

	
	public function register() {
		$session = $this->session->userdata('status');
		$this->data['program'] = $this->M_auth->getdatapilihan();
		$this->data['kampus'] = $this->db->get('kampus')->result();
		
		//$data = $this->M_auth->login($username, $password);
		if ($session == '') {
			$this->load->view('register',$this->data);
		} else {
			redirect('Home');
		}
	}

	public function login() {
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == TRUE) {
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);

			$data = $this->M_auth->login($username, $password);

			if ($data['hasil'] == false) {
				$this->session->set_flashdata('error_msg', $data['data']);
				redirect('Auth');
			} else {
				$session = [
					'userdata' => $data['data'],
					'status' => "Loged in"
				];
				$this->session->set_userdata($session);
				redirect('Home');
			}
		} else {
			$this->session->set_flashdata('error_msg', validation_errors());
			redirect('Auth');
		}
	}
	
	public function kirimotp() {
		$email = $_POST['email'];
		$otp=$a = mt_rand(100000,999999);
		$this->emailotp($email,$otp);
		echo $otp;
	}
	
	
	
	
	
	public function prosesregister() {
		$this->form_validation->set_rules('txtnama', 'Nama', 'required|min_length[4]|max_length[50]');
		$this->form_validation->set_rules('txtemail', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('txtotp2', 'OTP', 'required|min_length[4]|max_length[6]');
		$simpan=false;
		if ($this->form_validation->run() == TRUE) {
			$nama = trim($_POST['txtnama']);
			$email = trim($_POST['txtemail']);
			$nohp= trim($_POST['txthp']);
			$sekolah= trim($_POST['txtsekolah']);
			$prodi= trim($_POST['txtprodi']);
			$tempat= trim($_POST['txttempat']);
			$pass= trim($_POST['txtpass']);
			$wn= trim($_POST['txtwn']);
			$txtotp1= trim($_POST['txtotp1']);
			$txtotp2= trim($_POST['txtotp2']);
			if ($txtotp1!= $txtotp2) {
				$this->session->set_flashdata('error_msg',"OTP tidak Cocok");
				redirect('Auth/register');
				exit;
			}
			
			 $datasimpan = array(
                'nama_siswa'     => $nama,
                'email_siswa'          =>  $email,
                'telp_siswa'       =>  $nohp,
                'status_wn'           => $wn,
                'pilihan1'           => $prodi,
				'asal_sekolah'           => $sekolah,
				'tempat_ujian'           => $tempat,
				'password'           => md5($pass),
				'foto'           =>  "profil2.jpg",
            );
        
      
      	$simpan = $this->db->insert('pendaftaran', $datasimpan);
		$iddaftar = $this->db->insert_id();

			if ($simpan== false) {
				$this->session->set_flashdata('error_msg',"Pendaftaran Gagal");
				redirect('Auth/register');
			} else {
				
					$sql="select tanggal_akhir from setting order by id desc limit 1";
					$queri = $this->db->query($sql);
					$tanggalakhir=$queri->row()->tanggal_akhir;
				
				
				
				
				$jumlahnya=$wn=="WNI"? 250000:1000000;
				$this->session->set_flashdata('success', 'Pendaftaran berhasil,silahkan lakukan pembayaran melalui VA yang dikirm ke email');
				if($wn=="WNI"){
				$datava=$this->buatva($iddaftar,$jumlahnya,$tanggalakhir,$nama,$email,$nohp);
				$nomorva=$datava['virtual_account'];
				$bank="BNI";
				}
			    else{
					$nomorva=rand(1111111111,9999999999);
					$databri=json_decode($this->buatvabri($nomorva,$nama,$jumlahnya,$tanggalakhir));
					if(!$databri->status){
						$this->session->set_flashdata('error_msg', ["Nomor VA sudah tersedia"]);
						redirect('Auth');
					}
					$bank="BRI";
					}
				
				$this->emaildatava($jumlahnya,$nomorva,$email,$bank);
				redirect('Auth');
			}
		} else {
			$this->session->set_flashdata('error_msg', validation_errors());
			redirect('Auth');
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('Auth');
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */