<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Excel_model extends CI_Model
{
    //
    public function create_template()
    {
        $this->load->library('SimpleXLSXGen');

        //Sheet 1
        $sheet1 = [
            ['<left><b><style color="#FF0000">Template Upload Jadwal</style</b></left>', null],
            [''],
            ['<left><b><style color="#FF0000">Ketentuan mengisi template</style</b></left>', null],
            ['<left>1. Isi data sesuai dengan master yang ada di sheet yang lain </left>', null],
            ['<left>2. Jika ada perbedaan huruf/kata maka data pada baris itu tidak akan tersimpan </left>', null],
            ['<left>3. Format Tanggal -> Tahun - Bulan - Tanggal contoh : <b>2022-12-30</b></left>', null],
            ['<left>4. Format Tanggal -> Pilih locale = english(U.K) ', null],
            ['<left>5. Format Tanggal -> Pastikan format kolom tanggal sesuai contoh di atas</left>', null],
            ['<left>6. <style color="#FF0000">Jangan menghapus/mengedit data yang ada di sini kecuali menginput jadwal</style></left>', null],
            [''],
            ['<left>Input data jadwal di bawah</left>', null],
            [''],
            ['<style bgcolor="#FFFF00"><b>Tanggal</b></style></border>', '<style bgcolor="#FFFF00"><b>Nama Gedung</b></style>', '<style bgcolor="#FFFF00"><b>Nama Ruangan</b></style>', '<style bgcolor="#FFFF00"><b>Nama Item</b></style>', '<style bgcolor="#FFFF00"><b>Pekerjaan</b></style>'],
        ];

        //Master Gedung
        $judul = [
            ['<left><b>Master Gedung</b></left>'],
            [''],
            ['<style bgcolor="#00FF00">Nama Gedung</style>', '<style bgcolor="#FFFF00">Keterangan</style>']
        ];
        $query = $this->db->query('select nama_gedung, keterangan from mst_gedung');
        $master_gedung = array_merge($judul, $query->result_array());

        //Master Ruangan
        $judul = [
            ['<left><b>Master Ruangan</b></left>'],
            [''],
            ['<style bgcolor="#FFFF00">Nama Gedung</style>', '<style bgcolor="#FFFF00">Kode Ruangan</style>', '<style bgcolor="#00FF00">Nama Ruangan</style>', '<style bgcolor="#FFFF00">Keterangan</style>']
        ];
        $query = $this->db->query('select nama_gedung,kode_ruangan,uraian_ruangan, keterangan from view_ruangan');
        $master_ruangan = array_merge($judul, $query->result_array());


        //Master Item
        $judul = [
            ['<left><b>Master Item</b></left>'],
            [''],
            ['<style bgcolor="#00FF00">Nama Item</style>', '<style bgcolor="#FFFF00">Merek Item</style>', '<style bgcolor="#FFFF00">Tipe Item</style>']
        ];
        $query = $this->db->query("select nama_item,merek_item,tipe_item from mst_item");
        $master_item = array_merge($judul, $query->result_array());

        //Master Pekerjaan Rutin
        $judul = [
            ['<left><b>Master Pekerjaan Rutin</b></left>'],
            [''],
            ['<style bgcolor="#00FF00">Pekerjaan</style>', '<style bgcolor="#FFFF00">Uraian Pekerjaan</style>']
        ];
        $query = $this->db->query("select jenis_pekerjaan,uraian_pekerjaan from mst_pkrutin");
        $master_pekerjaan = array_merge($judul, $query->result_array());

        //$rutin = array_merge($rutin_head,$query->result_array());




        //menulis ke excel
        $xlsx = $this->simplexlsxgen->fromArray($sheet1)->mergeCells('A1:J1')
            ->mergeCells('A3:J3')->mergeCells('A4:J4')->mergeCells('A5:J5')->mergeCells('A6:J6')
            ->mergeCells('A7:J7')->mergeCells('A8:J8')->mergeCells('A10:J10')
            ->setColWidth(1, 20)
            ->setColWidth(2, 35)
            ->setColWidth(3, 35)
            ->setColWidth(4, 35)
            ->setColWidth(5, 35)
            ->addSheet($master_gedung, 'Master Gedung')
            ->setColWidth(1, 35)
            ->setColWidth(2, 50)
            ->addSheet($master_ruangan, 'Master Ruangan')
            ->setColWidth(1, 35)
            ->setColWidth(2, 20)
            ->setColWidth(3, 40)
            ->setColWidth(4, 50)
            ->addSheet($master_item, 'Master Item')
            ->setColWidth(1, 35)
            ->setColWidth(2, 35)
            ->setColWidth(3, 35)
            ->addSheet($master_pekerjaan, 'Master Pekerjaan')
            ->setColWidth(1, 35)
            ->setColWidth(2, 50);
        //simpan file
        $xlsx->saveAs('upload/template.xlsx'); // or downloadAs('books.xlsx') or $xlsx_content = (string) $xlsx 

    }


    public function upload($nama_file, $id_teknisi, $tanggal_jadwal)
    {
        //

        $this->load->library('SimpleXLSX');
        //$this->ssp->complex($_REQUEST, $sql_details, $table, $primaryKey, $columns, '', $where)

        $target_dir = "upload/";

        if ($xlsx = $this->simplexlsx->parse($nama_file)) {
           
            $dim = $xlsx->dimension();
            $cols = $dim[0];
            $counter = 0;
            foreach ($xlsx->readRows() as $k => $r) {
                $counter = $counter + 1;
                $save = false;

                //Jika row 14 (di bawah row nama gedung)
                //sesuaikan $counter jika ada penambahan keterangan di atas row nama gedung

                if ($counter >=14 && isset($r[0]) && isset($r[1]) && isset($r[2]) && isset($r[3]) && isset($r[4])){
                    $tanggal_jadwal= $r[0];
                    $nama_gedung= strtoupper($r[1]);
                    $nama_ruangan= strtoupper($r[2]);
                    $nama_item= strtoupper($r[3]);
                    $pekerjaan= strtoupper($r[4]);

                    //master gedung
                    $query = $this->db->query("select id_gedung from mst_gedung where UPPER(nama_gedung) = '$nama_gedung'");
                    $result = $query->first_row();
                    $id_gedung = $result->id_gedung;

                    //master ruangan
                    $query = $this->db->query("select id_ruangan from mst_ruangan where UPPER(uraian_ruangan) = '$nama_ruangan'");
                    $result = $query->first_row();
                    $id_ruangan = $result->id_ruangan;

                    //master item
                    $query = $this->db->query("select id_item from mst_item where UPPER(nama_item) = '$nama_item'");
                    $result = $query->first_row();
                    $id_item = $result->id_item;

                    //master pkrutin
                    $query = $this->db->query("select id_pkrutin from mst_pkrutin where UPPER(jenis_pekerjaan) = '$pekerjaan'");
                    $result = $query->first_row();
                    $id_pkrutin = $result->id_pkrutin;


                    //insert ke draft

                    //cek kalau dobel
                    $query1 = $this->db->query("select * from as_rutin where id_user=$id_teknisi and tanggal_jadwal='$tanggal_jadwal' 
                                                     and id_gedung=$id_gedung and id_ruangan=$id_ruangan and id_item=$id_item and id_pkrutin=$id_pkrutin");
                        if ($query1->num_rows() == 0) {
                            $data_insert = array(
                                'id_pembuat' => $this->session->userdata('id_user'),
                                'id_gedung' => $id_gedung,
                                'id_ruangan' => $id_ruangan,
                                'id_item' => $id_item,
                                'id_pkrutin' => $id_pkrutin,
                                'id_user' => $id_teknisi,
                                'tanggal_jadwal' => $tanggal_jadwal,
                                'status_pekerjaan' => 0
                                //'created_at' => date("Y-m-d H:i:s")
                            );
        
                            $this->db->insert('as_rutin', $data_insert);
                        }

                }

            }

        } else {
            echo $this->simplexlsx->parseError();
        }


        return true;
    }
}
