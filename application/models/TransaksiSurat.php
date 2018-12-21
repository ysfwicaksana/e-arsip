<?php

class TransaksiSurat extends CI_Model {
    
    var $table = 'transaksi_surat';
    
    function allForUser($region,$id_user){
        $this->db->where('region',$region);
        $this->db->where('id_user',$id_user);
        return $this->db->get($this->table);
    }
    
}