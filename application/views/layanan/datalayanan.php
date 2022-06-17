<style>

#right{float:right}
.right {
                text-align: right;
            }
			.center {
                text-align: center;
            }
</style>

<div class="msg" style="display:none;">
  <?php  echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  
  <!-- /.box-header -->
  <div class="box-body">
  	<div class="btn-group" id="right">
						<a href="javascript:void(0);" class="btn btn-primary float-right" onclick="tambahlayanan();">Tambah</a>
						
	</div><br><br>
	  <div class="table-responsive" style="min-height: 500px;">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Kode Layanan</th>
          <th>Nama Layanan</th>
		  <th>Satuan</th>
		  <th>Jenis Layanan</th>
          <th>Harga Jual</th>
          <th>Status</th>
		  <th>Aksi</th>
         
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
          <h3 class="modal-title text-white">Layanan Baru</h3>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
      
        <div class="modal-body">
         <form>
          <div class="form-group row">
                    <label for="" class="col-md-4 col-form-label">Kode Layanan</label>
                    <div class="col-md-8">
					 
                        <input type="text" id="txtkode" class="form-control" name="txtkode" required>
                    </div>
          </div>
          <div class="form-group row">
                    <label for="" class="col-md-4 col-form-label">Nama Layanan</label>
                    <div class="col-md-8">
                        <input type="txt" id="txtnama" class="form-control" name="txtnama" required>
                    </div>
          </div>
		  
		  <div class="form-group row">
                    <label for="" class="col-md-4 col-form-label">Satuan</label>
                    <div class="col-md-3">
                        <input type="text" id="txtsatuan" name="txtsatuan" class="form-control">
                    </div>
					<label for="" class="col-md-2 col-form-label">Harga Layanan</label>
                    <div class="col-md-3">
                        <input type="text" id="txtharga" name="txtharga" class="form-control">
                    </div>
          </div>
		  
		  
		   <div class="form-group row">
                   
					
					<label for="" class="col-md-4 col-form-label">Jenis Layanan</label>
                    <div class="col-md-3">
                        <select name="txtjenis" id="txtjenis" class="form-control" data-placeholder="Pilih Satuan" required>
                           <option value="Kiloan">Kiloan</option>
                            <option value="Satuan">Satuan</option>
							<option value="Meteran">Meteran</option>
                        </select>
                    </div>
					
					<label for="" class="col-md-2 col-form-label">Status</label>
                    <div class="col-md-3">
                        <select name="txtstatus" id="txtstatus" class="form-control" data-placeholder="Pilih Satuan" required>
                           <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
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
                    <label for="" class="col-md-4 col-form-label">Kode Layanan</label>
                    <div class="col-md-8">
					 
                        <input type="text" id="txtkodeubah" class="form-control" name="txtkodeubah" readonly required>
                    </div>
          </div>
          <div class="form-group row">
                    <label for="" class="col-md-4 col-form-label">Nama Layanan</label>
                    <div class="col-md-8">
                        <input type="txt" id="txtnamaubah" class="form-control" name="txtnamaubah" required>
                    </div>
          </div>
		  
		  <div class="form-group row">
                    <label for="" class="col-md-4 col-form-label">Satuan</label>
                    <div class="col-md-3">
                        <input type="text" id="txtsatuanubah" name="txtsatuanubah" class="form-control">
                    </div>
					<label for="" class="col-md-2 col-form-label">Harga Layanan</label>
                    <div class="col-md-3">
                        <input type="text" id="txthargaubah" name="txthargaubah" class="form-control">
                    </div>
          </div>
		  
		  
		   <div class="form-group row">
                   
					<label for="" class="col-md-4 col-form-label">Jenis Layanan</label>
                    <div class="col-md-3">
                        <select name="txtjenisubah" id="txtjenisubah" class="form-control" data-placeholder="Pilih Satuan" required>
                           <option value="Kiloan">Kiloan</option>
                            <option value="Satuan">Satuan</option>
							<option value="Meteran">Meteran</option>
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
		$('#txtharga').val("");
		$('#txtkode').val("");
		$('#txtsatuan').val("");
		$('#txtstatus').val("1");
		
	}
	function simpandata(){
		 var _nama=$('#txtnama').val();
			
			var _kode=$('#txtkode').val();
			var _harga=$('#txtharga').val();
			var _satuan=$('#txtsatuan').val();
			var _status=$('#txtstatus').val();
			var _jenis=$('#txtjenis').val();
			
          
		if(_kode==null || _kode=="") {
			  alert("Kode layanan harus diisi!"); return;
		  }
		  
		  if(_nama==null || _nama=="") {
			  alert("Nama layanan harus diisi!"); return;
		  }
		  
		  if(_harga==null || _harga=="") {
			  alert("Harga harus diisi!"); return;
		  }
		  
		  if(_satuan==null || _satuan=="") {
			  alert("Harga harus diisi!"); return;
		  }
		 
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('layanan/simpanlayanan')?>",
               // dataType : "JSON",
                data : { 	nama:_nama,
							kode:_kode,
							harga:_harga,
							satuan:_satuan,
							status:_status,
							jenis:_jenis,
							
				
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
			
			var _kode=$('#txtkodeubah').val();
			var _harga=$('#txthargaubah').val();
			var _satuan=$('#txtsatuanubah').val();
			var _status=$('#txtstatusubah').val();
			var _jenis=$('#txtjenisubah').val();
          
		  if(_nama==null || _nama=="") {
			  alert("Nama layanan harus diisi!"); return;
		  }
		  
		  if(_harga==null || _harga=="") {
			  alert("Harga harus diisi!"); return;
		  }
		  
		  if(_satuan==null || _satuan=="") {
			  alert("Harga harus diisi!"); return;
		  }
		 
		
		
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('layanan/simpanubah')?>",
               // dataType : "JSON",
                data : { 
							nama:_nama,
							kode:_kode,
							harga:_harga,
							satuan:_satuan,
							status:_status,
							jenis:_jenis,
				
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
                url  : "<?php echo base_url('layanan/hapus')?>",
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
                    url : "<?php echo base_url('layanan/getdatalayanan');?>",
                    method : "POST",
                  data: {id_layanan:id},
                   dataType : 'json',
                    success: function(data){
						_idubah=data.id;
					  $('[name="txtnamaubah"]').val(data.nama_layanan);
                      $('[name="txtkodeubah"]').val(data.kode_layanan);
					  $('[name="txtsatuanubah"]').val(data.satuan);
					  $('[name="txthargaubah"]').val(data.harga_jual);
					  $('[name="txtstatusubah"]').val(data.status);
					   $('[name="txtjenisubah"]').val(data.jenis_layanan);
					 
					
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
	 {targets: [-3],
         className: 'right'
     },
	 ],
    "ordering": true,
    "searching": true,
    "serverSide": true,
	"bDestroy": true,
    
 
  "ajax":{
          url :"<?php echo base_url('layanan/datalayananjson'); ?>", // json datasource
          type: "post",
			  // method  , by default get
          
        },
		
		"columns": [
			
			{ "data": "kode_layanan"},
			{ "data": "nama_layanan"},
			{ "data": "satuan"},
			{ "data": "jenis_layanan"},
			{ "data": "harga_jual"},
			{ "data": "status"},
			{ "data": "aksi"},
			
			
		]
  
  });
 
	}
	
	function tambahlayanan(){
		 $('#modaltambah').modal('show');
	}
	
</script>
