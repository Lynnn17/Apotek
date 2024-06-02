<?php
include "../koneksi.php";
$id = $_GET['id'];
$sql= "DELETE FROM tb_barang where id='$id'";
$execute=mysqli_query($koneksi,$sql);
 ?>
 <script type="text/javascript">
 	 alert('Good! Menghapus Daftar Obat Berhasil ...');
        window.location.href="../daftarobatadmin.php";
</script>