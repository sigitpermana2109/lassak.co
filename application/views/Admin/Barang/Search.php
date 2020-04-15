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
      <div class="row">
        <div class="col">
          <h1>Data Barang</h1>
        </div>
        <div class="col-9 align-right">
          <form method="POST" action="<?= base_url('Admin/Laporan/laporanBarangMasuk'); ?>">
            <div class="row">
              <div class="col">
                <input type="text" name="tgl_awal" class="form-control datepicker">
              </div>

              <p>S/D</p>

              <div class="col">
                <input type="text" name="tgl_akhir" class="form-control datepicker">
              </div>
              <div class="col">
                <button type="submit" class="btn btn-success btn-sm btn-rounded">Cetak</button>
              </div>
            </div>
          </form>
        </div>
      </div>
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
                      <th>Kategori</th>
                      <th>Barang</th>
                      <th>Deskripsi</th>
                      <th>Harga</th>
                      <th>Berat</th>
                      <th>Stok</th>
                      <th>Gambar</th>
                      <th colspan="3" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = $this->uri->segment(4)+1;
                    foreach ($barang as $row) {
                      ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama_kategori']; ?></td>
                        <td><?= $row['nama_barang']; ?></td>
                        <td><?= substr($row['deskripsi'], 0, 40); ?> ...</td>
                        <td>Rp. <?= number_format($row['harga'],0,',','.'); ?></td>
                        <td><?= $row['berat']; ?> gr</td>
                        <td><?= $row['stok']; ?></td>
                        <td><img style="width:20%;border: 1px solid #ddd;border-radius: 5px;padding: 5px;width: 90px;height: 90px;"  src="<?php echo base_url('assets/images/upload/'.$row['gambar1']) ?>"></td>
                        <td>
                          <button data-toggle="modal" data-target="#modalTambah" class="btn btn-sm btn-rounded btn-warning" onclick="select(
                            '<?= $row['id_barang']; ?>',
                            '<?= $row['id_kategori']; ?>',
                            '<?= $row['nama_barang']; ?>',
                            '<?= $row['deskripsi']; ?>',
                            '<?= $row['harga']; ?>',
                            '<?= $row['berat']; ?>',
                            '<?= $row['stok']; ?>',
                            '<?= $row['gambar1']; ?>'
                            );" >
                            <i class="far fa-edit"></i>
                          </button>
                        </td>
                        <td>
                          <a href="<?= base_url('Admin/Barang/detailBarang/'.$row['id_barang']); ?>" class="btn btn-sm btn-success btn-rounded">
                            <i class="fas fa-eye"></i>
                          </a>
                        </td>
                        <td>
                          <button data-toggle="modal" data-target="#modalHapus<?= $row['id_barang']; ?>" class="btn btn-danger btn-sm btn-rounded">
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

  <?php foreach ($barang as $row) { ?>

    <!-- Modal Hapus -->
    <div class="modal" tabindex="-1" id="modalHapus<?= $row['id_barang']; ?>" role="dialog" aria-hidden="true">
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
            <a href="<?= base_url('Admin/Barang/delete/'.$row['id_barang']); ?>" class="btn btn-danger btn-sm btn-rounded">Hapus</a>
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

          <form class="forms-sample" id="addForm" method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Barang/manajemen');  ?>">
            <div class="form-group">
              <label for="exampleInputName1">Kategori</label>
              <select class="form-control" name="id_kategori" id="id_kategori">
                <option value='' selected>- Pilih Kategori -</option>";
                <?php
                foreach($kategori as $kategori) { ?>
                  <option value="<?= $kategori['id_kategori']; ?>" ><?= $kategori['nama_kategori']; ?></option> 
                <?php }?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail3">Nama Barang</label>
              <input type="text" name="nama_barang" class="form-control" id="nama_barang" placeholder="Nama Barang ...">
            </div>
            <div class="form-group">
              <label for="exampleTextarea1">Deskripsi</label>
              <textarea class="form-control" placeholder="Isi deskripsi disini ..." name="deskripsi" id="deskripsi" rows="2"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail3">Harga</label>
              <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga ...">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail3">Berat</label>
              <input type="text" name="berat" class="form-control" id="berat" placeholder="Berat ...">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail3">Stok</label>
              <input type="text" name="stok" class="form-control" id="stok" placeholder="Stok ...">
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Gambar</label>
              <input type="file" id="cover" name="gambar1" class="form-control" onchange="loadFile(event)" /><br>
              <img id="foto_cover" class="m-2" style="width:30%;border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 150px;"  src="<?=base_url('assets/images/default.png'); ?>">
            </div>
            <input type="hidden" name="id_barang" id="id_barang">
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
  function select($id_barang, $id_kategori, $nama_barang, $deskripsi, $harga, $berat, $stok, $gambar1){
    $('#id_barang').val($id_barang);
    $('#id_kategori').val($id_kategori);
    $('#nama_barang').val($nama_barang);
    $('#deskripsi').val($deskripsi);
    $('#harga').val($harga);
    $('#berat').val($berat);
    $('#stok').val($stok);
    var link = "<?= base_url()?>assets/images/upload/";
    document.getElementById("foto_cover").src = link+$gambar1;
  }

  function refresh(){
    $("#id_barang").val('');
    $("#id_kategori").val('');
    $("#nama_barang").val('');
    $("#deskripsi").val('');
    $("#harga").val('');
    $("#berat").val('');
    $("#stok").val('');
    document.getElementById("foto_cover").src = '<?= base_url('assets/images/default.png'); ?>';
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