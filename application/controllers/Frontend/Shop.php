<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Frontend/M_keranjang');
		$this->load->model('Admin/M_barang');
		$this->load->model('Admin/M_transaksi');
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			$data["user"] 	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->row_array();
			$data["member"] = $this->M_transaksi->getMember($data['user']['id_member']);
			$id_kategori=($this->uri->segment(4))?$this->uri->segment(4):0;
			$jumlah_data = $this->M_barang->jumlah_data();
			$data["kategori"] = $this->M_keranjang->getKategori();
			$config['base_url'] = base_url('Frontend/Shop/index'); //site url
        	$config['total_rows'] = $jumlah_data; //total row
        	$config['per_page'] = 6;  //show record per halaman
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
        	$data["barang"] = $this->M_keranjang->getBarang($config['per_page'], $from);
        	$data['pagination'] = $this->pagination->create_links();
        	$data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
        	$data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
        	$data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
        } else{
        	$id_kategori=($this->uri->segment(4))?$this->uri->segment(4):0;
        	$data["kategori"] = $this->M_keranjang->getKategori();
        	$jumlah_data = $this->M_barang->jumlah_data();
			$config['base_url'] = base_url('Frontend/Shop/index'); //site url
        	$config['total_rows'] = $jumlah_data; //total row
        	$config['per_page'] = 6;  //show record per halaman
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
        	$data["barang"] = $this->M_keranjang->getBarang($config['per_page'], $from);
        	$data['pagination'] = $this->pagination->create_links();
        }

        $this->load->view('Frontend/Shop', $data);
    }

    public function masuk_keranjang()
    {
    	if ($this->session->userdata('email')) {

    		$id_member 		= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->		row_array();
    		$id = $this->input->post('id_member');
    		$id_barang = $this->input->post('id_barang');
    		$data = $this->input->post();
    		$cek = $this->M_keranjang->ambilData($id_barang, $id);
            $dataUkuran = $this->M_keranjang->cekDataUkuran($id_barang);
    		$cek_ukuran = $this->M_keranjang->catatan();
            if ($_POST['jumlah'] >= $dataUkuran['jumlah']) {
                $this->session->set_flashdata('jumlah_kurang', 'Data');
                redirect('Frontend/Shop/tampil_keranjang');
            }else{
    		  if ($cek_ukuran == 0 OR $cek == 0) {
    		  	$this->M_keranjang->masuk_keranjang('t_keranjang', $data);
    		  } else{
    			 $update = $this->M_keranjang->updateJumlah($id_barang, $id, $this->input->post('jumlah'), $this->input->post('catatan'));
    		  }
            }

    		$this->session->set_flashdata('berhasil', 'Data berhasil disimpan !');
    		redirect('Frontend/Shop/tampil_keranjang');
    	} else{
    		redirect('Auth_member');
    	}
    }

    public function edit_catatan()
    {
    	$id 		= $this->input->post('id_keranjang');
    	$catatan 	= $_POST['catatan'];
    	$this->M_keranjang->editCatatan($id,$catatan);
    	$this->session->set_flashdata('berhasil_update', 'Data berhasil disimpan !');
    	redirect('Frontend/Shop/tampil_keranjang');	
    }

    public function tampil_keranjang()
    {
    	is_login();
    	$data["user"] 	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->row_array();
    	$data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
    	$data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
    	$data["data_keranjang"] = $this->M_keranjang->getKeranjang($data['user']['id_member']);
    	$data["total_bayar"] 	= $this->M_keranjang->getTotalBayar($data['user']['id_member']);
    	$data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
    	$data["getKeranjang2"] 	= $this->M_keranjang->getKeranjang2($data['user']['id_member']);
    	$this->load->view('Frontend/Chart', $data);
    }

    public function shop_detail($id)
    {
    	if ($this->session->userdata('email')) {
    		is_login();
    		$data["user"] 	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->		row_array();
    		$data["member"] = $this->M_transaksi->getMember($data['user']['id_member']);
    		$data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
    		$data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
    		$data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
    		$data["barang"] = $this->M_keranjang->dataEdit($id);
            $data["dataUkuran"] = $this->M_barang->getDetailBarang($id);
    	} else{
    		$data["barang"] = $this->M_keranjang->dataEdit($id);
            $data["dataUkuran"] = $this->M_barang->getDetailBarang($id);
    	}

    	$this->load->view('Frontend/Shop-detail', $data);
    }

    public function hapus_keranjang($id=null)
    {
    	$hapus = $this->M_keranjang->hapusData('t_keranjang',$id);
    	if ($hapus > 0) {
    		$this->session->set_flashdata('hapus', 'Data berhasil disimpan !');
    		
    	} else {
    		$this->session->set_flashdata('hapus_gagal', 'Data gagal disimpan !');
    	
    	}
    	redirect('Frontend/Shop/tampil_keranjang');
    }


    public function filter($id)
    {
    	if ($this->session->userdata('email')) {
    		$data["user"] 	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->		row_array();
    		$data["member"] = $this->M_transaksi->getMember($data['user']['id_member']);
    		$data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
    		$data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
    		$data["total_keranjang"]= $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
    		$where 					= array('id_kategori' => $id);
    		$data['kategori'] 		= $this->M_keranjang->getKategori();
    		$data['barang'] 			= $this->M_keranjang->kategori($where);
    	} else{
    		$where = array('id_kategori' => $id);
    		$data['kategori'] 	= $this->M_keranjang->getKategori();
    		$data['barang'] 		= $this->M_keranjang->kategori($where);
    	}
    	$this->load->view('Frontend/Filter', $data);
    }

    public function search()
    {
    	if ($this->session->userdata('email')) {
    		$data["user"] 	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->		row_array();
    		$data["member"] = $this->M_transaksi->getMember($data['user']['id_member']);
    		$data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
    		$keyword 			= $this->input->get('keyword');
    		$data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
    		$data["kategori"] 	= $this->M_keranjang->getKategori();
    		$data['barang']		= $this->M_barang->searchBarang($keyword);
    		$data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
    	}else{
    		$keyword 			= $this->input->get('keyword');
    		$data["kategori"] 	= $this->M_keranjang->getKategori();
    		$data['barang']		= $this->M_barang->searchBarang($keyword);
    	}
    	$this->load->view('Frontend/Search_barang',$data);
    }

    public function hargaASC()
    {
    	if ($this->session->userdata('email')) {
    		$data["user"] 	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->		row_array();
    		$data["member"] = $this->M_transaksi->getMember($data['user']['id_member']);
            $jumlah_data = $this->M_barang->jumlah_data();
            $config['base_url'] = base_url('Frontend/Shop/hargaASC'); //site url
            $config['total_rows'] = $jumlah_data; //total row
            $config['per_page'] = 6;  //show record per halaman
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
            $data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
            $data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
            $data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
            $data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
            $data["kategori"]   = $this->M_keranjang->getKategori();
            $data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
            $data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
            $from = $this->uri->segment(4);
            $this->pagination->initialize($config);
            $data["barang"] = $this->M_keranjang->hargaASC($config['per_page'], $from);
            $data['pagination'] = $this->pagination->create_links();
            
    	} else{
            $jumlah_data = $this->M_barang->jumlah_data();
    		$config['base_url'] = base_url('Frontend/Shop/hargaASC'); //site url
            $config['total_rows'] = $jumlah_data; //total row
            $config['per_page'] = 6;  //show record per halaman
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
            $data["barang"] = $this->M_keranjang->hargaASC($config['per_page'], $from);
            $data['pagination'] = $this->pagination->create_links();
            $data["kategori"]   = $this->M_keranjang->getKategori();
    	}
    	$this->load->view('Frontend/HargaASC', $data);

    }

    public function hargaDESC()
    {
        if ($this->session->userdata('email')) {
            $data["user"]   = $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->        row_array();
            $data["member"] = $this->M_transaksi->getMember($data['user']['id_member']);
            $jumlah_data = $this->M_barang->jumlah_data();
            $config['base_url'] = base_url('Frontend/Shop/hargaDESC'); //site url
            $config['total_rows'] = $jumlah_data; //total row
            $config['per_page'] = 6;  //show record per halaman
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
            $data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
            $data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
            $data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
            $data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
            $data["kategori"]   = $this->M_keranjang->getKategori();
            $data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
            $data["total_keranjang"] = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
            $from = $this->uri->segment(4);
            $this->pagination->initialize($config);
            $data["barang"] = $this->M_keranjang->hargaDESC($config['per_page'], $from);
            $data['pagination'] = $this->pagination->create_links();
            
        } else{
            $jumlah_data = $this->M_barang->jumlah_data();
            $config['base_url'] = base_url('Frontend/Shop/hargaDESC'); //site url
            $config['total_rows'] = $jumlah_data; //total row
            $config['per_page'] = 6;  //show record per halaman
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
            $data["barang"] = $this->M_keranjang->hargaDESC($config['per_page'], $from);
            $data['pagination'] = $this->pagination->create_links();
            $data["kategori"]   = $this->M_keranjang->getKategori();
        }
        $this->load->view('Frontend/HargaASC', $data);

    }

    public function menunggu_pembayaran()
    {
    	$data["user"] 	= $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->		row_array();
    	$data["row_keranjang"] = $this->M_keranjang->getRowNavKeranjang($data['user']['id_member']);
    	$data["nav_keranjang"] = $this->M_keranjang->getNavKeranjang($data['user']['id_member']);
    	$data["menunggu_pembayaran"] = $this->M_keranjang->menunggu_pembayaran($data['user']['id_member']);
    	$data["getMenunggu"]		 = $this->M_keranjang->getMenunggu($data['user']['id_member']);
    	$data["total_keranjang"] 	 = $this->M_keranjang->getTotalKeranjang($data['user']['id_member']);
    	$this->load->view('Frontend/Menunggu_pembayaran', $data);
    }

    public function updateSampai($id)
    {
        $update = array(
            'status_transaksi' => 'Selesai'  
        );

        $ubah = $this->M_transaksi->updateStatus($id, $update);

        if ($ubah > 0) {
            $this->session->set_flashdata('selamat', 'Data berhasil disimpan !');
            redirect('Frontend/Riwayat');
        } else {
            $this->session->set_flashdata('selamat_gagal', 'Data gagal disimpan !');
            redirect('Frontend/Riwayat');
        }
    }

    public function beriRating()
    {
        $id_member  = $this->db->get_where('t_member', ['email' => $this->session->userdata('email')])->        row_array();
        $rating     = $_POST['rating'];
        $id_barang  = $_POST['id_barang'];

        $add = array(
            'id_barang' => $id_barang,
            'id_member' => $id_member['id_member'],
            'rating'    => $rating
        );

        $tambah = $this->M_transaksi->tambahRating($add);


        if ($tambah > 0) {
            $this->session->set_flashdata('berhasil', 'Data berhasil disimpan !');
            redirect('Frontend/Riwayat');
        } else {
            $this->session->set_flashdata('gagal', 'Data gagal disimpan !');
            redirect('Frontend/Riwayat');
        }
    }

    public function update_transaksi()
    {
    	$id 				= $this->input->post('id_transaksi');
    	$upload_pembayaran  = $this->_uploadImage();
    	$transaksi 			= $this->M_transaksi->getTransaksi1($id);
    	if ($transaksi['status_transaksi'] === 'Menunggu Pembayaran') {
    		$update = array(
    			'status_transaksi' => 'Menunggu Konfirmasi'	
    		);
    	}
    	$data['status'] = $this->M_transaksi->updateStatus($id, $update);
    	$add = $this->M_transaksi->uploadPembayaran($id, $upload_pembayaran);

    	if ($add > 0) {
    		$this->session->set_flashdata('selamat', 'Data berhasil disimpan !');
    		redirect('Frontend/Riwayat');
    	} else {
    		$this->session->set_flashdata('selamat_gagal', 'Data gagal disimpan !');
    		redirect('Frontend/Riwayat');
    	}
    }

    

    public function updateBatalStatus($id)
    {
    	$transaksi = $this->M_transaksi->getTransaksi1($id);
    	if ($transaksi['status_transaksi'] === 'Menunggu Pembayaran') {
    		$update = array(
    			'status_transaksi' => 'Pesanan Dibatalkan'	
    		);
    	}

    	$data['status'] = $this->M_transaksi->updateStatus($id, $update);

    	if ($data > 0) {
    		$this->session->set_flashdata('selamat', 'Data berhasil disimpan !');
    		redirect('Frontend/Riwayat');
    	} else {
    		$this->session->set_flashdata('selamat_gagal', 'Data gagal disimpan !');
    		redirect('Frontend/Riwayat');
    	}
    }

    public function _uploadImage()
    {
    	$config['upload_path'] 		= './assets/images/upload/bukti_pembayaran/';
    	$config['allowed_types'] 	= 'gif|jpg|png';
    	$config['file_name'] 		= $_FILES['upload_pembayaran']['name'];
    	$config['overwrite'] 		= true;
        // $config['max_size'] = 1024;


    	$this->load->library('upload', $config);

    	if ($this->upload->do_upload('upload_pembayaran')) {
    		return $this->upload->data("file_name");
    	}
    	return "default.png";
    }

    public function qty_plus($id)
    {
    	$data = $this->db->query("SELECT * FROM t_keranjang WHERE id_keranjang='".$id."'")->row();
    	$this->db->query("UPDATE t_keranjang SET jumlah = $data->jumlah+1 WHERE id_keranjang = '$id'");
    	redirect('Frontend/Shop/tampil_keranjang');
    }

    public function qty_min($id)
    {
    	$data = $this->db->query("SELECT * FROM t_keranjang WHERE id_keranjang='".$id."'")->row();
    	if ($data->jumlah > 1) {
    		$this->db->query("UPDATE t_keranjang SET jumlah = $data->jumlah-1 WHERE id_keranjang = '$id'");
    	}else{
    		$this->db->query("DELETE FROM t_keranjang WHERE id_keranjang = '$id'");
    	}
    	redirect('Frontend/Shop/tampil_keranjang');
    }
}
