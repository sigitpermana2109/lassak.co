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
    <div class="section-header shadow">
      <h1>Data Bank</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                  <i class="fa fa-plus"> Tambah Data</i>
                </button>
              </h4>
              <div class="card-header-action">
                <form action="<?= base_url('Admin/Bank/search'); ?>">
                  <div class="input-group">
                    <input type="text" class="form-control" name="keyword" placeholder="Search">
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
                      <th>Bank</th>
                      <th>No. Rekening</th>
                      <th>Nama Pemilik</th>
                      <th colspan="2" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php 
                    $no = $this->uri->segment(4)+1;
                    foreach ($bank as $row) {
                      ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama_bank']; ?></td>
                        <td><?= $row['no_rekening']; ?></td>
                        <td><?= $row['nama_pemilik']; ?></td>
                        <td>
                          <button data-toggle="modal" data-target="#modalTambah" class="btn btn-sm btn-rounded btn-warning" onclick="select(
                            '<?= $row['id_bank']; ?>',
                            '<?= $row['nama_bank']; ?>',
                            '<?= $row['no_rekening']; ?>',
                            '<?= $row['nama_pemilik']; ?>'
                            )" >
                            <i class="far fa-edit"></i>
                          </button>

                          <button data-toggle="modal" data-target="#modalHapus<?= $row['id_bank']; ?>" class="btn btn-sm btn-rounded btn-danger">
                            <i class="fas fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>

              </div>
              <!-- pagination -->
              <!-- <div class="row">
                <div class="col">
                  <?= $pagination; ?>
                </div>
              </div> -->
              <!-- pagination -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php foreach ($bank as $row) { ?>

    <!-- Modal Hapus -->
    <div class="modal fade" tabindex="-1" id="modalHapus<?= $row['id_bank']; ?>" role="dialog" aria-hidden="true">
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
            <a href="<?= base_url('Admin/Bank/delete/'.$row['id_bank']); ?>" class="btn btn-danger btn-sm btn-rounded">Hapus</a>
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
          <h5 class="modal-title" id="exampleModalLabel">Manajemen data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refresh()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form class="forms-sample" id="addForm" method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Bank/insert');  ?>">
            <div class="form-group">
              <label for="exampleInputEmail3">Nama bank</label>
              <input type="text" name="nama_bank" class="form-control" id="nama_bank" placeholder="Nama bank ...">
              <input type="hidden" name="id_bank" id="id_bank">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail3">Nomor rekening</label>
              <input type="text" name="no_rekening" class="form-control" id="no_rekening" placeholder="Nomor rekening ...">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail3">Nama pemilik</label>
              <input type="text" name="nama_pemilik" class="form-control" id="nama_pemilik" placeholder="Nama pemilik ...">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning btn-sm btn-rounded" data-dismiss="modal" onclick="refresh()">Batal</button>
              <button type="submit" id="valid" class="btn btn-primary btn-sm btn-rounded">Simpan</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- Modal Tambah -->
</div>


<?php $this->load->view('_partials_admin/footer'); ?>

<script type="text/javascript">
  function select($id_bank, $nama_bank, $no_rekening, $nama_pemilik){
    $('#id_bank').val($id_bank);
    $('#nama_bank').val($nama_bank);
    $('#no_rekening').val($no_rekening);
    $('#nama_pemilik').val($nama_pemilik);
  }

  function refresh(){
    $("#id_bank").val('');
    $("#nama_bank").val('');
    $("#no_rekening").val('');
    $('#nama_pemilik').val('');
  }
</script>

<script>
  $("#addForm").validate({
    rules: {
      nama_bank: {
        required: true,
        minlength: 2
      },
      no_rekening: {
        required: true,
        maxlength: 10,
        number: true
      },
      nama_pemilik: {
        required: true,
        minlength: 2
      },
    },
    messages: {
      nama_bank: {
        required: "Anda harus mengisi kolom ini",
        minlength: "Min. 2 karakter"
      },
      no_rekening: {
        required: "Anda harus mengisi kolom ini",
        maxlength: "Max. 10 karakter",
        number: "Hanya untuk angka"
      },
      nama_pemilik: {
        required: "Anda harus mengisi kolom ini",
        minlength: "Min. 2 karakter"
      }
    }
  });
</script>