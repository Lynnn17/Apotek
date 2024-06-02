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
                if ($_SESSION['level']=="User"){
                ?>
                    <script language="JavaScript">
                        alert('Anda Tidak Mempunyai Akses Dihalaman Ini!!');
                        document.location='../dashboard.php';
                    </script>
                    <?php
                };
    $id= $_GET['id'];
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_out WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
?>
<?php

              $id_barang      =$data['id_barang'];
            $kode_msk    = $data['kode_msk'];
            $nama_msk  = $data['nama_msk'];
            $hapus    = $data['stok'];
            $selSto =mysqli_query($koneksi, "SELECT * FROM tb_medis WHERE id='$id_barang'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['stok'];
        //menghitung sisa stok
        $sisa    =$stok+$hapus;

            $ambil=mysqli_query($koneksi,"DELETE FROM tb_out where id='$id'") or die(mysqli_error($koneksi));
           if($ambil){
                    //update stok
                    $upstok= mysqli_query($koneksi, "UPDATE tb_medis SET stok='$sisa' WHERE id='$id_barang'");
                   ?>
                    <script language="JavaScript">
                        alert('Good! Membatalkan Data Alat Keluar Berhasil ...');
                        document.location='../alatkeluaradmin.php';
                    </script>
                    <?php
                }
                else {
                    echo "<div><b>Oops!</b> 404 Error Server.</div>";
                }
    ?>