<!DOCTYPE html>
<html lang="en">

<head>
  <title>Lassak ecommerce</title>
  <?php $this->load->view('_layout_frontend/head.php'); ?>
</head>

<body>
  <!--================Header Menu Area =================-->
  <?php $this->load->view('_layout_frontend/navbar.php'); ?>
  <!--================Header Menu Area =================-->

  <!--================Home Banner Area =================-->
  <section class="banner_area">
    <div class="banner_inner d-flex align-items-center" style="background-image: url(<?= base_url('assets/images/dashboard/banner_1.png'); ?>);">
      <div class="container">
        <div
        class="banner_content d-md-flex justify-content-between align-items-center"
        >
        <div class="mb-3 mb-md-0">
          <h1 style="color: #fff;">Profile saya</h1>
          <p style="color: #ebebeb;">Hubungi kami untuk segala pertanyaan anda</p>
        </div>
        <div class="page_link">
          <a href="index.html" style="color: #ebebeb;">Beranda</a>
          <a href="contact.html" style="color: #ebebeb;">Profile saya</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!-- ================ contact section start ================= -->
<section class="section_gap">
  <div class="container">


    <div class="section-body">
      <h2 class="section-title"><span class="fa fa-user"></span> <?= $member['nama_depan']; ?> <?= $member['nama_belakang']; ?></h2>

      <div class="row mx-auto d-block">
        <div class="col-xs-12 ">
          <nav>
            <div class="nav nav-tabs md-tabs nav-justified success-color my-4" role="tablist">
              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
                <i class="fas fa-user-circle"></i> Biodata Diri</a>
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
                <i class="far fa-address-book"></i> Daftar Alamat</a>
              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">
                <i class="fas fa-key"></i> Ubah Password</a>

            </div>
          </nav>
          <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane fade show active text-body" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <div class="row">
                <!-- First column -->
                <div class="col-lg-4 mb-4">

                  <!-- Card -->
                  <div class="card card-cascade narrower">

                    <!-- Card image -->
                    <div class="view view-cascade gradient-card-header warna-hitam lighten-3">
                      <h5 class="mb-0 text-white font-weight-bold">Edit Photo</h5>
                    </div>
                    <!-- Card image -->

                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center">
                      <img width="100" height="100" src="<?= base_url('assets/images/faces/'.$member['foto']); ?>" alt="User Photo" class="z-depth-1 mb-3 mx-auto img-fluid" />
                      

                      <p class="text-muted"><small> <p>Besar file : Maksimum 2 Megabytes<br>
                      Ekstensi : .JPG .JPEG .PNG</p></small></p>
                      <div class="row flex-center">
                        <a href="#" data-toggle="modal" data-target="#modalPicture" data-dismiss="modal" class="btn btn-success btn-rounded btn-sm" onclick="select('<?= $member['id_member'] ?>','<?= $member['foto'] ?>')">Pilih Foto</a>
                      </div>
                    </div>
                    <!-- Card content -->

                  </div>
                  <!-- Card -->

                </div>
                <!-- First column -->

                <!-- Second column -->
                <div class="col-lg-8 mb-4">

                  <!-- Card -->
                  <div class="card card-cascade narrower">

                    <!-- Card image -->
                    <div class="view view-cascade gradient-card-header warna-hitam lighten-3">
                      <h5 class="mb-0 text-white font-weight-bold">Update Akun</h5>
                    </div>
                    <!-- Card image -->

                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center">

                      <!-- Edit Form -->
                      <form method="POST" action="<?= base_url('Frontend/Profile/update/'.$member['id_member']); ?>">
                        <!-- First row -->

                        <div class="row">

                          <!-- First column -->
                          <div class="col-md-6">
                            <div class="md-form mb-0">
                              <input type="text" id="form1" class="form-control" name="nama_depan" 
                              value="<?= $member['nama_depan']; ?>">
                              <?= form_error('nama_depan', '<small class="text-danger pl-3">', '</small>'); ?>
                              <label for="form1" data-error="wrong" data-success="right">Nama Depan</label>
                            </div>
                          </div>
                          <!-- Second column -->
                          <div class="col-md-6">
                            <div class="md-form mb-0">
                              <input type="text" class="form-control" id="form1" name="nama_belakang" 
                              value="<?= $member['nama_belakang']; ?>">
                              <?= form_error('nama_belakang', '<small class="text-danger pl-3">', '</small>'); ?>
                              <label for="form2" data-error="wrong" data-success="right">Nama Belakang</label>
                            </div>
                          </div>
                        </div>
                        <!-- First row -->

                        <!-- First row -->
                        <div class="row">
                          <!-- First column -->
                          <div class="col-md-6">
                            <div class="md-form mb-0">
                              <input type="text" class="form-control datepicker" id="tgl_lahir" name="tgl_lahir" 
                              value="<?= $member['tgl_lahir']; ?>">
                              <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                              <label for="form81" data-error="wrong" data-success="right">Tanggal Lahir</label>
                            </div>
                          </div>

                          <!-- Second column -->
                          <div class="col-md-6">
                            <div class="md-form mb-0">
                              <select class="mdb-select md-form" name="jk" id="jk">
                                <?php
                                $jk = $member['jk'];
                                if($jk == 'Pria') { ?>
                                  <option value="" disabled="">-- Pilih Jenis Kelamin --</option>
                                  <option value="Pria" selected>Pria</option>
                                  <option value="Wanita">Wanita</option>
                                <?php } elseif($jk == 'Wanita') { ?>
                                  <option value="" disabled="">-- Pilih Jenis Kelamin --</option>
                                  <option value="Pria">Pria</option>
                                  <option value="Wanita" selected>Wanita</option>
                                <?php } ?>
                              </select>
                              <?= form_error('jk', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                          </div>
                        </div>
                        <!-- First row -->

                        <!-- Second row -->
                        <div class="row">

                          <!-- First column -->
                          <div class="col-md-6">
                            <div class="md-form mb-0">
                              <input type="email" class="form-control" id="form1" name="email" value="<?= $member['email']; ?>" readonly>
                              <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                              <label for="form76">E-mail</label>
                            </div>
                          </div>
                          <!-- Second column -->

                          <div class="col-md-6">
                            <div class="md-form mb-0">
                              <input type="number" class="form-control" id="form1" name="no_telp" value="<?= $member['no_telp']; ?>" >
                              <?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
                              <label for="form77" data-error="wrong" data-success="right">No Telephone</label>
                            </div>
                          </div>
                        </div>
                        <!-- Second row -->

                        <!-- Fourth row -->
                        <div class="row">
                          <div class="col-md-12 text-center my-4">
                            <input type="submit" value="Update Akun" class="btn btn-success btn-rounded">
                          </div>
                        </div>
                        <!-- Fourth row -->

                      </form>
                      <!-- Edit Form -->

                    </div>
                    <!-- Card content -->

                  </div>
                  <!-- Card -->

                </div>
                <!-- Second column -->
              </div>
            </div>
            <div class="tab-pane fade text-body" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
              <div>
                <a href="#" data-toggle="modal" data-target="#modalTambah" class="btn btn-success btn-rounded my-4">
                  <span class="fa fa-plus"></span> Tambah Alamat
                </a>
              </div>
              <table class="table">
                <thead>
                  <th></th>
                  <th>Alamat Pengiriman</th>
                  <th>Kota Pengiriman</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </thead>
                <?php foreach ($alamat as $row) { ?>
                  <tbody>
                    <td>
                      <?php if ($row['status'] == 'arsip') { ?>
                        <a href="<?= base_url('Frontend/Checkout/updateAlamat/'.$row['id_alamat']); ?>" class="btn btn-success btn-rounded btn-sm">Publik</a>
                      <?php }elseif($row['status'] == 'publik') { ?>

                      <?php } ?>
                    </td>
                    <td><?= $row['alamat'] ?></td>
                    <td><?= $row['nama_kota'] ?></td>
                    <td><?= $row['status'] ?> </td>
                    <td>
                      <a href="#" data-toggle="modal" data-target="#modalAlamat" onclick="pilih('<?= $row['id_alamat'] ?>','<?= $row['alamat'] ?>','<?= $row['id_kota'] ?>','<?= $row['id_member'] ?>')" class="btn btn-success btn-rounded btn-sm"><span class="fa fa-edit"></span></a>
                      <a href="#" data-toggle="modal" data-target="#modalHapus<?=$row['id_alamat'];?>" class="btn btn-outline-success btn-rounded btn-sm"><span class="fa fa-trash"></span></a>
                    </td>

                  </tbody>
                <?php } ?>
              </table>
            </div>
            <div class="tab-pane fade text-body" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
              <div class="col-md-11 mx-auto d-block">
                <?= $this->session->flashdata('message'); ?>
                <form action="<?= base_url('Frontend/Profile/ubahPassword'); ?>" method="post">
                  <div class="md-form">
                    <label for="current_password">Password Sekarang</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                    <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="md-form">
                    <label for="new_password1">Password Baru</label>
                    <input type="password" class="form-control" id="new_password1" name="new_password1">
                    <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="md-form">
                    <label for="new_password2">Ulang Password</label>
                    <input type="password" class="form-control" id="new_password2" name="new_password2">
                    <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="md-form">
                    <button type="submit" class="btn btn-success btn-rounded">Ubah Password</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>


  </div>
</div>
</section>

<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby=#modalTambah" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold text-center" id="exampleModalLabel">Tambah Alamat Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST" enctype="multipart/form-data" action="<?= base_url('Frontend/Profile/manajemenAlamat');  ?>">
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
          <div class="md-form">
            <select name="id_kota" class="mdb-select md-form" searchable="Cari disini ..." id="kabupaten" required>
              <option value="" disabled selected>Pilih Kabupaten/ Kota</option>
            </select>
          </div>
          <div class="md-form">
            <select name="id_kecamatan" class="mdb-select md-form" searchable="Cari disini ..." id="kecamatan" required>
              <option value="" disabled selected>Pilih Kecamatan</option>
            </select>
          </div>
          <div class="md-form">
            <select name="id_kelurahan" class="mdb-select md-form" searchable="Cari disini ..." id="desa" required>
              <option value="" disabled selected>Pilih Kelurahan</option>
            </select>
          </div>
          <div class="md-form">
            <select class="mdb-select md-form" disabled>
              <option value="" disabled selected>Mohon isi alamat dengan lengkap dan tepat !</option>
            </select>
          </div>
          <div class="md-form">
            <textarea id="form7" name="alamat" class="md-textarea form-control" rows="2" required></textarea>
            <label for="form7">Alamat Lengkap</label>
            <input type="hidden" name="id_alamat" id="id_alamat">
          </div>
          <div class="md-form">
            <input input type="text" id="form1" name="kode_pos" class="form-control" required>
            <label for="form1">Kode Pos</label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-success" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah-->
<div class="modal fade" id="modalPicture" tabindex="-1" role="dialog" aria-labelledby=#modalPicture" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refresh()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form class="forms-sample" id="addForm" method="POST" enctype="multipart/form-data" action="<?= base_url('Frontend/Profile/updateFoto');  ?>">

          <div class="form-group">
            <img id="foto_cover" class="m-2 mx-auto d-block" style="border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 300px;height: 400px;"  src="<?=base_url('assets/images/faces/default.jpg'); ?>">
            <input type="file" id="cover" name="foto" class="form-control" onchange="loadFile(event)" /><br>
          </div>
          <input type="hidden" name="id_member" id="id_member">
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="refresh()">Batal</button>
            <button type="submit" class="btn btn-primary" >Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Tambah -->


<?php foreach ($alamat as $row) { ?>
  <!-- Modal Konfirmasi -->
  <div class="modal" tabindex="-1" id="modalHapus<?=$row['id_alamat'];?>" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Apakah Anda Yakin ?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Data yang anda hapus tidak akan kembali lagi</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
          <a href="<?= base_url('Frontend/Profile/deleteAlamat/'.$row['id_alamat']); ?>" class="btn btn-danger">Yakin</a>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Konfirmasi -->
<?php } ?>

<!-- ================ contact section end ================= -->

<!--================ start footer Area  =================-->
<?php $this->load->view('_layout_frontend/footer.php'); ?>
<!--================ End footer Area  =================-->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script type="text/javascript">
  function select($id_member, $foto){
    $("#id_member").val($id_member);
    var link = "<?= base_url()?>assets/images/faces/";
    document.getElementById("foto_cover").src = link+$foto;
  }

  function pilih($id_alamat, $alamat, $id_kota, $id_member){
    $("#id_alamat").val($id_alamat);
    $("#alamat").val($alamat);
    $("#id_kota").val($id_kota);
    $('#id_member').val($id_member);
  }

  function refresh(){
    $("#id_member").val('');
    document.getElementById("foto_cover").src = '<?= base_url('assets/images/faces/default.jpg'); ?>';
  }

  function refresh2(){
    $("#id_alamat").val('');
    $("#alamat").val('');
    $("#id_kota").val('');
    
  }

  $("#tag").select2();
  var loadFile = function(event) {
    var output = document.getElementById('foto_cover');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>
<script src="<?= base_url('assets/MDB/js/jquery.min.js');?>"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#kategori').change(function(){
      var id=$(this).val();
      $.ajax({
        url : "<?php echo base_url();?>Frontend/Checkout/get_detail_ongkir",
        method : "POST",
        data : {id: id},
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '';
          var i;
          var a;
          for(i=0; i<data.length; i++){
            html += data[i].harga;
            var b = data[i].harga;
            var c = $('#total').val();
            a = Number(b) + Number(c);
          }
          $('.subkategori').val(html);
          $('.subkategori').html(html);
          $('.total').html(a);
          $('#tagihan').val(a);

        }
      });
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#provinsi").change(function (){
      var url = "<?php echo site_url('Frontend/Profile/add_ajax_kab');?>/"+$(this).val();
      $('#kabupaten').load(url);
      return false;
    })

    $("#kabupaten").change(function (){
      var url = "<?php echo site_url('Frontend/Profile/add_ajax_kec');?>/"+$(this).val();
      $('#kecamatan').load(url);
      return false;
    })

    $("#kecamatan").change(function (){
      var url = "<?php echo site_url('Frontend/Profile/add_ajax_des');?>/"+$(this).val();
      $('#desa').load(url);
      return false;
    })
  });
</script>

<?php $this->load->view('_layout_frontend/js.php'); ?>
<?php $this->load->view('_layout_frontend/alert.php'); ?>
</body>
</html>