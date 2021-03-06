<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kategori extends CI_Model {

	public function getKategori($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('t_kategori');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function jumlah_data(){
        $this->db->select('*');
        $this->db->from('t_kategori');
        $query = $this->db->get();
        return $query->num_rows();
    }

	public function tambahKategori($table_name, $data)
	{
		$add = $this->db->insert($table_name, $data);
		return $add;
	}

	public function dataEdit($id){
		$this->db->select('*');
		$this->db->from('t_kategori');
		$this->db->where('id_kategori',$id);
		$query = $this->db->get();
        return $query->row();
	}

	public function editKategori($table_name,$data,$id)
	{
		$this->db->where('id_kategori', $id);
		$edit = $this->db->update($table_name, $data);
		return $edit;
	}

	public function hapusData($table_name, $id)
	{
		$this->db->where('id_kategori', $id);
		$hapus = $this->db->delete($table_name);
		return $hapus;
	}

	public function search($keyword)
	{
		$this->db->select('*');
		$this->db->from('t_kategori');
		$this->db->or_like('nama_kategori',$keyword);
		return $this->db->get()->result_array();
	}
}
