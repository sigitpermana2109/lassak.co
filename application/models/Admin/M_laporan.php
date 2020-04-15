<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{


	public function laporanPenghasilanSUM($tgl_awal, $tgl_akhir)
	{
		$query = $this->db->query("SELECT SUM(jumlah_barang*harga) AS total_penghasilan FROM laporan_penghasilan WHERE tanggal_transaksi >= '$tgl_awal' AND tanggal_transaksi <= '$tgl_akhir'");
		return $query->row_array();
	}

	public function laporanPenghasilan($tgl_awal, $tgl_akhir)
	{
		$this->db->select('*');
		$this->db->where('tanggal_transaksi >=', $tgl_awal);
		$this->db->where('tanggal_transaksi <=', $tgl_akhir);
		$query = $this->db->get('laporan_penghasilan');
		return $query->result_array();
	}
	public function laporanBarangMasuk($tgl_awal, $tgl_akhir)
	{
		$this->db->select('*');
		$this->db->where('date_created >=', $tgl_awal);
		$this->db->where('date_created <=', $tgl_akhir);
		$query = $this->db->get('barang_masuk');
		return $query->result_array();
	}
}
