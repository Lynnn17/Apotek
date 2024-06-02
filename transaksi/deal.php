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
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_tuku WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    $jenis_obat=$data['jenis_obat'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu Deal Transaksi</title>
    <link rel="stylesheet" type="text/css" href="../asset/order.css">
</head>
<body style="background-image: url(../BG.png)">
  <div class="order">
            <h2>
                 Transaksi Deal
            </h2>
            <div>
                <form action="" method="POST" class="">
                    <td>Seri Obat</td>
                    <input type="text" name="id_obat" value="<?php echo $data['id_obat'] ?>" placeholder="" readonly>
                    <!-- <td>
                          <?php
                        $selBar    =mysqli_query($koneksi, "SELECT * FROM tb_pembelian ORDER BY nama_obat");
                        echo '<select name="id_obat" required>';
                        echo '<option value=""></option>';
                        while ($rowbar = mysqli_fetch_array($selBar)) {
                        echo '<option value="'.$rowbar['id'].'">'.$rowbar['nama_obat'].'_'.$rowbar['produsen'].'</option>';
                        }
                        echo '</select>';
                        ?>
                    </td> -->
                    <div class="">
                        <label>Kode Obat</label>
                        <input type="text" name="kode_obat" value="<?php echo $data['kode_obat'] ?>" placeholder="Masukkan Obat" readonly>
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
                        <label>Jumlah</label>
                        <input type="number" min="1" name="stok" value="<?php echo $data['stok'] ?>"  placeholder="Masukkan stok" readonly>
                    </div>
                     <div class="">
                <label>Jenis Obat</label>
                <input type="" name="jenis_obat" value="<?php echo $data['jenis_obat'] ?>" readonly>
                </div>
                     <button type="submit" class="simpan" name="simpan"onclick="return confirm('Inputan Sudah Sesuai?')">Simpan</button>
                    <button type="reset" class="reset">Reset</button>
                </form>
            </div>
        </div>
</body>
</html>

<?php



        if(isset($_POST['simpan']))
        {
            $id = $_GET['id'];
            $sql= mysqli_query($koneksi,"DELETE FROM tb_tuku where id='$id'");
            $id_obat       =$_POST['id_obat'];
            $kode_obat    = $_POST['kode_obat'];
            $nama_obat  = $_POST['nama_obat'];
            $produsen  = $_POST['produsen'];
            $jumlah     = $_POST['stok'];
            $jenis_obat   = $_POST['jenis_obat'];
            $selSto =mysqli_query($koneksi, "SELECT * FROM tb_pembelian WHERE id_obat='$id_obat'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['stok'];
        //menghitung sisa stok
        $sisa    =$stok+$jumlah;

            $ambil=mysqli_query($koneksi, "UPDATE tb_tuku
            SET id_obat='$id_obat',kode_obat='$kode_obat', nama_obat='$nama_obat',produsen='$produsen', stok='$jumlah', jenis_obat='$jenis_obat'
            WHERE id='$id'") or die(mysqli_error($koneksi));

           if($ambil){
                    //update stok
                    $upstok= mysqli_query($koneksi, "UPDATE tb_pembelian SET stok='$sisa' WHERE id_obat='$id_obat'");
                    ?>
                    <script language="JavaScript">
                        alert('Good! Transaksi Berhasil ...');
                        document.location='../datatransaksi.php';
                    </script>
                    <?php
                }
                else {
                    echo "<div><b>Oops!</b> 404 Error Server.</div>";
                }
        }
    ?>
