<?php
include "../koneksi.php";
$id = $_GET['id'];
$sql= "DELETE FROM tb_medis where id='$id'";
$execute=mysqli_query($koneksi,$sql);
 ?>
 <script type="text/javascript">
 	 alert('Good! Menghapus Daftar Alat Medis Berhasil ...');
        window.location.href="../daftaralatadmin.php";
</script>