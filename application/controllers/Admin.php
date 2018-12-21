<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin extends CI_Controller {
    
    function __construct(){
       parent::__construct();
       $this->load->model('GlobalCrud','crud');
       $this->load->model('pegawai');
       $this->load->model('UserModel','user');
       $this->load->model('SuratInternal','internal');
        $this->load->model('SuratEksternal','eksternal');
       if($this->session->userdata('level') != 1){
           redirect('login');
       }
    }
    
    function index(){
        
        $destinasi_surat = array('destinasi_surat' => $this->session->userdata('id_user'));
        $asal_surat = array('asal_surat' => $this->session->userdata('id_user'));
        $asal_eks = array('asal_surat_pengguna' => $this->session->userdata('id_user'));
        $destinasi_eks = array('tujuan_surat_pengguna' => $this->session->userdata('id_user'));
        
        $data = array(
            'view_internal_jenis' => $this->crud->all('view_internal_jenis')->result(),
            'view_internal_prioritas' => $this->crud->all('view_internal_prioritas')->result(),
            'view_internal_sifat' => $this->crud->all('view_internal_sifat')->result(),
            'view_internal_media' => $this->crud->all('view_internal_media')->result(),
            'view_eksternal_jenis' => $this->crud->all('view_eksternal_jenis')->result(),
            'view_eksternal_prioritas' => $this->crud->all('view_eksternal_prioritas')->result(),
            'view_eksternal_sifat' => $this->crud->all('view_eksternal_sifat')->result(),
            'view_eksternal_media' => $this->crud->all('view_eksternal_media')->result(),
            'set_internal_masuk' => $this->crud->get('surat_internal',$destinasi_surat)->num_rows(),
            'set_internal_keluar' => $this->crud->get('surat_internal',$asal_surat)->num_rows(),
            'set_eksternal_keluar' => $this->crud->get('surat_eksternal',$asal_eks)->num_rows(),
            'set_eksternal_masuk' => $this->crud->get('surat_eksternal',$destinasi_eks)->num_rows(),
            'set_akun' => $this->crud->count_table('user'),
            'set_unit' => $this->crud->count_table('unit_kerja'),
            'set_jabatan' => $this->crud->count_table('jabatan'),
            'set_pegawai' => $this->crud->count_table('pegawai')
            
            
        );
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('admin/dashboard',$data);
        $this->load->view('layouts/footer');
    }
    
    function akun(){
        $data = array(
            'set_pegawai' => $this->pegawai->join_pegawai_jabatan_unitkerja()->result(),
            'set' => $this->pegawai->join_pegawai_user()->result()
            
        );
        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('admin/akun/kelola',$data);
        $this->load->view('layouts/footer');
    }
     
    function surat_internal($jenis_surat){
        
        if($jenis_surat == 'masuk'){
           
             $data = array(
                'set' => $this->internal->get_surat_destinasi('surat_internal',$this->session->userdata('id_user'),'destinasi_surat')->result(),
                'jenis' => 'Masuk',
                'set_jenis' => $this->crud->all('jenis_surat')->result(),
                'set_prioritas' => $this->crud->all('prioritas_surat')->result(),
                'set_sifat' => $this->crud->all('sifat_surat')->result(),
                'set_media' => $this->crud->all('media_surat')->result(),
                'pembuat' => $this->session->userdata('id_user')
            );
            
            
        } else if($jenis_surat == 'keluar') {
            
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
        $this->load->view('admin/surat-internal/kelola',$data);
        $this->load->view('layouts/footer');
        
    }
    
   function surat_eksternal($jenis_surat){
        
        if($jenis_surat == "masuk"){
            
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
        $this->load->view('admin/surat-eksternal/kelola',$data);
        $this->load->view('layouts/footer');
   }
    
     function arsip_formulir(){
        $data = array(
             'set' => $this->crud->all('arsip_formulir')->result()
        );
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('admin/arsip-formulir/kelola',$data);
        $this->load->view('layouts/footer');
     }
    
    function arsip_dokumen(){
        $data = array(
             'set' => $this->crud->all('arsip_dokumen')->result()
        );
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('admin/arsip-dokumen/kelola',$data);
        $this->load->view('layouts/footer');
     }

    function pegawai(){
        $this->load->model('jabatan');
        
        
        $data = array(
            'set' => $this->pegawai->join_pegawai_jabatan_unitkerja()->result(),
            'set_unit' => $this->crud->all('unit_kerja')->result(),
            'set_jabatan' => $this->jabatan->join_jabatan_unitkerja()->result(),
            'unit_selected' => '',
            'jabatan_selected' => ''
        );
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('admin/pegawai/kelola',$data);
        $this->load->view('layouts/footer');
    }
    
    
    
    function jenis_surat(){
        $data = array(
            'set' => $this->crud->all('jenis_surat')->result()
        );
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('admin/jenis-surat/kelola',$data);
        $this->load->view('layouts/footer');
    }
    
    function sifat_surat(){
        $data = array(
            'set' => $this->crud->all('sifat_surat')->result()
        );
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('admin/sifat-surat/kelola',$data);
        $this->load->view('layouts/footer');
    }
    
    function prioritas_surat(){
        $data = array(
            'set' => $this->crud->all('prioritas_surat')->result()
        );
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('admin/prioritas-surat/kelola',$data);
        $this->load->view('layouts/footer');
    }
    
    function media_surat(){
        $data = array(
            'set' => $this->crud->all('media_surat')->result()
        );
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('admin/media-surat/kelola',$data);
        $this->load->view('layouts/footer');
    }
    
    function perintah_disposisi(){
        $data = array(
            'set' => $this->crud->all('perintah_disposisi')->result()
        );
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('admin/perintah-disposisi/kelola',$data);
        $this->load->view('layouts/footer');
    }
    
    
    
    function lokasi_surat(){
        $data = array(
            'set' => $this->crud->all('lokasi_surat')->result()
        );
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('admin/lokasi-surat/kelola',$data);
        $this->load->view('layouts/footer');
    }
    
    function unit_kerja(){
        $data = array(
            'set' => $this->crud->all('unit_kerja')->result()
        );
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('admin/unit-kerja/kelola',$data);
        $this->load->view('layouts/footer');
    }
    
    function jabatan(){
        $this->load->model('Jabatan','jabatan');
        $data = array(
            'set' => $this->jabatan->join_jabatan_unitkerja()->result(),
            'set_unit' => $this->crud->all('unit_kerja')->result()
        );
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('admin/jabatan/kelola',$data);
        $this->load->view('layouts/footer');
    }
    
    
    
    
    
}
