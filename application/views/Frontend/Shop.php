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
          <h1 style="color: #fff;">Kategori Belanja</h1>
          <p style="color: #ebebeb;">Beberapa barang yang dapat anda beli.</p>
        </div>
        <div class="page_link">
          <a href="index.html" style="color: #ebebeb;">Beranda</a>
          <a href="contact.html" style="color: #ebebeb;">Belanja</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Category Product Area =================-->
<section class="cat_product_area section_gap">
  <div class="container">
    <div class="row flex-row-reverse">

      <div class="col-lg-3 mb-5">
        <div class="left_sidebar_area card shadow">
          <aside class="left_widgets p_filter_widgets">
            <div class="l_w_title">
              <h3>Kategori</h3>
            </div>
            <div class="widgets_inner">
              <ul class="list">
                <li>
                  <a href="<?= base_url('Frontend/Shop'); ?>">Semua</a>
                </li>
                <?php foreach ($kategori as $row) {
                  ?>
                  <li>
                    <a href="<?php echo site_url('Frontend/Shop/filter/'.$row['id_kategori']); ?>"><?= $row['nama_kategori']; ?></a>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </aside>
        </div>
      </div>

      <div class="col-lg-9">
        <?php $this->load->view('_layout_frontend/sort.php'); ?>
        <form action="<?= base_url('Shop/tambah_keranjang/'); ?>" method="POST">  
          <div class="latest_product_inner">
            <div class="row">
              <?php  
              foreach ($barang as $row) {
                ?>
                <div class="col-xl-4 col-md-6">
                  <div class="single-product card shadow">
                    <div class="product-img">
                      <img class="card-img" style="width: 225px;height: 225px;" src="<?php echo base_url('assets/images/upload/'.$row['gambar1']) ?>" alt="" />
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
                          <span class="mr-4">Rp. <?= number_format($row['harga'], 0 ,',', '.'); ?></span>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
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
          <input type="hidden" name="id_barang">
        </form>


        

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
                <select name="catatan" class="mdb-select md-form" id="ukuran" required>
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


  <!--================End Category Product Area =================-->

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
  <?php $this->load->view('_layout_frontend/alert.php'); ?>
</body>
</html>