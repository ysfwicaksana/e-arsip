<?php
if(defined('basepath')) exit ('No direct access script allowed');

class Media_surat extends CI_Controller {
    
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
            $this->message = "Media Pengiriman Surat Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/media-surat');
        } else {
            
            $query = array(
                'nama_media' => $this->input->post('nama_media'),
                'keterangan' => $this->input->post('keterangan')
            );
            
            $this->crud->insert('media_surat',$query);
            $this->message = "Media Pengiriman Surat Baru Berhasil Dibuat :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/media-surat');
            
        }
    }
    
    function get($id){
        
        $data = array(
            'id_media' => $id
        );
        
        $result = $this->crud->get('media_surat',$data)->row();
        echo json_encode($result);
        
    }
    
    function update(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            $this->message = "Media Pengiriman Surat Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/media-surat');
        } else {
            $query = array(
                'nama_media' => $this->input->post('nama_media'),
                'keterangan' => $this->input->post('keterangan')
            );
            
            $this->crud->update('media_surat',$query,'id_media',$this->input->post('id_media'));
            $this->message = "Media Pengiriman Surat Berhasil Diubah :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/media-surat');
        }
    }
    
    function destroy($id){
        $this->message = "Media Pengiriman Surat Berhasil Dihapus :)";
        $this->crud->delete('media_surat','id_media',$id);
        $this->session->set_flashdata('success',$this->message);
        redirect('admin/media-surat');
        
    }
    
    function validation(){
        $this->form_validation->set_rules('nama_media','Jenis Surat','required');

    }
}