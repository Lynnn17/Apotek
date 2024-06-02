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
                if ($_SESSION['level']=="User"){
                ?>
                    <script language="JavaScript">
                        alert('Anda Tidak Mempunyai Akses Dihalaman Ini!!');
                        document.location='../dashboard.php';
                    </script>
                    <?php
                };
    $id= $_GET['id'];
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_out WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengurangan Jumlah Stok Alat Keluar</title>
     <link rel="stylesheet" type="text/css" href="../asset/jumlahstok.css">
</head>
<body style="background-image: url(../BG.png)">
  <div class="jmlstok">
            <h2>
                Pengurangan Jumlah Stok Alat Keluar
            </h2>
            <div>
                <form action="" method="POST" class="">
                    <div class="">
                        <label for="nama">Kode Jual</label>
                        <input type="text" name="kode_msk" value="<?php echo $data['kode_msk'] ?>"  placeholder="Masukkan Kode Jual" readonly>
                    </div>
                    <div class="">
                        <label>Nama Alat</label>
                        <input type="text" name="nama_msk" value="<?php echo $data['nama_msk'] ?>" placeholder="Masukkan Obat" readonly>
                    </div>
                    <div class="">
                        <label >Kurang</label>
                        <input type="number" name="kurang"   placeholder="Jumlah Kurang Stok" min="1" >
                    </div>
                     <button type="submit" class="simpan" name="simpan"onclick="return confirm('Inputan Sudah Sesuai??')">Simpan</button>
                    <button type="reset" class="reset">Reset</button>
                </form>

            </div>
        </div>
</body>
</html>

<?php
        if(isset($_POST['simpan']))
        {
            $id_barang      =$data['id_barang'];
            $kode_msk    = $_POST['kode_msk'];
            $nama_msk  = $_POST['nama_msk'];
            $kurang = $_POST['kurang'];
            $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_out WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    $jmlh=$data['stok'];
    $hasil=$jmlh-$kurang;
            $selSto =mysqli_query($koneksi, "SELECT * FROM tb_medis WHERE id='$id_barang'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['stok'];
        $sisa    =$stok+$kurang;
       if ($jmlh < $kurang) {
        ?>
        <script language="JavaScript">
            alert('Oops! Nilai Pengurangan Terlalu Besar ...');
            document.location='../alatkeluaradmin.php';
        </script>
        <?php
    }

        else{

            $ambil=mysqli_query($koneksi, "UPDATE tb_out
            SET id_barang='$id_barang',kode_msk='$kode_msk', nama_msk='$nama_msk', stok='$hasil'
            WHERE id='$id'") or die(mysqli_error($koneksi));

           if($ambil){
                    //update stok
                    $upstok= mysqli_query($koneksi, "UPDATE tb_medis SET stok='$sisa' WHERE id='$id_barang'");
                    ?>
                    <script language="JavaScript">
                        alert('Good! Mengurangi Stok Alat Keluar Berhasil ...');
                        document.location='../alatkeluaradmin.php';
                    </script>
                    <?php
                }
                else {
                    echo "<div><b>Oops!</b> 404 Error Server.</div>";
                }
        }
    }

    ?>
