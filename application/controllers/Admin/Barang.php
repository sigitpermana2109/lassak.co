<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('email_admin')) {
		} else{
			redirect('Auth_admin');
		}
		$this->load->model('Admin/M_barang');
	}

	public function index()
	{
		$jumlah_data = $this->M_barang->jumlah_data();
		$config['base_url'] = base_url('Admin/Barang/index'); //site url
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
        $data['barang'] = $this->M_barang->getBarang($config['per_page'], $from);
        $data['pagination'] = $this->pagination->create_links();
        $data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
        $data["kategori"] 	= $this->M_barang->getKategori();
        $data['title'] 		= 'Data Barang';
        $this->load->view("Admin/Barang/List", $data);
    }

    public function detailBarang($id)
    {
        $data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
        $data["detail"] = $this->M_barang->detailBarang($id);
        $data["title"]  = 'Detail Barang';
        $this->load->view('Admin/Barang/Detail_barang', $data);
    }

    public function tambahUkuran()
    {
        $ukuran = $_POST['ukuran'];
        $panjang = $_POST['panjang'];
        $lebar  = $_POST['lebar'];
        $jumlah = $_POST['jumlah'];

        $data = array(
            'id_barang' => $this->input->post('id_barang'),
            'ukuran'    => $ukuran,
            'panjang'   => $panjang,
            'lebar'     => $lebar,
            'jumlah'    => $jumlah
        );

        $add = $this->M_barang->tambahBarang('t_detail_barang', $data);

        if ($add > 0) {

            $p = $this->db->query("SELECT stok FROM t_barang WHERE id_barang='".$this->input->post('id_barang')."'")->row();
            $stok = $p->stok + $jumlah;
            $isi = array(
                'stok' => $stok
            );
            $this->db->query("UPDATE t_barang SET stok='$stok' WHERE id_barang='".$this->input->post('id_barang')."'");
            $this->session->set_flashdata('berhasil', 'Data berhasil disimpan !');
            redirect('Admin/Barang/DetailBarang/'.$this->input->post('id_barang'));
        } else {
            $this->session->set_flashdata('gagal', 'Data gagal disimpan !');
            redirect('Admin/Barang/DetailBarang/'.$this->input->post('id_barang'));
        }
    }

    public function deleteUkuran()
    {
        $hapus = $this->M_barang->hapusUkuran('t_detail_barang',$this->input->get('id_detail_barang'));
        if($hapus > 0) {
            $p = $this->db->query("SELECT stok FROM t_barang WHERE id_barang='".$this->input->post('id_barang')."'")->row();
            $q = $this->db->query("SELECT jumlah FROM t_detail_barang WHERE id_detail_barang='".$this->input->get('id_detail_barang')."'")->row();
            $stok = $p->stok - $q->jumlah;
            $isi = array(
                'stok' => $stok
            );
            $this->db->query("UPDATE t_barang SET stok='$stok' WHERE id_barang='".$this->input->post('id_barang')."'");
            $this->session->set_flashdata('hapus', 'Data berhasil dihapus !');
            redirect('Admin/Barang/DetailBarang/'.$this->input->get('id_barang'));
        }else{
            $this->session->set_flashdata('hapus_gagal', 'Data gagal dihapus !');
            redirect('Admin/Barang/DetailBarang/'.$this->input->get('id_barang'));
        }
    }


    public function manajemen()
    {
    	$id = $this->input->post('id_barang');
    	$id_kategori	= $_POST['id_kategori'];
    	$nama_barang	= $_POST['nama_barang'];
    	$deskripsi 	 	= $_POST['deskripsi'];
    	$harga 			= $_POST['harga'];
    	$berat 			= $_POST['berat'];
    	$gambar1		= $this->_uploadImage();
    	
        $data = array(
            'id_kategori' => $id_kategori,
            'nama_barang' => $nama_barang,
            'deskripsi'   => $deskripsi,
            'harga'       => $harga,
            'berat'       => $berat,
            'gambar1'     => $gambar1,
            'date_created'=> date('Y-m-d')
        );

    	if ($id == NULL || $id == '') {
    		$add = $this->M_barang->tambahBarang('t_barang', $data);
    	} else{
    		$add = $this->M_barang->editBarang('t_barang', $data, $id);
    	} 

    	if ($add > 0) {
    		$this->session->set_flashdata('berhasil', 'Data berhasil disimpan !');
    		redirect('Admin/Barang');
    	} else {
    		$this->session->set_flashdata('gagal', 'Data gagal disimpan !');
    		redirect('Admin/Barang');
    	}

    }


    public function delete($id=null)
    {
    	$hapus = $this->_deleteImage($id);
    	$hapus = $this->M_barang->hapusData('t_barang',$id);
    	if($hapus > 0) {
    		$this->session->set_flashdata('hapus', 'Data berhasil dihapus !');
    		redirect('Admin/Barang');
    	}else{
    		$this->session->set_flashdata('hapus_gagal', 'Data gagal dihapus !');
    		redirect('Admin/Barang');
    	}
    }

    public function search()
    {
    	$data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
    	$keyword 		   = $this->input->get('keyword');
    	$data['barang']    = $this->M_barang->searchBarang($keyword);
        $data['title']     = 'Data Barang';
        $this->load->view('Admin/Barang/Search',$data);
    }

    public function _uploadImage()
    {
    	$config['upload_path'] 		= './assets/images/upload/';
    	$config['allowed_types'] 	= 'gif|jpg|png';
    	$config['file_name'] 		= $_FILES['gambar1']['name'];
    	$config['overwrite'] 		= true;
        // $config['max_size'] = 1024;


    	$this->load->library('upload', $config);

    	if ($this->upload->do_upload('gambar1')) {
    		return $this->upload->data("file_name");
    	}
    	return "default.png";
    }

    private function _deleteImage($id)
    {
    	$barang = $this->M_barang->dataEdit($id);
    	if ($barang->gambar1 != "default.png") {
    		$filename = explode(".", $barang->gambar1)[0];
    		return array_map('unlink', glob(FCPATH."assets/images/upload/$filename.*"));
    	}
    }
}
