<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_kerusakan extends CI_Controller
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

    public function empty()
    {
        //$tanggal_jadwal =  date("Y-m-d");
        //$query = $this->db->query("select * from view_rutin where tanggal_jadwal = '$tanggal_jadwal'");
        //$data['data']=$query->result();
        $data['data'] = '';
        $data['status'] = "ok";
        echo json_encode($data);
    }

    public function kerusakan_new()
    {
        //Cek jika user Login / variabel "asm_st" ada di session
        //Kalau sudah login, variabel "asm_st" = "yes"
        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');
        if (empty($cek) || $cek <> "yes") {
            return $this->load->view('auth/v_login');
        }

        //Jika User = 99(IT) atau 1(admin)
        if ($this->Login_model->cekLogin('NRUTIN_INPUT', 'view')) {
            $data['link'] = 'nrutin';
            $data['sublink'] = 'kerusakan';
            $data['subsublink'] = '';

            $data['title'] = 'Input Kerusakan - ' . $this->config->item('app_name');

            //CSS untuk menampilkan tabel (datatables)
            $data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>
                                 <link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/select2/css/select2.min.css"/>
                                 <link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/select2/css/select2-bootstrap-5-theme.css"/>';


            //JS untuk menampilkan tabel (datatables)
            $data['cust_js'] = '<script  src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>
                                <script src="' . base_url() . 'dist/libs/litepicker/dist/litepicker.js"></script>
                                <script src="' . base_url() . 'dist/libs/select2/js/select2.full.min.js"></script>';

            $query = $this->db->query("select id_user val ,nama deskripsi from mst_user where spc = 0");
            $data['teknisi'] = $query->result();

            $query = $this->db->query('select id_gedung val,nama_gedung AS deskripsi from mst_gedung');
            $data['gedung'] = $query->result();

            $query = $this->db->query("select id_pkrutin val,jenis_pekerjaan deskripsi from mst_pkrutin");
            $data['pkrutin'] = $query->result();


            $query = $this->db->query("select id_item val,CONCAT_WS(' / ', nama_item, merek_item) deskripsi from view_item");
            $data['item'] = $query->result();


            $this->load->view('tabler/a_header', $data);
            $this->load->view('tabler/kerusakan/v_kerusakan', $data);
            $this->load->view('tabler/a_footer');
            $this->load->view('tabler/kerusakan/v_kerusakan_js', $data);
            $this->load->view('tabler/a_end_page');
        }
        //Jika bukan kembali ke base_url (home)
        else {
            redirect(base_url());
        }
        //END FUNCTION
    }

    public function kerusakan_save()
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
        elseif ($this->Login_model->cekLogin('NRUTIN_INPUT', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST

                $id_user = $this->session->userdata['id_user'];
                (isset($_POST['tanggal_laporan']))         ? $tanggal_laporan =      $_POST['tanggal_laporan']         : $tanggal_laporan = "";

                (isset($_POST['id_gedung']))         ? $id_gedung =      $_POST['id_gedung']         : $id_gedung = "";
                (isset($_POST['id_ruangan']))         ? $id_ruangan =      $_POST['id_ruangan']         : $id_ruangan = "";
                (isset($_POST['id_item']))         ? $id_item =      $_POST['id_item']         : $id_item = "";
                (isset($_POST['keluhan']))         ? $keluhan =      $_POST['keluhan']         : $keluhan = "";
                (isset($_POST['prioritas']))         ? $prioritas =      $_POST['prioritas']         : $prioritas = "";


                $data['err_id_gedung'] = "";
                $data['err_id_ruangan'] = "";
                $data['err_id_item'] = "";
                $data['err_keluhan'] = "";
                $data['err_prioritas'] = "";

                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('id_gedung', 'id_gedung', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_ruangan', 'id_ruangan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_item', 'id_item', 'trim|required', $pesanError);
                $this->form_validation->set_rules('keluhan', 'keluhan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('prioritas', 'prioritas', 'trim|required', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_id_gedung'] = form_error('id_gedung', '<span>', '</span>');
                    $data['err_id_ruangan'] = form_error('id_ruangan', '<span>', '</span>');
                    $data['err_id_item'] = form_error('id_item', '<span>', '</span>');
                    $data['err_keluhan'] = form_error('keluhan', '<span>', '</span>');
                    $data['err_prioritas'] = form_error('prioritas', '<span>', '</span>');

                    $err = true;
                    $data['status'] = 'nok';
                }

                $ip = $this->session->userdata('id_user');

                //Jika jika ada kembar
                /*
                $query = $this->db->query("select * from as_rutin where id_pembuat = '$ip' and id_gedung = '$id_gedung' 
                        and id_ruangan = '$id_ruangan' and id_item = '$id_item' and id_pkrutin = '$id_pkrutin' and id_user=$id_user and tanggal_jadwal='$tanggal_jadwal'");
                if ($query->num_rows() >= 1) {
                    $err = true;
                    $data['status'] = 'nok';
                    $data['err_id_pkrutin'] = 'Pekerjaan sudah ada di list';
                }
                */


                //Jika ada error 
                if ($err) {
                    //
                }
                //Jika tidak ada error
                else {

                    //Insert data
                    $data_insert = array(
                        'id_pembuat' => $this->session->userdata('id_user'),
                        'id_gedung' => $id_gedung,
                        'id_ruangan' => $id_ruangan,
                        'id_item' => $id_item,
                        'keluhan' => $keluhan,
                        'tanggal_laporan' => $tanggal_laporan,
                        'prioritas' => $prioritas,
                        'created_at' => date("Y-m-d H:i:s")
                    );

                    $this->db->insert('as_nonrutin', $data_insert);

                    $data['info'] = 'Data Keluhan Berhasil Disimpan';
                    $data['status'] = 'ok';
                }
            }
        } else {
            $data['status'] = 'nok';
            $data['info'] = 'Anda Tidak Berhak';
        }

        echo json_encode($data);

        //END FUNCTION
    }


    public function kerusakan_view()
    {
        //Cek jika user Login / variabel "asm_st" ada di session
        //Kalau sudah login, variabel "asm_st" = "yes"
        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');
        if (empty($cek) || $cek <> "yes") {
            return $this->load->view('auth/v_login');
        }
        //Jika User = 99(IT) atau 1(admin)
        if ($this->Login_model->cekLogin('NRUTIN_DATA', 'view')) {
            $data['link'] = 'nrutin';
            $data['sublink'] = 'update_kerusakan';
            $data['subsublink'] = '';

            $data['title'] = 'Update Kerusakan - ' . $this->config->item('app_name');

            //CSS untuk menampilkan tabel (datatables)
            $data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>';

            //JS untuk menampilkan tabel (datatables)
            $data['cust_js'] = '<script  src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>';

            $query = $this->db->query('select id_user val,nama deskripsi from mst_user where spc in (0)');
            $data['teknisi'] = $query->result();

            $option = array(
                array("val" => 0, "deskripsi" => "Belum Dikerjakan"),
                array("val" => 1, "deskripsi" => "On Progress"),
                array("val" => 2, "deskripsi" => "Pending"),
                array("val" => 3, "deskripsi" => "Selesai"),
                array("val" => 4, "deskripsi" => "Tidak Dikerjakan"),
            );

            $data['statuspekerjaan'] = $option;


            $optionx = array(
                array("val" => 1, "deskripsi" => "Rendah"),
                array("val" => 2, "deskripsi" => "Menengah"),
                array("val" => 3, "deskripsi" => "Tinggi"),
                array("val" => 4, "deskripsi" => "Urgent"),
            );

            $data['prioritas'] = $optionx;

            $data['edit'] = $this->Login_model->cekLogin('NRUTIN_DATA', 'edit') ? 'ok' : 'nok';
            $data['delete'] = $this->Login_model->cekLogin('NRUTIN_DATA', 'delete') ? 'ok' : 'nok';


            $tipe = ($this->uri->segment(3)) ? $this->uri->segment(3) : '';
            if ($tipe == 'nok') $data['stat'] = 'nok';
            else $data['stat'] = 'all';



            $this->load->view('tabler/a_header', $data);
            $this->load->view('tabler/kerusakan/v_kerusakan_view', $data);
            $this->load->view('tabler/a_footer');
            $this->load->view('tabler/kerusakan/v_kerusakan_view_js', $data);
            $this->load->view('tabler/a_end_page');
        }
        //Jika bukan kembali ke base_url (home)
        else {
            redirect(base_url());
        }
        //END FUNCTION
    }

    public function nonrutin_query()
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
        elseif ($this->Login_model->cekLogin('NRUTIN_INPUT', 'view')) {
            (isset($_POST['tipe']))         ? $tipe = $_POST['tipe']         : $tipe = "";
            if ($tipe <> "") {
                if ($tipe == "ruangan") {
                    (isset($_POST['id_gedung']))         ? $id_gedung =       $_POST['id_gedung']         : $id_gedung = "";
                    $query = $this->db->query("select id_ruangan val,CONCAT_WS(' / ', kode_ruangan, uraian_ruangan) AS deskripsi 
                                from mst_ruangan where status_ruangan = 1 and id_gedung=$id_gedung");
                } else if ($tipe == "item") {
                    (isset($_POST['id_gedung']))         ? $id_gedung =       $_POST['id_gedung']         : $id_gedung = "";
                    (isset($_POST['id_ruangan']))         ? $id_ruangan =       $_POST['id_ruangan']         : $id_ruangan = "";
                    $query = $this->db->query("select id_item val,CONCAT_WS(' / ', nama_item,merek_item, tipe_item) AS deskripsi 
                                from view_ruangan_item where id_gedung=$id_gedung and id_ruangan = $id_ruangan");
                } else if ($tipe == "pkrutin") {
                    (isset($_POST['id_item']))         ? $id_item =       $_POST['id_item']         : $id_item = "";
                    //Ambil data kategori dari id_item
                    $query = $this->db->query("select * from mst_item where id_item = $id_item");
                    $qitem = $query->first_row();
                    $kategori = $qitem->id_kategori;
                    //Ambil data pkrutin berdasarkan id_kategori
                    $query = $this->db->query("select id_pkrutin val, CONCAT_WS(' / ' , jenis_pekerjaan, uraian_pekerjaan) as deskripsi 
                                from mst_pkrutin where id_kategori =$kategori");
                } else if ($tipe == "draft") {

                    (isset($_POST['tanggal_jadwal']))   ? $tanggal_jadwal = $_POST['tanggal_jadwal']    : $tanggal_jadwal = "";
                    (isset($_POST['id_user']))          ? $id_user        = $_POST['id_user']           : $id_user = "";
                    //Ambil data kategori dari id_item
                    $query = $this->db->query("select * from view_rutin_draft where id_user = $id_user and tanggal_jadwal='$tanggal_jadwal'");
                } else if ($tipe == "delete_list") {

                    (isset($_POST['id_rutin']))         ? $id_rutin =       $_POST['id_rutin']         : $id_rutin = "";
                    //Ambil data kategori dari id_item
                    $this->db->where('id_rutin_draft', $id_rutin);
                    $this->db->delete('as_rutin_draft');
                }
            }
            if ($tipe == "delete_list" || $tipe == "delete_draft") {
                $data["data"] = 'ok';
            } else {
                $data["data"] = $query->result();
            }
        }
        //Jika bukan kembali ke base_url (home)
        else {
            $data['status'] = 'nok';
            $data['info'] = 'Anda Tidak Berhak';
        }

        echo json_encode($data);
    }

    public function kerusakan_view_data()
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
        elseif ($this->Login_model->cekLogin('NRUTIN_DATA', 'view')) {

            $this->load->library('SSP');
            $table = 'view_nonrutin';
            $primaryKey = 'id_nonrutin';

            $columns = array(
                array('db' => 'id_nonrutin', 'dt' => 'id_nonrutin'),
                array('db' => 'id_teknisi',  'dt' => 'id_teknisi'),
                array('db' => 'nama_teknisi',   'dt' => 'nama_teknisi'),
                array('db' => 'tanggal_laporan',   'dt' => 'tanggal_laporan'),
                array('db' => 'tanggal_perbaikan',   'dt' => 'tanggal_perbaikan'),
                array('db' => 'nama_gedung',   'dt' => 'nama_gedung'),
                array('db' => 'nama_ruangan',   'dt' => 'nama_ruangan'),
                array('db' => 'nama_item',   'dt' => 'nama_item'),
                array('db' => 'prioritas',   'dt' => 'prioritas'),
                array('db' => 'prioritas_text',   'dt' => 'prioritas_text'),
                array('db' => 'status_pekerjaan_text',   'dt' => 'status_pekerjaan_text'),
                array('db' => 'status_pekerjaan',   'dt' => 'status_pekerjaan'),
                array('db' => 'keterangan',   'dt' => 'keterangan'),
                array('db' => 'keluhan',   'dt' => 'keluhan')
            );

            $sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db'   => $this->db->database,
                'host' => $this->db->hostname
            );

            (isset($_POST['status_pekerjaan']))         ? $status_pekerjaan =       $_POST['status_pekerjaan']         : $status_pekerjaan = "";
            (isset($_POST['bulan']))         ? $bulan =       $_POST['bulan']         : $bulan = date('m');
            (isset($_POST['tahun']))         ? $tahun =       $_POST['tahun']         : $tahun = date('Y');
            (isset($_POST['prioritas']))         ? $prioritas =       $_POST['prioritas']         : $prioritas = "";
            (isset($_POST['stat']))         ? $stat =       $_POST['stat']         : $stat = "";


            //$where  = "id_user='2' and status_pekerjaan = 3";
            $where = "";
            $is_user = "";

            if ($this->session->userdata('spc') == 2){
                $is_user = " and id_pembuat =" . $this->session->userdata('id_user') ;
            }
            if ($stat == "nok") {
                $where = "status_pekerjaan in (0,1,2,4) $is_user";
            } else {
                if ($bulan == 99) {
                    $where = "DATE_FORMAT(tanggal_laporan,'%Y') = '$tahun' $is_user";
                } else {
                    $where = "DATE_FORMAT(tanggal_laporan,'%Y-%m') = '$tahun-$bulan' $is_user";
                }

                if ($status_pekerjaan <> "" && $status_pekerjaan <> 99) {
                    $where = $where . " and status_pekerjaan = $status_pekerjaan $is_user";
                }

                if ($prioritas <> "") {
                    $where = $where . " and prioritas = $prioritas $is_user";
                }
            }


            echo json_encode(
                //SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns );
                //$this->ssp->simple($_GET, $sql_details, $table, $primaryKey, $columns );
                $this->ssp->complex($_REQUEST, $sql_details, $table, $primaryKey, $columns, '', $where)
            );


            //$query = $this->db->query("select * from view_nonrutin");
            //$data["data"] = $query->result();
        }
        //Jika bukan kembali ke base_url (home)
        else {
            $data['status'] = 'nok';
            $data['info'] = 'Anda Tidak Berhak';
            echo json_encode($data);
        }




        //END FUNCTION
    }

    public function kerusakan_view_upd()
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
        elseif ($this->Login_model->cekLogin('NRUTIN_DATA', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_nonrutin']))         ? $id_nonrutin =       $_POST['id_nonrutin']         : $id_nonrutin = "";
                (isset($_POST['status_pekerjaan']))         ? $status_pekerjaan =       $_POST['status_pekerjaan']         : $status_pekerjaan = "";
                (isset($_POST['keterangan']))         ? $keterangan =      $_POST['keterangan']         : $keterangan = "";
                (isset($_POST['id_teknisi']))         ? $id_teknisi =      $_POST['id_teknisi']         : $id_teknisi = "";
                (isset($_POST['prioritas']))         ? $prioritas =      $_POST['prioritas']         : $prioritas = "";


                $data['err_status_pekerjaan'] = "";
                $data['err_keterangan'] = "";

                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('status_pekerjaan', 'status_pekerjaan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_teknisi', 'id_teknisi', 'trim|required', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_status_pekerjaan'] = form_error('status_pekerjaan', '<span>', '</span>');
                    $data['err_keterangan'] = form_error('keterangan', '<span>', '</span>');
                    $data['err_id_teknisi'] = form_error('id_teknisi', '<span>', '</span>');

                    $err = true;
                    $data['status'] = 'nok';
                }

                //Jika ada error 
                if ($err) {
                    //
                }
                //Jika tidak ada error
                else {

                    $this->db->trans_begin();
                    $tanggal_perbaikan = null;

                    //ambil data keterangan lama
                    $query = $this->db->query("select * from as_nonrutin where id_nonrutin = $id_nonrutin");
                    $old_data = $query->first_row();
                    $old_keterangan = $old_data->keterangan;

                    $nketerangan = $old_keterangan . $this->session->userdata('nama') . ' : ' . $keterangan . chr(10) . chr(13) . '------------------'. chr(10) . chr(13);

                    if ($status_pekerjaan == 3) {
                        $tanggal_perbaikan =  date("Y-m-d");
                    }
                    //Update data
                    $data_insert = array(
                        'id_teknisi' => $id_teknisi,
                        'status_pekerjaan' => $status_pekerjaan,
                        'keterangan' => $nketerangan,
                        'prioritas' => $prioritas,
                        'tanggal_perbaikan' => $tanggal_perbaikan
                    );
                    $this->db->where('id_nonrutin', $id_nonrutin);
                    $this->db->update('as_nonrutin', $data_insert);


                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        $data['info'] = 'Data Gagal Diupdate';
                        $data['status'] = 'nok';
                    } else {
                        $this->db->trans_commit();
                        $data['info'] = 'Data Berhasil Diupdate';
                        $data['status'] = 'ok';
                    }
                }
            }
        } else {
            $data['status'] = 'nok';
            $data['info'] = 'Anda Tidak Berhak';
        }

        echo json_encode($data);

        //END FUNCTION
    }

    public function kerusakan_view_approve()
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
        elseif ($this->Login_model->cekLogin('NRUTIN_DATA', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_nonrutin']))         ? $id_nonrutin =       $_POST['id_nonrutin']         : $id_nonrutin = "";
                (isset($_POST['status']))         ? $status =       $_POST['status']         : $status = "";
                (isset($_POST['keterangan']))         ? $keterangan =      $_POST['keterangan']         : $keterangan = "";

                $this->db->trans_begin();

                //ambil data keterangan lama
                $query = $this->db->query("select * from as_nonrutin where id_nonrutin = $id_nonrutin");
                $old_data = $query->first_row();
                $old_keterangan = $old_data->keterangan;

                $nketerangan = $old_keterangan . $this->session->userdata('nama') . ' : ' . $keterangan . chr(10) . chr(13) . '------------------'. chr(10) . chr(13);
                if ($status == 'ok') {
                    //Update data
                    $data_insert = array(
                        'status_pekerjaan' => 5,
                        'keterangan' => $nketerangan,
                    );
                    $this->db->where('id_nonrutin', $id_nonrutin);
                    $this->db->update('as_nonrutin', $data_insert);
                    $data['info'] = 'Data Berhasil Di Approve';
                } else if ($status == 'nok') {
                    //Update data
                    $data_insert = array(
                        'status_pekerjaan' => 1,
                        'keterangan' => $nketerangan,
                    );
                    $this->db->where('id_nonrutin', $id_nonrutin);
                    $this->db->update('as_nonrutin', $data_insert);
                    $data['info'] = 'Data Berhasil Di Tolak';
                }

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $data['info'] = 'Data Gagal Diupdate';
                    $data['status'] = 'nok';
                } else {
                    $this->db->trans_commit();

                    $data['status'] = 'ok';
                }
            }
        } else {
            $data['status'] = 'nok';
            $data['info'] = 'Anda Tidak Berhak';
        }

        echo json_encode($data);

        //END FUNCTION
    }

    public function kerusakan_view_del()
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
        elseif ($this->Login_model->cekLogin('NRUTIN_DATA', 'delete')) {

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_nonrutin']))         ? $id_nonrutin =       $_POST['id_nonrutin']         : $id_nonrutin = "";

                if ($id_nonrutin == "") {
                    $data['status'] = 'nok';
                    $data['info'] = 'Tidak ada data yang dihapus';
                } else {
                    $this->db->where('id_nonrutin', $id_nonrutin);
                    $this->db->delete('as_nonrutin');
                    $data['info'] = 'Data keluhan Berhasil Dihapus';
                    $data['status'] = 'ok';
                    $data['last'] = $this->db->last_query();
                }
            }
        } else {
            $data['status'] = 'nok';
            $data['info'] = 'Anda Tidak Berhak';
        }

        echo json_encode($data);

        //END FUNCTION
    }
}
