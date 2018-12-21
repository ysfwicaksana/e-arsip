<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
				    <?php echo $this->session->flashdata('notify');?>
				    <?php echo validation_errors();?>
					<!-- OVERVIEW -->
                  
				        <a href="#" class="act-btn" onclick="add_supplier() ">+</a>
                 
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Kelola Surat <?php echo $jenis;?> </h3>
							<p class="panel-subtitle">Admin / Surat Eksternal / Surat <?php echo $jenis;?> </p>
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
                                        <?php if($jenis == 'Keluar'){ ?>
                                        
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
                                                    File: <a href="<?php echo base_url($row->file_path);?>">Download</a>
                                                </td>
                                            <?php } ?>
                                             
                                        <?php } ?>
                                        
                                        <?php if($jenis == 'Keluar'){ ?>   
                                            <td>
                                                <small>
                                                    <?php echo $row->tujuan_surat_luar;?>
                                                </small>
                                            </td>
                                        <?php } else { ?>
                                            <td>
                                                <small>
                                                    <?php echo $row->asal_surat_luar;?>
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
							                       Media asalan: <?php echo $row->nama_media;?>    
							                   </small> 
							                </td>
							             <?php if($jenis == 'Keluar'){ ?>
							                 <td>
                                                
                                                 <?php echo anchor('surat-eksternal/destroy/'.$row->id_surat_eksternal,'<button class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>',array('onclick' => 'return confirm("Anda yakin ingin menghapus data ini?")'));?> 
							                </td>
							             <?php } else { ?>
							                 <td>
							                     <?php echo anchor('disposisi-eksternal/daftar-disposisi/'.$row->id_surat_eksternal,'<button class="btn btn-success"><i class="fa fa-file"></i> Disposisi</button>');?>
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

<script>
    
   
    function add_supplier(){
        $('#form')[0].reset();
        $("#myModal").modal('show');
        <?php if($jenis == 'Keluar'){ ?>
            $('.modal-title').text('Tambah Surat Keluar');
            $('#form').attr({'action':'<?php echo site_url('surat-eksternal/create');?>','enctype' :'multipart/form-data'});
        <?php } else { ?>
            $('.modal-title').text('Tambah Surat Masuk');
            $('#form').attr({'action':'<?php echo site_url('surat-eksternal/create2');?>','enctype' :'multipart/form-data'});
        <?php } ?>
        // Set title to Bootstrap modal title
        $('[name=submit]').val('Tambah').show();
        
        
        $('.modal-footer').show();
    }

   
</script>

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
                <input type="hidden"  name="id_surat_eksternal"/>
               
                
                <div class="form-group">
                    <label>Nomor Surat</label>
                    <input type="text" name="nomor_surat" class="form-control">
                </div>
                
                <div class="form-group">
                    <label>Perihal</label>
                    <input type="text" name="perihal" class="form-control">
                </div>
                <?php if($jenis == 'Keluar'){ ?>
                <div class="form-group">
                    <label>Destinasi Surat</label>
                    <textarea name="tujuan_surat_luar" class="form-control"></textarea>
                    <input type="hidden" name="asal_surat_pengguna" value="<?php echo $this->session->userdata('id_user');?>"/>
                </div>
                 <?php } else if($jenis == 'Masuk') { ?>
                <input type="hidden" name="tujuan_surat_pengguna" value="<?php echo $this->session->userdata('id_user');?>">  
                   <div class="form-group">
                        <label>Asal Surat</label>
                        <textarea class="form-control" name="asal_surat_luar"></textarea> 
                    </div>
               <?php } ?>
               
              
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
