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
      <h1>Data Detail Barang</h1>
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
                <form action="<?= base_url('Admin/Barang/search'); ?>">
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
                      <th>Ukuran</th>
                      <th>Panjang</th>
                      <th>Lebar</th>
                      <th>Jumlah</th>
                      <th colspan="2" class="text-center" width="6">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php 
                    $no = $this->uri->segment(5)+1;
                    foreach ($detail as $row) {
                      ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['ukuran']; ?></td>
                        <td><?= $row['panjang']; ?></td>
                        <td><?= $row['lebar']; ?></td>
                        <td><?= $row['jumlah']; ?></td>
                        <td>
                          <a href="" class="btn btn-sm btn-rounded btn-success">
                            <i class="fas fa-edit"></i>
                          </a>
                        
                          <button data-toggle="modal" data-target="#modalHapus<?= $row['id_detail_barang']; ?>" class="btn btn-sm btn-rounded btn-danger">
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

  <?php foreach ($detail as $row) { ?>

    <!-- Modal Hapus -->
    <div class="modal fade" tabindex="-1" id="modalHapus<?= $row['id_detail_barang']; ?>" role="dialog" aria-hidden="true">
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
            <a href="<?= base_url('Admin/Barang/deleteUkuran?id_detail_barang='.$row['id_detail_barang']).'&id_barang='.$this->uri->segment(4)?>" class="btn btn-danger btn-sm btn-rounded">Hapus</a>
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

          <form class="forms-sample" id="addForm" method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Barang/tambahUkuran');  ?>">
            <div class="form-group">
              <label for="exampleInputName1">Ukuran</label>
              <select class="form-control" name="ukuran" id="ukuran">
                <option value='' selected>- Pilih Ukuran -</option>";
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="All">All Size</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail3">Panjang</label>
              <input type="text" name="panjang" class="form-control" id="panjang" placeholder="Masukkan Dalam CM ...">
            </div>
            <div class="form-group">
              <label for="exampleTextarea2">Lebar</label>
              <input type="text" name="lebar" class="form-control" id="lebar" placeholder="Masukkan Dalam CM ...">
            </div>
            <div class="form-group">
              <label for="exampleTextarea1">Stok</label>
              <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Masukkan Jumlah ...">
            </div>
            <input type="hidden" name="id_barang" id="id_barang" value="<?php echo $this->uri->segment(4)?>">
            <div class="modal-footer">
              <button type="button" class="btn btn-warning btn-sm btn-rounded" data-dismiss="modal" onclick="refresh()">Batal</button>
              <button type="submit" class="btn btn-primary btn-sm btn-rounded" >Simpan</button>
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
  function select($id_barang){
    $('#id_barang').val($id_barang);
  }

  function refresh(){
    $("#id_barang").val('');
  }
</script>

<script>
  $("#addForm").validate({
    rules: {
      id_kategori: {
        required: true
      },
      nama_barang: {
        required: true,
        minlength: 3
      },
      deskripsi: {
        required: true,
        minlength: 5
      },
      harga: {
        required: true,
        number: true,
        minlength: 5
      },
      ukuran: {
        required: true,
      },
      berat: {
        required: true,
        number: true,
        minlength: 2
      },
      stok: {
        required: true,
        number: true
      },
    },

    messages: {
      id_kategori: {
        required: "Mohon pilih salah satu"
      },
      nama_barang: {
        required: "Anda harus mengisi kolom ini",
        minlength: "Min. 3 karakter"
      },
      deskripsi: {
        required: "Anda harus mengisi kolom ini",
        minlength: "Min. 5 karakter"
      },
      harga: {
        required: "Anda harus mengisi kolom ini",
        number: "Hanya untuk angka",
        minlength: "Min. 5 karakter"
      },
      ukuran: {
        required: "Anda harus mengisi kolom ini",
        minlength: "Min. 3 karakter"
      },
      berat: {
        required: "Anda harus mengisi kolom ini",
        number: "Hanya untuk angka",
        minlength: "Min. 2 karakter"
      },
      stok: {
        required: "Anda harus mengisi kolom ini",
        number: "Hanya untuk angka"
      }
    }
  });
</script>