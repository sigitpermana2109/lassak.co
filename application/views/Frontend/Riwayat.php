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
					<h1 style="color: #fff;">Riwayat pembelian</h1>
					<p style="color: #ebebeb;">Semua tentang item yang anda beli dan sudah terbeli</p>
				</div>
				<div class="page_link">
					<a href="index.html" style="color: #ebebeb;">Beranda</a>
					<a href="contact.html" style="color: #ebebeb;">Riwayat pembelian</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!--================End Home Banner Area =================-->

<!-- ================ contact section start ================= -->
<section class="section_gap">
	<div class="container">
		<div class="mx-auto d-block">
			<nav>
				<ul class="nav nav-tabs nav-justified md-tabs success-color" id="myTabJust" role="tablist">
					<li class="nav-item">
						<a class="nav-item nav-link active" id="menunggu-pembayaran-tab" data-toggle="tab" href="#menunggu-pembayaran" role="tab" aria-controls="menunggu-pembayaran" aria-selected="true"><h6 class="h6-responsive text-white">Menunggu Pembayaran</h6></a>						
					</li>
					<li class="nav-item">
						<a class="nav-item nav-link" id="menunggu-konfirmasi-tab" data-toggle="tab" href="#menunggu-konfirmasi" role="tab" aria-controls="menunggu-konfirmasi" aria-selected="false"><h6 class="h6-responsive text-white">Menunggu Konfirmasi</h6></a>
					</li>
					<li class="nav-item">
						<a class="nav-item nav-link" id="pesanan-diproses-tab" data-toggle="tab" href="#pesanan-diproses" role="tab" aria-controls="pesanan-diproses" aria-selected="false"><h6 class="h6-responsive text-white">Pesanan Sedang Diproses</h6></a>
					</li>
					<li class="nav-item">
						<a class="nav-item nav-link" id="sedang-dikirim-tab" data-toggle="tab" href="#sedang-dikirim" role="tab" aria-controls="sedang-dikirim" aria-selected="false"><h6 class="h6-responsive text-white">Pesanan Sedang Dikirim</h6></a>
					</li>
					<li class="nav-item">
						<a class="nav-item nav-link" id="nav-selesai-tab" data-toggle="tab" href="#nav-selesai" role="tab" aria-controls="nav-selesai" aria-selected="false"><h6 class="h6-responsive text-white">Pesanan Telah Selesai</h6></a>
					</li>
					<li class="nav-item">
						<a class="nav-item nav-link" id="pesanan-dibatalkan-tab" data-toggle="tab" href="#pesanan-dibatalkan" role="tab" aria-controls="pesanan-dibatalkan" aria-selected="false"><h6 class="h6-responsive text-white">Pesanan Telah Dibatalkan</h6></a>
					</li>
				</ul>
			
			</nav>

			<div class="tab-content card pt-5" id="nav-tabContent">
				<div class="tab-pane fade show active text-body" id="menunggu-pembayaran" role="tabpanel" aria-labelledby="menunggu-pembayaran-tab">
					<div class="row">
						<?php if(!empty($getMenunggu)){ ?>
							<?php foreach ($menunggu_pembayaran as $row) {
								?>
								<div class="col-lg-5 col-md-5 shadow my-3 mx-auto d-block">
									<h4 class="text-center my-3 font-weight-bold">Belanja</h4>
									<div class="row">
										<?php
										$batas = date('d-M-Y', strtotime($row['batas_bayar'])); 
										$waktu_sekarang = date('d-M-Y');
										if ($waktu_sekarang >= $batas) { ?>
											<div class="my-3 mx-3">
												<a href="#">
													Transaksi Dibatalkan
												</a>
											</div>
										<?php }else{ ?>
											<div class="my-3 mx-3">
												<a href="#" data-toggle="modal" data-target="#modalBatal<?= $row['id_transaksi'];?>">
													Batalkan Transaksi
												</a>
											</div>
										<?php } ?>									
									</div>
									<div class="row">
										<div class="mx-3">
											<p>Total : <span class="text-danger font-weight-bold">Rp. <?= number_format($row['total_bayar'], 0, ',', '.'); ?></span> Tanggal Pembelian <span class="font-weight-bold"><?php $date = date('d M, Y', strtotime($row['tanggal_transaksi'])); echo $date; ?></span></p>
											<div class="bg-warning">
												<p class="text-center font-weight-bold text-white">Bayar Sebelum <?php $batas = date('d M Y, H.i', strtotime($row['batas_bayar'])); echo $batas; ?> WIB</p>
											</div>
										</div>
									</div>
									<div class="my-4">
										<h5 class="font-weight-bold">Rekening yang harus ditransfer : </h5>    
										<h2 class="mx-4"><?= $row['no_rekening']; ?> (<?= $row['nama_bank']; ?>)</h2>
										<h5 class="font-weight-bold">a/n <?= $row['nama_pemilik'] ?></h5>
									</div>
									<?php
									$batas = date('d-M-Y', strtotime($row['batas_bayar'])); 
									$waktu_sekarang = date('d-M-Y');
									if ($waktu_sekarang >= $batas) { ?>
										<div class="my-3 text-center">
											<a href="#" data-toggle="modal" data-target="#modalKedaluwarsa" class="btn btn-danger">Unggah Bukti Pembayaran</a>
										</div>
									<?php }else{ ?>
										<div class="my-3 text-center">
											<a href="#" data-toggle="modal" data-target="#modalTambah" onclick="select('<?= $row['id_transaksi'] ?>', '<?= $row['upload_pembayaran'] ?>')" class="btn btn-success">Unggah Bukti Pembayaran</a>
										</div>
									<?php } ?>
								</div>
							<?php } ?>
						<?php }else{ ?>
							<div class="col-lg-12 my-4">
								<img class="mx-auto d-block" style="max-width: 25%;max-height: 25%;" src="<?= base_url('assets/frontend/img/warning.png'); ?>">
								<h5 class="text-center">Belum ada pesanan</h5>
							</div>
						<?php } ?>
					</div>
				</div>

				<div class="tab-pane fade text-body" id="menunggu-konfirmasi" role="tabpanel" aria-labelledby="menunggu-konfirmasi-tab">
					<?php if (!empty($getMenunggu_konfirmasi)) { ?>
						<?php foreach ($getMenunggu_konfirmasi as $row) {?>
							<div class="col-xl-12 my-4">
								<div class="card shadow">
									<div class="card-header">
										<p><?= $row['tanggal_transaksi']; ?></p>
									</div>
									<div class="card-body p-4">
										<div class="row">
											<div class="col-sm">
												<h5>No. Transaksi</h5>
												<p><?= $row['id_transaksi']; ?></p>
											</div>
											<div class="col-sm">
												<h5>Status Pesanan</h5>
												<p><?= $row['status_transaksi']; ?></p>
											</div>
											<div class="col-sm">
												<h5>Total Bayar</h5>
												<p class="text-danger font-weight-bold">Rp. <?= number_format($row['total_bayar'], 0, ',', '.'); ?></p>
											</div>
										</div>
										<div class="row">
											<div class="col-sm">
												<table>
													<tr>
														<td><img style="width:20%;border: 1px solid #ddd;border-radius: 5px;padding: 5px;width: 90px;height: 90px;"  src="<?php echo base_url('assets/images/upload/'.$row['gambar1']) ?>"></td>
														<td>
															<h5 class="mx-3"><?= $row['nama_barang']; ?></h5>                    
															<p class="mx-3"><span class="text-danger">Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></span> <?= $row['jumlah_barang']; ?> Produk</p>
														</td>
													</tr>
												</table>
											</div>
											<div class="col-sm">
												<h5>Total Harga Produk</h5>
												<p class="font-weight-bold">Rp. <?= number_format($row['harga']*$row['jumlah_barang'], 0, ',', '.'); ?></p>
											</div>
											<div class="col-sm my-auto d-flex">
												<button class="btn btn-success" data-toggle="modal" data-target="#modalDetail">Detail</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					<?php }else{ ?>
						<div class="col-lg-12 my-4">
							<img class="mx-auto d-block" style="max-width: 25%;max-height: 25%;" src="<?= base_url('assets/frontend/img/warning.png'); ?>">
							<h5 class="text-center">Belum ada pesanan</h5>
						</div>
					<?php } ?>
				</div>

				<div class="tab-pane fade text-body" id="pesanan-diproses" role="tabpanel" aria-labelledby="pesanan-diproses-tab">
					<?php if (!empty($getPesanan_diproses)) { ?>
						<?php foreach ($getPesanan_diproses as $row) {?>
							<div class="my-4">
								<div class="card shadow">
									<div class="card-header">
										<p><?= $row['tanggal_transaksi']; ?></p>
									</div>
									<div class="card-body p-4">
										<div class="row">
											<div class="col-sm">
												<h5>No. Transaksi</h5>
												<p><?= $row['id_transaksi']; ?></p>
											</div>
											<div class="col-sm">
												<h5>Status Pesanan</h5>
												<p><?= $row['status_transaksi']; ?></p>
											</div>
											<div class="col-sm">
												<h5>Total Bayar</h5>
												<p class="text-danger font-weight-bold">Rp. <?= number_format($row['total_bayar'], 0, ',', '.'); ?></p>
											</div>
										</div>
										<div class="row">
											<div class="col-sm">
												<table>
													<tr>
														<td><img style="width:20%;border: 1px solid #ddd;border-radius: 5px;padding: 5px;width: 90px;height: 90px;"  src="<?php echo base_url('assets/images/upload/'.$row['gambar1']) ?>"></td>
														<td>
															<h5 class="mx-3"><?= $row['nama_barang']; ?></h5>                    
															<p class="mx-3"><span class="text-danger">Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></span> <?= $row['jumlah_barang']; ?> Produk</p>
														</td>
													</tr>
												</table>
											</div>
											<div class="col-sm">
												<h5>Total Harga Produk</h5>
												<p class="font-weight-bold">Rp. <?= number_format($row['harga']*$row['jumlah_barang'], 0, ',', '.'); ?></p>
											</div>
											<div class="col-sm">
												<h5> </h5>
												<p class="text-danger"> </p>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					<?php }else{ ?>
						<div class="col-lg-12 my-4">
							<img class="mx-auto d-block" style="max-width: 25%;max-height: 25%;" src="<?= base_url('assets/frontend/img/warning.png'); ?>">
							<h5 class="text-center">Belum ada pesanan</h5>
						</div>
					<?php } ?>
				</div>

				<div class="tab-pane fade text-body" id="sedang-dikirim" role="tabpanel" aria-labelledby="sedang-dikirim-tab">
					<?php if (!empty($getSedang_dikirim)) { ?>
						<?php foreach ($getSedang_dikirim as $sdgkirim) {?>
							<div class="col-xl-12 my-4">
								<div class="card shadow">
									<div class="card-header">
										<div class="row">
											<div class="col-md-8 ">
												<p><?= $sdgkirim['tanggal_transaksi']; ?></p>
											</div>
											<div class="col-md-4">
												<a href="#" class="main_btn" data-toggle="modal" data-target="#konfirmasiPesanan<?= $sdgkirim['id_transaksi']; ?>">Pesanan Sudah Sampai ?</a>
											</div>

										</div>
									</div>
									<div class="card-body p-4">
										<div class="row">
											<div class="col-sm">
												<h5>No. Transaksi</h5>
												<p><?= $sdgkirim['id_transaksi']; ?></p>
											</div>
											<div class="col-sm">
												<h5>Status Pesanan</h5>
												<p><?= $sdgkirim['status_transaksi']; ?></p>
											</div>
											<div class="col-sm">
												<h5>Total Bayar</h5>
												<p class="text-danger font-weight-bold">Rp. <?= number_format($sdgkirim['total_bayar'], 0, ',', '.'); ?></p>
											</div>
										</div>
										<div class="row">
											<div class="col-sm">
												<table>
													<tr>
														<td><img style="width:20%;border: 1px solid #ddd;border-radius: 5px;padding: 5px;width: 90px;height: 90px;"  src="<?php echo base_url('assets/images/upload/'.$sdgkirim['gambar1']) ?>"></td>
														<td>
															<h5 class="mx-3"><?= $sdgkirim['nama_barang']; ?></h5>                    
															<p class="mx-3"><span class="text-danger">Rp. <?= number_format($sdgkirim['harga'], 0, ',', '.'); ?></span> <?= $sdgkirim['jumlah_barang']; ?> Produk</p>
														</td>
													</tr>
												</table>
											</div>
											<div class="col-sm">
												<h5>Total Harga Produk</h5>
												<p class="font-weight-bold">Rp. <?= number_format($sdgkirim['harga']*$sdgkirim['jumlah_barang'], 0, ',', '.'); ?></p>
											</div>
											<div class="col-sm my-auto d-flex">
												<button class="btn btn-success" data-toggle="modal" data-target="#modalDetail">Detail</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					<?php }else{ ?>
						<div class="col-lg-12 my-4">
							<img class="mx-auto d-block" style="max-width: 25%;max-height: 25%;" src="<?= base_url('assets/frontend/img/warning.png'); ?>">
							<h5 class="text-center">Belum ada pesanan</h5>
						</div>
					<?php } ?>
				</div>

				<div class="tab-pane fade text-body" id="nav-selesai" role="tabpanel" aria-labelledby="nav-selesai-tab">
					<div class="row">
						<?php if (!empty($getSelesai)) { ?>
							<?php foreach ($getSelesai as $selesai) {?>
								<div class="col-lg-5 col-md-5 shadow my-3 mx-auto d-block">
									<div class="">
										<div class="row">
											<div class="my-3 mx-3">
												<a href="#">
													Tanggal : <?= $selesai['tanggal_transaksi']; ?>
												</a>
											</div>
										</div>
										<div class="row">
											<div class="mx-3">
												<p>No. Transaksi : <span class="text-danger font-weight-bold"><?= $selesai['id_transaksi']; ?></span></p>
											</div>
										</div>
										<div class="my-4">
											<table>
												<tr>
													<td><img style="width:20%;border: 1px solid #ddd;border-radius: 5px;padding: 5px;width: 90px;height: 90px;"  src="<?php echo base_url('assets/images/upload/'.$selesai['gambar1']) ?>"></td>
													<td>
														<h5 class="mx-3"><?= $selesai['nama_barang']; ?></h5>                    
														<p class="mx-3"><span class="text-danger">Rp. <?= number_format($selesai['harga'], 0, ',', '.'); ?></span> <?= $selesai['jumlah_barang']; ?> Produk</p>
														<p class="mx-3">Total Harga Produk</p>
														<p class="font-weight-bold mx-3">Rp. <?= number_format($selesai['harga']*$selesai['jumlah_barang'], 0, ',', '.'); ?></p>
													</td>
												</tr>
											</table>
										</div>
										<div class="my-3 text-center">
											<?php if ($getRating['id_member'] AND $getRating['id_barang'] AND ['rating'] == 0) { ?>
												<a href="#" class="btn btn-danger my-3" data-toggle="modal" data-target="#beriRating" onclick="selectId('<?= $selesai['id_barang'] ?>')">
													Anda Belum Memberikan Rating
												</a>
											<?php }else{ ?>											
												<a href="#" class="btn btn-success my-3">
													Anda Telah Memberikan Rating
												</a>
											<?php } ?>
										</div>
									</div>

								</div>
							<?php } ?>
						<?php }else{ ?>
							<div class="col-lg-12 my-4">
								<img class="mx-auto d-block" style="max-width: 25%;max-height: 25%;" src="<?= base_url('assets/frontend/img/warning.png'); ?>">
								<h5 class="text-center">Belum ada pesanan</h5>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="tab-pane fade text-body" id="pesanan-dibatalkan" role="tabpanel" aria-labelledby="pesanan-dibatalkan-tab">
					<?php if (!empty($getPesanan_dibatalkan)) { ?>
						<?php foreach ($getPesanan_dibatalkan as $row) {?>
							<div class="my-4">
								<div class="card shadow">
									<div class="card-header">
										<p><?= $row['tanggal_transaksi']; ?></p>
									</div>
									<div class="card-body p-4">
										<div class="row">
											<div class="col-sm">
												<h5>No. Transaksi</h5>
												<p><?= $row['id_transaksi']; ?></p>
											</div>
											<div class="col-sm">
												<h5>Status Pesanan</h5>
												<p><?= $row['status_transaksi']; ?></p>
											</div>
											<div class="col-sm">
												<h5>Total Bayar</h5>
												<p class="text-danger font-weight-bold">Rp. <?= number_format($row['total_bayar'], 0, ',', '.'); ?></p>
											</div>
										</div>
										<div class="row">
											<div class="col-sm">
												<table>
													<tr>
														<td><img style="width:20%;border: 1px solid #ddd;border-radius: 5px;padding: 5px;width: 90px;height: 90px;"  src="<?php echo base_url('assets/images/upload/'.$row['gambar1']) ?>"></td>
														<td>
															<h5 class="mx-3"><?= $row['nama_barang']; ?></h5>                    
															<p class="mx-3"><span class="text-danger">Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></span> <?= $row['jumlah_barang']; ?> Produk</p>
														</td>
													</tr>
												</table>
											</div>
											<div class="col-sm">
												<h5>Total Harga Produk</h5>
												<p class="font-weight-bold">Rp. <?= number_format($row['harga']*$row['jumlah_barang'], 0, ',', '.'); ?></p>
											</div>
											<div class="col-sm">
												<h5> </h5>
												<p class="text-danger"> </p>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					<?php }else{ ?>
						<div class="col-lg-12 my-4">
							<img class="mx-auto d-block" style="max-width: 25%;max-height: 25%;" src="<?= base_url('assets/frontend/img/warning.png'); ?>">
							<h5 class="text-center">Belum ada pesanan</h5>
						</div>
					<?php } ?>
				</div>
			</div>
		</div> 
	</div>
</section>

<!-- Modal Tambah-->
<div class="modal fade bd-example-modal-lg" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby=#modalTambah" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Upload Bukti Pembayaran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refresh()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="bg-secondary">
					<p class="text-white text-center"><span class="fa fa-info-circle"></span> Unggah bukti pembayaran dapat mempercepat verifikasi pembayaran.</p>
				</div>
				<p>Pastikan bukti pembayaran menampilkan :</p>
				<div class="row mx-2 mb-4">
					<div class="col">
						<ul style="list-style: circle;">
							<li>
								<span class="font-weight-bold">Tanggal/Waktu Transfer</span><br>
								<span>contoh : tgl.03/02/20 / jam 08:07:09</span>
							</li>
							<li>
								<span class="font-weight-bold">Status Berhasil</span><br>
								<span>contoh : Transfer BERHASIL, Transaksi Sukses</span>
							</li>
						</ul>
					</div>
					<div class="col">
						<ul style="list-style: circle;">
							<li>
								<span class="font-weight-bold">Detail Penerima</span><br>
								<span>contoh : Transfer ke Rekening Lassak.co</span>
							</li>
							<li>
								<span class="font-weight-bold">Jumlah Transfer</span><br>
								<span>contoh : Rp. 123.456,00</span>
							</li>
						</ul>
					</div>
				</div>
				<form class="forms-sample" id="addForm" method="POST" enctype="multipart/form-data" action="<?= base_url('Frontend/Shop/update_transaksi');  ?>">

					<div class="file-field">
						<div class="mb-4">
							<img class="mx-auto d-block rounded img-fluid" width="200" src="<?= base_url('assets/images/upload/default.png') ?>" alt="example placeholder avatar">
						</div>
						<div class="d-flex justify-content-center">
							<div class="btn btn-mdb-color btn-rounded float-left">
								<span>Pilih Gambar</span>
								<input type="file" id="cover" name="upload_pembayaran" onchange="loadFile(event)" /><br>
							</div>
						</div>
					</div>
					<input type="hidden" name="id_transaksi" id="id_transaksi">
					<div class="modal-footer">
						<button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="refresh()">Batal</button>
						<button type="submit" class="btn btn-outline-success btn-sm" >Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Modal Tambah -->

<div class="modal fade" id="modalKedaluwarsa" tabindex="-1" role="dialog" aria-labelledby=#modalKedaluwarsa" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Batas Pembayaran Habis !</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="modal-body">
					<h4 class="text-center">Maaf Batas Pembayaran Anda Sudah Habis.</h4>
					<div class="text-center my-3">
						<button type="button" class="btn btn-success" data-dismiss="modal">Oke</button>
					</div>  
				</div>
			</div>
		</div>
	</div>
</div>


<?php foreach ($menunggu_pembayaran as $row) { ?>
	<div class="modal fade" id="modalBatal<?= $row['id_transaksi'];?>" tabindex="-1" role="dialog" aria-labelledby=#modalTambah" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin ?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="modal-body">
						<p>Ingin Membatalkan Pesanan.</p>  
					</div>
					<div class="modal-footer"> 
						<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
						<a href="<?= base_url('Frontend/Shop/updateBatalStatus/'.$row['id_transaksi'])?>" class="btn btn-danger">Yakin</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<?php foreach ($getSedang_dikirim as $sdgkirim) { ?>
	<div class="modal fade" id="konfirmasiPesanan<?= $sdgkirim['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby=#modalTambah" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin ?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refresh()">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<p>Yakinkan bahwa pesanan anda telah sampai dengan baik.</p>			
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-success" data-dismiss="modal">Batal</button>
						<a href="<?= base_url('Frontend/Shop/updateSampai/'.$sdgkirim['id_transaksi'])?>" class="btn btn-success">Yakin</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<div class="modal fade" id="beriRating" tabindex="-1" role="dialog" aria-labelledby=#modalTambah" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Berikan Nilai</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="forms-sample" method="POST" action="<?= base_url('Frontend/Shop/beriRating'); ?>">
					<input type="hidden" name="id_barang" id="id_barang">
					<ul class="rate-area">
						<input type="radio" id="5-star" name="rating" value="5" /><label for="5-star" title="Amazing">5 stars</label>
						<input type="radio" id="4-star" name="rating" value="4" /><label for="4-star" title="Good">4 stars</label>
						<input type="radio" id="3-star" name="rating" value="3" /><label for="3-star" title="Average">3 stars</label>
						<input type="radio" id="2-star" name="rating" value="2" /><label for="2-star" title="Not Good">2 stars</label>
						<input type="radio" id="1-star" name="rating" value="1" /><label for="1-star" title="Bad">1 star</label>
					</ul>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary" >Yakin</button>
				</div>

			</form>		
		</div>
	</div>
</div>

<!-- Modal Detail-->
<div class="modal fade bd-example-modal-lg" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Detail</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php foreach ($getDetail as $key) { ?>
					<table>
						<tr>
							<td><img style="width:20%;border: 1px solid #ddd;border-radius: 5px;padding: 5px;width: 90px;height: 90px;"  src="<?php echo base_url('assets/images/upload/'.$key['gambar1']) ?>"></td>
							<td>
								<h5 class="mx-3"><?= $key['nama_barang']; ?></h5>                    
								<p class="mx-3"><span class="text-danger">Rp. <?= number_format($key['harga'], 0, ',', '.'); ?></span> <?= $key['jumlah_barang']; ?> Produk</p>
							</td>
							<input type="hidden" name="id_transaksi" id="id_transaksi">
						</tr>
					</table>
				<?php } ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Tutup</button>

			</div>
		</div>
	</div>
</div>
<!-- Modal Detail -->
<!-- ================ contact section end ================= -->

<!--================ start footer Area  =================-->
<?php $this->load->view('_layout_frontend/footer.php'); ?>
<!--================ End footer Area  =================-->

<!-- Optional JavaScript -->
<script src="<?= base_url('assets/MDB/js/addons/rating.min.js');?>"></script>
<script>
	$(document).ready(function() {
		$('#rateMe3').mdbRate();
	});
</script>
<script type="text/javascript">
	function select($id_transaksi) {
		$("#id_transaksi").val($id_transaksi);
	}
</script>

<script type="text/javascript">
	function data($id_transaksi, $nama_barang, $gambar1, $harga, $jumlah_barang) {
		$("#id_transaksi").val($id_transaksi);
		$("#nama_barang").val($nama_barang);
		$("#harga").val($harga);
		$("#jumlah_barang").val($jumlah_barang);
		var link = "<?= base_url()?>assets/images/upload/";
		document.getElementById("foto_cover").src = link+$gambar1;
	}
</script>

<script>
	function selectId($id_barang){
		$("#id_barang").val($id_barang);
	}
</script>

<script type="text/javascript">
	function select($id_transaksi, $upload_pembayaran){
		$("#id_transaksi").val($id_transaksi);
		var link = "<?= base_url()?>assets/images/upload/bukti_pembayaran/";
		document.getElementById("foto_cover").src = link+$upload_pembayaran;
	}

	function refresh(){
		$("#id_transaksi").val('');
		document.getElementById("foto_cover").src = '<?= base_url('assets/images/upload/bukti_pembayaran/default.png'); ?>';
	}
</script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<?php $this->load->view('_layout_frontend/js.php'); ?>
<?php $this->load->view('_layout_frontend/alert.php'); ?>
</body>
</html>