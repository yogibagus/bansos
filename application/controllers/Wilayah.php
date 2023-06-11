<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_User', 'M_Wilayah']);
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
        echo "no one here";
    }

    // get provinsi for AJAX
    public function get_provinsi(){
        $provinsiOptions = $this->M_Wilayah->get_all_provinsi();

        // Generate the HTML options for Provinsi
        $optionsHtml = '<option value="" selected disabled>- Pilih Provinsi -</option>';
        foreach ($provinsiOptions as $provinsi) {
            $optionsHtml .= '<option value="' . $provinsi->id . '">' . $provinsi->nama . '</option>';
        }
        echo $optionsHtml;
    }

    // get kabupaten for AJAX
    public function get_kabupaten(){
        // Retrieve the selected Provinsi ID from the AJAX request
        $provinsiId = $this->input->post('provinsi_id');
        $kabupatenOptions = $this->M_Wilayah->get_kabupaten_by_id_provinsi($provinsiId);

        // Generate the HTML options for Kabupaten
        $optionsHtml = '<option value="" selected disabled>- Pilih Kabupaten -</option>';
        foreach ($kabupatenOptions as $kabupaten) {
            $optionsHtml .= '<option value="' . $kabupaten->id . '">' . $kabupaten->nama . '</option>';
        }
        echo $optionsHtml;
    }

    // get kecamatan for AJAX
    public function get_kecamatan(){
        // Retrieve the selected Kabupaten ID from the AJAX request
        $kabupatenId = $this->input->post('kabupaten_id');
        $kecamatanOptions = $this->M_Wilayah->get_kecamatan_by_id_kabupaten($kabupatenId);

        // Generate the HTML options for Kecamatan
        $optionsHtml = '<option value="" selected disabled>- Pilih Kecamatan -</option>';
        foreach ($kecamatanOptions as $kecamatan) {
            $optionsHtml .= '<option value="' . $kecamatan->id . '">' . $kecamatan->nama . '</option>';
        }
        echo $optionsHtml;
    }

    // get kelurahan for AJAX
    public function get_kelurahan(){
        // Retrieve the selected Kecamatan ID from the AJAX request
        $kecamatanId = $this->input->post('kecamatan_id');
        $kelurahanOptions = $this->M_Wilayah->get_kelurahan_by_id_kecamatan($kecamatanId);

        // Generate the HTML options for Kelurahan
        $optionsHtml = '<option value="" selected disabled>- Pilih Kelurahan -</option>';
        foreach ($kelurahanOptions as $kelurahan) {
            $optionsHtml .= '<option value="' . $kelurahan->id . '">' . $kelurahan->nama . '</option>';
        }
        echo $optionsHtml;
    }

}
