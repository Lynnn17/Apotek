<?php
 include "../koneksi.php";
	if (isset($_POST['simpan']))
	 {
	$username=$_POST["username"];
	$password=$_POST["password"];
	$nama=$_POST["nama"];
	$alamat=$_POST["alamat"];
	$no_hp=$_POST["no_hp"];
	$tgl_lahir=$_POST["tgl_lahir"];
	$jk=$_POST["jk"];
	$level=$_POST["level"];

		$insert=mysqli_query($koneksi,"INSERT INTO tb_user(username,password,nama,alamat,no_hp,tgl_lahir,jk,level) VALUES('$username','$password','$nama','$alamat','$no_hp','$tgl_lahir','$jk','$level') ") or die(mysqli_error($koneksi));
        }
     echo "<script>
		alert('Good! Input Data Pengguna Berhasil :)');
		location = '../daftarpenggunaadmin.php';
		</script>
	";
?>