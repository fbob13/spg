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
            $data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>';


            //JS untuk menampilkan tabel (datatables)
            //$data['cust_js'] = '<script type="text/javascript" src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>';
            $data['cust_js'] = '<script src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>
                                <script src="' . base_url() . 'dist/libs/litepicker/dist/litepicker.js"></script>';

            $query = $this->db->query("select id_user val ,nama deskripsi from mst_user where spc = 0");
            $data['teknisi'] = $query->result();

            $query = $this->db->query('select id_gedung val,nama_gedung AS deskripsi from mst_gedung');
            $data['gedung'] = $query->result();

            $query = $this->db->query("select id_pkrutin val,jenis_pekerjaan deskripsi from mst_pkrutin");
            $data['pkrutin'] = $query->result();


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
                    $query = $this->db->query("select id_ruangan val,CONCAT_WS(' - ', kode_ruangan, uraian_ruangan) AS deskripsi 
                                from mst_ruangan where status_ruangan = 1 and id_gedung=$id_gedung");
                } else if ($tipe == "item") {
                    (isset($_POST['id_gedung']))         ? $id_gedung =       $_POST['id_gedung']         : $id_gedung = "";
                    (isset($_POST['id_ruangan']))         ? $id_ruangan =       $_POST['id_ruangan']         : $id_ruangan = "";
                    $query = $this->db->query("select id_item val,CONCAT_WS(' - ', nama_item,merek_item, tipe_item) AS deskripsi 
                                from view_ruangan_item where id_gedung=$id_gedung and id_ruangan = $id_ruangan");
                } else if ($tipe == "pkrutin") {
                    (isset($_POST['id_item']))         ? $id_item =       $_POST['id_item']         : $id_item = "";
                    //Ambil data kategori dari id_item
                    $query = $this->db->query("select * from mst_item where id_item = $id_item");
                    $qitem = $query->first_row();
                    $kategori = $qitem->id_kategori;
                    //Ambil data pkrutin berdasarkan id_kategori
                    $query = $this->db->query("select id_pkrutin val, CONCAT_WS(' - ' , jenis_pekerjaan, uraian_pekerjaan) as deskripsi 
                                from mst_pkrutin where id_kategori =$kategori");
                } else if ($tipe == "draft") {

                    (isset($_POST['tanggal_jadwal']))   ? $tanggal_jadwal = $_POST['tanggal_jadwal']    : $tanggal_jadwal = "";
                    (isset($_POST['id_user']))          ? $id_user        = $_POST['id_user']           : $id_user = "";
                    //Ambil data kategori dari id_item
                    $query = $this->db->query("select * from view_rutin where id_user = $id_user and tanggal_jadwal='$tanggal_jadwal'");
                } else if ($tipe == "delete_list") {

                    (isset($_POST['id_rutin']))         ? $id_rutin =       $_POST['id_rutin']         : $id_rutin = "";
                    //Ambil data kategori dari id_item
                    $this->db->where('id_rutin', $id_rutin);
                    $this->db->delete('as_rutin');
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
            $data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>';

            //JS untuk menampilkan tabel (datatables)
            $data['cust_js'] = '<script  src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>';

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
                array( 'db' => 'id_rutin', 'dt' => 'id_rutin' ),
                array( 'db' => 'id_user',  'dt' => 'id_user' ),
                array( 'db' => 'nama_teknisi',   'dt' => 'nama_teknisi' ),
                array( 'db' => 'tanggal_jadwal',   'dt' => 'tanggal_jadwal' ),
                array( 'db' => 'nama_gedung',   'dt' => 'nama_gedung' ),
                array( 'db' => 'nama_ruangan',   'dt' => 'nama_ruangan' ),
                array( 'db' => 'nama_item',   'dt' => 'nama_item' ),
                array( 'db' => 'jenis_pekerjaan',   'dt' => 'jenis_pekerjaan' ),
                array( 'db' => 'status_pekerjaan_text',   'dt' => 'status_pekerjaan_text' ),
                array( 'db' => 'status_pekerjaan',   'dt' => 'status_pekerjaan' ),
                array( 'db' => 'keterangan',   'dt' => 'keterangan' )
            );

            $sql_details = array(
                'user' => 'root',
                'pass' => '',
                'db'   => 'aslam',
                'host' => 'localhost'
            );

            (isset($_POST['status_pekerjaan']))         ? $status_pekerjaan =       $_POST['status_pekerjaan']         : $status_pekerjaan = "";
            (isset($_POST['bulan']))         ? $bulan =       $_POST['bulan']         : $bulan = date('m');
            (isset($_POST['tahun']))         ? $tahun =       $_POST['tahun']         : $tahun = date('Y');


            //$where  = "id_user='2' and status_pekerjaan = 3";
            $where="";

            if($bulan == 99){
                $where = "DATE_FORMAT(tanggal_jadwal,'%Y') = '$tahun'";
            }else{
                $where = "DATE_FORMAT(tanggal_jadwal,'%Y-%m') = '$tahun-$bulan'";
            }
            
            if($status_pekerjaan <> "" && $status_pekerjaan <>99){
                $where = $where . " and status_pekerjaan = $status_pekerjaan";
            }
            
            echo json_encode(
                //SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns );
                //$this->ssp->simple($_GET, $sql_details, $table, $primaryKey, $columns );
                $this->ssp->complex($_REQUEST, $sql_details, $table, $primaryKey, $columns,'',$where )
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

                    //Update data
                    $data_insert = array(
                        'status_pekerjaan' => $status_pekerjaan,
                        'keterangan' => $keterangan,
                        'tanggal_realisasi' => $tanggal_realisasi,
                        'id_user' => $id_user
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
