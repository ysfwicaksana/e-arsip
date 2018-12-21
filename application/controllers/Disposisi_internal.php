<?php
if(defined('basepath')) exit ('No direct access script allowed');

class Disposisi_internal extends CI_Controller {
    
    var $message;
    
    function __construct(){
        parent::__construct();
        $this->load->model('GlobalCrud','crud');
        $this->load->model('SuratInternal','internal');
        $this->load->model('Jabatan','jabatan');
        $this->load->model('Pegawai','pegawai');        
    }
    
    function daftar_disposisi($id){
        $data = array(
            'set' => $this->internal->join_disposisi_perintah_pegawai($id)->result(),
            'set_surat' => $this->internal->set_surat($id)->result(),
            'set_perintah' => $this->crud->all('perintah_disposisi')->result(),
            'set_unit' => $this->crud->all('unit_kerja')->result(),
            'set_jabatan' => $this->jabatan->join_jabatan_unitkerja()->result(),
            'set_pegawai' => $this->pegawai->join_pegawai_jabatan()->result(),
            'pegawai_selected' => '',
            'unit_selected' => '',
            'jabatan_selected' => '',
            'id_surat_internal' => $id
        );
        
        if($this->session->userdata('level') == 1){
             
            $this->load->view('layouts/header');
            $this->load->view('layouts/nav');
            $this->load->view('admin/surat-internal/disposisi',$data);
            $this->load->view('layouts/footer');
        } else {
            $this->load->view('layouts/header');
            $this->load->view('layouts/nav');
            $this->load->view('user/surat-internal/disposisi',$data);
            $this->load->view('layouts/footer');
        }
        
        
        
    }
    
    function create(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            $this->message = "Komponen Disposisi Wajib Diisi!";
            $this->session->set_flashdata('danger',$this->message);
            if($this->session->userdata('level') == 1){
                redirect('admin/surat-internal/masuk');
            } else {
                redirect('user/surat-internal/masuk'); 
            }
            
            
        } else {
            
            $query = array(
                'isi_disposisi' => $this->input->post('isi_disposisi'),
                'tanggal_disposisi' => $this->input->post('tanggal_disposisi'),
                'id_surat_internal' => $this->input->post('id_surat_internal'),
                'id_perintah' => $this->input->post('id_perintah'),
                'tujuan_disposisi' => $this->input->post('tujuan_disposisi')
            );
            
            $this->crud->insert('disposisi_internal',$query);
            $this->message = 'Disposisi Berhasil Dibuat';
            $this->session->set_flashdata('success',$this->message);
             if($this->session->userdata('level') == 1){
                redirect('admin/surat-internal/masuk');
            } else {
                redirect('user/surat-internal/masuk'); 
            }
                    
        }
    }
    
    function get($id){
        $query = array('id_disposisi_internal' => $id);
        $result = $this->crud->get('disposisi_internal',$query)->row();
        echo json_encode($result);
        
    }
    
    function print($id){
        //print_r($this->internal->disposisi_internal($id)->result());
        $data = array(
            'set' => $this->internal->join_disposisi($id)->result(),
            'set_surat' => $this->internal->disposisi_internal($id)->result()
        ); 
        
        if($this->session->userdata('level') == 1){
             $this->load->view('admin/surat-internal/print-disposisi',$data);
        } else {
             $this->load->view('user/surat-internal/print-disposisi',$data);
        }
       
        
    }
    
    
    function update(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            $this->message = "Semua Kompoenen Disposisi Wajib Diisi!";
            $this->session->set_flashdata('danger',$this->message);
            redirect('disposisi_internal/daftar-disposisi');
        } else {
            $query = array(
                'isi_disposisi' => $this->input->post('isi_disposisi'),
                'tanggal_disposisi' => $this->input->post('tanggal_disposisi'),
                'id_surat_internal' => $this->input->post('id_surat_internal'),
                'id_perintah' => $this->input->post('id_perintah'),
                'tujuan_disposisi' => $this->input->post('tujuan_disposisi')
            );
            
            $this->crud->update('disposisi_internal',$query,'id_disposisi_internal',$this->input->post('id_disposisi_internal'));
            $this->message = 'Disposisi Berhasil Diubah';
            $this->session->set_flashdata('success',$this->message);
             if($this->session->userdata('level') == 1){
                redirect('admin/surat-internal/masuk');
            } else {
                redirect('user/surat-internal/masuk'); 
            }
        }
    }
    
    function destroy($id){
        $this->message = "Disposisi Berhasil Dihapus :)";
        $this->crud->delete('disposisi_internal','id_disposisi_internal',$id);
        $this->session->set_flashdata('success',$this->message);
        if($this->session->userdata('level') == 1){
                redirect('admin/surat-internal/masuk');
        } else {
                redirect('user/surat-internal/masuk'); 
        }
        
    }
    
    function validation(){
        $this->form_validation->set_rules('isi_disposisi','','required');
        $this->form_validation->set_rules('tanggal_disposisi','','required');
       
    }
}
