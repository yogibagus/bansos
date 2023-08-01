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
    
    // get all data master penyaluran with count data penyaluran by id master penyaluran
    public function get_all_master_penyaluran()
    {
        $this->db->select('tb_master_penyaluran.*, tb_user.nama as nama_user, user_updated.nama as nama_user_updated, user_assigned.nama as nama_user_assigned, tb_master_penyaluran.status as status_master_penyaluran');
        $this->db->from('tb_master_penyaluran');
        $this->db->join('tb_user', 'tb_user.id = tb_master_penyaluran.created_by');
        $this->db->join('tb_user as user_updated', 'user_updated.id = tb_master_penyaluran.updated_by', 'left');
        $this->db->join('tb_user as user_assigned', 'user_assigned.id = tb_master_penyaluran.id_user', 'left');
        $this->db->join('tb_penyaluran', 'tb_penyaluran.id_master_penyaluran = tb_master_penyaluran.id', 'left');
        $this->db->where('tb_master_penyaluran.is_deleted', 0);

        // get role
        $role = $this->session->userdata('role');
        if($role == 4){ // role CO magang
            // get id user
            $id_user = $this->session->userdata('id');
            // check id user
            $this->db->where_in('tb_master_penyaluran.id_user', [$id_user, -1]);
            // check status 1 or 2 with query or
            $this->db->where_in('tb_master_penyaluran.status', [1,2]);
        }
        

        // $this->db->where('tb_penyaluran.is_deleted', 1);
        $this->db->group_by('tb_master_penyaluran.id');
        $this->db->order_by('tb_master_penyaluran.id', 'desc');
        $master = $this->db->get()->result();
        
        // query to count data penyaluran by status (0: belum disalurkan, 1: tersalur, 2: tidak tersalur)
        foreach ($master as $key => $value) {
            $count = 0;
            $this->db->select('count(id) as jumlah');
            $this->db->from('tb_penyaluran');
            $this->db->where('id_master_penyaluran', $value->id);
            $this->db->where('status', 0);
            $this->db->where('is_deleted', 0);
            $belum_disalurkan = $this->db->get()->row();
            $master[$key]->data_belum_disalurkan = $belum_disalurkan->jumlah;

            $this->db->select('count(id) as jumlah');
            $this->db->from('tb_penyaluran');
            $this->db->where('id_master_penyaluran', $value->id);
            $this->db->where('status', 1);
            $this->db->where('is_deleted', 0);
            $tersalur = $this->db->get()->row();
            $master[$key]->data_tersalur = $tersalur->jumlah;

            $this->db->select('count(id) as jumlah');
            $this->db->from('tb_penyaluran');
            $this->db->where('id_master_penyaluran', $value->id);
            $this->db->where('status', 2);
            $this->db->where('is_deleted', 0);
            $tidak_tersalur = $this->db->get()->row();
            $master[$key]->data_tidak_tersalur = $tidak_tersalur->jumlah;

            $count = $count + $belum_disalurkan->jumlah + $tersalur->jumlah + $tidak_tersalur->jumlah;
            $master[$key]->jumlah_data_penyaluran = $count;
        }

        // count global bansos
        $total_all_bansos = 0;
        $total_all_bansos_tersalur = 0;
        $total_all_bansos_tidak_tersalur = 0;
        $total_all_bansos_belum_tersalur = 0;
        foreach ($master as $key => $value) {
            $total_all_bansos = $total_all_bansos + $value->jumlah_data_penyaluran;
            $total_all_bansos_tersalur = $total_all_bansos_tersalur + $value->data_tersalur;
            $total_all_bansos_tidak_tersalur = $total_all_bansos_tidak_tersalur + $value->data_tidak_tersalur;
            $total_all_bansos_belum_tersalur = $total_all_bansos_belum_tersalur + $value->data_belum_disalurkan;
        }
        
        $result = [
            'data' => $master,
            'summary' => [
                'total_all_bansos' => $total_all_bansos,
                'total_all_bansos_tersalur' => $total_all_bansos_tersalur,
                'total_all_bansos_tidak_tersalur' => $total_all_bansos_tidak_tersalur,
                'total_all_bansos_belum_tersalur' => $total_all_bansos_belum_tersalur,
            ]
        ];

        return $result;
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

    // get data penyaluran by id master penyaluran, with data bansos
    public function get_data_penyaluran_by_id_master_penyaluran($filter, $filter_penyaluran)
    {
        // get all data penyaluran by id master penyaluran
        $this->db->select('
        tb_penyaluran.id,
        tb_penyaluran.id_master_penyaluran,
        tb_penyaluran.id_bansos,
        tb_penyaluran.status as status_penyaluran,
        tb_penyaluran.note,
        tb_penyaluran.created_at as created_at_penyaluran,
        tb_penyaluran.updated_at as updated_at_penyaluran,
        tb_penyaluran.created_by as created_by_penyaluran,
        tb_penyaluran.updated_by as updated_by_penyaluran,
        tb_user.nama as user_created,
        tb_user.nama as user_updated,
        tb_bansos.nama,
        tb_bansos.norek,
        tb_bansos.nik,
        tb_bansos.tahun,
        tb_bansos.jenis_bansos,
        tb_bansos.kabupaten,
        tb_bansos.kecamatan,
        tb_bansos.kelurahan
        ');
        $this->db->from('tb_penyaluran');
        $this->db->join('tb_bansos', 'tb_bansos.id = tb_penyaluran.id_bansos');
        $this->db->join('tb_user', 'tb_user.id = tb_penyaluran.created_by');
        $this->db->join('tb_user as user_updated', 'user_updated.id = tb_penyaluran.updated_by', 'left');
        
        // filter_penyaluran
        if(!empty($filter_penyaluran)){
            foreach ($filter_penyaluran as $key => $value) {
                if($value != ''){
                    $this->db->where('tb_penyaluran.'.$key, $value);
                }
            }
        }

        // filter bansos
        if(!empty($filter)){
            foreach ($filter as $key => $value) {
                if($value != ''){
                    $this->db->where('tb_bansos.'.$key, $value);
                }
            }
        }

        // echo $this->db->last_query();die;
        $this->db->where('tb_penyaluran.is_deleted', 0);
        $this->db->where('tb_bansos.is_deleted', 0);
        $this->db->order_by('tb_penyaluran.id', 'desc');
        $data_penyaluran = $this->db->get()->result();
        // print query
        return $data_penyaluran;
    }

    // update data penyaluran
    public function update_data_penyaluran($data, $id = '')
    {
        if ($id == '') {
            // new insert
            $this->db->insert('tb_penyaluran', $data);
        } else {
            // update
            $this->db->where('id', $id);
            $this->db->update('tb_penyaluran', $data);
        }
    }

    // bulk update data penyaluran
    function bulk_update_data_penyaluran( $data, $id_master_penyaluran )
    {
        $this->db->trans_start();
        $this->db->where('id_master_penyaluran', $id_master_penyaluran);
        $check = $this->db->update_batch('tb_penyaluran', $data, 'id');
        $this->db->trans_complete();
        if ($check) {
            return true;
        } else {
            return false;
        }
    }

}