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
    <div class="section-header shadow">
      <h1>Data detail transaksi</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>
                <a class="btn btn-primary" href="<?= base_url('Admin/Transaksi'); ?>">
                  <i class="fa fa-arrow-left"> Kembali</i>
                </a>
              </h4>
              <div class="card-header-action">

              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-hover" id="sortable-table">
                  <thead class="text-center">
                    <tr>
                      <th>No</th>
                      <th colspan="2" class="text-center">Barang</th>
                      <th>Ukuran</th>
                      <th>Harga</th>
                      <th>Jumlah Pesanan</th>
                      <th>Sub Total</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php 
                    $no = 1;
                    foreach ($detail as $row) {
                      ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td>
                          <img style="width:20%;border: 1px solid #ddd;border-radius: 5px;padding: 5px;width: 90px;height: 90px;" class="my-3"  src="<?php echo base_url('assets/images/upload/'.$row['gambar1']) ?>">
                        </td>
                        <td><?= $row['nama_barang']; ?></td>
                        <td><?= $row['ukuran']; ?></td>
                        <td>Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td><?= $row['jumlah_barang']; ?></td>
                        <td>Rp. <?= number_format($row['jumlah_barang']*$row['harga'], 0, ',', '.'); ?></td>
                      </tr>
                    <?php } ?>
                    <tr>
                      <td colspan="5" class="text-right font-weight-bold">Total Bayar</td>
                      <td class="font-weight-bold">
                        Rp. <?= number_format($total['total_bayar'], 0, ',', '.'); ?>    
                      </td>
                    </tr>
                  </tbody>
                </table>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


</div>


<?php $this->load->view('_partials_admin/footer'); ?>