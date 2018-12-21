<?php
if(defined('basepath')) exit ('No direct access script allowed');

class Sifat_surat extends CI_Controller {
    
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
            $this->message = "Sifat Surat Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/sifat-surat');
        } else {
            
            $query = array(
                'nama_sifat' => $this->input->post('nama_sifat'),
                'keterangan' => $this->input->post('keterangan')
            );
            
            $this->crud->insert('sifat_surat',$query);
            $this->message = "Sifat Surat Baru Berhasil Dibuat :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/sifat-surat');
            
        }
    }
    
    function get($id){
        
        $data = array(
            'id_sifat' => $id
        );
        
        $result = $this->crud->get('sifat_surat',$data)->row();
        echo json_encode($result);
        
    }
    
    function update(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            $this->message = "Sifat Surat Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/sifat-surat');
        } else {
            $query = array(
                'nama_sifat' => $this->input->post('nama_sifat'),
                'keterangan' => $this->input->post('keterangan')
            );
            
            $this->crud->update('sifat_surat',$query,'id_sifat',$this->input->post('id_sifat'));
            $this->message = "Sifat Surat Berhasil Diubah :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/sifat-surat');
        }
    }
    
    function destroy($id){
        $this->message = "Sifat Surat Berhasil Dihapus :)";
        $this->crud->delete('sifat_surat','id_sifat',$id);
        $this->session->set_flashdata('success',$this->message);
        redirect('admin/sifat-surat');
        
    }
    
    function validation(){
        $this->form_validation->set_rules('nama_sifat','Nama Sifat','required');

    }
}