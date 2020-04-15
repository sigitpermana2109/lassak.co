<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

	public function getadmin()
	{
		$this->db->select('*');
		$this->db->from('t_admin');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function jumlah_data(){
        $this->db->select('*');
        $this->db->from('t_admin');
        $query = $this->db->get();
        return $query->num_rows();
    }

	public function getEmailAdmin()
	{
		$this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
	}

	public function tambahadmin($table_name, $data)
	{
		$add = $this->db->insert($table_name, $data);
		return $add;
	}

	public function dataEdit($id){
		$this->db->select('*');
		$this->db->from('t_admin');
		$this->db->where('id_admin',$id);
		$query = $this->db->get();
        return $query->result_array();
	}

	public function editadmin($table_name,$data,$id)
	{
		$this->db->where('id_admin', $id);
		$edit = $this->db->update($table_name, $data);
		return $edit;
	}

	public function hapusData($table_name, $id)
	{
		$this->db->where('id_admin', $id);
		$hapus = $this->db->delete($table_name);
		return $hapus;
	}
}
