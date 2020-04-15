<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('email')) {
		} else{
			redirect('Auth_member');
		}
		$this->load->model('Frontend/M_keranjang');
		$this->load->model('Admin/M_transaksi');
		$this->load->model('Admin/M_barang');
	}

	public function index()
	{
		$data["user"] 	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->row_array();
		$data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
		$data["member"] = $this->M_transaksi->getMember($data['user']['id_member']);
		$data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
		$data["data_keranjang"] = $this->M_keranjang->getKeranjang($data['user']['id_member']);
		$data["total_bayar"] = $this->M_keranjang->getTotalBayar($data['user']['id_member']);
		$data["bank"] = $this->M_transaksi->getBank();
		$data["provinsi"] = $this->M_keranjang->get_provinsi();
		$data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
		$data["ongkir"] = $this->M_transaksi->getOngkir($data['member']['id_kota']);
		$data["alamat"] = $this->M_keranjang->getAlamat($data['user']['id_member']);

		$harga_total = 0;
		foreach($_POST['harga'] as $item)
		{
			$harga_total += (int)$item;
		}
		$data['total']= $harga_total;

		$jumlah_total = 0;
		foreach($_POST['jumlah'] as $item)
		{
			$jumlah_total += ((int)$item);
		}
		$data['jumlah']= $jumlah_total;
		$data['id'] = $_POST['id'];
		$this->load->view('Frontend/Checkout', $data);
	}	

	public function get_detail_ongkir(){
		$id=$this->input->post('id');
		$data=$this->M_keranjang->get_detail_ongkir($id);
		echo json_encode($data);
	}

	public function tambahAlamat()
	{
		$id_member 		=  $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->		row_array();
		$id_provinsi    = $_POST['id_provinsi'];
		$id_kota	    = $_POST['id_kota'];
		$id_kecamatan   = $_POST['id_kecamatan'];
		$id_kelurahan   = $_POST['id_kelurahan'];
		$kode_pos       = $_POST['kode_pos'];
		$alamat	        = $_POST['alamat'];

		$data = array(

			'id_member' 	=> $id_member['id_member'],		
			'alamat' 		=> $alamat,
			'id_provinsi'	=> $id_provinsi,
			'id_kota' 		=> $id_kota,
			'id_kecamatan' 	=> $id_kecamatan,
			'id_kelurahan'	=> $id_kelurahan,
			'kode_pos'		=> $kode_pos
		);

		$add = $this->M_keranjang->insertAlamat('t_detail_alamat', $data);
		if ($add > 0) {
			$this->session->set_flashdata('berhasil', 'Data berhasil disimpan !');
			redirect('Frontend/Shop/tampil_keranjang');
		} else {
			echo "gagal";
		}

	}

	public function updateAlamat($id)
	{
		$id_member	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->row_array();
		$data = ['status' => 'arsip'];
		$this->M_transaksi->updateAlamat($id_member['id_member'], $data);
		$publik = ['status' => 'publik'];
		$this->M_transaksi->updateStatusAlamat($id, $publik);
		redirect('Frontend/Shop/tampil_keranjang');
	}

	public function proses_pesanan()
	{
		
		$data["user"] 	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->row_array();
		$data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
		$data["member"] = $this->M_transaksi->getMember($data['user']['id_member']);
		$data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
		$data["data_keranjang"] = $this->M_keranjang->getKeranjang($data['user']['id_member']);
		$data["total_bayar"] = $this->M_keranjang->getTotalBayar($data['user']['id_member']);
		$data["bank"] = $this->M_transaksi->getBank();
		$data["provinsi"] = $this->M_keranjang->get_provinsi();
		$data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
		$data["ongkir"] = $this->M_transaksi->getOngkir($data['member']['id_kota']);
		$data["alamat"] = $this->M_keranjang->getAlamat($data['user']['id_member']);
		
		if (!empty($data['nav_keranjang'])) {
			
			date_default_timezone_set('Asia/Jakarta');
			$id_member	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->row_array();
			$id_bank		= $_POST['id_bank'];
			$id_ongkir		= $_POST['id_ongkir'];   
			$total_bayar	= $_POST['total_bayar'];
			$id_alamat 		= $_POST['id_alamat'];

			$id = $this->M_transaksi->get_last_id('id_transaksi', 't_transaksi');
			$id_transaksi = ltrim($id['id_transaksi'], "TR");
			$id_transaksi = sprintf('%04d', $id_transaksi + 1);
			$id_transaksi = "TR".$id_transaksi;

			$transaksi = array(
				'id_transaksi'		=> $id_transaksi,
				'id_member'			=> $id_member['id_member'],
				'id_alamat'			=> $id_alamat,
				'id_bank'			=> $id_bank,
				'id_ongkir' 		=> $id_ongkir,
				'total_bayar'		=> $total_bayar,
				'tanggal_transaksi' => date('Y-m-d H:i:s'),
				'batas_bayar'		=> date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y'))),
			);

			$add = $this->M_transaksi->tambahTransaksi('t_transaksi', $transaksi);

			foreach ($_POST['id'] as $key) {
				$this->M_transaksi->tambahDetail($id_transaksi, $id_member['id_member'], $key);
				$this->M_transaksi->destroy_keranjang($key, 't_keranjang');
			}

			$email = $this->send();

			if ($add > 0) {
				$this->session->set_flashdata('berhasil', 'Data berhasil disimpan !');
				redirect('Frontend/Checkout/pembayaran_berhasil');
			} else {
				$this->session->set_flashdata('gagal', 'Data gagal disimpan !');
				redirect('Frontend/Checkout');
			}

		}else{
			$this->session->set_flashdata('Kosong', 'Data gagal disimpan !');
			redirect('Frontend/Checkout');
		}	
	}

	public function send()
	{
		$this->load->view('_layout_frontend/head.php');
		$from_email = "lassakco75@gmail.com"; 
		$to_email = $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->row_array();
		$data["user"] 	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->row_array();
		$data["data_keranjang"] = $this->M_keranjang->getKeranjang($data['user']['id_member']);
		$data["new_transaksi"]	= $this->M_transaksi->getNewTransaksi($data['user']['id_member']);
		$id = $this->M_transaksi->get_last_id('id_transaksi', 't_transaksi');
		$data["detail_transaksi"]	= $this->M_transaksi->getNewDetailTransaksi($data['user']['id_member'], $id['id_transaksi']);    
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => $from_email,
			'smtp_pass' => 'qazwsx12@',
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1',
			'wordwrap'	=> TRUE
		);

		$this->load->library('email', $config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");   
		$message="
		
		<div class='row card shadow col-lg-10 mx-auto d-block'>
		<h3 class='text-center my-5'>Segera Selesaikan Pembayaran Anda</h3>
		<div class='col-lg-8 bg-secondary p-5 my-2 mx-auto d-block'>
		<h4 class='text-center text-white'>Bayar sebelum :</h4>
		<h2 class='text-center text-white'>
		".date('d M Y, H.i', strtotime($data['new_transaksi']['batas_bayar']))." WIB
		</h2>
		</div>

		<div class='col-lg-8 bg-warning p-3 my-4 mx-auto d-block'>
		<h5 class='text-center'>Pastikan untuk tidak menginformasikan bukti dan data pembayaran kepada pihak manapun kecuali Lassak.co.</h5>
		</div>

		<div class='col-lg-8 p-3 my-2 mx-auto d-block'>
		<h5>Transfer pembayaran ke nomor rekening :</h5>
		<h3 class='mx-4'> ".$data['new_transaksi']['no_rekening']." (".$data['new_transaksi']['nama_bank'].")</h3>
		<h5>a/n ".$data['new_transaksi']['nama_pemilik']."</h5>
		</div>

		<div class='col-lg-8 p-3 my-2 mx-auto d-block'>
		<h5>Jumlah yang harus di bayar :</h5>
		<h3 class='text-danger'>Rp. ".number_format($data['new_transaksi']['total_bayar'], 0, ',', '.')."</h3>
		</div>

		<div class='col-lg-8 p-3 my-2 mx-auto d-block'>
		<h6 class='text-center'>Pastikan pembayaran Anda sudah BERHASIL dan unggah bukti untuk mempercepat proses verifikasi</h6>
		</div>

		</div> ";
		$this->email->from($from_email, 'Lassak.co E-commerce'); 
		$this->email->to($to_email['email']);
		$this->email->subject('Pembayaran Berhasil');

		$this->email->message($message);

 
		if($this->email->send()){
			$this->session->set_flashdata("berhasil","Email berhasil terkirim."); 
		}else {
			$this->session->set_flashdata("notif","Email gagal dikirim."); 
 
		} 

	}

	public function pembayaran_berhasil()
	{
		$data["user"] 	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->row_array();
		$data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
		$data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
		$data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
		$data["data_keranjang"] = $this->M_keranjang->getKeranjang($data['user']['id_member']);
		$data["new_transaksi"]	= $this->M_transaksi->getNewTransaksi($data['user']['id_member']);
		$id = $this->M_transaksi->get_last_id('id_transaksi', 't_transaksi');
		$data["detail_transaksi"]	= $this->M_transaksi->getNewDetailTransaksi($data['user']['id_member'], $id['id_transaksi']);  
		$this->load->view('Frontend/Pembayaran_berhasil', $data);
	}
}
