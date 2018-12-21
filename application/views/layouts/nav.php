<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="#"><b>Archival Management System</b></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
			
			
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								
								<li><a href="<?php echo base_url('login/signout');?>"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
						
					</ul>
				</div>
			</div>
		</nav>
		
	<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
					    <?php if($this->session->userdata('level') == 1){ ?>
                             <li><a href="<?php echo site_url('admin');?>" class=""><i class="lnr lnr-home"></i><span>Dashboard</span></a></li>
                            <li>
                                <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-arrow-right"></i> <span>Surat Internal</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                                <div id="subPages" class="collapse ">
                                    <ul class="nav">
                                        <li><a href="<?php echo site_url('admin/surat-internal/masuk');?>" class=""><i class="lnr lnr-envelope"></i><span>Surat Masuk</span></a></li>

                                        <li><a href="<?php echo site_url('admin/surat-internal/keluar');?>" class=""><i class="lnr lnr-envelope"></i><span>Surat Keluar</span></a></li>

                                    </ul>
                                </div>
							
						    </li>
                            <li>
                                <a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr-arrow-left"></i> <span>Surat Eksternal</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                                <div id="subPages2" class="collapse ">
                                    <ul class="nav">
                                        <li><a href="<?php echo site_url('admin/surat-eksternal/masuk');?>" class=""><i class="lnr lnr-envelope"></i><span>Surat Masuk</span></a></li>

                                        <li><a href="<?php echo site_url('admin/surat-eksternal/keluar');?>" class=""><i class="lnr lnr-envelope"></i><span>Surat Keluar</span></a></li>

                                    </ul>
                                </div>
							
						    </li>
                           <li><a href="<?php echo site_url('admin/arsip-dokumen');?>" class=""><i class="lnr lnr-inbox"></i><span>Arsip SK & Dokumen</span></a></li>
                           <li><a href="<?php echo site_url('admin/arsip-formulir');?>" class=""><i class="lnr lnr-inbox"></i><span>Formulir & Blanko</span></a></li>
                            <li>
                                <a href="#subPages4" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user"></i> <span>Pengaturan Pegawai</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                                <div id="subPages4" class="collapse ">
                                    <ul class="nav">
                                       
                                        <li><a href="<?php echo site_url('admin/unit-kerja');?>" class=""><i class="lnr lnr-apartment"></i><span>Unit Kerja</span></a></li>

                                        <li><a href="<?php echo site_url('admin/jabatan');?>" class=""><i class="lnr lnr-star"></i><span>Jabatan</span></a></li>
                                        
                                        <li><a href="<?php echo site_url('admin/pegawai');?>" class=""><i class="lnr lnr-users"></i><span>Pegawai</span></a></li>
                                        
                                        <li><a href="<?php echo site_url('admin/akun');?>" class=""><i class="lnr lnr-license"></i><span>Akun</span></a></li>

                                    </ul>
                                </div>
							
						    </li>
                        
					        <li>
							<a href="#subPages3" data-toggle="collapse" class="collapsed"><i class="lnr lnr-cog"></i> <span>Pengaturan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages3" class="collapse ">
								<ul class="nav">
								   
									<li><a href="<?php echo site_url('admin/jenis-surat');?>" class=""><i class="lnr lnr-envelope"></i><span>Jenis Surat</span></a></li>
									<li><a href="<?php echo site_url('admin/sifat-surat');?>" class=""><i class="lnr lnr-question-circle"></i><span>Sifat Surat</span></a></li>
									<li><a href="<?php echo site_url('admin/prioritas-surat');?>" class=""><i class="lnr lnr-clock"></i><span>Prioritas Surat</span></a></li>
									<li><a href="<?php echo site_url('admin/media-surat');?>" class=""><i class="lnr lnr-paperclip"></i><span>Media Surat</span></a></li>
									
									<li><a href="<?php echo site_url('admin/perintah-disposisi');?>" class=""><i class="lnr lnr-bullhorn"></i><span>Perintah Disposisi</span></a></li>
									           									
								</ul>
							</div>
							
						</li>
					    <?php } else if($this->session->userdata('level') == 0){ ?>
                        <li><a href="<?php echo site_url('user');?>" class=""><i class="lnr lnr-home"></i><span>Dashboard</span></a></li>

                        <li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-arrow-right"></i> <span>Surat Internal</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="<?php echo site_url('user/surat-internal/masuk');?>" class=""><i class="lnr lnr-envelope"></i><span>Surat Masuk</span></a></li>
									
									<li><a href="<?php echo site_url('user/surat-internal/keluar');?>" class=""><i class="lnr lnr-envelope"></i><span>Surat Keluar</span></a></li>
									
								</ul>
							</div>
							
						</li>
                       <li>
							<a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr-arrow-left"></i> <span>Surat Eksternal</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages2" class="collapse ">
								<ul class="nav">
									<li><a href="<?php echo site_url('user/surat-eksternal/masuk');?>" class=""><i class="lnr lnr-envelope"></i><span>Surat Masuk</span></a></li>
									
									<li><a href="<?php echo site_url('user/surat-eksternal/keluar');?>" class=""><i class="lnr lnr-envelope"></i><span>Surat Keluar</span></a></li>
									
								</ul>
							</div>
							
						</li>
                        <?php } ?>
				        
						
						
						
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->