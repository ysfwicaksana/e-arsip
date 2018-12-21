<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/js/klorofil-common.js');?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-chained/1.0.1/jquery.chained.min.js"></script>
<script src="<?php echo base_url('assets/js/file-upload.js');?>"></script>

<script type="text/javascript">
     <?php if($this->session->flashdata('success')){?>
        toastr.success("<?php echo $this->session->flashdata('success');?>");
     <?php } else if($this->session->flashdata('danger')){ ?>
        toastr.error("<?php echo $this->session->flashdata('danger');?>");
     <?php } else if($this->session->flashdata('warning')){ ?>
        toastr.warning("<?php echo $this->session->flashdata('warning');?>");
     <?php } else if($this->session->flashdata('info')){ ?>
        toastr.info("<?php echo $this->session->flashdata('info');?>");

     <?php } ?>
    
    $(document).ready(function(){
        $("#data").DataTable();
        $("#jabatan").chained('#unit_kerja');
        
        $("#set_jabatan").chained("#set_unit_kerja");
        $("#set_pegawai").chained('#set_jabatan');
        
        $("#pegawai-akun").select2();
        $(".file-upload").file_upload();
        $('[name="confirm"]').keyup(function(e){
            
            e.preventDefault();
            
            var confirm = $('[name="confirm"]').val();
            var password = $('[name="password"]').val();
            
            if(confirm == ''){
                $('#notif-confirm').text('*Sesuaikan Dengan Password Diatas').css({'color':'red','font-weight':'bold'});
                $("#button-disabled").attr('disabled','disabled');
            } else {
                
                if(confirm != password){
                    $('#notif-confirm').text(' Tidak Sesuai Dengan Password Diatas').css('color','red');
                    $("#button-disabled").attr('disabled','disabled');
                
                } else {
                   $('#notif-confirm').text(' Telah Sesuai Dengan Password Diatas').css('color','green');
                   $("#button-disabled").removeAttr('disabled','disabled');

                }
                
            }
        });
         
    });
</script>
</body>
</html>


