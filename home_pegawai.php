<?php
session_start();
if (empty($_SESSION['username']) or empty($_SESSION['level'])) {
    echo "<script>alert('Maaf, untuk mengakses halaman ini, anda harus login terlebih dahulu, terima kasih');document.location='index.php'</script>";
}

//koneksi database
include "koneksi.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pegawai | Ngodingpintar</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <header class="py-5 bg-secondary">
            <div class="head">
                <h1 class="text-center font-weight-normal display-4 text-white">Program Gudang </h1>
            </div>
    </header>

    <div class="container">
        <div class="jumbotron bg-info text-white">
            <h2 class="display-6">Hello, <b><?= $_SESSION['nama_lengkap'] ?></b></h2>
            <p class="lead"> Selamat datang, anda berhasil Login sebagai <b><?= $_SESSION['username'] ?></b> </p>
            <hr class="my-4">
            <a class="btn btn-danger btn-lg" href="logout.php" role="button">Logout</a>
        </div>
    </div>

    <!-- Awal Card Tabel -->
    <div class="card mt-4">
        <div class="card-header bg-success text-white">
        Daftar Data Gudang
        </div>
        <div class="card-body">

            <table class="table table-bordered table-striped">
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
                <?php
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * from gudang order by no_brg desc");
                    while($data = mysqli_fetch_array($tampil)) :
                ?>
                <tr>
                    <td><?=$no++;?></td>
                    <td><?=$data['kd_brg']?></td>
                    <td><?=$data['nama_brg']?></td>
                    <td><?=$data['harga']?></td>
                    <td><?=$data['stok']?></td>
                </tr>
                <?php endwhile; //penutup perulangan while ?>
            </table>
            
        </div>
    </div>
    <!-- Akhir Card Tabel -->
</body>

</html>