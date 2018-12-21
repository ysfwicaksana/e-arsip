<?php
if(defined('basepath')) exit ('No direct access script allowed');

class Pengguna extends CI_Controller {
    
    var $message;
    
    function __construct(){
        parent::__construct();
        $this->load->model('GlobalCrud','crud');
        $this->load->model('UserModel','user');
        if($this->session->userdata('level') != 1){
            redirect('login');
        }
    }
    
    function create(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            $this->message = 'Semua inputan wajib di isi!';
            $this->session->set_flashdata('danger',$this->message);
            redirect('admin/akun');
        } else {

                $query = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'password' => sha1($this->input->post('password')),
                    'id_pegawai' => $this->input->post('id_pegawai'),
                    'level' => '0'
                );    
                
                $this->crud->insert('user',$query);
                $this->message = 'Pengguna baru berhasil dibuat';
                $this->session->set_flashdata('success',$this->message);
                redirect('admin/akun');
            
            
        }
    }
    
    function update(){
        $this->form_validation->set_rules('email','','required|valid_email');
        $this->form_validation->set_rules('name','','required');
        if($this->form_validation->run() == FALSE){
            $this->message = 'Nama dan email harus diisi!';
            $this->session->set_flashdata('danger',$this->message);
            redirect('admin/akun');
        } else {
            
            $query = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email')
            );
            
            $this->crud->update('user',$query,'id_user',$this->input->post('id_user'));
            $this->message = 'Profil pengguna berhasil diubah';
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/akun');
        }
    }
    
    function reset_password(){
        if($this->input->post('new_password') == $this->input->post('confirm')){
            
            $old_password = $this->user->reset($this->input->post('id_user'));
            if($old_password == sha1($this->input->post('password'))){
                
                $query = array(
                    'password' => sha1($this->input->post('new_password'))
                );
                
                $this->crud->update('user',$query,'id_user',$this->input->post('id_user'));
                $this->message = 'Password berhasil diubah';
                $this->session->set_flashdata('success',$this->message);
                redirect('admin/akun');
                
            } else {
                
                $this->message = 'Password baru tidak sesuai!';
                $this->session->set_flashdata('danger',$this->message);
                redirect('admin/akun');
            }
            
        } else {
            
            $this->message = 'Konfirmasi Password tidak sesuai!';
            $this->session->set_flashdata('danger',$this->message);
            redirect('admin/akun');
            
        }
           
    }
    
    function destroy($id){
        $this->crud->delete('user','id_user',$id);
        $this->message = "Pengguna telah dihapus";
        $this->session->set_flashdata('success',$this->message);
        redirect('admin/akun');
    }
    
    function reset(){
        
    }
    
    function get($id){
        $data = array('id_user' => $id);
        $result = $this->crud->get('user',$data)->row();
        echo json_encode($result);
    }
    
    function validation(){
        $this->form_validation->set_rules('name','Nama ','required');
        $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('confirm','Konfirmasi Password','required');
    }
}

