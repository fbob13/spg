<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_test extends CI_Controller
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
        $data['title'] = 'Ganti Password';
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
        $this->load->view('tabler/setting/v_ganti_password_js', $data);
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

    public function excel_read()
    {
        $data['xx'] = "";

        $this->load->library('SimpleXLSX');
        //$this->ssp->complex($_REQUEST, $sql_details, $table, $primaryKey, $columns, '', $where)


        if (isset($_FILES['file'])) {
            if ($xlsx = $this->simplexlsx->parse($_FILES['file']['tmp_name'])) {
                echo '<h2>Parsing Result</h2>';
                echo '<table border="1" cellpadding="3" style="border-collapse: collapse">';

                $dim = $xlsx->dimension();
                $cols = $dim[0];

                foreach ($xlsx->readRows() as $k => $r) {
                    //      if ($k == 0) continue; // skip first row
                    echo '<tr>';
                    for ($i = 0; $i < $cols; $i++) {
                        echo '<td>' . (isset($r[$i]) ? $r[$i] : '&nbsp;') . '</td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo $this->simplexlsx->parseError();
            }
        }

        echo '<h2>Upload form</h2>
<form method="post" enctype="multipart/form-data">
*.XLSX <input type="file" name="file"  />&nbsp;&nbsp;<input type="submit" value="Parse" />
</form>';

        /*
        $this->load->view('tabler/a_header', $data);
        $this->load->view('tabler/test/excel_read', $data);
        $this->load->view('tabler/a_footer', $data);
        //$this->load->view('tabler/setting/excel_read', $data);
        $this->load->view('tabler/a_end_page', $data);
        */
    }

    public function excel_write_old()
    {
        $this->load->library('SimpleXLSXGen');

        $books = [
            ['ISBN', 'title', 'author', 'publisher', 'ctry'],
            [618260307, 'The Hobbit', 'J. R. R. Tolkien', 'Houghton Mifflin', 'USA'],
            [908606664, 'Slinky Malinki', 'Lynley Dodd', 'Mallinson Rendel', 'NZ']
        ];

        $books2 = [
            ['ISBN', 'title', 'author', 'publisher', 'ctry'],
            [618260307, 'The Hobbit', 'J. R. R. Tolkien', 'Houghton Mifflin', 'USA'],
            [908606664, 'Slinky Malinki', 'Lynley Dodd', 'Mallinson Rendel', 'NZ'],
            [908606664, 'Slinky Malinki', 'Lynley Dodd', 'Mallinson Rendel', 'NZ']
        ];


        $query = $this->db->query('select * from view_rutin');
        $rutin_head = [['nama','test']];
        $rutin = array_merge($rutin_head,$query->result_array());

        $xlsx = $this->simplexlsxgen->fromArray($books)->addSheet($books2,'shetttt')->addSheet($rutin,'rutin');
        //$xlsx = $this->simplexlsxgen::
        $xlsx->saveAs('upload/template.xlsx'); // or downloadAs('books.xlsx') or $xlsx_content = (string) $xlsx 
        
        echo "excel write";

    }

    public function excel_write()
    {
        $this->Excel_model->create_template();
        
        echo "excel write";

    }
}
