<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends  AUTH_Controller {

	
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
	
	
	public function datatransaksi()
	{
			
		//check_access(40,$this->session->type_id);
		// $this->data['title']="Data Cabang";
		// $this->data['access']=true;
		// $this->template->views('cabang/datacabang',  $this->data);
		
		$data['userdata'] = $this->userdata;
		
		

		$data['page'] = "transaksi";
		
		$data['judul'] = "Data Transaksi";
		$data['deskripsi'] = "Data Transaksi";
		$data['access'] = true;
		
		$this->template->views('transaksi/datatransaksi',  $data);
		
	}
	
	
	
	public function datatransaksijson()
	{
		//$whereData = " where u.status_publish=1 and(u.disetujui=1 or u.last_id_approval is null) and u.isspk=0";
		$whereData = " where t.id>0";
		
		
		$post = $this->input->post();
		
		
		if(!empty($post))
		{
			if (!empty($post['search']['value'])) 
			{
				$whereData .=" AND (
				nama_pelanggan LIKE '%".$post['search']['value']."%' 
				or nama_agen LIKE '%".$post['search']['value']."%' )";
			}
			$sql_filtered  = "select t.id,t.nomor_transaksi,DATE_FORMAT(t.tgl_transaksi, '%d %b %Y')  tgl_transaksi,
			t.jumlah,
			(case when t.status_laundry=0 then 'ready pick up' when t.status_laundry=1 then 'pick up' 
			when t.status_laundry=2 then 'pengiriman' when t.status_laundry=3 then 'done' end) status_laundry,
			(case when t.status_bayar=0 then 'Belum dibayar' else 'dibayar' end) status_bayar,
			nama_pelanggan,coalesce(nama_agen,'') nama_agen
			from transaksi t join pelanggan p on t.id_pelanggan=p.id 
			left join agen a on t.id_agen=a.id
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
				$nestedData['jumlah'] =  number_format($r['jumlah'],0);
				$nestedData['nomor_transaksi'] = $r['nomor_transaksi'];
                $nestedData['nama_agen'] = $r['nama_agen'];
				$nestedData['nama_pelanggan'] =  $r['nama_pelanggan'];
				$nestedData['status_bayar'] = $r['status_bayar'];
				$nestedData['status_laundry'] = $r['status_laundry'];
				$nestedData['tgl_transaksi'] = $r['tgl_transaksi'];
				
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
