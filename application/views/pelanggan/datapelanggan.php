<style>

#right{float:right}
</style>

<div class="msg" style="display:none;">
  <?php  echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  
  <!-- /.box-header -->
  <div class="box-body">
  	<div class="btn-group" id="right">
						<a href="javascript:void(0);" class="btn btn-primary float-right" onclick="tambahpelanggan();">Tambah</a>
						
	</div><br><br>
	  <div class="table-responsive" style="min-height: 500px;">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Nama Pelanggan</th>
          <th>Email</th>
          <th>Telp</th>
          <th>Status</th>
		   <th>Agen</th>
          <th>Aksi</th>
         <th></th>
        </tr>
      </thead>
     
    </table>
	</div>
  </div>
</div>

 <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white">Pelanggan Baru</h3>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
      
        <div class="modal-body">
         <form>
          <div class="form-group row">
                    <label for="" class="col-md-4 col-form-label">Nama Pelanggan</label>
                    <div class="col-md-8">
					 
                        <input type="text" id="txtnama" class="form-control" name="txtnama" required>
                    </div>
          </div>
          <div class="form-group row">
                    <label for="" class="col-md-4 col-form-label">Alamat</label>
                    <div class="col-md-8">
                        <input type="txt" id="txtalamat" class="form-control" name="txtalamat" required>
                    </div>
          </div>
		  
		  <div class="form-group row">
                    <label for="" class="col-md-4 col-form-label">Kota</label>
                    <div class="col-md-3">
                        <input type="text" id="txtkota" name="txtkota" class="form-control">
                    </div>
					<label for="" class="col-md-2 col-form-label">Kode Pos</label>
                    <div class="col-md-3">
                        <input type="text" id="txtkodepos" name="txtkodepos" class="form-control">
                    </div>
          </div>
		  
		  
		    <div class="form-group row">
                    
					<label for="" class="col-md-4 col-form-label">Nomor HP</label>
                    <div class="col-md-3">
                        <input type="text" id="txtnohp" name="txtnohp" class="form-control">
                    </div>
					 <label for="" class="col-md-2 col-form-label">Email</label>
                    <div class="col-md-3">
                        <input type="text" id="txtemail" name="txtemail" class="form-control">
                    </div>
            </div>
			
			
			<div class="form-group row">
                   
					
					<label for="" class="col-md-4 col-form-label">Status</label>
                    <div class="col-md-3">
                        <select name="txtstatus" id="txtstatus" class="form-control" data-placeholder="Pilih Satuan" required>
                           <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
					<label for="" class="col-md-2 col-form-label">Agen</label>
                    <div class="col-md-3">
                        <select name="txtagen" id="txtagen" class="form-control" data-placeholder="Pilih Satuan" required>
                           <option value="0">Tanpa Agen</option>
                          <?php foreach($agen as $u):?>
                                <option value="<?php echo $u->id?>"><?php echo $u->nama_agen?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
            </div>
			
			
               
        </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <button class="btn btn-primary" id="btn_add" onclick="simpandata();" >Simpan</button>
        </div>
       
      </div>
    </div>
  </div>
  
  
  <div class="modal fade" id="modalubah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white">Ubah Data</h3>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
      
        <div class="modal-body">
         <form>
          <div class="form-group row">
                    <label for="" class="col-md-4 col-form-label">Nama Pelanggan</label>
                    <div class="col-md-8">
					 <input type="hidden" name="idubah" id="idubah" class="form-control" placeholder="Id" readonly>
                        <input type="text" id="txtnamaubah" class="form-control" name="txtnamaubah" required>
                    </div>
          </div>
          <div class="form-group row">
                    <label for="" class="col-md-4 col-form-label">Alamat</label>
                    <div class="col-md-8">
                        <input type="txt" id="txtalamatubah" class="form-control" name="txtalamatubah" required>
                    </div>
          </div>
		  
		  <div class="form-group row">
                    <label for="" class="col-md-4 col-form-label">Kota</label>
                    <div class="col-md-3">
                        <input type="text" id="txtkotaubah" name="txtkotaubah" class="form-control">
                    </div>
					<label for="" class="col-md-2 col-form-label">Kode Pos</label>
                    <div class="col-md-3">
                        <input type="text" id="txtkodeposubah" name="txtkodeposubah" class="form-control">
                    </div>
          </div>
		  
		  
		    <div class="form-group row">
                    <label for="" class="col-md-4 col-form-label">Email</label>
                    <div class="col-md-3">
                        <input type="text" id="txtemailubah" name="txtemailubah" class="form-control">
                    </div>
					<label for="" class="col-md-2 col-form-label">Nomor HP</label>
                    <div class="col-md-3">
                        <input type="text" id="txtnohpubah" name="txtnohpubah" class="form-control">
                    </div>
            </div>
			
			
			<div class="form-group row">
                    <label for="" class="col-md-4 col-form-label">Agen</label>
                    <div class="col-md-3">
                        <select name="txtagenubah" id="txtagenubah" class="form-control" data-placeholder="Pilih Satuan" required>
                           <option value="0">Pilih Agen</option>
                          <?php foreach($agen as $u):?>
                                <option value="<?php echo $u->id?>"><?php echo $u->nama_agen?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
					
					<label for="" class="col-md-2 col-form-label">Status</label>
                    <div class="col-md-3">
                        <select name="txtstatusubah" id="txtstatusubah" class="form-control" data-placeholder="Pilih Satuan" required>
                           <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
            </div>
			
			
        </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <button class="btn btn-primary" id="btn_add" onclick="simpanubah();" >Simpan</button>
        </div>
       
      </div>
    </div>
  </div>
  

<div id="tempat-modal"></div>

<script type="text/javascript">
var _idubah=0;
    $(document).ready(function() {
		
		getdata();
	});
	
	
	function kosong(){
		$('#txtnama').val("");
		$('#txtalamat').val("");
		$('#txtkota').val("");
		$('#txtkodepos').val("");
		$('#txtnohp').val("");
		$('#txtemail').val("");
		$('#txtstatus').val("1");
		$('#txtagen').val("0");
	}
	function simpandata(){
		 var _nama=$('#txtnama').val();
			var _alamat=$('#txtalamat').val();
			var _kota=$('#txtkota').val();
			var _kodepos=$('#txtkodepos').val();
			var _nomorhp=$('#txtnohp').val();
			var _email=$('#txtemail').val();
			var _status=$('#txtstatus').val();
			var _idagen=$('#txtagen').val();
          
		
		  
		  if(txtnama==null || txtnama=="") {
			  alert("Nama Pelanggan harus diisi!"); return;
		  }
		  
		  if(_nomorhp==null || _nomorhp=="") {
			  alert("Nomor HP harus diisi!"); return;
		  }
		 
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('pelanggan/simpanpelanggan')?>",
               // dataType : "JSON",
                data : { nama:_nama,
						alamat:_alamat,
							kota:_kota,
							kode_pos:_kodepos,
							no_hp:_nomorhp,
							email:_email,
							status:_status,
							id_agen:_idagen,
				
				},
                success: function(response){
					
                    
                    var table = $('#list-data').DataTable();
					table.draw(false);
					
					$('#modaltambah').modal('hide');
					kosong();
                    
                },
				
            });
	}
	
	function simpanubah(){
	
		 var _nama=$('#txtnamaubah').val();
			var _alamat=$('#txtalamatubah').val();
			var _kota=$('#txtkotaubah').val();
			
			var _kodepos=$('#txtkodeposubah').val();
			var _nomorhp=$('#txtnohpubah').val();
			var _email=$('#txtemailubah').val();
			var _status=$('#txtstatusubah').val();
			
			var _idagen=$('#txtagenubah').val();
          
		  if(_nama==null || _nama=="") {
			  alert("Nama Pelanggan harus diisi!"); return;
		  }
		  
		  if(_nomorhp==null || _nomorhp=="") {
			  alert("Nomor HP harus diisi!"); return;
		  }
		 
		 
		
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('pelanggan/simpanubah')?>",
               // dataType : "JSON",
                data : { 
							id_pelanggan:_idubah,
							nama_pelanggan:_nama,
							alamat:_alamat,
							kota:_kota,
							kode_pos:_kodepos,
							no_hp:_nomorhp,
							email:_email,
							status:_status,
							id_agen:_idagen,
				
				},
                success: function(response){
					
                    var table = $('#list-data').DataTable();
					table.draw(false);;
					
					$('#modalubah').modal('hide');
                    
                },
				
            });
	}
	
	function hapus(id){
		if (confirm("Yakin hapus?")==false) return;
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('pelanggan/hapus')?>",
               // dataType : "JSON",
                data : { id:id,
						
				
				},
                success: function(response){
					
                    
                    var table = $('#list-data').DataTable();
					table.draw(false);;
					
					
                    
                },
				
            });
	}
	
	function ubah(id){
		 	
	

	 $.ajax({
                    url : "<?php echo base_url('pelanggan/getdatapelanggan');?>",
                    method : "POST",
                  data: {id_pelanggan:id},
                   dataType : 'json',
                    success: function(data){
						_idubah=data.id;
					  $('[name="idubah"]').val(data.id);
                      $('[name="txtnamaubah"]').val(data.nama_pelanggan);
					  $('[name="txtalamatubah"]').val(data.alamat_pelanggan);
					  $('[name="txtkotaubah"]').val(data.kota_pelanggan);
						$('[name="txtkontakpersonubah"]').val(data.kontak_person);
					  $('[name="txtkodeposubah"]').val(data.kode_pos);
					  $('[name="txtnohpubah"]').val(data.no_hp);
					  $('[name="txtemailubah"]').val(data.email);
					  $('[name="txtstatusubah"]').val(data.status);
					 
					
					   $('[name="txtagenubah"]').val(data.id_agen);
						$('#modalubah').modal('show');
 
                    }
                });
               
	 }
	function getdata(){
		
		var datatable=   $('#list-data').DataTable( {
      
 "processing" : true,
  "oLanguage": {
                "sLengthMenu": "Tampilkan _MENU_ data per halaman",
                "sSearch": "Pencarian: ",
                "sZeroRecords": "Maaf, tidak ada data yang ditemukan",
               "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
				//"sInfo": "",
                "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
                "sInfoFiltered": "(di filter dari _MAX_ total data)",
                "oPaginate": {
                    "sFirst": "<<",
                    "sLast": ">>",
                    "sPrevious": "<",
                    "sNext": ">"
               }
            },
  columnDefs: [{
        targets: [0],
        orderable: false
     },
	 {targets: [-1],
         visible: false
     },
	 ],
    "ordering": true,
    "searching": true,
    "serverSide": true,
	"bDestroy": true,
    
 
  "ajax":{
          url :"<?php echo base_url('pelanggan/datapelangganjson'); ?>", // json datasource
          type: "post",
			  // method  , by default get
          
        },
		
		"columns": [
			
			{ "data": "nama_pelanggan"},
			{ "data": "email"},
			{ "data": "no_hp"},
			{ "data": "status"},
			{ "data": "nama_agen"},
			{ "data": "aksi"},
			{ "data": "id"},
			
		]
  
  });
 
	}
	
	function tambahpelanggan(){
		 $('#modaltambah').modal('show');
	}
	
</script>
