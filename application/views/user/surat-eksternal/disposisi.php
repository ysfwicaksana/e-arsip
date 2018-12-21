<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
			    <div class="container-fluid">
			        <div class="panel panel-headline">
			            <div class="panel-heading">
			                <h3 class="panel-title">Isi Surat</h3>
			                <?php foreach($set_surat as $row_surat){ ?>
			                <div class="panel-body">
                                <blockquote>
                                    <h6>
                                            <b>Nomor Surat: </b> <?php echo $row_surat->nomor_surat;?> <br/>
                                            <b>Asal:</b>  <?php echo $row_surat->asal_surat_luar;?><br/>
                                            <b>Perihal: </b><?php echo $row_surat->perihal;?><br/>
                                            <?php $tanggal = date_create($row_surat->tanggal_surat); $tgl = date_format($tanggal,'d-F-Y');?>
                                            <b>Tanggal Surat:</b> <?php echo $tgl;?>
                                        
                                    </h6>
                                    <?php echo $row_surat->isi_ringkas;?><br/>
                                    
                                    
                                </blockquote>
                                <hr/>
                                
                                <label>Keterangan:</label><br/>
                                <small>
                                    <b>Jenis Surat:</b><?php echo $row_surat->nama_jenis;?><br/>
                                    <b>Prioritas Surat:</b><?php echo $row_surat->nama_prioritas;?><br/>
                                    <b>Sifat Surat:</b><?php echo $row_surat->nama_sifat;?><br/>
                                    <b>Media Pengiriman:</b><?php echo $row_surat->nama_media;?>
                                </small>
			                </div>
			                <?php } ?>
			            </div>
			        </div>
			    </div>
				<div class="container-fluid">
				    <?php echo $this->session->flashdata('notify');?>
				    <?php echo validation_errors();?>
					<!-- OVERVIEW -->
                  
				        <a href="#" class="act-btn" onclick="add_supplier() ">+</a>
                 
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Kelola Disposisi </h3>
							<p class="panel-subtitle">Surat Internal / Disposisi </p>
						</div>
						<div class="panel-body">
						
							<table class="display" id="data">
							    <thead>
							        <tr>
                                        <th>No.</th>
							            <th>Diteruskan Kepada</th>
                                        <th>Isi Disposisi</th>
                                        
							            <th>Keterangan</th>
							            <th>Opsi</th>
							        </tr>
							    </thead>
							    <tbody>
							        
                                    <?php $no = 1; foreach($set as $row){ ?>
                                    <tr>
                                        <td><?php echo $no++;?></td>
                                        <td><?php echo $row->nama_pegawai;?></td>
                                        <td><?php echo $row->isi_disposisi;?></td>
                                       
                                        <td>
                                            <?php $tanggal = date_create($row->tanggal_disposisi); $tgl = date_format($tanggal,'d-F-Y');?>
                                            <small>
                                                Tanggal Disposisi: <?php echo $tgl;?><br/>
                                                Perintah: <?php echo $row->nama_perintah;?><br/>
                                            </small>               
                                        </td>
                                        <td>
                                           <?php echo anchor('disposisi-eksternal/print/'.$row->id_disposisi_eksternal,'<button class="btn btn-warning"><i class="fa fa-print"></i> Print</button>',array('target','_BLANK'));?>
                                           
                                            <button class="btn btn-success" onclick="edit_supplier(<?php echo $row->id_disposisi_eksternal;?>)"><i class="fa fa-edit"></i> Ubah</button>
                                            
                                            
                                            
                                            <?php echo anchor('disposisi-eksternal/destroy/'.$row->id_disposisi_eksternal,'<button class="btn btn-danger"><i class="fa fa-trash"></i> Hapus </button>');?>
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
        $('.modal-title').text('Tambah Disposisi'); // Set title to Bootstrap modal title
        $('[name=submit]').val('Tambah').show();
        $('#form').attr('action','<?php echo site_url('disposisi_eksternal/create');?>');
        $('.modal-footer').show();
    }

    function edit_supplier(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('disposisi-eksternal/get')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_disposisi_eksternal"]').val(data.id_disposisi_eksternal);
             $('[name="id_surat_eksternal"]').val(data.id_surat_eksternal);
            $('[name="isi_disposisi"]').val(data.isi_disposisi);
            $('[name="tanggal_disposisi"]').val(data.tanggal_disposisi);
           
            
           


            $('#myModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Disposisi'); // Set title to Bootstrap modal title
            $('[name=submit]').val('Edit').show();
            $('.modal-footer').show();
            $('#form').attr('action','<?php echo site_url('disposisi-eksternal/update');?>');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax'+jqXHR);
        }
    });
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
        <?php echo form_open('disposisi/create',array('id' => 'form'));?>
       
          <div class="row">
              <div class="col-md-6">
                  <input type="hidden" name="id_surat_eksternal" value="<?php echo $id_surat_eksternal;?>"/>
                  <input type="hidden" name="id_disposisi_eksternal">
                    <div class="form-group">
                        <label>Isi Disposisi</label>
                        <textarea name="isi_disposisi" class="form-control"></textarea>

                    </div>

                    <div class="form-group">
                        <label>Tanggal Disposisi</label>
                        <input type="date" name="tanggal_disposisi" class="form-control">
                    </div>

                     <div class="form-group">
                        <label>Penyelesaian</label>
                        <select name="id_perintah" class="form-control">
                            <?php foreach($set_perintah as $row_perintah){ ?>
                                <option value="<?php echo $row_perintah->id_perintah;?>"><?php echo $row_perintah->nama_perintah;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
              </div>
              <div class="col-md-6">
                   <div class="form-group">
                    <label>Unit Kerja</label>
                    <select  class="form-control" id="set_unit_kerja">
                       <?php foreach($set_unit as $row_unit){ ?>
                        <option <?php echo $unit_selected == $row_unit->id_unit ? 'selected="selected"' : ''?> value="<?php echo $row_unit->id_unit;?>"><?php echo $row_unit->nama_unit;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <select  class="form-control" id="set_jabatan">
                       <?php foreach($set_jabatan as $row_jabatan){ ?>
                        <option <?php echo $jabatan_selected == $row_jabatan->id_unit ? 'selected="selected"' : ''?> value="<?php echo $row_jabatan->id_jabatan;?>"
                        class="<?php echo $row_jabatan->id_unit;?>"><?php echo $row_jabatan->nama_jabatan;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pegawai (Tujuan Disposisi)</label>
                    <select name="tujuan_disposisi" class="form-control" id="set_pegawai">
                       <?php foreach($set_pegawai as $row_pegawai){ ?>
                        <option <?php echo $pegawai_selected == $row_pegawai->id_jabatan ? 'selected="selected"' : ''?> value="<?php echo $row_pegawai->id_pegawai;?>"
                        class="<?php echo $row_pegawai->id_pegawai;?>"><?php echo $row_pegawai->nama_pegawai;?></option>
                        <?php } ?>
                    </select>
                </div>
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
</div>
