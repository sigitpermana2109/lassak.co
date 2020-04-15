<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

	public function getTransaksi($limit,$offset)
	{
		$this->db->select('*');
		$this->db->join('t_detail_transaksi', 't_transaksi.id_transaksi =t_detail_transaksi.id_transaksi');
		$this->db->join('t_bank', 't_transaksi.id_bank = t_bank.id_bank');
		$this->db->join('t_member', 't_transaksi.id_member = t_member.id_member');
		$this->db->join('t_detail_alamat', 't_member.id_member = t_detail_alamat.id_member');
		$this->db->join('t_provinsi', 't_detail_alamat.id_provinsi = t_provinsi.id_provinsi');
		$this->db->join('t_kota', 't_detail_alamat.id_kota = t_kota.id_kota');
		$this->db->join('t_kecamatan', 't_detail_alamat.id_kecamatan = t_kecamatan.id_kecamatan');
		$this->db->join('t_kelurahan', 't_detail_alamat.id_kelurahan = t_kelurahan.id_kelurahan');
		$this->db->join('t_ongkir', 't_transaksi.id_ongkir = t_ongkir.id_ongkir');
		$this->db->group_by('t_transaksi.id_transaksi');
		$this->db->order_by('t_transaksi.id_transaksi', 'DESC'); 
		$this->db->limit($limit,$offset);
		$query = $this->db->get('t_transaksi');
		return $query->result_array();
	}

	public function getNewTransaksi($id)
	{
		$query = $this->db->query("SELECT * FROM t_transaksi INNER JOIN t_bank ON t_transaksi.id_bank=t_bank.id_bank WHERE id_member='$id' ORDER BY id_transaksi DESC");
		return $query->row_array();
	}

	public function getNewDetailTransaksi($id, $id_transaksi)
	{
		$query = $this->db->query("SELECT * FROM t_transaksi 
			INNER JOIN t_detail_transaksi ON t_transaksi.id_transaksi=t_detail_transaksi.id_transaksi 
			INNER JOIN t_barang	ON t_detail_transaksi.id_barang = t_barang.id_barang
			WHERE t_transaksi.id_member='$id' AND t_transaksi.id_transaksi='$id_transaksi'
			ORDER BY t_detail_transaksi.id_transaksi DESC");
		return $query->result_array();
	}

	public function getTransaksi1($id)
	{
		$query = $this->db->get_where('t_transaksi', ['id_transaksi' => $id]);
		return $query->row_array();
	}

	public function getDetail($id)
	{
		$this->db->select('*');
		$this->db->from('t_detail_transaksi');
		$this->db->join('t_barang', 't_detail_transaksi.id_barang=t_barang.id_barang');
		$this->db->join('t_transaksi', 't_detail_transaksi.id_transaksi=t_transaksi.id_transaksi');
		$this->db->where('t_transaksi.id_transaksi', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getTotalBayar($id)
	{
		$this->db->select('SUM(t_barang.harga*t_detail_transaksi.jumlah_barang) AS total_bayar');
		$this->db->join('t_barang', 't_detail_transaksi.id_barang=t_barang.id_barang');
		$this->db->join('t_transaksi', 't_detail_transaksi.id_transaksi=t_transaksi.id_transaksi');
		$this->db->where('t_transaksi.id_transaksi', $id);
		$query = $this->db->get('t_detail_transaksi');
		return $query->row_array();
	}

	public function jumlah_data(){
		$this->db->select('*');
		$this->db->from('t_transaksi');
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function updateStatus($id, $data)
	{
		$this->db->where('id_transaksi', $id);
		$edit = $this->db->update('t_transaksi', $data);
		return $edit;
	}

	public function getMember($id)
	{
		$query = $this->db->query("SELECT t_detail_alamat.alamat, t_detail_alamat.id_kota, t_member.nama_depan, t_member.nama_belakang, t_member.tgl_lahir, t_member.jk, t_member.no_telp, t_member.password, t_kota.nama_kota, t_detail_alamat.id_alamat, t_member.id_member, t_member.email, t_member.foto, t_detail_alamat.id_provinsi, t_detail_alamat.id_kelurahan, t_detail_alamat.id_kecamatan, t_detail_alamat.kode_pos, t_provinsi.nama_provinsi, t_kelurahan.nama_kelurahan, t_kecamatan.nama_kecamatan FROM t_member, t_detail_alamat, t_kota, t_provinsi, t_kelurahan, t_kecamatan 
			WHERE t_member.id_member=t_detail_alamat.id_member
			AND t_provinsi.id_provinsi = t_detail_alamat.id_provinsi
			AND t_kota.id_kota=t_detail_alamat.id_kota
			AND t_kecamatan.id_kecamatan = t_detail_alamat.id_kecamatan
			AND t_kelurahan.id_kelurahan = t_detail_alamat.id_kelurahan
			AND t_detail_alamat.id_member = '$id'
			AND t_detail_alamat.status = 'publik'");
		return $query->row_array();
	}

	public function updateAlamat($id, $data)
	{
		$this->db->where('id_member', $id);
		$edit = $this->db->update('t_detail_alamat', $data);
		return $edit;
	}

	public function getOngkir($id)
	{
		$query = $this->db->query("SELECT * FROM t_ongkir
			INNER JOIN t_kota ON t_ongkir.id_kota=t_kota.id_kota
			INNER JOIN t_detail_alamat ON t_kota.id_kota=t_detail_alamat.id_kota
			INNER JOIN t_kurir ON t_ongkir.id_kurir=t_kurir.id_kurir
			WHERE t_detail_alamat.id_kota = '$id' GROUP BY t_ongkir.id_ongkir");
		return $query->result_array();
	}

	public function updateStatusAlamat($id, $data)
	{
		$this->db->where('id_alamat', $id);
		$edit = $this->db->update('t_detail_alamat', $data);
		return $edit;
	}


	public function getBank()
	{
		$this->db->select('*');
		$this->db->from('t_bank');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function tambahTransaksi($table_name, $data)
	{
		$add = $this->db->insert($table_name, $data);
		return $add;
	}

	public function tambahDetail($id_transaksi, $id_member, $id_keranjang)
	{
		$add = $this->db->query("CALL InsertDetail('".$id_member."','".$id_transaksi."','".$id_keranjang."')");
		return $add;
	}

	public function addResi($id, $no_resi)
	{
		$this->db->where('id_transaksi', $id);
		$this->db->set('no_resi', $no_resi);
		$tambahResi = $this->db->update('t_transaksi');
		return $tambahResi;
	}

	public function uploadPembayaran($id, $upload)
	{
		$this->db->where('id_transaksi', $id);
		$this->db->set('upload_pembayaran', $upload);
		$uploadPembayaran = $this->db->update('t_transaksi');
		return $uploadPembayaran;
	}

	public function get_last_id($a, $b)
	{
		$query = $this->db->query("SELECT $a from $b order by $a desc");
		return $query->row_array();
	}

	public function destroy_keranjang($id_keranjang, $table)
	{
		$this->db->where('id_keranjang', $id_keranjang);
		$this->db->delete($table);
	}

	public function search($keyword)
	{
		$this->db->select('*');
		$this->db->from('t_transaksi');
		$this->db->or_like('id_transaksi',$keyword);
		$this->db->or_like('tanggal_transaksi', $keyword);
		return $this->db->get()->result_array();
	}

	public function tambahRating($data)
	{
		$add = $this->db->insert('t_rating', $data);
		return $add;
	}
}
