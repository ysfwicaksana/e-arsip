<?php
if(defined('basepath')) exit ('No direct access script allowed');

class Perintah_disposisi extends CI_Controller {
    
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
            $this->message = "Perintah Disposisi Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/perintah-disposisi');
        } else {
            
            $query = array(
                'nama_perintah' => $this->input->post('nama_perintah'),
                'keterangan' => $this->input->post('keterangan')
            );
            
            $this->crud->insert('perintah_disposisi',$query);
            $this->message = "Perintah Disposisi Baru Berhasil Dibuat :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/perintah-disposisi');
            
        }
    }
    
    function get($id){
        
        $data = array(
            'id_perintah' => $id
        );
        
        $result = $this->crud->get('perintah_disposisi',$data)->row();
        echo json_encode($result);
        
    }
    
    function update(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            $this->message = "Perintah Disposisi Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/perintah-disposisi');
        } else {
            $query = array(
                'nama_perintah' => $this->input->post('nama_perintah'),
                'keterangan' => $this->input->post('keterangan')
            );
            
            $this->crud->update('perintah_disposisi',$query,'id_perintah',$this->input->post('id_perintah'));
            $this->message = "Perintah Disposisi Berhasil Diubah :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/perintah-disposisi');
        }
    }
    
    function destroy($id){
        $this->message = "Perintah Disposisi Berhasil Dihapus :)";
        $this->crud->delete('perintah_disposisi','id_perintah',$id);
        $this->session->set_flashdata('success',$this->message);
        redirect('admin/perintah-disposisi');
        
    }
    
    function validation(){
        $this->form_validation->set_rules('nama_perintah','Jenis Surat','required');

    }
}