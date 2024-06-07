<?php include 'header.php'; ?>

<?php
$ambil = $koneksi->query("SELECT * FROM transaksi WHERE idtransaksi='$_GET[id]'");
$row = $ambil->fetch_assoc();
?>

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Edit Transaksi</h6>
			</div>
			<div class="card-body">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Tanggal</label>
						<input type="date" class="form-control" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<textarea rows="3" class="form-control" name="keterangan" required><?php echo $row['keterangan']; ?></textarea>
					</div>
					<div class="form-group">
						<label>Jenis</label>
						<select class="form-control" name="jenis" required>
							<option <?php if ($row['jenis'] == 'Pendapatan') echo 'selected'; ?> value="Pendapatan">Pendapatan</option>
							<option <?php if ($row['jenis'] == 'Pengeluaran') echo 'selected'; ?> value="Pengeluaran">Pengeluaran</option>
						</select>
					</div>
					<div class="form-group">
						<label>Jumlah</label>
						<?php
						if ($row['jenis'] == 'Pendapatan') {
							$jumlah = $row['pendapatan'];
						} else {
							$jumlah = $row['pengeluaran'];
						}
						?>
						<input type="number" class="form-control" name="jumlah" value="<?php echo $jumlah; ?>" required>
					</div>
					<button class="btn btn-primary" name="ubah"><i class="glyphicon glyphicon-saved"></i>Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
if (isset($_POST['ubah'])) {
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
	$koneksi->query("UPDATE transaksi SET tanggal='$tanggal', keterangan='$keterangan', jenis='$jenis', pendapatan='$pendapatan', pengeluaran='$pengeluaran' WHERE idtransaksi='$_GET[id]'");
	echo "<script>alert('Data transaksi Berhasil Diubah');</script>";
	echo "<script>location='transaksidaftar.php';</script>";
}
?>

<?php include 'footer.php'; ?>