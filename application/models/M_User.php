<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_User extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        // set utc + 7
        date_default_timezone_set('Asia/Jakarta');
    }

    public function get_all_users()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('is_deleted', 0);
        return $this->db->get()->result();
    }

    public function get_user_by_email($email)
    {
        $query = $this->db->select('*')
            ->from('tb_user')
            ->where('email', $email)
            ->where('is_deleted', 0)
            ->get();
        // cek apakah email terdaftar
        if ($query->num_rows() < 0) {
            return false;
        } else {
            return $query->row();
        }
    }

    public function get_user_by_id($id)
    {
        $query = $this->db->select('*')
            ->from('tb_user')
            ->where('id', $id)
            ->where('is_deleted', 0)
            ->get();
        return $query->row();
    }

    public function update_user($data, $id = '')
    {
        if ($id == '') {
            // new insert
            $this->db->insert('tb_user', $data);
        } else {
            // update
            $this->db->where('id', $id);
            $this->db->update('tb_user', $data);
        }
    }

    public function count_all_users()
    {
        $query = $this->db->select('*')
            ->from('tb_user')
            ->where('is_deleted', 0)
            ->get();
        return $query->num_rows();
    }

    // soft delete user
    public function delete_user($id)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_user', ['is_deleted' => 1]);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
