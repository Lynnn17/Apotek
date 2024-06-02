<?php
include '../koneksi.php';
$id=@$_POST['id'];  //menangkap id yang disubmit

//memilih semua data di tabel buku sesuai dengan id yang disubmit
$query = mysqli_query($koneksi, "select * from tb_medis where id='$id'");
$data = mysqli_fetch_array($query);

echo json_encode($data); //menampilkan data json

?>