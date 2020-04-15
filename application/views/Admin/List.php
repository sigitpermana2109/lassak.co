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
    <div class="section-header shadow-lg">
      <h1>Data Admin</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card shadow-lg">
            <div class="card-header">
              <h4>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                  <i class="fa fa-plus"> Tambah Data</i>
                </button>
              </h4>
              <div class="card-header-action">
                <form>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-btn">
                      <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-hover" id="sortable-table">
                  <thead class="text-center">
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>No. Telp</th>
                      <th>Foto</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php 
                    $no = 1;
                    foreach ($admin as $row) {
                      ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama_lengkap']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['no_telp']; ?></td>         
                        <td><img style="width:20%;border: 1px solid #ddd;border-radius: 5px;padding: 5px;width: 100px;height: 100px;"  src="<?php echo base_url('assets/images/faces/'.$row['foto']); ?>">
                        </td>
                        <td>
                          <button data-toggle="modal" data-target="#modalHapus<?= $row['id_admin']; ?>" class="btn btn-sm btn-rounded btn-danger">
                            <i class="fas fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>

              </div>
              <!-- pagination -->
              <div class="row">
                <div class="col">
                  <?= $pagination; ?>
                </div>
              </div>
              <!-- pagination -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php foreach ($admin as $row) { ?>

  <!-- Modal Hapus -->
  <div class="modal fade" tabindex="-1" id="modalHapus<?= $row['id_admin']; ?>" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Apakah Anda Yakin ?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Data yang anda hapus tidak bisa kembali lagi.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning btn-sm btn-rounded" data-dismiss="modal">Batal</button>
          <a href="<?= base_url('Admin/Admin/delete/'.$row['id_admin']); ?>" class="btn btn-danger btn-sm btn-rounded">Hapus</a>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Hapus -->
<?php } ?>

<!-- Modal Tambah-->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby=#modalTambah" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Manajemen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form class="forms-sample" id="addForm" method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Admin/insert');  ?>">
          <div class="form-group">
            <label for="exampleInputEmail3">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Nama Lengkap ...">
            
          </div>

          <div class="form-group">
            <label for="exampleInputEmail3">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Email ...">
          
          </div>

          <div class="form-group">
            <label for="exampleInputEmail3">No. Telephone</label>
            <input type="text" name="no_telp" id="no_telp" class="form-control" placeholder="No. Telephone ...">
            <input type="hidden" name="id_admin" id="id_admin">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail3">Password</label>
            <input type="password" name="password1" id="password1" class="form-control" placeholder="Password ...">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail3">Ulangi Password</label>
            <input type="password" name="password2" id="password2" class="form-control" placeholder="Ulangi Password ...">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail3">Foto</label>
            <input type="file" id="foto" name="gambar1" class="form-control" onchange="loadFile(event)" /><br>
            <img id="foto_cover" class="m-2" style="width:30%;border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 150px;"  src="<?=base_url('assets/images/faces/default.jpg'); ?>">
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-warning btn-sm btn-rounded" data-dismiss="modal">Batal</button>
            <button type="submit" id="valid" class="btn btn-primary btn-sm btn-rounded">Tambah Data</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
<!-- Modal Tambah -->



<?php $this->load->view('_partials_admin/footer'); ?>
<script type="text/javascript">

  function refresh(){
    $("#id_admin").val('');
    $("#nama_lengkap").val('');
    $("#email").val('');
    $("#no_telp").val('');
    $("#password1").val('');
    $("#password2").val('');
    document.getElementById("foto_cover").src = '<?= base_url('assets/images/faces/default.jpg'); ?>';
  }
</script>

<script>
  $("#addForm").validate({
    rules: {
      id_admin: {
        required: true
      },
      nama_lengkap: {
        required: true,
        minlength: 3
      },
      email: {
        required: true,
        email:true,
        minlength: 5
      },
      no_telp: {
        required: true,
        number: true,
        minlength: 5
      },
      password1: {
        required: true,
        password2:{
          equalTo: "#password1"
        }
        minlength: 6
      },
    },

    messages: {
      id_admin: {
        required: "Mohon pilih salah satu"
      },
      nama_lengkap: {
        required: "Anda harus mengisi kolom ini",
        minlength: "Min. 3 karakter"
      },
      email: {
        required: "Anda harus mengisi kolom ini",
        email:"Mohon isi dengan email yang valid",
        minlength: "Min. 5 karakter"
      },
      no_telp: {
        required: "Anda harus mengisi kolom ini",
        number: "Hanya untuk angka",
        minlength: "Min. 2 karakter"
      },
      password: {
        required: "Anda harus mengisi kolom ini",
        minlength: "Min. 6 karakter"
      },
      password2: {
        equalTo: "Password Tidak Cocok"
      }
    }
  });
</script>