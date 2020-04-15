<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('email_admin')) {
		} else{
			redirect('Auth_admin');
		}
		$this->load->model('Admin/M_transaksi');
		$this->load->model('Frontend/M_keranjang');
	}

	public function index()
	{
		$jumlah_data = $this->M_transaksi->jumlah_data();
		$config['base_url'] = base_url('Admin/Transaksi/index'); //site url
        $config['total_rows'] = $jumlah_data; //total row
        $config['per_page'] = 5;  //show record per halaman
        $config['uri_segment'] = 4;  // uri parameter
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = floor($choice);
        $config['next_link']        = ' Next <i class="fa fa-chevron-right"></i>';
        $config['prev_link']        = '<i class="fa fa-chevron-left"></i> Prev ';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '</span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span></li>';
        $from = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data['transaksi'] = $this->M_transaksi->getTransaksi($config['per_page'], $from);
        $data['pagination'] = $this->pagination->create_links();
        $data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
        $data['title'] 		= 'Data transaksi';
		$this->load->view("Admin/Transaksi/List", $data);	
	}


	public function detail_transaksi($id)
	{
		$data['title'] 		= 'Data detail transaksi';
		$data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
		$data['detail'] = $this->M_transaksi->getDetail($id);
		$data['total']	= $this->M_transaksi->getTotalBayar($id);
		$this->load->view('Admin/Transaksi/Detail', $data);

	}

	public function proses_pesanan()
	{
		$this->form_validation->set_rules('id_ongkir');
		$id_member	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->row_array();
		$id_bank		= $_POST['id_bank'];
		$id_ongkir		= $_POST['id_ongkir'];
		$nama			= $_POST['nama'];
		$alamat 		= $_POST['alamat'];
		$catatan 		= $_POST['catatan'];
		$total_bayar	= $_POST['total_bayar'];

		$id = $this->M_transaksi->get_last_id('id_transaksi', 't_transaksi');
		$id_transaksi = ltrim($id['id_transaksi'], "TR");
		$id_transaksi = sprintf('%04d', $id_transaksi + 1);
		$id_transaksi = "TR".$id_transaksi;
	
		$transaksi = array(
			'id_transaksi'		=> $id_transaksi,
			'id_member'			=> $id_member['id_member'],
			'id_bank'			=> $id_bank,
			'id_ongkir' 		=> $id_ongkir,
			'nama' 				=> $nama,
			'alamat' 			=> $alamat,
			'catatan' 			=> $catatan,
			'total_bayar'		=> $total_bayar,
			'tanggal_transaksi' => date('Y-m-d H:i:s'),
			'batas_bayar'		=> date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y'))),
		);

		$add = $this->M_transaksi->tambahTransaksi('t_transaksi', $transaksi);

		$this->M_transaksi->tambahDetail($id_transaksi, $id_member['id_member']);
		$this->M_transaksi->destroy_keranjang('id_member', $id_member['id_member'], 't_keranjang');

		if ($add > 0) {
			$this->session->set_flashdata('berhasil', 'Data berhasil disimpan !');
			redirect('Frontend/Checkout');
		} else {
			$this->session->set_flashdata('gagal', 'Data gagal disimpan !');
			redirect('Frontend/Checkout');
		}
	}

	public function updateStatus($id)
	{
		$data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
		$transaksi = $this->M_transaksi->getTransaksi1($id);
		if ($transaksi['status_transaksi'] === 'Menunggu Konfirmasi') {
			$update = array(
			'status_transaksi' => 'Pesanan Diproses'	
			);
		} elseif ($transaksi['status_transaksi'] === 'Pesanan Diproses') {
			$update = array(
			'status_transaksi' => 'Sedang Dikirim'	
			);
		} 
		$data['status'] = $this->M_transaksi->updateStatus($id, $update);
		redirect('Admin/Transaksi');
	}

	public function insertResi($id)
	{

		$add = $this->M_transaksi->addResi($id,  $_POST['no_resi']);
		if ($add > 0) {
			$this->session->set_flashdata('berhasil', 'Data berhasil disimpan !');
			redirect('Admin/Transaksi');
		} else {
			$this->session->set_flashdata('gagal', 'Data gagal disimpan !');
			redirect('Admin/Transaksi');
		}
	}

	public function search()
    {
    	$data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
    	$keyword 		   = $this->input->get('keyword');
    	$data['transaksi']    = $this->M_transaksi->search($keyword);
        $data['title']     = 'Data Transaksi';
    	$this->load->view('Admin/Transaksi/Search',$data);
    }
}