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
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_in WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menambah Jumlah Stok Alat Medis Masuk</title>
     <link rel="stylesheet" type="text/css" href="../asset/jumlahstok.css">
</head>
<body style="background-image: url(../BG.png)">
        <div class="jmlstok">
            <h2>
                Menambah Jumlah Stok Alat Medis Masuk
            </h2>
            <div>
                <form action="" method="POST" class="">
                    <div class="">
                        <label for="nama">Kode Masuk</label>
                        <input type="text" name="kode_msk" value="<?php echo $data['kode_msk'] ?>"  placeholder="Masukkan Kode Masuk" readonly>
                    </div>
                    <div class="">
                        <label>Nama Alat</label>
                        <input type="text" name="nama_msk" value="<?php echo $data['nama_msk'] ?>" placeholder="Masukkan Nama Alat Medis" readonly >
                    </div>
                    <div class="">
                        <label for="alamat">Tambah</label>
                        <input type="number" name="tambah"  placeholder="Masukkan Jumlah" min="1" >
                    </div>
                    <div class="">
                        <label>Harga</label>
                        <input type="text" name="harga" value="<?php echo $data['harga'] ?>" placeholder="Masukkan Obat" readonly >
                    </div>
                    <div class="">
                        <label for="tgl_masuk">Tanggal Masuk</label>
                        <input type="date" name="tgl_masuk" value="<?php echo $data['tgl_masuk'] ?>" xplaceholder="Masukkan Tanggal" readonly>
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
            $id_barang       =$data['id_barang'];
            $kode_msk    = $_POST['kode_msk'];
            $nama_msk  = $_POST['nama_msk'];
            $tambah = $_POST['tambah'];
            $harga   = $_POST['harga'];
            $tgl_masuk       = $_POST['tgl_masuk'];
            $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_in WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    $jmlh=$data['stok'];
    $hasil=$jmlh+$tambah;


            $selSto =mysqli_query($koneksi, "SELECT * FROM tb_medis WHERE id='$id_barang'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['stok'];
        //menghitung sisa stok
        $sisa    =$stok+$tambah;

            $ambil=mysqli_query($koneksi, "UPDATE tb_in
            SET id_barang='$id_barang',kode_msk='$kode_msk', nama_msk='$nama_msk', stok='$hasil',harga='$harga', tgl_masuk='$tgl_masuk'
            WHERE id='$id'") or die(mysqli_error($koneksi));

           if($ambil){
                    //update stok
                    $upstok= mysqli_query($koneksi, "UPDATE tb_medis SET stok='$sisa' WHERE id='$id_barang'");
                    ?>
                    <script language="JavaScript">
                        alert('Good! Menambah Jumlah Stok Alat Medis Masuk Berhasil ...');
                        document.location='../alatmasukadmin.php';
                    </script>
                    <?php
                }
                else {
                    echo "<div><b>Oops!</b> 404 Error Server.</div>";
                }
        }
    ?>
