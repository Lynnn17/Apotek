<?php 	error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
include "../koneksi.php";
$query="SELECT*FROM tb_tuku";
 $hasil= mysqli_query($koneksi, $query);
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
 ?>
     <!DOCTYPE html>
    <html>
    <head>
        <title>Cetak</title>
    </head>
    <body>
        <center>
            <h2>Apotek Farmasi </h2>
            <h4>Jln. Raya Cepu-Bojonegoro No.4444,Kopjan,Purwosari,Kab Bojonegoro,Jawa Timur</h4>

            <hr />
        </center>
        <label>
            <h4>
                Nama Kasir: <?php echo $_SESSION['nama']; ?>
            </h4>
         </label>
        <label>
            <?php
                    $tanggal= mktime(date("m"),date("d"),date("Y"));
                    echo "Tanggal : <b>".date("d-M-Y", $tanggal)."</b> ";
                    date_default_timezone_set('Asia/Jakarta');
        ?>
            
        </label>
        <br>
        <br>
        <table border="1" style="width: 100%">
                     <tr>
                        <td>No</td>
                        <td>Nama Alat</td>
                        <td>Harga</td>
                        <td>Jumlah</td>
                        <td>Total</td>

                    </tr>

                         <?php

                    $no=0;
                    $query="SELECT*FROM tb_beli";

                    $hasil= mysqli_query($koneksi, $query);

                    while($row=mysqli_fetch_assoc($hasil)){
                    $no++;
                    $subtotal += $row['total'];
                        ?>

                <tr>
                    <td>
                        <?php echo $no?>

                    </td>
                    <td>
                        <?php echo $row['nama_mds'];?>
                    </td>
                    <td>
                         <?php echo "Rp." .number_format($row['harga']).",-";?>
                    </td>
                    <td>
                        <?php echo $row['stok'];?>
                    </td>
                    <td>
                        <?php echo "Rp." .number_format($row['total']).",-";?>
                    </td>
                </tr>
                <?php
                 }
                  $hasil=mysqli_query($koneksi, $query);
                    $row=mysqli_fetch_assoc($hasil);
                ?>
                </table>
                 <h3>  <th>SubTotal:<?php echo "Rp." .number_format($subtotal).",-";?> </th> </h3>
            </div>
        </div>
        </table>
        <script>
        window.print();
    </script>
    </body>
    </html>
