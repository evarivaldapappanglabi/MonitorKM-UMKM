<?php include 'header.php'; ?>

<?php
// Inisialisasi data tahun
$tahunSekarang = date('Y');
$tahunQuery = $koneksi->query("SELECT DISTINCT YEAR(tanggal) AS tahun FROM transaksi ORDER BY tahun ASC");
$tahunData = array();
while ($row = $tahunQuery->fetch_assoc()) {
    $tahunData[] = $row['tahun'];
}

// Fungsi untuk mendapatkan pendapatan per bulan berdasarkan tahun dan UMKM
function getPendapatanPerBulan($id, $tahun)
{
    global $koneksi;
    $pendapatanPerBulan = array();
    // Inisialisasi data untuk setiap bulan dengan nilai awal 0
    for ($bulan = 1; $bulan <= 12; $bulan++) {
        $pendapatanPerBulan[$bulan] = 0;
    }

    // Mendapatkan data transaksi berdasarkan tahun dan UMKM
    $ambil = $koneksi->query("SELECT * FROM transaksi WHERE id = '$id' AND YEAR(tanggal) = '$tahun' ORDER BY idtransaksi ASC");

    // Looping untuk menghitung pendapatan per bulan
    while ($data = $ambil->fetch_assoc()) {
        $bulan = date('n', strtotime($data['tanggal']));
        $pendapatanPerBulan[$bulan] += $data['pendapatan'];
    }

    // Inisialisasi array untuk menyimpan data grafik
    $dataPoints = array();

    // Looping untuk mengisi dataPoints dengan data pendapatan per bulan
    foreach ($pendapatanPerBulan as $bulan => $pendapatan) {
        $dataPoints[] = array("label" => date('M', mktime(0, 0, 0, $bulan, 1)), "y" => $pendapatan);
    }

    return $dataPoints;
}

// Fungsi untuk mendapatkan pengeluaran per bulan berdasarkan tahun dan UMKM
function getPengeluaranPerBulan($id, $tahun)
{
    global $koneksi;
    $pengeluaranPerBulan = array();
    // Inisialisasi data untuk setiap bulan dengan nilai awal 0
    for ($bulan = 1; $bulan <= 12; $bulan++) {
        $pengeluaranPerBulan[$bulan] = 0;
    }

    // Mendapatkan data transaksi berdasarkan tahun dan UMKM
    $ambil = $koneksi->query("SELECT * FROM transaksi WHERE id = '$id' AND YEAR(tanggal) = '$tahun' ORDER BY idtransaksi ASC");

    // Looping untuk menghitung pengeluaran per bulan
    while ($data = $ambil->fetch_assoc()) {
        $bulan = date('n', strtotime($data['tanggal']));
        $pengeluaranPerBulan[$bulan] += $data['pengeluaran'];
    }

    // Inisialisasi array untuk menyimpan data grafik
    $dataPoints = array();

    // Looping untuk mengisi dataPoints dengan data pengeluaran per bulan
    foreach ($pengeluaranPerBulan as $bulan => $pengeluaran) {
        $dataPoints[] = array("label" => date('M', mktime(0, 0, 0, $bulan, 1)), "y" => $pengeluaran);
    }

    return $dataPoints;
}

// Tangkap tahun dan UMKM yang dipilih dari metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tahun = $_POST["tahun"];
    $id_umkm = $_POST['id_umkm'];
    $pendapatanPerBulan = getPendapatanPerBulan($id_umkm, $tahun);
    $pengeluaranPerBulan = getPengeluaranPerBulan($id_umkm, $tahun);
} else {
    // Jika tahun dan UMKM belum dipilih, gunakan tahun saat ini sebagai default
    $tahun = $tahunSekarang;
    $id_umkm = '';
    $pendapatanPerBulan = getPendapatanPerBulan($id_umkm, $tahun);
    $pengeluaranPerBulan = getPengeluaranPerBulan($id_umkm, $tahun);
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Selamat Datang</h1>

    <!-- Form filter tahun -->
    <form method="post">
        <div class="form-group">
            <label for="tahun">Pilih UMKM :</label>
            <select class="form-control" id="id_umkm" name="id_umkm">
                <option value=""></option>
                <?php $ambil = $koneksi->query("SELECT*FROM pengguna WHERE level='User' order by namausaha asc") or die(mysqli_error($koneksi)); ?>
                <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                    <option value="<?= $pecah['id'] ?>" <?= ($pecah['id'] == $id_umkm) ? 'selected' : '' ?>><?= $pecah['namausaha'] ?> - <?= $pecah['alamatusaha'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="tahun">Pilih Tahun:</label>
            <select class="form-control" id="tahun" name="tahun">
                <?php foreach ($tahunData as $tahunOption) : ?>
                    <option value="<?= $tahunOption ?>" <?= ($tahunOption == $tahun) ? 'selected' : '' ?>><?= $tahunOption ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
    <br>
    <div class="row">
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pendapatan perbulan</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="chartContainerPendapatan" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pengeluaran perbulan</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="chartContainerPengeluaran" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
    window.onload = function() {
        var chartPendapatan = new CanvasJS.Chart("chartContainerPendapatan", {
            animationEnabled: true,
            title: {
                text: "Pendapatan per Bulan"
            },
            axisY: {
                title: "Pendapatan (Rp)"
            },
            axisX: {
                title: "Bulan",
                interval: 1
            },
            data: [{
                type: "line",
                dataPoints: <?= json_encode($pendapatanPerBulan) ?>
            }]
        });
        chartPendapatan.render();

        var chartPengeluaran = new CanvasJS.Chart("chartContainerPengeluaran", {
            animationEnabled: true,
            title: {
                text: "Pengeluaran per Bulan"
            },
            axisY: {
                title: "Pengeluaran (Rp)"
            },
            axisX: {
                title: "Bulan",
                interval: 1
            },
            data: [{
                type: "line",
                dataPoints: <?= json_encode($pengeluaranPerBulan) ?>
            }]
        });
        chartPengeluaran.render();
    }
</script>