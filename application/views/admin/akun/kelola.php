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
							<h3 class="panel-title">Kelola Pengguna </h3>
							<p class="panel-subtitle">Admin / Pengguna</p>
						</div>
						<div class="panel-body">
						
							<table class="display" id="data">
							    <thead>
							        <tr>
                                        <th>No.</th>
                                        <th>Akun</th>
							            <th>Jabatan</th>
							            <th>Unit Kerja</th>
							            <th>Status</th>
							            <th>Opsi</th>
							        </tr>
							    </thead>
							    <tbody>
							        
                                    <?php $no = 1; foreach($set as $row){ ?>
                                    <tr>
                                        <td><?php echo $no++;?></td>
							            <td>
                                            <small>
                                                Nama: <?php echo $row->name;?><br/>
                                                Pegawai: <?php echo $row->nama_pegawai;?> <br/>
                                                Email: <?php echo $row->email;?> 
                                            </small>
                                        </td> 
                                        <td><?php echo $row->nama_jabatan;?></td> 
							            <td><?php echo $row->nama_unit;?></td>
							        <?php if($row->level == 1){ ?>
							            <td><span class="label label-primary">Admin</span></td>
							        <?php } else { ?>
							            <td><span class="label label-warning">Pengguna</span></td>
                                    <?php } ?>      
							            <td>
							                <button class="btn btn-warning" onclick="edit_supplier(<?php echo $row->id_user;?>)"><i class="fa fa-edit"></i> Edit</button>
							                <button class="btn btn-info" onclick="reset(<?php echo $row->id_user;?>)"><i class="fa fa-undo"></i> Reset Password</button> 
							                 <?php echo anchor('pengguna/destroy/'.$row->id_user,'<button class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>',array('onclick' => 'return confirm("Anda yakin ingin menghapus data ini?")'));?> 
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
        $('.modal-title').text('Tambah Pengguna'); // Set title to Bootstrap modal title
        $('#passwordnew').css('display','none');
        $('#password').show();
        $('#pengguna').show();
        $('#pegawai').show();
        $('#email').show();  
        $('#password label').text('Password');  
        $('[name=submit]').val('Tambah').show();
        $('#form').attr('action','<?php echo site_url('pengguna/create');?>');
        $('.modal-footer').show();
    }

    function edit_supplier(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('pengguna/get')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_user"]').val(data.id_user);
            $('[name="name"]').val(data.name);
            $('[name="email"]').val(data.email);
            $('#password').css('display','none');
            $('#passwordnew').css('display','none');
            $('#confirm').css('display','none');
            $('#myModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Pengguna'); // Set title to Bootstrap modal title
            $('[name=submit]').val('Edit').show();
            $('.modal-footer').show();
            $('#form').attr('action','<?php echo site_url('pengguna/update');?>');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax'+jqXHR);
        }
    });
    }
    
    function reset(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('pengguna/get')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_user"]').val(data.id_user);
            $('#pengguna').css('display','none');
            $('#email').css('display','none');
            $('#pegawai').css('display','none');
            $('#password').show();
            $('#password label').text('Password Lama');
            $('#passwordnew').show();
            $('#confirm').show();
            $('#myModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Reset Password'); // Set title to Bootstrap modal title
            $('[name=submit]').val('Reset').show();
            $('.modal-footer').show();
            $('#form').attr('action','<?php echo site_url('pengguna/reset-password');?>');
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
        <?php echo form_open('pengguna/create',array('id' => 'form'));?>
        <input type="hidden"  name="id_user"/>

        <div class="form-group" id="pengguna">
            <label>Nama Akun</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group" id="pegawai">
            <label>Pegawai</label>
            <select name="id_pegawai" class="form-control" id="pegawai-akun" style="width:100%!important;">
               <?php foreach($set_pegawai as $row_pegawai) { ?>
                <option value="<?php echo $row_pegawai->id_pegawai;?>"><?php echo $row_pegawai->nama_pegawai;?> (<?php echo $row_pegawai->nama_jabatan;?> - <?php echo $row_pegawai->nama_unit;?>)</option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group" id="email">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        
        <div class="form-group" id="password">
            <label>Password</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        
        <div class="form-group" id="passwordnew">
            <label>Password Baru</label>
            <input type="password" name="new_password"  class="form-control" id="new_password" >
        </div>
        <div class="form-group" id="confirm">
            <label>Konfirmasi Password</label> <small id="notif-confirm"></small>
            <input type="password" name="confirm"  class="form-control">
        </div>
       
        <div class="modal-footer">
            <input type="submit" name="submit" value="Tambah" class="btn btn-success" id="button-disabled">
            <?php echo form_close();?>
        </div>
      </div>
      
    </div>

  </div>
</div>
