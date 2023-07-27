<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_Penyaluran', 'M_Notif', 'M_User']);
        // // get session
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
            if ($this->role != 1 && $this->role != 2) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak memiliki akses!</div>');
                redirect('');
            }
        }

        // get notif
        $this->load->model('M_Notif');
        $this->data['notif'] = $this->M_Notif->get_all_notif_by_id_user($this->id);
    }

    public function index(){
        redirect('laporan/bansos');
    }

    // read notif
    public function bansos()
    {
        $data_master = $this->M_Penyaluran->get_all_master_penyaluran();
        $data["data"] = $data_master["data"];
        $data["summary"] = $data_master["summary"];
        $data["user"] = $this->M_User->get_user_by_role(4); // get all user CO Magang
        $data["notif"] = $this->data['notif'];

        // get role
        $role = $this->session->userdata('role');
        if ($role == 4) { // role CO magang
            $data['send_to'] = "PIC";
        } else if ($role == 3) { // role superadmin
            $data['send_to'] = "CO Magang";
        } else {
            $data['send_to'] = "-";
        }

        $this->load->view('template_admin/meta', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/menu', $data);
        $this->load->view('admin/penyaluran/data_master_penyaluran', $data);
        $this->load->view('template_admin/footer', $data);
    }
}