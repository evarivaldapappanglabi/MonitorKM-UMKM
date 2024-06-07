<?php include 'header.php'; ?>

<?php
$ambil = $koneksi->query("SELECT * FROM pengguna WHERE id='$_GET[id]'");
$row = $ambil->fetch_assoc();
?>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit UMKM</h6>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" value="<?= $row['nama'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label>No Telp</label>
                        <input type="number" class="form-control" name="telepon" value="<?= $row['telepon'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Usaha</label>
                        <input type="text" class="form-control" name="namausaha" value="<?= $row['namausaha'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat Usaha</label>
                        <textarea type="text" class="form-control" name="alamatusaha" required><?= $row['alamatusaha'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>NPWP Usaha</label>
                        <input type="text" class="form-control" name="npwpusaha" value="<?= $row['npwpusaha'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" name="nik" value="<?= $row['nik'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $row['username'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $row['email'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="hidden" class="form-control" name="passwordlama" value="<?= $row['password'] ?>">
                        <input type="password" class="form-control" name="password">
                        <span class="text-danger">Kosongkan jika tidak ingin mengganti password</span>

                    </div>
                    <button type="submit" class="btn btn-primary" name="ubah"><i class="glyphicon glyphicon-saved"></i>Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['ubah'])) {
    $id = $_GET['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $nik = $_POST['nik'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamatusaha = $_POST['alamatusaha'];
    $npwpusaha = $_POST['npwpusaha'];
    $namausaha = $_POST['namausaha'];

    if ($_POST['password'] == "") {
        $password = $_POST['passwordlama'];
    } else {
        $password = $_POST['password'];
    }

    $koneksi->query("UPDATE pengguna 
                SET nama='$nama', 
                    username='$username', 
                    nik='$nik',
                    email='$email', 
                    password='$password', 
                    alamatusaha='$alamatusaha', 
                    telepon='$telepon', 
                    namausaha='$namausaha', 
                    npwpusaha='$npwpusaha' 
                WHERE id='$id'") or die (mysqli_error($koneksi));


    echo "<script>alert('Data Berhasil Diubah');</script>";
    echo "<script>location='umkmdaftar.php';</script>";
}
?>

<?php include 'footer.php'; ?>