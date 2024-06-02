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
    $query = mysqli_query($koneksi, "SELECT max(kode_obat) as kodeTerbesar FROM tb_barang");
     $data=mysqli_fetch_array($query);
     $kode_obat = $data['kodeTerbesar'];
     $urutan= (int) substr($kode_obat,3,3);
     $urutan++;
    $huruf = "OBT";
    $kode_obat = $huruf . sprintf("%03s",$urutan);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Daftar Obat</title>
    <link rel="stylesheet" type="text/css" href="../asset/tambahdaftarobat.css">
</head>
<body style="background-image: url(../BG.png);">
    <?php
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    $jenis_obat=$data['jenis_obat'];
    ?>
    <div>
        <form action="simpan.php" method="post" class="tambah" enctype="multipart/form-data">
            <h2>Tambah Data Obat</h2>
            <label>Kode Obat</label>
                <input type="" name="kode_obat" style="display: block;" value="<?php echo $kode_obat; ?>" placeholder="Kode Obat..." readonly>
            <label>Nama Obat</label>
                <input type="" maxlength="25" name="nama_obat" style="display: block;" placeholder="Nama Obat..." required>
            <label>Nama Prodesen</label>
                <input type="" maxlength="20" name="produsen" style="display: block;" placeholder="Nama Produsen..." required>
            <label>Harga</label>
                <input type="" name="harga" required style="display: block;" placeholder="Harga...">
                <label>Stok</label>
                <input type="number" min="0" required name="stok" style="display: block;" placeholder="Stok...">
            <label>Jenis Obat</label>
                <select class="form-control" name="jenis_obat" style="display: block;">
                    <option value="Kapsul" <?php if ($jenis_obat=='Kapsul') {echo "selected";} ?>>Kapsul</option>
                    <option value="Tablet"<?php if ($jenis_obat=='Tablet') {echo "selected";} ?>>Tablet</option>
                    <option value="Cair"<?php if ($jenis_obat=='Cair') {echo "selected";} ?>>Cair</option>
                </select>
                <label>Gambar</label>
                <td><input type="file" name="gambar" style="display: block;"></td>
             <button type="submit" class="simpan" name="simpan" onclick="return confirm('Inputan Sudah Sesuai?')">Simpan</button>
        </form>
    </div>
</body>
</html>
