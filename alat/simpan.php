<?php
include "../koneksi.php";
    if (isset($_POST['simpan'])) {
    $kode_mds=$_POST["kode_mds"];
    $nama_mds=$_POST["nama_mds"];
    $stok=$_POST["stok"];
    $harga=$_POST["harga"];
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
        }else if ($width > "10000000" || $height > "100000") { 
            ?>
        <script language="JavaScript">
            alert('Oops! Ukuran Panjang Dan Lebar Terlalu Besar ...');
            document.location='tambah.php';
        </script>
        <?php
        }else{
            if(move_uploaded_file($source, $folder.$nama_file)); {
 
        $insert=mysqli_query($koneksi,"INSERT INTO tb_medis(kode_mds,nama_mds,stok,harga,file) VALUES('$kode_mds','$nama_mds','$stok','$harga','$nama_file') ") or die(mysqli_error($koneksi));  
         echo "<script>
		alert('Good! Menambah Daftar Alat Medis Berhasil :)');
		location = '../daftaralatadmin.php';
		</script>
	";
}
}
}
?>