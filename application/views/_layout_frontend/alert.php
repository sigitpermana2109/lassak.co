  <?php
  if($this->session->flashdata('berhasil')){  ?>
    <script type="text/javascript">
      $(document).ready(function(){
        Swal.fire('Berhasil','Data Berhasil Ditambahkan','success');
      });
    </script>
  <?php }else if($this->session->flashdata('gagal')){ ?>
    <script type="text/javascript">
      $(document).ready(function(){
        Swal.fire('Gagal','Data Gagal Ditambahkan','error');
      });
    </script>
  <?php }else if($this->session->flashdata('berhasil_update')){ ?>
    <script type="text/javascript">
      $(document).ready(function(){
        Swal.fire('Berhasil','Data Berhasil Di Update','success');
      });
    </script>
  <?php }else if($this->session->flashdata('gagal_update')){ ?>
    <script type="text/javascript">
      $(document).ready(function(){
        Swal.fire('Gagal','Data Gagal Di Update','error');
      });
    </script>
  <?php }else if($this->session->flashdata('hapus')){ ?>
    <script type="text/javascript">
      $(document).ready(function(){
        Swal.fire('Berhasil','Data Berhasil Terhapus','success');
      });
    </script>
  <?php }else if($this->session->flashdata('hapus_gagal')){ ?>
    <script type="text/javascript">
      $(document).ready(function(){
        Swal.fire('Gagal','Data Gagal Di Hapus','error');
      });
    </script>
  <?php }else if($this->session->flashdata('selamat')){ ?>
    <script type="text/javascript">
      $(document).ready(function(){
        Swal.fire('Anda telah berhasil melakukan transaksi','Mohon tunggu konfirmasi dari admnistrator','success');
      });
    </script>
  <?php }else if($this->session->flashdata('selamat_gagal')){ ?>
    <script type="text/javascript">
      $(document).ready(function(){
        Swal.fire('Gagal','Data Gagal Di Hapus','error');
      });
    </script>
  <?php }else if($this->session->flashdata('Kosong')){ ?>
    <script type="text/javascript">
      $(document).ready(function(){
        Swal.fire('Maaf','Anda Belum Memilih Barang','error');
      });
    </script>
  <?php }else if($this->session->flashdata('jumlah_kurang')){ ?>
    <script type="text/javascript">
      $(document).ready(function(){
        Swal.fire('Maaf','Stok Barang Kami Tidak Mencukupi','error');
      });
    </script>
    <?php } ?>