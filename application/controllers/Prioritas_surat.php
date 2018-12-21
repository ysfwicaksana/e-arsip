<?php
if(defined('basepath')) exit ('No direct access script allowed');

class Prioritas_surat extends CI_Controller {
    
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
            $this->message = "Prioritas Surat Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/prioritas-surat');
        } else {
            
            $query = array(
                'nama_prioritas' => $this->input->post('nama_prioritas'),
                'keterangan' => $this->input->post('keterangan')
            );
            
            $this->crud->insert('prioritas_surat',$query);
            $this->message = "Prioritas Surat Baru Berhasil Dibuat :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/prioritas-surat');
            
        }
    }
    
    function get($id){
        
        $data = array(
            'id_prioritas' => $id
        );
        
        $result = $this->crud->get('prioritas_surat',$data)->row();
        echo json_encode($result);
        
    }
    
    function update(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            $this->message = "Prioritas Surat Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/prioritas-surat');
        } else {
            $query = array(
                'nama_prioritas' => $this->input->post('nama_prioritas'),
                'keterangan' => $this->input->post('keterangan')
            );
            
            $this->crud->update('prioritas_surat',$query,'id_prioritas',$this->input->post('id_prioritas'));
            $this->message = "Prioritas Surat Berhasil Diubah :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/prioritas-surat');
        }
    }
    
    function destroy($id){
        $this->message = "Prioritas Surat Berhasil Dihapus :)";
        $this->crud->delete('prioritas_surat','id_prioritas',$id);
        $this->session->set_flashdata('success',$this->message);
        redirect('admin/prioritas-surat');
        
    }
    
    function validation(){
        $this->form_validation->set_rules('nama_prioritas','Jenis Surat','required');

    }
}