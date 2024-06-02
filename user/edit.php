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
    $ambilData = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id='$id'");
    $data=mysqli_fetch_array($ambilData);
    $jk=$data['jk'];
    $level=$data['level'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Pengguna</title>
    <link rel="stylesheet" type="text/css" href="../asset/edituser.css">
</head>
<body style="background-image: url(../BG.png)">
      <div class="edit">
            <h2>
                Edit Data Pengguna
            </h2>
            <div>
                <form action="" method="POST" class="">
                    <div class="">
                        <label>Username</label>
                        <input maxlength="10" type="text" name="username" value="<?php echo $data['username'] ?>"  placeholder="Masukkan Username"required >
                    </div>
                    <div class="">
                        <label>Password</label>
                        <input type="" maxlength="8" name="password" value="<?php echo $data['password'] ?>"  placeholder="Masukkan Password" required>
                    </div>
                    <div class="">
                        <label>Nama</label>
                        <input type="text" maxlength="20" name="nama" value="<?php echo $data['nama'] ?>"  placeholder="Masukkan Nama" required>
                    </div>
                    <div class="">
                        <label>Alamat</label>
                        <input maxlength="55" type="text" name="alamat" value="<?php echo $data['alamat'] ?>" placeholder="Masukkan Obat"required>
                    </div>
                    <div class="">
                        <label>No Hp</label>
                        <input type="" maxlength="12" name="no_hp" value="<?php echo $data['no_hp'] ?>" xplaceholder="Masukkan No Hp"required>
                    </div>
                     <div class="">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" value="<?php echo $data['tgl_lahir'] ?>" xplaceholder="Masukkan Tanggal"required>
                    </div>
                     <div class="">
                        <label>Jenis Kelamin</label>
                <select class="form-control" name="jk" required>
                    <option value="Perempuan" <?php if ($jk=='Perempuan') {echo "selected";} ?>>Perempuan</option>
                    <option value="Laki-Laki" <?php if ($level=='Laki-Laki') {echo "selected";} ?>>Laki-Laki</option>
                    </select>
                <label>Level</label>
                <select class="form-control" name="level">
                    <option value="User" <?php if ($level=='User') {echo "selected";} ?>>User</option>
                    <option value="Admin"<?php if ($level=='Admin') {echo "selected";} ?>>Admin</option>
                </select>
              </div>
                    <button type="submit" class="simpan" name="simpan" onclick="return confirm('Inputan Sudah Sesuai??')">Simpan</button>
                    <button type="reset" class="reset">Reset</button>
                </form>
            </div>
        </div>
</body>
</html>

<?php
        if(isset($_POST['simpan']))
        {
            $username    = $_POST['username'];
            $password    = $_POST['password'];
            $nama    = $_POST['nama'];
            $alamat  = $_POST['alamat'];
            $no_hp  = $_POST['no_hp'];
            $tgl_lahir       = $_POST['tgl_lahir'];
            $level   = $_POST['level'];

            $ambil=mysqli_query($koneksi, "UPDATE tb_user
            SET  username='$username', password='$password', nama='$nama', alamat='$alamat', no_hp='$no_hp' ,tgl_lahir='$tgl_lahir',level='$level'
            WHERE id='$id'") or die(mysqli_error($koneksi));
                  ?>
                   <script language="JavaScript">
                        alert('Good! Edit Data Pengguna Berhasiil :)');
                        document.location='../daftarpenggunaadmin.php';
                    </script>
                   <?php
                    }
                   ?>
