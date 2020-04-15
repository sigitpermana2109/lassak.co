<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {

	public function totalBarang()
	{
		$this->db->select('COUNT(id_barang) as total_barang');
		$this->db->from('t_barang');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function totalMember()
	{
		$this->db->select('COUNT(id_member) as total_member');
		$this->db->from('t_member');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function totalTransaksi()
	{
		$this->db->select('COUNT(id_transaksi) as total_transaksi');
		$this->db->from('t_transaksi');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function transaksiBaru()
	{
		$this->db->select('*');
		$this->db->join('t_member', 't_transaksi.id_member=t_member.id_member');
		$this->db->join('t_bank', 't_transaksi.id_bank=t_bank.id_bank');
		$this->db->join('t_ongkir', 't_transaksi.id_ongkir=t_ongkir.id_ongkir');
		$this->db->order_by('t_transaksi.id_transaksi', 'DESC');
		$this->db->limit(5);
		$query = $this->db->get('t_transaksi');
		return $query->result_array();
	}

	public function  orderPending()
	{
		$query = $this->db->query("SELECT COUNT(status_transaksi) AS order_pending FROM t_transaksi WHERE status_transaksi = 'Menunggu Konfirmasi'");
		return $query->row_array();
	}

	public function  orderPengiriman()
	{
		$query = $this->db->query("SELECT COUNT(status_transaksi) AS order_pengiriman FROM t_transaksi WHERE status_transaksi = 'Sedang Dikirim'");
		return $query->row_array();
	}

	public function  orderSelesai()
	{
		$query = $this->db->query("SELECT COUNT(status_transaksi) AS order_selesai FROM t_transaksi WHERE status_transaksi = 'Sampai Tujuan'");
		return $query->row_array();
	}

	public function totalPenghasilan()
	{
		$query = $this->db->query("SELECT fcTotalPenghasilan('totalPerbulan') AS total");
		return $query->row_array();
	}
}
