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
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_tuku WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    $jenis_obat=$data['jenis_obat'];
?>
<?php

            $id_obat       =$data['id_obat'];
            $kode_obat    = $data['kode_obat'];
            $nama_obat  = $data['nama_obat'];
            $produsen  = $data['produsen'];
            $jumlah     = $data['stok'];
            $jenis_obat   = $data['jenis_obat'];
            $selSto =mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE id='$id_obat'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['stok'];
        //menghitung sisa stok
        $sisa    =$stok+$jumlah;

            $ambil=mysqli_query($koneksi,"DELETE FROM tb_tuku where id='$id'") or die(mysqli_error($koneksi));

           if($ambil){
                    //update stok
                    $upstok= mysqli_query($koneksi, "UPDATE tb_barang SET stok='$sisa' WHERE id='$id_obat'");
                    ?>
                    <script language="JavaScript">
                        alert('Good! Pembatalan Transaksi Berhasil ...');
                        document.location='../datatransaksi.php';
                    </script>
                    <?php
                }
                else {
                    echo "<div><b>Oops!</b> 404 Error Server.</div>";
                }
    ?>