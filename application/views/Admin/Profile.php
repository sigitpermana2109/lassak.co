<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('_partials_admin/header');
$this->load->view('_partials_admin/navbar');
$this->load->view('_partials_admin/layout');
$this->load->view('_partials_admin/sidebar');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Profile</div>
            </div>
          </div>
          <div class="section-body">
            <h2 class="section-title">Hi, <?= $admin_user['nama_lengkap']; ?> !</h2>
            <p class="section-lead">
              Merubah informasi anda
            </p>

            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget ">
                  <div class="profile-widget-header ">                     
                    <img alt="image" src="<?= base_url('assets/images/faces/'.$admin_user['foto']); ?>" class="rounded-circle mx-auto d-block" style="max-width: 50%;">
                  </div>
                
              
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <div class="card-header">
                      <ul class="nav py-2">
                         <li class="active"><a href="#settings" data-toggle="tab" class="btn btn-warning btn-rounded">Edit profile</a></li>&nbsp
                         <li><a href="#password" data-toggle="tab" class="btn btn-warning btn-rounded">Ubah password</a></li>
                       </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content">
                         <div class="active tab-pane" id="settings">
                           <form class="forms-sample" method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Admin/update/'.$admin_user['id_admin']);  ?>">
                              <div class="class row">
                                <div class="col-lg">
                                  <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Nama lengkap</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" 
                                            value="<?= $admin_user['nama_lengkap']; ?>">
                                            <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="username" name="username" value="<?= $admin_user['username']; ?>" readonly>
                                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="email" name="email" value="<?= $admin_user['email']; ?>" readonly>
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">No Rekening</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="no_rekening" name="no_rekening" value="<?= $admin_user['no_rekening']; ?>">
                                            <?= form_error('no_rekening', '<small class="text-danger pl-3">', '</small>'); ?>
                        
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Nama Pemilik</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" value="<?= $admin_user['nama_pemilik']; ?>">
                                            <?= form_error('nama_pemilik', '<small class="text-danger pl-3">', '</small>'); ?>
                        
                                        </div>
                                    </div> -->
                                    <div class=" form-group row">
                                        <div class="col-sm-2">Pictures</div>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-sm-9">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="foto" name="foto">
                                                        <input type="hidden" name="old_image" value="<?= $admin_user['foto'] ?>">
                                                        <label class="custom-file-label" 
                                                        for="image">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                      <button class="btn btn-primary btn-rounded">Update</button>
                                   </div>
                                </div>
                              </div>
                            </form>
                         </div>
                         
                         <div class="tab-pane" id="password">
                           <form class="form-horizontal" action="<?php echo base_url('Admin/Admin/ubahPassword/'.$admin_user['id_admin']); ?>" method="POST">
                             <div class="form-group row">
                              <label for="name" class="col-sm-2 col-form-label">Ubah Password</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" id="password1" name="password1">
                                  <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
              
                              </div>
                              </div>
                              <div class="form-group row">
                                  <label for="name" class="col-sm-2 col-form-label">Ulang Password</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="password2" name="password2">
                                      <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                              </div>                            
                              <div class="card-footer text-right">
                                <button class="btn btn-primary btn-rounded">Ubah password</button>
                              </div>
                           </form>
                         </div>
                       </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php $this->load->view('_partials_admin/footer'); ?>