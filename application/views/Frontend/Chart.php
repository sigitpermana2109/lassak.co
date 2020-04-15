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
          <h1 style="color: #fff;">Keranjang</h1>
          <p style="color: #ebebeb;">Barang yang telah anda masukkan kedalam keranjang</p>
        </div>
        <div class="page_link">
          <a href="index.html" style="color: #ebebeb;">Beranda</a>
          <a href="contact.html" style="color: #ebebeb;">Keranjang</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Cart Area =================-->
<section class="cart_area">
  <div class="container">
    <?php if (!empty($getKeranjang2)) { ?>
      <div class="cart_inner">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Pilih</th>
                <th scope="col" class="text-center">Produk</th>
                <th colspan="2" class="text-center">Harga</th>
                <th class="text-center">Kuantitas</th>
                <th scope="col" class="text-center">Sub Total</th>
                <th scope="col" class="text-center">Hapus</th>
              </tr>
            </thead>
            <form method="post" action="<?= base_url('Frontend/Checkout'); ?>">
              <?php 
              foreach ($data_keranjang as $row) {
                if ($row['jumlah'] > 0) {
                  ?>
                  <tbody>
                    <tr>
                      <td>
                        <input type="checkbox" class="form-check-input" id="materialUnchecked<?= $row['id_keranjang']?>" name="list[]" onclick="data('<?= $row['id_keranjang']?>', '<?= $row['jumlah']*$row['harga']?>','<?=$row['jumlah']?>')" >
                        <label class="form-check-label" for="materialUnchecked<?= $row['id_keranjang']?>"> </label>
                        <input type="hidden" name="id[]" id="id<?= $row['id_keranjang']?>">
                        <input type="hidden" name="harga[]" id="total<?= $row['id_keranjang']?>">
                        <input type="hidden" name="jumlah[]" id="jumlah<?= $row['id_keranjang']?>">
                      </td>
                      <script>
                        function data($id_keranjang, $total, $jumlah, $materialUnchecked){
                          $('#id'+$id_keranjang).val($id_keranjang);
                          $('#total'+$id_keranjang).val($total);
                          $('#jumlah'+$id_keranjang).val($jumlah);
                          $('#materialUnchecked'+$id_keranjang).val($materialUnchecked);
                        }
                      </script>
                      <td>
                        <div class="media">
                          <div class="d-flex">
                            <img style="width: 120px;height: 130px;" src="<?php echo base_url('assets/images/upload/'.$row['gambar1']) ?>" alt=""/>
                          </div>
                          <div class="media-body">
                            <p class="font-weight-bold"><?= $row['nama_barang']; ?></p>
                            <div class="row mx-4">
                              <p class="font-italic">
                                <?php $data = $this->db->query("SELECT * FROM t_detail_barang where id_barang='".$row['id_barang']."'")->result_array(); ?>
                                Ukuran : <?= $row['catatan']; ?> 
                                <div class="col">
                                  <a href="#" data-toggle="modal" data-target="#modalKeranjang" onclick="select(
                                    '<?= $row['id_keranjang'] ?>',
                                    '<?= $row['id_barang'] ?>', 
                                    '<?= $user['id_member'] ?>',
                                    '<?php echo "<option disabled selected>Pilih Ukuran</option>"; 
                                    foreach($data as $d){
                                      echo "<option>".$d['ukuran']."</option>";}?>'
                                      )">
                                      <span class="fa fa-edit"></span> 
                                      Edit
                                    </a>
                                  </div>
                                </p>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td colspan="2">
                          <h5 class="text-center">Rp. <?= number_format($row['harga'], 0,',','.'); ?></h5>
                        </td>
                        <td>
                          <div class="product_count">
                            <input type="text" name="qty" id="sst" value="<?= $row['jumlah']; ?>"  class="input-text qty" readonly>
                            <a href="<?= base_url('Frontend/Shop/qty_plus/'.$row['id_keranjang'])?>">
                              <button class="increase items-count" id="btn-plus" type="button" >
                                <i class="lnr lnr-chevron-up"></i>
                              </button>
                            </a>
                            <a href="<?= base_url('Frontend/Shop/qty_min/'.$row['id_keranjang'])?>">
                              <button class="reduced items-count" type="button">
                                <i class="lnr lnr-chevron-down"></i>
                              </button>
                            </a>
                          </div>
                        </td>
                        <td>
                          <h5 class="text-center">Rp. <?= number_format($row['jumlah']*$row['harga'], 0,',','.'); ?></h5>
                        </td>
                        <td>
                          <a href="#" data-toggle="modal" data-target="#modalHapus<?= $row['id_keranjang']; ?>" ><h5 class="text-center"><span class="fa fa-trash" title="Hapus"></span></h5></a>
                        </td>
                      </tr>
                    <?php } ?>

                    <!-- Modal Hapus -->
                    <div class="modal" tabindex="-1" id="modalHapus<?= $row['id_keranjang']; ?>" role="dialog" aria-hidden="true">
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
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                            <a href="<?= base_url('Frontend/Shop/hapus_keranjang/'.$row['id_keranjang']) ?>" class="btn btn-danger">Hapus</a>

                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal Hapus -->


                  <?php } ?>

                  <tr class="text-center">
                    <td colspan="2"></td>
                    <td></td>
                    <td>
                      <h5>Total</h5>
                    </td>
                    <td>
                      <h5>Rp. <?= number_format($total_bayar['total'], 0,',','.'); ?></h5>
                    </td>
                  </tr>
                  <tr class="out_button_area">
                    <td></td>
                    <td></td>
                    <td colspan="2"></td>
                    <td>
                      <div class="checkout_btn_inner">
                        <a class="gray_btn" href="<?= base_url('Frontend/Shop'); ?>">Lanjutkan belanja</a>
                        <input type="submit" name="" class="main_btn" value="Lanjutkan ke pembayaran">
                      </div>
                    </td>
                  </tr>
                </form>
              </tbody>
            </table>
          </div>
        </div>
      <?php } else{?>
        <div class="col-lg-12">
          <img class="mx-auto d-block" style="max-width: 25%;max-height: 25%;" src="<?= base_url('assets/frontend/img/warning.png'); ?>">
          <h2 class="text-center">Ooppss.. Keranjang belanja anda kosong</h2>
          <div class="text-center my-4">
            <a class="main_btn align-center" href="<?= base_url('Frontend/Shop'); ?>">Ayo Belanja !</a>
          </div>
        </div>

      <?php  }?>
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
          <form method="POST" action="<?= base_url('Frontend/Shop/edit_catatan'); ?>">
            <div class="input-group-icon mt-10">
              <div class="md-form" id="default-select2">
                <select name="catatan" class="mdb-select md-form" id="ukuran" required>
                </select>
              </div>
            </div>
            <input type="hidden" name="id_barang" id="id_barang">
            <input type="hidden" name="id_keranjang" id="id_keranjang">
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



  <!--================End Cart Area =================-->

  <!--================ start footer Area  =================-->
  <?php $this->load->view('_layout_frontend/footer.php'); ?>
  <!--================ End footer Area  =================-->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->

  <script type="text/javascript">
    function select($id_keranjang, $id_barang, $id_member, $ukuran){
      $("#id_keranjang").val($id_keranjang);
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