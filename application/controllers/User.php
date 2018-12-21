<?php
if(defined('basepath')) exit ('No direct access script allowed');

class User extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('GlobalCrud','crud');
        $this->load->model('SuratInternal','internal');
         $this->load->model('SuratEksternal','eksternal');
        $this->load->model('UserModel','user');
        if($this->session->userdata('level') != '0'){
            redirect('login');
        }
    }
    
    
    function index(){
        
        $destinasi_surat = array('destinasi_surat' => $this->session->userdata('id_user'));
        $asal_surat = array('asal_surat' => $this->session->userdata('id_user'));
        $asal_eks = array('asal_surat_pengguna' => $this->session->userdata('id_user'));
        $destinasi_eks = array('tujuan_surat_pengguna' => $this->session->userdata('id_user'));
        
        $data = array(
            'name' => $this->session->userdata('name'),
            'set_internal_masuk' => $this->crud->get('surat_internal',$destinasi_surat)->num_rows(),
            'set_internal_keluar' => $this->crud->get('surat_internal',$asal_surat)->num_rows(),
            'set_eksternal_keluar' => $this->crud->get('surat_eksternal',$asal_eks)->num_rows(),
            'set_eksternal_masuk' => $this->crud->get('surat_eksternal',$destinasi_eks)->num_rows()
        );
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('user/dashboard',$data);
        $this->load->view('layouts/footer');
    }
    
   
    
    function surat_internal($jenis_surat){
        
        if($jenis_surat == 'masuk'){
            
            $data = array(
                'set' => $this->internal->get_surat_destinasi('surat_internal',$this->session->userdata('id_user'),'destinasi_surat')->result(),
                'jenis' => 'Masuk',
                'set_destinasi' => $this->user->destinasi_surat($this->session->userdata('id_user'))->result(),
                'set_jenis' => $this->crud->all('jenis_surat')->result(),
                'set_prioritas' => $this->crud->all('prioritas_surat')->result(),
                'set_sifat' => $this->crud->all('sifat_surat')->result(),
                'set_media' => $this->crud->all('media_surat')->result(),
                'pembuat' => $this->session->userdata('id_user')
            );
            
        } else {
            
            $data = array(
                'set' => $this->internal->get_surat_destinasi('surat_internal',$this->session->userdata('id_user'),'asal_surat')->result(),
                'jenis' => 'Keluar',
                'set_destinasi' => $this->user->destinasi_surat($this->session->userdata('id_user'))->result(),
                'set_jenis' => $this->crud->all('jenis_surat')->result(),
                'set_prioritas' => $this->crud->all('prioritas_surat')->result(),
                'set_sifat' => $this->crud->all('sifat_surat')->result(),
                'set_media' => $this->crud->all('media_surat')->result(),
                'pembuat' => $this->session->userdata('id_user')
            );
            
        }
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('user/surat-internal/kelola',$data);
        $this->load->view('layouts/footer');
        
    }
    
    function surat_eksternal($jenis_surat){
        
        if($jenis_surat == "masuk"){
            //print_r($this->eksternal->get_surat_destinasi('asal_surat_pengguna',$this->session->userdata('id_user'))->result());
            $data = array(
                'set' => $this->eksternal->get_surat_destinasi('surat_eksternal','tujuan_surat_pengguna',$this->session->userdata('id_user'))->result(),
                'jenis' => 'Masuk',
                'set_destinasi' => $this->user->destinasi_surat($this->session->userdata('id_user'))->result(),
                'set_jenis' => $this->crud->all('jenis_surat')->result(),
                'set_prioritas' => $this->crud->all('prioritas_surat')->result(),
                'set_sifat' => $this->crud->all('sifat_surat')->result(),
                'set_media' => $this->crud->all('media_surat')->result(),
                'pembuat' => $this->session->userdata('id_user')
            );
            
        } else {
            
             $data = array(
                'set' => $this->eksternal->get_surat_destinasi('surat_eksternal','asal_surat_pengguna',$this->session->userdata('id_user'))->result(),
                'jenis' => 'Keluar',
                'set_destinasi' => $this->user->destinasi_surat($this->session->userdata('id_user'))->result(),
                'set_jenis' => $this->crud->all('jenis_surat')->result(),
                'set_prioritas' => $this->crud->all('prioritas_surat')->result(),
                'set_sifat' => $this->crud->all('sifat_surat')->result(),
                'set_media' => $this->crud->all('media_surat')->result(),
                'pembuat' => $this->session->userdata('id_user')
            );
            
            
        }
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('user/surat-eksternal/kelola',$data);
        $this->load->view('layouts/footer');
        
    }
}