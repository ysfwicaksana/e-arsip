<?php

class Jabatan extends CI_Model {
    
    function join_jabatan_unitkerja(){
        $this->db->order_by('nama_jabatan','asc');
        $this->db->join('unit_kerja','unit_kerja.id_unit = jabatan.id_unit');
        return $this->db->get('jabatan');
    }
    
}