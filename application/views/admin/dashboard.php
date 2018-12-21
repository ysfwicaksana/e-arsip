<div class="main"> 
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Dashboard</h3>
							<p class="panel-subtitle">Selamat Datang Administrator</p>
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
							<div class="row">
							    <div class="col-md-3">
							        <div class="metric">
										<span class="icon"><i class="lnr lnr-user"></i></span>
										<p>
											<span class="number"><?php echo $set_akun;?></span>
											<span class="title"> Akun Pengguna</span>
										</p>
									</div>
							    </div>
							    <div class="col-md-3">
							        <div class="metric">
										<span class="icon"><i class="lnr lnr-apartment"></i></span>
										<p>
											<span class="number"><?php echo $set_unit;?></span>
											<span class="title"> Unit Kerja</span>
										</p>
									</div>
							    </div>
							    <div class="col-md-3">
							        <div class="metric">
										<span class="icon"><i class="lnr lnr-star"></i></span>
										<p>
											<span class="number"><?php echo $set_jabatan;?></span>
											<span class="title"> Jabatan</span>
										</p>
									</div>
							    </div>
							    <div class="col-md-3">
							        <div class="metric">
										<span class="icon"><i class="lnr lnr-users"></i></span>
										<p>
											<span class="number"><?php echo $set_pegawai;?></span>
											<span class="title"> Pegawai</span>
										</p>
									</div>
							    </div>
							</div>
							
						</div>
					</div>
					<div class="panel panel-headline">
					    <div class="panel-heading">
					        <h3 class="panel-title">Reporting</h3>
					        <p class="panel-subtitle">Laporan</p>
					    </div>
					    <div class="panel-body">
					        <div class="row">
					            <div class="col-md-6">
                                   <label> Surat Menurut Jenis Surat </label>
                                   <ul class="nav nav-tabs">
                                       <li class="active"><a data-toggle="tab" href="#internal-jenis">Internal</a></li>
                                       <li><a data-toggle="tab" href="#eksternal-jenis">Eksternal</a></li>
                                   </ul>
                                   <div class="tab-content">
                                       <div id="internal-jenis" class="tab-pane fade in active">
                                           
                                           <table class="table table-hover">
                                              <thead>
                                                  <tr>
                                                      <th>Jenis Surat</th>
                                                      <th>Jumlah</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <?php foreach($view_internal_jenis as $row_internal_jenis){ ?>
                                                      <tr>
                                                          <td>
                                                              <?php if($row_internal_jenis->jenis_surat == NULL){ ?>
                                                                      <small>Kosong</small> 
                                                                       
                                                               <?php } else { ?>
                                                                    <small><?php echo $row_internal_jenis->jenis_surat;?></small>
                                                               <?php } ?>   
                                                          </td>
                                                          <td>
                                                               <?php if($row_internal_jenis->jumlah == NULL){ ?>
                                                                      <small>Kosong</small> 
                                                                       
                                                               <?php } else { ?>
                                                                    <small><?php echo $row_internal_jenis->jumlah;?></small>
                                                               <?php } ?>        
                                                            </td>
                                                      </tr>
                                                  <?php } ?>
                                              </tbody>
                                           </table>
                                       </div>
                                       <div id="eksternal-jenis" class="tab-pane fade">
                                           
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Jenis Surat</th>
                                                        <th>Jumlah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   <?php foreach($view_eksternal_jenis as $row_eksternal_jenis){ ?>
                                                      
                                                       <tr>
                                                           <td>
                                                               <?php if($row_eksternal_jenis->jenis_surat == NULL){ ?>
                                                                      <small>Kosong</small> 
                                                                       
                                                               <?php } else { ?>
                                                                    <small><?php echo $row_eksternal_jenis->jenis_surat;?></small>
                                                               <?php } ?>        
                                                            </td>
                                                            <td>
                                                               <?php if($row_eksternal_jenis->jumlah == NULL){ ?>
                                                                      <small>Kosong</small> 
                                                                       
                                                               <?php } else { ?>
                                                                    <small><?php echo $row_eksternal_jenis->jumlah;?></small>
                                                               <?php } ?>        
                                                            </td>
                                                       </tr>
                                                   <?php } ?>
                                                </tbody>
                                            </table>
                                       </div>
                                   </div>
					              
					            </div>
					            <div class="col-md-6">
					               <label> Surat Menurut Prioritas Surat </label>
                                   <ul class="nav nav-tabs">
                                       <li class="active"><a data-toggle="tab" href="#internal-prioritas">Internal</a></li>
                                       <li><a data-toggle="tab" href="#eksternal-prioritas">Eksternal</a></li>
                                   </ul>
                                   <div class="tab-content">
                                       <div id="internal-prioritas" class="tab-pane fade in active">
                                           
                                           <table class="table table-hover">
                                              <thead>
                                                  <tr>
                                                      <th>Prioritas Surat</th>
                                                      <th>Jumlah</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <?php foreach($view_internal_prioritas as $row_internal_prioritas){ ?>
                                                      <tr>
                                                          <td>
                                                              <?php if($row_internal_prioritas->prioritas_surat == NULL){ ?>
                                                                      <small>Kosong</small> 
                                                                       
                                                               <?php } else { ?>
                                                                    <small><?php echo $row_internal_prioritas->prioritas_surat;?></small>
                                                               <?php } ?>   
                                                          </td>
                                                          <td>
                                                               <?php if($row_internal_prioritas->jumlah == NULL){ ?>
                                                                      <small>Kosong</small> 
                                                                       
                                                               <?php } else { ?>
                                                                    <small><?php echo $row_internal_prioritas->jumlah;?></small>
                                                               <?php } ?>        
                                                            </td>
                                                      </tr>
                                                  <?php } ?>
                                              </tbody>
                                           </table>
                                       </div>
                                       <div id="eksternal-prioritas" class="tab-pane fade">
                                           
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Prioritas Surat</th>
                                                        <th>Jumlah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   <?php foreach($view_eksternal_prioritas as $row_eksternal_prioritas){ ?>
                                                      
                                                       <tr>
                                                           <td>
                                                               <?php if($row_eksternal_prioritas->prioritas_surat == NULL){ ?>
                                                                      <small>Kosong</small> 
                                                                       
                                                               <?php } else { ?>
                                                                    <small><?php echo $row_eksternal_prioritas->prioritas_surat;?></small>
                                                               <?php } ?>        
                                                            </td>
                                                            <td>
                                                               <?php if($row_eksternal_prioritas->jumlah == NULL){ ?>
                                                                      <small>Kosong</small> 
                                                                       
                                                               <?php } else { ?>
                                                                    <small><?php echo $row_eksternal_prioritas->jumlah;?></small>
                                                               <?php } ?>        
                                                            </td>
                                                       </tr>
                                                   <?php } ?>
                                                </tbody>
                                            </table>
                                       </div>
                                   </div>
					            </div>
					            </div>
					            <div class="row">
					               <div class="col-md-6">
					               <label> Surat Menurut Sifat Surat </label>
                                   <ul class="nav nav-tabs">
                                       <li class="active"><a data-toggle="tab" href="#internal-sifat">Internal</a></li>
                                       <li><a data-toggle="tab" href="#eksternal-sifat">Eksternal</a></li>
                                   </ul>
                                   <div class="tab-content">
                                       <div id="internal-sifat" class="tab-pane fade in active">
                                           
                                           <table class="table table-hover">
                                              <thead>
                                                  <tr>
                                                      <th>Sifat Surat</th>
                                                      <th>Jumlah</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <?php foreach($view_internal_sifat as $row_internal_sifat){ ?>
                                                      <tr>
                                                          <td>
                                                              <?php if($row_internal_sifat->sifat_surat == NULL){ ?>
                                                                      <small>Kosong</small> 
                                                                       
                                                               <?php } else { ?>
                                                                    <small><?php echo $row_internal_sifat->sifat_surat;?></small>
                                                               <?php } ?>   
                                                          </td>
                                                          <td>
                                                               <?php if($row_internal_sifat->jumlah == NULL){ ?>
                                                                      <small>Kosong</small> 
                                                                       
                                                               <?php } else { ?>
                                                                    <small><?php echo $row_internal_sifat->jumlah;?></small>
                                                               <?php } ?>        
                                                            </td>
                                                      </tr>
                                                  <?php } ?>
                                              </tbody>
                                           </table>
                                       </div>
                                       <div id="eksternal-sifat" class="tab-pane fade">
                                           
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Sifat Surat</th>
                                                        <th>Jumlah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   <?php foreach($view_eksternal_sifat as $row_eksternal_sifat){ ?>
                                                      
                                                       <tr>
                                                           <td>
                                                               <?php if($row_eksternal_sifat->sifat_surat == NULL){ ?>
                                                                      <small>Kosong</small> 
                                                                       
                                                               <?php } else { ?>
                                                                    <small><?php echo $row_eksternal_sifat->sifat_surat;?></small>
                                                               <?php } ?>        
                                                            </td>
                                                            <td>
                                                               <?php if($row_eksternal_sifat->jumlah == NULL){ ?>
                                                                      <small>Kosong</small> 
                                                                       
                                                               <?php } else { ?>
                                                                    <small><?php echo $row_eksternal_sifat->jumlah;?></small>
                                                               <?php } ?>        
                                                            </td>
                                                       </tr>
                                                   <?php } ?>
                                                </tbody>
                                            </table>
                                       </div>
                                   </div>
					            </div>
					            
					            <div class="col-md-6">
					               <label> Surat Menurut Media Pengiriman </label>
                                   <ul class="nav nav-tabs">
                                       <li class="active"><a data-toggle="tab" href="#internal-media">Internal</a></li>
                                       <li><a data-toggle="tab" href="#eksternal-media">Eksternal</a></li>
                                   </ul>
                                   <div class="tab-content">
                                       <div id="internal-media" class="tab-pane fade in active">
                                           
                                           <table class="table table-hover">
                                              <thead>
                                                  <tr>
                                                      <th>Media Pengiriman</th>
                                                      <th>Jumlah</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <?php foreach($view_internal_media as $row_internal_media){ ?>
                                                      <tr>
                                                          <td>
                                                              <?php if($row_internal_media->media_surat == NULL){ ?>
                                                                      <small>Kosong</small> 
                                                                       
                                                               <?php } else { ?>
                                                                    <small><?php echo $row_internal_media->media_surat;?></small>
                                                               <?php } ?>   
                                                          </td>
                                                          <td>
                                                               <?php if($row_internal_media->jumlah == NULL){ ?>
                                                                      <small>Kosong</small> 
                                                                       
                                                               <?php } else { ?>
                                                                    <small><?php echo $row_internal_media->jumlah;?></small>
                                                               <?php } ?>        
                                                            </td>
                                                      </tr>
                                                  <?php } ?>
                                              </tbody>
                                           </table>
                                       </div>
                                       <div id="eksternal-media" class="tab-pane fade">
                                           
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Media Pengiriman</th>
                                                        <th>Jumlah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   <?php foreach($view_eksternal_media as $row_eksternal_media){ ?>
                                                      
                                                       <tr>
                                                           <td>
                                                               <?php if($row_eksternal_media->media_surat == NULL){ ?>
                                                                      <small>Kosong</small> 
                                                                       
                                                               <?php } else { ?>
                                                                    <small><?php echo $row_eksternal_media->media_surat;?></small>
                                                               <?php } ?>        
                                                            </td>
                                                            <td>
                                                               <?php if($row_eksternal_media->jumlah == NULL){ ?>
                                                                      <small>Kosong</small> 
                                                                       
                                                               <?php } else { ?>
                                                                    <small><?php echo $row_eksternal_media->jumlah;?></small>
                                                               <?php } ?>        
                                                            </td>
                                                       </tr>
                                                   <?php } ?>
                                                </tbody>
                                            </table>
                                       </div>
                                   </div>
					            </div>
					            </div>
					        </div>
					    </div>
					</div>
					