<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_master extends CI_Controller
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
    public function item()
    {
        //Cek jika user Login / variabel "asm_st" ada di session
        //Kalau sudah login, variabel "asm_st" = "yes"
        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');
        if (empty($cek) || $cek <> "yes") {
            return $this->load->view('auth/v_login');
        }



        //Jika User = 99(IT) atau 1(admin)
        if ($this->Login_model->cekLogin('MST_ITE', 'view')) {
            $data['link'] = 'master';
            $data['sublink'] = 'item';
            $data['subsublink'] = '';

            $data['title'] = 'Master Item - ' . $this->config->item('app_name');

            //CSS untuk menampilkan tabel (datatables)
            $data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>';

            //JS untuk menampilkan tabel (datatables)
            $data['cust_js'] = '<script  src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>';

            $query = $this->db->query("select id_kategori val, uraian_kategori deskripsi from mst_kategori");
            $data['kategori'] = $query->result();
            $this->load->view('tabler/a_header', $data);
            $this->load->view('tabler/master/v_item', $data);
            $this->load->view('tabler/a_footer');
            $this->load->view('tabler/master/v_item_js', $data);
            $this->load->view('tabler/a_end_page');
        }
        //Jika bukan kembali ke base_url (home)
        else {
            redirect(base_url());
        }
        //END FUNCTION
    }

    public function item_data()
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
        elseif ($this->Login_model->cekLogin('MST_ITE', 'view')) {
            $query = $this->db->query("select * from view_item where status_item = 1");
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

    public function item_new()
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
        elseif ($this->Login_model->cekLogin('MST_ITE', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['nama_item']))         ? $nama_item =       $_POST['nama_item']         : $nama_item = "";
                (isset($_POST['merek_item']))         ? $merek_item =      $_POST['merek_item']         : $merek_item = "";
                (isset($_POST['tipe_item']))         ? $tipe_item =      $_POST['tipe_item']         : $tipe_item = "";
                (isset($_POST['id_kategori']))         ? $id_kategori =      $_POST['id_kategori']         : $id_kategori = "";
                (isset($_POST['id_subkategori']))         ? $id_subkategori =      $_POST['id_subkategori']         : $id_subkategori = "";

                $data['err_nama_item'] = "";
                $data['err_merek_item'] = "";
                $data['err_tipe_item'] = "";
                $data['err_kategori'] = "";
                $data['err_subkategori'] = "";

                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('nama_item', 'nama_item', 'trim|required', $pesanError);
                $this->form_validation->set_rules('merek_item', 'merek_item', 'trim|required', $pesanError);
                $this->form_validation->set_rules('tipe_item', 'id_ruangan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_subkategori', 'id_subkategori', 'trim|required', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_nama_item'] = form_error('nama_item', '<span>', '</span>');
                    $data['err_merek_item'] = form_error('merek_item', '<span>', '</span>');
                    $data['err_tipe_item'] = form_error('tipe_item', '<span>', '</span>');
                    $data['err_kategori'] = form_error('id_kategori', '<span>', '</span>');
                    $data['err_subkategori'] = form_error('id_subkategori', '<span>', '</span>');

                    $err = true;
                    $data['status'] = 'nok';
                }

                //Jika ada error 
                if ($err) {
                    //
                }
                //Jika tidak ada error
                else {

                    //Insert data
                    $data_insert = array(
                        'nama_item' => $nama_item,
                        'merek_item' => $merek_item,
                        'tipe_item' => $tipe_item,
                        'id_kategori' => $id_kategori,
                        'id_subkategori' => $id_subkategori,
                        'created_at' => date("Y-m-d H:i:s")
                    );

                    $this->db->insert('mst_item', $data_insert);

                    //Update Template Upload
                    $this->Excel_model->create_template();

                    $data['info'] = 'Data Item Baru Berhasil Disimpan';
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

    public function item_upd()
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
        elseif ($this->Login_model->cekLogin('MST_ITE', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_item']))         ? $id_item =       $_POST['id_item']         : $id_item = "";
                (isset($_POST['nama_item']))         ? $nama_item =       $_POST['nama_item']         : $nama_item = "";
                (isset($_POST['merek_item']))         ? $merek_item =      $_POST['merek_item']         : $merek_item = "";
                (isset($_POST['tipe_item']))         ? $tipe_item =      $_POST['tipe_item']         : $tipe_item = "";
                (isset($_POST['id_kategori']))         ? $id_kategori =      $_POST['id_kategori']         : $id_kategori = "";
                (isset($_POST['id_subkategori']))         ? $id_subkategori =      $_POST['id_subkategori']         : $id_subkategori = "";

                $data['err_nama_item'] = "";
                $data['err_merek_item'] = "";
                $data['err_tipe_item'] = "";
                $data['err_kategori'] = "";
                $data['err_subkategori'] = "";

                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('nama_item', 'nama_item', 'trim|required', $pesanError);
                $this->form_validation->set_rules('merek_item', 'merek_item', 'trim|required', $pesanError);
                $this->form_validation->set_rules('tipe_item', 'tipe_item', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_subkategori', 'id_subkategori', 'trim|required', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_nama_item'] = form_error('nama_item', '<span>', '</span>');
                    $data['err_merek_item'] = form_error('merek_item', '<span>', '</span>');
                    $data['err_tipe_item'] = form_error('id_ruangan', '<span>', '</span>');
                    $data['err_kategori'] = form_error('id_kategori', '<span>', '</span>');
                    $data['err_subkategori'] = form_error('id_subkategori', '<span>', '</span>');

                    $err = true;
                    $data['status'] = 'nok';
                }

                //Cek jika id_item datanya ada di tabel
                $query = $this->db->query("select * from mst_item where id_item = $id_item");
                if ($query->num_rows() <> 1) {
                    $err = true;
                    $data['status'] = 'nok';
                    $data['info'] = 'ID Tidak Terdaftar';
                }

                //Jika ada error 
                if ($err) {
                    //
                }
                //Jika tidak ada error
                else {

                    //Update data
                    $data_insert = array(
                        'nama_item' => $nama_item,
                        'merek_item' => $merek_item,
                        'tipe_item' => $tipe_item,
                        'id_kategori' => $id_kategori,
                        'id_subkategori' => $id_subkategori,
                    );
                    $this->db->where('id_item', $id_item);
                    $this->db->update('mst_item', $data_insert);

                    //Update Template Upload
                    $this->Excel_model->create_template();

                    $data['info'] = 'Data Item Berhasil Diupdate';
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

    public function item_del()
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
        elseif ($this->Login_model->cekLogin('MST_ITE', 'delete')) {

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_item']))         ? $id_item =       $_POST['id_item']         : $id_item = "";

                if ($id_item == "") {
                    $data['status'] = 'nok';
                    $data['info'] = 'Tidak ada data yang dihapus';
                } else {
                    $this->db->where('id_item', $id_item);
                    $this->db->delete('mst_item');

                    //Update Template Upload
                    $this->Excel_model->create_template();

                    $data['info'] = 'Data Item Berhasil Dihapus';
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


    public function item_query()
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
        elseif ($this->Login_model->cekLogin('MST_ITE', 'view')) {
            (isset($_POST['tabel']))         ? $tabel =       $_POST['tabel']         : $tabel = "";

            if ($tabel == "subkategori") {
                (isset($_POST['id_kategori']))         ? $id_kategori =       $_POST['id_kategori']         : $id_kategori = "";
                $query = $this->db->query("select id_subkategori val,CONCAT_WS(' / ', kode_subkategori, uraian_subkategori) AS deskripsi from mst_subkategori where id_kategori = $id_kategori");
                $data["data"] = $query->result();
            }
        }
        //Jika bukan kembali ke base_url (home)
        else {
            $data['status'] = 'nok';
            $data['info'] = 'Anda Tidak Berhak';
        }

        echo json_encode($data);


        //END FUNCTION
    }

    public function gedung()
    {
        //Cek jika user Login / variabel "asm_st" ada di session
        //Kalau sudah login, variabel "asm_st" = "yes"
        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');
        if (empty($cek) || $cek <> "yes") {
            return $this->load->view('auth/v_login');
        }



        //Jika User = 99(IT) atau 1(admin)
        if ($this->Login_model->cekLogin('MST_GED', 'view')) {
            $data['link'] = 'master';
            $data['sublink'] = 'gedung';
            $data['subsublink'] = '';

            $data['title'] = 'Pekerjaan Rutin - ' . $this->config->item('app_name');

            //CSS untuk menampilkan tabel (datatables)
            $data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>';

            //JS untuk menampilkan tabel (datatables)
            $data['cust_js'] = '<script  src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>';

            $this->load->view('tabler/a_header', $data);
            $this->load->view('tabler/master/v_gedung', $data);
            $this->load->view('tabler/a_footer');
            $this->load->view('tabler/master/v_gedung_js', $data);
            $this->load->view('tabler/a_end_page');
        }
        //Jika bukan kembali ke base_url (home)
        else {
            redirect(base_url());
        }
        //END FUNCTION
    }

    public function gedung_data()
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
        elseif ($this->Login_model->cekLogin('MST_GED', 'view')) {
            $query = $this->db->query("select * from mst_gedung");
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

    public function gedung_new()
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
        elseif ($this->Login_model->cekLogin('MST_GED', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['nama_gedung']))         ? $nama_gedung =       $_POST['nama_gedung']         : $nama_gedung = "";
                (isset($_POST['keterangan']))         ? $keterangan =      $_POST['keterangan']         : $keterangan = "";


                $data['err_nama_gedung'] = "";
                $data['err_keterangan'] = "";


                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('nama_gedung', 'nama_gedung', 'trim|required', $pesanError);
                $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_nama_gedung'] = form_error('nama_gedung', '<span>', '</span>');
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

                    //Insert data
                    $data_insert = array(
                        'nama_gedung' => $nama_gedung,
                        'keterangan' => $keterangan,
                        'created_at' => date("Y-m-d H:i:s")
                    );

                    $this->db->insert('mst_gedung', $data_insert);

                    //Update Template Upload
                    $this->Excel_model->create_template();

                    $data['info'] = 'Data Gedung Baru Berhasil Disimpan';
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

    public function gedung_upd()
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
        elseif ($this->Login_model->cekLogin('MST_GED', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_gedung']))         ? $id_gedung =       $_POST['id_gedung']         : $id_gedung = "";
                (isset($_POST['nama_gedung']))         ? $nama_gedung =       $_POST['nama_gedung']         : $nama_gedung = "";
                (isset($_POST['keterangan']))         ? $keterangan =      $_POST['keterangan']         : $keterangan = "";

                $data['err_nama_gedung'] = "";
                $data['err_keterangan'] = "";

                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('nama_gedung', 'nama_gedung', 'trim|required', $pesanError);
                $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_nama_gedung'] = form_error('nama_gedung', '<span>', '</span>');
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

                    //Update data
                    $data_insert = array(
                        'nama_gedung' => $nama_gedung,
                        'keterangan' => $keterangan,
                    );
                    $this->db->where('id_gedung', $id_gedung);
                    $this->db->update('mst_gedung', $data_insert);

                    //Update Template Upload
                    $this->Excel_model->create_template();

                    $data['info'] = 'Data Gedung Berhasil Diupdate';
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

    public function gedung_del()
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
        elseif ($this->Login_model->cekLogin('MST_GED', 'delete')) {

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_gedung']))         ? $id_gedung =       $_POST['id_gedung']         : $id_gedung = "";

                if ($id_gedung == "") {
                    $data['status'] = 'nok';
                    $data['info'] = 'Tidak ada data yang dihapus';
                } else {
                    $this->db->where('id_gedung', $id_gedung);
                    $this->db->delete('mst_gedung');

                    //Update Template Upload
                    $this->Excel_model->create_template();

                    $data['info'] = 'Data Gedung Berhasil Dihapus';
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

    public function ruangan_item()
    {
        //Cek jika user Login / variabel "asm_st" ada di session
        //Kalau sudah login, variabel "asm_st" = "yes"
        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');
        if (empty($cek) || $cek <> "yes") {
            return $this->load->view('auth/v_login');
        }



        //Jika User = 99(IT) atau 1(admin)
        if ($this->Login_model->cekLogin('MST_RUA_ITE', 'view')) {
            $data['link'] = 'master';
            $data['sublink'] = 'ruangan_item';
            $data['subsublink'] = '';

            $data['title'] = 'Master Item - ' . $this->config->item('app_name');

            //CSS untuk menampilkan tabel (datatables)
            $data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>
                                <link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/select2/css/select2.min.css"/>
                                 <link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/select2/css/select2-bootstrap-5-theme.css"/>';

            //JS untuk menampilkan tabel (datatables)
            $data['cust_js'] = '<script src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>
                                <script src="' . base_url() . 'dist/libs/select2/js/select2.full.min.js"></script>';

            $query = $this->db->query('select id_item val,CONCAT_WS(\' / \', nama_item,merek_item,tipe_item) AS deskripsi from mst_item where status_item = 1');
            // $query = $this->db->query('select id_item val,nama_item AS deskripsi from mst_item where status_item = 1');
            $data['item'] = $query->result();

            $query = $this->db->query('select id_gedung val,nama_gedung AS deskripsi from mst_gedung');
            $data['gedung'] = $query->result();



            $this->load->view('tabler/a_header', $data);
            $this->load->view('tabler/master/v_ruangan_item', $data);
            $this->load->view('tabler/a_footer');
            $this->load->view('tabler/master/v_ruangan_item_js', $data);
            $this->load->view('tabler/a_end_page');
        }
        //Jika bukan kembali ke base_url (home)
        else {
            redirect(base_url());
        }
        //END FUNCTION
    }

    public function ruangan_item_data()
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
        elseif ($this->Login_model->cekLogin('MST_RUA_ITE', 'view')) {
            $query = $this->db->query("select * from view_ruangan_item order by id_ruangan_item desc");
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

    public function ruangan_item_new()
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
        elseif ($this->Login_model->cekLogin('MST_RUA_ITE', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_item']))         ? $id_item =       $_POST['id_item']         : $id_item = "";
                (isset($_POST['id_ruangan']))         ? $id_ruangan =      $_POST['id_ruangan']         : $id_ruangan = "";
                (isset($_POST['id_gedung']))         ? $id_gedung =      $_POST['id_gedung']         : $id_gedung = "";
                (isset($_POST['tahun_pengadaan']))     ? $tahun_pengadaan = $_POST['tahun_pengadaan']     : $tahun_pengadaan = "";

                $data['err_id_item'] = "";
                $data['err_id_ruangan'] = "";
                $data['err_id_gedung'] = "";
                $data['err_tahun_pengadaan'] = "";

                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('id_item', 'id_item', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_ruangan', 'id_ruangan', 'trim', $pesanError);
                $this->form_validation->set_rules('id_gedung', 'id_gedung', 'trim|required', $pesanError);
                $this->form_validation->set_rules('tahun_pengadaan', 'tahun_pengadaan', 'trim|required', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_id_item'] = form_error('nama_item', '<span>', '</span>');
                    $data['err_id_ruangan'] = form_error('id_ruangan', '<span>', '</span>');
                    $data['err_id_gedung'] = form_error('id_gedung', '<span>', '</span>');
                    $data['err_tahun_pengadaan'] = form_error('tahun_pengadaan', '<span>', '</span>');

                    $err = true;
                    $data['status'] = 'nok';
                }

                //Jika ada error 
                if ($err) {
                    //
                }
                //Jika tidak ada error
                else {

                    //Insert data
                    $data_insert = array(
                        'id_item' => $id_item,
                        'id_ruangan' => $id_ruangan,
                        'id_gedung' => $id_gedung,
                        'tahun_pengadaan' => $tahun_pengadaan,
                        'created_at' => date("Y-m-d H:i:s")
                    );

                    $this->db->insert('mst_ruangan_item', $data_insert);

                    //Update Template Upload
                    $this->Excel_model->create_template();


                    $data['info'] = 'Data Baru Berhasil Disimpan';
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

    public function ruangan_item_upd()
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
        elseif ($this->Login_model->cekLogin('MST_RUA_ITE', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_ruangan_item']))         ? $id_ruangan_item =       $_POST['id_ruangan_item']         : $id_ruangan_item = "";
                (isset($_POST['id_item']))         ? $id_item =       $_POST['id_item']         : $id_item = "";
                (isset($_POST['id_gedung']))         ? $id_gedung =      $_POST['id_gedung']         : $id_gedung = "";
                (isset($_POST['id_ruangan']))         ? $id_ruangan =      $_POST['id_ruangan']         : $id_ruangan = "";
                (isset($_POST['tahun_pengadaan']))     ? $tahun_pengadaan = $_POST['tahun_pengadaan']     : $tahun_pengadaan = "";

                $data['err_id_item'] = "";
                $data['err_id_ruangan'] = "";
                $data['err_id_gedung'] = "";
                $data['err_tahun_pengadaan'] = "";

                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('id_item', 'id_item', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_gedung', 'id_gedung', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_ruangan', 'id_ruangan', 'trim', $pesanError);
                $this->form_validation->set_rules('tahun_pengadaan', 'tahun_pengadaan', 'trim|required', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_id_item'] = form_error('id_item', '<span>', '</span>');
                    $data['err_id_ruangan'] = form_error('id_ruangan', '<span>', '</span>');
                    $data['err_id_gedung'] = form_error('err_id_gedung', '<span>', '</span>');
                    $data['err_tahun_pengadaan'] = form_error('tahun_pengadaan', '<span>', '</span>');

                    $err = true;
                    $data['status'] = 'nok';
                }


                //Jika ada error 
                if ($err) {
                    //
                }
                //Jika tidak ada error
                else {

                    //Update data
                    $data_insert = array(
                        'id_gedung' => $id_gedung,
                        'id_item' => $id_item,
                        'id_ruangan' => $id_ruangan,
                        'tahun_pengadaan' => $tahun_pengadaan
                    );
                    $this->db->where('id_ruangan_item', $id_ruangan_item);
                    $this->db->update('mst_ruangan_item', $data_insert);

                    //Update Template Upload
                    $this->Excel_model->create_template();


                    $data['info'] = 'Data Item Berhasil Diupdate';
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

    public function ruangan_item_del()
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
        elseif ($this->Login_model->cekLogin('MST_RUA_ITE', 'delete')) {

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_ruangan_item']))         ? $id_ruangan_item =       $_POST['id_ruangan_item']         : $id_ruangan_item = "";

                if ($id_ruangan_item == "") {
                    $data['status'] = 'nok';
                    $data['info'] = 'Tidak ada data yang dihapus';
                } else {
                    $this->db->where('id_ruangan_item', $id_ruangan_item);
                    $this->db->delete('mst_ruangan_item');

                    //Update Template Upload
                    $this->Excel_model->create_template();

                    $data['info'] = 'Data Item Berhasil Dihapus';
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

    public function ruangan_item_query()
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
        elseif ($this->Login_model->cekLogin('MST_RUA_ITE', 'view')) {
            (isset($_POST['tabel']))         ? $tabel =       $_POST['tabel']         : $tabel = "";

            if ($tabel == "ruangan") {
                (isset($_POST['id_gedung']))         ? $id_gedung =       $_POST['id_gedung']         : $id_gedung = "";
                $query = $this->db->query("select id_ruangan val,CONCAT_WS(' / ', kode_ruangan, uraian_ruangan) AS deskripsi from mst_ruangan where status_ruangan = 1 and id_gedung='$id_gedung'");
                $data["data"] = $query->result();
            }
        }
        //Jika bukan kembali ke base_url (home)
        else {
            $data['status'] = 'nok';
            $data['info'] = 'Anda Tidak Berhak';
        }

        echo json_encode($data);


        //END FUNCTION
    }

    public function ruangan()
    {
        //Cek jika user Login / variabel "asm_st" ada di session
        //Kalau sudah login, variabel "asm_st" = "yes"
        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');
        if (empty($cek) || $cek <> "yes") {
            return $this->load->view('auth/v_login');
        }

        //Jika User = 99(IT) atau 1(admin)
        if ($this->Login_model->cekLogin('MST_RUA', 'view')) {
            $data['link'] = 'master';
            $data['sublink'] = 'ruangan';
            $data['subsublink'] = '';

            $data['title'] = 'Master Ruangan - ' . $this->config->item('app_name');

            //CSS untuk menampilkan tabel (datatables)
            $data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>';

            //JS untuk menampilkan tabel (datatables)
            $data['cust_js'] = '<script src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>';

            $query = $this->db->query("select id_gedung val, nama_gedung deskripsi from mst_gedung");
            $data['gedung'] = $query->result();

            $this->load->view('tabler/a_header', $data);
            $this->load->view('tabler/master/v_ruangan', $data);
            $this->load->view('tabler/a_footer');
            $this->load->view('tabler/master/v_ruangan_js', $data);
            $this->load->view('tabler/a_end_page');
        }
        //Jika bukan kembali ke base_url (home)
        else {
            redirect(base_url());
        }
        //END FUNCTION
    }

    public function ruangan_data()
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
        elseif ($this->Login_model->cekLogin('MST_RUA', 'view')) {
            $query = $this->db->query("select * from view_ruangan where status_ruangan = 1 order by id_gedung,kode_ruangan");
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

    public function ruangan_new()
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
        elseif ($this->Login_model->cekLogin('MST_RUA', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_gedung']))         ? $id_gedung =    $_POST['id_gedung']       : $id_gedung = "";
                (isset($_POST['kode_ruangan']))         ? $kode_ruangan =    $_POST['kode_ruangan']       : $kode_ruangan = "";
                (isset($_POST['uraian_ruangan']))       ? $uraian_ruangan =  $_POST['uraian_ruangan']     : $uraian_ruangan = "";
                (isset($_POST['keterangan']))           ? $keterangan =      $_POST['keterangan']         : $keterangan = "";

                $data['err_gedung'] = "";
                $data['err_kode_ruangan'] = "";
                $data['err_uraian_ruangan'] = "";
                $data['err_keterangan'] = "";

                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('id_gedung', 'kode_ruangan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('kode_ruangan', 'kode_ruangan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('uraian_ruangan', 'uraian_ruangan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_gedung'] = form_error('id_gedung', '<span>', '</span>');
                    $data['err_kode_ruangan'] = form_error('kode_ruangan', '<span>', '</span>');
                    $data['err_uraian_ruangan'] = form_error('uraian_ruangan', '<span>', '</span>');
                    $data['err_keterangan'] = form_error('keterangan', '<span>', '</span>');

                    $err = true;
                    $data['status'] = 'nok';
                }

                //cek jika kode kembar
                $query = $this->db->query("select * from mst_ruangan where kode_ruangan = '$kode_ruangan'");
                if ($query->num_rows() >= 1) {
                    $err = true;
                    $data['err_kode_ruangan'] = 'Kode Ruangan Sudah Terdaftar';
                    $data['status'] = 'nok';
                }


                //Jika ada error 
                if ($err) {
                    //
                }
                //Jika tidak ada error
                else {

                    //Insert data
                    $data_insert = array(
                        'id_gedung' => $id_gedung,
                        'kode_ruangan' => $kode_ruangan,
                        'uraian_ruangan' => $uraian_ruangan,
                        'keterangan' => $keterangan,
                        'created_at' => date("Y-m-d H:i:s")
                    );

                    $this->db->insert('mst_ruangan', $data_insert);

                    //Update Template Upload
                    $this->Excel_model->create_template();

                    $data['info'] = 'Data Ruangan Baru Berhasil Disimpan';
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

    public function ruangan_upd()
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
        elseif ($this->Login_model->cekLogin('MST_RUA', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_gedung']))         ? $id_gedung =    $_POST['id_gedung']       : $id_gedung = "";
                (isset($_POST['id_ruangan']))         ? $id_ruangan =       $_POST['id_ruangan']         : $id_ruangan = "";
                (isset($_POST['kode_ruangan']))         ? $kode_ruangan =       $_POST['kode_ruangan']         : $kode_ruangan = "";
                (isset($_POST['uraian_ruangan']))         ? $uraian_ruangan =      $_POST['uraian_ruangan']         : $uraian_ruangan = "";
                (isset($_POST['keterangan']))         ? $keterangan =      $_POST['keterangan']         : $keterangan = "";

                $data['err_gedung'] = "";
                $data['err_kode_ruangan'] = "";
                $data['err_uraian_ruangan'] = "";
                $data['err_keterangan'] = "";

                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('id_gedung', 'id_gedung', 'trim|required', $pesanError);
                $this->form_validation->set_rules('kode_ruangan', 'kode_ruangan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('uraian_ruangan', 'uraian_ruangan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('keterangan', 'keterangan', 'trim', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_gedung'] = form_error('id_gedung', '<span>', '</span>');
                    $data['err_kode_ruangan'] = form_error('kode_ruangan', '<span>', '</span>');
                    $data['err_uraian_ruangan'] = form_error('uraian_ruangan', '<span>', '</span>');
                    $data['err_keterangan'] = form_error('keterangan', '<span>', '</span>');

                    $err = true;
                    $data['status'] = 'nok';
                }

                //Cek jika kode_ruangan sudah ada
                $query = $this->db->query("select * from mst_ruangan where id_ruangan <> $id_ruangan and kode_ruangan = '$kode_ruangan'");
                if ($query->num_rows() >= 1) {
                    $err = true;
                    $data['status'] = 'nok';
                    $data['err_kode_ruangan'] = 'Kode Ruangan Sudah Terdaftar';
                }

                //Jika ada error 
                if ($err) {
                    //
                }
                //Jika tidak ada error
                else {

                    //Update data
                    $data_insert = array(
                        'id_gedung' => $id_gedung,
                        'kode_ruangan' => $kode_ruangan,
                        'uraian_ruangan' => $uraian_ruangan,
                        'keterangan' => $keterangan,
                    );
                    $this->db->where('id_ruangan', $id_ruangan);
                    $this->db->update('mst_ruangan', $data_insert);

                    //Update Template Upload
                    $this->Excel_model->create_template();

                    $data['info'] = 'Data Ruangan Berhasil Diupdate';
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

    public function ruangan_del()
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
        elseif ($this->Login_model->cekLogin('MST_RUA', 'delete')) {

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_ruangan']))         ? $id_ruangan =       $_POST['id_ruangan']         : $id_ruangan = "";

                if ($id_ruangan == "") {
                    $data['status'] = 'nok';
                    $data['info'] = 'Tidak ada data yang dihapus';
                } else {
                    $this->db->where('id_ruangan', $id_ruangan);
                    $this->db->delete('mst_ruangan');

                    //Update Template Upload
                    $this->Excel_model->create_template();

                    $data['info'] = 'Data Ruangan Berhasil Dihapus';
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

    public function prutin()
    {
        //Cek jika user Login / variabel "asm_st" ada di session
        //Kalau sudah login, variabel "asm_st" = "yes"
        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');
        if (empty($cek) || $cek <> "yes") {
            return $this->load->view('auth/v_login');
        }
        //Jika User = 99(IT) atau 1(admin)
        if ($this->Login_model->cekLogin('MST_PEK', 'view')) {
            $data['link'] = 'master';
            $data['sublink'] = 'prutin';
            $data['subsublink'] = '';

            $data['title'] = 'Pekerjaan Rutin - ' . $this->config->item('app_name');

            //CSS untuk menampilkan tabel (datatables)
            $data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>';

            //JS untuk menampilkan tabel (datatables)
            $data['cust_js'] = '<script  src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>';

            $query = $this->db->query('select id_ruangan val,CONCAT_WS(\' / \', kode_ruangan, uraian_ruangan) AS deskripsi from mst_ruangan where status_ruangan = 1');
            $data['ruangan'] = $query->result();

            $query = $this->db->query("select id_kategori val, uraian_kategori deskripsi from mst_kategori");
            $data['kategori'] = $query->result();


            $this->load->view('tabler/a_header', $data);
            $this->load->view('tabler/master/v_prutin', $data);
            $this->load->view('tabler/a_footer');
            $this->load->view('tabler/master/v_prutin_js', $data);
            $this->load->view('tabler/a_end_page');
        }
        //Jika bukan kembali ke base_url (home)
        else {
            redirect(base_url());
        }
        //END FUNCTION
    }

    public function prutin_data()
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
        elseif ($this->Login_model->cekLogin('MST_PEK', 'view')) {
            $query = $this->db->query("select * from view_pkrutin");
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

    public function prutin_new()
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
        elseif ($this->Login_model->cekLogin('MST_PEK', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['jenis_pekerjaan']))         ? $jenis_pekerjaan =       $_POST['jenis_pekerjaan']         : $jenis_pekerjaan = "";
                (isset($_POST['uraian_pekerjaan']))         ? $uraian_pekerjaan =      $_POST['uraian_pekerjaan']         : $uraian_pekerjaan = "";
                (isset($_POST['id_kategori']))         ? $id_kategori =      $_POST['id_kategori']         : $id_kategori = "";
                (isset($_POST['id_subkategori']))         ? $id_subkategori =      $_POST['id_subkategori']         : $id_subkategori = "";
                (isset($_POST['interval_hari']))         ? $interval_hari =      $_POST['interval_hari']         : $interval_hari = "";
                (isset($_POST['pengali']))         ? $pengali =      $_POST['pengali']         : $pengali = "";


                $data['err_jenis_pekerjaan'] = "";
                $data['err_uraian_pekerjaan'] = "";
                $data['err_id_kategori'] = "";
                $data['err_id_subkategori'] = "";
                $data['err_interval'] = "";


                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('jenis_pekerjaan', 'jenis_pekerjaan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('uraian_pekerjaan', 'uraian_pekerjaan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_subkategori', 'id_subkategori', 'trim|required', $pesanError);
                $this->form_validation->set_rules('interval_hari', 'interval_hari', 'trim|required', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_jenis_pekerjaan'] = form_error('jenis_pekerjaan', '<span>', '</span>');
                    $data['err_uraian_pekerjaan'] = form_error('uraian_pekerjaan', '<span>', '</span>');
                    $data['err_id_kategori'] = form_error('id_kategori', '<span>', '</span>');
                    $data['err_id_subkategori'] = form_error('id_subkategori', '<span>', '</span>');
                    $data['err_interval'] = form_error('interval_hari', '<span>', '</span>');

                    $err = true;
                    $data['status'] = 'nok';
                }

                //Jika ada error 
                if ($err) {
                    //
                }
                //Jika tidak ada error
                else {

                    //Insert data
                    $data_insert = array(
                        'jenis_pekerjaan' => $jenis_pekerjaan,
                        'uraian_pekerjaan' => $uraian_pekerjaan,
                        'id_kategori' => $id_kategori,
                        'id_subkategori' => $id_subkategori,
                        'interval_hari' => $interval_hari,
                        'pengali' => $pengali,
                        'created_at' => date("Y-m-d H:i:s")
                    );

                    $this->db->insert('mst_pkrutin', $data_insert);

                    //Update Template Upload
                    $this->Excel_model->create_template();


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

    public function prutin_upd()
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
        elseif ($this->Login_model->cekLogin('MST_PEK', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_pkrutin']))         ? $id_pkrutin =       $_POST['id_pkrutin']         : $id_pkrutin = "";
                (isset($_POST['jenis_pekerjaan']))         ? $jenis_pekerjaan =       $_POST['jenis_pekerjaan']         : $jenis_pekerjaan = "";
                (isset($_POST['uraian_pekerjaan']))         ? $uraian_pekerjaan =      $_POST['uraian_pekerjaan']         : $uraian_pekerjaan = "";
                (isset($_POST['id_kategori']))         ? $id_kategori =      $_POST['id_kategori']         : $id_kategori = "";
                (isset($_POST['id_subkategori']))         ? $id_subkategori =      $_POST['id_subkategori']         : $id_subkategori = "";
                (isset($_POST['interval_hari']))         ? $interval_hari =      $_POST['interval_hari']         : $interval_hari = "";
                (isset($_POST['pengali']))         ? $pengali =      $_POST['pengali']         : $pengali = "";

                $data['err_jenis_pekerjaan'] = "";
                $data['err_uraian_pekerjaan'] = "";
                $data['err_id_kategori'] = "";
                $data['err_id_subkategori'] = "";
                $data['err_interval'] = "";

                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('jenis_pekerjaan', 'jenis_pekerjaan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('uraian_pekerjaan', 'uraian_pekerjaan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim|required', $pesanError);
                $this->form_validation->set_rules('id_subkategori', 'id_subkategori', 'trim|required', $pesanError);
                $this->form_validation->set_rules('interval_hari', 'interval_hari', 'trim|required', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_jenis_pekerjaan'] = form_error('jenis_pekerjaan', '<span>', '</span>');
                    $data['err_uraian_pekerjaan'] = form_error('uraian_pekerjaan', '<span>', '</span>');
                    $data['err_id_kategori'] = form_error('id_kategori', '<span>', '</span>');
                    $data['err_id_subkategori'] = form_error('id_subkategori', '<span>', '</span>');
                    $data['err_interval'] = form_error('interval_hari', '<span>', '</span>');

                    $err = true;
                    $data['status'] = 'nok';
                }

                //Jika ada error 
                if ($err) {
                    //
                }
                //Jika tidak ada error
                else {

                    //Update data
                    $data_insert = array(
                        'jenis_pekerjaan' => $jenis_pekerjaan,
                        'uraian_pekerjaan' => $uraian_pekerjaan,
                        'id_kategori' => $id_kategori,
                        'id_subkategori' => $id_subkategori,
                        'interval_hari' => $interval_hari,
                        'pengali' => $pengali,
                    );
                    $this->db->where('id_pkrutin', $id_pkrutin);
                    $this->db->update('mst_pkrutin', $data_insert);

                    //Update Template Upload
                    $this->Excel_model->create_template();


                    $data['info'] = 'Data Item Berhasil Diupdate';
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

    public function prutin_del()
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
        elseif ($this->Login_model->cekLogin('MST_PEK', 'delete')) {

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_pkrutin']))         ? $id_pkrutin =       $_POST['id_pkrutin']         : $id_pkrutin = "";

                if ($id_pkrutin == "") {
                    $data['status'] = 'nok';
                    $data['info'] = 'Tidak ada data yang dihapus';
                } else {
                    $this->db->where('id_pkrutin', $id_pkrutin);
                    $this->db->delete('mst_pkrutin');

                    //Update Template Upload
                    $this->Excel_model->create_template();

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

    public function prutin_query()
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
        elseif ($this->Login_model->cekLogin('MST_PEK', 'view')) {
            (isset($_POST['tabel']))         ? $tabel =       $_POST['tabel']         : $tabel = "";

            if ($tabel == "subkategori") {
                (isset($_POST['id_kategori']))         ? $id_kategori =       $_POST['id_kategori']         : $id_kategori = "";
                $query = $this->db->query("select id_subkategori val,CONCAT_WS(' / ', kode_subkategori, uraian_subkategori) AS deskripsi from mst_subkategori where id_kategori = $id_kategori");
                $data["data"] = $query->result();
            }
        }
        //Jika bukan kembali ke base_url (home)
        else {
            $data['status'] = 'nok';
            $data['info'] = 'Anda Tidak Berhak';
        }

        echo json_encode($data);


        //END FUNCTION
    }

    public function kategori()
    {
        //Cek jika user Login / variabel "asm_st" ada di session
        //Kalau sudah login, variabel "asm_st" = "yes"
        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');
        if (empty($cek) || $cek <> "yes") {
            return $this->load->view('auth/v_login');
        }



        //Jika User = 99(IT) atau 1(admin)
        if ($this->Login_model->cekLogin('MST_KAT', 'view')) {
            $data['link'] = 'master';
            $data['sublink'] = 'kategori';
            $data['subsublink'] = '';

            $data['title'] = 'Kategori - ' . $this->config->item('app_name');

            //CSS untuk menampilkan tabel (datatables)
            $data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>';

            //JS untuk menampilkan tabel (datatables)
            $data['cust_js'] = '<script  src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>';

            $this->load->view('tabler/a_header', $data);
            $this->load->view('tabler/master/v_kategori', $data);
            $this->load->view('tabler/a_footer');
            $this->load->view('tabler/master/v_kategori_js', $data);
            $this->load->view('tabler/a_end_page');
        }
        //Jika bukan kembali ke base_url (home)
        else {
            redirect(base_url());
        }
        //END FUNCTION
    }

    public function kategori_data()
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
        elseif ($this->Login_model->cekLogin('MST_KAT', 'view')) {
            $query = $this->db->query("select * from mst_kategori");
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

    public function kategori_new()
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
        elseif ($this->Login_model->cekLogin('MST_KAT', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['kode_kategori']))         ? $kode_kategori =       $_POST['kode_kategori']         : $kode_kategori = "";
                (isset($_POST['uraian_kategori']))         ? $uraian_kategori =      $_POST['uraian_kategori']         : $uraian_kategori = "";


                $data['err_kode_kategori'] = "";
                $data['err_uraian_kategori'] = "";


                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('kode_kategori', 'kode_kategori', 'trim|required', $pesanError);
                $this->form_validation->set_rules('uraian_kategori', 'uraian_kategori', 'trim', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_kode_kategori'] = form_error('kode_kategori', '<span>', '</span>');
                    $data['err_uraian_kategori'] = form_error('uraian_kategori', '<span>', '</span>');

                    $err = true;
                    $data['status'] = 'nok';
                }

                //Jika ada error 
                if ($err) {
                    //
                }
                //Jika tidak ada error
                else {

                    //Insert data
                    $data_insert = array(
                        'kode_kategori' => $kode_kategori,
                        'uraian_kategori' => $uraian_kategori,
                    );

                    $this->db->insert('mst_kategori', $data_insert);

                    //Update Template Upload
                    $this->Excel_model->create_template();


                    $data['info'] = 'Data Kategori Berhasil Disimpan';
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

    public function kategori_upd()
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
        elseif ($this->Login_model->cekLogin('MST_KAT', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_kategori']))         ? $id_kategori =       $_POST['id_kategori']         : $id_kategori = "";
                (isset($_POST['kode_kategori']))         ? $kode_kategori =       $_POST['kode_kategori']         : $kode_kategori = "";
                (isset($_POST['uraian_kategori']))         ? $uraian_kategori =      $_POST['uraian_kategori']         : $uraian_kategori = "";

                $data['err_kode_kategori'] = "";
                $data['err_uraian_kategori'] = "";

                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('kode_kategori', 'kode_kategori', 'trim|required', $pesanError);
                $this->form_validation->set_rules('uraian_kategori', 'uraian_kategori', 'trim', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_kode_kategori'] = form_error('kode_kategori', '<span>', '</span>');
                    $data['err_uraian_kategori'] = form_error('uraian_kategori', '<span>', '</span>');

                    $err = true;
                    $data['status'] = 'nok';
                }

                //Jika ada error 
                if ($err) {
                    //
                }
                //Jika tidak ada error
                else {

                    //Update data
                    $data_insert = array(
                        'kode_kategori' => $kode_kategori,
                        'uraian_kategori' => $uraian_kategori,
                    );
                    $this->db->where('id_kategori', $id_kategori);
                    $this->db->update('mst_kategori', $data_insert);

                    //Update Template Upload
                    $this->Excel_model->create_template();

                    $data['info'] = 'Data Kategori Berhasil Diupdate';
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

    public function kategori_del()
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
        elseif ($this->Login_model->cekLogin('MST_KAT', 'delete')) {

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_kategori']))         ? $id_kategori =       $_POST['id_kategori']         : $id_kategori = "";

                if ($id_kategori == "") {
                    $data['status'] = 'nok';
                    $data['info'] = 'Tidak ada data yang dihapus';
                } else {
                    $this->db->where('id_kategori', $id_kategori);
                    $this->db->delete('mst_kategori');

                    //Update Template Upload
                    $this->Excel_model->create_template();

                    $data['info'] = 'Data Kategori Berhasil Dihapus';
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


    public function subkategori()
    {
        //Cek jika user Login / variabel "asm_st" ada di session
        //Kalau sudah login, variabel "asm_st" = "yes"
        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');
        if (empty($cek) || $cek <> "yes") {
            return $this->load->view('auth/v_login');
        }



        //Jika User = 99(IT) atau 1(admin)
        if ($this->Login_model->cekLogin('MST_KAT', 'view')) {
            $data['link'] = 'master';
            $data['sublink'] = 'subkategori';
            $data['subsublink'] = '';

            $data['title'] = 'Subkategori - ' . $this->config->item('app_name');

            //CSS untuk menampilkan tabel (datatables)
            $data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>';

            //JS untuk menampilkan tabel (datatables)
            $data['cust_js'] = '<script  src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>';

            $query = $this->db->query("select id_kategori val, uraian_kategori deskripsi from mst_kategori");
            $data['kategori'] = $query->result();

            $this->load->view('tabler/a_header', $data);
            $this->load->view('tabler/master/v_subkategori', $data);
            $this->load->view('tabler/a_footer');
            $this->load->view('tabler/master/v_subkategori_js', $data);
            $this->load->view('tabler/a_end_page');
        }
        //Jika bukan kembali ke base_url (home)
        else {
            redirect(base_url());
        }
        //END FUNCTION
    }

    public function subkategori_data()
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
        elseif ($this->Login_model->cekLogin('MST_SUBKAT', 'view')) {
            $query = $this->db->query("select * from view_subkategori");
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

    public function subkategori_new()
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
        elseif ($this->Login_model->cekLogin('MST_SUBKAT', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_kategori']))         ? $id_kategori =       $_POST['id_kategori']         : $id_kategori = "";
                (isset($_POST['kode_subkategori']))         ? $kode_subkategori =       $_POST['kode_subkategori']         : $kode_subkategori = "";
                (isset($_POST['uraian_subkategori']))         ? $uraian_subkategori =      $_POST['uraian_subkategori']         : $uraian_subkategori = "";


                $data['err_kode_subkategori'] = "";
                $data['err_uraian_subkategori'] = "";


                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim|required', $pesanError);
                $this->form_validation->set_rules('kode_subkategori', 'kode_subkategori', 'trim|required', $pesanError);
                $this->form_validation->set_rules('uraian_subkategori', 'uraian_subkategori', 'trim', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {
                    $data['err_id_kategori'] = form_error('id_kategori', '<span>', '</span>');
                    $data['err_kode_subkategori'] = form_error('kode_subkategori', '<span>', '</span>');
                    $data['err_uraian_subkategori'] = form_error('uraian_subkategori', '<span>', '</span>');

                    $err = true;
                    $data['status'] = 'nok';
                }

                //Jika ada error 
                if ($err) {
                    //
                }
                //Jika tidak ada error
                else {

                    //Insert data
                    $data_insert = array(
                        'id_kategori' => $id_kategori,
                        'kode_subkategori' => $kode_subkategori,
                        'uraian_subkategori' => $uraian_subkategori,
                    );

                    $this->db->insert('mst_subkategori', $data_insert);

                    //Update Template Upload
                    $this->Excel_model->create_template();


                    $data['info'] = 'Data Subkategori Berhasil Disimpan';
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

    public function subkategori_upd()
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
        elseif ($this->Login_model->cekLogin('MST_SUBKAT', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_kategori']))         ? $id_kategori =       $_POST['id_kategori']         : $id_kategori = "";
                (isset($_POST['id_subkategori']))         ? $id_subkategori =       $_POST['id_subkategori']         : $id_subkategori = "";
                (isset($_POST['kode_subkategori']))         ? $kode_subkategori =       $_POST['kode_subkategori']         : $kode_subkategori = "";
                (isset($_POST['uraian_subkategori']))         ? $uraian_subkategori =      $_POST['uraian_subkategori']         : $uraian_subkategori = "";

                (isset($_POST['detail_item']))         ? $detail_item =      $_POST['detail_item']         : $detail_item = "";


                $pk = $arus_r = $arus_s = $arus_t = $teg_r = $teg_s = $teg_t = $teg_v = $psi = $oli = $solar = $radiator = $eng_hours = $accu = $temp =
                    $kap = $noice = $qty = $vol = $tgl_kadaluarsa = $kondisi = $tindakan = 0;


                $data['err_kode_subkategori'] = "";
                $data['err_uraian_subkategori'] = "";

                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('kode_subkategori', 'kode_subkategori', 'trim|required', $pesanError);
                $this->form_validation->set_rules('uraian_subkategori', 'uraian_subkategori', 'trim', $pesanError);

                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_kode_subkategori'] = form_error('kode_subkategori', '<span>', '</span>');
                    $data['err_uraian_subkategori'] = form_error('uraian_subkategori', '<span>', '</span>');

                    $err = true;
                    $data['status'] = 'nok';
                }

                //Jika ada error 
                if ($err) {
                    //
                }
                //Jika tidak ada error
                else {

                    //Update data

                    if ($detail_item <> "") {
                        foreach ($detail_item as $vw) {
                            if ($vw == 'pk') $pk = 1;
                            if ($vw == 'arus_r') $arus_r = 1;
                            if ($vw == 'arus_s') $arus_s = 1;
                            if ($vw == 'arus_t') $arus_t = 1;
                            if ($vw == 'teg_r') $teg_r = 1;
                            if ($vw == 'teg_s') $teg_s = 1;
                            if ($vw == 'teg_t') $teg_t = 1;
                            if ($vw == 'teg_v') $teg_v = 1;
                            if ($vw == 'psi') $psi = 1;
                            if ($vw == 'oli') $oli = 1;
                            if ($vw == 'solar') $solar = 1;
                            if ($vw == 'radiator') $radiator = 1;
                            if ($vw == 'eng_hours') $eng_hours = 1;
                            if ($vw == 'accu') $accu = 1;
                            if ($vw == 'temp') $temp = 1;
                            if ($vw == 'kap') $kap = 1;
                            if ($vw == 'noice') $noice = 1;
                            if ($vw == 'qty') $qty = 1;
                            if ($vw == 'vol') $vol = 1;
                            if ($vw == 'tgl_kadaluarsa') $tgl_kadaluarsa = 1;
                            if ($vw == 'kondisi') $kondisi = 1;
                            if ($vw == 'tindakan') $tindakan = 1;
                        }
                    }

                    $data_insert = array(
                        'id_kategori' => $id_kategori,
                        'kode_subkategori' => $kode_subkategori,
                        'uraian_subkategori' => $uraian_subkategori,

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
                    $this->db->where('id_subkategori', $id_subkategori);
                    $this->db->update('mst_subkategori', $data_insert);

                    //Update Template Upload
                    $this->Excel_model->create_template();

                    $data['info'] = 'Data Subkategori Berhasil Diupdate';
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

    public function subkategori_del()
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
        elseif ($this->Login_model->cekLogin('MST_SUBKAT', 'delete')) {

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_subkategori']))         ? $id_subkategori =       $_POST['id_subkategori']         : $id_subkategori = "";

                if ($id_subkategori == "") {
                    $data['status'] = 'nok';
                    $data['info'] = 'Tidak ada data yang dihapus';
                } else {
                    $this->db->where('id_subkategori', $id_subkategori);
                    $this->db->delete('mst_subkategori');

                    //Update Template Upload
                    $this->Excel_model->create_template();

                    $data['info'] = 'Data Subkategori Berhasil Dihapus';
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
