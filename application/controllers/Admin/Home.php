<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('email_admin')) {
		} else{
			redirect('Auth_admin');
		}
		$this->load->model('Admin/M_home');
	}

	public function index()
	{
		$data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
		$data["totalBarang"] 		= $this->M_home->totalBarang();
		$data["totalMember"] 		= $this->M_home->totalMember();
		$data["orderPending"]		= $this->M_home->orderPending();
		$data["orderPengiriman"]	= $this->M_home->orderPengiriman();
		$data["orderSelesai"]		= $this->M_home->orderSelesai();
		$data["total_penghasilan"]	= $this->M_home->totalPenghasilan();
		$data["totalTransaksi"] 	= $this->M_home->totalTransaksi();
		$data["transaksiBaru"] 		= $this->M_home->transaksiBaru();
		$data['title'] 				= 'Beranda';
		$this->load->view('Admin/Home', $data);	
	}
}