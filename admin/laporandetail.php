<?php include 'header.php'; ?>
<?php
$ambil = $koneksi->query("SELECT * FROM laporan 
	WHERE laporan.idlaporan='$_GET[id]'");
$detail = $ambil->fetch_assoc();

$ambilidentitas = $koneksi->query("SELECT * FROM laporanidentitas 
	WHERE idlaporan='$_GET[id]'");
$dataidentitas = $ambilidentitas->fetch_assoc();

$ambilpemanfaatan = $koneksi->query("SELECT * FROM laporanpemanfaatan 
	WHERE idlaporan='$_GET[id]'");
$datapemanfaatan = $ambilpemanfaatan->fetch_assoc();

$ambilbantuan = $koneksi->query("SELECT * FROM laporanbantuan 
	WHERE idlaporan='$_GET[id]'");

$ambilperkembangan = $koneksi->query("SELECT * FROM laporanperkembangan 
	WHERE idlaporan='$_GET[id]'");
$dataperkembangan = $ambilperkembangan->fetch_assoc();

$ambilpemasaran = $koneksi->query("SELECT * FROM laporanpemasaran 
	WHERE idlaporan='$_GET[id]'");
$datapemasaran = $ambilpemasaran->fetch_assoc();

?>
<style>



    h2 {
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Laporan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table">
                            <tr>
                                <td>Nama</td>
                                <td>: <?php echo $detail['namalengkap']; ?></td>
                            </tr>
                            <tr>
                                <td>Telepon</td>
                                <td>: <?php echo $detail['notelp']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>: <?php echo $detail['email']; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Usaha </td>
                                <td>: <?php echo $detail['namausaha']; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>: <?php echo tanggal($detail['tanggal']); ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>: <?php echo $detail['status']; ?></td>
                            </tr>
                            <tr>
                                <td>File Laporan</td>
                                <td>: <a href="../file/<?= $detail['file'] ?>" class="btn btn-success" target="_blank">Download</a></td>
                            </tr>
                        </table>

                        <h4>I. Identitas Wirausaha Pemula</h4>
                        <table class="table">
                            <tr>
                                <th>Nama (Sesuai KTP)</th>
                                <td><?= $dataidentitas['namalengkap'] ?></td>
                            </tr>
                            <tr>
                                <th>Nomor KTP/NIK</th>
                                <td><?= $dataidentitas['nik'] ?></td>
                            </tr>
                            <tr>
                                <th>Alamat Usaha</th>
                                <td><?= $dataidentitas['alamatusaha'] ?></td>
                            </tr>
                            <tr>
                                <th>No.TLP</th>
                                <td><?= $dataidentitas['notelp'] ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?= $dataidentitas['email']  ?></td>
                            </tr>
                            <tr>
                                <th>Nama Usaha</th>
                                <td><?= $dataidentitas['namausaha']  ?></td>
                            </tr>
                            <tr>
                                <th>Bidang Usaha</th>
                                <td><?= $dataidentitas['bidangusaha']  ?></td>
                            </tr>
                            <tr>
                                <th>Jenis Produksi</th>
                                <td><?= $dataidentitas['jenisproduksi']  ?></td>
                            </tr>
                            <tr>
                                <th>Lama Usaha</th>
                                <td><?= $dataidentitas['lamausaha'] ?></td>
                            </tr>
                        </table>

                        <h4>II. Pemanfaatan Dana Awal</h4>
                        <table class="table">
                            <tr>
                                <th>Nilai Bantuan Yang Diterima</th>
                                <td><?= $datapemanfaatan['nilaibantuan'] ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Pencairan Dana</th>
                                <td><?= $datapemanfaatan['tanggalpencairan'] ?></td>
                            </tr>
                            <tr>
                                <th>Nomor Rekening</th>
                                <td><?= $datapemanfaatan['nomorrekening'] ?></td>
                            </tr>
                            <tr>
                                <th>Nama Bank</th>
                                <td><?= $datapemanfaatan['namabank'] ?></td>
                            </tr>
                            <tr>
                                <th>Modal Kerja</th>
                                <td><?= $datapemanfaatan['modalkerja'] ?></td>
                            </tr>
                            <tr>
                                <th>Modal Investasi/Peralatan</th>
                                <td><?= $datapemanfaatan['modalinvestasi'] ?></td>
                            </tr>
                            <tr>
                                <th>Penggunaan Dana</th>
                                <td><?= $datapemanfaatan['penggunaandana'] ?></td>
                            </tr>
                        </table>

                        <h4>III. Penggunaan Bantuan Dana Yang Diterima</h4>
                        <table class="table">
                            <tr>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Pengeluaran</th>
                                <th>Keterangan</th>
                            </tr>
                            <?php
                            while ($databantuan = $ambilbantuan->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= $databantuan['tanggalpenggunaan'] ?></td>
                                    <td><?= $databantuan['kategori'] ?></td>
                                    <td><?= $databantuan['pengeluaran'] ?></td>
                                    <td><?= $databantuan['keterangan'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>

                        <h4>IV. Perkembangan Usaha</h4>
                        <table class="table">
                            <tr>
                                <th>Uraian</th>
                                <th>Satuan</th>
                                <th>Sebelum</th>
                                <th>Sesudah</th>
                            </tr>
                            <tr>
                                <td>Jumlah Karyawan</td>
                                <td>Orang</td>
                                <td><?= $dataperkembangan['jumlahkaryawansebelum'] ?></td>
                                <td><?= $dataperkembangan['jumlahkaryawansesudah'] ?></td>
                            </tr>
                            <tr>
                                <td>Omset Usaha per Bulan</td>
                                <td>Rupiah</td>
                                <td><?= $dataperkembangan['omsetsebelum'] ?></td>
                                <td><?= $dataperkembangan['omsetsesudah'] ?></td>
                            </tr>
                            <tr>
                                <td>Keuntungan per Bulan</td>
                                <td>Rupiah</td>
                                <td><?= $dataperkembangan['keuntungansebelum'] ?></td>
                                <td><?= $dataperkembangan['keuntungansesudah'] ?></td>
                            </tr>
                        </table>

                        <h4>V. Cara Pemasaran Produk</h4>
                        <p><?= $datapemasaran['carapemasaran'] ?></p>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Konfirmasi</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="Belum Dikonfirmasi" <?= $detail['status'] == 'Belum Dikonfirmasi' ? 'selected' : '' ?>>Belum Dikonfirmasi</option>
                                    <option value="Diterima" <?= $detail['status'] == 'Di Terima' ? 'selected' : '' ?>>Di Terima</option>
                                    <option value="Diproses" <?= $detail['status'] == 'Di Proses' ? 'selected' : '' ?>>Di Proses</option>
                                    <option value="Diverifikasi" <?= $detail['status'] == 'Di Verifikasi' ? 'selected' : '' ?>>Di Verifikasi</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control" name="keterangan" rows="5"><?= $detail['keterangan'] ?></textarea>
                            </div>
                            <button class=" btn btn-primary float-right pull-right" name="proses">Simpan</button>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<?php
if (isset($_POST["proses"])) {
    $id = $_GET['id'];
    $status = $_POST["status"];
    $keterangan = $_POST["keterangan"];
    $koneksi->query("UPDATE laporan SET status='$status',keterangan='$keterangan'
		WHERE idlaporan='$id'");
    echo "<script>alert('Status Laporan Berhasil Diupdate')</script>";
    echo "<script>location='laporandaftar.php';</script>";
} ?>

<?php include 'footer.php'; ?>