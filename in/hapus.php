<?php
include "../koneksi.php";
$id = $_GET['id'];
$sql= "DELETE FROM tb_in where id='$id'";
$execute=mysqli_query($koneksi,$sql);
 ?>
 <script type="text/javascript">
 	 alert('Good! Menghapus Data Alat Medis Masuk Berhasil ...');
        window.location.href="../alatmasukadmin.php";
</script>