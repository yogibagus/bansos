<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Penyaluran extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        // set utc + 7
        date_default_timezone_set('Asia/Jakarta');
    }
    
    public function get_all_master_penyaluran()
    {
        $this->db->select('tb_master_penyaluran.*, tb_user.nama as nama_user, user_updated.nama as nama_user_updated, user_assigned.nama as nama_user_assigned');
        $this->db->from('tb_master_penyaluran');
        $this->db->join('tb_user', 'tb_user.id = tb_master_penyaluran.created_by');
        $this->db->join('tb_user as user_updated', 'user_updated.id = tb_master_penyaluran.updated_by', 'left');
        $this->db->join('tb_user as user_assigned', 'user_assigned.id = tb_master_penyaluran.id_user', 'left');
        // $this->db->join('tb_penyaluran', 'tb_penyaluran.id_master_penyaluran = tb_master_penyaluran.id', 'left');
        $this->db->where('tb_master_penyaluran.is_deleted', 0);
        $this->db->group_by('tb_master_penyaluran.id');
        $this->db->order_by('tb_master_penyaluran.id', 'desc');
        return $this->db->get()->result();
    }

    // get data master penyaluran by id
    public function get_master_penyaluran_by_id($id)
    {
        $query = $this->db->select('*')
            ->from('tb_master_penyaluran')
            ->where('id', $id)
            ->where('is_deleted', 0)
            ->get();
        return $query->row();
    }

    // update data master penyaluran
    public function update_master_penyaluran($data, $id = '')
    {
        if ($id == '') {
            // new insert
            $this->db->insert('tb_master_penyaluran', $data);
        } else {
            // update
            $this->db->where('id', $id);
            $this->db->update('tb_master_penyaluran', $data);
        }
    }

    // delete data master penyaluran
    public function delete_master_penyaluran($id)
    {
        $data = [
            'is_deleted' => 1,
            'deleted_by' => $this->session->userdata('id'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id', $id);
        $this->db->update('tb_master_penyaluran', $data);
    }

    // bulk insert data penyaluran
    public function bulk_insert_data_penyaluran($data)
    {
        $this->db->trans_start();
        $check = $this->db->insert_batch('tb_penyaluran', $data);
        $this->db->trans_complete();
        if ($check) {
            return true;
        } else {
            return false;
        }
    }
}