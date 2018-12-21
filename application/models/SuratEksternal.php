<?php

class SuratEksternal extends CI_Model {
    
    
    function get_surat_destinasi($table,$status,$session){
        //$this->db->select('*');
        $this->db->select('
            id_surat_eksternal,
            pegawai_asal.nama_pegawai as nama_pegawai_asal,
            pegawai_tujuan.nama_pegawai as nama_pegawai_tujuan,
            jabatan_asal.nama_jabatan as nama_jabatan_asal,
            jabatan_tujuan.nama_jabatan as nama_jabatan_tujuan,
            unitkerja_tujuan.nama_unit as nama_unit_tujuan,
            unitkerja_asal.nama_unit as nama_unit_asal,
            nomor_surat,
            isi_ringkas,
            tanggal_surat,
            perihal,
            asal_surat_luar,
            tujuan_surat_luar,
            file_path,
            lokasi_surat,
            jenis_surat.nama_jenis as nama_jenis,
            prioritas_surat.nama_prioritas as nama_prioritas,
            sifat_surat.nama_sifat as nama_sifat,
            media_surat.nama_media as nama_media
            
        '); 
        $this->db->from($table);
        $this->db->join('user user_asal','user_asal.id_user = surat_eksternal.asal_surat_pengguna','left');
        $this->db->join('user user_tujuan','user_tujuan.id_user = surat_eksternal.tujuan_surat_pengguna','left');
        $this->db->join('pegawai pegawai_asal','pegawai_asal.id_pegawai = user_asal.id_pegawai','left');
        $this->db->join('pegawai pegawai_tujuan','pegawai_tujuan.id_pegawai = user_tujuan.id_pegawai','left');
        $this->db->join('jabatan jabatan_asal','jabatan_asal.id_jabatan = pegawai_asal.id_jabatan','left');
        $this->db->join('jabatan jabatan_tujuan','jabatan_tujuan.id_jabatan = pegawai_tujuan.id_jabatan','left');
        $this->db->join('unit_kerja unitkerja_tujuan','unitkerja_tujuan.id_unit = jabatan_tujuan.id_unit','left');
        $this->db->join('unit_kerja unitkerja_asal','unitkerja_asal.id_unit = jabatan_asal.id_unit','left');
        
        $this->db->join('jenis_surat','jenis_surat.id_jenis = surat_eksternal.id_jenis');
        $this->db->join('prioritas_surat','prioritas_surat.id_prioritas = surat_eksternal.id_prioritas');
        $this->db->join('sifat_surat','sifat_surat.id_sifat = surat_eksternal.id_sifat');
         $this->db->join('media_surat','media_surat.id_media = surat_eksternal.id_media');
        
        $this->db->where($status,$session);
        $this->db->order_by('id_surat_eksternal','DESC');
        return $this->db->get();
    }
    
    
    
     function set_surat($id){
         
        $this->db->select('
            id_surat_eksternal,
            nomor_surat,
            isi_ringkas,
            tanggal_surat,
            perihal,
            asal_surat_luar,
            jenis_surat.nama_jenis as nama_jenis,
            prioritas_surat.nama_prioritas as nama_prioritas,
            sifat_surat.nama_sifat as nama_sifat,
            media_surat.nama_media as nama_media
            
        '); 
        $this->db->from('surat_eksternal');
        $this->db->join('jenis_surat','jenis_surat.id_jenis = surat_eksternal.id_jenis');
        $this->db->join('prioritas_surat','prioritas_surat.id_prioritas = surat_eksternal.id_prioritas');
        $this->db->join('sifat_surat','sifat_surat.id_sifat = surat_eksternal.id_sifat');
        $this->db->join('media_surat','media_surat.id_media = surat_eksternal.id_media');
        
        $this->db->where('id_surat_eksternal',$id);
        return $this->db->get();
    }
    
     function join_disposisi_perintah_pegawai($query){
        $this->db->select("*");
        $this->db->join('perintah_disposisi','perintah_disposisi.id_perintah = disposisi_eksternal.id_perintah');
        $this->db->join('pegawai','pegawai.id_pegawai = disposisi_eksternal.tujuan_disposisi');
        $this->db->where('id_surat_eksternal',$query);
        return $this->db->get('disposisi_eksternal');
    }
    
    function join_disposisi($id){
        $this->db->select("*");
        $this->db->join('perintah_disposisi','perintah_disposisi.id_perintah = disposisi_eksternal.id_perintah');
        $this->db->join('pegawai','pegawai.id_pegawai = disposisi_eksternal.tujuan_disposisi');
        $this->db->where('id_disposisi_eksternal',$id);
        return $this->db->get('disposisi_eksternal');
    }
    
    function disposisi_eksternal($id){
        $this->db->select('
            nomor_surat,
            tanggal_surat,
            perihal,
            asal_surat_luar,
            nama_jenis,
            nama_prioritas,
            nama_sifat,
            nama_media,
        ');
        $this->db->join('surat_eksternal','surat_eksternal.id_surat_eksternal = disposisi_eksternal.id_surat_eksternal ');
        $this->db->join('jenis_surat','jenis_surat.id_jenis = surat_eksternal.id_jenis');
        $this->db->join('prioritas_surat','prioritas_surat.id_prioritas = surat_eksternal.id_prioritas');
        $this->db->join('sifat_surat','sifat_surat.id_sifat = surat_eksternal.id_sifat');
        $this->db->join('media_surat','media_surat.id_media = surat_eksternal.id_media');
        $this->db->where('id_disposisi_eksternal',$id);
        return $this->db->get('disposisi_eksternal');
        
    }
}