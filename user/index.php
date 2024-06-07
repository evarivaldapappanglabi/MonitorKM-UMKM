<?php include 'header.php'; ?>
<?php
$id = $_SESSION['pengguna']['id'];

// Mendapatkan tanggal awal dan akhir bulan ini
$tanggalAwalBulanIni = date('Y-m-01');
$tanggalAkhirBulanIni = date('Y-m-t');

// Mendapatkan pendapatan bulan ini
$queryPendapatanBulanIni = $koneksi->query("SELECT SUM(pendapatan) AS total_pendapatan FROM transaksi WHERE id = '$id' AND tanggal BETWEEN '$tanggalAwalBulanIni' AND '$tanggalAkhirBulanIni'");
$dataPendapatanBulanIni = $queryPendapatanBulanIni->fetch_assoc();
$pendapatanBulanIni = $dataPendapatanBulanIni['total_pendapatan'];

// Mendapatkan pengeluaran bulan ini
$queryPengeluaranBulanIni = $koneksi->query("SELECT SUM(pengeluaran) AS total_pengeluaran FROM transaksi WHERE id = '$id' AND tanggal BETWEEN '$tanggalAwalBulanIni' AND '$tanggalAkhirBulanIni'");
$dataPengeluaranBulanIni = $queryPengeluaranBulanIni->fetch_assoc();
$pengeluaranBulanIni = $dataPengeluaranBulanIni['total_pengeluaran'];

// Menghitung sisa saldo
$sisaSaldo = $pendapatanBulanIni - $pengeluaranBulanIni;

// Inisialisasi data tahun
$tahunSekarang = date('Y');
$tahunQuery = $koneksi->query("SELECT DISTINCT YEAR(tanggal) AS tahun FROM transaksi WHERE id = '$id' ORDER BY tahun ASC");
$tahunData = array();
while ($row = $tahunQuery->fetch_assoc()) {
    $tahunData[] = $row['tahun'];
}

// Fungsi untuk mendapatkan pendapatan per bulan berdasarkan tahun
function getPendapatanPerBulan($id, $tahun)
{
    global $koneksi;
    $pendapatanPerBulan = array();
    // Inisialisasi data untuk setiap bulan dengan nilai awal 0
    for ($bulan = 1; $bulan <= 12; $bulan++) {
        $pendapatanPerBulan[$bulan] = 0;
    }

    // Mendapatkan data transaksi berdasarkan tahun
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

// Fungsi untuk mendapatkan pengeluaran per bulan berdasarkan tahun
function getPengeluaranPerBulan($id, $tahun)
{
    global $koneksi;
    $pengeluaranPerBulan = array();
    // Inisialisasi data untuk setiap bulan dengan nilai awal 0
    for ($bulan = 1; $bulan <= 12; $bulan++) {
        $pengeluaranPerBulan[$bulan] = 0;
    }

    // Mendapatkan data transaksi berdasarkan tahun
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

// Tangkap tahun yang dipilih dari metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tahun = $_POST["tahun"];
    $pendapatanPerBulan = getPendapatanPerBulan($id, $tahun);
    $pengeluaranPerBulan = getPengeluaranPerBulan($id, $tahun);
} else {
    // Jika tahun belum dipilih, gunakan tahun saat ini sebagai default
    $tahun = $tahunSekarang;
    $pendapatanPerBulan = getPendapatanPerBulan($id, $tahun);
    $pengeluaranPerBulan = getPengeluaranPerBulan($id, $tahun);
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Selamat Datang</h1>
    <div class="row">
        <!-- Pendapatan Bulan Ini Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pendapatan Bulan Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= rupiah($pendapatanBulanIni) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengeluaran Bulan Ini Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pengeluaran Bulan Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= rupiah($pengeluaranBulanIni) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sisa Saldo Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Sisa Saldo</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= rupiah($sisaSaldo) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Form filter tahun -->
    <form method="post">
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