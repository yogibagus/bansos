<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beritaacara extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_User', 'M_Beritaacara', 'M_Wilayah']);
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
        redirect('beritaacara/data_berita_acara');
    }

    public function data_berita_acara()
    {
        $data["data"] = $this->M_Beritaacara->get_all_berita_acara();
        $data['provinsi'] = $this->M_Wilayah->get_all_provinsi();
        $this->load->view('template_admin/meta', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/menu', $data);
        $this->load->view('admin/beritaacara/data_berita_acara', $data);
        $this->load->view('template_admin/footer', $data);
    }

    // edit berita acara
    public function edit_berita_acara($id)
    {
        $data['data'] = $this->M_Beritaacara->get_berita_acara_by_id($id);
        $data['provinsi'] = $this->M_Wilayah->get_all_provinsi();
        $data['kabupaten'] = $this->M_Wilayah->get_kabupaten_by_id_provinsi($data['data']->id_provinsi);
        $data['kecamatan'] = $this->M_Wilayah->get_kecamatan_by_id_kabupaten($data['data']->id_kabupaten);
        $data['kelurahan'] = $this->M_Wilayah->get_kelurahan_by_id_kecamatan($data['data']->id_kecamatan);
        $this->load->view('template_admin/meta', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/menu', $data);
        $this->load->view('admin/beritaacara/edit_berita_acara', $data);
        $this->load->view('template_admin/footer', $data);
    }

    // update berita acara
    public function update_berita_acara($id)
    {
        $data['jenis_bansos'] = $this->input->post('jenis_bansos');
        $data['tahun'] = $this->input->post('tahun');
        $data['id_provinsi'] = $this->input->post('id_provinsi');
        $data['id_kabupaten'] = $this->input->post('id_kabupaten');
        $data['id_kecamatan'] = $this->input->post('id_kecamatan');
        $data['id_kelurahan'] = $this->input->post('id_kelurahan');

        $check = $this->M_Beritaacara->update_berita_acara($data, $id);
        if ($check) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengubah data berita acara!</div>');
            redirect('beritaacara/data_berita_acara');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengubah data berita acara!</div>');
            redirect('beritaacara/data_berita_acara');
        }
    }

    // create berita acara
    public function create_berita_acara()
    {
        $data['jenis_bansos'] = $this->input->post('jenis_bansos');
        $data['tahun'] = $this->input->post('tahun');
        $data['id_provinsi'] = $this->input->post('id_provinsi');
        $data['id_kabupaten'] = $this->input->post('id_kabupaten');
        $data['id_kecamatan'] = $this->input->post('id_kecamatan');
        $data['id_kelurahan'] = $this->input->post('id_kelurahan');

        $check = $this->M_Beritaacara->create_berita_acara($data);
        if ($check) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambah data berita acara!</div>');
            redirect('beritaacara/data_berita_acara');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambah data berita acara!</div>');
            redirect('beritaacara/data_berita_acara');
        }

    }

    // delete berita acara
    public function delete_berita_acara($id)
    {
        $check = $this->M_Beritaacara->delete_berita_acara($id);
        if ($check) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus data berita acara!</div>');
            redirect('beritaacara/data_berita_acara');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menghapus data berita acara!</div>');
            redirect('beritaacara/data_berita_acara');
        }
    }

}
