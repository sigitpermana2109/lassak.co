<?php  

class Ongkir extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('email_admin')) {
		} else{
			redirect('Auth_admin');
		}
		$this->load->model('Admin/M_ongkir');
	}

	public function index()
	{
		$jumlah_data = $this->M_ongkir->jumlah_data();
		$config['base_url'] = base_url('Admin/Ongkir/index'); //site url
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
        $data['ongkir'] = $this->M_ongkir->getongkir($config['per_page'], $from);
        $data['pagination'] = $this->pagination->create_links();
        $data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
        $data['title'] 		= 'Data ongkir';
        $data["kurir"] 	= $this->M_ongkir->getKurir();
        $data["kota"]	= $this->M_ongkir->getKota();
        $this->load->view("Admin/Ongkir/List", $data);
    }


    public function insert()
    {
    	$id = $this->input->post('id_ongkir');
    	$id_kurir		= $_POST['id_kurir'];
    	$id_kota		= $_POST['id_kota'];
    	$harga 			= $_POST['harga'];
    	$data = array(
    	    'id_kurir'  => $id_kurir,
    	    'id_kota'   => $id_kota,
    	    'harga'     => $harga
    	);

    	if ($id == NULL || $id == '') {
    		$add = $this->M_ongkir->tambahOngkir('t_ongkir', $data);
    	}  else{
    		$add = $this->M_ongkir->editOngkir('t_ongkir', $data, $id);
    	} 

    	if ($add > 0) {
    		$this->session->set_flashdata('berhasil', 'Data berhasil disimpan !');
    		redirect('Admin/Ongkir');
    	} else {
    		$this->session->set_flashdata('gagal', 'Data gagal disimpan !');
    		redirect('Admin/Ongkir');
    	}

    }

    public function delete($id=null)
    {
    	$hapus = $this->M_ongkir->hapusData('t_ongkir', $id);
    	if($hapus > 0) {
    		$this->session->set_flashdata('hapus', 'Data berhasil dihapus !');
    		redirect('Admin/Ongkir');
    	}else{
    		$this->session->set_flashdata('hapus_gagal', 'Data gagal dihapus !');
    		redirect('Admin/Ongkir');
    	}
    }

    public function search()
    {
        $data["admin_user"] = $this->db->get_where('t_admin', ['email' => $this->session->userdata('email_admin')])->row_array();
        $keyword           = $this->input->get('keyword');
        $data['ongkir']    = $this->M_ongkir->search($keyword);
        $data['title']     = 'Data Ongkir';
        $this->load->view('Admin/Ongkir/Search',$data);
    }
}
