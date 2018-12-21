<?php  

if(defined('basepath')) exit ('No direct access script allowed');

class Pegawai extends CI_Controller {
    
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
            $this->message = "Seluruh Komponen Pegawai Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/pegawai');
        } else {
            
            $query = array(
                'nama_pegawai' => $this->input->post('nama_pegawai'),
                'kontak_email' => $this->input->post('kontak_email'),
                'kontak_telepon' => $this->input->post('kontak_telepon'),
                'id_unit' => $this->input->post('id_unit'),
                'id_jabatan' => $this->input->post('id_jabatan')
            );
            
            $this->crud->insert('pegawai',$query);
            $this->message = "Pegawai Baru Berhasil Dibuat :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/pegawai');
            
        }
    }
    
    function get($id){
        
        $data = array(
            'id_pegawai' => $id
        );
        
        $result = $this->crud->get('pegawai',$data)->row();
        echo json_encode($result);
        
    }
    
    function update(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            $this->message = "Komponen Pegawai Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/pegawai');
        } else {
            $query = array(
                'nama_pegawai' => $this->input->post('nama_pegawai'),
                'kontak_email' => $this->input->post('kontak_email'),
                'kontak_telepon' => $this->input->post('kontak_telepon'),
                'id_unit' => $this->input->post('id_unit'),
                'id_jabatan' => $this->input->post('id_jabatan')
            );
            
            $this->crud->update('pegawai',$query,'id_pegawai',$this->input->post('id_pegawai'));
            $this->message = "Pegawai Berhasil Diubah :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/pegawai');
        }
    }
    
    function destroy($id){
        $this->message = "Pegawai Berhasil Dihapus :)";
        $this->crud->delete('pegawai','id_pegawai',$id);
        $this->session->set_flashdata('success',$this->message);
        redirect('admin/pegawai');
        
    }
    
    function validation(){
        $this->form_validation->set_rules('nama_pegawai','Jenis Surat','required');
        $this->form_validation->set_rules('kontak_email','Jenis Surat','required');
        $this->form_validation->set_rules('kontak_telepon','Jenis Surat','required');
        $this->form_validation->set_rules('id_unit','Jenis Surat','required');
        $this->form_validation->set_rules('id_jabatan','Jenis Surat','required');

    }
}