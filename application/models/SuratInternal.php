<?php

class SuratInternal extends CI_Model {
    
    function all(){
        $this->db->select('
            id_surat_internal,
            nomor_surat,
            isi_ringkas,
            tanggal_surat,
            perihal,
            file_path,
            lokasi_surat,
            user.name as name,
            pegawai.nama_pegawai as nama_pegawai,
            jabatan.nama_jabatan as nama_jabatan,
            unit_kerja.nama_unit as nama_unit,
            jenis_surat.nama_jenis as nama_jenis,
            prioritas_surat.nama_prioritas as nama_prioritas,
            sifat_surat.nama_sifat as nama_sifat,
            media_surat.nama_media as nama_media
            
        ');
        $this->db->from('surat_internal');
        $this->db->join('user','user.id_user = surat_internal.destinasi_surat ');
        $this->db->join('pegawai','pegawai.id_pegawai = user.id_pegawai');
        $this->db->join('jabatan','jabatan.id_jabatan = pegawai.id_jabatan');
        $this->db->join('unit_kerja','unit_kerja.id_unit = jabatan.id_unit');
        $this->db->join('jenis_surat','jenis_surat.id_jenis = surat_internal.id_jenis');
        $this->db->join('prioritas_surat','prioritas_surat.id_prioritas = surat_internal.id_prioritas');
        $this->db->join('sifat_surat','sifat_surat.id_sifat = surat_internal.id_sifat');
        $this->db->join('media_surat','media_surat.id_media = surat_internal.id_media');
        
        return $this->db->get();
    }
    
    function get_surat_destinasi($table,$session,$status){
        $this->db->select('
            id_surat_internal,
            pegawai_penerima.nama_pegawai as nama_pegawai_penerima,
            pegawai_pengirim.nama_pegawai as nama_pegawai_pengirim,
            penerima_jabatan.nama_jabatan as nama_jabatan_penerima,
            pengirim_jabatan.nama_jabatan as nama_jabatan_pengirim,
            nomor_surat,
            isi_ringkas,
            tanggal_surat,
            perihal,
            asal_surat,
            file_path,
            lokasi_surat,
            pengirim_unit.nama_unit as nama_unit_pengirim,
            penerima_unit.nama_unit as nama_unit_penerima,
            jenis_surat.nama_jenis as nama_jenis,
            prioritas_surat.nama_prioritas as nama_prioritas,
            sifat_surat.nama_sifat as nama_sifat,
            media_surat.nama_media as nama_media
            
        ');
        $this->db->from('surat_internal');
        $this->db->join('user pengirim','pengirim.id_user = surat_internal.asal_surat');
        $this->db->join('user penerima','penerima.id_user = surat_internal.destinasi_surat');
        $this->db->join('pegawai pegawai_pengirim','pegawai_pengirim.id_pegawai = pengirim.id_pegawai');
        $this->db->join('pegawai pegawai_penerima','pegawai_penerima.id_pegawai = penerima.id_pegawai');
        $this->db->join('jabatan penerima_jabatan','penerima_jabatan.id_jabatan = pegawai_penerima.id_jabatan');
        $this->db->join('jabatan pengirim_jabatan','pengirim_jabatan.id_jabatan = pegawai_pengirim.id_jabatan');
        $this->db->join('unit_kerja penerima_unit','penerima_unit.id_unit = penerima_jabatan.id_unit');
        $this->db->join('unit_kerja pengirim_unit','pengirim_unit.id_unit = pengirim_jabatan.id_unit');
        $this->db->join('jenis_surat','jenis_surat.id_jenis = surat_internal.id_jenis');
        $this->db->join('prioritas_surat','prioritas_surat.id_prioritas = surat_internal.id_prioritas');
        $this->db->join('sifat_surat','sifat_surat.id_sifat = surat_internal.id_sifat');
        $this->db->join('media_surat','media_surat.id_media = surat_internal.id_media');
        $this->db->where($status,$session);
        $this->db->order_by('id_surat_internal','DESC');
        return $this->db->get();
    }
    
    
    
     function set_surat($id){
        $this->db->select('
            id_surat_internal,
            nomor_surat,
            isi_ringkas,
            tanggal_surat,
            perihal,
            file_path,
            lokasi_surat,
            user.name as name,
            pegawai.nama_pegawai as nama_pegawai,
            jabatan.nama_jabatan as nama_jabatan,
            unit_kerja.nama_unit as nama_unit,
            jenis_surat.nama_jenis as nama_jenis,
            prioritas_surat.nama_prioritas as nama_prioritas,
            sifat_surat.nama_sifat as nama_sifat,
            media_surat.nama_media as nama_media
            
        ');
        $this->db->from('surat_internal');
        $this->db->join('user','user.id_user = surat_internal.asal_surat');
        
        $this->db->join('pegawai','pegawai.id_pegawai = user.id_pegawai');
        $this->db->join('jabatan','jabatan.id_jabatan = pegawai.id_jabatan');
        $this->db->join('unit_kerja','unit_kerja.id_unit = jabatan.id_unit');
        $this->db->join('jenis_surat','jenis_surat.id_jenis = surat_internal.id_jenis');
        $this->db->join('prioritas_surat','prioritas_surat.id_prioritas = surat_internal.id_prioritas');
        $this->db->join('sifat_surat','sifat_surat.id_sifat = surat_internal.id_sifat');
        $this->db->join('media_surat','media_surat.id_media = surat_internal.id_media');
        $this->db->where('id_surat_internal',$id);
        return $this->db->get();
    }
    
     function join_disposisi_perintah_pegawai($query){
        $this->db->select("*");
        $this->db->join('perintah_disposisi','perintah_disposisi.id_perintah = disposisi_internal.id_perintah');
        $this->db->join('pegawai','pegawai.id_pegawai = disposisi_internal.tujuan_disposisi');
        $this->db->where('id_surat_internal',$query);
        return $this->db->get('disposisi_internal');
    }
    
    function join_disposisi($query){
        $this->db->select("*");
        $this->db->join('perintah_disposisi','perintah_disposisi.id_perintah = disposisi_internal.id_perintah');
        $this->db->join('pegawai','pegawai.id_pegawai = disposisi_internal.tujuan_disposisi');
        $this->db->where('id_disposisi_internal',$query);
        return $this->db->get('disposisi_internal');
    }
    
    function disposisi_internal($id){
        $this->db->select('
            nomor_surat,
            tanggal_surat,
            perihal,
            nama_pegawai,
            nama_jabatan,
            nama_unit,
            nama_jenis,
            nama_prioritas,
            nama_sifat,
            nama_media,
        ');
        $this->db->join('surat_internal','surat_internal.id_surat_internal = disposisi_internal.id_surat_internal ');
        $this->db->join('user','user.id_user = surat_internal.asal_surat');
        $this->db->join('pegawai','pegawai.id_pegawai = user.id_pegawai');
        $this->db->join('jabatan','jabatan.id_jabatan = pegawai.id_jabatan');
        $this->db->join('unit_kerja','unit_kerja.id_unit = jabatan.id_unit');
        $this->db->join('jenis_surat','jenis_surat.id_jenis = surat_internal.id_jenis');
        $this->db->join('prioritas_surat','prioritas_surat.id_prioritas = surat_internal.id_prioritas');
        $this->db->join('sifat_surat','sifat_surat.id_sifat = surat_internal.id_sifat');
        $this->db->join('media_surat','media_surat.id_media = surat_internal.id_media');
        $this->db->where('id_disposisi_internal',$id);
        return $this->db->get('disposisi_internal');
        
    }
}