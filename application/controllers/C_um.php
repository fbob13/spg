<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_um extends CI_Controller
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
	public function edit()
	{
		$cek = $this->session->userdata('asm_st');
		//$cek = $this->session->userdata('logged_in');
		if (empty($cek) || $cek <> "yes") {
			return $this->load->view('auth/v_login');
		}

		$data['link'] = 'um';
		$data['sublink'] = 'edit';
		$data['subsublink'] = '';

		$data['title'] = 'Edit User Manual - ' . $this->config->item('app_name');;
		$data['cust_css'] = '';
		$data['cust_js'] = '<script src="' . base_url() . 'dist/libs/ckeditor5/ckeditor.js"></script>';


		(isset($_POST['content']))                 ? $content = $_POST['content']     : $content = 'xcvx';

		if (isset($_POST['content'])) {
			
			$myfile = fopen("application/views/tabler/um/v_um_content.php", "w") or die("Unable to open file!");
			fwrite($myfile, $content);
			fclose($myfile);
			$data['content']= $content;

		} else {
			$myfile = fopen("application/views/tabler/um/v_um_content.php", "r") or die("Unable to open file!");
			$data['content'] = fread($myfile,50000);
			fclose($myfile);
		}


		//echo json_encode($data);
		//return;


		$this->load->view('tabler/a_header', $data);
		$this->load->view('tabler/um/v_um_edit.php', $data);
		$this->load->view('tabler/a_footer', $data);
		$this->load->view('tabler/um/v_um_edit_js.php', $data);
		$this->load->view('tabler/a_end_page', $data);
	}

	public function um()
	{
		$cek = $this->session->userdata('asm_st');
		//$cek = $this->session->userdata('logged_in');
		if (empty($cek) || $cek <> "yes") {
			return $this->load->view('auth/v_login');
		}

		$data['link'] = 'um';
		$data['sublink'] = 'edit';
		$data['subsublink'] = '';

		$data['title'] = 'User Manual - ' . $this->config->item('app_name');;
		$data['cust_css'] = '';
		$data['cust_js'] = '';




		//echo json_encode($data);
		//return;
		$this->load->view('tabler/a_header', $data);

		$this->load->view('tabler/um/v_um_start.php', $data);
		$this->load->view('tabler/um/v_um_content.php', $data);
		$this->load->view('tabler/um/v_um_end.php', $data);
		
		$this->load->view('tabler/a_footer', $data);
		$this->load->view('tabler/um/v_um_js.php', $data);
		$this->load->view('tabler/a_end_page', $data);
	}

	public function data()
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
		elseif ($this->session->userdata('spc') == 1 or $this->session->userdata('spc') == 99 or $this->session->userdata('spc') == 0 or $this->session->userdata('spc') == 2) {

			$tipe = ($this->uri->segment(3)) ? $this->uri->segment(3) : 'tipe';
			$bulan = ($this->uri->segment(4)) ? $this->uri->segment(4) : 'bulan';
			$tahun = date('Y');
			if ($tipe == 1) {	// rutin nonrutin
				$query = $this->db->query("select count(*) as total from as_rutin where DATE_FORMAT(tanggal_jadwal,'%Y-%m') = '$tahun-$bulan'");
				$result = $query->first_row();
				$data['rutin'] = $result->total;

				$query = $this->db->query("select count(*) as total from as_nonrutin where DATE_FORMAT(tanggal_laporan,'%Y-%m') = '$tahun-$bulan'");
				$result = $query->first_row();
				$data['nonrutin'] = $result->total;
			} else if ($tipe == 2) { // nonrutin by status
				$data['belum'] = $data['progres'] = $data['pending'] = $data['selesai'] = $data['tidak'] = $data['approve'] = 0;
				$query = $this->db->query("SELECT status_pekerjaan, COUNT(id_nonrutin) jumlah from as_nonrutin where DATE_FORMAT(tanggal_laporan,'%Y-%m') = '$tahun-$bulan' GROUP BY status_pekerjaan");
				$result = $query->result();
				foreach ($result as $res) {
					if ($res->status_pekerjaan == 0) $data['belum'] = $res->jumlah;
					else if ($res->status_pekerjaan == 1) $data['pending'] = $res->jumlah;
					else if ($res->status_pekerjaan == 2) $data['selesai'] = $res->jumlah;
					else if ($res->status_pekerjaan == 3) $data['tidak'] = $res->jumlah;
					else if ($res->status_pekerjaan == 4) $data['approve'] = $res->jumlah;
				}
			} else if ($tipe == 3) { // nonrutin by prioritas
				$data['rendah'] = $data['menengah'] = $data['tinggi'] = $data['urgent'] = 0;
				$query = $this->db->query("SELECT prioritas, COUNT(id_nonrutin) jumlah from as_nonrutin where DATE_FORMAT(tanggal_laporan,'%Y-%m') = '$tahun-$bulan' GROUP BY prioritas");
				$result = $query->result();
				$result = $query->result();
				foreach ($result as $res) {
					if ($res->prioritas == 1) $data['rendah'] = $res->jumlah;
					else if ($res->prioritas == 2) $data['menengah'] = $res->jumlah;
					else if ($res->prioritas == 3) $data['tinggi'] = $res->jumlah;
					else if ($res->prioritas == 4) $data['urgent'] = $res->jumlah;
				}
			}


			$data['status'] = 'ok';
		}
		//Jika bukan kembali ke base_url (home)
		else {
			$data['status'] = 'nok';
			$data['info'] = 'Anda Tidak Berhak';
		}

		echo json_encode($data);


		//END FUNCTION
	}


	public function editx()
	{
		//Cek jika user Login / variabel "asm_st" ada di session
		//Kalau sudah login, variabel "asm_st" = "yes"
		$cek = $this->session->userdata('asm_st');
		$spc = $this->session->userdata('spc');
		if (empty($cek) || $cek <> "yes") {
			return $this->load->view('auth/v_login');
		}
		//Jika User = 99(IT) atau 1(admin)

		if ($this->Login_model->cekLogin('REP', 'view')) {
			$data['link'] = 'report';
			$data['sublink'] = '';
			$data['subsublink'] = '';

			$data['title'] = 'Report - ' . $this->config->item('app_name');

			//CSS untuk menampilkan tabel (datatables)
			$data['cust_css'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'dist/libs/DataTables/datatables.min.css"/>';

			//JS untuk menampilkan tabel (datatables)
			$data['cust_js'] = '<script src="' . base_url() . 'dist/libs/DataTables/datatables.min.js"></script>
            <script src="' . base_url() . 'dist/libs/litepicker/dist/litepicker.js"></script>';

			$hari = date("Y-m-d");
			(isset($_POST['type']))                 ? $type = $_POST['type']     : $type = 0;
			(isset($_POST['qs-tanggal-awal']))                 ? $tanggal_awal = $_POST['qs-tanggal-awal']     : $tanggal_awal = $hari;
			(isset($_POST['qs-tanggal-akhir']))                 ? $tanggal_akhir = $_POST['qs-tanggal-akhir']     : $tanggal_akhir = $hari;
			(isset($_POST['qs-status']))                 ? $status = $_POST['qs-status']     : $status = 99;
			(isset($_POST['qs-teknisi']))                 ? $teknisi = $_POST['qs-teknisi']     : $teknisi = '';


			$data['type'] = $type;
			$data['tanggal_awal'] = $tanggal_awal;
			$data['tanggal_akhir'] = $tanggal_akhir;
			$data['status'] = $status;
			$data['teknisi'] = $teknisi;



			$query = $this->db->query('select id_user,nama from mst_user where spc = 0');
			$data['data_teknisi'] = $query->result();



			$this->load->view('tabler/a_header', $data);
			$this->load->view('tabler/report/v_report', $data);
			$this->load->view('tabler/a_footer');
			$this->load->view('tabler/report/v_report_js', $data);
			$this->load->view('tabler/a_end_page');
		}
		//Jika bukan kembali ke base_url (home)
		else {
			redirect(base_url());
		}
	}
}
