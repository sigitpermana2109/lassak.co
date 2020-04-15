<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Frontend/M_keranjang');
		$this->load->model('Admin/M_transaksi');

	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			$data["user"] 	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->		row_array();
			$data["member"] = $this->M_transaksi->getMember($data['user']['id_member']);
			$data["kategori"] = $this->M_keranjang->getKategori();
			$data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
			$data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
			$data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
			$data['barang'] = $this->M_keranjang->maxBarang();	
		} else{
			$data["kategori"] = $this->M_keranjang->getKategori();
			$data['barang'] = $this->M_keranjang->maxBarang();
		}
		$this->load->view('Frontend/Home', $data);
	}
}
