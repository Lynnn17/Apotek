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
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_pembelian WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    $jenis_obat=$data['jenis_obat'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Menambah Jumlah Obat Keluar</title>
    <link rel="stylesheet" type="text/css" href="../asset/jumlahstok.css">
</head>
<body style="background-image: url(../BG.png)">
  <div class="jmlstok">
            <h2>
                Menambah Jumlah Stok Obat Keluar
            </h2>
            <div>
                <form action="" method="POST" class="">
                    <div class="">
                        <label for="nama">Kode Jual</label>
                        <input type="text" name="kode_jual" value="<?php echo $data['kode_jual'] ?>"  placeholder="Masukkan Kode Jual" readonly>
                    </div>
                    <div class="">
                        <label>Nama Obat</label>
                        <input type="text" name="nama_obat" value="<?php echo $data['nama_obat'] ?>" placeholder="Masukkan Obat" readonly>
                    </div>
                    <div class="">
                        <label>Produsen</label>
                        <input type="text" name="produsen" value="<?php echo $data['produsen'] ?>" placeholder="Masukkan Produsen" readonly>
                    </div>
                    <div class="">
                        <label >Tambah</label>
                        <input type="number" name="tambah"   placeholder="Jumlah tambah stok" min="1">
                    </div>
                     <div class="">
                <label>Jenis Obat</label>
                <input type="" name="jenis_obat" value="<?php echo $data['jenis_obat']?>" readonly>
                </div>
                    <button type="submit" class="simpan" name="simpan" onclick="return confirm('Inputan Sudah Sesuai??')">Simpan</button>
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
            $kode_jual    = $_POST['kode_jual'];
            $nama_obat  = $_POST['nama_obat'];
            $produsen  = $_POST['produsen'];
            $tambah = $_POST['tambah'];
            $jenis_obat   = $_POST['jenis_obat'];
             $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_pembelian WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    $jmlh=$data['stok'];
    $hasil=$jmlh+$tambah;
            $selSto =mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE id='$id_obat'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['stok'];
        //menghitung sisa stok
        $sisa    =$stok-$tambah;
        if ($stok < $tambah) {
        ?>
        <script language="JavaScript">
            alert('Oops! Jumlah penambahan lebih besar dari stok ...');
            document.location='../obatkeluaradmin.php';
        </script>
        <?php
    }
    else{
            $ambil=mysqli_query($koneksi, "UPDATE tb_pembelian
            SET id_obat='$id_obat',kode_jual='$kode_jual', nama_obat='$nama_obat', produsen='$produsen', stok='$hasil', jenis_obat='$jenis_obat'
            WHERE id='$id'") or die(mysqli_error($koneksi));

           if($ambil){
                    //update stok
                    $upstok= mysqli_query($koneksi, "UPDATE tb_barang SET stok='$sisa' WHERE id='$id_obat'");
                    ?>
                    <script language="JavaScript">
                        alert('Good! Menambah Jumlah Stok Obat Keluar Berhasil ...');
                        document.location='../obatkeluaradmin.php';
                    </script>
                    <?php
                }
                else {
                    echo "<div><b>Oops!</b> 404 Error Server.</div>";
                }
        }
    }
    ?>
