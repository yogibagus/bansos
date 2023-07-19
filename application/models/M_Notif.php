<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Notif extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        // set utc + 7
        date_default_timezone_set('Asia/Jakarta');
    }

    // create new notif
    public function create_notif($data)
    {
        $this->db->insert('tb_notif', $data);
    }

    // get all notif by id user
    public function get_all_notif_by_id_user($id_user)
    {
        $this->db->select('tb_notif.*, tb_user.nama as receiver, sender.nama as sender');
        $this->db->from('tb_notif');
        $this->db->join('tb_user', 'tb_user.id = tb_notif.id_user');
        $this->db->join('tb_user as sender', 'tb_notif.created_by = sender.id');
        $this->db->where('tb_notif.id_user', $id_user);
        $this->db->where('tb_notif.is_deleted', 0);
        $this->db->order_by('tb_notif.id', 'desc');
        return $this->db->get()->result();
    }

    // get_notif_by_id
    public function get_notif_by_id($id)
    {
        $this->db->select('tb_notif.*, tb_user.nama as receiver, sender.nama as sender');
        $this->db->from('tb_notif');
        $this->db->join('tb_user', 'tb_user.id = tb_notif.id_user');
        $this->db->join('tb_user as sender', 'tb_notif.created_by = sender.id');
        $this->db->where('tb_notif.id', $id);
        $this->db->where('tb_notif.is_deleted', 0);
        return $this->db->get()->row();
    }

    // read notif
    public function read_notif($id)
    {
        $data = [
            'is_read' => 1,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id')
        ];
        $this->db->where('id', $id);
        $this->db->update('tb_notif', $data);
    }

    // read all notif
    public function read_all_notif($id_user)
    {
        $data = [
            'is_read' => 1,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id')
        ];
        $this->db->where('id_user', $id_user);
        $this->db->update('tb_notif', $data);
    }

    // delete notif
    public function delete_notif($id)
    {
        $data = [
            'is_deleted' => 1,
            'deleted_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id')
        ];
        $this->db->where('id', $id);
        $this->db->update('tb_notif', $data);
    }
}