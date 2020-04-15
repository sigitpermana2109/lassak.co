<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kurir extends CI_Model {

	public function getkurir($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('t_kurir');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function jumlah_data(){
        $this->db->select('*');
        $this->db->from('t_kurir');
        $query = $this->db->get();
        return $query->num_rows();
    }

	public function tambahkurir($table_name, $data)
	{
		$add = $this->db->insert($table_name, $data);
		return $add;
	}

	public function dataEdit($id){
		$this->db->select('*');
		$this->db->from('t_kurir');
		$this->db->where('id_kurir',$id);
		$query = $this->db->get();
        return $query->row();
	}

	public function editkurir($table_name,$data,$id)
	{
		$this->db->where('id_kurir', $id);
		$edit = $this->db->update($table_name, $data);
		return $edit;
	}

	public function hapusData($table_name, $id)
	{
		$this->db->where('id_kurir', $id);
		$hapus = $this->db->delete($table_name);
		return $hapus;
	}

	public function search($keyword)
	{
		$this->db->select('*');
		$this->db->from('t_kurir');
		$this->db->or_like('jenis_kurir',$keyword);
		return $this->db->get()->result_array();
	}
}