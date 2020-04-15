<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('email_admin')) {
		} else{
			redirect('Auth_admin');
		}
		$this->load->model('Admin/M_member');
	}

	public function index()
	{
		$jumlah_data = $this->M_member->jumlah_data();
		$config['base_url'] = base_url('Admin/Member/index'); //site url
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
        $data['member'] = $this->M_member->getmember($config['per_page'], $from);
        $data['pagination'] = $this->pagination->create_links();
        $data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
        $data['title'] 		= 'Data member';
		$this->load->view("Admin/Member/List", $data);
	}

	public function delete($id=null)
	{
		$hapus = $this->M_member->hapusData('t_member',$id);
		if($hapus > 0) {
			$this->session->set_flashdata('hapus', 'Data berhasil dihapus !');
			redirect('Admin/Member');
		}else{
			$this->session->set_flashdata('hapus_gagal', 'Data gagal dihapus !');
			redirect('Admin/Member');
		}
	}

	public function _uploadImage()
    {
        $config['upload_path'] 		= './assets/images/faces/';
        $config['allowed_types'] 	= 'gif|jpg|png';
        $config['file_name'] 		= $_FILES['foto']['name'];
        $config['overwrite'] 		= true;
        // $config['max_size'] = 1024;


        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            return $this->upload->data("file_name");
        }
        return "default.jpg";
    }

    private function _deleteImage($id)
    {
    $foto = $this->getById($id);
    if ($foto->foto != "default.jpg") {
        $filename = explode(".", $foto->foto)[0];
        return array_map('unlink', glob(FCPATH."assets/images/faces/$filename.*"));
        }
	}

	public function search()
    {
    	$data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
    	$keyword 		   = $this->input->get('keyword');
    	$data['member']    = $this->M_member->search($keyword);
        $data['title']     = 'Data Member';
    	$this->load->view('Admin/Member/Search',$data);
    }
}
