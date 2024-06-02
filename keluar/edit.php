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
    $id = $_GET['id'];
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_pembelian WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    $jenis_obat=$data['jenis_obat'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Obat Keluar</title>
    <link rel="stylesheet" type="text/css" href="../asset/editobatkeluar.css">
</head>
<body style="background-image: url(../BG.png)">
        <div class="edit">
            <h2>
                Edit Data Obat Keluar
            </h2>
            <div>
                <form action="" method="POST" class="">
                    <td>Seri Obat</td>
                    <td>
                          <?php
                        $selBar    =mysqli_query($koneksi, "SELECT * FROM tb_barang ORDER BY nama_obat");
                        echo '<select name="id_obat" required>';
                        echo '<option value="'.$data['id_obat'].'">'.$data['nama_obat'].'_'.$data['produsen'].'</option>';
                        while ($rowbar = mysqli_fetch_array($selBar)) {
                        echo '<option value="'.$rowbar['id'].'">'.$rowbar['nama_obat'].'_'.$rowbar['produsen'].'</option>';
                        }
                        echo '</select>';
                        ?>
                    </td>
                    <div class="">
                        <label for="nama">Kode Jual</label>
                        <input type="text" name="kode_jual" value="<?php echo $data['kode_jual'] ?>" readonly>
                    </div>
                    <div class="">
                       <label>Nama Obat</label> <br>
                    <?php
                        $selBar    =mysqli_query($koneksi, "SELECT * FROM tb_barang ORDER BY nama_obat");
                        echo '<select name="nama_obat" required>';
                        echo '<option value="'.$data['nama_obat'].'">'.$data['nama_obat'].'</option>';
                        while ($rowbar = mysqli_fetch_array($selBar)) {
                        echo '<option value="'.$rowbar['nama_obat'].'">'.$rowbar['nama_obat'].'</option>';
                        }
                         echo '</select>';
                        ?>
                    </div>
                     <label>Produsen</label> <br>
                    <?php
                        $selBar    =mysqli_query($koneksi, "SELECT * FROM tb_barang ORDER BY nama_obat");
                        echo '<select name="produsen" required>';
                        echo '<option value="'.$data['produsen'].'">'.$data['produsen'].'</option>';
                        while ($rowbar = mysqli_fetch_array($selBar)) {
                        echo '<option value="'.$rowbar['produsen'].'">'.$rowbar['nama_obat'].'_'.$rowbar['produsen'].'</option>';
                        }
                         echo '</select>';
                        ?>
                    </div>
                     <div class="">
                <label>Jenis Obat</label>
                <select class="form-control" name="jenis_obat">
                    <option value="Kapsul" <?php if ($jenis_obat=='Kapsul') {echo "selected";} ?>>Kapsul</option>
                    <option value="Tablet"<?php if ($jenis_obat=='Tablet') {echo "selected";} ?>>Tablet</option>
                    <option value="Cair"<?php if ($jenis_obat=='Cair') {echo "selected";} ?>>Cair</option>
                </select>
                </div>
                     <button type="submit" class="simpan" name="simpan" onclick="return confirm('Inputan Sudah Sesuai?')">Simpan</button>
                    <button type="reset" class="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
  </div>
</body>
</html>
<?php
        if(isset($_POST['simpan']))
        {
            $id_obat=$_POST['id_obat'];
            $kode_jual   = $_POST['kode_jual'];
            $nama_obat  = $_POST['nama_obat'];
            $produsen  = $_POST['produsen'];
            $jenis_obat   = $_POST['jenis_obat'];
            $ambil=mysqli_query($koneksi, "UPDATE tb_pembelian
            SET id_obat='$id_obat', kode_jual='$kode_jual',nama_obat='$nama_obat',produsen='$produsen', jenis_obat='$jenis_obat'
            WHERE id='$id'") or die(mysqli_error($koneksi));

            echo "<script>
        alert('Good! Edit Data Obat Keluar Berhasil :)');
        location = '../obatkeluaradmin.php';
        </script>";
        }
?>
