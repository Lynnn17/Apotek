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
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_in WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
?>
<?php
            $id_barang      =$data['id_barang'];
            $kode_msk    = $data['kode_msk'];
            $nama_msk  = $data['nama_msk'];
            $hapus = $data['stok'];
            $harga=$data['harga'];
            $tgl_masuk       = $data['tgl_masuk'];
             $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_in WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    $jmlh=$data['stok'];
    $hasil=$jmlh-$hapus;
            $selSto =mysqli_query($koneksi, "SELECT * FROM tb_medis WHERE id='$id_barang'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['stok'];
        //menghitung sisa stok
        $sisa    =$stok-$hapus;
            if ($stok < $hapus) {
                 ?>
        <script language="JavaScript">
            alert('Oops! Jumlah lebih besar dari stok ...');
            document.location='../alatmasukadmin.php';
        </script>
        <?php
       
    }
        else{

            $ambil=mysqli_query($koneksi,"DELETE FROM tb_in where id='$id'") or die(mysqli_error($koneksi));
           if($ambil){
                    //update stok
                    $upstok= mysqli_query($koneksi, "UPDATE tb_medis SET stok='$sisa' WHERE id='$id_barang'");
                    ?>
                    <script language="JavaScript">
                        alert('Good! Membatalkan Data Alat Medis Masuk Berhasil ...');
                        document.location='../alatmasukadmin.php';
                    </script>
                    <?php
                }
                else {
                    echo "<div><b>Oops!</b> 404 Error Server.</div>";
                }
        }
    ?>