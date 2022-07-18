<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_report extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function report()
    {
        //Cek jika user Login / variabel "asm_st" ada di session
        //Kalau sudah login, variabel "asm_st" = "yes"
        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');
        if (empty($cek) || $cek <> "yes") {
            return $this->load->view('auth/v_login');
        }
        //Jika User = 99(IT) atau 1(admin)

        if ($this->Login_model->cekLogin('REP', 'view')) {
            $data['link'] = 'report';
            $data['sublink'] = '';
            $data['subsublink'] = '';

            $data['title'] = 'Report - ' . $this->config->item('app_name');

            //CSS untuk menampilkan tabel (datatables)
            $data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>';

            //JS untuk menampilkan tabel (datatables)
            $data['cust_js'] = '<script src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>
            <script src="' . base_url() . 'dist/libs/litepicker/dist/litepicker.js"></script>';

            $hari = date("Y-m-d");
            (isset($_POST['type']))                 ? $type = $_POST['type']     : $type = 0;
            (isset($_POST['qs-tanggal-awal']))                 ? $tanggal_awal = $_POST['qs-tanggal-awal']     : $tanggal_awal = $hari;
            (isset($_POST['qs-tanggal-akhir']))                 ? $tanggal_akhir = $_POST['qs-tanggal-akhir']     : $tanggal_akhir = $hari;
            (isset($_POST['qs-status']))                 ? $status = $_POST['qs-status']     : $status = 99;
            (isset($_POST['qs-teknisi']))                 ? $teknisi = $_POST['qs-teknisi']     : $teknisi = '';
            (isset($_POST['qs-subkat-none']))                 ? $id_subkategori = $_POST['qs-subkat-none']     : $id_subkategori = '';            
            if($type == 4){
                (isset($_POST['qs-subkat']))                 ? $id_subkategori = $_POST['qs-subkat']     : $id_subkategori = '';
            }
            


            $data['type'] = $type;
            $data['tanggal_awal'] = $tanggal_awal;
            $data['tanggal_akhir'] = $tanggal_akhir;
            $data['status'] = $status;
            $data['teknisi'] = $teknisi;
            $data['id_subkategori'] = $id_subkategori;

            $query = $this->db->query("select id_subkategori val,uraian_subkategori deskripsi from mst_subkategori");
            $data['subkategori'] = $query->result();

            $query = $this->db->query('select id_user,nama from mst_user where spc = 0');
            $data['data_teknisi'] = $query->result();

            $this->load->view('tabler/a_header', $data);
            $this->load->view('tabler/report/v_report', $data);
            $this->load->view('tabler/a_footer');
            $this->load->view('tabler/report/v_report_js', $data);
            $this->load->view('tabler/a_end_page');
        }
        //Jika bukan kembali ke base_url (home)
        else {
            redirect(base_url());
        }
    }

    public function report_data()
    {
        //Cek jika user Login / variabel "asm_st" ada di session
        //Kalau sudah login, variabel "asm_st" = "yes"
        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');
        if (empty($cek) || $cek <> "yes") {
            $data['status'] = 'nok';
            $data['info'] = 'Anda Tidak Berhak';
        }
        //Jika User = 99(IT) atau 1(admin)
        elseif ($this->Login_model->cekLogin('REP', 'view')) {

            (isset($_POST['type']))           ? $type       = $_POST['type']     : $type = 0;

            (isset($_POST['tanggal_awal']))           ? $tanggal_awal       = $_POST['tanggal_awal']     : $tanggal_awal = "";
            (isset($_POST['tanggal_akhir']))           ? $tanggal_akhir       = $_POST['tanggal_akhir']     : $tanggal_akhir = "";
            (isset($_POST['teknisi']))           ? $teknisi       = $_POST['teknisi']     : $teknisi = "";
            (isset($_POST['status']))           ? $status       = $_POST['status']     : $status = "99";
            (isset($_POST['id_subkategori']))           ? $id_subkategori       = $_POST['id_subkategori']     : $id_subkategori = "";

            $data['type'] = $type;

            $str_query_a = "";
            $str_query_b = "";
            $str_query_d = "";
            $where = 'where';

            if ($tanggal_awal <> "" && $tanggal_akhir <> "") {
                $str_query_a = "$where tanggal_jadwal between '$tanggal_awal' and '$tanggal_akhir'";
                $str_query_b = "$where tanggal_laporan between '$tanggal_awal' and '$tanggal_akhir'";
                $str_query_d = "$where tanggal_jadwal between '$tanggal_awal' and '$tanggal_akhir'";
                $where = 'and';
            }

            if ($teknisi <> "") {
                $str_query_a = $str_query_a . " $where id_user =$teknisi";
                $str_query_b = $str_query_b . " $where id_teknisi =$teknisi";
                $str_query_d = $str_query_d . " $where id_user =$teknisi";
                $where = 'and';
            }

            if ($status <> "" && $status <> "99" && $type <> 4) {
                $str_query_a = $str_query_a . " $where status_pekerjaan =$status";
                $str_query_b = $str_query_b . " $where status_pekerjaan =$status";
                //$str_query_d = $str_query_d . " $where status_pekerjaan =$status";
                $where = 'and';
            }

            if ($id_subkategori <> "" && $id_subkategori <> "99" && $id_subkategori <> 4) {
                $str_query_a = $str_query_a . " $where id_subkategori = $id_subkategori";
                //$str_query_b = $str_query_b . " $where status_pekerjaan =$status";
                //$str_query_d = $str_query_d . " $where status_pekerjaan =$status";
                $where = 'and';
            }

            $data['data'] = "";
            if ($type == '') {
                //$query = $this->db->query('select nik,spc from mst_user');
            } elseif ($type == 1) {
                $query = $this->db->query("select * from view_rutin $str_query_a order by tanggal_jadwal,nama_teknisi");
                $data['data'] = $query->result();
                $data['last_query'] = $this->db->last_query();
            } elseif ($type == 2) {
                $query = $this->db->query("select * from view_nonrutin $str_query_b order by tanggal_laporan, nama_teknisi");
                $data['data'] = $query->result();
                $data['last_query'] = $this->db->last_query();
            }elseif ($type == 4) {
                $data['filename'] = $this->Excel_model->report_4($teknisi, $tanggal_awal,$tanggal_akhir, $id_subkategori);
            }

            

            $data['status'] = 'ok';
        }
        //Jika bukan kembali ke base_url (home)
        else {
            $data['status'] = 'nok';
            $data['info'] = 'Anda Tidak Berhak';
        }

        echo json_encode($data);


        //END FUNCTION
    }
}
