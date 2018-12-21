<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
				    <?php echo $this->session->flashdata('notify');?>
				    <?php echo validation_errors();?>
					<!-- OVERVIEW -->
                   <?php if($jenis == 'Keluar') { ?>
				        <a href="#" class="act-btn" data-toggle="modal" data-target="#myModal">+</a>
                  <?php } ?>
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Kelola Surat <?php echo $jenis;?> </h3>
							<p class="panel-subtitle">Admin / Surat Internal / Surat <?php echo $jenis;?> </p>
						</div>
						<div class="panel-body">
						
							<table class="display" id="data">
							    <thead>
							        <tr>
                                        <th>No.</th>
							            <th>Isi Ringkas</th>
							            <?php if($jenis == 'Keluar'){ ?>
							                <th>Destinasi Surat</th>
							            <?php } else { ?>
							            <th>Asal Surat</th>
							            <?php } ?>
							            <th>Keterangan Surat</th>
							            <th>Atribut Surat</th>
							            <th>Opsi</th>
							        </tr>
							    </thead>
							    <tbody>
							        
                                    <?php $no = 1; foreach($set as $row){ ?>
                                    <tr>
                                        <td><?php echo $no++;?></td>
                                        <?php if($jenis == "Keluar"){ ?>
                                            
                                            <?php if(empty($row->file_path)){ ?>
                                                <td>
                                                    <p><?php echo $row->isi_ringkas;?></p> <br/>
                                                    <label class="label label-primary">Tidak ada berkas yang di unggah</label>
                                                </td>
                                            <?php } else { ?>
                                                <td>
                                                    <small><?php echo $row->isi_ringkas;?></small> <br/>
                                                     <label class="label label-success">Berkas telah di unggah</label>
                                                </td>
                                            <?php } ?>
                                        
                                        <?php } else { ?>
                                           
                                            <?php if(empty($row->file_path)){ ?>
                                                <td>
                                                    <p><?php echo $row->isi_ringkas;?></p> <br/>
                                                    <label class="label label-primary">Tidak ada berkas yang di unggah</label>
                                                </td>
                                            <?php } else { ?>
                                                <td>
                                                    <small><?php echo $row->isi_ringkas;?></small> <br/>
                                                    File : <a href="<?php echo base_url($row->file_path);?>">Download</a>
                                                </td>
                                            <?php } ?>
                                            
                                        <?php } ?>
                                        
                                        
                                        <?php if($jenis == 'Keluar'){ ?>   
                                            <td>
                                                <small>
                                                    Tujuan: <?php echo $row->nama_pegawai_penerima;?> <br/>
                                                    Jabatan: <?php echo $row->nama_jabatan_penerima;?> <br/>
                                                    Unit Kerja : <?php echo $row->nama_unit_penerima;?>
                                                </small>
                                            </td>
                                        <?php } else { ?>
                                            <td>
                                                <small>
                                                    Asal: <?php echo $row->nama_pegawai_pengirim;?> <br/>
                                                    Jabatan: <?php echo $row->nama_jabatan_pengirim;?> <br/>
                                                    Unit Kerja : <?php echo $row->nama_unit_pengirim;?>
                                                </small>
                                            </td>
                                        <?php } ?>    
                                            <td>
							                    <small>
                                                    No. Surat: <font color="green"><?php echo $row->nomor_surat;?></font><br/>
                                                    <?php $tanggal = date_create($row->tanggal_surat); $tgl = date_format($tanggal,'d-F-Y');?>
                                                    Tanggal Surat: <?php echo $tgl;?> <br/>
                                                    Perihal: <?php echo $row->perihal;?>                                                 
							                     </small>   
							                </td>
							                <td>
							                   <small>
							                       Jenis Surat: <?php echo $row->nama_jenis;?><br/>
							                       Prioritas Surat: <?php echo $row->nama_prioritas;?><br/>
							                       Sifat Surat: <?php echo $row->nama_sifat;?><br/>
							                       Media Pengiriman: <?php echo $row->nama_media;?>    
							                   </small> 
							                </td>
							             <?php if($jenis == 'Keluar'){ ?>
							                 <td>
                                                
                                                 <?php echo anchor('surat-internal/destroy/'.$row->id_surat_internal,'<button class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>',array('onclick' => 'return confirm("Anda yakin ingin menghapus data ini?")'));?> 
							                </td>
							             <?php } else { ?>
							                 <td>
							                     <?php echo anchor('disposisi-internal/daftar-disposisi/'.$row->id_surat_internal,'<button class="btn btn-success"><i class="fa fa-file"></i> Disposisi</button>');?>
							                 </td>
							             <?php } ?>   
							            
							            </tr>
							         <?php } ?>   
							        
							    </tbody>
							</table>
						</div>
					</div>
				
			<!-- END MAIN CONTENT -->
		</div>
    </div>
</div>



<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Jenis Kegiatan</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart('surat-internal/create',array('id' => 'form'));?>
        <div class="row">
            <div class="col-md-6">
                <input type="hidden"  name="id_surat_internal"/>
                <input type="hidden" name="asal_surat" value="<?php echo $pembuat;?>">
                
                <div class="form-group">
                    <label>Nomor Surat</label>
                    <input type="text" name="nomor_surat" class="form-control">
                </div>
                
                <div class="form-group">
                    <label>Perihal</label>
                    <input type="text" name="perihal" class="form-control">
                </div>
                
                <div class="form-group">
                    <label>Destinasi Surat</label>
                    <select name="destinasi_surat" class="form-control" id="pegawai-akun" style="width:100%!important;">
                       <?php foreach($set_destinasi as $row_des) { ?>
                        <option value="<?php echo $row_des->id_user;?>"><?php echo $row_des->nama_pegawai;?> (<?php echo $row_des->nama_jabatan;?> - <?php echo $row_des->nama_unit;?>)</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                   <label>Isi Ringkas</label>
                   <textarea name="isi_ringkas" class="form-control"></textarea>
                </div>
                
                <div class="form-group">
                    <label>Tanggal Surat</label>
                    <input type="date" name="tanggal_surat" class="form-control">
                </div>
                <div class="form-group">
                    <label>Tanggal Transaksi</label>
                    <input type="date" name="tanggal_transaksi" class="form-control">
                </div>
                
            </div>
            <div class="col-md-6">
             
               <div class="form-group">
                <label>Jenis Surat</label>
                <select name="id_jenis" class="form-control">
                    <?php foreach($set_jenis as $row_jenis){ ?>
                        <option value="<?php echo $row_jenis->id_jenis;?>">
                            <?php echo $row_jenis->nama_jenis;?>
                        </option>
                    <?php } ?>
                </select>
               </div>
               
               <div class="form-group">
                <label> Prioritas Surat</label>
                <select name="id_prioritas" class="form-control">
                    <?php foreach($set_prioritas as $row_prioritas){ ?>
                        <option value="<?php echo $row_prioritas->id_prioritas;?>">
                            <?php echo $row_prioritas->nama_prioritas;?>
                        </option>
                    <?php } ?>
                </select>
               </div>
               
               <div class="form-group">
                <label> Sifat Surat</label>
                <select name="id_sifat" class="form-control">
                    <?php foreach($set_sifat as $row_sifat){ ?>
                        <option value="<?php echo $row_sifat->id_sifat;?>">
                            <?php echo $row_sifat->nama_sifat;?>
                        </option>
                    <?php } ?>
                </select>
               </div>
               
               <div class="form-group">
                <label> Media Pengiriman Surat</label>
                <select name="id_media" class="form-control">
                    <?php foreach($set_media as $row_media){ ?>
                        <option value="<?php echo $row_media->id_media;?>">
                            <?php echo $row_media->nama_media;?>
                        </option>
                    <?php } ?>
                </select>
               </div>
               
               <div class="form-group">
                   <label>Lokasi Penyimpanan Berkas</label>
                   <textarea name="lokasi_surat" class="form-control"></textarea>
               </div>
               
               <div class="form-group">
                    <label>Unggah Berkas</label><br/>
                    <label class="file-upload btn btn-primary">
                        Cari Berkas...<input type="file" name="file_path">
                    </label>
                    
                </div>
            </div>
        </div>
        
        
        <div class="modal-footer">
            <input type="submit" name="submit" value="Tambah" class="btn btn-success">
            <?php echo form_close();?>
        </div>
      </div>
      
    </div>

  </div>
</div>
