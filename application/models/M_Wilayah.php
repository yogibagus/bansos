<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Wilayah extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // get all provinsi
    public function get_all_provinsi()
    {
        $this->db->select('*');
        $this->db->from('tb_provinsi');
        return $this->db->get()->result();
    }

    // get all kabupaten
    public function get_all_kabupaten()
    {
        $this->db->select('*');
        $this->db->from('tb_kabupaten');
        return $this->db->get()->result();
    }

    // get all kecamatan
    public function get_all_kecamatan()
    {
        $this->db->select('*');
        $this->db->from('tb_kecamatan');
        return $this->db->get()->result();
    }

    // get all kelurahan
    public function get_all_kelurahan()
    {
        $this->db->select('*');
        $this->db->from('tb_kelurahan');
        return $this->db->get()->result();
    }

    // get kabupaten by id provinsi
    public function get_kabupaten_by_id_provinsi($id_provinsi)
    {
        $this->db->select('*');
        $this->db->from('tb_kabupaten');
        $this->db->where('id_provinsi', $id_provinsi);
        return $this->db->get()->result();
    }

    // get kecamatan by id kabupaten
    public function get_kecamatan_by_id_kabupaten($id_kabupaten)
    {
        $this->db->select('*');
        $this->db->from('tb_kecamatan');
        $this->db->where('id_kabupaten', $id_kabupaten);
        return $this->db->get()->result();
    }

    // get kelurahan by id kecamatan
    public function get_kelurahan_by_id_kecamatan($id_kecamatan)
    {
        $this->db->select('*');
        $this->db->from('tb_kelurahan');
        $this->db->where('id_kecamatan', $id_kecamatan);
        return $this->db->get()->result();
    }
    
}
