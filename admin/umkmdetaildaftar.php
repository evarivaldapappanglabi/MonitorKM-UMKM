    <?php include 'header.php'; ?>
    <?php require ('./multipleregresi.php'); ?>
    <?php
    $id = $_GET['id'];


    // Inisialisasi tanggal awal dan tanggal akhir default
    $tanggal_awal = date('Y-m-01');
    $tanggal_akhir = date('Y-m-t');
    // Periksa apakah ada pengiriman form untuk filter tanggal
    if (isset($_POST['filter'])) {
        // Ambil tanggal awal dan tanggal akhir dari formulir
        $tanggal_awal = $_POST['tanggal_awal'];
        $tanggal_akhir = $_POST['tanggal_akhir'];
    }

    ?>
    <?php $ambil = $koneksi->query("SELECT*FROM pengguna WHERE level='User' order by id desc") or die(mysqli_error($koneksi));
    $data = $ambil->fetch_assoc();
    ?>


    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Laporan</h6>
                    <h6 class="m-0 font-weight-bold text-primary"><?= $data['namausaha'] ?>, <?= $data['alamatusaha'] ?></h6>
                </div>
                <div class="card-body">
                    <!-- Formulir filter tanggal -->
                    <?php if (isset($_GET['page']) != "regresi") {?>
                    <form method="post" class="mb-3">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="tanggal_awal">Tanggal Awal</label>
                                <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" value="<?= $tanggal_awal ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="tanggal_akhir">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="<?= $tanggal_akhir ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-primary mt-4" name="filter">Filter</button>
                            </div>
                        </div>
                    </form>
                    <?php } ?>

                    <?php if (isset($_GET['page']) == "regresi") {
                        // If condition is true, execute this block of code
                        $dateTwoYear = date("Y-m-d", strtotime("-2 year"));
                        $queryHelper = "SELECT                              
                                laporan.idlaporan, 
                                pendapatan, 
                                laporanperkembangan.jumlahkaryawansesudah, 
                                laporanperkembangan.keuntungansesudah 
                            FROM 
                                laporan 
                                JOIN (
                                    SELECT 
                                        id, 
                                        idlaporan,
                                        SUM(pendapatan) AS pendapatan 
                                    FROM 
                                        transaksi 
                                    GROUP BY 
                                        idlaporan
                                ) AS trans ON laporan.idlaporan = trans.idlaporan 
                                JOIN laporanperkembangan ON laporan.idlaporan = laporanperkembangan.idlaporan 
                            WHERE 
                                laporan.id = ".$id." 
                                AND laporan.status = 'Diterima' 
                                AND laporan.tanggal > ".$dateTwoYear."
                            ORDER BY 
                                laporan.tanggal DESC;";
                        // var_dump($queryHelper);
                        $ambil = $koneksi->query($queryHelper);
                            ?>
                            <!-- Add HTML content after "test" using a combination of PHP and HTML -->
                                <div class="table-responsive">
                                <table class="table table-bordered" id="table">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Laporan</th>
                                            <th>Karyawan</th>
                                            <th>Keuntungan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $saldo = 0;
                                        $totalPendapatan = 0;
                                        $totalPengeluaran = 0;
                                        $nomor = 1;
                                        while ($data = $ambil->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><?= $nomor ?></td>
                                                <td><?php echo $data["pendapatan"] ?></td>
                                                <td><?php echo $data["jumlahkaryawansesudah"] ?></td>
                                                <td><?php echo $data["keuntungansesudah"] ?></td>
                                            </tr>
                                            <?php $nomor++; ?>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                        <!-- If condition is false, execute this block of code -->
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Pendapatan</th>
                                        <th>Pengeluaran</th>
                                        <th>Sisa Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $saldo = 0;
                                    $totalPendapatan = 0;
                                    $totalPengeluaran = 0;
                                    $nomor = 1;

                                    $ambil = $koneksi->query("SELECT * FROM transaksi WHERE id = '$id' AND tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY idtransaksi ASC");

                                    while ($data = $ambil->fetch_assoc()) {
                                        $saldo += $data['pendapatan'];
                                        $saldo -= $data['pengeluaran'];
                                        $totalPendapatan += $data['pendapatan'];
                                        $totalPengeluaran += $data['pengeluaran'];
                                    ?>
                                        <tr>
                                            <td><?= $nomor ?></td>
                                            <td><?php echo tanggal($data["tanggal"]) ?></td>
                                            <td><?php echo $data["keterangan"] ?></td>
                                            <td><?php echo rupiah($data["pendapatan"]) ?></td>
                                            <td><?php echo rupiah($data["pengeluaran"]) ?></td>
                                            <td><?php echo rupiah($saldo) ?></td>
                                        </tr>
                                        <?php $nomor++; ?>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right mt-3">
                            <strong>Total Pendapatan: <?= rupiah($totalPendapatan) ?></strong><br>
                            <strong>Total Pengeluaran: <?= rupiah($totalPengeluaran) ?></strong><br>
                            <strong>Sisa Saldo: <?= rupiah($saldo) ?></strong>
                        </div>
                    <?php }?>



                    <div>
                    <?php
                        if (isset($_GET['page']) == "regresi") {
                            // template tanggal 2 tahun kebelakang
                            function getTanggal() {
                                $now = date("Y-m-d");
                                $end = date("Y-m-d", strtotime("-2 year"));
                                $start = new DateTime($end);
                                $end = new DateTime($now);
                                $interval = DateInterval::createFromDateString('1 month');
                                $period = new DatePeriod($start, $interval, $end);
                                $months = array();
                            
                                foreach ($period as $dt) {
                                    $data = $dt->format("Y-m-d");
                                    array_push($months, $data);
                                }
                                return $months;
                            }

                            function createPairs($array) {
                                $pairs = array();
                                for ($i = 0; $i < count($array) - 1; $i++) {
                                    $pair = array($array[$i], $array[$i + 1]);
                                    array_push($pairs, $pair);
                                }
                                return $pairs;
                            }

                            // x1 = totalPendapatan
                            // x2 = $totalKaryawan
                            // y  = $totalKeuntungan

                            $regresiDataPoints = array();
                            $regresiLinePoints = array();
                            function regresiLinierBerganda($dataX1, $dataX2, $dataY,&$regresiDataPoints, &$regresiLinePoints) {
                                // $dataX1 = array_map('intval', $dataX1);
                                // $dataX2 = array_map('intval', $dataX2);
                                // $dataY = array_map('intval', $dataY);

                                $regresiDataPoints = array();
                                $regresiLinePoints = array();

                                $regresi = new MultipleRegresi($dataX1, $dataX2, $dataY);
                                $hasil = $regresi->hasil;
                                $Fhitung = $regresi->Fhitung;
                                $Ftable = $regresi->Ftable;

                                

                                if (count($dataX1) > 0) {
                                    foreach ($dataX1 as $key => $value) {
                                        $regresiDataPoints[] = array("y" => $value, "x" => $dataX2[$key]);
                                        // persamaan
                                        $regresiLinePoints[] = array("y" =>$value, "x" => ($regresi->a + $regresi->b1 * $value + $regresi->b2 * $dataX2[$key]));
                                    }
                                } else {
                                    $regresiDataPoints[] = array("y" => 0, "x" => 0);
                                    $$regresiLinePoints[] = array("y" => 0, "x" => 0);
                                }

                                return array( $hasil,$Fhitung,$Ftable,$regresiDataPoints, $regresiLinePoints);
                            }

                            
                            // main perhitungan
                            function mainPerhitungan($koneksi, $id, &$regresiDataPoints, &$regresiLinePoints) {
                                $fix = getTanggal();
                                $data = array();
                                $max = 6;
                                
                                for ($i = 0; $i <= count($fix)-1; $i+=$max){
                                $first = $fix[$i];
                                array_push($data,$first);
                                if (count($data) == $max){
                                    $data = array();
                                } 
                                if (count($data) == 4) {
                                    array_push($data,date("Y-m-d"));
                                }
                                };
                                $pairs = createPairs($data);
                                $rangeHelper = array();
                                $hasilRegresi = array();
                                $regresiDataArr = array();
                                $regresiLineArr = array();
                                $FhitungArr = array();
                                $FtableArr = array();
                                
                                // PERHITUNGAN PER SEMESTER
                                foreach ($pairs as $pair) {
                                    $firstDate = $pair[0];
                                    $lastDate = $pair[1];

                                    $transaksiQuery = "SELECT 
                                    laporan.idlaporan, 
                                    pendapatan, 
                                    laporanperkembangan.jumlahkaryawansesudah, 
                                    laporanperkembangan.keuntungansesudah 
                                  FROM 
                                    laporan 
                                    JOIN (
                                      SELECT 
                                        id,
                                        idlaporan, 
                                        SUM(pendapatan) AS pendapatan 
                                      FROM 
                                        transaksi 
                                      GROUP BY 
                                        idlaporan
                                    ) AS trans ON laporan.idlaporan = trans.idlaporan
                                    JOIN laporanperkembangan ON laporan.idlaporan = laporanperkembangan.idlaporan 
                                  WHERE 
                                    laporan.id = ".$id." 
                                    AND laporan.status = 'Diterima' 
                                    AND laporan.tanggal BETWEEN '".$firstDate."' 
                                    AND '".$lastDate."' 
                                  ORDER BY 
                                    laporan.tanggal DESC
                                  ;
                                    ";

                                    $ambilTransaksi = $koneksi->query($transaksiQuery);
                                    // var_dump($transaksiQuery);


                                    $jumlahPendapatan = 0;
                                    $jumlahKaryawan = 0;
                                    $jumlahKeuntungan = 0;
                                    $smtX1 = array();
                                    $smtX2 = array();
                                    $smtY = array();

                                    if ($ambilTransaksi->num_rows > 0) {
                                        // Iterasi dan ambil data
                                        while ($rowData = $ambilTransaksi->fetch_assoc()) {
                                            $jumlahPendapatan = $rowData['pendapatan']; // Use the actual column name without alias
                                            $jumlahKaryawan = $rowData['jumlahkaryawansesudah']; // Use the actual column name without alias
                                            $jumlahKeuntungan = $rowData['keuntungansesudah']; 
                                            // var_dump($rowData);// Use the actual column name without alias                                                                                    
                                            array_push($smtX1, $jumlahPendapatan);
                                            array_push($smtX2,  $jumlahKaryawan);
                                            array_push($smtY, $jumlahKeuntungan);
                                        }
                                    } else {
                                        // Tindakan yang akan diambil jika tidak ada data yang ditemukan
                                        $jumlahPendapatan = 0;
                                        $jumlahKaryawan = 0;
                                        $jumlahKeuntungan = 0;

                                        array_push($smtX1, $jumlahPendapatan);
                                        array_push($smtX2,  $jumlahKaryawan);
                                        array_push($smtY, $jumlahKeuntungan);
                                    }
                                    $smtX1 = array_map('intval', $smtX1);
                                    $smtX2 = array_map('intval', $smtX2);
                                    $smtY = array_map('intval', $smtY);

                                    
                                    // savings data return
                                    list($hasil, $Fhitung,$Ftable, $regresiDataPoints, $regresiLinePoints) = regresiLinierBerganda($smtX1, $smtX2, $smtY, $regresiDataPoints,$regresiLinePoints);
                                    
                                    // ada array push per variabel
                                    array_push($hasilRegresi, $hasil);
                                    array_push($regresiDataArr, $regresiDataPoints);
                                    array_push($regresiLineArr, $regresiLinePoints);
                                    array_push($rangeHelper, $firstDate. " - ". $lastDate);
                                    array_push($FhitungArr, $Fhitung);
                                    array_push($FtableArr, $Ftable);
                                }                                
                                

                                return array($hasilRegresi,$FhitungArr,$FtableArr, $regresiDataArr, $regresiLineArr, $rangeHelper);
                            }


                            list($hasilRegresi, $FhitungArr,$FtableArr, $regresiDataArr, $regresiLineArr, $rangeHelper) = mainPerhitungan($koneksi, $id, $regresiDataPoints, $regresiLinePoints);

                            $lastIndexData[] = end($regresiDataArr);
                            $lastIndexLine[] = end($regresiLineArr);

                            // antisipasi string
                            foreach ($lastIndexData[0] as &$dataPoint) {
                                $dataPoint['y'] = intval($dataPoint['y']);
                                $dataPoint['x'] = intval($dataPoint['x']);
                            }
                        }
                    ?>

                    </div>
                </div>
            </div>
            
            <?php if (isset($_GET['page']) == "regresi") {?>
                <div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Regresi</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Range Tanggal</th>
                                            <th>F Hitung</th>
                                            <th>F Tabel</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $nomor =1;
                                        foreach ($rangeHelper as $key =>$value) {
                                        ?>
                                            <tr>
                                                <td><?= $nomor ?></td>
                                                <td><?php echo $value ?></td>
                                                <td><?php echo $FhitungArr[$key] ?></td>
                                                <td><?php echo $FtableArr[$key] ?></td>
                                                <td><?php echo ($hasilRegresi[$key] == 1) ? "Layak" : "Tidak layak" ?></td>
                                            </tr>
                                            <?php $nomor++; ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <div id="chartContainerRegresi" style="margin-top: 20px; height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <script>
        window.onload = function() {
            var chartRegresi = new CanvasJS.Chart("chartContainerRegresi", {
                animationEnabled: true,
                title: {
                    text: "Regresi Linier Berganda"
                },
                axisY: {
                    title: "Pendapatan",
                },
                axisX: {
                    title: "Karyawan",                    
                },
                data: [{
                    type: "line",
                    markerType: "square",
                    toolTipContent: "x: {x}, y: {y}",
                    dataPoints: <?php echo json_encode($lastIndexData[0]); ?>
                }]
            });
            chartRegresi.render();
        }
    </script>
