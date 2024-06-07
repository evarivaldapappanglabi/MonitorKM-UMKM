
<?php
include '../koneksi.php';

$koneksi->query("DELETE FROM transaksi WHERE idtransaksi='$_GET[id]'");

echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script>location='transaksidaftar.php';</script>";

?>