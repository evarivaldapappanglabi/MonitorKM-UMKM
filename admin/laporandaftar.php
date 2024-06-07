<?php include 'header.php'; ?>
<?php
if (isset($_GET['idnotif']) && !empty($_GET['idnotif'])) {
    $idnotif = $_GET['idnotif'];
    $ambilsebelum = $koneksi->query("SELECT * FROM notiflaporan WHERE idnotif = '$idnotif'") or die(mysqli_error($koneksi));
    $cek = $ambilsebelum->fetch_assoc();
    if ($cek['baca'] == "") {
        $koneksi->query("UPDATE notiflaporan SET baca='Sudah' WHERE idnotif='$idnotif'") or die(mysqli_error($koneksi));
        echo "<script> location ='laporandaftar.php';</script>";
    }
}
?>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Laporan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Lengkap</th>
                                <th>No Telp</th>
                                <th>Nama Usaha</th>
                                <th>Email</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Keterangan</th>

                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $saldo = 0;
                            $nomor = 1;
                            $ambil = $koneksi->query("SELECT * FROM laporan order by idlaporan asc");
                            while ($data = $ambil->fetch_assoc()) {

                            ?>
                                <tr>
                                    <td><?= $nomor ?></td>
                                    <td><?php echo tanggal($data["tanggal"]) ?></td>
                                    <td><?php echo $data["namalengkap"] ?></td>
                                    <td><?php echo $data["notelp"] ?></td>
                                    <td><?php echo $data["namausaha"] ?></td>
                                    <td><?php echo $data["email"] ?></td>
                                    <td><a href="../file/<?= $data['file'] ?>" class="btn btn-success" target="_blank">Download Laporan</a></td>
                                    <td><?php echo $data["status"] ?></td>
                                    <td><?php echo $data["keterangan"] ?></td>
                                    <td>
                                        <a href="laporandetail.php?id=<?php echo $data['idlaporan']; ?>" class="btn btn-warning btn-sm m-1">Detail</a>
                                        <a href="laporanhapus.php?id=<?php echo $data['idlaporan']; ?>" class="btn btn-danger btn-sm m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
                                    </td>

                                </tr>
                                <?php $nomor++; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>