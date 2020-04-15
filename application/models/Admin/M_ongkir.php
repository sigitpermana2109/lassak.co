<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ongkir extends CI_Model {

	public function getOngkir($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('t_ongkir');
		$this->db->join('t_kota','t_ongkir.id_kota=t_kota.id_kota');
		$this->db->join('t_kurir', 't_ongkir.id_kurir=t_kurir.id_kurir');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
        return $query->result_array();
	}

	public function jumlah_data(){
        $this->db->select('*');
        $this->db->from('t_ongkir');
        $query = $this->db->get();
        return $query->num_rows();
    }

	public function getKota()
	{
		$this->db->select('*');
		$this->db->from('t_kota');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getKurir()
	{
		$this->db->select('*');
		$this->db->from('t_kurir');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function tambahOngkir($table_name, $data)
	{
		$add = $this->db->insert($table_name, $data);
		return $add;
	}

	public function dataEdit($id)
	{
		$this->db->select('*');
		$this->db->from('t_ongkir');
		$this->db->join('t_kota','t_ongkir.id_kota=t_kota.id_kota');
		$this->db->join('t_kurir', 't_ongkir.id_kurir=t_kurir.id_kurir');
		$this->db->where('id_ongkir', $id);
		$query = $this->db->get();
        return $query->row();
	}

	public function editOngkir($table_name, $data, $id)
	{
		$this->db->where('id_ongkir', $id);
		$edit = $this->db->update($table_name, $data);
		return $$edit;
	}

	public function hapusData($table_name, $id)
	{
		$this->db->where('id_ongkir', $id);
		$hapus = $this->db->delete($table_name);
		return $hapus;
	}

	public function search($keyword)
	{
		$this->db->select('*');
		$this->db->from('t_ongkir');
		$this->db->join('t_kota','t_ongkir.id_kota=t_kota.id_kota');
		$this->db->join('t_kurir', 't_ongkir.id_kurir=t_kurir.id_kurir');
		$this->db->or_like('jenis_kurir',$keyword);
		$this->db->or_like('nama_kota', $keyword);
		$this->db->or_like('harga', $keyword);
		return $this->db->get()->result_array();
	}

}
