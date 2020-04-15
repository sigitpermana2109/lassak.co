<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if ($this->session->userdata('email')) {
        } else{
            redirect('Auth_member');
        }
		$this->load->model('Admin/M_member');
		$this->load->model('Admin/M_transaksi');
		$this->load->model('Frontend/M_keranjang');
	}

	public function index()
	{
		$data["user"] 	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->row_array();
		$data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
		$data["member"] = $this->M_transaksi->getMember($data['user']['id_member']);
		$data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
		$data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
		$data["alamat"] = $this->M_keranjang->getAlamat($data['user']['id_member']);
		$data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
        $data["provinsi"] = $this->M_keranjang->get_provinsi();
		$this->load->view("Frontend/Profile", $data);
	}

	public function update($id)
	{
        $nama_depan     = $_POST['nama_depan'];
        $nama_belakang  = $_POST['nama_belakang'];
        $jk             = $_POST['jk'];
        $tgl_lahir      = $_POST['tgl_lahir'];
        $no_telp        = $_POST['no_telp'];
        $email          = $_POST['email'];          
                      
        $data = array(
        'nama_depan'    => $nama_depan,
        'nama_belakang' => $nama_belakang,
        'jk'            => $jk,
        'tgl_lahir'     => $tgl_lahir,
        'email'         => $email,
        'no_telp'       => $no_telp
        ); 

		$edit = $this->M_member->editmember('t_member', $data, $id);
		if ($edit > 0) {
			$this->session->set_flashdata('berhasil', 'Data berhasil diedit !');
			redirect('Frontend/Profile');
		} else {
			$this->session->set_flashdata('gagal', 'Data gagal diedit !');
			redirect('Frontend/Profile');
		}
	
	}

	public function updateFoto()
	{
		$id_member 		= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->		row_array();
		$id 	= $this->input->post('id_member');
		$foto  	= $this->_uploadImage();

		$edit = $this->M_member->updateFoto('t_member', $id, $foto, $id_member['id_member']);
		if ($edit > 0) {
			$this->session->set_flashdata('berhasil_update', 'Data berhasil diedit !');
			redirect('Frontend/Profile');
		} else {
			$this->session->set_flashdata('gagal_update', 'Data gagal diedit !');
			redirect('Frontend/Profile');
		}
	}


	public function ubahPassword()
    {
        $data['title'] = 'Change Password';
       	$data["user"] 	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->row_array();
       	$data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
		$data["member"] = $this->M_transaksi->getMember($data['user']['id_member']);
		$data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
		$data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
		$data["kota"] = $this->M_keranjang->getKota();
		$data["alamat"] = $this->M_keranjang->getAlamat($data['user']['id_member']);
		$data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('Frontend/Profile',$data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
             if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show mx-4" role="alert">
                 <strong>Password Sekarang Salah!</strong>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button></div>');
                redirect('Frontend/Profile');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show mx-4" role="alert">
                        <strong>Password Baru TidaK Boleh Sama Dengan Password Sekarang !</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>');
                    redirect('Frontend/Profile');
                } else {
                    //password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('id_member', $data['user']['id_member']);
                    $this->db->update('t_member');

                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show mx-4" role="alert"> <strong>Password Telah Berubah!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span> 
                        </button></div>');
                    redirect('Frontend/Profile');
                }
            }
        }
    }

    public function deleteAlamat($id=null)
    {
    	$hapus = $this->M_member->hapusAlamat('t_detail_alamat',$id);
    	if($hapus > 0) {
    		$this->session->set_flashdata('hapus', 'Data berhasil dihapus !');
    		redirect('Frontend/Profile');
    	}else{
    		$this->session->set_flashdata('hapus_gagal', 'Data gagal dihapus !');
    		redirect('Frontend/Profile');
    	}
    }

    public function manajemenAlamat()
    {
    	
    	$id_member         =  $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->       row_array();
        $id_provinsi    = $_POST['id_provinsi'];
        $id_kota        = $_POST['id_kota'];
        $id_kecamatan   = $_POST['id_kecamatan'];
        $id_kelurahan   = $_POST['id_kelurahan'];
        $kode_pos       = $_POST['kode_pos'];
        $alamat         = $_POST['alamat'];

        $data = array(

            'id_member'     => $id_member['id_member'],     
            'alamat'        => $alamat,
            'id_provinsi'   => $id_provinsi,
            'id_kota'       => $id_kota,
            'id_kecamatan'  => $id_kecamatan,
            'id_kelurahan'  => $id_kelurahan,
            'kode_pos'      => $kode_pos
        );

        $add = $this->M_keranjang->insertAlamat('t_detail_alamat', $data);
        if ($add > 0) {
            $this->session->set_flashdata('berhasil', 'Data berhasil disimpan !');
            redirect('Frontend/Profile');
        } else {
            echo "gagal";
        }

    }

	public function _uploadImage()
	{
		$config['upload_path'] 		= './assets/images/faces/';
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['file_name'] 		= $_FILES['foto']['name'];
		$config['overwrite'] 		= true;
        $config['max_size'] 		= 2048;


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

	function add_ajax_kab($id_prov)
	{
    	$query = $this->db->get_where('t_kota',array('id_provinsi'=>$id_prov));
    	$data = "<option value='' disabled selected>Pilih Kabupaten/ Kota</option>";
    	foreach ($query->result() as $value) {
        	$data .= "<option value='".$value->id_kota."'>".$value->nama_kota."</option>";
    	}
    	echo $data;
	}
  
	function add_ajax_kec($id_kab)
	{
    	$query = $this->db->get_where('t_kecamatan',array('id_kota'=>$id_kab));
    	$data = "<option value='' disabled selected>Pilih Kecamatan</option>";
    	foreach ($query->result() as $value) {
        	$data .= "<option value='".$value->id_kecamatan."'>".$value->nama_kecamatan."</option>";
    	}
    	echo $data;
	}
  
	function add_ajax_des($id_kec)
	{
    	$query = $this->db->get_where('t_kelurahan',array('id_kecamatan'=>$id_kec));
    	$data = "<option value='' disabled selected>Pilih Kelurahan</option>";
    	foreach ($query->result() as $value) {
        	$data .= "<option value='".$value->id_kelurahan."'>".$value->nama_kelurahan."</option>";
    	}
    	echo $data;
	}
}
