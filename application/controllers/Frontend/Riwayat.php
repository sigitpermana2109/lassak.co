<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('email')) {
		} else{
			redirect('Auth_member');
		}
		$this->load->model('Frontend/M_keranjang');
		$this->load->model('Frontend/M_riwayat');
		$this->load->model('Admin/M_transaksi');
	}

	public function index()
	{
		$data["user"] 			 = $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->row_array();
		$data["getMenunggu_konfirmasi"] = $this->M_riwayat->getMenunggu_konfirmasi($data['user']['id_member'] );
		$data["getPesanan_diproses"] = $this->M_riwayat->getPesanan_diproses($data['user']['id_member'] );
		$data["getSedang_dikirim"] = $this->M_riwayat->getSedang_dikirim($data['user']['id_member'] );
		$data["getSampai_tujuan"] = $this->M_riwayat->getSampai_tujuan($data['user']['id_member'] );
		$data["getSelesai"] = $this->M_riwayat->getSelesai($data['user']['id_member'] );
		$data["getPesanan_dibatalkan"] = $this->M_riwayat->getPesanan_dibatalkan($data['user']['id_member'] );
		$data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
		$data["menunggu_pembayaran"] = $this->M_keranjang->menunggu_pembayaran($data['user']['id_member']);
		$data["getMenunggu"]		 = $this->M_keranjang->getMenunggu($data['user']['id_member']);
		$id = $this->M_transaksi->get_last_id('id_transaksi', 't_transaksi');
		$data["detail_transaksi"]	= $this->M_transaksi->getNewDetailTransaksi($data['user']['id_member'], $id['id_transaksi']);
		$data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
		$data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
		$data["getDetail"]	= $this->M_riwayat->getDetailPesanan($data['user']['id_member']);
		$data["getRating"]	= $this->M_riwayat->getDataRating($data['user']['id_member']);

		$this->load->view('Frontend/Riwayat', $data);
	}
}
