<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('_partials_admin/header');
?>
<body style="background-image: url('<?= base_url('assets/frontend/img/banner/b2.png'); ?>');background-size: cover;">
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-success">
              <h4 class="h3-responsive font-weight-bold text-center mt-3">Login</h4>
              <?= $this->session->flashdata('message'); ?>
              <div class="card-body">
                <form method="POST" action="<?= base_url('Auth_member'); ?>" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control" name="email" tabindex="1" placeholder="Alamat Email ..." value="<?= set_value('email'); ?>">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a class="text-success" href="<?php echo base_url(); ?>dist/auth_forgot_password" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" placeholder="Password ...">
                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>        

                  <div class="form-group">
                    <button type="submit" class="btn btn-outline-success btn-lg btn-block btn-rounded" tabindex="4">
                      Login
                    </button>
                    <p class="text-center">Belum punya akun ? <a class="text-success" href="<?= base_url('Auth_member/daftar'); ?>">Daftar Disini !</a></p>
                  </div>
                </form>
                  <hr>
                  <p class="text-center">Copyright &copy; Lassak.co 2020</p>       
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php $this->load->view('_partials_admin/js'); ?>