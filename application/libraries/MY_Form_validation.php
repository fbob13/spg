<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{

    public function __construct($rules = array())
    {
        parent::__construct($rules);
    }


    public function unique_kode_kategori()
    {

        $kode_cabang = $this->CI->input->post('kode_cabang');
        $kode_kategori = $this->CI->input->post('kode_kategori');

        $check = $this->CI->db->get_where('mst_kategori', array('kode_cabang' => $kode_cabang, 'kode_kategori' => $kode_kategori), 1);

        if ($check->num_rows() > 0) {

            $this->set_message('unique_kode_kategori', 'Kode telah terdaftar');

            return FALSE;
        }

        return TRUE;
    }
}