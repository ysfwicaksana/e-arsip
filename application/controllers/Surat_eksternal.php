<?php
if(defined('basepath')) exit ('No direct access script allowed');

class Surat_eksternal extends CI_Controller {
    
    var $message;
    
    function __construct(){
        parent::__construct();
        $this->load->model('GlobalCrud','crud');
       
    }
    
    function create(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            
            $this->message = 'Semua Komponen Surat Wajib Diisi!';
            $this->session->set_flashdata('danger',$this->message);
            if($this->session->userdata('level') == 1){            
                redirect('admin/surat-eksternal/keluar');
            } else {
                
                redirect('user/surat-eksternal/keluar');
            }
        } else {
            
            $config = array(
                'upload_path' => 'files/surat-eksternal',
                'allowed_types' => 'pdf|jpg|png',
                'file_name' => $_FILES['file_path']['name'],
                'max_size' => 500000,
                'remove_space' => TRUE
            );
            
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('file_path')){
                
                $file = $this->upload->data();
                
                $query = array(
                    'nomor_surat' => $this->input->post('nomor_surat'),
                    'tujuan_surat_luar' => $this->input->post('tujuan_surat_luar'),
                    'isi_ringkas' => $this->input->post('isi_ringkas'),
                    'tanggal_surat' => $this->input->post('tanggal_surat'),
                    'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
                    'perihal' => $this->input->post('perihal'),
                    'file_path' => $config['upload_path']."/".$file['file_name'],
                    'lokasi_surat' => $this->input->post('lokasi_surat'),
                    'id_jenis' => $this->input->post('id_jenis'),
                    'id_prioritas' => $this->input->post('id_prioritas'),
                    'id_sifat' => $this->input->post('id_sifat'),
                    'id_media' => $this->input->post('id_media'),
                    'asal_surat_pengguna' => $this->input->post('asal_surat_pengguna')
                );
                
                $this->crud->insert('surat_eksternal',$query);
                
                if($this->session->userdata('level') == 1){
                    $this->message = "Surat Eksternal Keluar Berhasil Ditambah";
                    $this->session->userdata('success',$this->message);
                    redirect('admin/surat-eksternal/keluar');
                } else {
                    $this->message = "Surat Eksternal Keluar Berhasil Ditambah";
                    $this->session->userdata('success',$this->message);
                    redirect('user/surat-eksternal/keluar');
                }
                
            } else {
                $this->message = "Upload Berkas Error!";
                $this->session->set_flashdata('danger',$this->message);
                if($this->session->userdata('level') == 1){
                    redirect('admin/surat-eksternal/keluar');
                    
                } else {
                    redirect('user/surat-eksternal/keluar');
                } 
                    
            }
            
            
        }
    }
    
    function create2(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            
            $this->message = 'Semua Komponen Surat Wajib Diisi!';
            $this->session->set_flashdata('danger',$this->message);
            if($this->session->userdata('level') == 1){            
                redirect('admin/surat-eksternal/keluar');
            } else {
                
                redirect('user/surat-eksternal/keluar');
            }
        } else {
            
            $config = array(
                'upload_path' => 'files/surat-eksternal',
                'allowed_types' => 'pdf|jpg|png',
                'file_name' => $_FILES['file_path']['name'],
                'max_size' => 500000,
                'remove_space' => TRUE
            );
            
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('file_path')){
                
                $file = $this->upload->data();
                
                $query = array(
                    'nomor_surat' => $this->input->post('nomor_surat'),
                    'tujuan_surat_pengguna' => $this->input->post('tujuan_surat_pengguna'),
                    'isi_ringkas' => $this->input->post('isi_ringkas'),
                    'tanggal_surat' => $this->input->post('tanggal_surat'),
                    'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
                    'perihal' => $this->input->post('perihal'),
                    'file_path' => $config['upload_path']."/".$file['file_name'],
                    'lokasi_surat' => $this->input->post('lokasi_surat'),
                    'id_jenis' => $this->input->post('id_jenis'),
                    'id_prioritas' => $this->input->post('id_prioritas'),
                    'id_sifat' => $this->input->post('id_sifat'),
                    'id_media' => $this->input->post('id_media'),
                    'asal_surat_luar' => $this->input->post('asal_surat_luar')
                );
                
                $this->crud->insert('surat_eksternal',$query);
                
                if($this->session->userdata('level') == 1){
                    $this->message = "Surat Eksternal Masuk Berhasil Ditambah";
                    $this->session->userdata('success',$this->message);
                    redirect('admin/surat-eksternal/masuk');
                } else {
                    $this->message = "Surat Internal Masuk Berhasil Ditambah";
                    $this->session->userdata('success',$this->message);
                    redirect('user/surat-eksternal/masuk');
                }
                
            } else {
                $this->message = "Upload Berkas Error!";
                $this->session->set_flashdata('danger',$this->message);
                if($this->session->userdata('level') == 1){
                    redirect('admin/surat-eksternal/keluar');
                    
                } else {
                    redirect('user/surat-eksternal/keluar');
                } 
                    
            }
            
            
        }
    }
    
    function destroy($id){
        $this->crud->delete('surat_eksternal','id_surat_eksternal',$id);
        $this->message = 'Surat Eksternal Berhasil Dihapus :)';
        $this->session->set_flashdata('success',$this->message);
        if($this->session->userdata('level') == 1){
            redirect('admin/surat-eksternal/keluar');
        } else {
           redirect('admin/surat-eksternal/keluar'); 
        }
    }
    
    function validation(){
        $this->form_validation->set_rules('nomor_surat','','required');
        $this->form_validation->set_rules('perihal','','required');
        $this->form_validation->set_rules('isi_ringkas','','required');
        $this->form_validation->set_rules('tanggal_surat','','required');
        $this->form_validation->set_rules('tanggal_transaksi','','required');
        //$this->form_validation->set_rules('file_path','','required');
        $this->form_validation->set_rules('lokasi_surat','','required');
    }
    
}
