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
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    $jenis_obat=$data['jenis_obat']
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Daftar Obat</title>
     <link rel="stylesheet" type="text/css" href="../asset/editobatmasuk.css">
</head>
<body style="background-image: url('../BG.png')">
      <div class="edit">
            <h2>
                Edit Daftar Obat
            </h2>
            <div>
                <form action="" method="POST" class="">
                    <div class="">
                        <label for="nama">Kode Obat </label>
                        <input type="text" name="kode_obat" value="<?php echo $data['kode_obat'] ?>" readonly>
                    </div>
                    <div class="">
                        <label>Nama Obat</label>
                        <input type="" maxlength="25" name="nama_obat" value="<?php echo $data['nama_obat'] ?>" placeholder="Masukkan Obat" required>
                    </div>
                    <div>
                     <label>Nama Produsen</label>
                    <input type="" maxlength="20" name="produsen" value="<?php echo $data['produsen'] ?>" style="display: block;" placeholder="Nama Produsen..." required>
                    </div>
                    <div class="">
                        <label>Harga</label>
                        <input type="" name="harga" value="<?php echo $data['harga'] ?>" xplaceholder="Masukkan Tanggal" required>
                    </div>
                    <div class="">
                        <label>Stok</label>
                        <input type="number" min="0" name="stok" value="<?php echo $data['stok'] ?>"  placeholder="Masukkan stok">
                    </div>
                     <div class="">
                <label>Jenis Obat</label>
                <select class="form-control" name="jenis_obat">
                    <option value="Kapsul" <?php if ($jenis_obat=='Kapsul') {echo "selected";} ?>>Kapsul</option>
                    <option value="Tablet"<?php if ($jenis_obat=='Tablet') {echo "selected";} ?>>Tablet</option>
                    <option value="Cair"<?php if ($jenis_obat=='Cair') {echo "selected";} ?>>Cair</option>
                </select>
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
            $kode_obat    = $_POST['kode_obat'];
            $nama_obat  = $_POST['nama_obat'];
            $produsen  = $_POST['produsen'];
            $harga     = $_POST['harga'];
            $stok     = $_POST['stok'];
            $jenis_obat   = $_POST['jenis_obat'];
            $ambil=mysqli_query($koneksi, "UPDATE tb_barang
            SET kode_obat='$kode_obat',nama_obat='$nama_obat',produsen='$produsen',harga='$harga', stok='$stok', jenis_obat='$jenis_obat'
            WHERE id='$id'") or die(mysqli_error($koneksi));
            echo "<script>
        alert('Edit Daftar Obat Berhasil :)');
        location = '../daftarobatadmin.php';
        </script>";
        }
?>
