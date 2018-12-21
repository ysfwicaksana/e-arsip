<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Disposisi</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
    <style>
        #wrapper {
            width:600px;
            margin:auto;
        }
    </style>
</head>

<body>
  <div id="wrapper">
   <center>
       <img src="<?php echo base_url('assets/img/logoubp.png');?>" alt="Logo UBP" width="70" height="70">
       <h2>LEMBAR DISPOSISI</h2>
       <h4>
           Universitas Buana Perjuangan Karawang<br/>
           <small>
               Jl. H.S Ronggowaluyo Telukjambe Timur - Karawang<br/>
               Telp. 0267-8458159 Fax. 0267-8458160
           </small>
       </h4>
    
   </center>
   <hr/>
    <label>Surat:</label>
    <?php foreach($set_surat as $row_surat){ ?>
    <?php $tanggal = date_create($row_surat->tanggal_surat); $tgl = date_format($tanggal,'d-F-Y');?>
    
            <table>
                <tr>
                    <td>Nomor Surat</td>
                    <td>:</td>
                    <td><?php echo $row_surat->nomor_surat;?> </td>
                </tr>
                 <tr>
                    <td>Tanggal Surat</td>
                    <td>:</td>
                    <td><?php echo $tgl;?></td>
                </tr>
                <tr>
                    <td>Asal Surat</td>
                    <td>:</td>
                    <td><?php echo $row_surat->nama_pegawai;?> (<?php echo $row_surat->nama_jabatan;?> - <?php echo $row_surat->nama_unit;?>)</td>
                </tr>
                 <tr>
                    <td>Perihal</td>
                    <td>:</td>
                    <td><?php echo $row_surat->perihal;?></td>
                </tr>
                <tr>
                    <td>Jenis Surat</td>
                    <td>:</td>
                    <td><?php echo $row_surat->nama_jenis;?></td>
                </tr>
                <tr>
                    <td>Prioritas Surat</td>
                    <td>:</td>
                    <td><?php echo $row_surat->nama_prioritas;?></td>
                </tr>
                <tr>
                    <td>Sifat Surat</td>
                    <td>:</td>
                    <td><?php echo $row_surat->nama_sifat;?></td>
                </tr>
                <tr>
                    <td>Media Pengiriman</td>
                    <td>:</td>
                    <td><?php echo $row_surat->nama_media;?></td>
                </tr>
            </table>
            <hr/>
             <?php } ?>
    <label>Disposisi:</label>
    <?php foreach($set as $row) { ?>
       <?php $tanggal = date_create($row->tanggal_disposisi); $tgl_disposisi = date_format($tanggal,'d-F-Y');?>
        <table>
            
            <tr>
                <td>Tanggal Disposisi</td>
                <td>:</td>
                <td><?php echo $tgl_disposisi;?></td>
            </tr>
            <tr>
                <td>Diteruskan Kepada</td>
                <td>:</td>
                <td><?php echo $row->nama_pegawai;?></td>
            </tr>
            <tr>
                <td>Penyelesaian</td>
                <td>:</td>
                <td><?php echo $row->nama_perintah;?></td>
            </tr>
        </table>
   
    <hr/>
    <label>Isi Disposisi:</label>
    <p><?php echo $row->isi_disposisi;?></p>
    </div>
     <?php } ?>
    <script>
		window.print();
	</script>
</body>
</html>

