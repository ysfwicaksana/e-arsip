<?php
if(defined('basepath')) exit ('No direct access script allowed');

class Jenis_surat extends CI_Controller {
    
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
            $this->message = "Jenis Surat Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/jenis-surat');
        } else {
            
            $query = array(
                'nama_jenis' => $this->input->post('nama_jenis'),
                'keterangan' => $this->input->post('keterangan')
            );
            
            $this->crud->insert('jenis_surat',$query);
            $this->message = "Jenis Surat Baru Berhasil Dibuat :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/jenis-surat');
            
        }
    }
    
    function get($id){
        
        $data = array(
            'id_jenis' => $id
        );
        
        $result = $this->crud->get('jenis_surat',$data)->row();
        echo json_encode($result);
        
    }
    
    function update(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            $this->message = "Jenis Surat Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/jenis-surat');
        } else {
            $query = array(
                'nama_jenis' => $this->input->post('nama_jenis'),
                'keterangan' => $this->input->post('keterangan')
            );
            
            $this->crud->update('jenis_surat',$query,'id_jenis',$this->input->post('id_jenis'));
            $this->message = "Jenis Surat Berhasil Diubah :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/jenis-surat');
        }
    }
    
    function destroy($id){
        $this->message = "Jenis Surat Berhasil Dihapus :)";
        $this->crud->delete('jenis_surat','id_jenis',$id);
        $this->session->set_flashdata('success',$this->message);
        redirect('admin/jenis-surat');
        
    }
    
    function validation(){
        $this->form_validation->set_rules('nama_jenis','Jenis Surat','required');

    }
}