<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver extends  AUTH_Controller {

	
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
	
	
	public function datadriver()
	{
			
		//check_access(40,$this->session->type_id);
		// $this->data['title']="Data Cabang";
		// $this->data['access']=true;
		// $this->template->views('cabang/datacabang',  $this->data);
		
		$data['userdata'] = $this->userdata;
		
		

		$data['page'] = "driver";
		$this->db->where('status', 1);
		$data['cabang'] =  $this->db->get('cabang')->result();
		$data['judul'] = "Data Driver";
		$data['deskripsi'] = "Manage Data Driver";
		$data['access'] = true;
		
		$this->template->views('driver/datadriver',  $data);
		
	}
	
	
	
	public function datadriverjson()
	{
		//$whereData = " where u.status_publish=1 and(u.disetujui=1 or u.last_id_approval is null) and u.isspk=0";
		$whereData = " where p.id>0";
		
		
		$post = $this->input->post();
		
		
		if(!empty($post))
		{
			if (!empty($post['search']['value'])) 
			{
				$whereData .=" AND (
				nama_driver LIKE '%".$post['search']['value']."%' 
				)";
			}
			$sql_filtered  = "select p.id,a.nama_cabang,p.nama_driver,p.no_hp,p.email,
			(case when p.status=1 then 'Aktif' else 'NonAktif' end) status
			from driver p  join cabang a on p.id_cabang=a.id
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
				$nestedData['nama_driver'] =  $r['nama_driver'];
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
			$simpan=$this->db->delete("driver");
		if($simpan) $status="sukses";
			echo  $status;
      
    }
	
	public function getdatadriver(){
			$this->db->where('id', $_POST['id_driver']);
			$data = $this->db->get('driver')->row();
		    echo json_encode($data);
	}
	
	public function simpandriver(){
		$status="gagal";
		
		   $datasimpan = array(
				'nama_driver' => $_POST['nama'],
				'alamat_driver' 	=> $_POST['alamat'],
				'kota_driver' 	=>  $_POST['kota'],
				'kode_pos' 	=> $_POST['kode_pos'],
				'no_hp' => $_POST['no_hp'],
				'email' 	=>  $_POST['email'],
				'status' 	=> $_POST['status'],
				'id_cabang' => $_POST['id_cabang'],				
                 );
        
		$simpan = $this->db->insert('driver', $datasimpan);
		
		if($simpan) {
			
	
		$status="sukses";
		}
		echo  $status;
      
    }
	
	public function simpanubah(){
		$status="gagal";
		
		   $datasimpan = array(
				'nama_driver' => $_POST['nama'],
				'alamat_driver' 	=> $_POST['alamat'],
				'kota_driver' 	=>  $_POST['kota'],
				'kode_pos' 	=> $_POST['kode_pos'],
				'no_hp' => $_POST['no_hp'],
				'email' 	=>  $_POST['email'],
				'status' 	=> $_POST['status'],
				'id_cabang' => $_POST['id_cabang'],					
                 );
        
		$this->db->where('id', $_POST['id_driver']);
      $simpan=$this->db->update("driver", $datasimpan);
		
		if($simpan) {
			
	
		$status="sukses";
		}
		echo  $status;
      
    }
	
	
	
	
	
	
}
