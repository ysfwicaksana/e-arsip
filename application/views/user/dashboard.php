<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Dashboard</h3>
							<p class="panel-subtitle">Selamat Datang <?php echo $name;?></p>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-envelope"></i></span>
										<p>
											<span class="number"><?php echo $set_internal_masuk;?></span>
											<span class="title">Surat Internal Masuk</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-envelope"></i></span>
										<p>
											<span class="number"><?php echo $set_internal_keluar;?></span>
											<span class="title">Surat Internal Keluar</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-envelope"></i></span>
										<p>
											<span class="number"><?php echo $set_eksternal_masuk;?></span>
											<span class="title">Surat Eksternal Masuk</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-envelope"></i></span>
										<p>
											<span class="number"><?php echo $set_eksternal_keluar;?></span>
											<span class="title"> Surat Eksternal Keluar</span>
										</p>
									</div>
								</div>
							</div>
							
							
						</div>
					</div>
					