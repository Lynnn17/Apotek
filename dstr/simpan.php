<?php  

include "../koneksi.php";
	if (isset($_POST['simpan'])) {
	$kode_dstr=$_POST["kode_dstr"];
	$nama_dstr=$_POST["nama_dstr"];
	$alamat=$_POST["alamat"];
	$no_hp=$_POST["no_hp"];


		$insert=mysqli_query($koneksi,"INSERT INTO tb_dstr(kode_dstr,nama_dstr,alamat,no_hp) VALUES('$kode_dstr','$nama_dstr','$alamat','$no_hp') ") or die(mysqli_error($koneksi));
        }
     echo "<script>
		alert('Good! Input Data Distributor Berhasil :)');
		location = '../distributoradmin.php';
		</script>
	";
?>