<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyaluran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_User', 'M_Penyaluran', 'M_Bansos']);
        $this->load->library('Excel');
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
            // if ($this->role != 1) {
            //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak memiliki akses!</div>');
            //     redirect('');
            // }
        }
    }

    public function index(){
        redirect('penyaluran/data_master_penyaluran');
    }

    public function data_master_penyaluran()
    {
        $data["data"] = $this->M_Penyaluran->get_all_master_penyaluran();
        $data["user"] = $this->M_User->get_user_by_role(4); // get all user CO Magang
        // echo json_encode($data);die;
        $this->load->view('template_admin/meta', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/menu', $data);
        $this->load->view('admin/penyaluran/data_master_penyaluran', $data);
        $this->load->view('template_admin/footer', $data);
    }

    // create data master penyaluran
    public function create_master_penyaluran()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'id_user' => $this->input->post('id_user'),
            'created_by' => $this->id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->M_Penyaluran->update_master_penyaluran($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
        redirect('penyaluran/data_master_penyaluran');
    }

    // update data master penyaluran
    public function update_master_penyaluran($id = '')
    {
        $nama = $this->input->post('nama');

        $data = [
            'nama' => $nama,
            'updated_by' => $this->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->M_Penyaluran->update_master_penyaluran($data, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        redirect('penyaluran/data_master_penyaluran');
    }

    // delete data master penyaluran
    public function delete_master_penyaluran($id)
    {
        $this->M_Penyaluran->delete_master_penyaluran($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        redirect('penyaluran/data_master_penyaluran');
    }

    // get data bansos
    public function data_bansos($id_master_penyaluran)
    {
        // get master penyaluran by id
        $data["title"] = "Tambah Data Penyaluran - " .$this->M_Penyaluran->get_master_penyaluran_by_id($id_master_penyaluran)->nama;

        $data["master_bansos"] = $this->M_Bansos->get_all_master_bansos();

        $data['id_master_penyaluran'] = $id_master_penyaluran;

        $filter = [
            'nama' => $this->input->post('nama') ?? null,
            'nik' => $this->input->post('nik') ?? null,
            'norek' => $this->input->post('norek') ?? null,
            'status' => $this->input->post('status') ?? null,
            'id_master_bansos' => $this->input->post('id') ?? null,
            'tahun' => $this->input->post('tahun') ?? null,
            'jenis_bansos' => $this->input->post('jenis_bansos') ?? null,
            'status' => $this->input->post('status') ?? null,
            'kabupaten' => $this->input->post('kabupaten'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
        ];
        $data["filter"] = $filter;

        $data["data"] = $this->M_Bansos->get_all_bansos_penyaluran($filter, $id_master_penyaluran);

        $this->load->view('template_admin/meta', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/menu', $data);
        $this->load->view('admin/penyaluran/data_penyaluran', $data);
        $this->load->view('template_admin/footer', $data);
    }

    // send_data_bansos for ajax request
    public function send_data_bansos()
    {
        try {
            $id_master_penyaluran = $this->input->post('id_master_penyaluran');
            // check if id_master_penyaluran is empty
            if ($id_master_penyaluran == '') {
                $response['error'] = "id_master_penyaluran kosong!";
                $response['message'] = "Gagal mengirim data bansos!";
                $response['status'] = false;
                echo json_encode($response);
            }
    
            $checked_list = $this->input->post('checked_list'); // id_bansos that checked
            // check if checked_list is empty and array
            if ($checked_list == '' || !is_array($checked_list)) {
                $response['error'] = "checked_list kosong atau bukan array!";
                $response['message'] = "Gagal mengirim data bansos!";
                $response['status'] = false;
                echo json_encode($response);
            }
    
            // get master penyaluran by id
            $master_penyaluran = $this->M_Penyaluran->get_master_penyaluran_by_id($id_master_penyaluran);
            // check if master_penyaluran is empty
            if ($master_penyaluran == '') {
                $response['error'] = "master_penyaluran kosong!";
                $response['message'] = "Gagal mengirim data bansos!";
                $response['status'] = false;
                echo json_encode($response);
            }
    
            $tmp = [];
            foreach ($checked_list as $key => $value) {
                $tmp[] = [
                    'id_master_penyaluran' => $id_master_penyaluran,
                    'id_bansos' => $value,
                    'created_by' => $this->id,
                    'created_at' => date('Y-m-d H:i:s')
                ];
            }
    
            $check = $this->M_Penyaluran->bulk_insert_data_penyaluran($tmp);
    
            if ($check) {
                $response['message'] = "Berhasil mengirim data bansos!";
                $response['status'] = true;
                echo json_encode($response);
            } else {
                $response['error'] = "Gagal mengirim data bansos!";
                $response['message'] = "Gagal mengirim data bansos!";
                $response['status'] = false;
                echo json_encode($response);
            }
        } catch (\Throwable $th) {
            $response['error'] = $th->getMessage();
            $response['message'] = "Gagal mengirim data bansos!";
            $response['status'] = false;
            echo json_encode($response);
        }
    }
}