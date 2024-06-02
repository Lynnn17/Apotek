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
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_beli WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
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
                    <td>Seri Alat</td>
                    <input type="text" name="id_barang" value="<?php echo $data['id_barang'] ?>" placeholder="Masukkan Obat" readonly>
                    <!-- <td>
                          <?php
                        $selBar    =mysqli_query($koneksi, "SELECT * FROM tb_out ORDER BY nama_msk");
                        echo '<select name="id_barang" required>';
                        echo '<option value=""></option>';
                        while ($rowbar = mysqli_fetch_array($selBar)) {
                        echo '<option value="'.$rowbar['id'].'">'.$rowbar['nama_msk'].'_'.$rowbar['kode_msk'].'</option>';
                        }
                        echo '</select>';
                        ?>
                    </td> -->
                    <div class="">
                        <label>Kode Alat</label>
                        <input type="text" name="kode_mds" value="<?php echo $data['kode_mds'] ?>" placeholder="Masukkan Obat" readonly>
                    </div>
                    <div class="">
                        <label>Nama Alat</label>
                        <input type="text" name="nama_mds" value="<?php echo $data['nama_mds'] ?>" placeholder="Masukkan Obat" readonly>
                    </div>
                    <div class="">
                        <label>Jumlah</label>
                        <input type="number" min="1" name="stok" value="<?php echo $data['stok'] ?>"  placeholder="Masukkan stok" readonly>
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
            $sql= mysqli_query($koneksi,"DELETE FROM tb_beli where id='$id'");
            $id_barang       =$_POST['id_barang'];
            $kode_mds    = $_POST['kode_mds'];
            $nama_mds  = $_POST['nama_mds'];
            $jumlah     = $_POST['stok'];
            $selSto =mysqli_query($koneksi, "SELECT * FROM tb_out WHERE id='$id_barang'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['stok'];
        //menghitung sisa stok
        $sisa    =$stok+$jumlah;

            $ambil=mysqli_query($koneksi, "UPDATE tb_beli
            SET id_barang='$id_barang',kode_mds='$kode_mds', nama_mds='$nama_mds', stok='$jumlah'
            WHERE id='$id'") or die(mysqli_error($koneksi));

           if($ambil){
                    //update stok
                    $upstok= mysqli_query($koneksi, "UPDATE tb_out SET stok='$sisa' WHERE id_barang='$id_barang'");
                    ?>
                    <script language="JavaScript">
                        alert('Good! Transaksi Berhasil ...');
                        document.location='../databeli.php';
                    </script>
                    <?php
                }
                else {
                    echo "<div><b>Oops!</b> 404 Error Server.</div>";
                }
        }
    ?>
