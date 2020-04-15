<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin/M_member');
        $this->load->model('Frontend/M_keranjang');
    }


    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('home', 'refresh');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Member';
            $data["provinsi"] = $this->M_keranjang->get_provinsi();
            $this->load->view('Frontend/Login_member', $data);
        } else {
                // validasinya succes 
            $this->_login();
        }
    }


    private function _login()
    {
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');

        $user = $this->db->get_where('t_member', ['email' => $email])->row_array();

            // jika usernya ada
        if ($user) {
                    // cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email'     => $user['email']
                ];
                $this->session->set_userdata($data);
                redirect('home', 'refresh');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show mx-4" role="alert">
          <strong>Password Salah!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>');
                redirect('Auth_member');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show mx-4" role="alert">
          <strong>Email tidak terdaftar!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>');
            redirect('Auth_member');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show mx-4" role="alert">
          <strong>Anda telah logout!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>');
        redirect('Auth_member');
    }

    public function daftar()
    {
        $data['title'] = 'Registrasi';
        $data["provinsi"] = $this->M_keranjang->get_provinsi();
        date_default_timezone_set('Asia/Jakarta');
        $this->form_validation->set_rules('nama_depan',' ', 'required|trim');
        $this->form_validation->set_rules('alamat',' ', 'required|trim');
        $this->form_validation->set_rules('nama_belakang',' ', 'required|trim');
        $this->form_validation->set_rules('tgl_lahir',' ', 'required|trim');
        $this->form_validation->set_rules('id_kota',' ', 'required',
            [
                'required' => 'Mohon Pilih Salah Satu'
            ]
        );
        $this->form_validation->set_rules('jk',' ', 'required',
            [
                'required' => 'Mohon Pilih Salah Satu'
            ]
        );
        $this->form_validation->set_rules('email',' ', 'required|trim|valid_email|is_unique[t_member.email]',
            [
                'is_unique' => 'Email telah terdaftar !'
            ]
        );
        $this->form_validation->set_rules('no_telp',' ', 'required|trim');
        $this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[6]|matches[password2]',
            [
                'matches'       => 'Password Tidak Cocok !',
                'min_length'    => 'Password terlalu pendek'
            ]);
        $this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');


        if ($this->form_validation->run() == FALSE) {

            $this->load->view('Frontend/Register_member', $data);
        } else {    
            $nama_depan     = $_POST['nama_depan'];
            $nama_belakang  = $_POST['nama_belakang'];
            $jk             = $_POST['jk'];
            $tgl_lahir      = $_POST['tgl_lahir'];
            $no_telp        = $_POST['no_telp'];
            $email          = $_POST['email'];          
            $password1      = $_POST['password1'];
            $password2      = $_POST['password2'];

            $id = $this->M_member->get_last_id('id_member', 't_member');
            $id_member = ltrim($id['id_member'], "M");
            $id_member = sprintf('%04d', $id_member + 1);
            $id_member = "M".$id_member;

            $data = array(
                'id_member'     => $id_member,    
                'nama_depan'    => $nama_depan,
                'nama_belakang' => $nama_belakang,
                'jk'            => $jk,
                'tgl_lahir'     => $tgl_lahir,
                'password'      => password_hash($password1, PASSWORD_DEFAULT),
                'email'         => $email,
                'no_telp'       => $no_telp,
                'active'        => 'Aktif',
                'foto'          => 'default.jpg',
                'date_created'  => date('Y-m-d')
            );

            $id_provinsi    = $_POST['id_provinsi'];
            $id_kota        = $_POST['id_kota'];
            $id_kecamatan   = $_POST['id_kecamatan'];
            $id_kelurahan   = $_POST['id_kelurahan'];
            $kode_pos       = $_POST['kode_pos'];
            $alamat         = $_POST['alamat'];

            $alamat = array(

                'id_member'     => $id_member,     
                'id_provinsi'   => $id_provinsi,
                'id_kota'       => $id_kota,
                'id_kecamatan'  => $id_kecamatan,
                'id_kelurahan'  => $id_kelurahan,
                'alamat'        => $alamat,
                'kode_pos'      => $kode_pos,
                'status'        => 'publik'
            );


            $add = $this->M_member->tambahmember('t_member', $data);
            $this->M_member->tambahAlamat('t_detail_alamat', $alamat);
            if ($add > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show mx-4" role="alert">
          <strong>Registrasi Berhasil, Silahkan Login!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>');
                redirect('Auth_member');
            } else {
                echo "gagal";
            }
        }

    }

    public function _uploadImage()
    {
        $config['upload_path']      = './assets/images/faces/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['file_name']        = $_FILES['foto']['name'];
        $config['overwrite']        = true;
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

    public function add_ajax_kab($id_prov)
    {
        $query = $this->db->get_where('t_kota',array('id_provinsi'=>$id_prov));
        $data = "<option value='' disabled selected>Pilih Kabupaten/ Kota</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='".$value->id_kota."'>".$value->nama_kota."</option>";
        }
        echo $data;
    }
  
    public function add_ajax_kec($id_kab)
    {
        $query = $this->db->get_where('t_kecamatan',array('id_kota'=>$id_kab));
        $data = "<option value='' disabled selected>Pilih Kecamatan</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='".$value->id_kecamatan."'>".$value->nama_kecamatan."</option>";
        }
        echo $data;
    }
  
    public function add_ajax_des($id_kec)
    {
        $query = $this->db->get_where('t_kelurahan',array('id_kecamatan'=>$id_kec));
        $data = "<option value='' disabled selected>Pilih Kelurahan</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='".$value->id_kelurahan."'>".$value->nama_kelurahan."</option>";
        }
        echo $data;
    }

}