<!--   <script src="<?= base_url('assets/frontend/js/jquery-3.2.1.min.js'); ?>"></script>
  <script src="<?= base_url('assets/frontend/js/popper.js'); ?>"></script>
  <script src="<?= base_url('assets/frontend/js/bootstrap.min.js'); ?>"></script> -->
  <script src="<?= base_url('assets/frontend/js/stellar.js'); ?>"></script>
  <script src="<?= base_url('assets/frontend/vendors/lightbox/simpleLightbox.min.js'); ?>"></script>
  <!-- <script src="<?= base_url('assets/frontend/vendors/nice-select/js/jquery.nice-select.min.js'); ?>"></script> -->
  <script src="<?= base_url('assets/frontend/vendors/isotope/imagesloaded.pkgd.min.js'); ?>"></script>
  <script src="<?= base_url('assets/frontend/vendors/isotope/isotope-min.js'); ?>"></script>
  <script src="<?= base_url('assets/frontend/vendors/owl-carousel/owl.carousel.min.js'); ?>"></script>
  <script src="<?= base_url('assets/frontend/js/jquery.ajaxchimp.min.js'); ?>"></script>
  <script src="<?= base_url('assets/frontend/vendors/counter-up/jquery.waypoints.min.js'); ?>"></script>
  <script src="<?= base_url('assets/frontend/vendors/counter-up/jquery.counterup.js'); ?>"></script>
  <script src="<?= base_url('assets/frontend/js/mail-script.js'); ?>"></script>
  <script src="<?= base_url('assets/frontend/js/bootstrap-select.js'); ?>"></script>
  <script src="<?= base_url('assets/frontend/js/bootstrap-select.min.js'); ?>"></script>
  <script src="<?= base_url('assets/frontend/js/theme.js'); ?>"></script>
  <script src="<?= base_url('assets/js/jquery.validate.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/jquery.validate.js'); ?>"></script>
  <script src="<?= base_url('assets/js/select2.full.min.js'); ?>"></script>
  <script src="<?= base_url('assets/sweetalert2/sweetalert2.min.js');?>"></script>
  <script src="<?= base_url('assets/MDB/js/jquery.min.js');?>"></script>
  <script src="<?= base_url('assets/MDB/js/popper.min.js');?>"></script>
  <script src="<?= base_url('assets/MDB/js/bootstrap.min.js');?>"></script>
  <script src="<?= base_url('assets/MDB/js/mdb.min.js');?>"></script>
  <script src="<?= base_url('assets/MDB/js/addons-pro/multi-range.min.js');?>"></script>
  <script>
    // Material Select Initialization
    $(document).ready(function() {
      $('.mdb-select').materialSelect();
      $('.datepicker').pickadate({
        // Escape any “rule” characters with an exclamation mark (!).
        format: 'yyyy-mm-dd',
        formatSubmit: 'yyyy-mm-dd',
        hiddenPrefix: 'prefix__',
        hiddenSuffix: '__suffix'
      });
    });

    $('.carousel.carousel-multi-item.v-2 .carousel-item').each(function(){
      var next = $(this).next();
      if (!next.length) {
        next = $(this).siblings(':first');
      }
      next.children(':first-child').clone().appendTo($(this));

      for (var i=0;i<4;i++) {
        next=next.next();
        if (!next.length) {
          next=$(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));
      }
    });
  </script>