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
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_medis WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Daftar Alat Medis</title>
     <link rel="stylesheet" type="text/css" href="../asset/editalat.css">
</head>
<body style="background-image: url('../BG.png')">
    <div class="edit">
            <h2>
                Edit Daftar Alat Medis
            </h2>
            <div>
                <form action="" method="POST" class="">
                    <div class="">
                        <label for="nama">Kode Alat </label>
                        <input type="text" name="kode_mds" value="<?php echo $data['kode_mds'] ?>" readonly>
                    </div>
                    <div class="">
                        <label>Nama Alat</label>
                        <input type="" maxlength="25" name="nama_mds" value="<?php echo $data['nama_mds'] ?>" placeholder="Masukkan Obat" required>
                    </div>

                    <div class="">
                        <label>Harga</label>
                        <input type="" name="harga" value="<?php echo $data['harga'] ?>" xplaceholder="Masukkan Tanggal" required>
                    </div>
                    <div class="">
                        <label>Stok</label>
                        <input type="number" min="0" name="stok" value="<?php echo $data['stok'] ?>"  placeholder="Masukkan stok">
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
            $kode_mds    = $_POST['kode_mds'];
            $nama_mds  = $_POST['nama_mds'];
            $harga     = $_POST['harga'];
            $stok     = $_POST['stok'];


            $ambil=mysqli_query($koneksi, "UPDATE tb_medis
            SET kode_mds='$kode_mds',nama_mds='$nama_mds',harga='$harga', stok='$stok'
            WHERE id='$id'") or die(mysqli_error($koneksi));
              echo "<script>
        alert('Good! Edit Daftar Alat Medis Berhasil :)');
        location = '../daftaralatadmin.php';
        </script>
    ";
        }
?>
