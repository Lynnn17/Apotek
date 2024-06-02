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
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_user");
    $data=mysqli_fetch_array($ambilData);
    $jk=$data['jk'];
    $level=$data['level'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Pengguna</title>
	<link rel="stylesheet" type="text/css" href="../asset/tambahdatauser.css">
</head>
<body style="background-image: url(../BG.png);">
	<div>
		<form action="simpan.php" method="POST" class="tambah">
			<h2>Tambah Data Pengguna</h2>
			<label>Username</label>
			<input type="" name="username" maxlength="10" placeholder="Username" required>
			<label>Password</label>
			<input type="" name="password" maxlength="8" placeholder="Password" required>
			<label>Nama</label>
			<input type="" name="nama" maxlength="20" placeholder="Nama" required>
			<label>Alamat</label>
			<input type="" name="alamat" maxlength="55" placeholder="Alamat" required>
			<label>No HP</label>
			<input type="" name="no_hp" maxlength="12" placeholder="No HP" required>
			<label>Tanggal Lahir</label>
			<input type="date" name="tgl_lahir" placeholder="Masukkan Tanggal" required>
			<label>Jenis Kelamin</label>
			<select class="form-control" name="jk" required>
        <option value="Perempuan" <?php if ($jk=='Perempuan') {echo "selected";} ?>>Perempuan</option>
        <option value="Laki-Laki" <?php if ($level=='Laki-Laki') {echo "selected";} ?>>Laki-Laki</option>
      </select>
      <label>Level</label>
			<select class="form-control" name="level" required>
        <option value="User" <?php if ($level=='User') {echo "selected";} ?>>User</option>
        <option value="Admin" <?php if ($level=='Admin') {echo "selected";} ?>>Admin</option>
      </select>
			<button  type="submit" class="simpan" name="simpan "onclick="return confirm('Inputan Sudah Sesuai?')">Simpan</button>
		</form>
	</div>

</body>
</html>
