<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurir extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('email_admin')) {
		} else{
			redirect('Auth_admin');
		}
		$this->load->model('Admin/M_kurir');
	}

	public function index()
	{
		$jumlah_data = $this->M_kurir->jumlah_data();
		$config['base_url'] = base_url('Admin/Kurir/index'); //site url
        $config['total_rows'] = $jumlah_data; //total row
        $config['per_page'] = 5;  //show record per halaman
        $config['uri_segment'] = 4;  // uri parameter
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = floor($choice);
        $config['next_link']        = '>>';
        $config['prev_link']        = '<<';
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
        $data['kurir'] = $this->M_kurir->getkurir($config['per_page'], $from);
        $data['pagination'] = $this->pagination->create_links();
        $data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
        $data['title'] 		= 'Data kurir';
        $this->load->view("Admin/Kurir/List", $data);
    }


    public function insert()
    {
    	$id = $this->input->post('id_kurir');
    	$jenis_kurir	= $_POST['jenis_kurir'];
    	$data = array(
    	    'jenis_kurir'   => $jenis_kurir 
    	);

    	if ($id == NULL || $id == '') {
    		$add = $this->M_kurir->tambahkurir('t_kurir', $data);
    	} else{
    		$add = $this->M_kurir->editkurir('t_kurir', $data, $id);
    	}

    	if ($add > 0) {
    		$this->session->set_flashdata('berhasil', 'Data berhasil disimpan !');
    		redirect('Admin/Kurir');
    	} else {
    		$this->session->set_flashdata('gagal', 'Data gagal disimpan !');
    		redirect('Admin/Kurir');
    	}
    }


    public function delete($id=null)
    {
    	$hapus = $this->M_kurir->hapusData('t_kurir',$id);
    	if($hapus > 0) {
    		$this->session->set_flashdata('hapus', 'Data berhasil dihapus !');
    		redirect('Admin/Kurir');
    	}else{
    		$this->session->set_flashdata('hapus_gagal', 'Data gagal dihapus !');
    		redirect('Admin/Kurir');
    	}
    }

    public function search()
    {
        $data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
        $keyword           = $this->input->get('keyword');
        $data['kurir']     = $this->M_kurir->search($keyword);
        $data['title']     = 'Data Kurir';
        $this->load->view('Admin/Kurir/Search',$data);
    }
}
