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
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_tuku WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    $jenis_obat=$data['jenis_obat'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengurangan Jumlah Obat Keluar</title>
    <link rel="stylesheet" type="text/css" href="../asset/order.css">
</head>
<body style="background-image: url(../BG.png)">
  <div class="order">
            <h2>
                Pengurangan Jumlah Stok Obat Keluar
            </h2>
            <div>
                <form action="" method="POST" class="">
                    <div class="">
                        <label>Nama Obat</label>
                        <input type="text" name="nama_obat" value="<?php echo $data['nama_obat'] ?>" placeholder="Masukkan Obat" readonly>
                    </div>
                    <div class="">
                        <label>Produsen</label>
                        <input type="text" name="produsen" value="<?php echo $data['produsen'] ?>" placeholder="Masukkan produsen" readonly>
                    </div>
                    <div class="">
                        <label>Kurang</label>
                        <input type="number" name="kurang"   placeholder="Masukkan Jumlah" min="1" required >
                    </div>
                    <div class="">
                        <label>Harga</label>
                        <input type="text" name="harga" value="<?php echo $data['harga'] ?>" placeholder="Masukkan Harga" readonly>
                    </div>
                     <div class="">
                <label>Jenis Obat</label>
                <input type="" name="jenis_obat" value="<?php echo $data['jenis_obat'] ?>" readonly>
                </div>
                    <button type="submit" class="simpan" name="simpan" onclick="return confirm('Inputan Sudah Sesuai?')">Simpan</button>
                    <button type="reset" class="reset">Reset</button>
                </form>
            </div>
        </div>
</body>
</html>
<?php
        if(isset($_POST['simpan']))
        {
            $id_obat       =$data['id_obat'];
            $nama_obat  = $_POST['nama_obat'];
            $produsen  = $_POST['produsen'];
            $kurang = $_POST['kurang'];
            $harga      = $_POST['harga'];
            $jenis_obat   = $_POST['jenis_obat'];
            $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_tuku WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    $jmlh=$data['stok'];
    $hasil=$jmlh-$kurang;

            $selSto =mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE id='$id_obat'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['stok'];
        //menghitung sisa stok
        $sisa    =$stok+$kurang;
            if ($jmlh < $kurang) {
        ?>
        <script language="JavaScript">
            alert('Oops! Nilai Pengurangan Terlalu Besar ...');
            document.location='../datatransaksi.php';
        </script>
        <?php
    }
        else{

            $ambil=mysqli_query($koneksi, "UPDATE tb_tuku
            SET id_obat='$id_obat', nama_obat='$nama_obat', produsen='$produsen', stok='$hasil', jenis_obat='$jenis_obat'
            WHERE id='$id'") or die(mysqli_error($koneksi));

           if($ambil){
                    //update stok
                    $upstok= mysqli_query($koneksi, "UPDATE tb_barang SET stok='$sisa' WHERE id='$id_obat'");
                    ?>
                    <script language="JavaScript">
                        alert('Good! Pengurangan Jumlah Stok Transaksi Berhasil ...');
                        document.location='../datatransaksi.php';
                    </script>
                    <?php
                }
                else {
                    echo "<div><b>Oops!</b> 404 Error Server.</div>";
                }
        }
}
    ?>
