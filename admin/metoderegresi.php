<?php include 'header.php'; ?>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Anggota UMKM</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="table">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>No.</th>
                                <th>Nama Usaha</th>
                                <th>Alamat Usaha</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1; ?>
                            <?php $ambil = $koneksi->query("SELECT*FROM pengguna WHERE level='User' order by id desc") or die (mysqli_error($koneksi)); ?>
                            <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $pecah['namausaha'] ?></td>
                                    <td><?php echo $pecah['alamatusaha'] ?></td>
                                    <td><?php echo "status" ?></td>
                                    <td>
                                        <a href="umkmdetaildaftar.php?id=<?php echo $pecah['id']; ?>&page='regresi'" class="btn btn-success m-1">Detail</a>
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