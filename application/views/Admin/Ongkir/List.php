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
      <h1>Data ongkir</h1>
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
                <form action="<?= base_url('Admin/Ongkir/search'); ?>">
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
                      <th>Jenis Kurir</th>
                      <th>Kota</th>
                      <th>Harga</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php 
                    $no = $this->uri->segment(4)+1;
                    foreach ($ongkir as $row) {
                      ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['jenis_kurir']; ?></td>
                        <td><?= $row['nama_kota']; ?></td>
                        <td><?= $row['harga']; ?></td>
                        <td>
                          <button data-toggle="modal" data-target="#modalTambah" class="btn btn-sm btn-rounded btn-warning" onclick="select(
                            '<?= $row['id_ongkir']; ?>',
                            '<?= $row['id_kurir']; ?>',
                            '<?= $row['id_kota']; ?>',
                            '<?= $row['harga']; ?>'
                            )">
                            <i class="far fa-edit"></i>
                          </button>

                          <button data-toggle="modal" data-target="#modalHapus<?= $row['id_ongkir']; ?>" class="btn btn-sm btn-rounded btn-danger">
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

  <?php foreach ($ongkir as $row) { ?>

    <!-- Modal Hapus -->
    <div class="modal fade" tabindex="-1" id="modalHapus<?= $row['id_ongkir']; ?>" role="dialog" aria-hidden="true">
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
            <a href="<?= base_url('Admin/Ongkir/delete/'.$row['id_ongkir']); ?>" class="btn btn-danger btn-sm btn-rounded">Hapus</a>
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
        <div class="modal-body mr-4">

          <form class="" id="addForm" method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Ongkir/insert');  ?>">
            <div class="md-form">
              <select class="mdb-select md-form" searchable="Cari disini ..." name="id_kurir" id="id_kurir">
                <option value='' disabled="" selected>- Pilih Kurir -</option>";
                <?php
                foreach($kurir as $kurir) { ?>
                  <option value="<?= $kurir['id_kurir']; ?>" ><?= $kurir['jenis_kurir']; ?></option> 
                <?php }?>
              </select>
            </div>
            <div class="md-form">
              <select class="mdb-select md-form" searchable="Cari disini ..." name="id_kota" id="id_kota">
                <option value='' disabled="" selected>- Pilih Kota -</option>";
                <?php
                foreach($kota as $kota) { ?>
                  <option value="<?= $kota['id_kota']; ?>" ><?= $kota['nama_kota']; ?></option> 
                <?php }?>
              </select>
            </div>
            <div class="md-form">
              
              <input type="text" name="harga" class="form-control" id="harga">
              <label for="harga">Harga</label>
              <input type="hidden" name="id_ongkir">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning btn-sm btn-rounded" data-dismiss="modal" onclick="refresh()">Batal</button>
              <button type="submit" class="btn btn-primary btn-sm btn-rounded">Tambah Data</button>
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
  function select($id_ongkir, $id_kurir, $id_kota, $harga){
    $('#id_ongkir').val($id_ongkir);
    $('#id_kurir').val($id_kurir);
    $('#id_kota').val($id_kota);
    $('#harga').val($harga);
  }

  function refresh(){
    $('#id_ongkir').val('');
    $('#id_kurir').val('');
    $('#id_kota').val('');
    $('#harga').val('');
  }
</script>

<script>
  $("#addForm").validate({
    rules: {
      id_kurir: {
        required: true
      },
      id_kota: {
        required: true
      },
      harga: {
        required: true,
        minlength: 4,
        number: true
      },
    },
    messages: {
      id_kurir: {
        required: "Mohon pilih salah satu"
      },
      id_kota: {
        required: "Mohon pilih salah satu"
      },
      harga: {
        required: "Anda harus mengisi kolom ini",
        minlength: "Min. 4 karakter",
        number: "Hanya untuk angka"
      }
    }
  });
</script>