<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_keranjang extends CI_Model {

	public function getBarang($limit, $offset)
	{
		$this->db->select('*');
		$this->db->from('t_barang');
		$this->db->join('t_kategori','t_kategori.id_kategori=t_barang.id_kategori');
		$this->db->order_by('t_barang.id_barang', 'DESC');	
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
        return $query->result_array();
	}

	public function searchBarang($keyword, $limit, $offset)
	{
		$this->db->select('*');
		$this->db->from('t_barang');
		$this->db->join('t_kategori','t_kategori.id_kategori=t_barang.id_kategori');
		$this->db->like('nama_barang', $keyword);
		$this->db->or_like('harga',$keyword);
		$this->db->or_like('nama_kategori', $keyword);
		$this->db->limit($limit, $offset);
		return $this->db->get()->result_array();
	}	

	public function dataEdit($id){
		$this->db->select('*');
		$this->db->join('t_kategori','t_kategori.id_kategori=t_barang.id_kategori');
		$this->db->where('t_barang.id_barang', $id);
		$query = $this->db->get('t_barang');
        return $query->row();
	}

	public function hargaASC($limit, $offset)
	{
		$this->db->select('*');
		$this->db->from('t_barang');
		$this->db->join('t_kategori','t_kategori.id_kategori=t_barang.id_kategori');
		$this->db->order_by('t_barang.harga', 'ASC');	
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
        return $query->result_array();
	}

	public function hargaDESC($limit, $offset)
	{
		$this->db->select('*');
		$this->db->from('t_barang');
		$this->db->join('t_kategori','t_kategori.id_kategori=t_barang.id_kategori');
		$this->db->order_by('t_barang.harga', 'DESC');	
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
        return $query->result_array();
	}

	public function get_ongkir()
	{
		$hasil=$this->db->query("SELECT * FROM t_ongkir");
		return $hasil;
	}

	public function get_detail_ongkir($id)
	{
		$hasil=$this->db->query("SELECT id_ongkir AS id, harga FROM t_ongkir WHERE id_ongkir='$id'");
		return $hasil->result();
	}

	public function getKeranjang($id)
	{
		$this->db->select('t_keranjang.id_keranjang, t_keranjang.id_barang, t_barang.nama_barang, t_barang.gambar1, t_barang.harga, t_keranjang.jumlah, t_keranjang.catatan');
		$this->db->from('t_keranjang');
		$this->db->join('t_barang', 't_barang.id_barang=t_keranjang.id_barang');
		$this->db->where('t_keranjang.id_member', $id);
		// $this->db->where('t_keranjang.id_keranjang', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getCheckout($id)
	{
		$this->db->select('t_keranjang.id_keranjang, t_keranjang.id_barang, t_barang.nama_barang, t_barang.gambar1, t_barang.harga, t_keranjang.jumlah, t_keranjang.catatan');
		$this->db->from('t_keranjang');
		$this->db->join('t_barang', 't_barang.id_barang=t_keranjang.id_barang');
		// $this->db->where('t_keranjang.id_member', $id);
		$this->db->where('t_keranjang.id_keranjang', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getPilihan($id)
	{
		$this->db->select('SUM(jumlah) AS total_keranjang');
		$this->db->from('t_keranjang');
		$this->db->where('id_keranjang', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function editCatatan($id, $catatan)
	{
		$query = $this->db->query("UPDATE t_keranjang SET catatan = '$catatan' WHERE id_keranjang = '$id'");
		return $query;
	}

	public function getNavKeranjang($id)
	{
		$this->db->select('t_keranjang.id_keranjang, t_keranjang.id_barang, t_barang.nama_barang, t_barang.gambar1, t_barang.harga, t_keranjang.jumlah');
		$this->db->join('t_barang', 't_barang.id_barang=t_keranjang.id_barang');
		$this->db->where('t_keranjang.id_member', $id);
		$this->db->group_by('t_keranjang.id_barang');
		$this->db->limit(3);
		$this->db->order_by('t_keranjang.id_keranjang', 'DESC');
		$query = $this->db->get('t_keranjang');
		return $query->result_array();
	}

	public function getRowNavKeranjang($id)
	{
		$this->db->select('t_keranjang.id_keranjang, t_keranjang.id_barang, t_barang.nama_barang, t_barang.gambar1, t_barang.harga, t_keranjang.jumlah');
		$this->db->join('t_barang', 't_barang.id_barang=t_keranjang.id_barang');
		$this->db->where('t_keranjang.id_member', $id);
		$this->db->group_by('t_keranjang.id_barang');
		$this->db->limit(3);
		$this->db->order_by('t_keranjang.id_keranjang', 'DESC');
		$query = $this->db->get('t_keranjang');
		return $query->row_array();
	}

	public function getKeranjang2($id)
	{
		$this->db->select('t_keranjang.id_keranjang, t_keranjang.id_barang, t_barang.nama_barang, t_barang.gambar1, t_barang.harga, t_keranjang.jumlah');
		$this->db->from('t_keranjang');
		$this->db->join('t_barang', 't_barang.id_barang=t_keranjang.id_barang');
		$this->db->where('t_keranjang.id_member', $id);
		$this->db->group_by('t_keranjang.id_barang');
		$query = $this->db->get();
		return $query->row_array();
	}


	public function getTotalBayar($id)
	{
		$this->db->select('SUM(t_barang.harga*t_keranjang.jumlah) AS total');
		$this->db->from('t_keranjang');
		$this->db->join('t_barang', 't_barang.id_barang=t_keranjang.id_barang');
		$this->db->where('t_keranjang.id_member', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getTotalKeranjang($id)
	{
		$this->db->select('SUM(jumlah) AS total_keranjang');
		$this->db->from('t_keranjang');
		$this->db->where('id_member', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getProduk($produk)
	{
		$this->db->where('id_member', $produk);
		$edit = $this->db->get('t_keranjang');
		return $edit->row_array();
	}

	public function maxBarang()
	{
		$this->db->select('*');
		$this->db->from('t_barang');
		$this->db->join('t_kategori','t_kategori.id_kategori=t_barang.id_kategori');
		$this->db->order_by('id_barang', 'DESC');
		$this->db->limit(8);
		$query = $this->db->get();
        return $query->result_array();
	}


	public function getKategori()
	{
		$this->db->select('*');
		$this->db->from('t_kategori');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function ambilData($id, $id_member)
	{
		return $this->db->query("SELECT * from t_keranjang where id_member= '$id_member' AND id_barang=$id")->num_rows();
	}

	public function tambahKeranjang($table_name, $data)
	{
		$add = $this->db->insert($table_name, $data);
		return $add;
	}

	public function updateCart($id, $id_member, $jumlah)
	{
		$query = $this->db->query("UPDATE t_keranjang set jumlah = '$jumlah' WHERE id_member = '$id_member' AND id_barang = $id");
		return $query;
	}

	public function updateJumlah($id, $id_member)
	{
		return $this->db->query("UPDATE t_keranjang SET jumlah = jumlah + 1 WHERE id_member = '$id_member' AND id_barang = $id");
	}

	public function kategori($where)
	{
		$this->db->select('*');
		$this->db->from('t_barang');
		$this->db->where($where);
		return $this->db->get()->result_array();
	}

	public function hapusData($table_name, $id)
	{
		$this->db->where('id_keranjang', $id);
		$hapus = $this->db->delete($table_name);
		return $hapus;
	}

	public function getAlamat($id)
	{
		$this->db->select('*');
		$this->db->join('t_member','t_member.id_member=t_detail_alamat.id_member');
		$this->db->join('t_provinsi', 't_detail_alamat.id_provinsi=t_provinsi.id_provinsi');
		$this->db->join('t_kota', 't_detail_alamat.id_kota=t_kota.id_kota');
		$this->db->join('t_kecamatan', 't_detail_alamat.id_kecamatan=t_kecamatan.id_kecamatan');
		$this->db->join('t_kelurahan', 't_detail_alamat.id_kelurahan=t_kelurahan.id_kelurahan');
		$this->db->where('t_detail_alamat.id_member',$id);
		$query = $this->db->get('t_detail_alamat');
        return $query->result_array();
	}

	public function insertAlamat($table_name, $data)
	{
		$add = $this->db->insert($table_name, $data);
		return $add;
	}

	public function menunggu_pembayaran($id)
	{
		$query = $this->db->query("SELECT * FROM t_transaksi INNER JOIN t_bank ON t_transaksi.id_bank=t_bank.id_bank WHERE id_member='$id' AND status_transaksi='Menunggu Pembayaran'ORDER BY id_transaksi DESC");
		return $query->result_array();
	}

	public function getMenunggu($id)
	{
		$query = $this->db->query("SELECT * FROM t_transaksi INNER JOIN t_bank ON t_transaksi.id_bank=t_bank.id_bank WHERE id_member='$id' AND status_transaksi='Menunggu Pembayaran'");
		return $query->row_array();
	}

	public function masuk_keranjang($table_name, $data)
	{
		$add = $this->db->insert($table_name, $data);
		return $add;
	}

	public function get_provinsi(){
		$hasil=$this->db->query("SELECT * FROM t_provinsi order by nama_provinsi asc");
		return $hasil->result_array();
	}

	public function getKota()
	{
		$query = $this->db->query("SELECT * FROM t_kota ORDER BY nama_kota ASC");
		return $query->result_array();
	}

	public function getKecamatan()
	{
		$query = $this->db->query("SELECT id_kecamatan, nama_kecamatan FROM t_kecamatan ORDER BY nama_kecamatan ASC");
		return $query->result_array();
	}

	public function getKelurahan()
	{
		$query = $this->db->query("SELECT id_kelurahan, nama_kelurahan FROM t_kelurahan ORDER BY nama_kelurahan ASC");
		return $query->result_array();
	}

	public function catatan()
	{
		$query = $this->db->query("SELECT * FROM t_keranjang WHERE catatan ='".$this->input->post('catatan')."'")->num_rows();
	}

	public function cekDataUkuran($id)
	{
		$query = $this->db->query("SELECT t_detail_barang.ukuran, t_detail_barang.jumlah FROM t_barang INNER JOIN t_detail_barang ON t_barang.id_barang=t_detail_barang.id_barang WHERE t_detail_barang.id_barang='$id'");
		return $query->row_array();
	}

}
