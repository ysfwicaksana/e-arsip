<?php
if(defined('basepath')) exit ('No direct access script allowed');

class Arsip_dokumen extends CI_Controller {
    
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
            $this->message = "Komponen Dokumen Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/arsip-dokumen');
        } else {
            $config = array(
                'upload_path' => 'files/arsip-dokumen',
                'allowed_types' => 'png|jpg|pdf|docx|doc|xls|xlsx',
                'remove_space' => TRUE,
                'max_size' => 50000,
                'min_width' => 1,
                'min_height' => 1,
                'max_width' => 1028,
                'max_height' => 768
            );
            
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            if($this->upload->do_upload('file_path')){
                
                $file = $this->upload->data();
                
                $query = array(
                    'nama_dokumen' => $this->input->post('nama_dokumen'),
                    'tanggal_dokumen' => $this->input->post('tanggal_dokumen'),
                    'keterangan' => $this->input->post('keterangan'),
                    'file_path' => $config['upload_path']."/".$file['file_name'],
                    
                );
                
                $this->crud->insert('arsip_dokumen',$query);
                $this->message = "Dokumen Berhasil Dibuat !";
                $this->session->set_flashdata('success',$this->message);            
                redirect('admin/arsip-dokumen');
                
            } else {
                $this->message = "Berkas gagal diupload !";
                $this->session->set_flashdata('warning',$this->message);            
                redirect('admin/arsip-formulir');
            }
        }
    }
    
    function destroy($id){
        $this->crud->delete('arsip_dokumen','id_dokumen',$id);
        $this->message = "Dokumen Berhasil Dihapus !";
        $this->session->set_flashdata('success',$this->message);            
        redirect('admin/arsip-dokumen');
    }
    
   function validation(){
        $this->form_validation->set_rules('nama_dokumen','','required');
        $this->form_validation->set_rules('tanggal_dokumen','','required');
    }
}