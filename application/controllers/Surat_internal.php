<?php
if(defined('basepath')) exit ('No direct access script allowed');

class Surat_internal extends CI_Controller {
    
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
                redirect('admin/surat-internal/keluar');
            } else {
                
                redirect('user/surat-internal/keluar');
            }
        } else {
            
            $config = array(
                'upload_path' => 'files/surat-internal',
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
                    'destinasi_surat' => $this->input->post('destinasi_surat'),
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
                    'asal_surat' => $this->input->post('asal_surat')
                );
                
                $this->crud->insert('surat_internal',$query);
                $this->message = "Surat Internal Keluar Berhasil Ditambah";
                $this->session->userdata('success',$this->message);
                if($this->session->userdata('level') == 1){
                    redirect('admin/surat-internal/keluar');
                } else {
                    redirect('user/surat-internal/keluar');
                }
                
            } else {
                $this->message = "Upload Berkas Error!";
                $this->session->set_flashdata('danger',$this->message);
                if($this->session->userdata('level') == 1){
                    redirect('admin/surat-internal/keluar');
                    
                } else {
                    redirect('user/surat-internal/keluar');
                } 
                    
            }
            
            
        }
    }
    
    function get($id){
        $query = array('id_surat_internal' => $id);
        
        $result = $this->crud->get('surat_internal',$query)->row();
        echo json_encode($result);
    }
    
    function update(){
        
            
            if(isset($_FILES['file_path']['name'])){
                
                $config = array(
                    'upload_path' => 'files/surat-internal',
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
                        'destinasi_surat' => $this->input->post('destinasi_surat'),
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
                        'asal_surat' => $this->input->post('asal_surat')
                    );
                    
                    $this->crud->update('surat_internal',$query,'id_surat_internal',$this->input->post('id_surat_internal'));
                    $this->message = "Surat Keluar Berhasil Diubah :)";
                    $this->session->userdata('success',$this->message);
                    redirect('admin/surat-internal/keluar');
                    
                } else {
                    $this->message = "Berkas gagal di unggah!";
                    $this->session->userdata('danger',$this->message);
                    redirect('admin/surat-internal/keluar');
                }
                
            } else {
                
                $query = array(
                        'nomor_surat' => $this->input->post('nomor_surat'),
                        'destinasi_surat' => $this->input->post('destinasi_surat'),
                        'isi_ringkas' => $this->input->post('isi_ringkas'),
                        'tanggal_surat' => $this->input->post('tanggal_surat'),
                        'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
                        'perihal' => $this->input->post('perihal'),    
                        'lokasi_surat' => $this->input->post('lokasi_surat'),
                        'id_jenis' => $this->input->post('id_jenis'),
                        'id_prioritas' => $this->input->post('id_prioritas'),
                        'id_sifat' => $this->input->post('id_sifat'),
                        'id_media' => $this->input->post('id_media'),
                        'asal_surat' => $this->input->post('asal_surat')
                );
                
                $this->crud->update('surat_internal',$query,'id_surat_internal',$this->input->post('id_surat_internal'));
                $this->message = "Surat Keluar Berhasil Diubah :)";
                $this->session->userdata('success',$this->message);
                redirect('admin/surat-internal/keluar');
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
