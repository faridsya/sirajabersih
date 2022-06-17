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
						<a href="javascript:void(0);" class="btn btn-primary float-right" onclick="tambahpelanggan();">Tambah</a>
						
	</div><br><br>
	  <div class="table-responsive" style="min-height: 500px;">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Nomor Transaksi</th>
          <th>Pelanggan</th>
          <th>Agen</th>
          <th>Tanggal</th>
		   <th>Jumlah</th>
		   <th>Status Laundry</th>
		    <th>Status Bayar</th>
          <th>Aksi</th>
         <th></th>
        </tr>
      </thead>
     
    </table>
	</div>
  </div>
</div>

 
  

<div id="tempat-modal"></div>

<script type="text/javascript">
var _idubah=0;
    $(document).ready(function() {
		
		getdata();
	});
	
	
	
	
	
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
	 {targets: [-4],
         className: 'right'
     },
	 ],
    "ordering": true,
    "searching": true,
    "serverSide": true,
	"bDestroy": true,
    
 
  "ajax":{
          url :"<?php echo base_url('transaksi/datatransaksijson'); ?>", // json datasource
          type: "post",
			  // method  , by default get
          
        },
		
		"columns": [
			
			{ "data": "nomor_transaksi"},
			{ "data": "nama_pelanggan"},
			{ "data": "nama_agen"},
			{ "data": "tgl_transaksi"},
			{ "data": "jumlah"},
			{ "data": "status_laundry"},
			{ "data": "status_bayar"},
			{ "data": "id"},
			
		]
  
  });
 
	}
	
	function tambahpelanggan(){
		 $('#modaltambah').modal('show');
	}
	
</script>
