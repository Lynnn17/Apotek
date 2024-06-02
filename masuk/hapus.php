<?php
include "../koneksi.php";
$id = $_GET['id'];
$sql= "DELETE FROM tb_masuk where id='$id'";
$execute=mysqli_query($koneksi,$sql);
 ?>
 <script type="text/javascript">
 	 alert('Good! Menghapus Data Obat Masuk Berhasil ...');
        window.location.href="../obatmasukadmin.php";
</script>