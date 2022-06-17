<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_setting extends CI_Controller
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


    public function ganti_password()
    {
        $data['title'] = 'Ganti Password - E-Warkah';
        $data['cust_css'] = '';
        $data['cust_js'] = '';
        $data['link'] = '';
        $data['sublink'] = '';
        $data['subsublink'] = '';
        $data['info'] = '';

        if (empty($_POST)) {
            //echo $this->load->view('p_password',$data,true);
            $data['info'] = '';
        } else {
            $data['info'] = 'yyyy';

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            (isset($_POST['pass_lama'])) ? $pass_lama = $_POST['pass_lama'] : $pass_lama = "";
            (isset($_POST['pass_baru'])) ? $pass_baru = $_POST['pass_baru'] : $pass_baru = "";
            (isset($_POST['pass_conf'])) ? $pass_conf = $_POST['pass_conf'] : $pass_conf = "";

            //cek password lama
            $status_cek_password = "";

            $u = $this->db->escape_str($this->session->userdata('id_user'));
            $p = md5($this->db->escape_str($pass_lama));

            $cek_login = $this->db->get_where('mst_user', array('id_user' => $u, 'password' => $p));

            if (count($cek_login->result()) == 1) {
                $status_cek_password = 'OK';
            } else {
                $status_cek_password = 'NOK';
            }




            $this->form_validation->set_rules('pass_baru', 'Password Baru', 'trim|required|min_length[6]|alpha_numeric', array(
                'required' => "Password Baru Harus di isi",
                'min_length' => "Password Baru Minimal 6 karakter",
                'alpha_numeric' => "Kombinasi Password Baru Hanya boleh mengandung Angka (0-9) dan Huruf (A-Z)"
            ));

            $this->form_validation->set_rules('pass_lama', 'Password Lama', 'trim|required', array(
                'required' => "Password Lama Harus di isi",
                'min_length' => "Password Lama Minimal 6 karakter",
                'alpha_numeric' => "Kombinasi Password Lama Hanya boleh mengandung Angka (0-9) dan Huruf (A-Z)"
            ));

            if ($status_cek_password == "NOK") {
                $data['status'] = 'nok';
                $data['info'] = '<div class="alert alert-important alert-danger" role="alert">Password Lama Salah</div>';
            } else if ($this->form_validation->run() == FALSE) {
                $data['status'] = 'nok';
                $data['info'] = '<div class="alert alert-important alert-danger" role="alert">' . validation_errors() . '</div>';
            } else if ($pass_baru <> $pass_conf) {
                $data['status'] = 'nok';
                $data['info'] = '<div class="alert alert-important alert-danger" role="alert">Konfirmasi Password tidak sama</div>';
            } else {
                $data['status'] = 'ok';
                //$proses = $status_cek_password = $this->User_model->update_password($this->session->userdata('nik'), $pass_baru);

                $this->db->query('update mst_user set password = \'' . md5($pass_baru) . '\'
                where id_user = \'' . $this->session->userdata('id_user') . '\'');

                $data['info'] = '<div class="alert alert-important alert-success" role="alert">Password berhasil di rubah</div>';
            }
        }

        $this->load->view('tabler/a_header', $data);
        $this->load->view('tabler/setting/v_ganti_password', $data);
        $this->load->view('tabler/a_footer', $data);
        $this->load->view('tabler/a_end_page', $data);
    }

    public function profile()
    {

        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');

        //$cek = $this->session->userdata('logged_in');
        if (empty($cek) || $cek <> "yes") {
            return $this->load->view('auth/v_login');
        }

        $data['link'] = 'setting';
        $data['sublink'] = 'profil';
        $data['subsublink'] = '';

        $data['title'] = 'Edit Profil - ' . $this->config->item('app_name');
        $data['cust_css'] = '';
        $data['cust_js'] = '<script src="' . base_url() . 'dist/libs/jquery/jquery-3.6.0.min.js"></script>';
        //$data['data_role'] = $data_role;

        $query = $this->db->get_where('mst_user', array('id_user' => $this->session->userdata('id_user')));
        $data['data_profile'] = $query->first_row();

        $this->load->view('tabler/a_header', $data);
        $this->load->view('tabler/setting/v_profile', $data);
        $this->load->view('tabler/a_footer');
        $this->load->view('tabler/setting/v_profile_js', $data);
        $this->load->view('tabler/a_end_page');

        //END FUNCTION
    }

    public function profile_update()
    {
        
        $cek = $this->session->userdata('asm_st');
        $spc = $this->session->userdata('spc');

        //cek login
        if (empty($cek) || $cek <> "yes") {
            $data['status'] = 'nok';
            $data['message'] = 'Anda Tidak Berhak';
            echo json_encode($data);
        } /*else if ($data_role->edt == 0) {
			$data['status'] = 'nok';
			$data['message'] = 'Anda Tidak Berhak';
			echo json_encode($data);
		} */ else {

            $data['info'] = "";

            $data['nomor_induk'] = '';
            $data['nama'] = '';
            $data['jabatan'] = '';
            $data['j_kelamin'] = '';
            $data['telepon'] = '';
            $data['alamat'] = '';
            $err = false;

            if (!empty($_POST)) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                $nomor_induk = $this->session->userdata('id_user');
                (isset($_POST['nomor_induk']))                 ? $nomor_induk = $_POST['nomor_induk']                                 : $nomor_induk = "";
                (isset($_POST['nama']))                 ? $nama = $_POST['nama']                                 : $nama = "";
                (isset($_POST['jabatan']))         ? $jabatan = $_POST['jabatan']                     : $jabatan = "";
                (isset($_POST['j_kelamin']))     ? $j_kelamin = $_POST['j_kelamin']             : $j_kelamin = "";
                (isset($_POST['telepon']))         ? $telepon = $_POST['telepon']                     : $telepon = "";
                (isset($_POST['alamat']))             ? $alamat = $_POST['alamat']                         : $alamat = "";
                (isset($_POST['email']))             ? $email = $_POST['email']                         : $email = "";

                $data['err_nomor_induk'] = '';
                $data['err_nama'] = '';
                $data['err_jabatan'] = '';
                $data['err_telepon'] = '';
                $data['err_j_kelamin'] = '';
                $data['err_alamat'] = '';
                $data['err_email'] = '';
                $data['err_foto'] = '';

                $this->form_validation->set_rules(
                    'nomor_induk',
                    'nomor_induk',
                    'trim|required',
                    array(
                        'required' => "harus di isi",
                    )
                );

                $this->form_validation->set_rules(
                    'nama',
                    'Nama',
                    'trim|required',
                    array(
                        'required' => "harus di isi",
                    )
                );
                $this->form_validation->set_rules(
                    'jabatan',
                    'Jabatan',
                    'trim|required',
                    array(
                        'required' => "harus di isi"
                    )
                );
                $this->form_validation->set_rules(
                    'telepon',
                    'Telepon',
                    'trim|required',
                    array(
                        'required' => "harus di isi"
                    )
                );
                $this->form_validation->set_rules(
                    'j_kelamin',
                    'Jenis Kelamin',
                    'trim|required',
                    array(
                        'required' => "harus di isi"
                    )
                );
                $this->form_validation->set_rules(
                    'alamat',
                    'Alamat',
                    'trim|required',
                    array(
                        'required' => "harus di isi"
                    )
                );
                $this->form_validation->set_rules(
                    'email',
                    'email',
                    'trim|required|valid_email',
                    array(
                        'required' => "harus di isi",
                        'is_unique' => "Email Telah Terdaftar"
                    )
                );

                if ($this->form_validation->run() == FALSE) {

                    $data['err_nama'] = form_error('nama', '<span>', '</span>');
                    $data['err_jabatan'] = form_error('jabatan', '<span>', '</span>');
                    $data['err_telepon'] = form_error('telepon', '<span>', '</span>');
                    $data['err_j_kelamin'] = form_error('j_kelamin', '<span>', '</span>');
                    $data['err_alamat'] = form_error('alamat', '<span>', '</span>');
                    $data['err_email'] = form_error('email', '<span>', '</span>');

                    $err = true;
                    $data['status'] = 'nok';
                }
                if ($j_kelamin <> 'L' && $j_kelamin <> 'P') {
                    $data['err_j_kelamin'] = '<span>Data tidak valid</span>';
                    $err = true;
                    $data['status'] = 'nok';
                }

                $old_data = $this->db->get_where('mst_user', array('id_user' => $this->session->userdata('id_user')), 1);
                $old_data_res = $old_data->first_row();
                $check = $this->db->get_where('mst_user', array('username' => $nomor_induk), 1);
                if ($check->num_rows() > 0) {
                    //$this->set_message('unique_kode_kategori', 'Kode telah terdaftar');
                    //return FALSE;
                    if ($nomor_induk == $old_data_res->username) {
                        $data['err_nomor_induk'] = '';
                    } else {
                        $data['err_nomor_induk'] = '<span>Username sudah terdaftar</span>';
                        $err = true;
                        $data['status'] = 'nok';
                    }
                }

                $check = $this->db->get_where('mst_user', array('email' => $email), 1);
                if ($check->num_rows() > 0) {
                    //$this->set_message('unique_kode_kategori', 'Kode telah terdaftar');
                    //return FALSE;
                    if ($email == $old_data_res->email) {
                        $data['err_email'] = '';
                    } else {
                        $data['err_email'] = '<span>Email sudah terdaftar</span>';
                        $err = true;
                        $data['status'] = 'nok';
                    }
                }

                $data['nama_foto'] = 'default.png';
                $check_foto = false;
                if (isset($_FILES['foto'])) {

                    $target_dir = "static/foto/";
                    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $simpan_foto = $target_dir . $nomor_induk . '.' . $imageFileType;
                    $data['nama_foto'] = $nomor_induk . '.' . $imageFileType;

                    //cek ukuran file
                    if ($_FILES["foto"]["size"] > 500000) {
                        $err = true;
                        $data['status'] = 'nok';
                        $data['err_foto'] = '<span>Ukuran Foto melebihi 500Kb</span>';
                    } else if (
                        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif"
                    ) {
                        $err = true;
                        $data['status'] = 'nok';
                        $data['err_foto'] = '<span>Format gambar tidak sesuai, Silahkan upload file dengan format jpg, jpeg, gif, png.</span>';
                    } else {
                        $check_foto = true;

                        $fn = $_FILES['foto']['tmp_name'];
                        $size = getimagesize($fn);
                        $ratio = $size[0] / $size[1]; // width/height
                        if ($ratio > 1) {
                            $width = 500;
                            $height = 500 / $ratio;
                        } else {
                            $width = 500 * $ratio;
                            $height = 500;
                        }
                        $src = imagecreatefromstring(file_get_contents($fn));
                        $dst = imagecreatetruecolor($width, $height);
                        imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
                        imagedestroy($src);
                        imagepng($dst, $simpan_foto); // adjust format as needed
                        imagedestroy($dst);

                        $err = false;
                    }
                }
                if ($err) {
                    //$data['nik'] = $nik;
                    //$data['nama'] = $nama;
                    $data['info'] = '<div class="breadcrumb bg-danger pt-4"><p>' . "Silahkan koreksi data yang di input" . '</p></div>';
                    //echo $this->load->view('p_new_user',$data,true);	\
                    echo json_encode($data);
                } else {

                    if ($check_foto) {
                        $data_update = array(
                            'username' => $nomor_induk,
                            'nama' => $nama,
                            'alamat' => $alamat,
                            'jabatan' => $jabatan,
                            'j_kelamin' => $j_kelamin,
                            'telepon' => $telepon,
                            'email' => $email,
                            'foto' => $data['nama_foto']
                        );
                    } else {
                        $data_update = array(
                            'username' => $nomor_induk,
                            'nama' => $nama,
                            'alamat' => $alamat,
                            'jabatan' => $jabatan,
                            'j_kelamin' => $j_kelamin,
                            'telepon' => $telepon,
                            'email' => $email
                        );
                    }


                    $sess_data['avatar'] = $data['nama_foto'];
                    $this->session->set_userdata($sess_data);


                    $this->db->where('id_user', $this->session->userdata('id_user'));
                    $this->db->update('mst_user', $data_update);

                    $data['info'] = 'Data Berhasil di update';
                    $data['status'] = 'ok';
                    //echo $this->load->view('p_new_user',$data,true);	

                    echo json_encode($data);
                }
            }
        }

        //END FUNCTION
    }
}
