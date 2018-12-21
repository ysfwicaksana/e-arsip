<?php

class GlobalCrud extends CI_Model {
    
    function all($table){
        return $this->db->get($table);
    }
    
    function get($table,$id){
        return $this->db->get_where($table,$id);
    }
    
    function insert($table,$query){
        $this->db->insert($table,$query);
    }
    
    function delete($table,$column,$id){
        $this->db->where($column,$id);
        $this->db->delete($table);
    }
    
    function update($table,$query,$column,$id){
        $this->db->where($column,$id);
        $this->db->update($table,$query);
    }
    
    function count_table($table){
        return $this->db->count_all($table);
    }
    
    function twoTablesFusion($table1,$table2,$select,$clause){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2,$clause);
        return $this->db->get();
    }
    
    
}