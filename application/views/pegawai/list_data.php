<?php
  foreach ($dataPegawai as $pegawai) {
	  $status=$pegawai->status=="0"?"belum bayar":"sudah bayar";
    ?>
    <tr>
      <td style="min-width:230px;"><?php echo $pegawai->nama_siswa; ?></td>
      <td><?php echo $pegawai->email_siswa; ?></td>
      <td><?php echo $pegawai->telp_siswa; ?></td>
      <td><?php echo $pegawai->status_wn; ?></td>
      <td><?php echo $status; ?></td>
      
    </tr>
    <?php
  }
?>