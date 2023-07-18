<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Bansos extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        // set utc + 7
        date_default_timezone_set('Asia/Jakarta');
    }
    
    public function get_all_master_bansos()
    {
        $this->db->select('tb_master_bansos.*, tb_user.nama as nama_user, user_updated.nama as nama_user_updated, count(tb_bansos.id_master_bansos) as jumlah_bansos');
        $this->db->from('tb_master_bansos');
        $this->db->join('tb_user', 'tb_user.id = tb_master_bansos.created_by');
        $this->db->join('tb_user as user_updated', 'user_updated.id = tb_master_bansos.updated_by', 'left');
        $this->db->join('tb_bansos', 'tb_bansos.id_master_bansos = tb_master_bansos.id', 'left');
        $this->db->where('tb_master_bansos.is_deleted', 0);
        $this->db->group_by('tb_master_bansos.id');
        $this->db->order_by('tb_master_bansos.id', 'desc');
        return $this->db->get()->result();
    }

    // get data bansos by id
    public function get_master_bansos_by_id($id)
    {
        $query = $this->db->select('*')
            ->from('tb_master_bansos')
            ->where('id', $id)
            ->where('is_deleted', 0)
            ->get();
        return $query->row();
    }

    // update data bansos
    public function update_master_bansos($data, $id = '')
    {
        if ($id == '') {
            // new insert
            $this->db->insert('tb_master_bansos', $data);
        } else {
            // update
            $this->db->where('id', $id);
            $this->db->update('tb_master_bansos', $data);
        }
    }

    // delete data bansos
    public function delete_master_bansos($id)
    {
        $data = [
            'is_deleted' => 1,
            'deleted_by' => $this->session->userdata('id'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id', $id);
        $this->db->update('tb_master_bansos', $data);
    }

    // get all data bansos
    public function get_all_bansos($filter)
    {
        $this->db->select('tb_bansos.*, tb_master_bansos.nama as nama_master_bansos, tb_user.nama as nama_user, user_updated.nama as nama_user_updated');
        $this->db->from('tb_bansos');
        $this->db->join('tb_master_bansos', 'tb_master_bansos.id = tb_bansos.id_master_bansos', 'left');
        $this->db->join('tb_user', 'tb_user.id = tb_bansos.created_by', 'left');
        $this->db->join('tb_user as user_updated', 'user_updated.id = tb_bansos.updated_by', 'left');
        // filter
        foreach ($filter as $key => $value) {
            if ($value != '') {
                $this->db->like('tb_bansos.' . $key, $value);
            }
        }
        $this->db->where('tb_bansos.is_deleted', 0);
        $this->db->order_by('tb_bansos.id', 'desc');
        return $this->db->get()->result();
    }

    // get all data bansos
    public function get_all_bansos_penyaluran($filter, $id_master_penyaluran)
    {
        // get all data but not in penyaluran with id_master_penyaluran
        $this->db->select('tb_bansos.*, tb_master_bansos.nama as nama_master_bansos, tb_user.nama as nama_user, user_updated.nama as nama_user_updated');
        $this->db->from('tb_bansos');
        $this->db->join('tb_master_bansos', 'tb_master_bansos.id = tb_bansos.id_master_bansos', 'left');
        $this->db->join('tb_user', 'tb_user.id = tb_bansos.created_by', 'left');
        $this->db->join('tb_user as user_updated', 'user_updated.id = tb_bansos.updated_by', 'left');
        // filter
        // check if filter is not empty
        if(!empty($filter)){
            foreach ($filter as $key => $value) {
                if ($value != '') {
                    $this->db->like('tb_bansos.' . $key, $value);
                }
            }
        }

        // echo json_encode($in);die;
        $this->db->where('tb_bansos.is_deleted', 0);
        $this->db->where("tb_bansos.id NOT IN (SELECT id_bansos FROM tb_penyaluran WHERE id_master_penyaluran = $id_master_penyaluran AND is_deleted = 0 AND status != 2)");
        $this->db->order_by('tb_bansos.id', 'desc');
        return $this->db->get()->result();
    }

    // get data bansos by id
    public function get_bansos_by_id($id)
    {
        $query = $this->db->select('tb_bansos.*, tb_master_bansos.nama as nama_master_bansos, tb_user.nama as nama_user, user_updated.nama as nama_user_updated')
            ->from('tb_bansos')
            ->join('tb_master_bansos', 'tb_master_bansos.id = tb_bansos.id_master_bansos')
            ->join('tb_user', 'tb_user.id = tb_bansos.created_by')
            ->where('tb_bansos.id', $id)
            ->where('tb_bansos.is_deleted', 0)
            ->get();
        return $query->row();
    }

    // update data bansos
    public function update_bansos($data, $id = '')
    {
        if ($id == '') {
            // new insert
            $this->db->insert('tb_bansos', $data);
        } else {
            // update
            $this->db->where('id', $id);
            $this->db->update('tb_bansos', $data);
        }
         if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // delete data bansos
    public function delete_bansos($id)
    {
        $data = [
            'is_deleted' => 1,
            'deleted_by' => $this->session->userdata('id'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id', $id);
        $this->db->update('tb_bansos', $data);
         if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //bulk_update_bansos_status
    public function bulk_update_bansos_status($data, $id)
    {
        $this->db->where_in('id', $id);
        $this->db->update('tb_bansos', $data);
         if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}