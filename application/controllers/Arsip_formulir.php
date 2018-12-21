<?php
if(defined('basepath')) exit ('No direct access script allowed');

class Arsip_formulir extends CI_Controller {
    
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
            $this->message = "Komponen Arsip Formulir Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/arsip-formulir');
        } else {
            $config = array(
                'upload_path' => 'files/arsip-formulir',
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
                    'nama_formulir' => $this->input->post('nama_formulir'),
                    'tanggal_formulir' => $this->input->post('tanggal_formulir'),
                    'keterangan' => $this->input->post('keterangan'),
                    'file_path' => $config['upload_path']."/".$file['file_name'],
                    
                );
                
                $this->crud->insert('arsip_formulir',$query);
                $this->message = "Formulir & Blanko Berhasil Dibuat !";
                $this->session->set_flashdata('success',$this->message);            
                redirect('admin/arsip-formulir');
                
            } else {
                $this->message = "Berkas gagal diupload !";
                $this->session->set_flashdata('warning',$this->message);            
                redirect('admin/arsip-formulir');
            }
        }
    }
    
    function destroy($id){
        $this->crud->delete('arsip_formulir','id_formulir',$id);
        $this->message = "Formulir & Blanko Berhasil Dihapus !";
        $this->session->set_flashdata('success',$this->message);            
        redirect('admin/arsip-formulir');
    }
    
   function validation(){
        $this->form_validation->set_rules('nama_formulir','','required');
        $this->form_validation->set_rules('tanggal_formulir','','required');
    }
}