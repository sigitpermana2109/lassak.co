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
      <h1>Data member</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                  <i class="fa fa-plus"> Tambah Data</i>
                </button>
              </h4>
              <div class="card-header-action">
                <form action="<?= base_url('Admin/Member/search'); ?>">
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
                      <th>Nama</th>
                      <th>Email</th>
                      <th>No. Telp</th>
                      <th>Tgl. Lahir</th>
                      <th>JK</th>
                      <th>Foto</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php 
                    $no = 1;
                    foreach ($member as $row) {
                      ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama_depan']; ?> <?= $row['nama_belakang']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['no_telp']; ?></td>
                        <td><?= $row['tgl_lahir'] ?></td>
                        <td><?= $row['jk']; ?></td>
                        <td><img style="width:20%;border: 1px solid #ddd;border-radius: 5px;padding: 5px;width: 100px;height: 100px;"  src="<?php echo base_url('assets/images/faces/'.$row['foto']); ?>">
                        </td>
                        <td>
                          <button data-toggle="modal" data-target="#modalHapus<?= $row['id_member']; ?>" class="btn btn-sm btn-rounded btn-danger">
                            <i class="fas fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>

              </div>
              <!-- pagination -->
              <!-- <div class="row">
                <div class="col">
                  <?= $pagination; ?>
                </div>
              </div> -->
              <!-- pagination -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php foreach ($member as $row) { ?>

    <!-- Modal Hapus -->
    <div class="modal fade" tabindex="-1" id="modalHapus<?= $row['id_member']; ?>" role="dialog" aria-hidden="true">
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
            <button type="button" class="btn btn-warning btn-sm btn-rounded" data-dismiss="modal">Batal</button>
            <a href="<?= base_url('Admin/Member/delete/'.$row['id_member']); ?>" class="btn btn-danger btn-sm btn-rounded">Hapus</a>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal Hapus -->
  <?php } ?>

</div>


<?php $this->load->view('_partials_admin/footer'); ?>

<script type="text/javascript">
  $(document).ready(function(){

    $('#form_valid').on('submit', function(event){
      event.preventDefault();
      $.ajax({
        url:"<?= base_url('admin/member/insert'); ?>",
        method: "POST",
        data:$(this).serialize(),
        dataType:'json',
        beforeSend:function(){
          $('#valid').attr('disabled', 'disabled');
        },
        success:function(data)
        {
          if (data.error) {
            if (data.nama_member_error != '') 
            {
              $('#nama_member_error').html(data.nama_member_error);
            }
            else
            {
              $('#nama_member_error').html('');
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
            $('#nama_member_error').html('');
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
        url:"<?= base_url('admin/member/update/'.$member['id_member']) ?>",
        method: "POST",
        data:$(this).serialize(),
        dataType:'json',
        beforeSend:function(){
          $('#valid1').attr('disabled', 'disabled');
        },
        success:function(data)
        {
          if (data.error) {
            if (data.nama_member_error1 != '') 
            {
              $('#nama_member_error1').html(data.nama_member_error1);
            }
            else
            {
              $('#nama_member_error1').html('');
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
            $('#nama_member_error1').html('');
            $('#no_rekening_error1').html('');
            $('#formUpdate')[0].reset();
          }
          $('#valid1').attr('disabled', false);


        }

      })
    });
  });
</script>