<?php
    include "../koneksi.php";
    session_start();
    if (!isset($_SESSION['username'])) {
    ?>
                    <script language="JavaScript">
                        alert('Anda Harus Login  Terlebih Dahulu!!');
                        document.location='index.php';
                    </script>
                    <?php
                }
                if ($_SESSION['level']=="Admin"){
                ?>
                    <script language="JavaScript">
                        alert('Anda Tidak Mempunyai Akses Dihalaman Ini!!');
                        document.location='../dashboardadmin.php';
                    </script>
                    <?php
                };
    $id= $_GET['id'];
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_beli WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Penambahan Jumlah Transaksi</title>
    <link rel="stylesheet" type="text/css" href="../asset/order.css">
</head>
<body style="background-image: url(../BG.png)">
  <div class="order">
            <h2>
                Penambahan Jumlah Transaki
            </h2>
            <div>
                <form action="" method="POST" class="">
                    <div class="">
                        <label>Nama Alat</label>
                        <input type="text" name="nama_mds" value="<?php echo $data['nama_mds'] ?>" placeholder="Masukkan Obat" readonly>
                    </div>
                    <div class="">
                        <label>Tambah</label>
                        <input type="number" name="tambah"   placeholder="Masukkan Jumlah" min="1" >
                    </div>
                    <div class="">
                        <label>Harga</label>
                        <input type="text" name="harga" value="<?php echo $data['harga'] ?>" placeholder="Masukkan Harga" readonly>
                    </div>
                    <button onclick="return confirm('Inputan Sudah Sesuai?')" type="submit" class="simpan" name="simpan">Simpan</button>
                    <button type="reset" class="reset">Reset</button>
                </form>
            </div>
        </div>
</body>
</html>

<?php
        if(isset($_POST['simpan']))
        {
            $id_barang       =$data['id_barang'];
            $nama_mds  = $_POST['nama_mds'];
            $tambah = $_POST['tambah'];
            $harga      = $_POST['harga'];
            $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_beli WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    $jmlh=$data['stok'];
    $hasil=$jmlh+$tambah;
            $selSto =mysqli_query($koneksi, "SELECT * FROM tb_medis WHERE id='$id_barang'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['stok'];
        //menghitung sisa stok
        $sisa    =$stok-$tambah;

            if ($stok < $tambah) {
        ?>
        <script language="JavaScript">
            alert('Oops! Jumlah Penambahan lebih besar dari stok ...');
            document.location='../databeli.php';
        </script>
        <?php
    }
        else{

            $ambil=mysqli_query($koneksi, "UPDATE tb_beli
            SET id_barang='$id_barang', nama_mds='$nama_mds', stok='$hasil'
            WHERE id='$id'") or die(mysqli_error($koneksi));

           if($ambil){
                    //update stok
                    $upstok= mysqli_query($koneksi, "UPDATE tb_medis SET stok='$sisa' WHERE id='$id_barang'");
                    ?>
                    <script language="JavaScript">
                        alert('Good! Penambahan Jumlah Stok Transaksi Berhasil ...');
                        document.location='../databeli.php';
                    </script>
                    <?php
                }
                else {
                    echo "<div><b>Oops!</b> 404 Error Server.</div>";
                }
        }
    }
    ?>
