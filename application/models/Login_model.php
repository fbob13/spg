<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Login_model extends CI_Model
{
  //

  public function cekRole($nik, $kode_role)
  {
    $data = $this->db->query('select * from mst_user_role where nik ="' . $nik . '" and kode_role ="' . $kode_role . '"');


    $hasil =  $data->first_row();
    return $hasil;
  }

  public function getRole($nik)
  {
    $data = $this->db->query('select * from mst_user_role where nik ="' . $nik . '"');
    foreach ($data->result() as $row) {
      $hasil[] = $row;
    }
    return $hasil;
  }

  public function getDataUser()
  {
    $cabang = $this->session->userdata('kode_cabang_user');
    if ($cabang == 'all') {
      $data = $this->db->query('select a.kode_cabang,nik,username,nama,spc,alamat,jabatan,j_kelamin,telepon,email,foto,b.nama_cabang from mst_user a, mst_cabang b where a.kode_cabang = b.kode_cabang and spc=1');
    } else {
      $data = $this->db->query('select a.kode_cabang,nik,username,nama,spc,alamat,jabatan,j_kelamin,telepon,email,foto,b.nama_cabang from mst_user a, mst_cabang b where a.kode_cabang =\'' . $cabang . '\' and a.kode_cabang = b.kode_cabang and spc=1');
    }

    foreach ($data->result() as $row) {
      $hasil[] = $row;
    }
    return $hasil;
  }



  public function getLoginData($user, $pass)
  {

    $u = $this->db->escape_str($user);
    $p = md5($this->db->escape_str($pass));


    $cek_login = $this->db->get_where('mst_user', array('username' => $u, 'password' => $p));

    if (count($cek_login->result()) > 0) {
      foreach ($cek_login->result() as $qad) {

        $sess_data['id_user'] = $qad->id_user;
        $sess_data['username'] = $qad->username;
        $sess_data['nama'] = $qad->nama;
        $sess_data['spc'] = $qad->spc;
        $sess_data['avatar'] = $qad->foto;

        $sess_data['asm_st'] = "yes";

        $this->session->set_userdata($sess_data);
      }

      header('location:' . base_url());
    } else {
      header('location:' . base_url());
      $this->session->set_flashdata('info', '
								<div class="alert alert-danger alert-important text-center">
							Kombinasi Username / Password Salah
							<br />
						</div>
					');
    }
  }

  public function getUserRole($nik)
  {
    $data = $this->db->query('select a.kode_role, b.nama_role,vw,edt,dlt from mst_user_role a left join mst_role b on a.kode_role = b.kode_role where nik = \'' . $nik . '\' order by b.nama_role');

    foreach ($data->result() as $row) {
      $hasil[] = $row;
    }
    return $hasil;
  }

  //Fungsi cek login dan role halaman
  public function cekLogin($kode_halaman = "", $aksi = "")
  {
    $status = false;
    $spc = $this->session->userdata('spc');
    $cek = $this->session->userdata('asm_st');
    if (empty($cek) || $cek <> "yes") {
      $status = false;
    } else {
      if ($kode_halaman <> "" and $aksi <> "") {
        $query = $this->db->query("select * from view_akses where spc =$spc and kode_halaman='$kode_halaman'");
        $akses = $query->first_row();
        $hasil = 0;
        if ($query->num_rows() >= 1) {
          if ($aksi == 'view') {
            $hasil = $akses->vw;
          } else if ($aksi == 'edit') {
            $hasil = $akses->edt;
          } else if ($aksi == 'delete') {
            $hasil = $akses->del;
          }
          if ($hasil == 1) {
            $status = true;
          } else {
            $status = false;
          }
        } else {
          $status = false;
        }
      } else {
        $status = true;
      }
    }
    return $status;
  }
}
