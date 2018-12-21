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
							<h3 class="panel-title">Kelola Formulir & Blanko </h3>
							<p class="panel-subtitle">Admin / Formulir & Blanko</p>
						</div>
						<div class="panel-body">
						
							<table class="display" id="data">
							    <thead>
							        <tr>
                                        <th>No.</th>
                                        <th>Nama Formulir / Blanko</th>
							            <th>Tanggal Berkas</th>
							            <th>Keterangan</th>
							            
							            <th>Opsi</th>
							        </tr>
							    </thead>
							    <tbody>
							        
                                    <?php $no = 1; foreach($set as $row){ ?>
                                    <tr>
                                        <td><?php echo $no++;?></td>
                                        <td><?php echo $row->nama_formulir;?> <br/>
                                            <small>File:</small> <a href="<?php echo base_url($row->file_path);?>">Download</a>
                                        </td>
                                        <?php $tanggal = date_create($row->tanggal_formulir); $tgl = date_format($tanggal,'d-F-Y');?>
                                        <td><?php echo $tgl;?></td>
                                        <?php if(empty($row->keterangan)){ ?>
                                            <td><small style="color:red">Keterangan Kosong</small></td>
                                        <?php } else { ?>
                                            <td><?php echo $row->keterangan;?></td>
                                        <?php } ?>                                        
                                        <td>
                                            <?php echo anchor('arsip-formulir/destroy/'.$row->id_formulir,'<button class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>');?>
                                        </td>
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
        $('.modal-title').text('Tambah Formulir & Blanko'); // Set title to Bootstrap modal title
        $('[name=submit]').val('Tambah').show();
       // $('#form').attr({'action':'<?php echo site_url('arsip_formulir/create');?>','enctype':'multipart/form-data'});
        $('.modal-footer').show();
    }

</script>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Jenis Kegiatan</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart('arsip_formulir/create',array('id' => 'form'));?>
        <input type="hidden"  name="id_formulir"/>

        <div class="form-group">
            <label>Nama Formulir / Blanko</label>
            <input type="text" name="nama_formulir" class="form-control">
        </div>
        
        <div class="form-group">
            <label>Tanggal Berkas</label>
            <input type="date" name="tanggal_formulir" class="form-control">
        </div>
        
        <div class="form-group">
           <label>Keterangan</label><small style="color:red">*optional</small>
           <textarea name="keterangan" class="form-control"></textarea>
        </div>
        
        <div class="form-group">
            <label>Unggah Berkas</label><br/>
            <label class="file-upload btn btn-primary">
                Cari Berkas...<input type="file" name="file_path">
            </label>
                    
        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit" value="Tambah" class="btn btn-success">
            <?php echo form_close();?>
        </div>
      </div>
      
    </div>

  </div>
</div>
