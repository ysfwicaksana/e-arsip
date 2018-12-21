<?php 

class Pegawai extends CI_Model {
    
    function join_pegawai_jabatan_unitkerja(){
        $this->db->join('unit_kerja','unit_kerja.id_unit = pegawai.id_unit');
        $this->db->join('jabatan','jabatan.id_jabatan = pegawai.id_jabatan');
        $this->db->order_by('nama_pegawai','ASC');
        return $this->db->get('pegawai');
    }
    
    function join_pegawai_user(){
        $this->db->select('id_user, name, email, level, nama_pegawai, nama_jabatan, nama_unit');
        $this->db->from('user');
        $this->db->join('pegawai','pegawai.id_pegawai = user.id_pegawai');
        $this->db->join('jabatan','pegawai.id_jabatan = jabatan.id_jabatan');
        $this->db->join('unit_kerja','pegawai.id_unit = unit_kerja.id_unit');
        return $this->db->get();
    }
    
    function join_pegawai_jabatan(){
        $this->db->order_by('nama_pegawai','asc');
        $this->db->join('jabatan','pegawai.id_jabatan = jabatan.id_jabatan');
        return $this->db->get('pegawai');
    }
    
}