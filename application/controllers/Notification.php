<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_Notif']);
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
            // if ($this->role != 1) {
            //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak memiliki akses!</div>');
            //     redirect('');
            // }
        }
    }

    public function index(){
        redirect('login');
    }

    // read notif
    public function read($id)
    {
        $this->M_Notif->read_notif($id);

        // get notif by if
        $notif = $this->M_Notif->get_notif_by_id($id);
        // check $notif->jenis with switch case
        switch ($notif->jenis) {
            case 'penyaluran co magang':
                // redirect to penyaluran
                redirect('penyaluran/detail_penyaluran/'.$notif->id_reff);
                break;
            default:
                redirect($this->agent->referrer());
                break;
        }

    }
}