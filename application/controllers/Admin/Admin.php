<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('email_admin')) {
		} else{
			redirect('Auth_admin');
		}
		$this->load->model('Admin/M_admin');
	}

	public function index()
	{
		$jumlah_data = $this->M_admin->jumlah_data();
		$config['base_url'] = base_url('Admin/Admin/index'); //site url
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
        $data['admin'] = $this->M_admin->getadmin($config['per_page'], $from);
        $data['pagination'] = $this->pagination->create_links();
        $data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
        $data['title'] 		= 'Data admin';
        $this->load->view("Admin/List", $data);
    }

    public function profile()
    {
    	$data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
    	$data["admin"] = $this->M_admin->getadmin();
    	$data["title"] = 'Profile';
    	$this->load->view("Admin/Profile", $data);
    }

    public function insert()
    {
    	$id = $this->input->post('id_admin');
    	$nama_lengkap 	= $_POST['nama_lengkap'];
    	$password1 		= $_POST['password1'];
    	$password2 		= $_POST['password2'];
    	$email 			= $_POST['email'];
    	$no_telp 		= $_POST['no_telp'];
    	$foto 			= $this->_uploadImage();

    	$data = array(
    		'nama_lengkap'	=> $nama_lengkap, 		
    		'email' 		=> $email,
    		'no_telp' 		=> $no_telp,
    		'foto'			=> $foto,
    		'password' 		=> password_hash($password1, PASSWORD_DEFAULT)
    	);

    	$add = $this->M_admin->tambahadmin('t_admin', $data);
    	if ($add > 0) {
    		$this->session->set_flashdata('berhasil', 'Data berhasil disimpan !');

    	} else {
    		echo "gagal";
    	}

    	redirect('Admin/Admin');
    }


    public function update($id)
    {
    	$this->form_validation->set_rules('nama_lengkap',' ', 'required|trim');
    	$this->form_validation->set_rules('username',' ', 'required|trim');
    	$this->form_validation->set_rules('email',' ', 'required|trim|valid_email');
    	$this->form_validation->set_rules('no_rekening',' ', 'required|numeric|trim|max_length[10]',
    		[
    			'max_length' => 'maximum 10 character !'
    		]);

    	if ($this->form_validation->run() == FALSE) {
    		$data["admin"] = $this->M_admin->dataEdit($id);
    		$this->load->view('Admin/Admin/List', $data);
    	} else {
    		$nama_lengkap 	= $_POST['nama_lengkap'];
    		$username		= $_POST['username'];
    		$email 			= $_POST['email'];
    		$no_rekening 	= $_POST['no_rekening'];

    		if (!empty($_FILES['foto']['name'])) {
    			$foto = $this->_uploadImage();
    		}else{
    			$foto = $_POST['old_image'];
    		}

    		$data = array(
    			'nama_lengkap' 	=> $nama_lengkap,
    			'username' 		=> $username,
    			'email' 		=> $email,
    			'no_rekening' 	=> $no_rekening,
    			'foto'			=> $foto
    		); 

    		$edit = $this->M_admin->editadmin('t_admin', $data, $id);
    		if ($edit > 0) {
    			$this->session->set_flashdata('berhasil_update', 'Data berhasil diedit !');
    			redirect('Admin/Admin/Profile');
    		} else {
    			$this->session->set_flashdata('gagal_update', 'Data gagal diedit !');
    			redirect('Admin/Admin/Profile');
    		}
    	}
    }

    public function ubahPassword($id)
    {
    	$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
    		'matches' => 'password dont match!',
    		'min_length' => 'Password too short!'
    	]);
    	$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
    	if ($this->form_validation->run() == FALSE) {
    		$data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
    		$data["admin"] = $this->M_admin->dataEdit($id);
    		$this->load->view('Admin/Admin/List', $data);
    	} else {
    		$password1 = $_POST['password1'];
    		$data = array(
    			'password' => password_hash($password1, PASSWORD_DEFAULT),
    		); 

    		$edit = $this->M_admin->editadmin('t_admin', $data, $id);
    		if ($edit > 0) {
    			$this->session->set_flashdata('alert_success', 'Data berhasil diedit !');
    			redirect('Admin/Admin');
    		} else {
    			echo "gagal";
    		}
    	}
    }

    public function delete($id=null)
    {
    	$hapus = $this->M_admin->hapusData('t_admin',$id);
    	if($hapus > 0) {
    		$this->session->set_flashdata('hapus', 'Data berhasil dihapus !');
    		redirect('Admin/Admin');
    	}else{
    		echo 'Gagal Dihapus';
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
}
