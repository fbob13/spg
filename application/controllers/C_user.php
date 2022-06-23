<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_user extends CI_Controller
{

    public function user_view()
    {
        //Cek jika user Login / variabel "asm_st" ada di session
        //Kalau sudah login, variabel "asm_st" = "yes"
        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');
        if (empty($cek) || $cek <> "yes") {
            return $this->load->view('auth/v_login');
        }
        //Jika User = 99(IT) atau 1(admin)

        if ($this->Login_model->cekLogin('ADM_USER', 'view')) {
            $data['link'] = 'admin';
            $data['sublink'] = 'user';
            $data['subsublink'] = '';

            $data['title'] = 'User aplikasi - ' . $this->config->item('app_name');

            //CSS untuk menampilkan tabel (datatables)
            $data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>';

            //JS untuk menampilkan tabel (datatables)
            $data['cust_js'] = '<script type="text/javascript" src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>';


            $this->load->view('tabler/a_header', $data);
            $this->load->view('tabler/admin/v_user', $data);
            $this->load->view('tabler/a_footer');
            $this->load->view('tabler/admin/v_user_js', $data);
            $this->load->view('tabler/a_end_page');
        }
        //Jika bukan kembali ke base_url (home)
        else {
            redirect(base_url());
        }
        //END FUNCTION
    }

    public function user_data()
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
        elseif ($this->Login_model->cekLogin('ADM_USER', 'view')) {
            $query = $this->db->query("select * from view_user");
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

    public function user_new()
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
        elseif ($this->Login_model->cekLogin('ADM_USER', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['username']))     ? $username =   $_POST['username']    : $username = "";
                (isset($_POST['nama']))         ? $nama =       $_POST['nama']        : $nama = "";
                (isset($_POST['nip']))          ? $nip =        $_POST['nip']         : $nip = "";
                (isset($_POST['jabatan']))      ? $jabatan =    $_POST['jabatan']     : $jabatan = "";
                (isset($_POST['j_kelamin']))    ? $j_kelamin =  $_POST['j_kelamin']   : $j_kelamin = "";
                (isset($_POST['alamat']))       ? $alamat =     $_POST['alamat']      : $alamat = "";
                (isset($_POST['telepon']))      ? $telepon =    $_POST['telepon']     : $telepon = "";
                (isset($_POST['email']))        ? $email =      $_POST['email']       : $email = "";
                (isset($_POST['spc']))          ? $spc =        $_POST['spc']         : $spc = "";


                $data['err_username'] = "";
                $data['err_nama'] = "";
                $data['err_nip'] = "";
                $data['err_jabatan'] = "";
                $data['err_j_kelamin'] = "";
                $data['err_alamat'] = "";
                $data['err_telepon'] = "";
                $data['err_email'] = "";
                $data['err_spc'] = "";

                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                $this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[mst_user.username]|min_length[6]', $pesanError);
                $this->form_validation->set_rules('nama', 'nama', 'trim|required', $pesanError);
                $this->form_validation->set_rules('nip', 'nip', 'trim|required', $pesanError);
                $this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('j_kelamin', 'j_kelamin', 'trim|required', $pesanError);
                $this->form_validation->set_rules('alamat', 'alamat', 'trim', $pesanError);
                $this->form_validation->set_rules('telepon', 'telepon', 'trim', $pesanError);
                $this->form_validation->set_rules('email', 'email', 'trim|valid_email', $pesanError);
                $this->form_validation->set_rules('spc', 'spc', 'trim|required', $pesanError);


                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    $data['err_username'] = form_error('username', '<span>', '</span>');
                    $data['err_nama'] = form_error('nama', '<span>', '</span>');
                    $data['err_nip'] = form_error('nip', '<span>', '</span>');
                    $data['err_jabatan'] = form_error('jabatan', '<span>', '</span>');
                    $data['err_j_kelamin'] = form_error('j_kelamin', '<span>', '</span>');
                    $data['err_alamat'] = form_error('alamat', '<span>', '</span>');
                    $data['err_telepon'] = form_error('telepon', '<span>', '</span>');
                    $data['err_email'] = form_error('email', '<span>', '</span>');
                    $data['err_spc'] = form_error('spc', '<span>', '</span>');


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
                        'username' => $username,
                        'nama' => $nama,
                        'nip' => $nip,
                        'jabatan' => $jabatan,
                        'j_kelamin' => $j_kelamin,
                        'alamat' => $alamat,
                        'telepon' => $telepon,
                        'email' => $email,
                        'spc' => $spc,
                        'password' => 'e10adc3949ba59abbe56e057f20f883e',
                        'created_at' => date("Y-m-d H:i:s")
                    );

                    $this->db->insert('mst_user', $data_insert);

                    $data['info'] = 'Data User Berhasil Disimpan';
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

    public function user_upd()
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
        elseif ($this->Login_model->cekLogin('ADM_USER', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_user']))      ? $id_user =    $_POST['id_user']     : $id_user = "";
                //(isset($_POST['username']))     ? $username =   $_POST['username']    : $username = "";
                (isset($_POST['nama']))         ? $nama =       $_POST['nama']        : $nama = "";
                (isset($_POST['nip']))          ? $nip =        $_POST['nip']         : $nip = "";
                (isset($_POST['jabatan']))      ? $jabatan =    $_POST['jabatan']     : $jabatan = "";
                (isset($_POST['j_kelamin']))    ? $j_kelamin =  $_POST['j_kelamin']   : $j_kelamin = "";
                (isset($_POST['alamat']))       ? $alamat =     $_POST['alamat']      : $alamat = "";
                (isset($_POST['telepon']))      ? $telepon =    $_POST['telepon']     : $telepon = "";
                (isset($_POST['email']))        ? $email =      $_POST['email']       : $email = "";
                (isset($_POST['spc']))          ? $spc =        $_POST['spc']         : $spc = "";


                //$data['err_username'] = "";
                $data['err_nama'] = "";
                $data['err_nip'] = "";
                $data['err_jabatan'] = "";
                $data['err_j_kelamin'] = "";
                $data['err_alamat'] = "";
                $data['err_telepon'] = "";
                $data['err_email'] = "";
                $data['err_spc'] = "";

                $pesanError = array(
                    'required' => "Harus di isi",
                );

                //Rules untuk inputan form (referensi "Libraries/Form Validation" codeigniter 3)
                //$this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[mst_user.username]|min_length[6]', $pesanError);
                $this->form_validation->set_rules('nama', 'nama', 'trim|required', $pesanError);
                $this->form_validation->set_rules('nip', 'nip', 'trim|required', $pesanError);
                $this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required', $pesanError);
                $this->form_validation->set_rules('j_kelamin', 'j_kelamin', 'trim|required', $pesanError);
                $this->form_validation->set_rules('alamat', 'alamat', 'trim', $pesanError);
                $this->form_validation->set_rules('telepon', 'telepon', 'trim', $pesanError);
                $this->form_validation->set_rules('email', 'email', 'trim|valid_email', $pesanError);
                $this->form_validation->set_rules('spc', 'spc', 'trim|required', $pesanError);


                //cek Jika ada isian form yang tidak sesuai maka akan muncul pesan error
                if ($this->form_validation->run() == FALSE) {

                    //$data['err_username'] = form_error('username', '<span>', '</span>');
                    $data['err_nama'] = form_error('nama', '<span>', '</span>');
                    $data['err_nip'] = form_error('nip', '<span>', '</span>');
                    $data['err_jabatan'] = form_error('jabatan', '<span>', '</span>');
                    $data['err_j_kelamin'] = form_error('j_kelamin', '<span>', '</span>');
                    $data['err_alamat'] = form_error('alamat', '<span>', '</span>');
                    $data['err_telepon'] = form_error('telepon', '<span>', '</span>');
                    $data['err_email'] = form_error('email', '<span>', '</span>');
                    $data['err_spc'] = form_error('spc', '<span>', '</span>');


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
                        //'username' => $username,
                        'nama' => $nama,
                        'nip' => $nip,
                        'jabatan' => $jabatan,
                        'j_kelamin' => $j_kelamin,
                        'alamat' => $alamat,
                        'telepon' => $telepon,
                        'email' => $email,
                        'spc' => $spc,
                        'created_at' => date("Y-m-d H:i:s")
                    );
                    $this->db->where('id_user', $id_user);
                    $this->db->update('mst_user', $data_insert);

                    $data['info'] = 'Data User Berhasil Disimpan';
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

    public function user_del()
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
        elseif ($this->Login_model->cekLogin('ADM_USER', 'delete')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                //Ambil data POST
                (isset($_POST['id_user']))      ? $id_user =    $_POST['id_user']     : $id_user = "";

                //Jika ada error 
                if ($err) {
                    //
                }
                //Jika tidak ada error
                else {

                    $this->db->where('id_user', $id_user);
                    $this->db->delete('mst_user');

                    $data['info'] = 'Data User Berhasil Dihapus';
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

    public function akses_view()
    {
        //Cek jika user Login / variabel "asm_st" ada di session
        //Kalau sudah login, variabel "asm_st" = "yes"
        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');
        if (empty($cek) || $cek <> "yes") {
            return $this->load->view('auth/v_login');
        }
        //Jika User = 99(IT) atau 1(admin)

        if ($this->Login_model->cekLogin('ADM_AKSES', 'view')) {
            $data['link'] = 'admin';
            $data['sublink'] = 'akses';
            $data['subsublink'] = '';

            $data['title'] = 'Hak Akses - ' . $this->config->item('app_name');

            //CSS untuk menampilkan tabel (datatables)
            $data['cust_css'] = '';

            //JS untuk menampilkan tabel (datatables)
            $data['cust_js'] = '';


            $this->load->view('tabler/a_header', $data);
            $this->load->view('tabler/admin/v_akses', $data);
            $this->load->view('tabler/a_footer');
            $this->load->view('tabler/admin/v_akses_js', $data);
            $this->load->view('tabler/a_end_page');
        }
        //Jika bukan kembali ke base_url (home)
        else {
            redirect(base_url());
        }
        //END FUNCTION
    }

    public function akses_data()
    {

        //$data = $this->db->query('select a.kode_role, b.nama_role,vw,edt,dlt from mst_user_role a left join mst_role b on a.kode_role = b.kode_role where nik = \'' . $nik . '\' and a.kode_role not in (\'SET_KTR\',\'SET_PROV\',\'SET_WEB\',\'SET_UPLOAD\') order by b.nama_role');

        //Cek jika user Login / variabel "asm_st" ada di session
        //Kalau sudah login, variabel "asm_st" = "yes"
        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');
        if (empty($cek) || $cek <> "yes") {
            $data['status'] = 'nok';
            $data['info'] = 'Anda Tidak Berhak';
        }
        //Jika User = 99(IT) atau 1(admin)
        elseif ($this->Login_model->cekLogin('ADM_AKSES', 'view')) {

            if (isset($_POST['spc'])) {
                $spc =    $_POST['spc'];
                $query = $this->db->query("select * from view_akses_spc where spc=$spc order by spc,kode_halaman");
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

    public function akses_upd()
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
        elseif ($this->Login_model->cekLogin('ADM_AKSES', 'edit')) {

            $data['info'] = "";
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                (isset($_POST['spc'])) ? $spc = $_POST['spc'] : $spc = "";
                (isset($_POST['role_view'])) ? $view = $_POST['role_view'] : $view = "";
                (isset($_POST['role_edit'])) ? $edit = $_POST['role_edit'] : $edit = "";
                (isset($_POST['role_delete'])) ? $delete = $_POST['role_delete'] : $delete = "";

                $this->db->trans_begin();

                $this->db->query("update mst_akses_detail set vw=0,edt=0,del=0 where spc=$spc");

                foreach ($view as $vw) {
                    $this->db->query("update mst_akses_detail set vw=1 where spc=$spc and kode_halaman='$vw'");
                }
                foreach ($edit as $edt) {
                    $this->db->query("update mst_akses_detail set edt=1 where spc=$spc and kode_halaman='$edt'");
                }
                foreach ($delete as $dlt) {
                    $this->db->query("update mst_akses_detail set del=1 where spc=$spc and kode_halaman='$dlt'");
                }

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $data['status'] = 'nok';
                    $data['info'] = 'Akses gagal diupdate';
                } else {
                    $this->db->trans_commit();
                    $data['status'] = 'ok';
                    $data['info'] = 'Akses berhasil diupdate';
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
