<?php
session_start();
include 'koneksi.php';

function rupiah($angka)
{
  $hasilrupiah = "Rp " . number_format($angka, 2, ',', '.');
  return $hasilrupiah;
}
function tanggal($tgl)
{
  $tanggal = substr($tgl, 8, 2);
  $bulan = getBulan(substr($tgl, 5, 2));
  $tahun = substr($tgl, 0, 4);
  return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function getBulan($bln)
{
  switch ($bln) {
    case 1:
      return "Januari";
      break;
    case 2:
      return "Februari";
      break;
    case 3:
      return "Maret";
      break;
    case 4:
      return "April";
      break;
    case 5:
      return "Mei";
      break;
    case 6:
      return "Juni";
      break;
    case 7:
      return "Juli";
      break;
    case 8:
      return "Agustus";
      break;
    case 9:
      return "September";
      break;
    case 10:
      return "Oktober";
      break;
    case 11:
      return "November";
      break;
    case 12:
      return "Desember";
      break;
  }
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Monitor KM</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="manifest" href="site.webmanifest">
  <link rel="shortcut icon" type="image/x-icon" href="assets_home/logo.jpeg">

  <link rel="stylesheet" href="assets_home/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets_home/assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets_home/assets/css/slicknav.css">
  <link rel="stylesheet" href="assets_home/assets/css/flaticon.css">
  <link rel="stylesheet" href="assets_home/assets/css/animate.min.css">
  <link rel="stylesheet" href="assets_home/assets/css/magnific-popup.css">
  <link rel="stylesheet" href="assets_home/assets/css/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets_home/assets/css/themify-icons.css">
  <link rel="stylesheet" href="assets_home/assets/css/slick.css">
  <link rel="stylesheet" href="assets_home/assets/css/nice-select.css">
  <link rel="stylesheet" href="assets_home/assets/css/style.css">
  <link rel="stylesheet" href="admin/assets/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

</head>

<body>
  <header>
    <!-- Header Start -->
    <div class="header-area header-transparent">
      <div class="main-header  header-sticky">
        <div class="container-fluid">
          <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-xl-2 col-lg-2 col-md-1">
             <h3>Monitor KM</h3>
            </div>
            <div class="col-xl-10 col-lg-10 col-md-10">
              <div class="menu-main d-flex align-items-center justify-content-end">
                <!-- Main-menu -->
                <div class="main-menu f-right d-none d-lg-block">
                  <nav>
                    <ul id="navigation">
                      <li><a href="index.php">Home</a></li>
                      <li><a href="contact.php">Contact</a></li>
                    
                      <?php
                      include 'koneksi.php';
                      if (isset($_SESSION["masyarakat"])) { ?>
                        <li><a href="#">Akun</a>
                          <ul class="submenu">
                            <li><a href="akun.php">Akun</a></li>
                            <li><a href="riwayatpendaftaran.php">Riwayat Pendaftaran</a></li>
                            <li><a href="logout.php">Logout</a></li>
                          </ul>
                        </li>
                      <?php } else {  ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="daftar.php">Daftar</a></li>
                      <?php } ?>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
            <!-- Mobile Menu -->
            <div class="col-12">
              <div class="mobile_menu d-block d-lg-none"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Header End -->
  </header>