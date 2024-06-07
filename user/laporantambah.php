<?php include 'header.php';
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;
?>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Laporan</h6>
            </div>
            <?php 
                $getId = $_GET['id'];
                $getUserResult = $koneksi->query("SELECT * FROM pengguna WHERE id='".$getId."'");
                $getUser = $getUserResult->fetch_object();
            ?> 
            
            
            <div class="card-body">
            <?php if ($getUser) {?> 
                <form method="post" enctype="multipart/form-data" action="">
                    <div class="form-group">
                        <label>Dari Tanggal</label>
                        <input type="date" class="form-control" name="daritanggal" value="<?= date('Y-m-1') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Sampai Tanggal</label>
                        <input type="date" class="form-control" name="sampaitanggal" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Periode</label>
                        <input type="text" class="form-control" name="periode" value="" required>
                    </div>
                    <hr>
                    <h4>Identitas</h4>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" readonly="readonly" value= "<?= $getUser->nama?>" >
                    </div>
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" name="nik" readonly="readonly" value= "<?= $getUser->nik?>">
                    </div>
                    <div class="form-group">
                        <label>No Telp</label>
                        <input type="number" class="form-control" name="notelp" readonly="readonly" value= "<?= $getUser->telepon?>">
                    </div>
                    <div class="form-group">
                        <label>Nama Usaha</label>
                        <input type="text" class="form-control" name="namausaha" readonly="readonly" value= "<?= $getUser->namausaha?>">
                    </div>
                    <div class="form-group">
                        <label>Alamat Usaha</label>
                        <textarea type="text" class="form-control" name="alamatusaha" readonly="readonly"><?= $getUser->alamatusaha?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" readonly="readonly" value= "<?= $getUser->email?>">
                    </div>
                    <?php
                    } else {
                        echo "Error executing query: " . mysqli_error($koneksi);
                    }
                    ?>

                    <hr>
                    <h4>Pemanfaatan Dana</h4>
                    <div class="form-group">
                        <label>Nilai Bantuan</label>
                        <input type="number" class="form-control" name="nilaibantuan" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pencairan Dana</label>
                        <input type="date" class="form-control" name="tanggalpencairandana" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor Rekening</label>
                        <input type="text" class="form-control" name="nomorrekening" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Bank</label>
                        <input type="text" class="form-control" name="namabank" required>
                    </div>
                    <div class="form-group">
                        <label>Modal Kerja</label>
                        <input type="text" class="form-control" name="modalkerja" required>
                    </div>
                    <div class="form-group">
                        <label>Modal Investasi/Peralatan</label>
                        <input type="text" class="form-control" name="modalinvestasi" required>
                    </div>
                    <div class="form-group">
                        <label>Penggunaan Dana </label>
                        <textarea type="text" class="form-control" name="penggunaandana" required></textarea>
                    </div>
                    <hr>

                    <h4>Penggunaan Bantuan</h4>
                    <div id="input-container">
                        <!-- Konten input awal -->
                        <div class="input-group mb-3">
                            <div class="form-group mr-2">
                                <label>Tanggal Penggunaan</label>
                                <input type="date" class="form-control" name="tanggalpenggunaan[]" required>
                            </div>
                            <div class="form-group mr-2">
                                <label>Kategori</label>
                                <input type="text" class="form-control" name="kategori[]" required>
                            </div>
                            <div class="form-group mr-2">
                                <label>Pengeluaran</label>
                                <input type="text" class="form-control" name="pengeluaran[]" required>
                            </div>
                            <div class="form-group mr-2">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" name="keterangan[]" required>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-success" type="button" onclick="tambahInput()">Tambah</button>
                            </div>
                        </div>
                    </div>

                    <script>
                        function tambahInput() {
                            // Buat elemen div baru
                            var newInput = document.createElement('div');
                            newInput.classList.add('input-group', 'mb-3');

                            // Isi elemen div baru dengan elemen input dan tombol
                            newInput.innerHTML = `
            <div class="form-group mr-2">
                <label>Tanggal Penggunaan</label>
                <input type="date" class="form-control" name="tanggalpenggunaan[]" required>
            </div>
            <div class="form-group mr-2">
                <label>Kategori</label>
                <input type="text" class="form-control" name="kategori[]" required>
            </div>
            <div class="form-group mr-2">
                <label>Pengeluaran</label>
                <input type="text" class="form-control" name="pengeluaran[]" required>
            </div>
            <div class="form-group mr-2">
                <label>Keterangan</label>
                <input type="text" class="form-control" name="keterangan[]" required>
            </div>
            <div class="input-group-append">
                <button class="btn btn-danger" type="button" onclick="hapusInput(this)">Hapus</button>
            </div>
        `;

                            document.getElementById('input-container').appendChild(newInput);
                        }

                        function hapusInput(btn) {
                            btn.parentNode.parentNode.remove();
                        }
                    </script>

                    <hr>

                    <h4>Pekembangan Usaha</h4>
                    <div>
                        <div class="form-group">
                            <label>Jumlah Karyawan Sebelum</label>
                            <input type="text" class="form-control" name="jumlahkaryawansebelum" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Karyawan Sesudah</label>
                            <input type="text" class="form-control" name="jumlahkaryawansesudah" required>
                        </div>
                        <div class="form-group">
                            <label>Omset Usaha per Bulan Sebelum</label>
                            <input type="text" class="form-control" name="omsetsebelum" required>
                        </div>
                        <div class="form-group">
                            <label>Omset Usaha per Bulan sesudah</label>
                            <input type="text" class="form-control" name="omsetsesudah" required>
                        </div>
                        <div class="form-group">
                            <label>Keuntungan Sebelum</label>
                            <input type="text" class="form-control" name="keuntungansebelum" required>
                        </div>
                        <div class="form-group">
                            <label>Keuntungan sesudah</label>
                            <input type="text" class="form-control" name="keuntungansesudah" required>
                        </div>
                    </div>
                    <hr>

                    <h4>Cara Pemasaran Produk</h4>
                    <div>
                        <div class="form-group">
                            <label>Cara Pemasaran Produk</label>
                            <textarea type="text" class="form-control" name="carapemasaran" required></textarea>`
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label>Upload Laporan</label>
                        <input type="file" class="form-control" name="file" required>
                    </div> -->


                    <button type="submit" class="btn btn-primary" name="save"><i class="glyphicon glyphicon-saved"></i>Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
if (isset($_POST['save'])) {

    // $namafile = $_FILES["file"]["name"];
    // $lokasifile = $_FILES["file"]["tmp_name"];
    // $namafix = date("YmdHis") . $namafile;
    // move_uploaded_file($lokasifile, "../file/$namafix");



    $daritanggal = $_POST['daritanggal'];
    $sampaitanggal = $_POST['sampaitanggal'];
    $periode = $_POST['periode'];
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $alamat_usaha = $_POST['alamatusaha'];
    $no_telp = $_POST['notelp'];
    $email = $_POST['email'];
    $nama_usaha = $_POST['namausaha'];
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

    $dompdf = new Dompdf();

    // HTML untuk laporan
    $html = '
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
        <h3>Tanggal: ' . date("d/m/Y", strtotime($daritanggal)) . ' – ' . date("d/m/Y", strtotime($sampaitanggal)) . '</h3>
        <h3>Periode: ' . $periode . '</h3>

        <h4>I. Identitas Wirausaha Pemula</h4>
        <table>
            <tr>
                <th>Nama (Sesuai KTP)</th>
                <td>' . $nama . '</td>
            </tr>
            <tr>
                <th>Nomor KTP/NIK</th>
                <td>' . $nik . '</td>
            </tr>
            <tr>
                <th>Alamat Usaha</th>
                <td>' . $alamat_usaha . '</td>
            </tr>
            <tr>
                <th>No.TLP</th>
                <td>' . $no_telp . '</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>' . $email . '</td>
            </tr>
            <tr>
                <th>Nama Usaha</th>
                <td>' . $nama_usaha . '</td>
            </tr>        
        </table>

        <h4>II. Pemanfaatan Dana Awal</h4>
        <table>
            <tr>
                <th>Nilai Bantuan Yang Diterima</th>
                <td>' . $nilai_bantuan . '</td>
            </tr>
            <tr>
                <th>Tanggal Pencairan Dana</th>
                <td>' .  date("d/m/Y", strtotime($tanggal_pencairan_dana)) . '</td>
            </tr>
            <tr>
                <th>Nomor Rekening</th>
                <td>' . $nomor_rekening . '</td>
            </tr>
            <tr>
                <th>Nama Bank</th>
                <td>' . $nama_bank . '</td>
            </tr>
            <tr>
                <th>Modal Kerja</th>
                <td>' . $modal_kerja . '</td>
            </tr>
            <tr>
                <th>Modal Investasi/Peralatan</th>
                <td>' . $modal_investasi . '</td>
            </tr>
            <tr>
                <th>Penggunaan Dana</th>
                <td>' . $penggunaan_dana . '</td>
            </tr>
        </table>

        <h4>III. Penggunaan Bantuan Dana Yang Diterima</h4>';
    $html .= '<table>
            <tr>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Pengeluaran</th>
                <th>Keterangan</th>
            </tr>';
    foreach ($tanggalpenggunaan as $key => $tanggal) {
        $html .= '<tr>
                    <td>' .  date("d/m/Y", strtotime($tanggalpenggunaan[$key])) . '</td>
                    <td>' . $kategori[$key] . '</td>
                    <td>' . $pengeluaran[$key] . '</td>
                    <td>' . $keterangan[$key] . '</td>
                </tr>';
    }
    $html .= '</table>


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
                <td>' . $jumlah_karyawan_sebelum . '</td>
                <td>' . $jumlah_karyawan_sesudah . '</td>
            </tr>
            <tr>
                <td>Omset Usaha per Bulan</td>
                <td>Rupiah</td>
                <td>' . $omset_sebelum . '</td>
                <td>' . $omset_sesudah . '</td>
            </tr>
            <tr>
                <td>Keuntungan per Bulan</td>
                <td>Rupiah</td>
                <td>' . $keuntungan_sebelum . '</td>
                <td>' . $keuntungan_sesudah . '</td>
            </tr>
        </table>

        <h4>V. Cara Pemasaran Produk</h4>
        <p>' . $cara_pemasaran . '</p>

        <h4>VI. INFORMASI LAINNYA</h4>
        <p>Kami yang mengisi laporan ini menyatakan bahwa data yang diberikan adalah sesuai dengan kondisi sesungguhnya.</p>
        <br>
        <br>
        <br>
        <p style="text-align: right;">............, ....................</p>
        <div style="text-align: right;">
            <br>
            <br>
            <p>' . $nama . '</p>
        </div>

    </div>
</body>

</html>';

    // Masukkan HTML ke DomPDF
    $dompdf->loadHtml($html);

    // Atur ukuran dan orientasi kertas
    $dompdf->setPaper('A4', 'portrait');

    // Render PDF
    $dompdf->render();

    // Simpan PDF ke dalam file
    $pdf_content = $dompdf->output();
    $file_name = 'laporan_' . date('YmdHis') . '.pdf';
    $file_path = '../file/' . $file_name;
    file_put_contents($file_path, $pdf_content);

    $id = $_SESSION['pengguna']['id'];
    $tanggal = date('Y-m-d');
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $notelp = $_POST['notelp'];
    $namausaha = $_POST['namausaha'];
    $status = "Belum Dikonfirmasi";

    // Begin the transaction
    $koneksi->begin_transaction();

    $koneksi->query("INSERT INTO laporan (id, namalengkap, email, notelp, namausaha, status, file, tanggal)
        VALUES('$id','$nama','$email','$notelp','$namausaha','$status','$file_name','$tanggal')");

    $idlaporan = $koneksi->insert_id;

    $koneksi->query("INSERT INTO laporanidentitas(idlaporan,nik, namalengkap,alamatusaha,notelp,email,namausaha,daritanggal,sampaitanggal,periode)
                    VALUES ('$idlaporan','$nik','$nama','$alamat_usaha','$no_telp','$email','$nama_usaha','$daritanggal','$sampaitanggal','$periode')");
    
    $koneksi->query("INSERT INTO laporanpemanfaatan(idlaporan, nilaibantuan,tanggalpencairan,nomorrekening,namabank,modalkerja,modalinvestasi,penggunaandana)
                    VALUES ('$idlaporan','$nilai_bantuan','$tanggal_pencairan_dana','$nomor_rekening','$nama_bank','$modal_kerja','$modal_investasi','$penggunaan_dana')");

    // Execute the update query
    $updateTrans = $koneksi->query("UPDATE `transaksi` SET `idlaporan`=".$idlaporan."  WHERE id = ".$id." AND idlaporan = 0 AND tanggal BETWEEN '".$daritanggal."' AND '".$sampaitanggal."'");

    // Check if the query was successful
    if ($updateTrans === TRUE) {
        if ($koneksi->affected_rows > 0) {
            foreach ($tanggalpenggunaan as $key => $tanggal) {
                $tglPenggunaan = $tanggalpenggunaan[$key];
                $ktg = $kategori[$key];
                $peng = $pengeluaran[$key];
                $ket = $keterangan[$key];
        
                $koneksi->query("INSERT INTO laporanbantuan (idlaporan, tanggalpenggunaan, kategori, pengeluaran, keterangan)
                                VALUES ('$idlaporan', '$tglPenggunaan', '$ktg', '$peng', '$ket')");
            }
        
            $koneksi->query("INSERT INTO laporanperkembangan (idlaporan, jumlahkaryawansebelum, jumlahkaryawansesudah, omsetsebelum, omsetsesudah,keuntungansebelum, keuntungansesudah, id)
                                VALUES ('$idlaporan', '$jumlah_karyawan_sebelum', '$jumlah_karyawan_sesudah', '$omset_sebelum', '$omset_sesudah', '$keuntungan_sebelum', '$keuntungan_sesudah','$id')");
        
            $koneksi->query("INSERT INTO laporanpemasaran (idlaporan, carapemasaran)
                                VALUES ('$idlaporan', '$cara_pemasaran')");
        
            $koneksi->query("INSERT INTO notiflaporan (idlaporan,pesan) VALUES ('$idlaporan','Ada Laporan yang baru ditambahkan')");
            
            $koneksi->commit();
            echo "<script>alert('Berhasil Menyimpan!');</script>"; 
            echo "<script>location ='Laporandaftar.php';</script>";
        } else {
            // No rows were affected, meaning no update was performed
            echo "<script>alert('Error: Gagal Menyimpan! Data Transaksi Sudah masuk laporan sebelumnya atau data transaksi kosong');</script>"; 
            $koneksi->rollback();
        }
    } else {
        $koneksi->rollback();
        echo "<script>alert('Error: " . $koneksi->error . "');</script>"; 
        echo "<script>location ='Laporandaftar.php';</script>";

        // echo "<script>alert('Error: " . $koneksi->error . "'); window.location.href = 'another_page.php';</script>";
    }
    

}
?>

<?php include 'footer.php'; ?>