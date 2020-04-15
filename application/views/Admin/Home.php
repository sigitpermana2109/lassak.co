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
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-success bg-success">
            <i class="fas fa-archive"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Pesanan</h4>
            </div>
            <div class="card-body">
              <?= number_format($totalTransaksi['total_transaksi'], 0, ',', '.'); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
         
          <div class="card-icon shadow-success bg-success">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Penghasilan Bulan Ini</h4>
            </div>
            <div class="card-body">
              Rp. <?= number_format($total_penghasilan['total'], 0, ',', '.'); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          
          <div class="card-icon shadow-success bg-success">
            <i class="fas fa-shopping-bag"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Barang</h4>
            </div>
            <div class="card-body">
              <?= number_format($totalBarang['total_barang'], 0, ',', '.'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Transaksi Terbaru</h4>
            <div class="card-header-action">
              <form method="POST" action="<?= base_url('Admin/Laporan'); ?>">
                <div class="row">
                  <div class="col">
                    <input type="text" name="tgl_awal" class="form-control datepicker">
                  </div>                 
                    <p>S/D</p>
                  <div class="col">
                    <input type="text" name="tgl_akhir" class="form-control datepicker">
                  </div>
                  <div class="col">
                    <button type="submit" class="btn btn-success">Cetak Laporan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="card-body">
            <div class="table-responsive table-invoice">
              <table class="table table-striped text-center">
                <tr>
                  <th>No. Transaksi</th>   
                  <th>Pelanggan</th>
                  <th>Tanggal</th>
                </tr>
                <?php foreach ($transaksiBaru as $row) { ?>
                  <tr>
                    <td><?= $row['id_transaksi']; ?></td>                        
                    <td class="font-weight-600"><?= $row['nama_depan']; ?></td>
                    <td><?php $date = date('d M, Y H:i:s', strtotime($row['tanggal_transaksi'])); 
                    echo $date; ?>    
                  </td>                        
                </tr>
              <?php } ?>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>
</div>
<?php $this->load->view('_partials_admin/footer'); ?>