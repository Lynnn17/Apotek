<?php
include "../koneksi.php";
$id = $_GET['id'];
$sql= "DELETE FROM tb_pembelian where id='$id'";
$execute=mysqli_query($koneksi,$sql);
 ?>
 <script type="text/javascript">
 	 alert('Good! Menghapus Obat Keluar Berhasil ...');
        window.location.href="../obatkeluaradmin.php";
</script>