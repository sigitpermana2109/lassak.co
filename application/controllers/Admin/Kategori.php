<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('email_admin')) {
		} else{
			redirect('Auth_admin');
		}
		$this->load->model('Admin/M_kategori');
	}

	public function index()
	{
		$jumlah_data = $this->M_kategori->jumlah_data();
		$config['base_url'] = base_url('Admin/Kategori/index'); //site url
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
        $data['kategori'] = $this->M_kategori->getkategori($config['per_page'], $from);
        $data['pagination'] = $this->pagination->create_links();
        $data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
        $data['title'] 		= 'Data kategori';
        $this->load->view("Admin/Kategori/List", $data);
    }


    public function insert()
    {
    	$id = $this->input->post('id_kategori');
    	$nama_kategori	= $_POST['nama_kategori'];
    	$data = array(
    	     'nama_kategori' => $nama_kategori
    	    );

    	if ($id == NULL || $id == '') {
    		$add = $this->M_kategori->tambahkategori('t_kategori', $data);
    	}  else{
    		$add = $this->M_kategori->editkategori('t_kategori', $data, $id);
    	}

    	
    	if ($add > 0) {
    		$this->session->set_flashdata('berhasil', 'Data berhasil disimpan !');
    		redirect('Admin/Kategori');
    	} else {
    		$this->session->set_flashdata('gagal', 'Data gagal disimpan !');
    		redirect('Admin/Kategori');
    	}
    	
    }


    public function update($id)
    {
    	$this->form_validation->set_rules('nama_kategori',' ', 'required');

    	if ($this->form_validation->run() == FALSE) {
    		$data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
    		$data["dataEdit"] = $this->M_kategori->dataEdit($id);
    		$this->load->view('Admin/Kategori/form_edit', $data);
    	} else {
    		$nama_kategori	= $_POST['nama_kategori'];
    		$data = array(
    			'nama_kategori' 	=> $nama_kategori
    		); 

    		$edit = $this->M_kategori->editkategori('t_kategori', $data, $id);
    		if ($edit > 0) {
    			$this->session->set_flashdata('berhasil_update', 'Data berhasil diedit !');
    			redirect('Admin/Kategori');
    		} else {
    			$this->session->set_flashdata('gagal_update', 'Data gagal diedit !');
    			redirect('Admin/Kategori');
    		}
    	}
    }

    public function delete($id=null)
    {
    	$hapus = $this->M_kategori->hapusData('t_kategori',$id);
    	if($hapus > 0) {
    		$this->session->set_flashdata('hapus', 'Data berhasil dihapus !');
    		redirect('Admin/Kategori');
    	}else{
    		$this->session->set_flashdata('hapus_gagal', 'Data gagal dihapus !');
    		redirect('Admin/Kategori');
    	}
    }

    public function search()
    {
        $data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
        $keyword           = $this->input->get('keyword');
        $data['kategori']    = $this->M_kategori->search($keyword);
        $data['title']     = 'Data Kategori';
        $this->load->view('Admin/Kategori/Search',$data);
    }
}
