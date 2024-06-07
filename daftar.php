<?php include 'header.php'; ?>
<main>
	<div class="hero-area2  slider-height2 hero-overly2 d-flex align-items-center ">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="hero-cap text-center pt-50">
						<h2>Daftar</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="contact-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<form class="form-contact contact_form" method="post">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Nama</label>
									<input type="text" name="nama" class="form-control" required>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" class="form-control" required>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Email</label>
									<input type="email" name="email" class="form-control" required>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password" class="form-control" required>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label>NIK</label>
									<input type="number" name="nik" class="form-control" required>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label>Alamat Usaha</label>
									<textarea class="form-control " name="alamat" required></textarea>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label>NPWP Usaha</label>
									<input type="text" name="npwpusaha" class="form-control">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label>Nama Usaha</label>
									<input type="text" name="namausaha" class="form-control">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label>Telepon</label>
									<input type="number" name="telepon" class="form-control">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label>Bidang Usaha</label>
									<input type="text" class="form-control" name="bidangusaha" required>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label>Jenis Produksi</label>
									<input type="text" class="form-control" name="jenisproduksi" required>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label>Lama Usaha</label>
									<input type="text" class="form-control" name="lamausaha" required>
								</div>	
							</div>

						</div>
						<div class="form-group mt-3">
							<button type="submit" name="daftar" class="button button-contactForm boxed-btn btn-block">Simpan</button>
						</div>
					</form>
				</div>
				<div class="col-lg-3 offset-lg-1">
					<img width="100%" style="height:500px;object-fit:cover" src="foto/daftar.png">
				</div>
			</div>
		</div>
	</section>
</main>
<?php
if (isset($_POST["daftar"])) {
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$nik = $_POST['nik'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$alamat = $_POST['alamat'];
	$telepon = $_POST['telepon'];
	$alamatusaha = $_POST['alamatusaha'];
	$npwpusaha = $_POST['npwpusaha'];
	$namausaha = $_POST['namausaha'];
	$bidangusaha = $_POST['bidangusaha'];
	$jenisproduksi = $_POST['jenisproduksi'];
	$lamausaha = $_POST['lamausaha'];
	$level = 'User';
	$ambil = $koneksi->query("SELECT*FROM pengguna 
							WHERE username='$username'");
	$yangcocok = $ambil->num_rows;
	if ($yangcocok == 1) {
		echo "<script>alert('Pendaftaran Gagal, Username sudah terdaftar')</script>";
		echo "<script>location='daftar.php';</script>";
	} else {
		$koneksi->query("INSERT INTO pengguna (nama, username, nik,email, password, alamatusaha, telepon,namausaha,npwpusaha, bidangusaha, jenisproduksi, lamausaha, level)
								VALUES('$nama','$username','$nik','$email','$password','$alamat','$telepon','$namausaha','$npwpusaha','$bidangusaha', '$jenisproduksi','$lamausaha', '$level')");
		echo "<script>alert('Pendaftaran Berhasil')</script>";
		echo "<script>location='login.php';</script>";
	}
}
?>
<?php
include 'footer.php';
?>