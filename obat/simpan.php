<?php
include "../koneksi.php";
    if (isset($_POST['simpan'])) {
    $kode_obat=$_POST["kode_obat"];
    $nama_obat=$_POST["nama_obat"];
    $harga=$_POST["harga"];
    $produsen=$_POST['produsen'];
    $stok=$_POST["stok"];
    $jenis_obat=$_POST["jenis_obat"];
    $nama_file=$_FILES["gambar"]["name"];
     $ukuran_gambar = $_FILES['gambar']['size']; 
    $source=$_FILES["gambar"]["tmp_name"];
    $folder='./gambar/';
    $fileinfo = @getimagesize($_FILES["gambar"]["tmp_name"]);
        //lebar gambar
        $width = $fileinfo[0];
        //tinggi gambar
        $height = $fileinfo[1]; 
    if($ukuran_gambar >80000000){ 
              ?>
        <script language="JavaScript">
            alert('Oops! Ukuran File 80Kb ...');
            document.location='tambah.php';
        </script>
        <?php
        }else if ($width > "100000" || $height > "100000") { 
            ?>
        <script language="JavaScript">
            alert('Oops! Ukuran Panjang Dan Lebar Terlalu Besar ...');
            document.location='tambah.php';
        </script>
        <?php
        }else{
            if(move_uploaded_file($source, $folder.$nama_file)); {
 
        $insert=mysqli_query($koneksi,"INSERT INTO tb_barang(kode_obat,nama_obat,produsen,harga,stok,jenis_obat,file) VALUES('$kode_obat','$nama_obat','$produsen','$harga','$stok','$jenis_obat','$nama_file') ") or die(mysqli_error($koneksi));  

       
        } 
        
         echo "<script>
		alert('Good! Menambah Daftar Obat Berhasil :)');
		location = '../daftarobatadmin.php';
		</script>
	";
}
}
?>