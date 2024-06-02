<?php  

include "../koneksi.php";
	if (isset($_POST['simpan'])) {
	$id_barang=$_POST["id_barang"];
	$kode_msk=$_POST["kode_msk"];
	$nama_msk=$_POST["nama_msk"];
	$stok=0;

		$insert=mysqli_query($koneksi,"INSERT INTO tb_out(id_barang,
		kode_msk,nama_msk,stok) VALUES('$id_barang','$kode_msk','$nama_msk','$stok') ") or die(mysqli_error($koneksi));
        }
     echo "<script>
		alert('Good! Input Data Alat Keluar Berhasil :)');
		location = '../alatkeluaradmin.php';
		</script>
	";
?>