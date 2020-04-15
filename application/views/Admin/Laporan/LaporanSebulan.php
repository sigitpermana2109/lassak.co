
<!-- Main Content -->

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?> &mdash; Lassak.co</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">
	<style type="text/css">
	.line-title{
		border: 0;
		border-style: inset;
		border-top: 2px solid #000;

	</style>
</head>
<body>
	<div class="col-12 mx-auto d-block">
		
		<table class="table mt-4">
			<tr>
				<td>
					<div class="my-auto d-flex">
						<img class="align-left" style="width: 200px;height: 80px;" src="assets/images/logo-name.png">

						<span class="text-center mx-auto d-block" style="line-height: 1.6; font-weight: bold;">
							<h3><b>Lassak.co</b></h3>

							<p>Jl. Rancamalang, Margaasih | Telp. 0895395288400 | Kab. Bandung 40215
								<br>http://lassak.co.id | email: lassak.co@gmail.com</p>
							</span>
						</div>
					</td>
				</tr>
			</table>
			<hr class="line-title">
			<div class="card-body p-2">
				<div class="table-responsive">
					<table class="table table-bordered" id="sortable-table">
						<thead class="text-center">
							<tr>
								<th>No</th>
								<th>Nama Barang</th>
								<th>Jumlah Barang Terjual</th>
								<th>Sub Total</th>
								
							</tr>
						</thead>
						<tbody class="text-center">
							<?php 
							$no = $this->uri->segment(4)+1;
							foreach ($barang as $row) {
								?>
								<tr>
									<td><?= $no++; ?></td>
									<td class="text-uppercase"><?= $row['nama_barang']; ?></td>
									<td><?= $row['jumlah_barang']; ?></td>
									<td>Rp. <?= number_format($row['jumlah_barang']*$row['harga'], 0, ',', '.'); ?> </td>
								</tr>
							<?php } ?>
							<tr>
								<td class="text-right font-weight-bold" colspan="3">Total Penghasilan : </td>
								<td class="font-weight-bold">Rp. <?= number_format($total['total_penghasilan'], 0, ',', '.'); ?></td>
							</tr>
							<tr>
								<td colspan="5"><p class="text-danger font-weight-bold font-italic text-right">** Penghasilan tersebut tidak termasuk biaya ongkos kirim.</p></td>
							</tr>
						</tbody>
					</table>

				</div>

			</div>
		</div>
		
	</body>
	</html>





