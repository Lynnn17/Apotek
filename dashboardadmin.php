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
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="asset/dashboard.css">
	<style>
	</style>
</head>
<body style="background-image: url(BG.png);">
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
				<form method="post" action="tambahdataobatmasuk.php">
					<label>Web Apotek</label>
				</form>
				<form class="logout" method="post" action="logout.php">
					<button onclick="return confirm('Yakin Ingin Log Out??')" type="submit">Log Out</button>
				</form>
		</div>
		<div class="badan">
			<div class="content">
				<img class="pfp" src="asset/img/PFP.png">
				<h3 class="wlcm">Selamat Datang, <?php echo $_SESSION['nama']; ?></h3>
				<div class="form1">
					<div class="formtext1">
						<label>Data Produk</label>
						<p>Berisi data berbagai macam produk yang dijual di apotek.</p>
					</div>
						<form class="formlink1">
							<a href="obatkeluaradmin.php">Menu Obat</a>
							<a href="alatkeluaradmin.php">Menu Alat</a>
						</form>
				</div>
				<div class="form2">
					<div class="formtext2">
						<label>Daftar Pengguna</label>
						<p>Berisi data dan identitas pengguna.</p>
					</div>
						<form class="formlink2">
							<a href="daftarpenggunaadmin.php">Daftar Pengguna</a>
						</form>
				</div>
				<br>
				<div class="form3">
					<div class="formtext3">
						<label>Daftar Barang</label>
						<p>Berisi informasi produk yang tersedia di apotek.</p>
					</div>
						<form class="formlink3">
							<a href="daftarobatadmin.php">Daftar Obat</a>
							<a href="daftaralatadmin.php">Daftar Alat</a>
						</form>
				</div>
				<div class="form4">
					<div class="formtext4">
						<label>Distributor</label>
						<p>Berisi informasi tentang distributor barang.</p>
					</div>
						<form class="formlink4">
							<a href="distributoradmin.php">Distributor</a>
						</form>
				</div>
		<div class="clear"></div>
	</div>
</body>
</html>
