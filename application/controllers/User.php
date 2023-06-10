<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_User', 'M_Bansos']);
        // get session
        $this->id = $this->session->userdata('id');
        $this->role = $this->session->userdata('role');
        $this->email = $this->session->userdata('email');
        $this->nama = $this->session->userdata('nama');

        // validate session
        if ($this->session->userdata('login') != true) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda belum log-in!</div>');
            redirect('login');
        } 
        else {
            if ($this->role != 1) { // super admin
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Ups! Anda <b>tidak</b> memiliki akses pada halaman <b>User</b>!</div>');
                // back
                echo "<script>window.history.back();</script>";
            }
        }
    }

    public function index(){
        redirect('user/data_user');
    }

    public function data_user()
    {
        $data['users'] = $this->M_User->get_all_users();
        $this->load->view('template_admin/meta', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/menu', $data);
        $this->load->view('admin/user/data_user', $data);
        $this->load->view('template_admin/footer', $data);
    }

    // add user
    public function create_user()
    {
        $data['nama']  = $this->input->post('nama');
        $data['email'] = $this->input->post('email');
        $data['nohp']  = $this->input->post('nohp');
        $data['alamat'] = $this->input->post('alamat');
        $data['jk']   = $this->input->post('jk');
        $data['jabatan'] = $this->input->post('jabatan');
        $data['role'] = $this->input->post('role');
        $data['status'] = $this->input->post('status');

        // simpan di database
        $this->M_User->update_user($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menbambah data user baru!</div>');
        redirect('user/data_user');
    }

    // update user
    public function update_user($id)
    {
        $data['nama']  = $this->input->post('nama');
        $data['email'] = $this->input->post('email');
        $data['nohp']  = $this->input->post('nohp');
        $data['alamat'] = $this->input->post('alamat');
        $data['jk']   = $this->input->post('jk');
        $data['jabatan'] = $this->input->post('jabatan');
        $data['role'] = $this->input->post('role');
        $data['status'] = $this->input->post('status');

        // simpan di database
        $this->M_User->update_user($data, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengubah data user!</div>');
        redirect('user/data_user');
    }

    // delete user
    public function delete_user($id)
    {
        $delete = $this->M_User->delete_user($id);
        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus data user!</div>');
            redirect('user/data_user');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menghapus data user!</div>');
            redirect('user/data_user');
        }
    }
}
