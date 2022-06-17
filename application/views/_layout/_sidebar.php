<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/img/<?php echo $userdata->foto; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $userdata->name; ?></p>
        <!-- Status -->
        <a href="<?php echo base_url(); ?>assets/#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
	
      <li class="header">Dashboard</li>
      <!-- Optionally, you can add icons to the links -->

      <li <?php if ($page == 'home') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Home'); ?>">
          <i class="fa fa-home"></i>
          <span>Home</span>
        </a>
      </li>
      <li class="header">Master</li>
     <li class="treeview">
		<a href="#">
		<i class="fa fa-pie-chart"></i>
		<span>Data Master</span>
		<span class="pull-right-container">
		<i class="fa fa-angle-left pull-right"></i>
		</span>
		</a>
		<ul class="treeview-menu">
		<li><a href="<?php echo base_url("cabang/datacabang");?>"><i class="fa fa-circle-o"></i>Cabang</a></li>
		<li><a href="<?php echo base_url("agen/dataagen");?>"><i class="fa fa-circle-o"></i>Agen</a></li>
		<li><a href="<?php echo base_url("pelanggan/datapelanggan");?>"><i class="fa fa-circle-o"></i>Pelanggan</a></li>
		<li><a href="<?php echo base_url("driver/datadriver");?>"><i class="fa fa-circle-o"></i>Driver</a></li>
		<li><a href="<?php echo base_url("layanan/datalayanan");?>"><i class="fa fa-circle-o"></i>Layanan</a></li>
		</ul>
	</li>

     
        <li class="header">Master</li>
     <li class="treeview">
		<a href="#">
		<i class="fa fa-pie-chart"></i>
		<span>Transaksi</span>
		<span class="pull-right-container">
		<i class="fa fa-angle-left pull-right"></i>
		</span>
		</a>
		<ul class="treeview-menu">
		<li><a href="<?php echo base_url("transaksi/datatransaksi");?>"><i class="fa fa-circle-o"></i>Transaksi</a></li>
		
		</ul>
</li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>