<?php
include "../koneksi.php";
$id = $_GET['id'];
$sql= "DELETE FROM tb_out where id='$id'";
$execute=mysqli_query($koneksi,$sql);
 ?>
 <script type="text/javascript">
 	 alert('Good! Menghapus Alat Medis Keluar Berhasil ...');
        window.location.href="../alatkeluaradmin.php";
</script>