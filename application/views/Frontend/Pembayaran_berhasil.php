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
          <h1 style="color: #fff;">Pembayaran Produk</h1>
          <p style="color: #ebebeb;">Mengisi formulir pembayaran</p>
        </div>
        <div class="page_link">
          <a href="index.html" style="color: #ebebeb;">Beranda</a>
          <a href="contact.html" style="color: #ebebeb;">Pembayaran Produk</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Checkout Area =================-->
<!-- ================ contact section start ================= -->
<section class="section_gap">
  <div class="container">
    <div class="row card shadow col-lg-10 mx-auto d-block">
      <h3 class="text-center my-5">Segera Selesaikan Pembayaran Anda</h3>
      <div class="col-lg-8 bg-secondary p-5 my-2 mx-auto d-block">
        <h4 class="text-center text-white">Bayar sebelum :</h4>
        <h2 class="text-center text-white">
          <?php $batas = date('d M Y, H.i', strtotime($new_transaksi['batas_bayar'])); echo $batas; ?> WIB
        </h2>
      </div>

      <div class="col-lg-8 bg-warning p-3 my-4 mx-auto d-block">
        <h5 class="text-center">Pastikan untuk tidak menginformasikan bukti dan data pembayaran kepada pihak manapun kecuali Lassak.co.</h5>
      </div>
      
      <div class="col-lg-8 p-3 my-2 mx-auto d-block">
        <h5>Transfer pembayaran ke nomor rekening :</h5>
        <h3 class="mx-4"><?= $new_transaksi['no_rekening'] ?> (<?= $new_transaksi['nama_bank']; ?>)</h3>
        <h5>a/n <?= $new_transaksi['nama_pemilik']; ?></h5>
      </div>

      <div class="col-lg-8 p-3 my-2 mx-auto d-block">
        <h5>Jumlah yang harus di bayar :</h5>
        <h3 class="text-danger">Rp. <?= number_format($new_transaksi['total_bayar'], 0, ',', '.'); ?></h3>
      </div>

      <div class="col-lg-8 p-3 my-2 mx-auto d-block">
        <h6 class="text-center">Pastikan pembayaran Anda sudah BERHASIL dan unggah bukti untuk mempercepat proses verifikasi</h6>
      </div>

      <div class="col-lg-8 p-3 my-2 mx-auto d-block">
        <a href="<?= base_url('Frontend/Riwayat'); ?>" class="btn btn-success mx-auto d-block my-3">Cek Status Pembayaran</a>
        <a href="<?= base_url('Frontend/Shop'); ?>" class="btn btn-outline-success mx-auto d-block my-3">Belanja Lagi</a>
      </div>

    </div>
  </div>
</div>
</section>
<!-- ================ contact section end ================= -->
<!--================End Checkout Area =================-->

<!--================ start footer Area  =================-->
<?php $this->load->view('_layout_frontend/footer.php'); ?>
<!--================ End footer Area  =================-->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<?php $this->load->view('_layout_frontend/js.php'); ?>
<?php $this->load->view('_layout_frontend/alert.php'); ?>
</body>

</html> 