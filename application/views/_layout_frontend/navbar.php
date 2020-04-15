<header class="header_area">
  <div class="main_menu">

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar success-color">
      <div class="container">
        <a class="navbar-brand logo_h" href="<?= base_url('Home'); ?>">
          <img style="width: 137px;height: 50px;" src="<?= base_url('assets/images/logo-name.png'); ?>" alt="" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7"
          aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item mx-1">
              <a class="nav-link font-weight-bold" href="<?= base_url('Home'); ?>">Beranda</a>
            </li>
            <li class="nav-item mx-1">
              <a class="nav-link font-weight-bold" href="<?= base_url('Frontend/Shop'); ?>">Belanja</a>
            </li>
            <li class="nav-item mx-1">
              <a class="nav-link font-weight-bold" href="<?= base_url('Frontend/Kontak'); ?>">Kontak</a>
            </li>
          </ul>
          <div class="md-form my-0">
            <ul class="navbar-nav mx-1 ml-auto">
              <?php if ($this->session->userdata('email') != NULL) { ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="icon-shopping-bag"></span>
                    <span class="number">
                      <?php if($total_keranjang['total_keranjang'] == 0){
                        echo "0";
                      }else{
                        echo $total_keranjang['total_keranjang'];
                      } ?>
                    </span>          
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-success" aria-labelledby="navbarDropdownMenuLink-4">
                    <?php if ($row_keranjang != NULL) { ?>
                      <?php foreach ($nav_keranjang as $row) { ?>
                          <a class="dropdown-item" href="javascript:void(0)">
                            <div class="mx-3 py-3">
                              <table>
                                <tr>
                                  <td><img style="width:20%;border: 1px solid #ddd;border-radius: 5px;padding: 5px;width: 90px;height: 90px;"  src="<?php echo base_url('assets/images/upload/'.$row['gambar1']) ?>"></td>
                                  <td>
                                    <h5 class="mx-3"><?= substr($row['nama_barang'], 0, 10); ?> ...</h5>             
                                    <p class="mx-3"><span class="text-danger">Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></span> <?= $row['jumlah']; ?> Produk</p>
                                  </td>
                                </tr>
                              </table>
                            </div>                         
                      <?php } ?>
                              <a class="dropdown-item text-center" href="<?= base_url('Frontend/Shop/tampil_keranjang'); ?>">Selengkapnya</a>
                           </a>                     
                  
                  <?php }else{ ?>
                  
                        <a class="dropdown-item" href="javascript:void(0)">
                          <div class="mx-3 py-3">
                            <img class="mx-auto d-block" style="max-width: 25%;max-height: 25%;" src="<?= base_url('assets/frontend/img/warning.png'); ?>">
                            <h5 class="text-center">Belum ada pesanan</h5>
                          </div>
                        </a>
                   </div>    
                  <?php } ?> 
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">                   
                    <img style="width: 30px;height: 30px; border: 1px solid #ddd;border-radius: 100px;" src="<?= base_url('assets/images/faces/'.$user['foto']); ?>"> <span class="font-weight-bold"><?= $user['nama_depan']; ?></span>          
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-success" aria-labelledby="navbarDropdownMenuLink-4">
                    <a class="dropdown-item" href="<?= base_url('Frontend/Profile'); ?>">Profil Saya</a>
                    <a class="dropdown-item" href="<?= base_url('Frontend/Riwayat'); ?>">Riwayat Pembelian</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalLogout">Keluar</a>
                  </div>
                </li>
              <?php } else{ ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle btn btn-outline-white" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user"></i> LOGIN
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-success"
                    aria-labelledby="navbarDropdownMenuLink-333">
                    <a class="dropdown-item" href="<?= base_url('Auth_member'); ?>">LOGIN</a>
                    <a class="dropdown-item" href="<?= base_url('Auth_member/daftar'); ?>">REGISTRASI</a>
                  </div>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </nav>

  </div>
</header>

<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Apakah Anda Yakin ?</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fa fa-times fa-4x animated rotateIn text-danger"></i>

      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a href="<?= base_url('Auth_member/logout'); ?>" class="btn  btn-outline-danger">Yes</a>
        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->