<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cabang extends  AUTH_Controller {

	
    public function __construct()
    {
		parent::__construct();
	$this->load->model('M_pegawai');
		$this->load->model('M_posisi');
		$this->load->model('M_kota');
	
    }
	public function index()
	{	
			$data = array(
		  'title' => "Modules &rsaquo; Datatables"
			);
   
		 $this->load->view('proyek/index.php', $data);
	}
	
	
	public function datacabang()
	{
			
		//check_access(40,$this->session->type_id);
		// $this->data['title']="Data Cabang";
		// $this->data['access']=true;
		// $this->template->views('cabang/datacabang',  $this->data);
		
		$data['userdata'] = $this->userdata;
		$data['dataPegawai'] = $this->M_pegawai->select_all();
		

		$data['page'] = "cabang";
		$data['judul'] = "Data Cabang";
		$data['deskripsi'] = "Manage Data Cabang";
		$data['access'] = true;
		
		$this->template->views('cabang/datacabang',  $data);
		
	}
	
	
	
	
	public function tambahpemasukan()
	{
			$data = array(
		  'title' => "Tambah Biaya Sewa",
		  'proyek' => $this->db->get('project')->result(),
		  'pelanggan' => $this->personmodel->getperson(1),
		  'tipebayar' => $this->db->get('pembayaran_jenis')->result(),
		   
			);
		$this->load->view('pemasukan/tambahpemasukan.php', $data);
	}
	
	
	
	
	public function datacabangjson()
	{
		//$whereData = " where u.status_publish=1 and(u.disetujui=1 or u.last_id_approval is null) and u.isspk=0";
		$whereData = " where id>0";
		
		
		$post = $this->input->post();
		
		
		if(!empty($post))
		{
			if (!empty($post['search']['value'])) 
			{
				$whereData .=" AND (
				nama_cabang LIKE '%".$post['search']['value']."%' 
				)";
			}
			$sql_filtered  = "select id,nama_cabang,kontak_person,no_hp,
			(case when status=1 then 'Aktif' else 'NonAktif' end) status
			from cabang
			 ".$whereData;
			
			$query_filtered = $this->db->query($sql_filtered);
			
			$sql  = $sql_filtered." ORDER BY ".$post['columns'][$post["order"][0]["column"]]['data']." ".$post["order"][0]["dir"]." limit ".$post['start'].",".$post['length'];
			$query = $this->db->query($sql);
			 $no = $post['start'] + 1;
			 if( $query->num_rows()>0){
			 $datana=$query->result_array();
            foreach ($datana as $r)
            {
				 
                
				$nestedData['id'] = $r['id'];
                $nestedData['nama_cabang'] = $r['nama_cabang'];
				$nestedData['kontak_person'] =  $r['kontak_person'];
				$nestedData['status'] = $r['status'];
                $nestedData['no_hp'] = $r['no_hp'];
			    $ubah ='<a href="javascript:void(0);" title="Ubah" class="btn btn-sm btn-warning" onclick="ubah('.$r['id'].');"><i class="fa fa-edit"></i></a>';
                $hapus ='<a href="javascript:void(0);" title="Hapus" class="btn btn-sm btn-danger" onclick="hapus('.$r['id'].');"><i class="fa fa-trash"></i></a>';
				$nestedData['aksi']=$ubah." ".$hapus;
				$data[] = $nestedData;
                $no++;
            }
			 }
			 else $data=[];
			$datanya= array(
					'draw' => $post["draw"],
					'recordsTotal' =>  $query->num_rows(),
					'recordsFiltered' => $query_filtered->num_rows(),
					'data' => $data
				);
		
			echo json_encode($datanya);
		}else{
			echo json_encode(array());
		}
	}
	
	public function hapus(){
		$status="gagal";
	      
		    $this->db->where('id', $_POST['id']);
			$simpan=$this->db->delete("cabang");
		if($simpan) $status="sukses";
			echo  $status;
      
    }
	
		public function getdatacabang(){
			$this->db->where('id', $_POST['id_cabang']);
			$data = $this->db->get('cabang')->row();
		    echo json_encode($data);
	}
	public function simpancabang(){
		$status="gagal";
		
		   $datasimpan = array(
		       
                'nama_cabang' => $_POST['nama_cabang'],
				'alamat_cabang' 	=> $_POST['alamat'],
				'kota_cabang' 	=>  $_POST['kota'],
				'kode_pos' 	=> $_POST['kode_pos'],
				'kontak_person' => $_POST['kontak_person'],
				'no_hp' => $_POST['no_hp'],
				'email' 	=>  $_POST['email'],
				'status' 	=> $_POST['status'],
				'latitude' => $_POST['latitude'],
				'longitude' => $_POST['longitude']				
                 );
        
		$simpan = $this->db->insert('cabang', $datasimpan);
		
		if($simpan) {
			
	
		$status="sukses";
		}
		echo  $status;
      
    }
	
	public function simpanubah(){
		$status="gagal";
		
		   $datasimpan = array(
		       
                'nama_cabang' => $_POST['nama_cabang'],
				'alamat_cabang' 	=> $_POST['alamat'],
				'kota_cabang' 	=>  $_POST['kota'],
				'kode_pos' 	=> $_POST['kode_pos'],
				'kontak_person' => $_POST['kontak_person'],
				'no_hp' => $_POST['no_hp'],
				'email' 	=>  $_POST['email'],
				'status' 	=> $_POST['status'],
				'latitude' => $_POST['latitude'],
				'longitude' => $_POST['longitude']				
                 );
        
		$this->db->where('id', $_POST['id_cabang']);
      $simpan=$this->db->update("cabang", $datasimpan);
		
		if($simpan) {
			
	
		$status="sukses";
		}
		echo  $status;
      
    }
	
	
	
	public function detailpemasukan($id)
	{
		check_access(40,$this->session->type_id);
		$this->data['title']="Detail Pemasukan";
		
		$sql="select s.id,p.name as namaproyek,no_pemasukan,jumlah,s.catatan,DATE_FORMAT(tgl_masuk, '%d %b %Y') tgl_masuk,w.name as kontak
		 from pemasukan s join project p on s.project_id =p.id 
		 join person  w on s.id_kontak=w.id
		 where s.id='$id'";
		$query = $this->db->query($sql);
			$this->data['data']= $query->row();
			$this->load->view('pemasukan/lihatpemasukan.php',  $this->data);
	}
	
	 public function getpenerimaan(){
			
        $idproyek=$_POST['id_proyek'];
		$this->db->where('project_id',$idproyek);
		$array = $this->db->get('pemesanan')->result();

		
		
        echo json_encode($array);
    }
	
	
	
}
