<?php error_reporting(0)?>
<?php 
$pesan= "Masukan Data Diri Anda";
$teks = "(isi password)";
if(isset($_POST['tambah'])){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama = $_POST['nama'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jk'];
    $akses = $_POST['akses'];
    if ($password == ""){
        $pesan  = "Data Diri anda Kurang!!!";
    }else{
        $pesan= "Berhasil Mendaftar(lagi?)"; 
        $sql = "INSERT INTO data_diri (username, password, nama, tanggal_lahir, alamat, jk, hak_akses) VALUES ('$username', '$password', '$nama', '$tanggal_lahir', '$alamat', '$jk', '$akses')";
        include "config.php";
        mysqli_query($db, $sql);
    }
    
  } 
  if(isset($_POST['kembali'])){
    session_destroy();
    header("Location: login.php");
  } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar AIndex | Website IOT</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>AIndex |</b> Website IOT</a>
  </div>
  <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?php echo $pesan?></h3>
        </div>
              <!-- /.card-header -->
              <!-- form start -->
        <form action="" method="post">
            <div class="card-body">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label> <label><?php echo $teks?></label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control">
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control">
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jk" class="form-control">
                      <option value="1">Laki-laki</option>
                      <option value="0">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Hak Akses</label>
                    <select name="akses" class="form-control">
                      <option value="2">Operator</option>
                    </select>
                </div>
            </div>
                <!-- /.card-body -->
            <div class="row mb=4">
            <div class="card-footer">
                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
            </div>
            <div class="card-footer">
                    <button type="submit" name="kembali" class="btn btn-primary">Kembali</button>
            </div>
            </div>
        </form>
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>