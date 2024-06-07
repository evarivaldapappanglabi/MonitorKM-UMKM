<?php include 'header.php'; ?>
<?php
$id = $_SESSION['pengguna']['id'];
?>
<?php
// Inisialisasi tanggal awal dan tanggal akhir default
$tanggal_awal = date('Y-m-01');
$tanggal_akhir = date('Y-m-t');
// Periksa apakah ada pengiriman form untuk filter tanggal
if (isset($_POST['filter'])) {
	// Ambil tanggal awal dan tanggal akhir dari formulir
	$tanggal_awal = $_POST['tanggal_awal'];
	$tanggal_akhir = $_POST['tanggal_akhir'];
}
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<a href="transaksitambah.php" class="btn btn-sm btn-primary shadow-sm float-right pull-right">
		<i class="fas fa-plus fa-sm text-white-50"></i> Tambah Transaksi
	</a>
</div>



<!-- Formulir filter tanggal -->
<form method="post" class="mb-3">
	<div class="form-row">
		<div class="form-group col-md-3">
			<label for="tanggal_awal">Tanggal Awal</label>
			<input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" value="<?= $tanggal_awal ?>">
		</div>
		<div class="form-group col-md-3">
			<label for="tanggal_akhir">Tanggal Akhir</label>
			<input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="<?= $tanggal_akhir ?>">
		</div>
		<div class="form-group col-md-3">
			<button type="submit" class="btn btn-primary mt-4" name="filter">Filter</button>
		</div>
	</div>
</form>
<div class="row">
	<div class="col-md-12 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="table">
						<thead class="bg-primary text-white">
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Keterangan</th>
								<th>Pendapatan</th>
								<th>Pengeluaran</th>
								<th>Sisa Saldo</th>
								<th>Aksi</th>

							</tr>
						</thead>
						<tbody>
							<?php
							$saldo = 0;
							$totalPendapatan = 0;
							$totalPengeluaran = 0;
							$nomor = 1;
							$ambil = $koneksi->query("SELECT * FROM transaksi WHERE id = '$id' AND tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY idtransaksi ASC");
							while ($data = $ambil->fetch_assoc()) {
								$saldo += $data['pendapatan'];
								$saldo -= $data['pengeluaran'];
								$totalPendapatan += $data['pendapatan'];
								$totalPengeluaran += $data['pengeluaran'];
							?>
								<tr>
									<td><?= $nomor ?></td>
									<td><?php echo tanggal($data["tanggal"]) ?></td>
									<td><?php echo $data["keterangan"] ?></td>
									<td><?php echo rupiah($data["pendapatan"]) ?></td>
									<td><?php echo rupiah($data["pengeluaran"]) ?></td>
									<td><?php echo rupiah($saldo) ?></td>
									<td>
										<a href="transaksiedit.php?id=<?php echo $data['idtransaksi']; ?>" class="btn btn-warning btn-sm">Ubah</a>
										<a href="transaksihapus.php?id=<?php echo $data['idtransaksi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
									</td>

								</tr>
								<?php $nomor++; ?>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="text-right mt-3">
					<strong>Total Pendapatan: <?= rupiah($totalPendapatan) ?></strong><br>
					<strong>Total Pengeluaran: <?= rupiah($totalPengeluaran) ?></strong><br>
					<strong>Sisa Saldo: <?= rupiah($saldo) ?></strong>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>