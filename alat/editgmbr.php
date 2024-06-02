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
    <title>Edit Gambar Alat Medis</title>
     <link rel="stylesheet" type="text/css" href="../asset/editgmbr.css">
</head>
<body style="background-image: url('../BG.png')">
  <div class="edit">
            <h2>
                Edit Gambar Alat Medis
            </h2>
            <div>
                <form action="" method="POST" class="" enctype="multipart/form-data">
                    <div class="">
                        <label for="nama">Kode Alat </label>
                        <input type="text" name="kode_mds" value="<?php echo $data['kode_mds'] ?>" readonly>
                    </div>
                    <div class="">
                        <label>Nama Alat</label>
                        <input type="" maxlength="25" name="nama_mds" value="<?php echo $data['nama_mds'] ?>" placeholder="Masukkan Obat" readonly>
                    </div>

                    <div class="">
                        <label>Harga</label>
                        <input type="" name="harga" value="<?php echo $data['harga'] ?>" xplaceholder="Masukkan Tanggal" readonly>
                    </div>
                    <div class="">
                        <label>Stok</label>
                        <input type="number" min="0" name="stok" value="<?php echo $data['stok'] ?>"  placeholder="Masukkan stok" readonly>
                    </div>
                <td>Gambar</td>
                <td><input type="file" name="gambar"></td>
                    <button type="submit" class="simpan" name="simpan" onclick="return confirm('Inputan Sudah Sesuai?')">Simpan</button>
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
            $nama_file=$_FILES["gambar"]["name"];
    $ukuran_gambar = $_FILES['gambar']['size'];
    $source=$_FILES["gambar"]["tmp_name"];
    $folder='./gambar/';
     $fileinfo = @getimagesize($_FILES["gambar"]["tmp_name"]);
        //lebar gambar
        $width = $fileinfo[0];
        //tinggi gambar
        $height = $fileinfo[1];
    if($ukuran_gambar >80000000){
              ?>
        <script language="JavaScript">
            alert('Oops! Ukuran File 80Kb ...');
            document.location='tambah.php';
        </script>
        <?php
        }else if ($width > "10000000" || $height > "100000") {
            ?>
        <script language="JavaScript">
            alert('Oops! Ukuran Panjang Dan Lebar Terlalu Besar ...');
            document.location='tambah.php';
        </script>
        <?php
        }else{
            if(move_uploaded_file($source, $folder.$nama_file)); {


            $ambil=mysqli_query($koneksi, "UPDATE tb_medis
            SET kode_mds='$kode_mds',nama_mds='$nama_mds',harga='$harga', stok='$stok',file='$nama_file'
            WHERE id='$id'") or die(mysqli_error($koneksi));
              echo "<script>
        alert('Good! Edit Gambar Alat Medis Berhasil :)');
        location = '../daftaralatadmin.php';
        </script>
    ";
        }
        }
}
?>
