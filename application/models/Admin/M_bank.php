<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bank extends CI_Model {

	public function getbank($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('t_bank');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function jumlah_data(){
        $this->db->select('*');
        $this->db->from('t_bank');
        $query = $this->db->get();
        return $query->num_rows();
    }

	public function tambahbank($table_name, $data)
	{
		$add = $this->db->insert($table_name, $data);
		return $add;
	}

	public function dataEdit($id){
		$this->db->select('*');
		$this->db->from('t_bank');
		$this->db->where('id_bank',$id);
		$query = $this->db->get();
        return $query->row();
	}

	public function editbank($table_name,$data,$id)
	{
		$this->db->where('id_bank', $id);
		$edit = $this->db->update($table_name, $data);
		return $edit;
	}

	public function hapusData($table_name, $id)
	{
		$this->db->where('id_bank', $id);
		$hapus = $this->db->delete($table_name);
		return $hapus;
	}

	public function search($keyword)
	{
		$this->db->select('*');
		$this->db->from('t_bank');
		$this->db->or_like('nama_bank',$keyword);
		$this->db->or_like('no_rekening', $keyword);
		return $this->db->get()->result_array();
	}
}