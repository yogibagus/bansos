<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bansos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_User', 'M_Bansos']);
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
            if ($this->role != 1 && $this->role != 2 && $this->role != 3) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak memiliki akses!</div>');
                redirect($this->agent->referrer());
            }
        }

        // get notif
        $this->load->model('M_Notif');
        $this->data['notif'] = $this->M_Notif->get_all_notif_by_id_user($this->id);
    }

    public function index(){
        redirect('bansos/data_master_bansos');
    }

    public function data_master_bansos()
    {
        $data["notif"] = $this->data['notif'];
        $data_master = $this->M_Bansos->get_all_master_bansos();
        $data["data"] = $data_master['data'];
        $data["summary"] = $data_master['summary'];
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
    
    // get all data bansos
    public function all()
    {
        $data["title"] = "Data Bansos";

        $data["master_bansos"] = $this->M_Bansos->get_all_master_bansos()['data'];

        $filter = [
            'nama' => $this->input->post('nama') ?? null,
            'nik' => $this->input->post('nik') ?? null,
            'norek' => $this->input->post('norek') ?? null,
            'id_master_bansos' => $this->input->post('id') ?? null,
            'tahun' => $this->input->post('tahun') ?? null,
            'jenis_bansos' => $this->input->post('jenis_bansos') ?? null,
            'status' => $this->input->post('status') ?? null,
            'kabupaten' => $this->input->post('kabupaten'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
        ];
        $data["filter"] = $filter;
        
        $filter_penyaluran = [
            'status' => $this->input->post('status_penyaluran') ?? null,
        ];

        $data["filter_penyaluran"] = $filter_penyaluran;


        // log
        // echo json_encode($filter);die;
        $data["data"] = $this->M_Bansos->get_all_bansos($filter, $filter_penyaluran);

        $data["notif"] = $this->data['notif'];
        $this->load->view('template_admin/meta', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/menu', $data);
        $this->load->view('admin/bansos/all', $data);
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
            redirect($this->agent->referrer());
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bansos berhasil diupdate!</div>');
        redirect($this->agent->referrer());
    }

    // create bansos
    public function create_bansos()
    {

        $id_master_bansos = $this->input->post('id_master_bansos');
        // check if empty
        if ($id_master_bansos == '' || $id_master_bansos == null){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Master Bansos tidak boleh kosong!</div>');
            redirect($this->agent->referrer());
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
            redirect($this->agent->referrer());
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bansos berhasil ditambahkan!</div>');
        redirect($this->agent->referrer());
    }

    // bulk update bansos status with array id, example is [2,3,4]
    public function bulk_update_bansos_status()
    {
        $id = $this->input->post('checked_list');

        // check is id array
        if (!is_array($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">ID tidak valid!</div>');
            redirect($this->agent->referrer());
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

    // download_format_bansos
    public function download_format_bansos()
    {
        $this->load->helper('download');
        $data = file_get_contents(base_url('assets/format/download_format_bansos.xlsx'));
        $name = 'format_bansos.xlsx';
        force_download($name, $data);
    }

    // import_data_bansos
    public function import_data_bansos($id)
    {
        $id_master_bansos = $id;
        // check if empty
        if ($id_master_bansos == '' || $id_master_bansos == null){
            return [
                'error' => 'Master Bansos tidak boleh kosong!',
                'message' => 'Upload gagal!',
                'status' => false
            ];
        }

        // path
        $path = './berkas/uploads';
        // check if path exist
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx';
        $config['max_size'] = 2000; // 2MB
        $config['file_name'] = 'temp_bansos';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);


        if (!$this->upload->do_upload('file')) {
            $response['error'] = $this->upload->display_errors();
            $response['message'] = 'Upload gagal!';
            $response['status'] = false;
            echo json_encode($response);
            return;
        } else {
            $file = $this->upload->data();
            $check = $this->excel->import_data_bansos($file['full_path'], $id_master_bansos);
            if ($check['status'] == false) {
                $response['error'] = $check['message'];
                $response['message'] = 'Upload gagal!';
                $response['status'] = false;
                echo json_encode($response);
                return;
            }

            // remove file
            unlink($file['full_path']);

            $response['message'] = 'Upload berhasil!';
            $response['status'] = true;
            echo json_encode($response);
            return;
        }
    }
    

}