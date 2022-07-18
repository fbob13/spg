<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_jadwal extends CI_Controller
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

    public function rutin_new()
    {
        //Cek jika user Login / variabel "asm_st" ada di session
        //Kalau sudah login, variabel "asm_st" = "yes"
        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');
        if (empty($cek) || $cek <> "yes") {
            return $this->load->view('auth/v_login');
        }

        //Jika User = 99(IT) atau 1(admin)
        if ($this->Login_model->cekLogin('RUTIN_INPUT', 'view')) {
            $data['link'] = 'rutin';
            $data['sublink'] = 'input_jadwal';
            $data['subsublink'] = '';

            $data['title'] = 'Buat Jadwal Rutin - ' . $this->config->item('app_name');

            //CSS untuk menampilkan tabel (datatables)
            $data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>
                                 <link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/select2/css/select2.min.css"/>
                                 <link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/select2/css/select2-bootstrap-5-theme.css"/>';


            //JS untuk menampilkan tabel (datatables)
            //$data['cust_js'] = '<script type="text/javascript" src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>';
            $data['cust_js'] = '<script src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>
                                <script src="' . base_url() . 'dist/libs/litepicker/dist/litepicker.js"></script>
                                <script src="' . base_url() . 'dist/libs/select2/js/select2.full.min.js"></script>';

            $query = $this->db->query("select id_user val ,nama deskripsi from mst_user where spc = 0");
            $data['teknisi'] = $query->result();

            $query = $this->db->query('select id_gedung val,nama_gedung AS deskripsi from mst_gedung');
            $data['gedung'] = $query->result();

            $query = $this->db->query("select id_pkrutin val,jenis_pekerjaan deskripsi from mst_pkrutin");
            $data['pkrutin'] = $query->result();

            $query = $this->db->query("select id_item val,nama_item deskripsi from mst_item");
            $data['item'] = $query->result();


            $this->load->view('tabler/a_header', $data);
            $this->load->view('tabler/jadwal/v_rutin', $data);
            $this->load->view('tabler/a_footer');
            $this->load->view('tabler/jadwal/v_rutin_js', $data);
            $this->load->view('tabler/a_end_page');
        }
        //Jika bukan kembali ke base_url (home)
        else {
            redirect(base_url());
        }
        //END FUNCTION
    }

    public function rutin_query()
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
        elseif ($this->Login_model->cekLogin('RUTIN_INPUT', 'view')) {
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
                    $subkategori = $qitem->id_subkategori;
                    //Ambil data pkrutin berdasarkan id_kategori
                    $query = $this->db->query("select id_pkrutin val, CONCAT_WS(' / ' , jenis_pekerjaan) as deskripsi 
                                from mst_pkrutin where id_subkategori =$subkategori");
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

    public function rutin_save_list()
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
        elseif ($this->Login_model->cekLogin('RUTIN_INPUT', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST

                (isset($_POST['id_user']))         ? $id_user =      $_POST['id_user']         : $id_user = "";
                (isset($_POST['tanggal_jadwal']))         ? $tanggal_jadwal =      $_POST['tanggal_jadwal']         : $tanggal_jadwal = "";

                (isset($_POST['id_gedung']))         ? $id_gedung =      $_POST['id_gedung']         : $id_gedung = "";
                (isset($_POST['id_ruangan']))         ? $id_ruangan =      $_POST['id_ruangan']         : $id_ruangan = "";
                (isset($_POST['id_item']))         ? $id_item =      $_POST['id_item']         : $id_item = "";
                (isset($_POST['id_pkrutin']))         ? $id_pkrutin =      $_POST['id_pkrutin']         : $id_pkrutin = "";


                $data['err_id_gedung'] = "";
                $data['err_id_ruangan'] = "";
                $data['err_id_item'] = "";
                $data['err_id_pkrutin'] = "";

                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('id_gedung', 'id_gedung', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_ruangan', 'id_ruangan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_item', 'id_item', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_pkrutin', 'id_pkrutin', 'trim|required', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_id_gedung'] = form_error('id_gedung', '<span>', '</span>');
                    $data['err_id_ruangan'] = form_error('id_ruangan', '<span>', '</span>');
                    $data['err_id_item'] = form_error('id_item', '<span>', '</span>');
                    $data['err_id_pkrutin'] = form_error('id_pkrutin', '<span>', '</span>');

                    $err = true;
                    $data['status'] = 'nok';
                }

                $ip = $this->session->userdata('id_user');

                //Jika jika ada kembar

                $query = $this->db->query("select * from as_rutin_draft where id_pembuat = '$ip' and id_gedung = '$id_gedung' 
                        and id_ruangan = '$id_ruangan' and id_item = '$id_item' and id_pkrutin = '$id_pkrutin' and id_user=$id_user and tanggal_jadwal='$tanggal_jadwal'");
                if ($query->num_rows() >= 1) {
                    $err = true;
                    $data['status'] = 'nok';
                    $data['err_id_pkrutin'] = 'Pekerjaan sudah ada di list';
                }

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
                        'id_pkrutin' => $id_pkrutin,
                        'id_user' => $id_user,
                        'tanggal_jadwal' => $tanggal_jadwal,
                        //'created_at' => date("Y-m-d H:i:s")
                    );

                    $this->db->insert('as_rutin_draft', $data_insert);

                    $data['info'] = 'Data Pekerjaan Rutin Baru Berhasil Disimpan';
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

    public function rutin_save()
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
        elseif ($this->Login_model->cekLogin('RUTIN_INPUT', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST

                (isset($_POST['id_user']))         ? $id_user =      $_POST['id_user']         : $id_user = "";
                (isset($_POST['tanggal_jadwal']))         ? $tanggal_jadwal =      $_POST['tanggal_jadwal']         : $tanggal_jadwal = "";

                $tgl_full = date("Y-m-d H:i:s");
                $ip = $this->session->userdata('id_user');
                //START TRANSACTION
                $this->db->trans_begin();

                //Ambil data draft
                $query = $this->db->query("select * from as_rutin_draft where id_user=$id_user and tanggal_jadwal ='$tanggal_jadwal'");
                if ($query->num_rows() >= 1) {
                    //Jika draft >=1
                    $data_draft = $query->result();

                    foreach ($data_draft as $df) {
                        //cek kalau datanya sudah ada di tabel AS_RUTIN
                        $query1 = $this->db->query("select * from as_rutin where id_user=$id_user and tanggal_jadwal='$tanggal_jadwal' 
                                                     and id_gedung=$df->id_gedung and id_ruangan=$df->id_ruangan and id_item=$df->id_item and id_pkrutin=$df->id_pkrutin");
                        if ($query1->num_rows() == 0) {
                            $this->db->simple_query("insert into as_rutin (id_user,id_pembuat,id_gedung,id_ruangan,id_item,id_pkrutin,tanggal_jadwal,status_pekerjaan,created_at)
                                                                    values($id_user,$ip,$df->id_gedung,$df->id_ruangan,$df->id_item,$df->id_pkrutin,'$df->tanggal_jadwal',0,'$tgl_full')");
                            $data['query'] = "insert into as_rutin (id_user,id_pembuat,id_gedung,id_ruangan,id_item,id_pkrutin,tanggal_jadwal,status_pekerjaan,created_at)
                            values($id_user,$ip,$df->id_gedung,$df->id_ruangan,$df->id_item,$df->id_pkrutin,'$df->tanggal_jadwal',0,'$tgl_full')";
                        }
                    }

                    //Hapus Draft
                    $query = $this->db->simple_query("delete from as_rutin_draft where id_user=$id_user and tanggal_jadwal='$tanggal_jadwal'");
                    $data['info'] = 'Jadwal berhasil di simpan';
                    $data['status'] = 'ok';
                } else {
                    //Jika kosong return
                    $data['info'] = 'Draft Kosong, tidak ada data yang tersimpan';
                    $data['status'] = 'nok';
                }



                //END TRANSACTION
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    //$data['info'] = 'Draft Kosong, tidak ada data yang tersimpan';
                    //$data['status'] = 'nok';
                } else {
                    $this->db->trans_commit();
                    //$data['info'] = 'Draft Kosong, tidak ada data yang tersimpan';
                    //$data['status'] = 'ok';
                }
            }
        } else {
            $data['status'] = 'nok';
            $data['info'] = 'Anda Tidak Berhak';
        }

        echo json_encode($data);

        //END FUNCTION
    }

    public function rutin_del_draft()
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
        elseif ($this->Login_model->cekLogin('RUTIN_INPUT', 'delete')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST

                (isset($_POST['id_user']))         ? $id_user =      $_POST['id_user']         : $id_user = "";
                (isset($_POST['tanggal_jadwal']))         ? $tanggal_jadwal =      $_POST['tanggal_jadwal']         : $tanggal_jadwal = "";

                //START TRANSACTION

                $this->db->trans_begin();

                $this->db->simple_query("delete from as_rutin_draft where id_user=$id_user and tanggal_jadwal = '$tanggal_jadwal'");

                //END TRANSACTION
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $data['info'] = 'Draft gagal di hapus';
                    $data['status'] = 'nok';
                } else {
                    $this->db->trans_commit();
                    $data['info'] = 'Draft berhasil di hapus';
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

    public function rutin_save_list_old() //save langsung ke tabel as_rutin (tidak apakai tabel temp)
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
        elseif ($this->Login_model->cekLogin('RUTIN_INPUT', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST

                (isset($_POST['id_user']))         ? $id_user =      $_POST['id_user']         : $id_user = "";
                (isset($_POST['tanggal_jadwal']))         ? $tanggal_jadwal =      $_POST['tanggal_jadwal']         : $tanggal_jadwal = "";

                (isset($_POST['id_gedung']))         ? $id_gedung =      $_POST['id_gedung']         : $id_gedung = "";
                (isset($_POST['id_ruangan']))         ? $id_ruangan =      $_POST['id_ruangan']         : $id_ruangan = "";
                (isset($_POST['id_item']))         ? $id_item =      $_POST['id_item']         : $id_item = "";
                (isset($_POST['id_pkrutin']))         ? $id_pkrutin =      $_POST['id_pkrutin']         : $id_pkrutin = "";


                $data['err_id_gedung'] = "";
                $data['err_id_ruangan'] = "";
                $data['err_id_item'] = "";
                $data['err_id_pkrutin'] = "";

                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('id_gedung', 'id_gedung', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_ruangan', 'id_ruangan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_item', 'id_item', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_pkrutin', 'id_pkrutin', 'trim|required', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_id_gedung'] = form_error('id_gedung', '<span>', '</span>');
                    $data['err_id_ruangan'] = form_error('id_ruangan', '<span>', '</span>');
                    $data['err_id_item'] = form_error('id_item', '<span>', '</span>');
                    $data['err_id_pkrutin'] = form_error('id_pkrutin', '<span>', '</span>');

                    $err = true;
                    $data['status'] = 'nok';
                }

                $ip = $this->session->userdata('id_user');

                //Jika jika ada kembar

                $query = $this->db->query("select * from as_rutin where id_pembuat = '$ip' and id_gedung = '$id_gedung' 
                        and id_ruangan = '$id_ruangan' and id_item = '$id_item' and id_pkrutin = '$id_pkrutin' and id_user=$id_user and tanggal_jadwal='$tanggal_jadwal'");
                if ($query->num_rows() >= 1) {
                    $err = true;
                    $data['status'] = 'nok';
                    $data['err_id_pkrutin'] = 'Pekerjaan sudah ada di list';
                }

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
                        'id_pkrutin' => $id_pkrutin,
                        'id_user' => $id_user,
                        'tanggal_jadwal' => $tanggal_jadwal,
                        'created_at' => date("Y-m-d H:i:s")
                    );

                    $this->db->insert('as_rutin', $data_insert);

                    $data['info'] = 'Data Pekerjaan Rutin Baru Berhasil Disimpan';
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


    public function upload()
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
        elseif ($this->Login_model->cekLogin('RUTIN_INPUT', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST

                (isset($_POST['id_user']))         ? $id_user =      $_POST['id_user']         : $id_user = "";
                (isset($_POST['tanggal_jadwal']))         ? $tanggal_jadwal =      $_POST['tanggal_jadwal']         : $tanggal_jadwal = "";

                $tgl_full = date("Y-m-d H:i:s");
                $ip = $this->session->userdata('id_user');
                //START TRANSACTION
                $this->db->trans_begin();





                //END TRANSACTION
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    //$data['info'] = 'Draft Kosong, tidak ada data yang tersimpan';
                    //$data['status'] = 'nok';
                } else {
                    $this->db->trans_commit();
                    //$data['info'] = 'Draft Kosong, tidak ada data yang tersimpan';
                    //$data['status'] = 'ok';
                }
            }

            if (isset($_FILES['dokumen'])) {

                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');


                (isset($_POST['id_user']))         ? $id_user =      $_POST['id_user']         : $id_user = "";
                (isset($_POST['tanggal_jadwal']))         ? $tanggal_jadwal =      $_POST['tanggal_jadwal']         : $tanggal_jadwal = "";

                $tgl_full = date("Y-m-d H:i:s");


                $target_dir = "upload/";
                $target_file = $target_dir . basename($_FILES["dokumen"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $simpan_dokumen = $target_dir . $id_user . '.' . $imageFileType;
                $data['nama_dokumen'] = $id_user . '.' . $imageFileType;

                if (file_exists($simpan_dokumen)) {
                    unlink($simpan_dokumen);
                }
                //cek ukuran file
                if ($_FILES["dokumen"]["size"] > 50000000) {
                    $err = true;
                    $data['status'] = 'nok';
                    $data['err_file'] = '<span>Ukuran file melebihi 50MB</span>';
                } else if ($imageFileType != "xlsx") {
                    $err = true;
                    $data['status'] = 'nok';
                    $data['err_file'] = '<span>Format dokumen tidak sesuai</span>';
                } else {
                    move_uploaded_file($_FILES['dokumen']['tmp_name'], $simpan_dokumen);
                    $err = false;

                    if ($this->Excel_model->upload($simpan_dokumen, $tanggal_jadwal)) {
                        $data['info'] = 'Data Berhasil di upload';
                    } else {
                        $err = true;
                    }
                    //return;
                }
            } else {
                $err = true;
                $data['status'] = 'nok';
                $data['err_file'] = '<span>Silahkan memilih file yang akan di upload</span>';
            }

            if ($err) {
                $data['status'] = 'nok';
                $data['info'] = 'Silahkan koreksi data yang di input';
            } else {


                $data['status'] = 'ok';
            }
        } else {
            $data['status'] = 'nok';
            $data['info'] = 'Anda Tidak Berhak';
        }

        echo json_encode($data);

        //END FUNCTION
    }


    public function rutin_view()
    {

        //Cek jika user Login / variabel "asm_st" ada di session
        //Kalau sudah login, variabel "asm_st" = "yes"
        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');
        if (empty($cek) || $cek <> "yes") {
            return $this->load->view('auth/v_login');
        }
        //Jika User = 99(IT) atau 1(admin)
        if ($this->Login_model->cekLogin('RUTIN_DATA', 'view')) {
            $data['link'] = 'rutin';
            $data['sublink'] = 'lihat_jadwal';
            $data['subsublink'] = '';

            $data['title'] = 'Pekerjaan Rutin - ' . $this->config->item('app_name');

            //CSS untuk menampilkan tabel (datatables)
            $data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>
                                 <link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/select2/css/select2.min.css"/>
                                 <link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/select2/css/select2-bootstrap-5-theme.css"/>';

            //JS untuk menampilkan tabel (datatables)
            //$data['cust_js'] = '<script type="text/javascript" src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>';
            $data['cust_js'] = '<script src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>
                                <script src="' . base_url() . 'dist/libs/select2/js/select2.full.min.js"></script>';

            //if($this->session->userdata('spc') == 1 or $this->session->userdata('spc') == 99)
            //{
            $option = array(
                array("val" => 0, "deskripsi" => "Belum Dikerjakan"),
                array("val" => 1, "deskripsi" => "On Progress"),
                array("val" => 2, "deskripsi" => "Pending"),
                array("val" => 3, "deskripsi" => "Selesai"),
                array("val" => 4, "deskripsi" => "Tidak Dikerjakan"),
            );


            $data['statuspekerjaan'] = $option;

            $query = $this->db->query('select id_user val,nama deskripsi from mst_user where spc in (0)');
            $data['teknisi'] = $query->result();

            $data['edit'] = $this->Login_model->cekLogin('RUTIN_DATA', 'edit') ? 'ok' : 'nok';
            $data['delete'] = $this->Login_model->cekLogin('RUTIN_DATA', 'delete') ? 'ok' : 'nok';

            $query = $this->db->query('select * from mst_subkategori');
            $data['subkategori'] = $query->result();

            $tipe = ($this->uri->segment(4)) ? $this->uri->segment(4) : '';
            if ($tipe == 'today') $data['today'] = 'ok';
            else $data['today'] = 'nok';

            $this->load->view('tabler/a_header', $data);
            $this->load->view('tabler/jadwal/v_rutin_view', $data);
            $this->load->view('tabler/a_footer');
            $this->load->view('tabler/jadwal/v_rutin_view_js', $data);
            $this->load->view('tabler/a_end_page');
        }
        //Jika bukan kembali ke base_url (home)
        else {
            redirect(base_url());
        }
        //END FUNCTION
    }

    public function rutin_view_data()   //Pakai server side rendering untuk datatables
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
        elseif ($this->Login_model->cekLogin('RUTIN_DATA', 'view')) {

            $this->load->library('SSP');
            $table = 'view_rutin';
            $primaryKey = 'id_rutin';

            $columns = array(
                array('db' => 'id_rutin', 'dt' => 'id_rutin'),
                array('db' => 'id_user',  'dt' => 'id_user'),
                array('db' => 'nama_teknisi',   'dt' => 'nama_teknisi'),
                array('db' => 'tanggal_jadwal',   'dt' => 'tanggal_jadwal'),
                array('db' => 'nama_gedung',   'dt' => 'nama_gedung'),
                array('db' => 'nama_ruangan',   'dt' => 'nama_ruangan'),
                array('db' => 'nama_item',   'dt' => 'nama_item'),
                array('db' => 'jenis_pekerjaan',   'dt' => 'jenis_pekerjaan'),
                array('db' => 'status_pekerjaan_text',   'dt' => 'status_pekerjaan_text'),
                array('db' => 'status_pekerjaan',   'dt' => 'status_pekerjaan'),
                array('db' => 'keterangan',   'dt' => 'keterangan'),
                array('db' => 'id_subkategori',   'dt' => 'id_subkategori'),

                array('db' => 'pk',   'dt' => 'pk'),
                array('db' => 'arus_r',   'dt' => 'arus_r'),
                array('db' => 'arus_s',   'dt' => 'arus_s'),
                array('db' => 'arus_t',   'dt' => 'arus_t'),
                array('db' => 'teg_r',   'dt' => 'teg_r'),
                array('db' => 'teg_s',   'dt' => 'teg_s'),
                array('db' => 'teg_t',   'dt' => 'teg_t'),
                array('db' => 'teg_v',   'dt' => 'teg_v'),
                array('db' => 'psi',   'dt' => 'psi'),
                array('db' => 'oli',   'dt' => 'oli'),
                array('db' => 'solar',   'dt' => 'solar'),
                array('db' => 'radiator',   'dt' => 'radiator'),
                array('db' => 'eng_hours',   'dt' => 'eng_hours'),
                array('db' => 'accu',   'dt' => 'accu'),
                array('db' => 'temp',   'dt' => 'temp'),
                array('db' => 'kap',   'dt' => 'kap'),
                array('db' => 'noice',   'dt' => 'noice'),
                array('db' => 'qty',   'dt' => 'qty'),
                array('db' => 'vol',   'dt' => 'vol'),
                array('db' => 'tgl_kadaluarsa',   'dt' => 'tgl_kadaluarsa'),
                array('db' => 'kondisi',   'dt' => 'kondisi'),
                array('db' => 'tindakan',   'dt' => 'tindakan'),

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
            (isset($_POST['today']))         ? $today =       $_POST['today']         : $today = 'nok';


            //$where  = "id_user='2' and status_pekerjaan = 3";
            $where = "";
            $tgl = date('Y-m-d');
            if ($today == 'ok') {
                $where = "tanggal_jadwal ='$tgl' ";
            } else {
                if ($bulan == 99) {
                    $where = "DATE_FORMAT(tanggal_jadwal,'%Y') = '$tahun'";
                } else {
                    $where = "DATE_FORMAT(tanggal_jadwal,'%Y-%m') = '$tahun-$bulan'";
                }

                if ($status_pekerjaan <> "" && $status_pekerjaan <> 99) {
                    $where = $where . " and status_pekerjaan = $status_pekerjaan";
                }
            }


            echo json_encode(
                //SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns );
                //$this->ssp->simple($_GET, $sql_details, $table, $primaryKey, $columns );
                $this->ssp->complex($_REQUEST, $sql_details, $table, $primaryKey, $columns, '', $where)
            );


            /*
            $query = $this->db->query("select * from view_rutin order by tanggal_jadwal desc");
            $data["data"] = $query->result();
            */
        }
        //Jika bukan kembali ke base_url (home)
        else {
            $data['status'] = 'nok';
            $data['info'] = 'Anda Tidak Berhak';
            echo json_encode($data);
        }

        //echo json_encode($data);


        //END FUNCTION
    }

    public function rutin_view_data_ori()
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
        elseif ($this->Login_model->cekLogin('RUTIN_DATA', 'view')) {
            $query = $this->db->query("select * from view_rutin order by tanggal_jadwal desc");
            $data["data"] = $query->result();
        }
        //Jika bukan kembali ke base_url (home)
        else {
            $data['status'] = 'nok';
            $data['info'] = 'Anda Tidak Berhak';
        }

        echo json_encode($data);


        //END FUNCTION
    }


    public function rutin_view_upd()
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
        elseif ($this->Login_model->cekLogin('RUTIN_DATA', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_rutin']))         ? $id_rutin =       $_POST['id_rutin']         : $id_rutin = "";
                (isset($_POST['status_pekerjaan']))         ? $status_pekerjaan =       $_POST['status_pekerjaan']         : $status_pekerjaan = "";
                (isset($_POST['keterangan']))         ? $keterangan =      $_POST['keterangan']         : $keterangan = "";
                (isset($_POST['id_user']))         ? $id_user =      $_POST['id_user']         : $id_user = "";

                (isset($_POST['pk']))         ? $pk =      $_POST['pk']         : $pk = '';
                (isset($_POST['arus_r']))         ? $arus_r =      $_POST['arus_r']         : $arus_r = '';
                (isset($_POST['arus_s']))         ? $arus_s =      $_POST['arus_s']         : $arus_s = '';
                (isset($_POST['arus_t']))         ? $arus_t =      $_POST['arus_t']         : $arus_t = '';
                (isset($_POST['teg_r']))         ? $teg_r =      $_POST['teg_r']         : $teg_r = '';
                (isset($_POST['teg_s']))         ? $teg_s =      $_POST['teg_s']         : $teg_s = '';
                (isset($_POST['teg_t']))         ? $teg_t =      $_POST['teg_t']         : $teg_t = '';
                (isset($_POST['teg_v']))         ? $teg_v =      $_POST['teg_v']         : $teg_v = '';
                (isset($_POST['psi']))         ? $psi =      $_POST['psi']         : $psi = '';
                (isset($_POST['oli']))         ? $oli =      $_POST['oli']         : $oli = '';
                (isset($_POST['solar']))         ? $solar =      $_POST['solar']         : $solar = '';
                (isset($_POST['radiator']))         ? $radiator =      $_POST['radiator']         : $radiator = '';
                (isset($_POST['eng_hours']))         ? $eng_hours =      $_POST['eng_hours']         : $eng_hours = '';
                (isset($_POST['accu']))         ? $accu =      $_POST['accu']         : $accu = '';
                (isset($_POST['temp']))         ? $temp =      $_POST['temp']         : $temp = '';
                (isset($_POST['kap']))         ? $kap =      $_POST['kap']         : $kap = '';
                (isset($_POST['noice']))         ? $noice =      $_POST['noice']         : $noice = '';
                (isset($_POST['qty']))         ? $qty =      $_POST['qty']         : $qty = '';
                (isset($_POST['vol']))         ? $vol =      $_POST['vol']         : $vol = '';
                (isset($_POST['tgl_kadaluarsa']))         ? $tgl_kadaluarsa =      $_POST['tgl_kadaluarsa']         : $tgl_kadaluarsa = '';
                (isset($_POST['kondisi']))         ? $kondisi =      $_POST['kondisi']         : $kondisi = '';
                (isset($_POST['tindakan']))         ? $tindakan =      $_POST['tindakan']         : $tindakan = '';



                $data['err_status_pekerjaan'] = "";
                $data['err_keterangan'] = "";

                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('status_pekerjaan', 'status_pekerjaan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_status_pekerjaan'] = form_error('status_pekerjaan', '<span>', '</span>');
                    $data['err_keterangan'] = form_error('keterangan', '<span>', '</span>');

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

                    $tanggal_realisasi = null;

                    if ($status_pekerjaan == 3) {
                        $tanggal_realisasi =  date("Y-m-d");
                    }
                    /*
                    if ($status_pekerjaan == 3) {
                        $tanggal_realisasi =  date("Y-m-d");
                        //Jika pekerjaan selesai buat jadwal sesuai periodenya
                        //ambil data pekerjaan yang di update
                        $query = $this->db->query("select * from as_rutin where id_rutin ='$id_rutin' ");
                        $data_jadwal = $query->first_row();

                        if ($data_jadwal->status_pekerjaan <> 3) {
                            $query = $this->db->query("select * from mst_pkrutin where id_pkrutin ='$data_jadwal->id_pkrutin' ");
                            $data_pkrutin = $query->first_row();
                            $tgl =  date("Y-m-d");

                            $data_insert = array(
                                'id_user'           => $id_user,
                                'id_pembuat'        => $data_jadwal->id_pembuat,
                                'id_gedung'         => $data_jadwal->id_gedung,
                                'id_ruangan'        => $data_jadwal->id_ruangan,
                                'id_item'           => $data_jadwal->id_item,
                                'id_pkrutin'        => $data_jadwal->id_pkrutin,
                                'tanggal_jadwal'    => date('Y-m-d', strtotime($tgl . "+ " . ($data_pkrutin->interval_hari * $data_pkrutin->pengali) . " days")),
                                'created_at'        => date("Y-m-d H:i:s")
                            );

                            $this->db->insert('as_rutin', $data_insert);
                        }
                    }
                    */

                    //ambil data keterangan lama
                    $query = $this->db->query("select * from as_rutin where id_rutin = $id_rutin");
                    $old_data = $query->first_row();
                    $old_keterangan = $old_data->keterangan;

                    $nketerangan = $old_keterangan . $this->session->userdata('nama') . ' : ' . $keterangan . chr(10) . chr(13) . '------------------'. chr(10) . chr(13);

                    //Update data
                    $data_insert = array(
                        'status_pekerjaan' => $status_pekerjaan,
                        'keterangan' => $nketerangan,
                        'tanggal_realisasi' => $tanggal_realisasi,
                        'id_user' => $id_user,

                        'pk' => $pk,
                        'arus_r' => $arus_r,
                        'arus_s' => $arus_s,
                        'arus_t' => $arus_t,
                        'teg_r' => $teg_r,
                        'teg_s' => $teg_s,
                        'teg_t' => $teg_t,
                        'teg_v' => $teg_v,
                        'psi' => $psi,
                        'oli' => $oli,
                        'solar' => $solar,
                        'radiator' => $radiator,
                        'eng_hours' => $eng_hours,
                        'accu' => $accu,
                        'temp' => $temp,
                        'kap' => $kap,
                        'noice' => $noice,
                        'qty' => $qty,
                        'vol' => $vol,
                        'tgl_kadaluarsa' => $tgl_kadaluarsa,
                        'kondisi' => $kondisi,
                        'tindakan' => $tindakan,


                    );
                    $this->db->where('id_rutin', $id_rutin);
                    $this->db->update('as_rutin', $data_insert);

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

    public function rutin_view_approve()
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
        elseif ($this->Login_model->cekLogin('RUTIN_DATA', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_rutin']))         ? $id_rutin =       $_POST['id_rutin']         : $id_rutin = "";
                (isset($_POST['status']))         ? $status =       $_POST['status']         : $status = "";
                (isset($_POST['keterangan']))         ? $keterangan =       $_POST['keterangan']         : $keterangan = "";


                $this->db->trans_begin();

                //ambil data keterangan lama
                $query = $this->db->query("select * from as_rutin where id_rutin = $id_rutin");
                $old_data = $query->first_row();
                $old_keterangan = $old_data->keterangan;

                $nketerangan = $old_keterangan . $this->session->userdata('nama') . ' : ' . $keterangan . chr(10) . chr(13) . '------------------'. chr(10) . chr(13);
/*
$nketerangan = $old_keterangan . $this->session->userdata('nama') . ' : ' . $keterangan . '
------------------
';
*/
                //Update data

                //$tanggal_realisasi = null;
                //$tanggal_realisasi =  date("Y-m-d");

                if ($status == 'ok') {
                    //Jika pekerjaan selesai buat jadwal sesuai periodenya
                    //ambil data pekerjaan yang di update
                    $query = $this->db->query("select * from as_rutin where id_rutin ='$id_rutin' ");
                    $data_jadwal = $query->first_row();

                    //cek jika sudah 3 berarti sudah pernah di update sebelumnya
                    if ($data_jadwal->status_pekerjaan <> 5) {
                        $query = $this->db->query("select * from mst_pkrutin where id_pkrutin ='$data_jadwal->id_pkrutin' ");
                        $data_pkrutin = $query->first_row();
                        //$tgl =  date("Y-m-d");
                        $tgl =  $data_jadwal->tanggal_realisasi;

                        $data_insert = array(
                            'id_user'           => $data_jadwal->id_user,
                            'id_pembuat'        => 999999,
                            'id_gedung'         => $data_jadwal->id_gedung,
                            'id_ruangan'        => $data_jadwal->id_ruangan,
                            'id_item'           => $data_jadwal->id_item,
                            'id_pkrutin'        => $data_jadwal->id_pkrutin,
                            'tanggal_jadwal'    => date('Y-m-d', strtotime($tgl . "+ " . ($data_pkrutin->interval_hari * $data_pkrutin->pengali) . " days")),
                            'created_at'        => date("Y-m-d H:i:s")
                        );

                        $this->db->insert('as_rutin', $data_insert);
                    }



                    $data_insert = array(
                        'status_pekerjaan' => 5,
                        'keterangan' => $nketerangan
                    );
                    $this->db->where('id_rutin', $id_rutin);
                    $this->db->update('as_rutin', $data_insert);
                    $data['info'] = 'Data Berhasil Di Approve';
                } else if ($status == 'nok') {

                    //Update data
                    $data_insert = array(
                        'status_pekerjaan' => 1,
                        'keterangan' => $nketerangan
                    );
                    $this->db->where('id_rutin', $id_rutin);
                    $this->db->update('as_rutin', $data_insert);
                    $data['info'] = 'Data Berhasil Ditolak';
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

    public function rutin_view_del()
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
        elseif ($this->Login_model->cekLogin('RUTIN_DATA', 'delete')) {

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_rutin']))         ? $id_rutin =       $_POST['id_rutin']         : $id_rutin = "";

                if ($id_rutin == "") {
                    $data['status'] = 'nok';
                    $data['info'] = 'Tidak ada data yang dihapus';
                } else {
                    $this->db->where('id_rutin', $id_rutin);
                    $this->db->delete('as_rutin');
                    $data['info'] = 'Data Pekerjaan Rutin Berhasil Dihapus';
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
}
