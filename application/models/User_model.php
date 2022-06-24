<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class User_model extends CI_Model
{
  //

  public function create_user($nik, $username, $kode_cabang, $password, $spc)
  {
    $this->db->query('insert into mst_user
                      (username,nama,kode_cabang,password,spc,foto)
                      VAlUES
                      (\'' . $nik . '\',
                      \'' . $username . '\',
                      \'' . $kode_cabang . '\',
                      \'' . md5($password) . '\',' . $spc . ',\'default.png\')
    ');
    $id_baru = $this->db->insert_id();
    $role = $this->db->query('select * from mst_role');

    foreach ($role->result() as $row) {
      $hasil[] = $row;
      $this->db->query("insert into mst_user_role (nik,kode_role,vw,edt,dlt) values('" . $id_baru . "','" . $row->kode_role . "',0,0,0)");
    }

    return 'User berhasil di buat';
  }

  public function delete_user($nik)
  {
    $this->db->query('delete from mst_user where nik = \'' . $nik . '\'');
    $this->db->query('delete from mst_user_role where nik = \'' . $nik . '\'');

    return 'User berhasil di hapus';
  }

  public function reset_password($nik)
  {
    $this->db->query('update mst_user set password = \'' . md5('123456') . '\'
              where NIK = \'' . $nik . '\'');

    return 'Password berhasil di reset menjadi <span class="text-primary">123456</span>';
  }
/*
  public function getUserRoleStrict($nik)
  {
    $data = $this->db->query('select a.kode_role, b.nama_role,vw,edt,dlt from mst_user_role a left join mst_role b on a.kode_role = b.kode_role where nik = \'' . $nik . '\' and a.kode_role not in (\'SET_KTR\',\'SET_PROV\',\'SET_WEB\',\'SET_UPLOAD\') order by b.nama_role');

    foreach ($data->result() as $row) {
      $hasil[] = $row;
    }
    return $hasil;
  }
*/
  public function getUserRole($nik)
  {
    //$data = $this->db->query('select a.kode_role, b.nama_role,vw,edt,dlt from mst_user_role a left join mst_role b on a.kode_role = b.kode_role where nik = \'' . $nik . '\' order by b.nama_role');
    $data = $this->db->query("select kode_halaman, vw, edt,del from view_akses where id_user = '$nik'");

    foreach ($data->result() as $row) {
      $hasil[] = $row;
    }
    return $hasil;
  }

  /*
  public function updateUserRole($nik, $view, $edit, $delete)
  {
    $this->db->query('update mst_user_role set vw=0,edt=0,dlt=0 where nik=\'' . $nik . '\' and kode_role not in (\'SET_KTR\',\'SET_PROV\',\'SET_WEB\',\'SET_UPLOAD\')');

    foreach ($view as $vw) {
      $this->db->query('update mst_user_role set vw=1 where nik=\'' . $nik . '\' and kode_role=\'' . $vw . '\'');
    }
    foreach ($edit as $edt) {
      $this->db->query('update mst_user_role set edt=1 where nik=\'' . $nik . '\' and kode_role=\'' . $edt . '\'');
    }
    foreach ($delete as $dlt) {
      $this->db->query('update mst_user_role set dlt=1 where nik=\'' . $nik . '\' and kode_role=\'' . $dlt . '\'');
    }
    return 'Hak Akses Berhasil di Update';
  }
*/
  public function update_password($nik, $password_baru)
  {
    $this->db->query('update mst_user set password = \'' . md5($password_baru) . '\'
    where nik = \'' . $nik . '\'');

    return 'Password berhasil di rubah';
  }

  public function cek_password($user, $pass)
  {

    $u = $this->db->escape_str($user);
    $p = md5($this->db->escape_str($pass));

    $cek_login = $this->db->get_where('mst_user', array('nik' => $u, 'password' => $p));

    if (count($cek_login->result()) == 1) {
      return 'OK';
    } else {
      return 'NOK';
    }
  }

}
