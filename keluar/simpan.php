<?php  

include "../koneksi.php";
	if (isset($_POST['simpan'])) {
	$id_obat=$_POST["id_obat"];
	$kode_jual=$_POST["kode_jual"];
	$nama_obat=$_POST["nama_obat"];
	$produsen=$_POST["produsen"];
	$stok=0;
	$jenis_obat=$_POST["jenis_obat"];


		$insert=mysqli_query($koneksi,"INSERT INTO tb_pembelian(id_obat,
		kode_jual,nama_obat,produsen,stok,jenis_obat) VALUES('$id_obat','$kode_jual','$nama_obat','$produsen','$stok','$jenis_obat') ") or die(mysqli_error($koneksi));
        }
     echo "<script>
		alert('Good! Input Data Obat Keluar Berhasil :)');
		location = '../obatkeluaradmin.php';
		</script>
	";
?>