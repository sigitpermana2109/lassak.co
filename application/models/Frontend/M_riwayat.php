<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_riwayat extends CI_Model {

	public function getMenunggu_konfirmasi($id)
	{
		$this->db->select('*');
		$this->db->join('t_detail_transaksi', 't_detail_transaksi.id_transaksi=t_transaksi.id_transaksi');
		$this->db->join('t_bank', 't_transaksi.id_bank=t_bank.id_bank');
		$this->db->join('t_ongkir', 't_transaksi.id_ongkir=t_ongkir.id_ongkir');
		$this->db->join('t_barang', 't_detail_transaksi.id_barang=t_barang.id_barang');
		$this->db->where('t_transaksi.id_member', $id);
		$this->db->where('t_transaksi.status_transaksi', 'Menunggu Konfirmasi');
		$this->db->group_by('t_transaksi.id_transaksi');
		$query = $this->db->get('t_transaksi');
		return $query->result_array();
	}

	public function getRowMenunggu_konfirmasi($id)
	{
		$query = $this->db->query("SELECT * FROM t_transaksi WHERE id_member='$id' AND status_transaksi='Menunggu Konfirmasi'");
		return $query->row_array();
	}

	public function getMenunggu($id)
	{
		$query = $this->db->query("SELECT * FROM t_transaksi INNER JOIN t_bank ON t_transaksi.id_bank=t_bank.id_bank WHERE id_member='$id' AND status_transaksi='Menunggu Pembayaran'");
		return $query->row_array();
	}

	public function getPesanan_diproses($id)
	{
		$this->db->select('*');
		$this->db->join('t_detail_transaksi', 't_detail_transaksi.id_transaksi=t_transaksi.id_transaksi');
		$this->db->join('t_bank', 't_transaksi.id_bank=t_bank.id_bank');
		$this->db->join('t_ongkir', 't_transaksi.id_ongkir=t_ongkir.id_ongkir');
		$this->db->join('t_barang', 't_detail_transaksi.id_barang=t_barang.id_barang');
		$this->db->where('t_transaksi.id_member', $id);
		$this->db->where('t_transaksi.status_transaksi', 'Pesanan Diproses');
		$this->db->group_by('t_transaksi.id_transaksi');
		$query = $this->db->get('t_transaksi');
		return $query->result_array();
	}

	public function getRowPesanan_diproses($id)
	{
		$query = $this->db->query("SELECT * FROM t_transaksi where status_transaksi='Pesanan Diproses'");
		return $query->row_array();
	}

	public function getSedang_dikirim($id)
	{
		
		$this->db->select('*');
		$this->db->join('t_detail_transaksi', 't_detail_transaksi.id_transaksi=t_transaksi.id_transaksi');
		$this->db->join('t_bank', 't_transaksi.id_bank=t_bank.id_bank');
		$this->db->join('t_ongkir', 't_transaksi.id_ongkir=t_ongkir.id_ongkir');
		$this->db->join('t_barang', 't_detail_transaksi.id_barang=t_barang.id_barang');
		$this->db->where('t_transaksi.id_member', $id);
		$this->db->where('t_transaksi.status_transaksi', 'Sedang Dikirim');
		$this->db->group_by('t_transaksi.id_transaksi');
		$query = $this->db->get('t_transaksi');
		return $query->result_array();
	}

	public function getRowSedang_dikirim($id)
	{
		$query = $this->db->query("SELECT * FROM t_transaksi where status_transaksi='Sedang Dikirim'");
		return $query->row_array();
	}

	public function getSampai_tujuan($id)
	{
		$query = $this->db->query("SELECT * FROM t_detail_transaksi INNER JOIN t_transaksi ON t_transaksi.id_transaksi=t_detail_transaksi.id_transaksi INNER JOIN t_barang ON t_barang.id_barang=t_detail_transaksi.id_barang WHERE t_transaksi.id_member='$id' AND t_transaksi.status_transaksi='Sampai Tujuan'");
		return $query->result_array();
	}

	public function getRowSampai_tujuan($id)
	{
		$query = $this->db->query("SELECT * FROM t_transaksi where status_transaksi='Sampai Tujuan'");
		return $query->row_array();
	}

	public function getSelesai($id)
	{
		$query = $this->db->query("SELECT * FROM t_detail_transaksi INNER JOIN t_transaksi ON t_transaksi.id_transaksi=t_detail_transaksi.id_transaksi INNER JOIN t_barang ON t_barang.id_barang=t_detail_transaksi.id_barang WHERE t_transaksi.id_member='$id' AND t_transaksi.status_transaksi='Selesai'");
		return $query->result_array();
	}

	public function getRowSelesai($id)
	{
		$query = $this->db->query("SELECT * FROM t_transaksi where status_transaksi='Selesai'");
		return $query->row_array();
	}

	public function getPesanan_dibatalkan($id)
	{
		$this->db->select('*');
		$this->db->join('t_detail_transaksi', 't_detail_transaksi.id_transaksi=t_transaksi.id_transaksi');
		$this->db->join('t_bank', 't_transaksi.id_bank=t_bank.id_bank');
		$this->db->join('t_ongkir', 't_transaksi.id_ongkir=t_ongkir.id_ongkir');
		$this->db->join('t_barang', 't_detail_transaksi.id_barang=t_barang.id_barang');
		$this->db->where('t_transaksi.id_member', $id);
		$this->db->where('t_transaksi.status_transaksi', 'Pesanan Dibatalkan');
		$this->db->group_by('t_transaksi.id_transaksi');
		$query = $this->db->get('t_transaksi');
		return $query->result_array();
	}

	public function getRowPesanan_dibatalkan($id)
	{
		$query = $this->db->query("SELECT * FROM t_transaksi where status_transaksi='Pesanan Dibatalkan'");
		return $query->row_array();
	}

	public function getDetailPesanan($id)
	{
		$this->db->select('*');
		$this->db->join('t_detail_transaksi', 't_detail_transaksi.id_transaksi=t_transaksi.id_transaksi');
		$this->db->join('t_barang', 't_detail_transaksi.id_barang=t_barang.id_barang');
		$this->db->where('t_transaksi.id_transaksi', $id);
		$query = $this->db->get('t_transaksi');
		return $query->result_array();
	}

	public function getDataRating($id)
	{
		$query = $this->db->query("SELECT * FROM t_rating WHERE id_member = '$id'");
		$query->row_array();
	}

}