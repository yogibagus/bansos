<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Beritaacara extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        // set utc + 7
        date_default_timezone_set('Asia/Jakarta');
    }

    // get berita all berita acara
    public function get_all_berita_acara()
    {
        $this->db->select('a.*, b.nama as nama_provinsi, c.nama as nama_kabupaten, d.nama as nama_kecamatan, e.nama as nama_kelurahan');
        $this->db->from('tb_berita_acara a');
        // join tb_provinsi b
        $this->db->join('tb_provinsi b', 'a.id_provinsi = b.id', 'left');
        // join tb_kabupaten c
        $this->db->join('tb_kabupaten c', 'a.id_kabupaten = c.id', 'left');
        // join tb_kecamatan d
        $this->db->join('tb_kecamatan d', 'a.id_kecamatan = d.id', 'left');
        // join tb_kelurahan e
        $this->db->join('tb_kelurahan e', 'a.id_kelurahan = e.id', 'left');

        $this->db->where('a.is_deleted', 0);
        // order by created_at desc
        $this->db->order_by('a.created_at', 'desc');
        return $this->db->get()->result();
    }

    // get berita acara by id
    public function get_berita_acara_by_id($id)
    {
        $this->db->select('a.*, b.nama as nama_provinsi, c.nama as nama_kabupaten, d.nama as nama_kecamatan, e.nama as nama_kelurahan');
        $this->db->from('tb_berita_acara a');
        // join tb_provinsi b
        $this->db->join('tb_provinsi b', 'a.id_provinsi = b.id', 'left');
        // join tb_kabupaten c
        $this->db->join('tb_kabupaten c', 'a.id_kabupaten = c.id', 'left');
        // join tb_kecamatan d
        $this->db->join('tb_kecamatan d', 'a.id_kecamatan = d.id', 'left');
        // join tb_kelurahan e
        $this->db->join('tb_kelurahan e', 'a.id_kelurahan = e.id', 'left');

        $this->db->where('a.is_deleted', 0);
        $this->db->where('a.id', $id);
        return $this->db->get()->row();
    }

    // delete berita acara
    public function delete_berita_acara($id)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_berita_acara', ['is_deleted' => 1, "updated_at" => date('Y-m-d H:i:s'), "updated_by" => $this->session->userdata('id')]);

        // cek apakah berhasil
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // update berita acara
    public function update_berita_acara($data, $id)
    {
        // date now
        $data['updated_at'] = date('Y-m-d H:i:s'); // [optional]
        $data['updated_by'] = $this->session->userdata('id'); // [optional]
        $this->db->where('id', $id);
        $this->db->update('tb_berita_acara', $data);

        // cek apakah berhasil
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // create berita acara
    public function create_berita_acara($data)
    {
        $data['created_by'] = $this->session->userdata('id'); // [optional]
        $this->db->insert('tb_berita_acara', $data);

        // cek apakah berhasil
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
