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
          <h1 style="color: #fff;">Detail Produk</h1>
          <p style="color: #ebebeb;">Keterangan secara lengkap dari sebuah produk</p>
        </div>
        <div class="page_link">
          <a href="index.html" style="color: #ebebeb;">Beranda</a>
          <a href="contact.html" style="color: #ebebeb;">Detail Produk</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Single Product Area =================-->
<div class="product_image_area">
  <div class="container">
    <div class="row s_product_inner">
      <div class="col-lg-6 card shadow-lg">
        <div class="s_product_img">
          <div
          id="carouselExampleIndicators"
          class="carousel slide"
          data-ride="carousel"
          >
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img 
              class="d-block w-100" style="height:600px;"
              src="<?php echo base_url('assets/images/upload/'.$barang->gambar1) ?>"
              alt="First slide"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-5 offset-lg-1">
      <div class="s_product_text">
        <h3><?= $barang->nama_barang; ?></h3>
        <h2>Rp. <?= number_format($barang->harga, 0,',','.'); ?></h2>
        <ul class="list">
          <li>
            <a class="active" href="#">
              <span>Kategori</span> : <?= $barang->nama_kategori; ?></a
              >
            </li>
            <li>
              <a href="#"> <span>Ukuran</span> :
              <ul style="list-style: circle;" class="mx-3">
                <?php foreach ($dataUkuran as $baris) { ?>
                  <li>
                    <?= $baris['ukuran'] ?></a> <span class="font-weight-bold">(<?= $baris['jumlah'] ?> Barang Tersedia)</span>
                  </li>
                <?php } ?>
              </ul>
            </li>
          </ul>
          <p>
            <?= $barang->deskripsi; ?>
          </p>
          <div class="card_area text-center mb-5">
            <?php if ($barang->stok === '0') { ?>
              <a class="main_btn" href="#" data-toggle="modal" data-target="#modalKosong">Masukkan Keranjang</a>
                <?php } elseif($this->session->userdata('email') != NULL) { ?>
                <a href="#" data-toggle="modal" class="main_btn" data-target="#modalKeranjang" onclick="select('<?= $barang->id_barang; ?>', '<?= $member['id_member'] ?>')">
                    Masukkan Keranjang
                </a>
                <?php }else{ ?>
                  <a href="#" data-toggle="modal" class="main_btn" data-target="#modalHarusLogin">
                    Masukkan Keranjang
                  </a>
              <?php } ?>
          
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="modalKosong" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Barang Kosong</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="text-center">Maaf barang yang anda inginkan sedang tidak tersedia.</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="main_btn" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Hapus -->

<!-- Modal  -->
<div class="modal fade" id="modalKeranjang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Keranjang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= base_url('Frontend/Shop/masuk_keranjang'); ?>">
          <div class="md-form">
            <input type="number" name="jumlah" id="form1" required class="form-control">
            <label for="form1">Masukkan Jumlah yang Anda Inginkan</label>
          </div>
          <div class="input-group-icon mt-10">
            <div class="md-form" id="default-select2">
              <select name="catatan" class="mdb-select md-form" required>
                <option value="" disabled="" selected="">-- Pilih Ukuran --</option>
                <?php foreach ($dataUkuran as $baris) { ?>
                  <option value="<?= $baris['ukuran'] ?>"><?= $baris['ukuran'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <input type="hidden" name="id_barang" id="id_barang">
          <input type="hidden" name="id_member" id="id_member">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-success" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal  -->
<!--================End Single Product Area =================-->

 <!-- Modal  -->
<div class="modal fade" id="modalHarusLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Anda Belum Login !</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Silahkan Login/Registrasi Terlebih Dahulu</p>
      
        
      </div>
        <div class="modal-footer">
          <a href="<?= base_url('Auth_member'); ?>" class="btn btn-outline-success">Login</a>
          <a href="<?= base_url('Auth_member/daftar'); ?>" class="btn btn-success">Registrasi</a>
        </div>     
    </div>
  </div>
</div>
<!-- End Modal  -->


<!--================ start footer Area  =================-->
<?php $this->load->view('_layout_frontend/footer.php'); ?>
<!--================ End footer Area  =================-->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script type="text/javascript">
  function select($id_barang, $id_member){
    $("#id_barang").val($id_barang);
    $("#id_member").val($id_member);
  }

  function refresh(){
    $("#id_barang").val('');
  }
</script>
<?php $this->load->view('_layout_frontend/js.php'); ?>
</body>

</html>