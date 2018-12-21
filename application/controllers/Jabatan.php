<?php
if(defined('basepath')) exit ('No direct access script allowed');

class Jabatan extends CI_Controller {
    
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
            $this->message = "Nama Jabatan & Unit Kerja Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/jabatan');
        } else {
            
            $query = array(
                'nama_jabatan' => $this->input->post('nama_jabatan'),
                'id_unit' => $this->input->post('id_unit'),
                'keterangan' => $this->input->post('keterangan')
            );
            
            $this->crud->insert('jabatan',$query);
            $this->message = "Jabatan Baru Berhasil Dibuat :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/jabatan');
            
        }
    }
    
    function get($id){
        
        $data = array(
            'id_jabatan' => $id
        );
        
        $result = $this->crud->get('jabatan',$data)->row();
        echo json_encode($result);
        
    }
    
    function update(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            $this->message = "Jabatan Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/jabatan');
        } else {
            $query = array(
                'nama_jabatan' => $this->input->post('nama_jabatan'),
                'id_unit' => $this->input->post('id_unit'),
                'keterangan' => $this->input->post('keterangan')
            );
            
            $this->crud->update('jabatan',$query,'id_jabatan',$this->input->post('id_jabatan'));
            $this->message = "Jabatan Berhasil Diubah :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/jabatan');
        }
    }
    
    function destroy($id){
        $this->message = "Jabatan Berhasil Dihapus :)";
        $this->crud->delete('jabatan','id_jabatan',$id);
        $this->session->set_flashdata('success',$this->message);
        redirect('admin/jabatan');
        
    }
    
    function validation(){
        $this->form_validation->set_rules('nama_jabatan','Jenis Surat','required');
        $this->form_validation->set_rules('id_unit','Jenis Surat','required');

    }
}