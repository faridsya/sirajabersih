<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Email</th>
          <th>Telp</th>
          <th>Warga negara</th>
          <th>Status Bayar</th>
         
        </tr>
      </thead>
      <tbody id="data-pegawai">
        
      </tbody>
    </table>
  </div>
</div>



<div id="tempat-modal"></div>

<
<?php
  $data['judul'] = 'Pegawai';
  $data['url'] = 'Pegawai/import';
 
?>