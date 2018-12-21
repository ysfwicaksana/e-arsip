<?php
if(defined('basepath')) exit ('No direct access script allowed');

class Unit_kerja extends CI_Controller {
    
    var $message;
    
    function __construct(){
        parent::__construct();
        $this->load->model('GlobalCrud','crud');
        if($this->session->userdata('level') != 1){
            redirect('login');
        }
    }
    
    function create(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            $this->message = "Nama Unit & Kepala Unit Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/unit-kerja');
        } else {
            
            $query = array(
                'nama_unit' => $this->input->post('nama_unit'),
                'kepala_unit' => $this->input->post('kepala_unit'),
                'keterangan' => $this->input->post('keterangan')
            );
            
            $this->crud->insert('unit_kerja',$query);
            $this->message = "Unit Kerja Baru Berhasil Dibuat :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/unit-kerja');
            
        }
    }
    
    function get($id){
        
        $data = array(
            'id_unit' => $id
        );
        
        $result = $this->crud->get('unit_kerja',$data)->row();
        echo json_encode($result);
        
    }
    
    function update(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            $this->message = "Nama Unit dan Kepala Unit Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/unit-kerja');
        } else {
            $query = array(
                'nama_unit' => $this->input->post('nama_unit'),
                'kepala_unit' => $this->input->post('kepala_unit'),
                'keterangan' => $this->input->post('keterangan')
            );
            
            $this->crud->update('unit_kerja',$query,'id_unit',$this->input->post('id_unit'));
            $this->message = "Unit Kerja Berhasil Diubah :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/unit-kerja');
        }
    }
    
    function destroy($id){
        $this->message = "Unit Kerja Berhasil Dihapus :)";
        $this->crud->delete('unit_kerja','id_unit',$id);
        $this->session->set_flashdata('success',$this->message);
        redirect('admin/unit-kerja');
        
    }
    
    function validation(){
        $this->form_validation->set_rules('nama_unit','Jenis Surat','required');
        $this->form_validation->set_rules('kepala_unit','Jenis Surat','required');

    }
}