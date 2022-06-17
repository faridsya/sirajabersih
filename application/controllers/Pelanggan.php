<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends  AUTH_Controller {

	
    public function __construct()
    {
		parent::__construct();
	
	
    }
	public function index()
	{	
			$data = array(
		  'title' => "Modules &rsaquo; Datatables"
			);
   
		 $this->load->view('pelanggan/index.php', $data);
	}
	
	
	public function datapelanggan()
	{
			
		//check_access(40,$this->session->type_id);
		// $this->data['title']="Data Cabang";
		// $this->data['access']=true;
		// $this->template->views('cabang/datacabang',  $this->data);
		
		$data['userdata'] = $this->userdata;
		
		

		$data['page'] = "pelanggan";
		$this->db->where('status', 1);
		$data['agen'] =  $this->db->get('agen')->result();
		$data['judul'] = "Data Pelanggan";
		$data['deskripsi'] = "Manage Data Pelanggan";
		$data['access'] = true;
		
		$this->template->views('pelanggan/datapelanggan',  $data);
		
	}
	
	
	
	public function datapelangganjson()
	{
		//$whereData = " where u.status_publish=1 and(u.disetujui=1 or u.last_id_approval is null) and u.isspk=0";
		$whereData = " where p.id>0";
		
		
		$post = $this->input->post();
		
		
		if(!empty($post))
		{
			if (!empty($post['search']['value'])) 
			{
				$whereData .=" AND (
				nama_pelanggan LIKE '%".$post['search']['value']."%' 
				)";
			}
			$sql_filtered  = "select p.id,a.nama_agen,p.nama_pelanggan,p.no_hp,p.email,
			(case when a.status=1 then 'Aktif' else 'NonAktif' end) status
			from pelanggan p left join agen a on p.id_agen=a.id
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
                $nestedData['nama_agen'] = $r['nama_agen'];
				$nestedData['nama_pelanggan'] =  $r['nama_pelanggan'];
				$nestedData['status'] = $r['status'];
				$nestedData['email'] = $r['email'];
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
			$simpan=$this->db->delete("pelanggan");
		if($simpan) $status="sukses";
			echo  $status;
      
    }
	
	public function getdatapelanggan(){
			$this->db->where('id', $_POST['id_pelanggan']);
			$data = $this->db->get('pelanggan')->row();
		    echo json_encode($data);
	}
	
	public function simpanpelanggan(){
		$status="gagal";
		
		   $datasimpan = array(
				'nama_pelanggan' => $_POST['nama'],
				'alamat_pelanggan' 	=> $_POST['alamat'],
				'kota_pelanggan' 	=>  $_POST['kota'],
				'kode_pos' 	=> $_POST['kode_pos'],
				'no_hp' => $_POST['no_hp'],
				'email' 	=>  $_POST['email'],
				'status' 	=> $_POST['status'],
				'id_agen' => $_POST['id_agen'],				
                 );
        
		$simpan = $this->db->insert('pelanggan', $datasimpan);
		
		if($simpan) {
			
	
		$status="sukses";
		}
		echo  $status;
      
    }
	
	public function simpanubah(){
		$status="gagal";
		
		   $datasimpan = array(
				'nama_pelanggan' => $_POST['nama_pelanggan'],
				'alamat_pelanggan' 	=> $_POST['alamat'],
				'kota_pelanggan' 	=>  $_POST['kota'],
				'kode_pos' 	=> $_POST['kode_pos'],
				'no_hp' => $_POST['no_hp'],
				'email' 	=>  $_POST['email'],
				'status' 	=> $_POST['status'],
				'id_agen' 	=> $_POST['id_agen'],				
                 );
        
		$this->db->where('id', $_POST['id_pelanggan']);
      $simpan=$this->db->update("pelanggan", $datasimpan);
		
		if($simpan) {
			
	
		$status="sukses";
		}
		echo  $status;
      
    }
	
	
	
	
	
	
}
