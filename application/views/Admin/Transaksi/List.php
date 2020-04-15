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
      <h1>Data transaksi</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>

              </h4>
              <div class="card-header-action">
                <form action="<?= base_url('Admin/Transaksi/search'); ?>">
                  <div class="input-group">
                    <input type="text" class="form-control" name="keyword" placeholder="Search">
                    <div class="input-group-btn">
                      <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-hover" id="sortable-table">
                  <thead class="text-center">
                    <tr>
                      <th>No</th>
                      <th>Nama Pemesan</th>
                      <th>Tanggal Pemesanan</th>
                      <th>Batas Pembayaran</th>
                      <th>Status</th>
                      <th colspan="3">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php 
                    $no = 1;
                    foreach ($transaksi as $row) {
                      ?>
                      <tr>
                        <td><?= $row['id_transaksi']; ?></td>
                        <td><?= $row['nama_depan']; ?></td>
                        <td>
                          <?php $date = date('d M, Y H:i:s', strtotime($row['tanggal_transaksi'])); 
                          echo $date; ?>    
                        </td>
                        <td>
                          <?php $batas = date('d M, Y H:i:s', strtotime($row['batas_bayar'])); 
                          echo $batas; ?>
                        </td>
                        <td>
                          <?php if ($row['status_transaksi'] == 'Menunggu Pembayaran') { ?>
                            <a href="#" class="badge badge-secondary">
                              Menunggu Pembayaran
                            </a>

                          <?php }elseif ($row['status_transaksi'] == 'Menunggu Konfirmasi') { ?>
                            <a href="#" class="badge badge-warning" data-toggle="modal" data-target="#modalResi1<?= $row['id_transaksi']; ?>">
                              Menunggu Konfirmasi
                            </a>

                          <?php } elseif ($row['status_transaksi'] == 'Pesanan Diproses') { ?>
                            <a href="#" class="badge badge-info" data-toggle="modal" data-target="#modalResi1<?= $row['id_transaksi']; ?>">
                              Pesanan Diproses
                            </a>

                          <?php } elseif ($row['status_transaksi'] == 'Sedang Dikirim') { ?>
                            <a href="#" class="badge badge-primary">
                              Sedang Dikirim
                            </a> 

                          <?php } elseif ($row['status_transaksi'] == 'Selesai') { ?>
                            <a href="#" class="badge badge-success">
                              Selesai
                            </a>

                          <?php } elseif($row['status_transaksi'] == 'Pesanan Dibatalkan') {?>
                            <a href="#" class="badge badge-danger">
                              Pesanan Dibatalkan
                            </a>
                          <?php } ?>
                        </td>
                        <td>
                          <button data-toggle="modal" data-target="#modalDetail<?= $row['id_transaksi']; ?>" class="btn btn-sm btn-rounded btn-warning" >
                            <i class="far fa-eye"></i>
                          </button>
                        </td>
                        <?php if ($row['status_transaksi'] == 'Sedang Dikirim') { ?>
                        <td>
                          <?php if (empty($row['no_resi'])) { ?>
                            <button data-toggle="modal" data-target="#modalResi<?= $row['id_transaksi']; ?>" class="btn btn-sm btn-rounded btn-danger">
                              <i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Insert nomor resi"></i>
                            </button>
                          <?php }else{ ?>
                            <button data-toggle="tooltip" data-placement="top" title="Nomor resi sudah ada" class="btn btn-sm btn-rounded btn-success">
                              <i class="fa fa-check"></i>
                            </button>
                          <?php } ?>
                        </td>
                        <?php }else{ ?>
                          
                        <?php } ?>
                        <td>
                          <a class="btn btn-sm btn-rounded btn-primary" href="<?= base_url('Admin/Transaksi/detail_transaksi/'.$row['id_transaksi']); ?>">
                            <i class="fas fa-info"></i>
                          </a>
                        </td>

                      </tr>
                    <?php } ?>
                  </tbody>
                </table>

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
        </div>
      </div>
    </div>
  </section>

  <?php foreach ($transaksi as $row) { ?>

    <!-- Modal Edit-->
    <div class="modal fade" id="modalResi<?= $row['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah nomor resi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form class="forms-sample" id="formUpdate" method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Transaksi/insertResi/'.$row['id_transaksi']); ?>">
              <div class="form-group">
                <label for="exampleInputEmail3">Nomor resi</label>
                <input type="text" name="no_resi" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm btn-rounded" data-dismiss="modal" aria-hidden="true">Batal</button>
              <button type="submit" class="btn btn-primary btn-sm btn-rounded" aria-hidden="true">Tambah</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal Edit -->

    <!-- Modal Update Status-->
    <div class="modal fade" id="modalResi1<?= $row['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin ingin mengubah status transaksi ?</p>  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning btn-sm btn-rounded" data-dismiss="modal">Batal</button>
            <a href="<?= base_url('Admin/Transaksi/updateStatus/'.$row['id_transaksi'])?>" class="btn btn-danger btn-sm btn-rounded">Update</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Update Status -->

    <!-- Modal Detail-->
    <div class="modal fade bd-example-modal-lg" id="modalDetail<?= $row['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myLargeModalLabel">Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <table class="table" id="sortable-table">                    
              <tr>
                <td class="font-weight-bold">Nama</td>
                <td colspan="2"><?= $row['nama_depan']; ?> <?= $row['nama_belakang']; ?></td>
                <td></td>
              </tr>
              <tr>
                <td class="font-weight-bold">Alamat</td>
                <td colspan="2"><?= $row['nama_kota']; ?>, KEC. <?= $row['nama_kecamatan'] ?>, KEL. <?= $row['nama_kelurahan'] ?>, <?= $row['alamat'] ?>, <?= $row['kode_pos'] ?></td>
                <td></td>
              </tr>
              <tr>
                <td class="font-weight-bold">Bank</td>
                <td colspan="2"><?= $row['nama_bank']; ?> - <?= $row['no_rekening']; ?> a/n <?= $row['nama_pemilik'] ?></td>
                <td></td>
              </tr>
              <tr>
                <td class="font-weight-bold">Nomor resi</td>
                <td colspan="2"><?= $row['no_resi']; ?></td>
                <td></td>
              </tr>
              <tr>
                <td class="font-weight-bold">Total Bayar</td>
                <td colspan="2">Rp. <?= number_format($row['total_bayar'], 0, ',', '.'); ?></td>
                <td></td>
              </tr>
              <tr>
                <td class="font-weight-bold">Bukti transfer</td>
                <td colspan="2">
                  <a href="#" data-dismiss="modal">
                    <div class="gallery">
                      <div class="gallery-item" data-image="<?php echo base_url('assets/images/upload/bukti_pembayaran/'.$row['upload_pembayaran']) ?>" data-title="Image 1">
                        <img style="width:20%;border: 1px solid #ddd;border-radius: 5px;padding: 5px;width: 90px;height: 90px;"  src="<?php echo base_url('assets/images/upload/bukti_pembayaran/'.$row['upload_pembayaran']) ?>">
                      </div>
                    </div>
                  </a>
                </td>
                <td></td>
              </tr>

            </table>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm btn-rounded" data-dismiss="modal" aria-hidden="true">Tutup</button>

          </div>
        </div>
      </div>
    </div>
    <!-- Modal Detail -->
  <?php } ?>

</div>


<?php $this->load->view('_partials_admin/footer'); ?>

<script type="text/javascript">
  $(document).ready(function(){

    $('#form_valid').on('submit', function(event){
      event.preventDefault();
      $.ajax({
        url:"<?= base_url('admin/transaksi/insert'); ?>",
        method: "POST",
        data:$(this).serialize(),
        dataType:'json',
        beforeSend:function(){
          $('#valid').attr('disabled', 'disabled');
        },
        success:function(data)
        {
          if (data.error) {
            if (data.nama_transaksi_error != '') 
            {
              $('#nama_transaksi_error').html(data.nama_transaksi_error);
            }
            else
            {
              $('#nama_transaksi_error').html('');
            }
            if (data.no_rekening_error != '') 
            {
              $('#no_rekening_error').html(data.no_rekening_error);
            }
            else
            {
              $('#no_rekening_error').html('');
            }
          }

          if (data.success) 
          {
            $('#berhasil').html(data.success);
            $('#nama_transaksi_error').html('');
            $('#no_rekening_error').html('');
            $('#form_valid')[0].reset();
          }
          $('#valid').attr('disabled', false);


        }

      })
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){

    $('#formUpdate').on('submit', function(event){
      event.preventDefault();
      $.ajax({
        url:"<?= base_url('admin/transaksi/update/'.$transaksi['id_transaksi']) ?>",
        method: "POST",
        data:$(this).serialize(),
        dataType:'json',
        beforeSend:function(){
          $('#valid1').attr('disabled', 'disabled');
        },
        success:function(data)
        {
          if (data.error) {
            if (data.nama_transaksi_error1 != '') 
            {
              $('#nama_transaksi_error1').html(data.nama_transaksi_error1);
            }
            else
            {
              $('#nama_transaksi_error1').html('');
            }
            if (data.no_rekening_error1 != '') 
            {
              $('#no_rekening_error1').html(data.no_rekening_error1);
            }
            else
            {
              $('#no_rekening_error1').html('');
            }
          }

          if (data.success) 
          {
            $('#berhasil').html(data.success);
            $('#nama_transaksi_error1').html('');
            $('#no_rekening_error1').html('');
            $('#formUpdate')[0].reset();
          }
          $('#valid1').attr('disabled', false);


        }

      })
    });
  });
</script>