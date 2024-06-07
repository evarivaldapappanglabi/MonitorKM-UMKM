<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap nilai dari setiap input pada formulir
    $daritanggal = $_POST['daritanggal'];
    $sampaitanggal = $_POST['sampaitanggal'];
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $alamat_usaha = $_POST['alamatusaha'];
    $no_telp = $_POST['notelp'];
    $email = $_POST['email'];
    $nama_usaha = $_POST['namausaha'];
    $bidang_usaha = $_POST['bidangusaha'];
    $jenis_produksi = $_POST['jenisproduksi'];
    $lama_usaha = $_POST['lamausaha'];
    $nilai_bantuan = $_POST['nilaibantuan'];
    $tanggal_pencairan_dana = $_POST['tanggalpencairandana'];
    $nomor_rekening = $_POST['nomorrekening'];
    $nama_bank = $_POST['namabank'];
    $modal_kerja = $_POST['modalkerja'];
    $modal_investasi = $_POST['modalinvestasi'];
    $penggunaan_dana = $_POST['penggunaandana'];
    $tanggalpenggunaan = $_POST['tanggalpenggunaan'];
    $kategori = $_POST['kategori'];
    $pengeluaran = $_POST['pengeluaran'];
    $keterangan = $_POST['keterangan'];
    $jumlah_karyawan_sebelum = $_POST['jumlahkaryawansebelum'];
    $jumlah_karyawan_sesudah = $_POST['jumlahkaryawansesudah'];
    $omset_sebelum = $_POST['omsetsebelum'];
    $omset_sesudah = $_POST['omsetsesudah'];
    $keuntungan_sebelum = $_POST['keuntungansebelum'];
    $keuntungan_sesudah = $_POST['keuntungansesudah'];
    $cara_pemasaran = $_POST['carapemasaran'];
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
function rupiah($angka)
{
    if ($angka != "") {
        $angkafix = $angka;
    } else {
        $angkafix = 0;
    }
    $hasilrupiah = "Rp " . number_format($angkafix, 2, ',', '.');
    return $hasilrupiah;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }

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
</head>

<body>
    <div class="container">
        <h2>Laporan Pemanfaatan/Perkembangan Wirausaha Pemula</h2>
        <h3>Tanggal: <?= date("d/m/Y", strtotime($daritanggal)) ?> – <?= date("d/m/Y", strtotime($sampaitanggal)) ?></h3>
        <h3>Periode: <?= $periode ?></h3>

        <h4>I. Identitas Wirausaha Pemula</h4>
        <table>
            <tr>
                <th>Nama (Sesuai KTP)</th>
                <td><?= $nama ?></td>
            </tr>
            <tr>
                <th>Nomor KTP/NIK</th>
                <td><?= $nik ?></td>
            </tr>
            <tr>
                <th>Alamat Usaha</th>
                <td><?= $alamat_usaha ?></td>
            </tr>
            <tr>
                <th>No.TLP</th>
                <td><?= $no_telp ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= $email ?></td>
            </tr>
            <tr>
                <th>Nama Usaha</th>
                <td><?= $nama_usaha ?></td>
            </tr>
            <tr>
                <th>Bidang Usaha</th>
                <td><?= $bidang_usaha ?></td>
            </tr>
            <tr>
                <th>Jenis Produksi</th>
                <td><?= $jenis_produksi ?></td>
            </tr>
            <tr>
                <th>Lama Usaha</th>
                <td><?= $lama_usaha ?></td>
            </tr>
        </table>

        <h4>II. Pemanfaatan Dana Awal</h4>
        <table>
            <tr>
                <th>Nilai Bantuan Yang Diterima</th>
                <td><?= $nilai_bantuan ?></td>
            </tr>
            <tr>
                <th>Tanggal Pencairan Dana</th>
                <td><?= $tanggal_pencairan_dana ?></td>
            </tr>
            <tr>
                <th>Nomor Rekening</th>
                <td><?= $nomor_rekening ?></td>
            </tr>
            <tr>
                <th>Nama Bank</th>
                <td><?= $nama_bank ?></td>
            </tr>
            <tr>
                <th>Modal Kerja</th>
                <td><?= $modal_kerja ?></td>
            </tr>
            <tr>
                <th>Modal Investasi/Peralatan</th>
                <td><?= $modal_investasi ?></td>
            </tr>
            <tr>
                <th>Penggunaan Dana</th>
                <td><?= $penggunaan_dana ?></td>
            </tr>
        </table>

        <h4>III. Penggunaan Bantuan Dana Yang Diterima</h4>
        <table>
            <tr>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Pengeluaran</th>
                <th>Keterangan</th>
            </tr>
            <?php
            foreach ($tanggalpenggunaan as $key => $tanggal) {
            ?>
                <tr>
                    <td><?= $tanggalpenggunaan[$key] ?></td>
                    <td><?= $kategori[$key] ?></td>
                    <td><?= $pengeluaran[$key] ?></td>
                    <td><?= $keterangan[$key] ?></td>
                </tr>
            <?php
            }
            ?>
        </table>

        <h4>IV. Perkembangan Usaha</h4>
        <table>
            <tr>
                <th>Uraian</th>
                <th>Satuan</th>
                <th>Sebelum</th>
                <th>Sesudah</th>
            </tr>
            <tr>
                <td>Jumlah Karyawan</td>
                <td>Orang</td>
                <td><?= $jumlah_karyawan_sebelum ?></td>
                <td><?= $jumlah_karyawan_sesudah ?></td>
            </tr>
            <tr>
                <td>Omset Usaha per Bulan</td>
                <td>Rupiah</td>
                <td><?= $omset_sebelum ?></td>
                <td><?= $omset_sesudah ?></td>
            </tr>
            <tr>
                <td>Keuntungan per Bulan</td>
                <td>Rupiah</td>
                <td><?= $keuntungan_sebelum ?></td>
                <td><?= $keuntungan_sesudah ?></td>
            </tr>
        </table>

        <h4>V. Cara Pemasaran Produk</h4>
        <p><?= $cara_pemasaran ?></p>

        <h4>VI. INFORMASI LAINNYA</h4>
        <p>Kami yang mengisi laporan ini menyatakan bahwa data yang diberikan adalah sesuai dengan kondisi sesungguhnya.</p>
        <br>
        <br>
        <br>
        <p style="text-align: right;">............, ....................</p>
        <div style="text-align: right;">
            <br>
            <br>
            <p><?= $nama ?></p>
        </div>

    </div>
</body>

</html>