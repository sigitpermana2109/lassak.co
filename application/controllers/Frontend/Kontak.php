<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Frontend/M_keranjang');
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			is_login();
			$data["user"] 	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->row_array();
			$data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
			$data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
			$data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
			$this->load->view('Frontend/Kontak', $data);
		}else{
			$this->load->view('Frontend/Kontak');
		}	
		
	}
}
