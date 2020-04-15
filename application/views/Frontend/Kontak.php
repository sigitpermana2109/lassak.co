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
              <h1 style="color: #fff;">Kontak kami</h1>
              <p style="color: #ebebeb;">Hubungi kami untuk segala pertanyaan anda</p>
            </div>
            <div class="page_link">
              <a href="index.html" style="color: #ebebeb;">Beranda</a>
              <a href="contact.html" style="color: #ebebeb;">Kontak kami</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!-- ================ contact section start ================= -->
  <section class="section_gap">
        <div class="col-lg-12">
          <div class="main_title">
            <h2><span>Kontak kami</span></h2>
          </div>
        </div>
    <div class="container">
      <div class="row">
   
        <div class="col-lg-8 mb-4 mb-lg-0">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.997236842967!2d107.55608431477275!3d-6.890932595020627!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6bd6aaaaaab%3A0xf843088e2b5bf838!2sSMK%20Negeri%2011%20Bandung!5e0!3m2!1sid!2sid!4v1580866409481!5m2!1sid!2sid" width="600" height="450" frameborder="0" style="border:0;height: 480px;width:700px;" allowfullscreen="" class="img-fluid"></iframe>

        </div>

        <div class="col-lg-4">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
              <h3>Bandung, Jawa barat.</h3>
              <p>Cilember, 40153</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
            <div class="media-body">
              <h3><a href="tel:454545654">0895395288400</a></h3>
              <p>Senin - Jum'at 7.00 - 18.00</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
              <h3><a href="mailto:support@colorlib.com">lassak@gmail.com</a></h3>
              <p>Kirim pertanyaan anda kapanpun dan dimanapun !</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->

  <!--================ start footer Area  =================-->
  <?php $this->load->view('_layout_frontend/footer.php'); ?>
  <!--================ End footer Area  =================-->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <?php $this->load->view('_layout_frontend/js.php'); ?>
  <?php $this->load->view('_layout_frontend/alert.php'); ?>
</body>
</html>