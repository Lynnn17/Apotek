<?php
include "koneksi.php";
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
                        document.location='dashboard.php';
                    </script>
                    <?php
                };
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Data Alat Medis Masuk</title>
  <link rel="stylesheet" type="text/css" href="asset/menualatmasuk.css">
</head>
<body style="background-image: url(BG.png)">
  <div class="bingkai">
    <div class="header">
      <label>
        <div id="clock" style="font-size: 20px"></div>
        <script type="text/javascript">
      function currentTime() {
      var date = new Date();
      var hour = date.getHours();
      var min = date.getMinutes();
      var sec = date.getSeconds();
      hour = updateTime(hour);
      min = updateTime(min);
      sec = updateTime(sec);
      document.getElementById("clock").innerText = hour + ":" + min + ":" + sec; /* adding time to the div */
        var t = setTimeout(function(){ currentTime() }, 1000); /* setting timer */
    }
    function updateTime(k) {
      if (k < 10) {
        return "0" + k;
      }
      else {
        return k;
      }
    }
    currentTime(); /* calling currentTime() function to initiate the process */
        </script>
        <?php
          $tanggal= mktime(date("m"),date("d"),date("Y"));
          echo "Tanggal : ".date("d M Y", $tanggal)." ";
          date_default_timezone_set('Asia/Jakarta');
          $a = date ("H");
          if (($a>=6) && ($a<=11)){
          echo "| Selamat Pagi!";
          }
          else if(($a>11) && ($a<=15))
          {
          echo "| Selamat Siang!";}
          else if (($a>15) && ($a<=18)){
          echo "| Selamat Sore!";}
          else { echo "| Selamat Malam!";}
        ?>
      </label>
    </div>
    <div class="menu">
        <form method="post" action="in/tambah.php">
          <label>Data Alat Medis Masuk</label>
          <button type="submit">Tambah Data Alat Masuk</button>
        </form>
    </div>
    <div class="badan">
      <div class="sidebar">
        <form method="" action="dashboardadmin.php">
          <button class="dashboard" type="submit">Dashboard</button>
        </form>
        <div class="dropdown">
            <button class="dropbtn">Menu Obat</button>
              <div class="dropdown-content">
                <a href="obatmasukadmin.php">Obat Masuk</a>
                <a href="obatkeluaradmin.php">Obat Keluar</a>
              </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Alat Masuk</button>
              <div class="dropdown-content">
                <a href="alatkeluaradmin.php">Alat Keluar</a>
              </div>
        </div>
        <form class="daftarobat" method="" action="daftarobatadmin.php">
					<button type="submit">Daftar Obat</button>
				</form>
        <form class="daftaralatadmin" method="" action="daftaralatadmin.php">
          <button type="submit">Daftar Alat</button>
        </form>
				<form class="distributor" method="" action="distributoradmin.php">
					<button type="submit">Distributor</button>
				</form>
				<form class="pengguna" method="" action="daftarpenggunaadmin.php">
					<button type="submit">Pengguna</button>
				</form>
        <form class="logout" method="post" action="logout.php">
          <button onclick="return confirm('Anda Yakin Ingin Log Out?')" type="submit">Log Out</button>
        </form>
      </div>
                 <form>
            <div class="form-group">
                <?php
                  $kolom=(isset($_GET['Kolom']))? $_GET['Kolom'] : "";
                ?>
            </div>
            <div class="search">
              <input type="text" id="KataKunci" name="KataKunci" placeholder="Cari data Alat Medis Masuk.." required="" value="<?php if (isset($_GET['KataKunci']))  echo $_GET['KataKunci']; ?>">
              <button class="cari" type="submit">Cari</button>
              <button class="resetbtn" onclick="location.href='alatmasukadmin.php'" type="button">Reset</button>
            </div>
          </form>
                 <hr>
      <div class="content">
        <table border="1" width="100%" align="center" cellspacing="0" cellpadding="10">
          <tr>
            <th>No</th>
            <th>Kode Jual</th>
            <th>Nama Alat</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Tanggal Msuk</th>
            <th>Edit Jumlah Stok</th>
            <th>Aksi</th>

          </tr>

          <?php
      include "koneksi.php";

      $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;

      $kolomCari=(isset($_GET['Kolom']))? $_GET['Kolom'] : "";

      $kolomKataKunci=(isset($_GET['KataKunci']))? $_GET['KataKunci'] : "";

      // Jumlah data per halaman
      $limit = 5;

      $limitStart = ($page - 1) * $limit;

      //kondisi jika parameter pencarian kosong
      if($kolomCari=="" && $kolomKataKunci==""){
        $SqlQuery = mysqli_query($koneksi, "SELECT * FROM tb_in LIMIT ".$limitStart.",".$limit);
      }else{
        //kondisi jika parameter kolom pencarian diisi
        $SqlQuery = mysqli_query($koneksi, "SELECT * FROM tb_in WHERE nama_msk LIKE '%$kolomKataKunci%' LIMIT ".$limitStart.",".$limit);
      }

      $no = $limitStart + 1;

      while($row = mysqli_fetch_array($SqlQuery)){
      ?>

            <tr align="center">
              <td><?php echo $no++; ?></td>
                <td>
                    <?php echo $row['kode_msk'];?>
                </td>
                <td>
                    <?php echo $row['nama_msk'];?>
                </td>
                <td>
                    <?php echo "Rp." .number_format($row['harga']).",-";?>
                </td>
                <td>
                    <?php echo $row['stok'];?>
                </td>
                 <td>
                    <?php echo $row['tgl_masuk'];?>
                </td>
                <td>
                  <a href="in/tambahstok.php?id=<?php echo $row['id'];?>">Tambah</a>
                  |
                  <a href="in/kurangstok.php?id=<?php echo $row['id'];?>">Kurang</a>

                </td>
                <td>
                  <a href="in/edit.php?id=<?php echo $row['id'];?>">Edit</a>
                  |
                  <a onclick="return confirm('Anda yakin ingin membatalkan?')" href="in/batal.php?id=<?php echo $row['id'];?>">Batal</a>
                  |
                  <a onclick="return confirm('Anda yakin ingin menghapus?')" href="in/hapus.php?id=<?php echo $row['id'];?>">Hapus</a>

                </td>
            </tr>
                <?php
                 }


                ?>
        </table>
        <div class="paging">
      <?php
        // Jika page = 1, maka LinkPrev disable
        if($page == 1){
      ?>
        <!-- link Previous Page disable -->
        <a class="disabled" href="#">Previous</a>
      <?php
        }
        else{
          $LinkPrev = ($page > 1)? $page - 1 : 1;

          if($kolomCari=="" && $kolomKataKunci==""){
          ?>
            <a class="prv" href="alatmasukadmin.php?page=<?php echo $LinkPrev; ?>">Previous</a>
       <?php
          }else{
        ?>
          <a class="prv" href="alatmasukadmin.php?Kolom=<?php echo $kolomCari;?>&KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $LinkPrev;?>">Previous</a>
         <?php
           }
        }
      ?>

      <?php
        //kondisi jika parameter pencarian kosong
        if($kolomCari=="" && $kolomKataKunci==""){
          $SqlQuery = mysqli_query($koneksi, "SELECT * FROM tb_in");
        }else{
          //kondisi jika parameter kolom pencarian diisi
          $SqlQuery = mysqli_query($koneksi, "SELECT * FROM tb_in WHERE nama_msk LIKE '%$kolomKataKunci%'");
        }

        //Hitung semua jumlah data yang berada pada tabel Sisawa
        $JumlahData = mysqli_num_rows($SqlQuery);

        // Hitung jumlah halaman yang tersedia
        $jumlahPage = ceil($JumlahData / $limit);

        // Jumlah link number
        $jumlahNumber = 1;

        // Untuk awal link number
        $startNumber = ($page > $jumlahNumber)? $page - $jumlahNumber : 1;

        // Untuk akhir link number
        $endNumber = ($page < ($jumlahPage - $jumlahNumber))? $page + $jumlahNumber : $jumlahPage;

        for($i = $startNumber; $i <= $endNumber; $i++){
          $linkActive = ($page == $i)? ' class="active"' : '';

          if($kolomCari=="" && $kolomKataKunci==""){
      ?>
          <a class="number" href="alatmasukadmin.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>

      <?php
        }else{
?>
          <a class="number" href="alatmasukadmin.php?Kolom=<?php echo $kolomCari;?>&KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
          <?php
        }
      }
      ?>

      <!-- link Next Page -->
      <?php
       if($page == $jumlahPage){
      ?>
        <a class="disabled" href="#">Next</a>
      <?php
      }
      else{
        $linkNext = ($page < $jumlahPage)? $page + 1 : $jumlahPage;
       if($kolomCari=="" && $kolomKataKunci==""){
          ?>
          <a class="nxt" href="alatmasukadmin.php?page=<?php echo $linkNext; ?>">Next</a>
       <?php
          }else{
        ?>
          <a class="nxt" href="alatmasukadmin.php?Kolom=<?php echo $kolomCari;?>&KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $linkNext; ?>">Next</a>
      <?php
        }
      }
      ?>
  </div>
    </div>
              </div>
              <div class="clear"></div>
            </div>
</body>
</html>
