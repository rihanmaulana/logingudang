<?php
session_start();
if (empty($_SESSION['username']) or empty($_SESSION['level'])) {
    echo "<script>alert('Maaf, untuk mengakses halaman ini, anda harus login terlebih dahulu, terima kasih');document.location='index.php'</script>";
}

//koneksi database
include "koneksi.php";

//jika tombol simpan di klik
if(isset($_POST['bsimpan']))
{   
    //pengujian apakah data akan diedit / disimpan baru
    if($_GET['hal'] == "edit")
    {
        //data akan diedit
        $edit = mysqli_query($koneksi, "UPDATE gudang set 
                                            kd_brg ='$_POST[tkd_brg]',
                                            nama_brg ='$_POST[tnama_brg]',
                                            harga ='$_POST[tharga]',
                                            stok ='$_POST[tstok]'
                                        WHERE no_brg = '$_GET[id]'
                                    ");
        if($edit) //jika edit sukses
        {
            echo "<script>
                    alert('Edit data sukses!');
                    document.location='home_admin.php';
                </script>";
        }
        else
        {
            echo "<script>
                    alert('Edit data GAGAL!');
                    document.location='home_admin.php';
                </script>";
        }
    } 
    else
    {
        //Data disimpan baru
        $simpan = mysqli_query($koneksi, "INSERT INTO gudang (kd_brg, nama_brg, harga, stok)
                                      VALUES ('$_POST[tkd_brg]',
                                             '$_POST[tnama_brg]',
                                             '$_POST[tharga]',
                                             '$_POST[tstok]')
                                    ");
        if($simpan) //jika simpan sukses
        {
            echo "<script>
                    alert('Simpan data sukses!');
                    document.location='home_admin.php';
                </script>";
        }
        else
        {
            echo "<script>
                    alert('Simpan data GAGAL!');
                    document.location='home_admin.php';
                </script>";
        }
    }

}

//pengujian jika tombol edit/ hapus di klik
if(isset($_GET['hal']))
{
    //Pengujian jika edit Data
    if($_GET['hal'] == "edit")
    {
        //Tampilkan Data yang akan diedit
        $tampil = mysqli_query($koneksi, "SELECT * FROM gudang WHERE no_brg = '$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if($data)
        {
            //Jika data ditemukan, maka data ditampung ke dalam variabel
            $vkd_brg = $data['kd_brg'];
            $vnama_brg = $data['nama_brg'];
            $vharga = $data['harga'];
            $vstok = $data['stok'];
        }
    }
    else if ($_GET['hal'] == "hapus")
    {
        //hapus data
        $hapus = mysqli_query($koneksi, "DELETE FROM gudang WHERE no_brg = '$_GET[id]' ");
        if($hapus){
            echo "<script>
                    alert('Hapus Data Suksess!!');
                    document.location='home_admin.php';
                 </script>";
        }
    }
}    

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrator | Ngodingpintar</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<header class="py-5 bg-secondary">
        <div class="head">
            <h1 class="text-center font-weight-normal display-4 text-white">Program Gudang </h1>
        </div>
</header>
<br>
    <div class="container">
        <div class="jumbotron bg-primary text-white">
            <h2 class="display-6">Hello, <b><?= $_SESSION['nama_lengkap'] ?></b></h2>
            <p class="lead"> Selamat datang, anda berhasil Login sebagai <b><?= $_SESSION['username'] ?></b> </p>
            <hr class="my-4">
            <a class="btn btn-danger btn-lg" href="logout.php" role="button">Logout</a>
        </div>
    </div>

<div class="container">

    <!-- Awal Card Form -->
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
        Form Input Data Gudang
        </div>
        <div class="card-body">
            <form method="post"action="">
                <div class="form-group mt-1">
                    <label>Kode Barang</label>
                    <input type="text" name="tkd_brg" value="<?=@$vkd_brg?>" class="form-control" 
                    placeholder="Input kode barang anda disini!" required>
                </div>
                <div class="form-group mt-1">
                    <label>Nama Barang</label>
                    <input type="text" name="tnama_brg" value="<?=@$vnama_brg?>" class="form-control" 
                    placeholder="Input nama barang anda disini!" required>
                </div>
                <div class="form-group mt-1">
                    <label>Harga</label>
                    <input type="text" name="tharga" value="<?=@$vharga?>" class="form-control" 
                    placeholder="Input harga barang anda disini!" required>
                </div>
                <div class="form-group mt-1">
                    <label>Stok</label>
                    <input type="text" name="tstok" value="<?=@$vstok?>" class="form-control" 
                    placeholder="Input stok barang anda disini!" required>
                </div>

                <button type="submit" class="btn btn-success mt-2" name="bsimpan">Simpan</button>
                <button type="reset" class="btn btn-danger mt-2" name="breset">Kosongkan</button>

            </form>
        </div>
    </div>
    <!-- Akhir Card Form -->

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
                    <th>Aksi</th>
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
                    <td>
                        <a href="home_admin.php?hal=edit&id=<?=$data['no_brg']?>"  class="btn btn-warning"> Edit </a>
                        <a href="home_admin.php?hal=hapus&id=<?=$data['no_brg']?>" 
	    			    onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger"> Hapus </a>
                    </td>
                </tr>
                <?php endwhile; //penutup perulangan while ?>
            </table>
            
        </div>
    </div>
    <!-- Akhir Card Tabel -->

</div>


<script type="text/javascript" src="js/css/bootstrap.min.js"></script>
</body>

</html>