<?php error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
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

    $query = mysqli_query($koneksi, "SELECT max(kode_msk) as kodeTerbesar FROM tb_out");
     $data=mysqli_fetch_array($query);
     $kode_msk = $data['kodeTerbesar'];
     $urutan= (int) substr($kode_msk,3,3);
     $urutan++;
    $huruf = "JUL";
    $kode_msk = $huruf . sprintf("%03s",$urutan);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Alat Keluar</title>
    <link rel="stylesheet" type="text/css" href="../asset/tambahdataalatkeluar.css">
</head>
<body style="background-image: url(../BG.png);">
    <?php
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_out WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    ?>
    <div>
        <form action="simpan.php" method="post" class="tambah">
            <h2>Tambah Data Alat Keluar</h2>
             <label>Seri Alat</label> <br>
    <select onchange="cek_database()" name="id_barang" id="id">
    <option value='' selected required>- Pilih -</option>
    <?php
        include "../koneksi.php";
        $karyawan = mysqli_query($koneksi,"SELECT * FROM tb_medis");
        while ($row = mysqli_fetch_array($karyawan)) {
            echo "<option value='$row[id]'>$row[nama_mds]</option>";
        }
    ?>
    </select>
                <label>Kode Jual</label>
                <input type="" name="kode_msk" style="display: block;" value="<?php echo $kode_msk;?>"  placeholder="Kode Jual..." readonly>
                <label>Nama Alat</label> <br>
                 <input type=""  name="nama_msk" id="nama_mds" style="display: block;" placeholder="Nama Alat Medis" readonly>
             <button type="submit" class="simpan" name="simpan" onclick="return confirm('Inputan Sudah Sesuai??')">Simpan</button>
        </form>
        <script src="jquery-1.7.2.min.js"></script>
<script>
        $(function() {
            $("#id").change(function(){    
                var id = $("#id").val();

                $.ajax({
                    url: 'ajax.php',    
                    type: 'POST',           
                    dataType: 'json',
                    data: {
                        'id': id            
                    },
                    success: function (medis) {
                        $("#nama_mds").val(medis['nama_mds']);
                                  
                    }
                });
            });
            $("form").submit(function(){     //mengirim data id yang telah di post
                
            });
            });
            </script>
    </div>
</body>
</html>
