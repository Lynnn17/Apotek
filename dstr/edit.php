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
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_dstr WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Distributor</title>
     <link rel="stylesheet" type="text/css" href="../asset/editdstr.css">
</head>
<body style="background-image: url(../BG.png)">
      <div class="edit">
            <h2>
                Edit Data Distributor
            </h2>
            <div>
                <form action="" method="POST" class="">
                    <div class="">
                        <label for="nama">Kode Distributor</label>
                        <input type="text" name="kode_dstr" value="<?php echo $data['kode_dstr'] ?>" readonly>
                    </div>
                    <div class="">
                        <label>Nama Distributor</label>
                        <input type="text" name="nama_dstr" maxlength="20" value="<?php echo $data['nama_dstr'] ?>" placeholder="Masukkan Obat">
                    </div>
                    <div class="">
                        <label>Alamat</label>
                        <input type="" name="alamat" maxlength="55" value="<?php echo $data['alamat'] ?>"  placeholder="Masukkan stok">
                    </div>
                    <div class="">
                        <label>No Hp</label>
                        <input type="" name="no_hp" maxlength="12" value="<?php echo $data['no_hp'] ?>"  placeholder="Masukkan stok">
                    </div>
                     <button type="submit" class="simpan" name="simpan" onclick="return confirm('Inputan Sudah Sesuai??')">Simpan</button>
                    <button type="reset" class="reset">Reset</button>
                </form>
            </div>
        </div>
</body>
</html>

<?php
        if(isset($_POST['simpan']))
        {
            $kode_dstr    = $_POST['kode_dstr'];
            $nama_dstr  = $_POST['nama_dstr'];
            $alamat    = $_POST['alamat'];
            $no_hp      = $_POST['no_hp'];

            $ambil=mysqli_query($koneksi, "UPDATE tb_dstr
            SET kode_dstr='$kode_dstr',nama_dstr='$nama_dstr', alamat='$alamat', no_hp='$no_hp'
            WHERE id='$id'") or die(mysqli_error($koneksi));

            echo "<script>
        alert('Good! Edit Data Distributor Berhasil :)');
        location = '../distributoradmin.php';
        </script>";
        }
?>
