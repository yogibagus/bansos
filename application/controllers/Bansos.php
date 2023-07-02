<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bansos extends CI_Controller
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
        redirect('bansos/data_master_bansos');
    }

    public function data_master_bansos()
    {
        $data["data"] = $this->M_Bansos->get_all_master_bansos();
        $this->load->view('template_admin/meta', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/menu', $data);
        $this->load->view('admin/bansos/data_master_bansos', $data);
        $this->load->view('template_admin/footer', $data);
    }

    // create bansos
    public function create_master_bansos()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'created_by' => $this->id,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->M_Bansos->update_master_bansos($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bansos berhasil ditambahkan!</div>');
        redirect('bansos/data_master_bansos');
    }

    // update bansos
    public function update_master_bansos($id)
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'updated_by' => $this->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->M_Bansos->update_master_bansos($data, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bansos berhasil diupdate!</div>');
        redirect('bansos/data_master_bansos');
    }

    // delete bansos
    public function delete_master_bansos($id)
    {
        $check = $this->M_Bansos->delete_master_bansos($id);
        if ($check == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Bansos tidak dapat dihapus!</div>');
            redirect('bansos/data_master_bansos');
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bansos berhasil dihapus!</div>');
        redirect('bansos/data_master_bansos');
    }
    
    public function proses()
    {
            
            $status = $this->input->get('status') ?? null;
            if ($status == '0') {
                $data["title"] = "Data Belum Tersalur";
            } else if ($status == '1') {
                $data["title"] = "Data Tersalur";
            } else if ($status == '2') {
                $data["title"] = "Data Tidak Tersalur";
            } else {
                redirect('bansos/proses?status=0');
            }

            $data["master_bansos"] = $this->M_Bansos->get_all_master_bansos();

            $filter = [
                'nama' => $this->input->post('nama') ?? null,
                'nik' => $this->input->post('nik') ?? null,
                'norek' => $this->input->post('norek') ?? null,
                'status' => $this->input->post('status') ?? null,
                'id_master_bansos' => $this->input->post('id') ?? null,
                'tahun' => $this->input->post('tahun') ?? null,
                'jenis_bansos' => $this->input->post('jenis_bansos') ?? null,
                'kabupaten' => $this->input->post('kabupaten'),
                'kecamatan' => $this->input->post('kecamatan'),
                'kelurahan' => $this->input->post('kelurahan'),
                'status' => $status,
            ];
            $data["filter"] = $filter;
            // log
            // echo json_encode($filter);die;
            $data["data"] = $this->M_Bansos->get_all_bansos($filter);

        $this->load->view('template_admin/meta', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/menu', $data);
        $this->load->view('admin/bansos/proses', $data);
        $this->load->view('template_admin/footer', $data);
    }

    // update bansos
    public function update_bansos($id)
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'nik' => $this->input->post('nik'),
            'norek' => $this->input->post('norek'),
            'id_master_bansos' => $this->input->post('id_master_bansos'),
            'tahun' => $this->input->post('tahun'),
            'jenis_bansos' => $this->input->post('jenis_bansos'),
            'kabupaten' => $this->input->post('kabupaten'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
            'status' => $this->input->post('status'),
            'updated_by' => $this->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $check = $this->M_Bansos->update_bansos($data, $id);
        if ($check == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Bansos tidak dapat diupdate!</div>');
            redirect('bansos/proses?status='.$this->input->post('current_status'));
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bansos berhasil diupdate!</div>');
        redirect('bansos/proses?status='.$this->input->post('current_status'));
    }

    // create bansos
    public function create_bansos()
    {

        $id_master_bansos = $this->input->post('id_master_bansos');
        // check if empty
        if ($id_master_bansos == '' || $id_master_bansos == null){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Master Bansos tidak boleh kosong!</div>');
            redirect('bansos/proses?status='.$this->input->post('current_status'));
        }

        $data = [
            'nama' => $this->input->post('nama'),
            'nik' => $this->input->post('nik'),
            'norek' => $this->input->post('norek'),
            'id_master_bansos' => $this->input->post('id_master_bansos'),
            'tahun' => $this->input->post('tahun'),
            'jenis_bansos' => $this->input->post('jenis_bansos'),
            'kabupaten' => $this->input->post('kabupaten'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
            'created_by' => $this->id,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $check = $this->M_Bansos->update_bansos($data);
        if ($check == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Bansos tidak dapat ditambahkan!</div>');
            redirect('bansos/proses?status='.$this->input->post('current_status'));
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bansos berhasil ditambahkan!</div>');
        redirect('bansos/proses?status='.$this->input->post('current_status'));
    }

    // bulk update bansos status with array id, example is [2,3,4]
    public function bulk_update_bansos_status()
    {
        $id = $this->input->post('checked_list');

        // check is id array
        if (!is_array($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">ID tidak valid!</div>');
            redirect('bansos/proses?status='.$this->input->post('current_status'));
            return false;
        }

        $status = $this->input->post('status');
        $data = [
            'status' => $status,
            'updated_by' => $this->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->M_Bansos->bulk_update_bansos_status($data, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bansos berhasil diupdate!</div>');
        return true;
    }

}
