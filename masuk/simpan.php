<?php
include "../koneksi.php";
        if(isset($_POST['simpan']))
        {
            $id_obat       =$_POST['id_obat'];
            $kode_obat    = $_POST['kode_obat'];
            $nama_obat  = $_POST['nama_obat'];
            $produsen  = $_POST['produsen'];
            $harga  = $_POST['harga'];
            $jumlah = $_POST['stok'];
            $tgl_masuk       = $_POST['tgl_masuk'];
            $jenis_obat   = $_POST['jenis_obat'];
            
            $selSto =mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE id='$id_obat'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['stok'];
        //menghitung sisa stok
        $sisa    =$stok+$jumlah;
            $ambil=mysqli_query($koneksi,"INSERT INTO tb_masuk(id_obat,kode_obat,nama_obat,produsen,harga,stok,jenis_obat,tgl_masuk) VALUES('$id_obat','$kode_obat','$nama_obat','$produsen','$harga','$jumlah','$jenis_obat','$tgl_masuk') ");

           if($ambil){
                    //update stok
                    $upstok= mysqli_query($koneksi, "UPDATE tb_barang SET stok='$sisa' WHERE id='$id_obat'");
                    ?>
                    <script language="JavaScript">
                        alert('Good! Berhasi Menambah Data Obat Masuk ...');
                        document.location='../obatmasukadmin.php';
                    </script>
                    <?php
                }
                else {
                    echo "<div><b>Oops!</b> 404 Error Server.</div>";
                }
        }
    ?>