<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_member extends CI_Model {

	public function getmember($limit,$offset)
	{
		$this->db->select('*');
		$this->db->limit($limit, $offset);
		$query = $this->db->get('t_member');
		return $query->result_array();
	}

	public function jumlah_data(){
        $this->db->select('*');
        $this->db->from('t_member');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function changeActiveState($key)
	{
	 $this->load->database();
	 $data = array(
	 'active' => 1
	 );
	
	 $this->db->where('md5(id)', $key);
	 $this->db->update('t_member', $data);
	
	 return true;
	}

	public function tambahmember($table_name, $data)
	{
		$add = $this->db->insert($table_name, $data);
		return $add;
	}

	public function dataEdit($id){
		$this->db->select('*');
		$this->db->from('t_member');
		$this->db->join('t_detail_alamat', 't_detail_alamat.id_alamat=t_member.id_alamat');
		$this->db->where('id_member',$id);
		$query = $this->db->get();
        return $query->row();
	}

	public function updateFoto($id, $id_member, $foto)
	{
		return $this->db->query("UPDATE t_member SET foto = '$foto' WHERE id_member = '$id_member' ");
	}

	public function editmember($table_name,$data,$id)
	{
		$this->db->where('id_member', $id);
		$edit = $this->db->update($table_name, $data);
		return $edit;
	}

	public function alamat($alamat)
	{
		$this->db->where('alamat', $alamat);
		$edit = $this->db->get('t_detail_alamat');
		return $edit->row_array();
	}

	public function hapusData($table_name, $id)
	{
		$this->db->where('id_member', $id);
		$hapus = $this->db->delete($table_name);
		return $hapus;
	}

	public function tambahAlamat($table_name, $data)
	{
		$add = $this->db->insert($table_name, $data);
		return $add;
	}

	public function get_last_id($a, $b)
	{
		$query = $this->db->query("SELECT $a from $b order by $a desc");
		return $query->row_array();
	}

	public function editAlamat($table_name,$data,$id)
	{
		$this->db->where('id_alamat', $id);
		$edit = $this->db->update($table_name, $data);
		return $edit;
	}

	public function hapusAlamat($table_name, $id)
	{
		$this->db->where('id_alamat', $id);
		$hapus = $this->db->delete($table_name);
		return $hapus;
	}

	public function search($keyword)
	{
		$this->db->select('*');
		$this->db->from('t_member');
		$this->db->or_like('nama_depan', $keyword);
		$this->db->or_like('nama_belakang', $keyword);
		$this->db->or_like('email', $keyword);
		$this->db->or_like('no_telp', $keyword);
		return $this->db->get()->result_array();
	}
}
