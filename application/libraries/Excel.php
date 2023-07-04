<?php defined('BASEPATH') or exit('No direct script access allowed');

ini_set('max_execution_time', 0); // 0 = Unlimited

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel
{
    protected $_ci;
  
    public function __construct()
    {
        log_message('Debug', 'PHPSpreadSheet class is loaded.');
        $this->_ci = &get_instance();
        $this->_ci->load->database();
    }

    // import excel
    public function import_data_bansos($file, $id)
    {
        try {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($file);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $data = [];
            foreach ($sheetData as $key => $value) {
                if ($key > 0) {
                    $data[] = [
                        'id_master_bansos' => $id, // id master bansos
                        'norek' => $value[0],
                        'nama' => $value[1],
                        'nik' => $value[2],
                        'kabupaten' => $value[3],
                        'kecamatan' => $value[4],
                        'kelurahan' => $value[5],
                        'tahun' => $value[6],
                        'jenis_bansos' => $value[7],
                        'created_by' => $this->_ci->session->userdata('id')
                    ];
                }
            }
            $check = $this->_ci->db->insert_batch('tb_bansos', $data);
            // check
            if ($check) {
                return [
                    'status' => true,
                    'message' => 'Data berhasil diimport'
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Data gagal diimport'
                ];
            }
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }
}
