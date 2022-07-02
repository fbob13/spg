<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_index extends CI_Controller
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
	public function index()
	{
		$cek = $this->session->userdata('asm_st');
		//$cek = $this->session->userdata('logged_in');
		if (empty($cek) || $cek <> "yes") {
			return $this->load->view('auth/v_login');
		}

		$data['link'] = 'dashboard';
		$data['sublink'] = '';
		$data['subsublink'] = '';

		$data['title'] = 'Dashboard - ' . $this->config->item('app_name');;
		$data['cust_css'] = '';
		$data['cust_js'] = '<script src="' . base_url() . 'dist/libs/apexcharts/dist/apexcharts.min.js"></script>';

		$tanggal = date('Y-m');

		$query = $this->db->query("select count(*) as total from as_rutin where DATE_FORMAT(tanggal_jadwal,'%Y-%m') = '$tanggal'");
		$result = $query->first_row();
		$data['rutin'] = $result->total;

		$query = $this->db->query("select count(*) as total from as_nonrutin where DATE_FORMAT(tanggal_laporan,'%Y-%m') = '$tanggal'");
		$result = $query->first_row();
		$data['nonrutin'] = $result->total;

		$data['belum'] = $data['progres'] = $data['pending'] = $data['selesai'] = $data['tidak'] = $data['approve'] = 0;
		$query = $this->db->query("SELECT status_pekerjaan, COUNT(id_nonrutin) jumlah from as_nonrutin where DATE_FORMAT(tanggal_laporan,'%Y-%m') = '$tanggal' GROUP BY status_pekerjaan");
		$result = $query->result();
		foreach ($result as $res) {
			if ($res->status_pekerjaan == 0) $data['belum'] = $res->jumlah;
			else if ($res->status_pekerjaan == 1) $data['pending'] = $res->jumlah;
			else if ($res->status_pekerjaan == 2) $data['selesai'] = $res->jumlah;
			else if ($res->status_pekerjaan == 3) $data['tidak'] = $res->jumlah;
			else if ($res->status_pekerjaan == 4) $data['approve'] = $res->jumlah;
		}

		$data['rendah'] = $data['menengah'] = $data['tinggi'] = $data['urgent'] = 0;
		$query = $this->db->query("SELECT prioritas, COUNT(id_nonrutin) jumlah from as_nonrutin where DATE_FORMAT(tanggal_laporan,'%Y-%m') = '$tanggal' GROUP BY prioritas");
		$result = $query->result();
		$result = $query->result();
		foreach ($result as $res) {
			if ($res->prioritas == 1) $data['rendah'] = $res->jumlah;
			else if ($res->prioritas == 2) $data['menengah'] = $res->jumlah;
			else if ($res->prioritas == 3) $data['tinggi'] = $res->jumlah;
			else if ($res->prioritas == 4) $data['urgent'] = $res->jumlah;
		}

		//echo json_encode($data);
		//return;
		$this->load->view('tabler/a_header', $data);
		$this->load->view('tabler/v_home', $data);
		$this->load->view('tabler/a_footer', $data);
		$this->load->view('tabler/v_home_js', $data);
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
		elseif ($this->session->userdata('spc') == 1 or $this->session->userdata('spc') == 99) {

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

	public function info()
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
		elseif ($this->session->userdata('spc') == 1 or $this->session->userdata('spc') == 99) {

			$tipe = ($this->uri->segment(3)) ? $this->uri->segment(3) : 'tipe';
			$tanggal = date('Y-m-d');
			if ($tipe == 'rutin') {
				$query = $this->db->query("select * from view_rutin where status_pekerjaan not in (3,5) and tanggal_jadwal='$tanggal' order by tanggal_jadwal,status_pekerjaan");
				$result = $query->result();
				$data['data'] = $result;
			} else if ($tipe == 'nonrutin') {
				$query = $this->db->query("select * from view_nonrutin where  status_pekerjaan not in (3,5) order by prioritas desc, tanggal_laporan asc");
				$result = $query->result();
				$data['data'] = $result;
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

	public function login()
	{
		$u = $this->input->post('nik');

		$p = $this->input->post('password');

		$this->Login_model->getLoginData($u, $p);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		header('location:' . base_url());
	}


	public function reset()
	{

		$this->session->sess_destroy();

		$data['title'] = 'Reset Password';

		$this->load->view('auth/v_reset', $data);
	}

	public function reset_send()
	{
		$this->load->library('email');

		$data = array();
		if (isset($_POST['email'])) {
			$email = $_POST['email'];
			$query = $this->db->get_where('mst_user', array('email' => $email));

			if (($query->num_rows() > 0)) {
				$data['status'] = 'ok';

				//SETTING EMAIL
				$query2 = $this->db->get('set_web');
				$setting = $query2->first_row();
				$config['protocol'] = 'smtp';
				$config['smtp_crypto'] = 'ssl';
				$config['smtp_host'] = 'smtp.hostinger.com';
				$config['smtp_port'] = '465';
				$config['smtp_user'] = $setting->email;
				$config['smtp_pass'] = $setting->pass_email;
				$config['newline'] = "\r\n";
				$config['crlf'] = "\r\n";
				$config['charset'] = "utf-8";
				$config['mailtype'] = "html";

				$this->email->initialize($config);

				//SEND EMAIL
				$this->email->from($setting->email, 'E-Warkah');
				$this->email->to($email);

				$this->email->subject('Reset Password Aplikasi E-Warkah');
				$password_baru = $this->random_str(8);



				$this->email->message('<html>
				<body>
					<p> Halo </p>
					<p>Anda telah melakukan permintaan untuk mereset password.</p>
					<p>Password baru anda : <b style="color:red;">' . $password_baru . '</b></p>
					<p>Silahkan melakukan login dengan password baru dan melakukan penggantian password.
					<br><br><br>
					<p><a href="' . base_url() . '" class="link-secondary">Aplikasi E-Warkah</a><br>Copyright &copy; 2022 BPN Kota Palopo. All rights reserved.
					</p>
				</body>
				</html>');

				$kirim_email = $this->email->send();
				if ($kirim_email) {
					//Reset Password di database
					$this->db->query('update mst_user set password = \'' . md5($password_baru) . '\' where email = \'' . $email . '\'');

					$data['status'] = 'ok';
					$data['info'] = "Email Berhasil di kirim";
					//$data['error'] = $this->email->print_debugger();
				} else {
					$data['status'] = 'nok';
					$data['info'] = "Email gagal terkirim";
					//$data['error'] = $this->email->print_debugger();
				}
			} else {
				$data['status'] = 'nok';
				$data['info'] = "Email tidak terdaftar";
			}
		} else {
			$data['status'] = 'nok';
			$data['info'] = "Silahkan masukkan alamat email anda";
		}

		$data['title'] = 'Reset Password - E-Warkah';


		echo json_encode($data);
	}

	public function test_email()
	{
		$config['protocol'] = 'smtp';
		$config['smtp_crypto'] = 'ssl';
		$config['smtp_host'] = 'smtp.hostinger.com';
		$config['smtp_port'] = '465';
		$config['smtp_user'] = 'xx@gmail.com';
		$config['smtp_pass'] = '';
		$config['newline'] = "\r\n";
		$config['crlf'] = "\r\n";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";

		$this->email->initialize($config);

		//SEND EMAIL
		$this->email->from('cclasha01@gmail.com', 'E');
		$this->email->to('frits130by@gmail.com');

		$this->email->subject('Reset Password Aplikasi E');
		$password_baru = $this->random_str(8);



		$this->email->message('<html>
				<body>
					<p> Halo </p>
					<p>Anda telah melakukan permintaan untuk mereset password.</p>
					<p>Password baru anda : <b style="color:red;"></b></p>
					<p>Silahkan melakukan login dengan password baru dan melakukan penggantian password.
					<br><br><br>
					<p><a href="' . base_url() . '" class="link-secondary">Aplikasi E-Warkah</a><br>Copyright &copy; 2022 BPN Kota Palopo. All rights reserved.
					</p>
				</body>
				</html>');

		$kirim_email = $this->email->send();

		$data['status'] = 'ok';
		$data['info'] = "Email Berhasil di kirim";
		$data['error'] = $this->email->print_debugger();
		echo json_encode($data);
	}

	function random_str(
		int $length = 64,
		string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
	): string {
		if ($length < 1) {
			throw new \RangeException("Length must be a positive integer");
		}
		$pieces = [];
		$max = mb_strlen($keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; ++$i) {
			$pieces[] = $keyspace[random_int(0, $max)];
		}
		return implode('', $pieces);
	}
}
