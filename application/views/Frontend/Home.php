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
  <section style="margin-bottom: 80px;">


    <!--Carousel Wrapper-->
    <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
      <!--Indicators-->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-2" data-slide-to="1"></li>
        <li data-target="#carousel-example-2" data-slide-to="2"></li>
      </ol>
      <!--/.Indicators-->
      <!--Slides-->
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <!--Mask color-->
          <img class="d-block w-100" height="458" width="1037" src="<?php echo base_url('assets/images/dashboard/banner_1.jpg'); ?>"
          alt="First slide">
          <div class="mask rgba-black-strong"></div>
          <div class="carousel-caption">
            <p class="sub text-uppercase font-weight-bold text-success">LASSAK.CO</p>
            <h1 class="font-weight-bold h1-responsive"><span>Show</span> Your <br />Personal <span>Style</span></h1>
            <h2 class="h2-responsive">Our quality remains a priority.</h2>
            <a class="main_btn mt-40 mb-5" href="<?= base_url('Frontend/Shop'); ?>">Lihat Selengkapnya</a>
          </div>
        </div>

        <div class="carousel-item ">
          <img class="d-block w-100" height="458" width="1037" src="<?php echo base_url('assets/frontend/img/banner/background3.png'); ?>"
          alt="Second slide">
          <div class="mask rgba-black-light"></div>
          <div class="carousel-caption">
            <h1 class="mb-5 text-left font-weight-bold text-white h1-responsive">Harga Murah Barang Berkualitas.</h1>
          </div>
        </div>

        <div class="carousel-item">
          <!--Mask color-->
          <div class="view">
            <img class="d-block w-100" height="458" width="1037" src="<?php echo base_url('assets/frontend/img/banner/background4.jpg'); ?>"
            alt="Third slide">
            <div class="mask rgba-black-slight"></div>
          </div>
          <div class="carousel-caption">
           <h1 class="mb-5 text-left font-weight-bold text-white h1-responsive">100% Transaksi Terjamin dan Aman.</h1>
         </div>
       </div>
     </div>
     <!--/.Slides-->
     <!--Controls-->
     <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
  </div>
  <!--/.Carousel Wrapper-->
</section>


<!--================End Home Banner Area =================-->


<!--================ Feature Product Area =================-->
<section class="feature_product_area section_gap_bottom_custom">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="main_title">
          <h2><span>Produk terbaru</span></h2>
          <p>Beberapa produk terbaru yang telah kami buat</p>
        </div>
      </div>
    </div>

    <div class="row">
      <?php foreach ($barang as $row) { ?>
        <div class="col-lg-3 col-md-5">
          <div class="single-product card shadow">
            <div class="product-img">
              <img class="img-fluid" style="max-height: 255px;max-width: 255px;" src="<?php echo base_url('assets/images/upload/'.$row['gambar1']) ?>" alt="" />
              <div class="p_icon">
                <?php if ($row['stok'] === '0') { ?>
                  <h3><b>SOLD OUT</b></h3>
                <?php }else{ ?>
                  <a href="<?= base_url('Frontend/Shop/shop_detail/'.$row['id_barang']); ?>">
                    <i class="ti-eye"></i>
                  </a>

                  <?php if ($this->session->userdata('email') != NULL) { 
                    $data = $this->db->query("SELECT * FROM t_detail_barang where id_barang='".$row['id_barang']."'")->result_array();
                    ?>
                    <a href="#" data-toggle="modal" data-target="#modalKeranjang" onclick="select(
                      '<?= $row['id_barang'] ?>', 
                      '<?= $user['id_member'] ?>',
                      '<?php echo "<option disabled selected>Pilih Ukuran</option>"; 
                      foreach($data as $d){
                        echo "<option>".$d['ukuran']."</option>";}?>'
                        )">
                        <i class="ti-shopping-cart"></i>
                      </a>
                    <?php }else{ ?>
                      <a href="#" data-toggle="modal" data-target="#modalHarusLogin">
                        <i class="ti-shopping-cart"></i>
                      </a>
                    <?php } ?>
                  <?php } ?>
                </div>
              </div>
              <div class="product-btm">
                <a href="<?= base_url('Frontend/Shop/shop_detail/'.$row['id_barang']); ?>" class="d-block">
                  <h4><?= substr($row['nama_barang'], 0, 18); ?>...</h4>
                </a>
                <div class="mt-3">
                  <span class="mr-4">RP. <?= number_format($row['harga'], 0, ',', '.'); ?></span>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>


        <div class="mx-auto d-block">
          <a class="main_btn" href="<?= base_url('Frontend/Shop'); ?>">Lihat Selengkapnya</a>
        </div>
        
      </div>
      <!--Carousel Wrapper-->

    </div>
  </section>
  <!--================ End Feature Product Area =================-->

  <!-- Start feature Area -->
  <section class="feature-area section_gap_bottom_custom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="main_title">
            <h2><span>Apa yang kami lakukan</span></h2>
            <p>Beberapa produk terbaru yang telah kami buat</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="single-feature shadow">
            <a href="#" class="title">
              <i class="flaticon-money"></i>
              <h3>Garansi Uang Kembali</h3>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="single-feature shadow">
            <a href="#" class="title">
              <i class="flaticon-truck"></i>
              <h3>Pengiriman Cepat</h3>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="single-feature shadow">
            <a href="#" class="title">
              <i class="flaticon-support"></i>
              <h3>Selalu Mendukung</h3>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="single-feature shadow">
            <a href="#" class="title">
              <i class="flaticon-blockchain"></i>
              <h3>Pembayaran Yang Aman</h3>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End feature Area -->

  <!--================ Offer Area =================-->
  <section class="offer_area">
    <div class="container">
      <div class="row justify-content-center">
        <div class="offset-lg-4 col-lg-6 text-center">
          <div class="offer_content">
            <img class="my-3" style="width: 170px;height: 70px;" src="<?= base_url('assets/images/logo-name.png'); ?>" alt="" />
            <p class="text-justify mx-5">Adidas AG, juga dikenal sebagai adidas, adalah sebuah perusahaan sepatu Jerman. Perusahaan ini dinamakan atas pendirinya, Adolf (Adi) Dassler, yang mulai memproduksi sepatu pada 1920-an di Herzogenaurach dekat Nuremberg. Rancangan baju dan sepatu perusahaan ini biasanya termasuk tiga strip paralel dengan warna yang sama, dan motif yang sama digunakan sebagai logo resmi adidasBeli produk di Lassak.co menyediakan baju, kemeja, jacket dan topi, lassak.co adalah brand asli produk lokal yang bertempat di kota Bandung.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

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
                <select name="catatan" class="mdb-select md-form" id="ukuran">
                </select>
              </div>
            </div>
            <input type="hidden" name="id_barang" id="id_barang">
            <input type="hidden" name="id_member" id="id_member" value="<?= $member['id_member'] ?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-success" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal  -->

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
  <!--================ End Offer Area =================-->

  <!--================ start footer Area  =================-->
  <?php $this->load->view('_layout_frontend/footer.php'); ?>
  <!--================ End footer Area  =================-->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script type="text/javascript">
    function select($id_barang, $id_member, $ukuran){
      $("#id_barang").val($id_barang);
      $("#id_member").val($id_member);
      $('#ukuran').html($ukuran);
    }

    function refresh(){
      $("#id_barang").val('');
    }
  </script>
  <?php $this->load->view('_layout_frontend/js.php'); ?>
</body>

</html>