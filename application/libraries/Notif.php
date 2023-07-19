<?php defined('BASEPATH') or exit('No direct script access allowed');
// helper for handling notification

class Notif {
    protected $_ci;

    function __construct()
    {
        $this->_ci = &get_instance();
    }

    // create new notification
    function create_notif($id_user, $judul, $pesan, $jenis = '', $id_reff = '')
    {
        $this->_ci->load->model('M_Notif');
        $data = [
            'id_user' => $id_user,
            'id_reff' => $id_reff,
            'judul' => $judul,
            'pesan' => $pesan,
            'jenis' => $jenis,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->_ci->session->userdata('id')
        ];
        $this->_ci->M_Notif->create_notif($data);
    }

    // helper for read notification
    function read_notif($id)
    {
        $this->_ci->load->model('M_Notif');
        $this->_ci->M_Notif->read_notif($id);
    }

    // helper for read all notification
    function read_all_notif($id_user)
    {
        $this->_ci->load->model('M_Notif');
        $this->_ci->M_Notif->read_all_notif($id_user);
    }

    // helper for delete notification
    function delete_notif($id)
    {
        $this->_ci->load->model('M_Notif');
        $this->_ci->M_Notif->delete_notif($id);
    }
}