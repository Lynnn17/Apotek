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
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_medis WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
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
                Order Alat Medis
            </h2>
            <div>
                <form action="" method="POST" class="">
                    <div class="">
                        <label>Kode Alat</label>
                        <input type="text" name="kode_mds" value="<?php echo $data['kode_mds'] ?>" placeholder="Masukkan Obat" readonly>
                    </div>
                    <div class="">
                        <label>Nama Alat</label>
                        <input type="text" name="nama_mds" value="<?php echo $data['nama_mds'] ?>" placeholder="Masukkan Obat" readoonly>
                    </div>
                    <div class="">
                        <label>Jumlah</label>
                        <input type="number" min="1" name="stok" value=""  placeholder="Masukkan stok">
                    </div>
                    <div class="">
                        <label >Harga</label>
                        <input type="" name="harga" value="<?php echo $data['harga'] ?>" xplaceholder="Masukkan Tanggal" readonly>
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
    $id_barang=$data["id"];
    $kode_mds=$_POST["kode_mds"];
    $nama_mds=$_POST["nama_mds"];
    $jumlah=$_POST["stok"];
    $harga=$_POST["harga"];
    $total=$harga*$jumlah;
        $selSto =mysqli_query($koneksi, "SELECT * FROM tb_medis WHERE id='$id_barang'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['stok'];
        //menghitung sisa stok
        $sisa    =$stok-$jumlah;
            if ($stok < $jumlah) {
        ?>
        <script language="JavaScript">
            alert('Oops! Jumlah transaksi lebih besar dari stok ...');
            document.location='../daftaralat.php';
        </script>
        <?php
    }
        else{


          $insert =mysqli_query($koneksi, "INSERT INTO tb_beli (id_barang,kode_mds,nama_mds,stok,harga,total) VALUES ('$id_barang','$kode_mds','$nama_mds','$jumlah','$harga','$total')");
        if($insert){
                    //update stok
                    $upstok= mysqli_query($koneksi, "UPDATE tb_medis SET stok='$sisa' WHERE id='$id_barang'");

                    ?>
                    <script language="JavaScript">
                        alert('Good! Input transaksi Alat Medis berhasil ...');
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
x