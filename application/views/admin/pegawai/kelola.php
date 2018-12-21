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
							<h3 class="panel-title">Kelola Pegawai</h3>
							<p class="panel-subtitle">Admin / Pengaturan Pengguna / Pegawai</p>
						</div>
						<div class="panel-body">
						
							<table class="display" id="data">
							    <thead>
							        <tr>
                                        <th>No.</th>
							            <th>Nama Pegawai</th>
							            <th>Kontak Email</th>
							            <th>Kontak Telepon</th>
							            <th>Unit Kerja</th>
							            <th>Jabatan</th>
							            <th>Opsi</th>
							        </tr>
							    </thead>
							    <tbody>
							        
                                    <?php $no = 1; foreach($set as $row){ ?>
                                    <tr>
                                        <td><?php echo $no++;?></td>
							            <td><?php echo $row->nama_pegawai;?></td> 
							            <td><?php echo $row->kontak_email;?></td>
							            <td><?php echo $row->kontak_telepon;?></td>
							            <td><?php echo $row->nama_unit;?></td>
							            <td><?php echo $row->nama_jabatan;?></td>   
							            <td>
							                <button class="btn btn-warning" onclick="edit_supplier(<?php echo $row->id_pegawai;?>)"><i class="fa fa-edit"></i> Edit</button> 
							                 <?php echo anchor('pegawai/destroy/'.$row->id_pegawai,'<button class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>',array('onclick' => 'return confirm("Anda yakin ingin menghapus data ini?")'));?> 
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
        $('.modal-title').text('Tambah Pegawai'); // Set title to Bootstrap modal title
        $('[name=submit]').val('Tambah').show();
        $('#form').attr('action','<?php echo site_url('pegawai/create');?>');
        $('.modal-footer').show();
    }

    function edit_supplier(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('pegawai/get')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_pegawai"]').val(data.id_pegawai);
            $('[name="nama_pegawai"]').val(data.nama_pegawai);
            $('[name="kontak_email"]').val(data.kontak_email);
            $('[name="kontak_telepon"]').val(data.kontak_telepon);
            $('#myModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Pegawai'); // Set title to Bootstrap modal title
            $('[name=submit]').val('Edit').show();
            $('.modal-footer').show();
            $('#form').attr('action','<?php echo site_url('pegawai/update');?>');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax'+jqXHR);
        }
    });
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
        <?php echo form_open('pegawai/create',array('id' => 'form'));?>
        <input type="hidden"  name="id_pegawai"/>

        <div class="form-group">
            <label>Nama Pegawai</label>
            <input type="text" name="nama_pegawai" class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="kontak_email" class="form-control">
        </div>
        <div class="form-group">
            <label>Telepon</label>
            <input type="text" name="kontak_telepon" class="form-control">
        </div>
        <div class="form-group">
            <label>Unit Kerja</label>
            <select name="id_unit" class="form-control" id="unit_kerja">
               <?php foreach($set_unit as $row_unit){ ?>
                <option <?php echo $unit_selected == $row_unit->id_unit ? 'selected="selected"' : ''?> value="<?php echo $row_unit->id_unit;?>"><?php echo $row_unit->nama_unit;?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Jabatan</label>
            <select name="id_jabatan" class="form-control" id="jabatan">
               <?php foreach($set_jabatan as $row_jabatan){ ?>
                <option <?php echo $jabatan_selected == $row_jabatan->id_unit ? 'selected="selected"' : ''?> value="<?php echo $row_jabatan->id_jabatan;?>"
                class="<?php echo $row_jabatan->id_unit;?>"><?php echo $row_jabatan->nama_jabatan;?></option>
                <?php } ?>
            </select>
        </div>
        <div class="modal-footer">
            <input type="submit" name="submit" value="Tambah" class="btn btn-success">
            <?php echo form_close();?>
        </div>
      </div>
      
    </div>

  </div>
</div>
