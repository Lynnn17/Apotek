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

    $id = $_GET['id'];
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    $jenis_obat=$data['jenis_obat'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order</title>
    <link rel="stylesheet" type="text/css" href="../asset/order.css">
</head>
<body style="background-image: url(../BG.png)">
  <div class="order">
            <h2>
                Order Obat
            </h2>
            <div>
                <form action="" method="POST" class="">
                    <div class="">
                        <label>Kode Obat</label>
                        <input type="text" name="kode_obat" value="<?php echo $data['kode_obat'] ?>" placeholder="Masukkan Obat" readonly>
                    </div>
                    <div class="">
                        <label>Nama Obat</label>
                        <input type="text" name="nama_obat" value="<?php echo $data['nama_obat'] ?>" placeholder="Masukkan Obat" readoonly>
                    </div>
                    <div class="">
                        <label>Produsen</label>
                        <input type="text" name="produsen" value="<?php echo $data['produsen'] ?>" placeholder="Masukkan Obat" readoonly>
                    </div>
                    <div class="">
                        <label>Jumlah</label>
                        <input type="number" min="1" name="stok" value=""  placeholder="Masukkan stok">
                    </div>
                    <div class="">
                        <label >Harga</label>
                        <input type="" name="harga" value="<?php echo $data['harga'] ?>" xplaceholder="Masukkan Tanggal" readonly>
                    </div>
                     <div class="">
                <label>Jenis Obat</label>
                <input type="" name="jenis_obat" value="<?php echo $data['jenis_obat'] ?>" readonly>
                </div>
                     <button type="submit" class="simpan" name="simpan"onclick="return confirm('Inputan Sudah Sesuai??')">Simpan</button>
                    <button type="reset" class="reset">Reset</button>
                </form>
            </div>
        </div>
</body>
</html>
<?php

    if (isset($_POST['simpan'])) {
    $id_obat=$data["id"];
    $kode_obat=$_POST["kode_obat"];
    $nama_obat=$_POST["nama_obat"];
    $produsen=$_POST["produsen"];
    $jumlah=$_POST["stok"];
    $harga=$_POST["harga"];
    $jenis_obat=$_POST["jenis_obat"];
    $total=$harga*$jumlah;
        $selSto =mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE id='$id_obat'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['stok'];
        //menghitung sisa stok
        $sisa    =$stok-$jumlah;
            if ($stok < $jumlah) {
        ?>
        <script language="JavaScript">
            alert('Oops! Jumlah transaksi lebih besar dari stok ...');
            document.location='../daftarobat.php';
        </script>
        <?php
    }
        else{


          $insert =mysqli_query($koneksi, "INSERT INTO tb_tuku (id_obat,kode_obat,nama_obat,produsen,stok,harga,jenis_obat,total) VALUES ('$id_obat','$kode_obat','$nama_obat','$produsen','$jumlah','$harga','$jenis_obat','$total')");
        if($insert){
                    //update stok
                    $upstok= mysqli_query($koneksi, "UPDATE tb_barang SET stok='$sisa' WHERE id='$id_obat'");

                    ?>
                    <script language="JavaScript">
                        alert('Good! Input transaksi Obat berhasil ...');
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
