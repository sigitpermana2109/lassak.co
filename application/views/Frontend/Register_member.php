<!DOCTYPE html>
<html lang="en">

<head>
  <title>Lassak ecommerce</title>
  <?php $this->load->view('_layout_frontend/head.php'); ?>
</head>

<body style="background-image: url('<?= base_url('assets/images/auth/b8.png'); ?>');">
  <div id="app">
    <section class="section">
      <div class="container my-5">

        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">

           <!-- Material form register -->
           <div class="card">

            <h5 class="card-header success-color white-text py-4">
              <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="logo" width="50" class="shadow-light rounded-circle "> <span class="text-center">Registrasi</span>
            </h5>

            <!--Card content-->
            <div class="card-body px-lg-5 pt-0">

              <!-- Form -->
              <form class="text-center" style="color: #757575;" method="POST" action="<?= base_url('Auth_member/daftar'); ?>" enctype="multipart/form-data">

                <div class="form-row">
                  <div class="col">
                    <!-- First name -->
                    <div class="md-form">
                      <input type="text" name="nama_depan" type="text" id="materialRegisterFormFirstName" class="form-control">                  
                      <label for="materialRegisterFormFirstName">Nama Depan</label>
                      <?= form_error('nama_depan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                  </div>
                  <div class="col">
                    <!-- Last name -->
                    <div class="md-form">
                      <input type="text" name="nama_belakang" id="materialRegisterFormLastName" class="form-control">
                      <label for="materialRegisterNamaBelakang">Nama Belakang</label>
                      <?= form_error('nama_belakang', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col">
                    <!-- First name -->
                    <div class="md-form">              
                      <input type="text" class="form-control datepicker" id="tgl_lahir" name="tgl_lahir">
                      <label for="tgl_lahir">Tanggal Lahir</label>
                      <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                  </div>
                  <div class="col">
                    <!-- Last name -->
                    <div class="md-form">
                      <select class="mdb-select md-form" name="jk">
                        <option value="" disabled="" selected="">Jenis Kelamin</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                      </select>
                      <?= form_error('jk', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col">
                    <!-- First name -->
                    <div class="md-form">
                      <input type="email" name="email" class="form-control" id="materialRegisterFormEmail">
                      <label for="materialRegisterFormEmail">E-mail</label>
                      <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                  </div>
                  <div class="col">
                    <!-- Last name -->
                    <div class="md-form">
                      <input type="number" name="no_telp" id="materialRegisterFormPhone" class="form-control">
                      <label for="materialRegisterFormPhone">No Telephone</label>
                      <?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col">
                    <!-- First name -->
                    <div class="md-form">
                      <select class="mdb-select md-form" searchable="Cari disini ..." name="id_provinsi" id="provinsi" required>
                        <option value="" disabled selected>Pilih Provinsi</option>
                        <?php 
                        foreach($provinsi as $prov)
                        {
                          echo '<option value="'.$prov['id_provinsi'].'">'.$prov['nama_provinsi'].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col">
                    <!-- Last name -->
                    <div class="md-form">
                      <select name="id_kota" class="mdb-select md-form" searchable="Cari disini ..." id="kabupaten" required>
                        <option value="" disabled selected>Pilih Kabupaten/ Kota</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col">
                    <!-- First name -->
                    <div class="md-form">
                      <select name="id_kecamatan" class="mdb-select md-form" searchable="Cari disini ..." id="kecamatan" required>
                        <option value="" disabled selected>Pilih Kecamatan</option>
                      </select>
                    </div>
                  </div>
                  <div class="col">
                    <!-- Last name -->
                    <div class="md-form">
                      <select name="id_kelurahan" class="mdb-select md-form" searchable="Cari disini ..." id="desa" required>
                        <option value="" disabled selected>Pilih Kelurahan</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="md-form">
                  <select class="mdb-select md-form" disabled>
                    <option value="" disabled selected> Isi alamat dan kode pos dengan benar ! </option>
                  </select>
                </div>

                <div class="form-row">
                  <div class="col">
                    <!-- First name -->
                    <div class="md-form">
                      <textarea id="form7" name="alamat" class="md-textarea form-control" rows="1" required></textarea>
                      <label for="materialRegisterForm">Alamat Lengkap</label>
                    </div>
                  </div>
                  <div class="col">
                    <!-- Last name -->
                    <div class="md-form">
                      <input type="text" name="kode_pos" id="materialRegister" class="form-control" required>
                      <label for="materialRegister">Kode Pos</label>
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col">
                    <!-- First name -->
                    <div class="md-form">
                      <input type="password" name="password1" id="materialRegisterPassword1" class="form-control">
                      <label for="materialRegisterPassword1">Password</label>
                      <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                  </div>
                  <div class="col">
                    <!-- Last name -->
                    <div class="md-form">
                      <input type="password" name="password2" id="materialRegisterPassword2" class="form-control">
                      <label for="materialRegisterPassword2">Ulangi Password</label>
                      <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                  </div>
                </div>    

                <!-- Sign up button -->
                <button type="submit" class="btn btn-outline-success btn-rounded btn-block my-3">Daftarkan !</button>

                <!-- Social register -->
                <p>Sudah Punya Akun ? <a class="text-success" href="<?= base_url('Auth_member'); ?>">Login</a></p>

                <hr>

                <!-- Terms of service -->
                <p>Copyright &copy; Lassak.co 2019</a>

                </form>
                <!-- Form -->

              </div>

            </div>
            <!-- Material form register -->
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php $this->load->view('_layout_frontend/js.php'); ?>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#provinsi").change(function (){
        var url = "<?php echo site_url('Auth_member/add_ajax_kab');?>/"+$(this).val();
        $('#kabupaten').load(url);
        return false;
      })

      $("#kabupaten").change(function (){
        var url = "<?php echo site_url('Auth_member/add_ajax_kec');?>/"+$(this).val();
        $('#kecamatan').load(url);
        return false;
      })

      $("#kecamatan").change(function (){
        var url = "<?php echo site_url('Auth_member/add_ajax_des');?>/"+$(this).val();
        $('#desa').load(url);
        return false;
      })
    });
  </script>
  <?php $this->load->view('_layout_frontend/alert.php'); ?>
</body>
</html>