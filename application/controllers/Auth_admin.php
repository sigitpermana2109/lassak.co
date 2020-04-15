<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        if ($this->session->userdata('email_admin')) {
            redirect('Admin/Home');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login admin';
            $this->load->view('Admin/Login_admin', $data);
        } else {
                // validasinya succes 
            $this->_login();
        }
    }


    private function _login()
    {
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');

        $user = $this->db->get_where('t_admin', ['email' => $email])->row_array();

            // jika usernya ada
        if ($user) {
                    // cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email_admin'     => $user['email'],
                ];
                $this->session->set_userdata($data);
                redirect('Admin/Home');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show mx-4" role="alert">
          <strong>Password Salah!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>');
                redirect('Auth_admin');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show mx-4" role="alert">
          <strong>Email tidak terdaftar!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>');
            redirect('Auth_admin');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email_admin');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show mx-4" role="alert">
          <strong>Anda telah logout!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>');
        redirect('Auth_admin');
    }


    public function blocked()
    {
        $this->load->view('auth/404');
    }
}
