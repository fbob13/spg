<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Master_model extends CI_Model
{
  //
  public function getJumlahRecord($nama_tabel, $kode_cabang)
  {
    if ($nama_tabel == 'mst_user') {
      $data = $this->db->query('select count(*) jumlah from ' . $nama_tabel . ' where kode_cabang = \'' . $kode_cabang . '\' and spc=0');
    } else {
      $data = $this->db->query('select count(*) jumlah from ' . $nama_tabel . ' where kode_cabang = \'' . $kode_cabang . '\'');
    }


    $hasil = $data->first_row();
    return $hasil->jumlah;
  }
  public function getJumlahRecordCari($nama_tabel, $kode_cabang, $nilai, $kolom, $ckec = "", $ckel = "", $ctahun = "")
  {

    $str_query = "";
    if ($ckec <> "") {
      $str_query = $str_query . ' and kode_kecamatan =\'' . $ckec . '\' ';
    }
    if ($ckel <> "") {
      $str_query = $str_query . ' and kode_kelurahan =\'' . $ckel . '\' ';
    }
    if ($ctahun <> "") {
      $str_query = $str_query . ' and tahun =\'' . $ctahun . '\' ';
    }

    if ($nama_tabel == 'mst_kelurahan') {
      $data = $this->db->query('(select count(*) jumlah from(select a.kode_cabang,b.kode_kecamatan,b.nama_kecamatan,a.kode_kelurahan,a.nama_kelurahan 
                                  from mst_kelurahan a 
                                  left join mst_kecamatan b on a.kode_kecamatan = b.kode_kecamatan and a.kode_cabang = b.kode_cabang 
                                  ) as jt where jt.kode_cabang = \'' . $kode_cabang . '\' and upper(jt.' . $kolom . ') like \'%' . $nilai . '%\')');
    } elseif ($nama_tabel == 'mst_subkategori') {
      $data = $this->db->query('(select count(*) jumlah from(select a.kode_cabang,b.kode_kategori,b.nama_kategori,a.kode_subkategori,a.nama_subkategori,a.keterangan 
                                  from mst_subkategori a 
                                  left join mst_kategori b on a.kode_kategori = b.kode_kategori and a.kode_cabang = b.kode_cabang 
                                  ) as jt where jt.kode_cabang = \'' . $kode_cabang . '\' and upper(jt.' . $kolom . ') like \'%' . $nilai . '%\')');
    } elseif ($nama_tabel == 'mst_user') {
      $data = $this->db->query('select count(*) jumlah from ' . $nama_tabel . ' where kode_cabang = \'' . $kode_cabang . '\' and upper(' . $kolom . ') like \'%' . $nilai . '%\' and spc=0');
    } else {
      $data = $this->db->query('select count(*) jumlah from ' . $nama_tabel . ' where kode_cabang = \'' . $kode_cabang . '\' and upper(' . $kolom . ') like \'%' . $nilai . '%\'' . $str_query);
    }
    $hasil = $data->first_row();
    return $hasil->jumlah;
  }

  public function getDataTableNew($nama_tabel, $select, $where, $limit, $start, $order, $arah)
  {
    if ($start == 0) {
      $start = 1;
    }
    $start = ($start - 1) * $limit;
    $end = $start + $limit;

    $query = $this->db->query('SELECT 
                        @i:=@i+1 AS rnum, 
                        t.*
                        FROM 
                            (select ' . $select . ' from ' . $nama_tabel . ' where ' . $where . ') AS t,
                            (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah . '
                        limit ' . $limit . ' offset ' . $start);

    $query_total = $this->db->query('select ' . $select . ' from ' . $nama_tabel . ' where ' . $where);

    if ($query->num_rows() > 0) {
      $data['result'] = $query->result();
      $data['rows'] = $query_total->num_rows();
      return $data;
    }
    $data['result'] = false;
    $data['rows'] = 0;
    return $data;
  }

  public function getDataTable($nama_tabel, $kode_cabang, $limit, $start, $order, $arah)
  {
    if ($start == 0) {
      $start = 1;
    }
    $start = ($start - 1) * $limit;
    $end = $start + $limit;
    if ($nama_tabel == 'mst_user') {
      $query = $this->db->query('SELECT 
                        @i:=@i+1 AS rnum, 
                        t.*
                        FROM 
                            (select kode_cabang,nik,username,nama,spc,alamat,jabatan,j_kelamin,telepon,email,foto,nip from ' . $nama_tabel . ' where kode_cabang = \'' . $kode_cabang . '\' and spc = 0) AS t,
                            (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah . '
                        limit ' . $limit . ' offset ' . $start);

      if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
          $data[] = $row;
        }
        return $data;
      }
      return false;
    } else {
      $query = $this->db->query('SELECT 
        @i:=@i+1 AS rnum, 
        t.*
        FROM 
            (select * from ' . $nama_tabel . ' where kode_cabang = \'' . $kode_cabang . '\') AS t,
            (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah . '
        limit ' . $limit . ' offset ' . $start);

      if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
          $data[] = $row;
        }
        return $data;
      }
      return false;
    }
  }

  public function getDataTableCari($nama_tabel, $kode_cabang, $limit, $start, $order, $arah, $nilai, $kolom, $ckec = "", $ckel = "", $ctahun = "")
  {
    $str_query = "";
    if ($ckec <> "") {
      $str_query = $str_query . ' and kode_kecamatan =\'' . $ckec . '\' ';
    }
    if ($ckel <> "") {
      $str_query = $str_query . ' and kode_kelurahan =\'' . $ckel . '\' ';
    }
    if ($ctahun <> "") {
      $str_query = $str_query . ' and tahun =\'' . $ctahun . '\' ';
    }

    if ($start == 0) {
      $start = 1;
    }
    $start = ($start - 1) * $limit;
    $end = $start + $limit;
    if ($nama_tabel == 'mst_user') {
      $query = $this->db->query('SELECT 
              @i:=@i+1 AS rnum, 
              t.*
          FROM 
              (select kode_cabang,nik,username,nama,spc,alamat,jabatan,j_kelamin,telepon,email,foto,nip from ' . $nama_tabel . ' where kode_cabang = \'' . $kode_cabang . '\' and upper(' . $kolom . ') like \'%' . $nilai . '%\' and spc=0) AS t,
              (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah . '
          limit ' . $limit . ' offset ' . $start);

      if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
          $data[] = $row;
        }
        return $data;
      }
      return false;
    } else {


      $query = $this->db->query('SELECT 
                                  @i:=@i+1 AS rnum, 
                                  t.*
                              FROM 
                                  (select * from ' . $nama_tabel . ' where kode_cabang = \'' . $kode_cabang . '\' and upper(' . $kolom . ') like \'%' . $nilai . '%\' ' . $str_query . ') AS t,
                                  (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah . '
                              limit ' . $limit . ' offset ' . $start);

      if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
          $data[] = $row;
        }
        return $data;
      }
      return false;
    }
  }




  public function getDataTableKelurahan($nama_tabel, $kode_cabang, $limit, $start, $order, $arah)
  {
    if ($start == 0) {
      $start = 1;
    }
    $start = ($start - 1) * $limit;
    $end = $start + $limit;

    $query = $this->db->query('SELECT 
                                  @i:=@i+1 AS rnum, 
                                  t.*
                              FROM 
                                  (select a.kode_cabang,b.kode_kecamatan,b.nama_kecamatan,a.kode_kelurahan,a.nama_kelurahan 
                                  from mst_kelurahan a 
                                  left join mst_kecamatan b on a.kode_kecamatan = b.kode_kecamatan and a.kode_cabang = b.kode_cabang 
                                  where a.kode_cabang = \'' . $kode_cabang . '\') AS t,
                                  (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah . '
                              limit ' . $limit . ' offset ' . $start);

    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }

  public function getDataTableKelurahanCari($nama_tabel, $kode_cabang, $limit, $start, $order, $arah, $nilai, $kolom)
  {
    if ($start == 0) {
      $start = 1;
    }
    $start = ($start - 1) * $limit;
    $end = $start + $limit;

    $query = $this->db->query('SELECT 
                                  @i:=@i+1 AS rnum, 
                                  t.*
                              FROM 
                                  (select * from(select a.kode_cabang,b.kode_kecamatan,b.nama_kecamatan,a.kode_kelurahan,a.nama_kelurahan 
                                  from mst_kelurahan a 
                                  left join mst_kecamatan b on a.kode_kecamatan = b.kode_kecamatan and a.kode_cabang = b.kode_cabang 
                                  ) as jt where jt.kode_cabang = \'' . $kode_cabang . '\' and upper(jt.' . $kolom . ') like \'%' . $nilai . '%\') AS t,
                                  (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah . '
                              limit ' . $limit . ' offset ' . $start);

    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }

  public function getDataTableSubkategori($nama_tabel, $kode_cabang, $limit, $start, $order, $arah)
  {
    if ($start == 0) {
      $start = 1;
    }
    $start = ($start - 1) * $limit;
    $end = $start + $limit;

    $query = $this->db->query('SELECT 
                                  @i:=@i+1 AS rnum, 
                                  t.*
                              FROM 
                                  (select a.kode_cabang,b.kode_kategori,b.nama_kategori,a.kode_subkategori,a.nama_subkategori,a.keterangan 
                                  from mst_subkategori a 
                                  left join mst_kategori b on a.kode_kategori = b.kode_kategori and a.kode_cabang = b.kode_cabang 
                                  where a.kode_cabang = \'' . $kode_cabang . '\') AS t,
                                  (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah . '
                              limit ' . $limit . ' offset ' . $start);

    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }

  public function getDataTableSubkategoriCari($nama_tabel, $kode_cabang, $limit, $start, $order, $arah, $nilai, $kolom)
  {
    if ($start == 0) {
      $start = 1;
    }
    $start = ($start - 1) * $limit;
    $end = $start + $limit;

    $query = $this->db->query('SELECT 
                                  @i:=@i+1 AS rnum, 
                                  t.*
                              FROM 
                                  (select * from(select a.kode_cabang,b.kode_kategori,b.nama_kategori,a.kode_subkategori,a.nama_subkategori,a.keterangan 
                                  from mst_subkategori a 
                                  left join mst_kategori b on a.kode_kategori = b.kode_kategori and a.kode_cabang = b.kode_cabang 
                                  ) as jt where jt.kode_cabang = \'' . $kode_cabang . '\' and upper(jt.' . $kolom . ') like \'%' . $nilai . '%\') AS t,
                                  (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah . '
                              limit ' . $limit . ' offset ' . $start);

    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }


  public function getDataTableDokumen($nama_tabel, $kode_cabang, $limit, $start, $order, $arah, $kategori, $subkategori = '')
  {
    if ($start == 0) {
      $start = 1;
    }
    $start = ($start - 1) * $limit;
    $end = $start + $limit;

    $query_string = 'SELECT 
    @i:=@i+1 AS rnum, 
    t.*
    FROM 
    (select a.id_dokumen,a.nomor_dokumen,a.nomor_lain,a.nama_dokumen,a.kode_kategori,b.nama_kategori,
      a.kode_subkategori,c.nama_subkategori,a.kode_kecamatan,d.nama_kecamatan,
      a.kode_kelurahan,e.nama_kelurahan,tahun,nomor_rak,a.kode_cabang,a.status,a.keterangan,
      a.created_by,a.created_at,a.updated_at,a.flag_serah_terima,a.tgl_serah_terima,a.serah,a.terima,
      a.nomor_bundel, a.tahun_lain1, a.tahun_lain2, a.kordinat,a.nomor_punggung,a.foto
      from dokumen a
      left join mst_kategori b on a.kode_kategori = b.kode_kategori and a.kode_cabang = b.kode_cabang
      left join mst_subkategori c on a.kode_subkategori = c.kode_subkategori and a.kode_cabang = c.kode_cabang and c.kode_kategori = b.kode_kategori 
      left join mst_kecamatan d on a.kode_kecamatan = d.kode_kecamatan and a.kode_cabang = d.kode_cabang
      left join mst_kelurahan e on a.kode_kelurahan = e.kode_kelurahan and a.kode_cabang = e.kode_cabang and e.kode_kecamatan= d.kode_kecamatan
    where';


    if ($subkategori == '' || $subkategori == '-') {
      $query = $this->db->query($query_string . ' a.kode_cabang = \'' . $kode_cabang . '\' and a.kode_kategori = \'' . $kategori . '\') AS t,
                                  (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah . '
                              limit ' . $limit . ' offset ' . $start);
    } else {

      $query = $this->db->query($query_string . ' a.kode_cabang = \'' . $kode_cabang . '\' and a.kode_kategori = \'' . $kategori . '\' and a.kode_subkategori = \'' . $subkategori . '\') AS t,
                                  (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah . '
                              limit ' . $limit . ' offset ' . $start);
    }
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }

  public function getDataTableDokumenCari($nama_tabel, $kode_cabang, $limit, $start, $order, $arah, $kategori, $subkategori = '', $nilai, $kolom, $ckec = "", $ckel = "", $ctahun = "", $nomor_lain1 = "")
  {
    $str_query = "";
    if ($ckec <> "") {
      $str_query = $str_query . ' and jt.kode_kecamatan =\'' . $ckec . '\' ';
    }
    if ($ckel <> "") {
      $str_query = $str_query . ' and jt.kode_kelurahan =\'' . $ckel . '\' ';
    }
    if ($ctahun <> "") {
      $str_query = $str_query . ' and (jt.tahun =\'' . $ctahun . '\' or  jt.tahun_lain1 =\'' . $ctahun . '\' ) ';
    }

    $explo = explode('-', $nomor_lain1);

    /*
    if (strpos($nomor_lain1, '-') !== false) {
      
      $a = $explo[0];
      $b = $explo[1];
      $str_query = $str_query . " AND nomor_lain between $a and $b ";
    }else{
      if ($nomor_lain1 <> "") {
        $str_query = $str_query . " AND ((SUBSTRING_INDEX(nomor_lain,'-',$nomor_lain1) <= 1 AND SUBSTRING_INDEX(nomor_lain,'-',-1) >=$nomor_lain1) OR nomor_lain = $nomor_lain1) ";
      }
    }

    */

    if ($nomor_lain1 <> "") {
      $str_query = $str_query . " AND (nomor_lain = '$nomor_lain1' or upper(trim(LEADING 0 from nomor_lain)) = '$nomor_lain1')";
    }


    if ($nilai <> "") {
      //$str_query = $str_query . ' and upper(jt.' . $kolom . ') like \'%' . $nilai . '%\' ';
      $nilai1 = strtoupper($nilai);
      if ($kolom == 'nama_dokumen') {
        //$str_query = $str_query . ' and upper(jt.' . $kolom . ') like \'%' . $nilai . '%\' ';
        $str_query = $str_query . " and upper(jt.$kolom) like '%$nilai1%' ";
      } else {
        //$str_query = $str_query . ' and jt.' . $kolom . ' = \'' . $nilai . '\' ';
        $str_query = $str_query . " and (UPPER(TRIM(LEADING 0 from jt.$kolom)) = '$nilai1' or UPPER(jt.$kolom) = '$nilai1')";
      }
    }

    if ($start == 0) {
      $start = 1;
    }
    $start = ($start - 1) * $limit;
    $end = $start + $limit;
    if ($subkategori == '' || $subkategori == '-') {
      $query = $this->db->query('SELECT 
                                  @i:=@i+1 AS rnum, 
                                  t.*
                              FROM 
                                  (select * from (select a.id_dokumen,a.nomor_dokumen,a.nama_dokumen,a.kode_kategori,b.nama_kategori,
                                    a.kode_subkategori,c.nama_subkategori,a.kode_kecamatan,d.nama_kecamatan,
                                    a.kode_kelurahan,e.nama_kelurahan,tahun,nomor_rak,a.kode_cabang,a.status,a.nomor_lain,a.keterangan,
                                    a.created_by,a.created_at,a.updated_at,a.flag_serah_terima,a.tgl_serah_terima,a.serah,a.terima, 
                                    a.nomor_bundel, a.tahun_lain1, a.tahun_lain2 , a.kordinat,a.nomor_punggung,a.foto
                                    from dokumen a
                                    left join mst_kategori b on a.kode_kategori = b.kode_kategori and a.kode_cabang = b.kode_cabang
                                    left join mst_subkategori c on a.kode_subkategori = c.kode_subkategori and a.kode_cabang = c.kode_cabang and c.kode_kategori = b.kode_kategori 
                                    left join mst_kecamatan d on a.kode_kecamatan = d.kode_kecamatan and a.kode_cabang = d.kode_cabang
                                    left join mst_kelurahan e on a.kode_kelurahan = e.kode_kelurahan and a.kode_cabang = e.kode_cabang and e.kode_kecamatan= d.kode_kecamatan ) as jt 
                                  where jt.kode_cabang = \'' . $kode_cabang . '\' and jt.kode_kategori = \'' . $kategori . '\' ' . $str_query . ') AS t,
                                  (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah . '


                              limit ' . $limit . ' offset ' . $start);
    } else {

      $query = $this->db->query('SELECT 
                                  @i:=@i+1 AS rnum, 
                                  t.*
                              FROM 
                                  (select * from (select a.id_dokumen,a.nomor_dokumen,a.nama_dokumen,a.kode_kategori,b.nama_kategori,
                                    a.kode_subkategori,c.nama_subkategori,a.kode_kecamatan,d.nama_kecamatan,
                                    a.kode_kelurahan,e.nama_kelurahan,tahun,nomor_rak,a.kode_cabang,a.status,a.nomor_lain,a.keterangan,
                                    a.created_by,a.created_at,a.updated_at,a.flag_serah_terima,a.tgl_serah_terima,a.serah,a.terima,
                                    a.nomor_bundel, a.tahun_lain1, a.tahun_lain2 , a.kordinat,a.nomor_punggung,a.foto
                                    from dokumen a
                                    left join mst_kategori b on a.kode_kategori = b.kode_kategori and a.kode_cabang = b.kode_cabang
                                    left join mst_subkategori c on a.kode_subkategori = c.kode_subkategori and a.kode_cabang = c.kode_cabang and c.kode_kategori = b.kode_kategori 
                                    left join mst_kecamatan d on a.kode_kecamatan = d.kode_kecamatan and a.kode_cabang = d.kode_cabang
                                    left join mst_kelurahan e on a.kode_kelurahan = e.kode_kelurahan and a.kode_cabang = e.kode_cabang and e.kode_kecamatan= d.kode_kecamatan) as jt
                                  where jt.kode_cabang = \'' . $kode_cabang . '\' and jt.kode_kategori = \'' . $kategori . '\' and jt.kode_subkategori = \'' . $subkategori . '\' ' . $str_query . ') AS t,
                                  (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah . '
                              limit ' . $limit . ' offset ' . $start);
    }

    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
    //return $this->db->last_query();
  }

  public function getDataTableDokumenJml($nama_tabel, $kode_cabang, $limit, $start, $order, $arah, $kategori, $subkategori = '')
  {
    if ($start == 0) {
      $start = 1;
    }
    $start = ($start - 1) * $limit;
    $end = $start + $limit;
    if ($subkategori == '' || $subkategori == '-') {
      $query = $this->db->query('SELECT 
                                  @i:=@i+1 AS rnum, 
                                  t.*
                              FROM 
                                  (select a.id_dokumen,a.nomor_dokumen,a.nama_dokumen,a.kode_kategori,b.nama_kategori,
                                    a.kode_subkategori,c.nama_subkategori,a.kode_kecamatan,d.nama_kecamatan,
                                    a.kode_kelurahan,e.nama_kelurahan,tahun,nomor_rak,a.kode_cabang,a.status,a.nomor_lain
                                    from dokumen a
                                    left join mst_kategori b on a.kode_kategori = b.kode_kategori and a.kode_cabang = b.kode_cabang
                                    left join mst_subkategori c on a.kode_subkategori = c.kode_subkategori and a.kode_cabang = c.kode_cabang and c.kode_kategori = b.kode_kategori 
                                    left join mst_kecamatan d on a.kode_kecamatan = d.kode_kecamatan and a.kode_cabang = d.kode_cabang
                                    left join mst_kelurahan e on a.kode_kelurahan = e.kode_kelurahan and a.kode_cabang = e.kode_cabang and e.kode_kecamatan= d.kode_kecamatan
                                  where a.kode_cabang = \'' . $kode_cabang . '\' and a.kode_kategori = \'' . $kategori . '\') AS t,
                                  (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah);
    } else {

      $query = $this->db->query('SELECT 
                                  @i:=@i+1 AS rnum, 
                                  t.*
                              FROM 
                                  (select a.id_dokumen,a.nomor_dokumen,a.nama_dokumen,a.kode_kategori,b.nama_kategori,
                                    a.kode_subkategori,c.nama_subkategori,a.kode_kecamatan,d.nama_kecamatan,
                                    a.kode_kelurahan,e.nama_kelurahan,tahun,nomor_rak,a.kode_cabang,a.status,a.nomor_lain
                                    from dokumen a
                                    left join mst_kategori b on a.kode_kategori = b.kode_kategori and a.kode_cabang = b.kode_cabang
                                    left join mst_subkategori c on a.kode_subkategori = c.kode_subkategori and a.kode_cabang = c.kode_cabang and c.kode_kategori = b.kode_kategori 
                                    left join mst_kecamatan d on a.kode_kecamatan = d.kode_kecamatan and a.kode_cabang = d.kode_cabang
                                    left join mst_kelurahan e on a.kode_kelurahan = e.kode_kelurahan and a.kode_cabang = e.kode_cabang and e.kode_kecamatan= d.kode_kecamatan
                                  where a.kode_cabang = \'' . $kode_cabang . '\' and a.kode_kategori = \'' . $kategori . '\' and a.kode_subkategori = \'' . $subkategori . '\') AS t,
                                  (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah);
    }
    return $query->num_rows();
  }

  public function getDataTableDokumenCariJml($nama_tabel, $kode_cabang, $limit, $start, $order, $arah, $kategori, $subkategori = '', $nilai, $kolom, $ckec = "", $ckel = "", $ctahun = "", $nomor_lain1 = "")
  {
    $str_query = "";
    if ($ckec <> "") {
      $str_query = $str_query . ' and jt.kode_kecamatan =\'' . $ckec . '\' ';
    }
    if ($ckel <> "") {
      $str_query = $str_query . ' and jt.kode_kelurahan =\'' . $ckel . '\' ';
    }
    if ($ctahun <> "") {
      $str_query = $str_query . ' and (jt.tahun =\'' . $ctahun . '\' or  jt.tahun_lain1 =\'' . $ctahun . '\') ';
    }
    /*
    $explo = explode('-',$nomor_lain1);
    if (strpos($nomor_lain1, '-') !== false) {
      
      $a = $explo[0];
      $b = $explo[1];
      $str_query = $str_query . " AND nomor_lain between $a and $b ";
    }else{
      if ($nomor_lain1 <> "") {
        $str_query = $str_query . " AND ((SUBSTRING_INDEX(nomor_lain,'-',$nomor_lain1) <= 1 AND SUBSTRING_INDEX(nomor_lain,'-',-1) >=$nomor_lain1) OR nomor_lain = $nomor_lain1) ";
      }
    }
    */

    if ($nomor_lain1 <> "") {
      $str_query = $str_query . " AND (nomor_lain = '$nomor_lain1' or upper(trim(LEADING 0 from nomor_lain)) = '$nomor_lain1')";
    }

    if ($nilai <> "") {
      //$str_query = $str_query . ' and upper(jt.' . $kolom . ') like \'%' . $nilai . '%\' ';
      $nilai1 = strtoupper($nilai);
      if ($kolom == 'nama_dokumen') {
        //$str_query = $str_query . ' and upper(jt.' . $kolom . ') like \'%' . $nilai . '%\' ';
        $str_query = $str_query . " and upper(jt.$kolom) like '%$nilai1%' ";
      } else {
        //$str_query = $str_query . ' and jt.' . $kolom . ' = \'' . $nilai . '\' ';
        $str_query = $str_query . " and (UPPER(TRIM(LEADING 0 from jt.$kolom)) = '$nilai1' or UPPER(jt.$kolom) = '$nilai1')";
      }
    }

    if ($start == 0) {
      $start = 1;
    }
    $start = ($start - 1) * $limit;
    $end = $start + $limit;
    if ($subkategori == '' || $subkategori == '-') {
      $query = $this->db->query('SELECT 
                                  @i:=@i+1 AS rnum, 
                                  t.*
                              FROM 
                                  (select * from (select a.id_dokumen,a.nomor_dokumen,a.nama_dokumen,a.kode_kategori,b.nama_kategori,
                                    a.kode_subkategori,c.nama_subkategori,a.kode_kecamatan,d.nama_kecamatan,
                                    a.kode_kelurahan,e.nama_kelurahan,tahun,nomor_rak,a.kode_cabang,a.status,a.nomor_lain,a.tahun_lain1,a.tahun_lain2
                                    from dokumen a
                                    left join mst_kategori b on a.kode_kategori = b.kode_kategori and a.kode_cabang = b.kode_cabang
                                    left join mst_subkategori c on a.kode_subkategori = c.kode_subkategori and a.kode_cabang = c.kode_cabang and c.kode_kategori = b.kode_kategori 
                                    left join mst_kecamatan d on a.kode_kecamatan = d.kode_kecamatan and a.kode_cabang = d.kode_cabang
                                    left join mst_kelurahan e on a.kode_kelurahan = e.kode_kelurahan and a.kode_cabang = e.kode_cabang and e.kode_kecamatan= d.kode_kecamatan ) as jt 
                                  where jt.kode_cabang = \'' . $kode_cabang . '\' and jt.kode_kategori = \'' . $kategori . '\' ' . $str_query . ' ) AS t,
                                  (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah);
    } else {

      $query = $this->db->query('SELECT 
                                  @i:=@i+1 AS rnum, 
                                  t.*
                              FROM 
                                  (select * from (select a.id_dokumen,a.nomor_dokumen,a.nama_dokumen,a.kode_kategori,b.nama_kategori,
                                    a.kode_subkategori,c.nama_subkategori,a.kode_kecamatan,d.nama_kecamatan,
                                    a.kode_kelurahan,e.nama_kelurahan,tahun,nomor_rak,a.kode_cabang,a.status,a.nomor_lain,a.tahun_lain1,a.tahun_lain2
                                    from dokumen a
                                    left join mst_kategori b on a.kode_kategori = b.kode_kategori and a.kode_cabang = b.kode_cabang
                                    left join mst_subkategori c on a.kode_subkategori = c.kode_subkategori and a.kode_cabang = c.kode_cabang and c.kode_kategori = b.kode_kategori 
                                    left join mst_kecamatan d on a.kode_kecamatan = d.kode_kecamatan and a.kode_cabang = d.kode_cabang
                                    left join mst_kelurahan e on a.kode_kelurahan = e.kode_kelurahan and a.kode_cabang = e.kode_cabang and e.kode_kecamatan= d.kode_kecamatan) as jt
                                  where jt.kode_cabang = \'' . $kode_cabang . '\' and jt.kode_kategori = \'' . $kategori . '\' and jt.kode_subkategori = \'' . $subkategori . '\' ' . $str_query . ') AS t,
                                  (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah);
    }
    return $query->num_rows();
  }

  //------------------------------------------------

  public function getJumlahRecordSelf($nama_tabel, $kode_cabang, $nik)
  {
    $data = $this->db->query('select count(*) jumlah from ' . $nama_tabel . ' where kode_cabang = \'' . $kode_cabang . '\' and nomor_induk = \'' . $nik . '\'');

    $hasil = $data->first_row();
    return $hasil->jumlah;
  }
  public function getJumlahRecordCariSelf($nama_tabel, $kode_cabang, $nilai, $kolom, $nik)
  {
    if ($nama_tabel == 'mst_kelurahan') {
      $data = $this->db->query('(select count(*) jumlah from(select a.kode_cabang,b.kode_kecamatan,b.nama_kecamatan,a.kode_kelurahan,a.nama_kelurahan 
                                  from mst_kelurahan a 
                                  left join mst_kecamatan b on a.kode_kecamatan = b.kode_kecamatan and a.kode_cabang = b.kode_cabang 
                                  ) as jt where jt.kode_cabang = \'' . $kode_cabang . '\' and upper(jt.' . $kolom . ') like \'%' . $nilai . '%\')');
    } elseif ($nama_tabel == 'mst_subkategori') {
      $data = $this->db->query('(select count(*) jumlah from(select a.kode_cabang,b.kode_kategori,b.nama_kategori,a.kode_subkategori,a.nama_subkategori,a.keterangan 
                                  from mst_subkategori a 
                                  left join mst_kategori b on a.kode_kategori = b.kode_kategori and a.kode_cabang = b.kode_cabang 
                                  ) as jt where jt.kode_cabang = \'' . $kode_cabang . '\' and upper(jt.' . $kolom . ') like \'%' . $nilai . '%\')');
    } else {
      $data = $this->db->query('select count(*) jumlah from ' . $nama_tabel . ' where kode_cabang = \'' . $kode_cabang . '\' and upper(' . $kolom . ') like \'%' . $nilai . '%\' and nomor_induk = \'' . $nik . '\'');
    }
    $hasil = $data->first_row();
    return $hasil->jumlah;
  }

  public function getDataTableSelf($nama_tabel, $kode_cabang, $limit, $start, $order, $arah, $nik)
  {
    if ($start == 0) {
      $start = 1;
    }
    $start = ($start - 1) * $limit;
    $end = $start + $limit;

    $query = $this->db->query('SELECT 
                                  @i:=@i+1 AS rnum, 
                                  t.*
                              FROM 
                                  (select * from ' . $nama_tabel . ' where kode_cabang = \'' . $kode_cabang . '\' and nomor_induk = \'' . $nik . '\') AS t,
                                  (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah . '
                              limit ' . $limit . ' offset ' . $start);

    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }

  public function getDataTableCariSelf($nama_tabel, $kode_cabang, $limit, $start, $order, $arah, $nilai, $kolom, $nik)
  {
    if ($start == 0) {
      $start = 1;
    }
    $start = ($start - 1) * $limit;
    $end = $start + $limit;

    $query = $this->db->query('SELECT 
                                  @i:=@i+1 AS rnum, 
                                  t.*
                              FROM 
                                  (select * from ' . $nama_tabel . ' where kode_cabang = \'' . $kode_cabang . '\' and upper(' . $kolom . ') like \'%' . $nilai . '%\' and nomor_induk = \'' . $nik . '\') AS t,
                                  (SELECT @i:=' . $start . ') AS foo order by ' . $order . ' ' . $arah . '
                              limit ' . $limit . ' offset ' . $start);

    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }

  //-------------------------------
}
