<?php include 'header.php'; ?>
<main>
	<div class="hero-area2  slider-height2 hero-overly2 d-flex align-items-center ">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="hero-cap text-center pt-50">
						<h2>Login</h2>
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
									<label>Username</label>
									<input type="text" name="username" class="form-control" placeholder="Username">
								</div>
							</div>
							<div class="col-sm-12">
								<label>Password</label>
								<div class="input-group">
									<input class="form-control password" id="password" class="block mt-1 w-full" type="password" placeholder="Kata Sandi" name="password" value="" autocomplete="off" required />
									<span class="input-group-text togglePassword">
										<i data-feather="eye" class="fa fa-eye" style="cursor: pointer;padding-top:5px"></i>
									</span>
								</div>
							</div>

						</div>
						<div class="form-group mt-3">
							<button type="submit" name="simpan" class="button button-contactForm boxed-btn btn-block">Masuk</button>
						</div>
					</form>
				</div>
				<div class="col-lg-3 offset-lg-1">
					<img width="100%" src="foto/daftar.png">
				</div>
			</div>
		</div>
	</section>
</main>
<?php
if (isset($_POST["simpan"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	$ambil = $koneksi->query("SELECT * FROM pengguna
		WHERE username='$username' AND password='$password' limit 1");
	$akunyangcocok = $ambil->num_rows;
	if ($akunyangcocok == 1) {
		$akun = $ambil->fetch_assoc();
		if ($akun['level'] == "Admin") {
			$_SESSION["admin"] = $akun;
			echo "<script>alert('Anda sukses login');</script>";
			echo "<script>location ='admin/index.php';</script>";
		} elseif ($akun['level'] == "User") {
			$_SESSION['pengguna'] = $akun;
			echo "<script>alert('Anda sukses login');</script>";
			echo "<script>location ='user/index.php';</script>";
		}
	} else {
		echo "<script> alert('username atau password anda salah');</script>";
		echo "<script> location ='login.php';</script>";
	}
}
?>

<?php
include 'footer.php';
?>