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
                        alert('Anda Tidak Mempunyai Akses Dihalaman Ini!');
                        document.location='../dashboard.php';
                    </script>
                    <?php
                };
    $query = mysqli_query($koneksi, "SELECT max(kode_dstr) as kodeTerbesar FROM tb_dstr");
     $data=mysqli_fetch_array($query);
     $kode_dstr = $data['kodeTerbesar'];
     $urutan= (int) substr($kode_dstr,3,3);
     $urutan++;
    $huruf = "DTR";
  $kode_dstr = $huruf . sprintf("%03s",$urutan);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Tambah Data Distributor</title>
  <link rel="stylesheet" type="text/css" href="../asset/tambahdatadstr.css">
</head>
<body style="background-image: url(../BG.png);">
  <?php
 $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_masuk WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    $jenis_obat=$data['jenis_obat'];
    ?>
  <div>
    <form action="simpan.php" method="post" class="tambah">
      <h2>Tambah Data Distributor</h2>
        <label>Kode Distributor</label>
        <input type="" name="kode_dstr" style="display: block;" value="<?php echo $kode_dstr; ?> " placeholder="Kode Obat..." readonly>
        <label>Nama DIstributor</label>
        <input type="" name="nama_dstr" maxlength="20" style="display: block;" placeholder="Nama Distributor">
        <label>Alamat</label>
        <input type="" name="alamat" maxlength="55" style="display: block;" placeholder="Alamat">
        <label>No Hp</label>
        <input type="" min="" name="no_hp" maxlength="12" style="display: block;" placeholder="No Hp">
       <button type="submit" class="simpan" name="simpan"onclick="return confirm('Inputan Sudah Sesuai??')">Simpan</button>
    </form>
  </div>
</body>
</html>
