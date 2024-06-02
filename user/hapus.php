<?php 
include "../koneksi.php";
$id = $_GET['id'];
$sql= "DELETE FROM tb_user where id='$id'";
$execute=mysqli_query($koneksi,$sql);
 ?>
 <script type="text/javascript">
 	 alert('Good! Menghapus Data Pengguna Berhasil ...');
		window.location.href="../daftarpenggunaadmin.php";
</script>