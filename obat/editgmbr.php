<?php
    include "../koneksi.php";
     session_start();
    if (!isset($_SESSION['username'])) {
    ?>
                    <script language="JavaScript">
                        alert('Anda Harus Login Terlebih Dahulu!!');
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
    <title>Edit Gambar Obat</title>
     <link rel="stylesheet" type="text/css" href="../asset/editgmbr.css">
</head>
<body style="background-image: url('../BG.png')">
      <div class="edit">
            <h2>
                Edit Gambar Obat
            </h2>
            <div>
                <form action="" method="POST" class=""  enctype="multipart/form-data">
                    <div class="">
                        <label for="nama">Kode Obat </label>
                        <input type="text" name="kode_obat" value="<?php echo $data['kode_obat'] ?>" readonly>
                    </div>
                    <div class="">
                        <label>Nama Obat</label>
                        <input type="" maxlength="25" name="nama_obat" value="<?php echo $data['nama_obat'] ?>" placeholder="Masukkan Obat" readonly >
                    </div>
                    <div>
                     <label>Nama Prodesen</label>
                    <input type="" maxlength="20" name="nama_prds" style="display: block;" value="<?php echo $data['produsen'] ?>" placeholder="Nama Produsen..." readonly>
                    </div>
                    <div class="">
                        <label>Harga</label>
                        <input type="" name="harga" value="<?php echo $data['harga'] ?>" xplaceholder="Masukkan Tanggal" readonly>
                    </div>
                    <div class="">
                        <label>Stok</label>
                        <input type="number" min="0" name="stok" value="<?php echo $data['stok'] ?>"  placeholder="Masukkan stok" readonly>
                    </div>
                     <div class="">
                <label>Jenis Obat</label>
                <input type="" name="jenis_obat" value="<?php echo $data['jenis_obat'] ?>" readonly>
                </div>
                <div>
                <label>Gambar</label>
                <td><input type="file" name="gambar" required></td>
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
            $harga     = $_POST['harga'];
            $stok     = $_POST['stok'];
            $jenis_obat   = $_POST['jenis_obat'];
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

            $ambil=mysqli_query($koneksi, "UPDATE tb_barang
            SET kode_obat='$kode_obat',nama_obat='$nama_obat',harga='$harga', stok='$stok', jenis_obat='$jenis_obat',file='$nama_file'
            WHERE id='$id'") or die(mysqli_error($koneksi));
            echo "<script>

        alert('Edit Gambar Obat Berhasil :)');
        location = '../daftarobatadmin.php';
        </script>";
        }
    }
}
?>
