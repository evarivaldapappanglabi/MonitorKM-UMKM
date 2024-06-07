
<?php
include '../koneksi.php';

$koneksi->query("DELETE FROM laporan WHERE idlaporan='$_GET[id]'");

echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script>location='laporandaftar.php';</script>";

?>