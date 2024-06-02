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

    $query = mysqli_query($koneksi, "SELECT max(kode_jual) as kodeTerbesar FROM tb_pembelian");
     $data=mysqli_fetch_array($query);
     $kode_jual = $data['kodeTerbesar'];
     $urutan= (int) substr($kode_jual,3,3);
     $urutan++;
    $huruf = "JUL";
    $kode_jual = $huruf . sprintf("%03s",$urutan);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Obat Keluar</title>
    <link rel="stylesheet" type="text/css" href="../asset/tambahdataobatkeluar.css">
</head>
<body style="background-image: url(../BG.png);">
    <div>
        <form action="simpan.php" method="post" class="tambah">
            <h2>Tambah Data Obat Keluar</h2>
            <label>Seri Obat</label> <br>
  <select onchange="cek_database()" name="id_obat" id="id">
    <option value='' selected required>- Pilih -</option>
    <?php
        include "../koneksi.php";
        $karyawan = mysqli_query($koneksi,"SELECT * FROM tb_barang");
        while ($row = mysqli_fetch_array($karyawan)) {
            echo "<option value='$row[id]'>$row[nama_obat]_$row[produsen]</option>";
        }
    ?>
    </select>
                <label>Kode Jual</label>
                <input type="" name="kode_jual" style="display: block;" value="<?php echo $kode_jual;?>"  placeholder="Kode Jual..." readonly>
                <label>Nama Obat</label> <br>
                <input type=""  name="nama_obat" id="nama_obat" style="display: block;" placeholder="Nama Obat" readonly>
                <label>Produsen</label> <br>
                <input type=""  name="produsen" id="produsen" style="display: block;" placeholder="Nama Produsen" readonly>
                <label>Jenis Obat</label>
                <input type=""  name="jenis_obat" id="jenis_obat" style="display: block;" placeholder="Jenis Obat" readonly>
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
                    success: function (obat) {
                        $("#nama_obat").val(obat['nama_obat']);
                        $("#produsen").val(obat['produsen']);
                        $("#jenis_obat").val(obat['jenis_obat']);
                                  
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
