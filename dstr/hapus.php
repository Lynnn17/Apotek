<?php 
include "../koneksi.php";
$id = $_GET['id'];
$sql= "DELETE FROM tb_dstr where id='$id'";
$execute=mysqli_query($koneksi,$sql);
 ?>
 <script type="text/javascript">
 		 alert('Good! Menghapus Data Diatributor Berhasil ...');
		window.location.href="../distributoradmin.php";
</script>