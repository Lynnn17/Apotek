<?php
  ob_start();
    session_start();
  include "koneksi.php"
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login - Sistem Informasi Apotek</title>
  <link rel="stylesheet" type="text/css" href="asset/index.css">
</head>
<body style="background-image:url(BG.png)">
<div class="bingkai">
      <h1>Silahkan Masuk</h1>
        <form class="login" action=""  method="POST">
              <input class="username" type="text" name="username" class="" placeholder="Username" required>
              <input class="password" type="password"  placeholder="Password" name="password" required>
            <button class="masuk" type="submit" name="masuk">Masuk</button>
        </form>
       </div>
</body>
</html>
<?php
if(isset($_POST['masuk'])){
  $username=$_POST['username'];
  $password=$_POST['password'];
  $ambil = mysqli_query($koneksi,"select * from tb_user where username='$username' and password='$password'");
  $ketemu = mysqli_num_rows($ambil);
  if($ketemu > 0){
  $data = mysqli_fetch_assoc($ambil);
  if($data['level']=="Admin"){
    // buat session login dan username
    $_SESSION['username'] = $username;
    $_SESSION['level'] = "admin";
    $_SESSION['nama'] = $data['nama'];
    // alihkan ke halaman dashboard admin
    header("location:dashboardadmin.php");
  }else if($data['level']=="User"){
    // buat session login dan username
    $_SESSION['username'] = $username;
    $_SESSION['level'] = "User";
      $_SESSION['nama'] = $data['nama'];
    header("location:dashboard.php");
      }
  }
  ?>
  <script type="text/javascript">
          alert("Username dan Password Anda Salah");
        </script>
      <?php
      }
       ?>
