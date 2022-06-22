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
        if ($spc == 99 || $spc == 1) {
            $data['link'] = 'nrutin';
            $data['sublink'] = 'kerusakan';
            $data['subsublink'] = '';

            $data['title'] = 'Input Kerusakan - ' . $this->config->item('app_name');

            //CSS untuk menampilkan tabel (datatables)
            $data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>';


            //JS untuk menampilkan tabel (datatables)
            //$data['cust_js'] = '<script type="text/javascript" src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>';
            $data['cust_js'] = '<script type="text/javascript" src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>
                                <script src="' . base_url() . 'dist/libs/litepicker/dist/litepicker.js"></script>';

            $query = $this->db->query("select id_user val ,nama deskripsi from mst_user where spc = 0");
            $data['teknisi'] = $query->result();

            $query = $this->db->query('select id_gedung val,nama_gedung AS deskripsi from mst_gedung');
            $data['gedung'] = $query->result();

            $query = $this->db->query("select id_pkrutin val,jenis_pekerjaan deskripsi from mst_pkrutin");
            $data['pkrutin'] = $query->result();


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
        elseif ($spc == 99 || $spc == 1) {

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
                    $data['err_keluhan'] = form_error('prioritas', '<span>', '</span>');

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
        if ($spc == 99 || $spc == 1) {
            $data['link'] = 'nrutin';
            $data['sublink'] = 'update_kerusakan';
            $data['subsublink'] = '';

            $data['title'] = 'Update Kerusakan - ' . $this->config->item('app_name');

            //CSS untuk menampilkan tabel (datatables)
            $data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>';

            //JS untuk menampilkan tabel (datatables)
            $data['cust_js'] = '<script type="text/javascript" src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>';

            $query = $this->db->query('select id_user val,nama deskripsi from mst_user where spc in (1,2)');
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
        elseif ($spc == 99 || $spc == 1) {
            $query = $this->db->query("select * from view_nonrutin");
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
        elseif ($spc == 99 || $spc == 1) {

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
                $this->form_validation->set_rules('keterangan', 'keterangan', 'trim', $pesanError);

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

                    //Update data
                    $data_insert = array(
                        'id_teknisi' => $id_teknisi,
                        'status_pekerjaan' => $status_pekerjaan,
                        'keterangan' => $keterangan,
                        'prioritas' => $prioritas
                    );
                    $this->db->where('id_nonrutin', $id_nonrutin);
                    $this->db->update('as_nonrutin', $data_insert);

                    $data['info'] = 'Data Berhasil Diupdate';
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
        elseif ($spc == 99 || $spc == 1) {

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
