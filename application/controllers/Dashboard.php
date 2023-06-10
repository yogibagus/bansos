<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
        // else {
        //     if ($this->role != ) {
        //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak memiliki akses!</div>');
        //         redirect('');
        //     }
        // }
    }

    public function index(){
        redirect('dashboard/dashboard_utama');
    }

    public function dashboard_utama()
    {
        $data["test"] = "test";
        $this->load->view('template_admin/meta', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/menu', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('template_admin/footer', $data);
    }

    // get profile
    public function profile()
    {
        $data['user'] = $this->M_User->get_user_by_id($this->id);
        $this->load->view('template_admin/meta', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/menu', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('template_admin/footer', $data);
        
        return $data;
    }

    // edit profile
    public function edit_profile($id)
    {
        $data['nama']  = $this->input->post('nama');
        $data['email'] = $this->input->post('email');
        $data['nohp']  = $this->input->post('nohp');
        $data['alamat'] = $this->input->post('alamat');
        $data['jk']   = $this->input->post('jk');
        $data['jabatan'] = $this->input->post('jabatan');

        // simpan di database
        $this->M_User->update_user($data, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengubah data profile!</div>');
        redirect('dashboard/profile');
    }
}
