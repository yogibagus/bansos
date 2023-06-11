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
}