<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('email_admin')) {
		} else{
			redirect('Auth_admin');
		}
		$this->load->model('Admin/M_laporan');
	}

	public function index()
	{
		$this->load->library('mypdf');
		$tgl_awal = $_POST['tgl_awal'];
		$tgl_akhir = $_POST['tgl_akhir'];
		$data["barang"] = $this->M_laporan->laporanPenghasilan($tgl_awal, $tgl_akhir);
		$data["total"] = $this->M_laporan->laporanPenghasilanSUM($tgl_awal, $tgl_akhir);
		$data["title"] = 'Laporan Penjualan Perbulan';
		$this->mypdf->generate('Admin/Laporan/LaporanSebulan', $data);
	}
	public function laporanBarangMasuk()
	{
		$this->load->library('mypdf');
		$tgl_awal = $_POST['tgl_awal'];
		$tgl_akhir = $_POST['tgl_akhir'];
		$data["barang"] = $this->M_laporan->laporanBarangMasuk($tgl_awal, $tgl_akhir);
		$data["title"] = 'Laporan Barang Masuk';
		$this->mypdf->generate('Admin/Laporan/LaporanBarangMasuk', $data);
	}
}
