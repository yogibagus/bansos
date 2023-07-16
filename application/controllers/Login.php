<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_User']);
        // get session
        $this->id = $this->session->userdata('id');
        $this->role = $this->session->userdata('role');
        $this->email = $this->session->userdata('email');

        // validate session
        // if ($this->session->userdata('login') == true) {
        //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda belum log-in!</div>');
        //     redirect('admin/dashboard');
        // }
    }

    public function index()
    {
        $this->load->view('template_admin_login/meta');
        $this->load->view('admin/login');
        $this->load->view('template_admin_login/footer');
    }

    public function cek_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->M_User->get_user_by_email($email);

        if ($user && password_verify($password, $user->password)) {
            if ($user->role == 1) { // superadmin
                $sessiondata = array(
                    'id' => $user->id,
                    'email' => $email,
                    'login' => true,
                    'role' => $user->role,
                    'nama' => $user->nama
                );
                $this->session->set_userdata($sessiondata);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil login!</div>');

                redirect('dashboard');
            } else if ($user->role == 2) { // Penyelia
                $sessiondata = array(
                    'id' => $user->id,
                    'email' => $email,
                    'login' => true,
                    'role' => $user->role,
                    'nama' => $user->nama
                );
                $this->session->set_userdata($sessiondata);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil login!</div>');

                //set log
                //activity_log("Auth", "Logged-in");
                redirect('dashboard');
            } else if ($user->role == 3) { // PIC
                $sessiondata = array(
                    'id' => $user->id,
                    'email' => $email,
                    'login' => true,
                    'role' => $user->role,
                    'nama' => $user->nama
                );
                $this->session->set_userdata($sessiondata);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil login!</div>');

                //set log
                //activity_log("Auth", "Logged-in");
                redirect('dashboard');
            } else if ($user->role == 4) { // CO Magang
                $sessiondata = array(
                    'id' => $user->id,
                    'email' => $email,
                    'login' => true,
                    'role' => $user->role,
                    'nama' => $user->nama
                );
                $this->session->set_userdata($sessiondata);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil login!</div>');

                //set log
                //activity_log("Auth", "Logged-in");
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email atau password salah!</div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email atau password salah!</div>');
            redirect('login');
        }
    }

    public function daftar()
    {
        $this->load->view('template_admin_login/meta');
        $this->load->view('template_admin_login/header');
        $this->load->view('main/daftar');
        $this->load->view('template_admin_login/footer');
    }

    public function proses_pendaftaran()
    {
        $password = $this->input->post('password');
        $password2 = $this->input->post('password2');
        $email = $this->input->post('email');
        $check_email = $this->M_User->get_user_by_email($email);
        // cek apakah user telah terdaftar, jika sudah maka batalkan
        if ($check_email != false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email telah terdaftar!</div>');
            redirect('login/daftar');
        } else {
            if ($password == $password2) {
                $data['nama'] = $this->input->post('nama');
                $data['email'] = $email;
                $data['jk'] = $this->input->post('jk');
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
                $data['nohp'] = $this->input->post('nohp');
                $data['status'] = 1;
                $data['role'] = 1;
                // simpan user di database
                $this->M_User->update_user($data);
                $id_user = $this->db->insert_id();
                $data_detail['id_user'] = $id_user;
                $data_detail['id_bank'] = 000;
                // simpan detail user ke database
                $this->M_User->update_detail_user($data_detail);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendaftaran berhasil dilakukan, silahkan login!</div>');
                redirect('login');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password tidak sesuai!</div>');
                redirect('login/daftar');
            }
        }
    }

    public function logout()
    {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil log-out!</div>');
        $this->session->sess_destroy();
        // null the session (just in case):
        $this->session->set_userdata(array('id' => '', 'role' => '', 'login' => ''));
        redirect('login');
    }
}
