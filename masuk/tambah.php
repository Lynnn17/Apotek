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

    $query = mysqli_query($koneksi, "SELECT max(kode_obat) as kodeTerbesar FROM tb_masuk");
     $data=mysqli_fetch_array($query);
     $kode_obat = $data['kodeTerbesar'];
     $urutan= (int) substr($kode_obat,3,3);
     $urutan++;
    $huruf = "MSK";
    $kode_obat = $huruf . sprintf("%03s",$urutan);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Obat Masuk</title>
    <link rel="stylesheet" type="text/css" href="../asset/tambahdataobatmasuk.css">
</head>
<body style="background-image: url(../BG.png);">
    <div>
        <form action="simpan.php" method="post" class="tambah">
            <h2>Tambah Data Obat Masuk</h2>   
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
    </select> <br>
            <label>Kode Obat</label>
                <input type="" name="kode_obat" style="display: block;" value="<?php echo $kode_obat; ?> " placeholder="Kode Obat..." readonly>
                <label>Nama Obat</label> <br>
                <input type=""  name="nama_obat" id="nama_obat" style="display: block;" placeholder="Nama Obat" readonly>
                <label>Produsen</label> <br>
                <input type=""  name="produsen" id="produsen" style="display: block;" placeholder="Nama Produsen" readonly>
                <label>Harga</label>
                <input type="" name="harga" style="display: block;" placeholder="Harga..." required>
                <label>Stok</label>
                <input type="number" min="1" name="stok" style="display: block;" placeholder="Jumlah..." required>
                <label>Jenis Obat</label> <br>
                <input type=""  name="jenis_obat" id="jenis_obat" style="display: block;" placeholder="Jenis Obat" readonly>
                <label>Tanggal Masuk</label> <br>
                <input type="date" name="tgl_masuk" placeholder="Masukkan Tanggal" required> <br>
             <button  type="submit" class="simpan" name="simpan" onclick="return confirm('Inputan Sudah Sesuai?')">Simpan</button>
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
