<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model {

	public function getBarang($limit,$offset)
	{
		$this->db->select('t_barang.nama_barang, t_barang.deskripsi, t_barang.harga, t_barang.berat, t_barang.stok, t_barang.gambar1, t_kategori.nama_kategori, t_barang.id_barang, t_kategori.id_kategori');
		$this->db->join('t_kategori','t_kategori.id_kategori=t_barang.id_kategori');
		$this->db->limit($limit, $offset);
  		$this->db->order_by('id_barang', 'ASC');
		$query = $this->db->get('t_barang');
        return $query->result_array();
	}

	public function getDetailBarang($id)
	{
		$query = $this->db->query("SELECT * FROM t_detail_barang WHERE id_barang='$id'");
		return $query->result_array();
	}

	public function jumlah_data(){
        $this->db->select('*');
        $this->db->from('t_barang');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function detailBarang($id)
    {
    	$this->db->select('*');
    	$this->db->where('id_barang', $id);
    	$query = $this->db->get('t_detail_barang');
    	return $query->result_array();
    }


	public function getKategori()
	{
		$this->db->select('*');
		$this->db->from('t_kategori');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function tambahBarang($table_name, $data)
	{
		$add = $this->db->insert($table_name, $data);
		return $add;
	}

	public function dataEdit(){
		$this->db->select('*');
		$this->db->from('t_barang');
		$this->db->join('t_kategori','t_kategori.id_kategori=t_barang.id_kategori');
		$query = $this->db->get();
        return $query->row_array();
	}

	public function editBarang($table_name,$data,$id)
	{
		$this->db->where('id_barang', $id);
		$edit = $this->db->update($table_name, $data);
		return $edit;
	}

	public function hapusData($table_name, $id)
	{
		$this->db->where('id_barang', $id);
		$hapus = $this->db->delete($table_name);
		return $hapus;
	}

	public function hapusUkuran($table_name, $id)
	{
		$this->db->where('id_detail_barang', $id);
		$hapus = $this->db->delete($table_name);
		return $hapus;
	}

	public function searchBarang($keyword)
	{
		$this->db->select('*');
		$this->db->from('t_barang');
		$this->db->join('t_kategori','t_kategori.id_kategori=t_barang.id_kategori');
		$this->db->like('nama_barang', $keyword);
		$this->db->or_like('harga',$keyword);
		$this->db->or_like('nama_kategori', $keyword);
		return $this->db->get()->result_array();
	}

	public function ratingBarang($rating,$id_barang,$email,$id_rating)
	{
		$dataMember = $this->db->get_where('t_member',['email' => $email])->row_array();
		return $dataMember;
		$id_member = $dataMember['id_member'];
		$data = array('id_rating' => '','id_member' => $id_member,'id_barang' => $id_barang,'rating' =>$rating );
		$this->db->insert('t_rating', $data);
		
	}
}
