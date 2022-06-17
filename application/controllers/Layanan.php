<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan extends  AUTH_Controller {

	
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
	
	
	public function datalayanan()
	{
			
		//check_access(40,$this->session->type_id);
		// $this->data['title']="Data Cabang";
		// $this->data['access']=true;
		// $this->template->views('cabang/datacabang',  $this->data);
		
		$data['userdata'] = $this->userdata;
		
		

		$data['page'] = "layanan";
		
		$data['judul'] = "Data Layanan";
		$data['deskripsi'] = "Manage Data Layanan";
		$data['access'] = true;
		
		$this->template->views('layanan/datalayanan',  $data);
		
	}
	
	
	
	public function datalayananjson()
	{
		//$whereData = " where u.status_publish=1 and(u.disetujui=1 or u.last_id_approval is null) and u.isspk=0";
		$whereData = " where id>0";
		
		
		$post = $this->input->post();
		
		
		if(!empty($post))
		{
			if (!empty($post['search']['value'])) 
			{
				$whereData .=" AND (
				nama_layanan LIKE '%".$post['search']['value']."%' 
				)";
			}
			$sql_filtered  = "select id,kode_layanan,nama_layanan,satuan,harga_jual,jenis_layanan,
			(case when status=1 then 'Aktif' else 'NonAktif' end) status
			from layanan
			 ".$whereData;
			
			$query_filtered = $this->db->query($sql_filtered);
			
			$sql  = $sql_filtered." ORDER BY ".$post['columns'][$post["order"][0]["column"]]['data']." ".$post["order"][0]["dir"]." limit ".$post['start'].",".$post['length'];
			$query = $this->db->query($sql);
			 $no = $post['start'] + 1;
			 if( $query->num_rows()>0){
			 $datana=$query->result_array();
            foreach ($datana as $r)
            {
				 
                
				$nestedData['kode_layanan'] = $r['kode_layanan'];
                $nestedData['nama_layanan'] = $r['nama_layanan'];
				$nestedData['satuan'] =  $r['satuan'];
				$nestedData['status'] = $r['status'];
				$nestedData['harga_jual'] = number_format($r['harga_jual'],0); 
				$nestedData['jenis_layanan'] = $r['jenis_layanan'];
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
			$simpan=$this->db->delete("layanan");
		if($simpan) $status="sukses";
			echo  $status;
      
    }
	
	public function getdatalayanan(){
			$this->db->where('id', $_POST['id_layanan']);
			$data = $this->db->get('layanan')->row();
		    echo json_encode($data);
	}
	
	public function simpanlayanan(){
		$status="gagal";
		
		   $datasimpan = array(
				'nama_layanan' => $_POST['nama'],
				'kode_layanan' 	=> $_POST['kode'],
				'harga_jual' 	=>  $_POST['harga'],
				'satuan' 	=> $_POST['satuan'],
				'status' 	=> $_POST['status'],
				'jenis_layanan' 	=> $_POST['jenis'],
							
                 );
        
		$simpan = $this->db->insert('layanan', $datasimpan);
		
		if($simpan) {
			
	
		$status="sukses";
		}
		echo  $status;
      
    }
	
	public function simpanubah(){
		$status="gagal";
		
		   $datasimpan = array(
				'nama_layanan' => $_POST['nama'],
			    'harga_jual' 	=>  $_POST['harga'],
				'satuan' 	=> $_POST['satuan'],
				'status' 	=> $_POST['status'],
				'jenis_layanan' 	=> $_POST['jenis'],				
                 );
        
		$this->db->where('kode_layanan', $_POST['kode']);
      $simpan=$this->db->update("layanan", $datasimpan);
		
		if($simpan) {
			
	
		$status="sukses";
		}
		echo  $status;
      
    }
	
	
	
	
	
	
}
