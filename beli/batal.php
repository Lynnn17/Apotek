<?php
    include "../koneksi.php";
    session_start();
if (!isset($_SESSION['username'])) {
    ?>
                    <script language="JavaScript">
                        alert('Anda Harus Login  Terlebih Dahulu!!');
                        document.location='index.php';
                    </script>
                    <?php
                }
                if ($_SESSION['level']=="Admin"){
                ?>
                    <script language="JavaScript">
                        alert('Anda Tidak Mempunyai Akses Dihalaman Ini!!');
                        document.location='../dashboardadmin.php';
                    </script>
                    <?php
                };
    $id = $_GET['id'];  
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_beli WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
?>
<?php

            $id_barang       =$data['id_barang'];
            $kode_mds    = $data['kode_mds'];
            $nama_mds  = $data['nama_mds'];
            $jumlah     = $data['stok'];
            $selSto =mysqli_query($koneksi, "SELECT * FROM tb_medis WHERE id='$id_barang'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['stok'];
        //menghitung sisa stok
        $sisa    =$stok+$jumlah;

            $ambil=mysqli_query($koneksi,"DELETE FROM tb_beli where id='$id'") or die(mysqli_error($koneksi));

           if($ambil){
                    //update stok
                    $upstok= mysqli_query($koneksi, "UPDATE tb_medis SET stok='$sisa' WHERE id='$id_barang'");
                    ?>
                    <script language="JavaScript">
                        alert('Good! Pembatalan Transaksi Berhasil ...');
                        document.location='../databeli.php';
                    </script>
                    <?php
                }
                else {
                    echo "<div><b>Oops!</b> 404 Error Server.</div>";
                }
    ?>