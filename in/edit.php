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
    <title>Edit Data Alat Medis</title>
    <link rel="stylesheet" type="text/css" href="../asset/editobatmasuk.css">
</head>
<body style="background-image: url(../BG.png)">
        <div class="edit">
            <h2>
                Edit Data Alat Medis
            </h2>
            <div>
                <form action="" method="POST" class="">
                    <td>Seri Alat</td>
                    <td>
                          <?php
                        $selBar    =mysqli_query($koneksi, "SELECT * FROM tb_medis ORDER BY nama_mds");
                        echo '<select name="id_barang" required>';
                        echo '<option value="'.$data['id_barang'].'">'.$data['nama_msk'].'_'.$data['kode_msk'].'</option>';
                        while ($rowbar = mysqli_fetch_array($selBar)) {
                        echo '<option value="'.$rowbar['id'].'">'.$rowbar['nama_mds'].'_'.$rowbar['kode_mds'].'</option>';
                        }
                        echo '</select>';
                        ?>
                    </td>
                    <div class="">
                        <label for="nama">Kode Alat</label>
                        <input type="text" required name="kode_msk" value="<?php echo $data['kode_msk'] ?>"  placeholder="Masukkan Kode Masuk" readonly >
                    </div>
                    <div class="">
                      <label>Nama Alat</label> <br>
                    <td>
                          <?php
                        $selBar    =mysqli_query($koneksi, "SELECT * FROM tb_medis ORDER BY nama_mds");
                        echo '<select name="nama_msk" required>';
                        echo '<option value="'.$data['nama_msk'].'">'.$data['nama_msk'].'</option>';
                        while ($rowbar = mysqli_fetch_array($selBar)) {
                        echo '<option value="'.$rowbar['nama_mds'].'">'.$rowbar['nama_mds'].'</option>';
                        }
                        echo '</select>';
                        ?>
                    </td>
                    </div>
                <div>
                    <label>Harga</label>
                <input type="" name="harga" required style="display: block;" value="<?php echo $data['harga'] ?>" placeholder="Harga...">
                    </div>
                    <div class="">
                        <label>Tanggal Masuk</label>
                        <input type="date" name="tgl_masuk" value="<?php echo $data['tgl_masuk'] ?>" xplaceholder="Masukkan Tanggal" required>
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
           $id_barang       =$_POST['id_barang'];
            $kode_msk    = $_POST['kode_msk'];
            $nama_msk  = $_POST['nama_msk'];
            $stok  = $data['stok'];
           $harga   = $_POST['harga'];
            $tgl_masuk       = $_POST['tgl_masuk'];

           $ambil=mysqli_query($koneksi, "UPDATE tb_in
            SET id_barang='$id_barang',kode_msk='$kode_msk', nama_msk='$nama_msk', stok='$stok',harga='$harga', tgl_masuk='$tgl_masuk'
            WHERE id='$id'") or die(mysqli_error($koneksi));

                  ?>
                   <script language="JavaScript">
                        alert('Good! Edit Data Alat Medis Masuk Berhasil :)');
                        document.location='../alatmasukadmin.php';
                    </script>
                   <?php
                    }
                   ?>
