<?php include 'header.php'; ?>

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Tambah Transaksi</h6>
			</div>
			<div class="card-body">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Tanggal</label>
						<input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>" required>
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<textarea rows="3" class="form-control" name="keterangan" required></textarea>
					</div>
					<div class="form-group">
						<label>Jenis</label>
						<select class="form-control" name="jenis" required>
							<option value="Pendapatan">Pendapatan</option>
							<option value="Pengeluaran">Pengeluaran</option>
						</select>
					</div>
					<div class="form-group">
						<label>Jumlah</label>
						<input type="number" class="form-control" name="jumlah" required>
					</div>
					<button type="submit" class="btn btn-primary" name="save"><i class="glyphicon glyphicon-saved"></i>Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
if (isset($_POST['save'])) {
	$id = $_SESSION['pengguna']['id'];
	$tanggal = $_POST['tanggal'];
	$keterangan = $_POST['keterangan'];
	$jenis = $_POST['jenis'];
	$jumlah = $_POST['jumlah'];
	if ($jenis == 'Pendapatan') {
		$pendapatan = $jumlah;
		$pengeluaran = 0;
	} else {
		$pendapatan = 0;
		$pengeluaran = $jumlah;
	}
	$koneksi->query("INSERT INTO transaksi (tanggal, keterangan, jenis, pendapatan, pengeluaran,id)
        VALUES('$tanggal','$keterangan','$jenis','$pendapatan','$pengeluaran','$id')");

	$id_kas_barusan = $koneksi->insert_id;
	echo "<script>alert('Data Berhasil Disimpan');</script>";
	echo "<script>location ='transaksidaftar.php';</script>";
}
?>

<?php include 'footer.php'; ?>