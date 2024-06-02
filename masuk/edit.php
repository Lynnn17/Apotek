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
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_masuk WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    $jenis_obat=$data['jenis_obat'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Obat Masuk</title>
    <link rel="stylesheet" type="text/css" href="../asset/editobatmasuk.css">
</head>
<body style="background-image: url(../BG.png)">
        <div class="edit">
            <h2>
                Edit Data Obat Masuk
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
                        <label for="nama">Kode Masuk</label>
                        <input type="text" required name="kode_obat" value="<?php echo $data['kode_obat'] ?>"  placeholder="Masukkan Kode Masuk" readonly >
                    </div>
                    <div class="">
                      <label>Nama Obat</label> <br>
                <td>
                          <?php
                        $selBar    =mysqli_query($koneksi, "SELECT * FROM tb_barang ORDER BY nama_obat");
                        echo '<select name="nama_obat" required>';
                        echo '<option value="'.$data['nama_obat'].'">'.$data['nama_obat'].'</option>';
                        while ($rowbar = mysqli_fetch_array($selBar)) {
                        echo '<option value="'.$rowbar['nama_obat'].'">'.$rowbar['nama_obat'].'</option>';
                        }
                        echo '</select>';
                        ?>
                    </td>
                    </div>
                    <div class="">
                      <label>Produsen</label> <br>
                <td>
                          <?php
                        $selBar    =mysqli_query($koneksi, "SELECT * FROM tb_barang ORDER BY nama_obat");
                        echo '<select name="produsen" required>';
                        echo '<option value="'.$data['produsen'].'">'.$data['produsen'].'</option>';
                        while ($rowbar = mysqli_fetch_array($selBar)) {
                        echo '<option value="'.$rowbar['produsen'].'">'.$rowbar['produsen'].'</option>';
                        }
                        echo '</select>';
                        ?>
                    </td>
                    </div>
                    <div class="">
                        <label>Tanggal Masuk</label>
                        <input type="date" name="tgl_masuk" value="<?php echo $data['tgl_masuk'] ?>" xplaceholder="Masukkan Tanggal" required>
                    </div>
                     <div class="">
                <label>Jenis Obat</label>
                <select class="form-control" name="jenis_obat">
                    <option value="Kapsul" <?php if ($jenis_obat=='Kapsul') {echo "selected";} ?>>Kapsul</option>
                    <option value="Tablet"<?php if ($jenis_obat=='Tablet') {echo "selected";} ?>>Tablet</option>
                    <option value="Cair"<?php if ($jenis_obat=='Cair') {echo "selected";} ?>>Cair</option>
                </select>
                </div>
                    <button type="submit" class="simpan" name="simpan" onclick="return confirm('Inputan Sudah Sesuai??')">Simpan</button>
                    <button type="reset" class="reset">Reset</button>
                </form>
          </div>
      </div>
    </div>
</body>
</html>
<?php
        if(isset($_POST['simpan']))
        {
            $id_obat    = $_POST['id_obat'];
            $kode_obat    = $_POST['kode_obat'];
            $nama_obat  = $_POST['nama_obat'];
            $produsen  = $_POST['produsen'];
            $tgl_masuk       = $_POST['tgl_masuk'];
            $jenis_obat   = $_POST['jenis_obat'];
            $ambil=mysqli_query($koneksi, "UPDATE tb_masuk
            SET id_obat='$id_obat', kode_obat='$kode_obat', nama_obat='$nama_obat', produsen='$produsen', tgl_masuk='$tgl_masuk', jenis_obat='$jenis_obat'
            WHERE id='$id'") or die(mysqli_error($koneksi));
                  ?>
                   <script language="JavaScript">
                        alert('Good! Edit Data Obat Masuk Berhasil :)');
                        document.location='../obatmasukadmin.php';
                    </script>
                   <?php
                    }
                   ?>
