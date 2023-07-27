<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyaluran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_User', 'M_Penyaluran', 'M_Bansos']);
        $this->load->library(['Excel', 'Notif']);
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
            if ($this->uri->segment(2) != "detail_penyaluran"){
                if ($this->role == 2) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak memiliki akses!</div>');
                    redirect($this->agent->referrer());
                }
            }
        }

        // get notif
        $this->load->model('M_Notif');
        $this->data['notif'] = $this->M_Notif->get_all_notif_by_id_user($this->id);
    }

    public function index(){
        redirect('penyaluran/data_master_penyaluran');
    }

    public function data_master_penyaluran()
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
        redirect($this->agent->referrer());
    }

    // update data master penyaluran
    public function update_master_penyaluran($id = '')
    {
        $nama = $this->input->post('nama');

        $data = [
            'nama' => $nama,
            'id_user' => $this->input->post('id_user'),
            'updated_by' => $this->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->M_Penyaluran->update_master_penyaluran($data, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
            redirect($this->agent->referrer());
    }

    // delete data master penyaluran
    public function delete_master_penyaluran($id)
    {
        $this->M_Penyaluran->delete_master_penyaluran($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
            redirect($this->agent->referrer());
    }

    // send data penyaluran
    public function send_data_penyaluran($id, $status = null)
    {
        // check if status is null
        if($status == null){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Status kosong!</div>');
            redirect($this->agent->referrer());
        }

        $data = [
            'status' => $status,
            'updated_by' => $this->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->M_Penyaluran->update_master_penyaluran($data, $id);
        if($status == 1){
            // send notification to user assigned
            $id_user = $this->M_Penyaluran->get_master_penyaluran_by_id($id)->id_user;
            $this->notif->create_notif($id_user, 'Ada tugas penyaluran baru!', 'Anda mendapatkan tugas penyaluran baru dari ' . $this->nama, 'penyaluran co magang', $id);
        }else if ($status == 2) {
            // send notification to user created
            $id_user = $this->M_Penyaluran->get_master_penyaluran_by_id($id)->created_by;
            $this->notif->create_notif($id_user, 'Tugas penyaluran selesai!', 'Tugas penyaluran yang anda buat telah selesai', 'penyaluran co magang', $id);
        }

        
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dikirim!</div>');
        redirect($this->agent->referrer());
    }

    // detail penyaluran, show all penyaluran by id master penyaluran
    public function detail_penyaluran($id_master_penyaluran)
    {
        // get master penyaluran by id
        $master_penyaluran = $this->M_Penyaluran->get_master_penyaluran_by_id($id_master_penyaluran);
        $data["title"] = $master_penyaluran->nama;
        $data['status'] = $master_penyaluran->status;

        $data['id_master_penyaluran'] = $id_master_penyaluran;

        $filter = [
            'nama' => $this->input->post('nama') ?? null,
            'nik' => $this->input->post('nik') ?? null,
            'norek' => $this->input->post('norek') ?? null,
            'status' => $this->input->post('status') ?? null,
            // 'id_master_bansos' => $this->input->post('id') ?? null,
            'tahun' => $this->input->post('tahun') ?? null,
            'jenis_bansos' => $this->input->post('jenis_bansos') ?? null,
            'status' => $this->input->post('status') ?? null,
            'kabupaten' => $this->input->post('kabupaten'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
        ];
        $data["filter"] = $filter;

        // filter master
        $filter_master = [
            'id_master_penyaluran' => $id_master_penyaluran,
            'status' => $this->input->post('master_status') ?? null,
        ];
        $data["filter_master"] = $filter_master;

        $data["data"] = $this->M_Penyaluran->get_data_penyaluran_by_id_master_penyaluran($filter, $filter_master);
        
        // echo json_encode($data);die;
        $data["notif"] = $this->data['notif'];
        $this->load->view('template_admin/meta', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/menu', $data);
        $this->load->view('admin/penyaluran/detail_penyaluran', $data);
        $this->load->view('template_admin/footer', $data);
    }

    // delete data penyaluran
    public function delete_data_penyaluran($id)
    {
        $data = [
            'is_deleted' => 1,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->id,
        ];
        $this->M_Penyaluran->update_data_penyaluran($data, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        redirect($this->agent->referrer());
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

        $data["notif"] = $this->data['notif'];
        $this->load->view('template_admin/meta', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/menu', $data);
        $this->load->view('admin/penyaluran/data_penyaluran', $data);
        $this->load->view('template_admin/footer', $data);
    }

    // add_data_bansos for ajax request
    public function add_data_bansos()
    {
        try {
            $id_master_penyaluran = $this->input->post('id_master_penyaluran');
            // check if id_master_penyaluran is empty
            if ($id_master_penyaluran == '') {
                $response['error'] = "id_master_penyaluran kosong!";
                $response['message'] = "Gagal mengirim data bansos!";
                $response['status'] = false;
                echo json_encode($response);
                return false;
            }
    
            // get master penyaluran by id
            $master_penyaluran = $this->M_Penyaluran->get_master_penyaluran_by_id($id_master_penyaluran);
            // check if master_penyaluran is empty
            if ($master_penyaluran == '') {
                $response['error'] = "master_penyaluran kosong!";
                $response['message'] = "Gagal mengirim data bansos!";
                $response['status'] = false;
                echo json_encode($response);
                return false;
            }

            $check_all = $this->input->post('check_all'); // check if all data is checked

            // check if all data is checked
            if($check_all === true || $check_all === 'true'){
                $filter = $this->input->post('filter');
                // get all data bansos
                $data_bansos = $this->M_Bansos->get_all_bansos_penyaluran($filter, $id_master_penyaluran);
                // check if data_bansos is empty
                if ($data_bansos == '') {
                    $response['error'] = "data_bansos kosong!";
                    $response['message'] = "Gagal mengirim data bansos!";
                    $response['status'] = false;
                    echo json_encode($response);
                    return false;
                }

                $tmp = [];
                foreach ($data_bansos as $key => $value) {
                    $tmp[] = [
                        'id_master_penyaluran' => $id_master_penyaluran,
                        'id_bansos' => $value->id,
                        'created_by' => $this->id,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                }

                $check = $this->M_Penyaluran->bulk_insert_data_penyaluran($tmp);
            }else if($check_all === false || $check_all === 'false'){
                $checked_list = $this->input->post('checked_list'); // id_bansos that checked
                // check if checked_list is empty and array
                if ($checked_list == '' || !is_array($checked_list)) {
                    $response['error'] = "checked_list kosong atau bukan array!";
                    $response['message'] = "Gagal mengirim data bansos!";
                    $response['status'] = false;
                    echo json_encode($response);
                    return false;
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
            }else{
                $response['error'] = "check_all kosong!";
                $response['message'] = "Gagal mengirim data bansos!";
                $response['status'] = false;
                echo json_encode($response);
                return false;
            }
    
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

    
    // update data bansos for ajax request
    public function update_data_bansos(){
        try {
            $id_master_penyaluran = $this->input->post('id_master_penyaluran');
            // check if id_master_penyaluran is empty
            if ($id_master_penyaluran == '') {
                $response['error'] = "id_master_penyaluran kosong!";
                $response['message'] = "Gagal mengirim data bansos!";
                $response['status'] = false;
                echo json_encode($response);
                return false;
            }

            // get master penyaluran by id
            $master_penyaluran = $this->M_Penyaluran->get_master_penyaluran_by_id($id_master_penyaluran);
            // check if master_penyaluran is empty
            if ($master_penyaluran == '') {
                $response['error'] = "master_penyaluran kosong!";
                $response['message'] = "Gagal mengirim data bansos!";
                $response['status'] = false;
                echo json_encode($response);
                return false;
            }

            // check status
            $status_data = $this->input->post('status_data');
            if($status_data == ''){
                $response['error'] = "status_data kosong!";
                $response['message'] = "Gagal update data bansos!";
                $response['status'] = false;
                echo json_encode($response);
                return false;
            }

            $check_all = $this->input->post('check_all'); // check if all data is checked


            // check if all data is checked
            if($check_all === true || $check_all === 'true'){
                $filter = $this->input->post('filter');
                $filter_penyaluran = $this->input->post('filter_penyaluran');   
                // get all data bansos
                $data_bansos = $this->M_Penyaluran->get_data_penyaluran_by_id_master_penyaluran($filter, $filter_penyaluran);
                // check if data_bansos is empty
                if ($data_bansos == '') {
                    $response['error'] = "data_bansos kosong!";
                    $response['message'] = "Gagal mengirim data bansos!";
                    $response['status'] = false;
                    echo json_encode($response);
                    return false;
                }

                
                $tmp = [];
                foreach ($data_bansos as $key => $value) {
                    $tmp[] = [
                        'id' => $value->id,
                        'status' => $status_data,
                        'note' => $this->input->post('note') ?? '',
                    ];
                }

                $check = $this->M_Penyaluran->bulk_update_data_penyaluran($tmp, $id_master_penyaluran);
                $tes = "123";
            }else{
                $checked_list = $this->input->post('checked_list'); // id_bansos that checked
                // check if checked_list is empty and array
                if ($checked_list == '' || !is_array($checked_list)) {
                    $response['error'] = "checked_list kosong atau bukan array!";
                    $response['message'] = "Gagal mengirim data bansos!";
                    $response['status'] = false;
                    echo json_encode($response);
                    return false;
                }
        
                $tmp = [];
                foreach ($checked_list as $key => $value) {
                    $tmp[] = [
                        'id' => $value,
                        'status' => $status_data,
                        'note' => $this->input->post('note') ?? '',
                    ];
                }        
                $check = $this->M_Penyaluran->bulk_update_data_penyaluran($tmp, $id_master_penyaluran);
                $tes = "1234";
            }

            if ($check) {
                $response['message'] = "Berhasil update data bansos!";
                $response['status'] = true;
                echo json_encode($response);
            } else {
                $response['error'] = "Gagal update data bansos!";
                $response['message'] = "Gagal update data bansos! $tes";
                $response['status'] = false;
                echo json_encode($response);
            }


        } catch (\Throwable $th) {
            $response['error'] = $th->getMessage();
            $response['message'] = "Gagal update data bansos!";
            $response['status'] = false;
            echo json_encode($response);
        }
    }
}