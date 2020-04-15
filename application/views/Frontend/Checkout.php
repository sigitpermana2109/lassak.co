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
<section class="checkout_area section_gap">
  <div class="container">
    <div class="billing_details">
      <div class="row">
        <div class="col-lg-8">
          <h3><b style="color: #000">Alamat Pengiriman</b></h3>
          <div>
            <h5><b style="color: black;"><?= $member['nama_depan']; ?> <?= $member['nama_belakang']; ?></b></h5>
            <h6><?= $member['no_telp']; ?></h6>
            <p><?= $member['alamat']; ?></p>
            <p><?= $member['nama_kota']; ?>, KEC. <?= $member['nama_kecamatan'] ?>, KEL. <?= $member['nama_kelurahan'] ?>, <?= $member['kode_pos'] ?></p>
          </div>
          <hr>
          <div class="creat_account">
            <h3><a href="#" data-toggle="modal" data-target="#modalTampil" class="main_btn">Pilih Alamat Lain</a></h3>
          </div>
          <form
          class="row contact_form"
          action="<?= base_url('Frontend/Checkout/proses_pesanan'); ?>"
          method="post"
          id="addForm"
          >         
          <div class="col-md-12 form-group select-outline">
            <select class="mdb-select md-form md-outline colorful-select dropdown-success" name="id_ongkir" id="kategori" required onclick="hasil('<?=$total_bayar['total']?>')">
              <option value="" disabled selected>Pilih opsi Anda</option>
              <?php 
              foreach ($ongkir as $row) {
                ?>
                <option value="<?= $row['id_ongkir'] ?>" ><?= $row['jenis_kurir']; ?></option>
              <?php } ?>
            </select>
            <label>Pilih kurir</label>
          </div>

          <div class="col-md-12 form-group select-outline">
            <select class="mdb-select md-form md-outline colorful-select dropdown-success" name="id_bank" id="bank" required>
              <option value="" disabled selected>Pilih opsi Anda</option>
              <?php 
              foreach ($bank as $row) {
                ?>
                <option value="<?= $row['id_bank'] ?>"><?= $row['nama_bank']; ?></option>
              <?php } ?>
            </select>
            <label>Pilih Bank</label>
          </div>

        </div>
        <div class="col-lg-4">
          <div class="order_box">
            <h2>Ringkasan Belanja</h2>
            <ul class="list list_2">
              <li>
                <a href="#"
                >Total Harga
                (<?= $jumlah  ; ?> Produk)
                <span id="">Rp. <?= number_format($total, 0,',','.'); ?></span>
                <input type="hidden" name="k" id="total" value="<?= $total ?>">
                <input type="hidden" name="total_bayar" id="tagihan">
                <input type="hidden" name="id_alamat" value="<?= $member['id_alamat']?>">
              </a>
            </li>
            <li>
              <a href="#"
              >Pengiriman
              <span class="subkategori">Rp. 0</span>
              <input type="hidden" name="m" class="subkategori">
            </a>
          </li>
          <li>
            <a href="#"
            >Total Tagihan
            <span class="total"></span>
          </a>
        </li>

      </ul>
      <?php foreach ($id as $key) {?>
        <input type="hidden" name="id[]" value="<?=$key?>">
      <?php } ?>
      <button href="#" class="main_btn my-2 mx-auto d-block">Bayar</button>
    </form>
  </div>
</div>




<!-- Modal Alamat-->
<div class="modal fade" id="modalTampil" tabindex="-1" role="dialog" aria-labelledby=#modalTampil" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih Alamat Pengiriman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form class="forms-sample" id="readForm" method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Kota/insert');  ?>">
          <div class="form-group">
            <a href="#" data-toggle="modal" data-target="#modalTambah" data-dismiss="modal" class="btn btn-outline-success my-2 mx-auto d-block">Tambah Alamat Baru</a>
            <?php foreach ($alamat as $key) { ?>

              <div class="card my-2">
                <div class="card-body">
                  <p class="card-text"><?= $key['nama_kota']; ?>, KEC. <?= $key['nama_kecamatan'] ?>, KEL. <?= $key['nama_kelurahan'] ?>, <?= $key['kode_pos'] ?></p>
                  
                  <?php if ($key['status'] == 'arsip') { ?>
                    <a href="<?= base_url('Frontend/Checkout/updateAlamat/'.$key['id_alamat']); ?>" class="btn btn-sm btn-outline-success">Pilih</a>
                  <?php }elseif($key['status'] == 'publik') { ?>
                  <?php } ?>
                </div>
              </div>

            <?php } ?>
            <input type="hidden" name="id_alamat" id="id_alamat">
          </div>

        </form>

      </div>
    </div>
  </div>
</div>
<!-- Modal Alamat -->

<!-- Modal Tambah-->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby=#modalTambah" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold text-center" id="exampleModalLabel">Tambah Alamat Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST" enctype="multipart/form-data" action="<?= base_url('Frontend/Checkout/tambahAlamat');  ?>">
          <div class="md-form">
            <select class="mdb-select md-form" searchable="Cari disini ..." name="id_provinsi" id="provinsi" required>
              <option value="" disabled selected>Pilih Provinsi</option>
              <?php 
              foreach($provinsi as $prov)
              {
                echo '<option value="'.$prov['id_provinsi'].'">'.$prov['nama_provinsi'].'</option>';
              }
              ?>
            </select>
          </div>
          <div class="md-form">
            <select name="id_kota" class="mdb-select md-form" searchable="Cari disini ..." id="kabupaten" required>
              <option value="" disabled selected>Pilih Kabupaten/ Kota</option>
            </select>
          </div>
          <div class="md-form">
            <select name="id_kecamatan" class="mdb-select md-form" searchable="Cari disini ..." id="kecamatan" required>
              <option value="" disabled selected>Pilih Kecamatan</option>
            </select>
          </div>
          <div class="md-form">
            <select name="id_kelurahan" class="mdb-select md-form" searchable="Cari disini ..." id="desa" required>
              <option value="" disabled selected>Pilih Kelurahan</option>
            </select>
          </div>
          <div class="md-form">
            <select class="mdb-select md-form" disabled>
              <option value="" disabled selected>Mohon isi alamat dengan lengkap dan tepat !</option>
            </select>
          </div>
          <div class="md-form">
            <textarea id="form7" name="alamat" class="md-textarea form-control" rows="2" required></textarea>
            <label for="form7">Alamat Lengkap</label>
            <input type="hidden" name="id_alamat" id="id_alamat">
          </div>
          <div class="md-form">
            <input type="text" id="form1" name="kode_pos" class="form-control" required>
            <label for="form1">Kode Pos</label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-success" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
<!-- Modal Tambah -->

<!-- Modal Konfirmasi -->
<div class="modal" tabindex="-1" id="modalKonfirmasi" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Apakah Anda Yakin ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
        <a href="<?= base_url('Frontend/Checkout/proses_pesanan'); ?>" class="btn btn-danger">Yakin</a>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Konfirmasi -->

</div>
</div>
</div>
</section>
<!--================End Checkout Area =================-->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<!--================ start footer Area  =================-->
<?php $this->load->view('_layout_frontend/footer.php'); ?>
<!--================ End footer Area  =================-->

<!-- Optional JavaScript -->

<script src="<?= base_url('assets/MDB/js/jquery.min.js');?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#kategori').change(function(){
      var id=$(this).val();
      $.ajax({
        url : "<?php echo base_url();?>Frontend/Checkout/get_detail_ongkir",
        method : "POST",
        data : {id: id},
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '';
          var i;
          var a;
          for(i=0; i<data.length; i++){
            html += data[i].harga;
            var b = data[i].harga;
            var c = $('#total').val();
            a = Number(b) + Number(c);
          }
          $('.subkategori').val(html);
          $('.subkategori').html(html);
          $('.total').html(a);
          $('#tagihan').val(a);

        }
      });
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#provinsi").change(function (){
      var url = "<?php echo site_url('Frontend/Profile/add_ajax_kab');?>/"+$(this).val();
      $('#kabupaten').load(url);
      return false;
    })

    $("#kabupaten").change(function (){
      var url = "<?php echo site_url('Frontend/Profile/add_ajax_kec');?>/"+$(this).val();
      $('#kecamatan').load(url);
      return false;
    })

    $("#kecamatan").change(function (){
      var url = "<?php echo site_url('Frontend/Profile/add_ajax_des');?>/"+$(this).val();
      $('#desa').load(url);
      return false;
    })
  });
</script>

<?php $this->load->view('_layout_frontend/js.php'); ?>
<?php $this->load->view('_layout_frontend/alert.php'); ?>
</body>

</html>