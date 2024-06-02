<?php
include "../koneksi.php";
        if(isset($_POST['simpan']))
        {
            $id_barang      =$_POST['id_barang'];
            $kode_msk    = $_POST['kode_msk'];
            $nama_msk  = $_POST['nama_msk'];
            $harga  = $_POST['harga'];
            $jumlah = $_POST['stok'];
            $tgl_masuk       = $_POST['tgl_masuk'];
            
            $selSto =mysqli_query($koneksi, "SELECT * FROM tb_medis WHERE id='$id_barang'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['stok'];
        //menghitung sisa stok
        $sisa    =$stok+$jumlah;
            $ambil=mysqli_query($koneksi,"INSERT INTO tb_in(id_barang,kode_msk,nama_msk,harga,stok,tgl_masuk) VALUES('$id_barang','$kode_msk','$nama_msk','$harga','$jumlah','$tgl_masuk') ");

           if($ambil){
                    //update stok
                    $upstok= mysqli_query($koneksi, "UPDATE tb_medis SET stok='$sisa' WHERE id='$id_barang'");
                    ?>
                    <script language="JavaScript">
                        alert('Good! Menambah Data Alat Medis Masuk Berhasil ...');
                        document.location='../alatmasukadmin.php';
                    </script>
                    <?php
                }
                else {
                    echo "<div><b>Oops!</b> 404 Error Server.</div>";
                }
        }
    ?>