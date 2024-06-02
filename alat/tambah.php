<?php error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
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
    $query = mysqli_query($koneksi, "SELECT max(kode_mds) as kodeTerbesar FROM tb_medis");
     $data=mysqli_fetch_array($query);
     $kode_msk = $data['kodeTerbesar'];
     $urutan= (int) substr($kode_msk,3,3);
     $urutan++;
    $huruf = "ALT";
    $kode_msk = $huruf . sprintf("%03s",$urutan);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Daftar Alat Medis</title>
    <link rel="stylesheet" type="text/css" href="../asset/tambahalat.css">
</head>
<body style="background-image: url(../BG.png);">
    <?php
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_medis WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    ?>
    <div>
        <form action="simpan.php" method="post" class="tambah" enctype="multipart/form-data">
            <h2>Tambah Data Alat Medis</h2>
            <label>Kode Alat</label>
                <input type="" name="kode_mds" style="display: block;" value="<?php echo $kode_msk; ?>" placeholder="Kode Obat..." readonly>
            <label>Nama Alat</label>
                <input type="" maxlength="40" name="nama_mds" style="display: block;" placeholder="Nama Alat..." required>
            <label>Harga</label>
                <input type="" name="harga" required style="display: block;" placeholder="Harga...">
                <label>Stok</label>
                <input type="number" min="0" required name="stok" style="display: block;" placeholder="Stok...">
                <label>Gambar</label>
                <td><input type="file" name="gambar" style="display: block;"></td>
             <button type="submit" class="simpan" name="simpan" onclick="return confirm('Inputan Sudah Sesuai?')">Simpan</button>
        </form>
    </div>
</body>
</html>
