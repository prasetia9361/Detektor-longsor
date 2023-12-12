<?php
$teks = "(isi password)";
if(isset($_POST['tambah'])){
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $nama = $_POST['nama'];
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $alamat = $_POST['alamat'];
  $jk = $_POST['jk'];
  $akses = $_POST['akses'];
  $sql = "INSERT INTO data_diri (username, password, nama, tanggal_lahir, alamat, jk, hak_akses) VALUES ('$username', '$password', '$nama', '$tanggal_lahir', '$alamat', '$jk', '$akses')";
  mysqli_query($db, $sql);
}

if(isset($_GET['del'])){
  $id = $_GET['del'];

  $sql = "DELETE FROM data_diri WHERE id = '$id'";
  mysqli_query($db, $sql);
}

if(isset($_POST['ubah'])){
  $id = $_GET['id'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $nama = $_POST['nama'];
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $alamat = $_POST['alamat'];
  $jk = $_POST['jk'];
  $akses = $_POST['akses'];

  if($password == ""){
    $sql = "UPDATE data_diri SET username='$username', nama='$nama', tanggal_lahir='$tanggal_lahir', alamat='$alamat', jk='$jk', hak_akses='$akses' WHERE id='$id' ";
  } else {
    $sql = "UPDATE data_diri SET username='$username', password='$password', nama='$nama', tanggal_lahir='$tanggal_lahir', alamat='$alamat', jk='$jk', hak_akses='$akses' WHERE id='$id' ";
  }

  mysqli_query($db, $sql);
}

$sql = "SELECT * FROM data_diri";
$result = mysqli_query($db, $sql);
?>

<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pengguna</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pengguna Terdaftar</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Akses</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php while($row = mysqli_fetch_array($result)){ 
                    if($row['jk'] == "1"){
                      $jenis_kelamin = "Laki";
                    } else {
                      $jenis_kelamin = "Perempuan";
                    }

                    if($row['hak_akses'] == "1"){
                      $akses = "Administrator";
                    } else if($row['hak_akses'] == "2") {
                      $akses = "Operator";
                    }
                    ?>
                  
                  <tr>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['username']?></td>
                    <td><?php echo $row['nama']?></td>
                    <td><?php echo $row['tanggal_lahir']?></td>
                    <td><?php echo $row['alamat']?></td>
                    <td><?php echo $jenis_kelamin ?></td>
                    <td><?php echo $akses ?></td>
                    <td><a href="?p=pengguna&del=<?php echo $row['id'] ?>">Hapus</a> | <a href="?p=pengguna_ubah&id=<?php echo $row['id'] ?>">Ubah</a></td>
                  </tr>
                  
                  <?php } ?>
                  
                  
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Akses</th>
                    <th>Aksi</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Pengguna</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="?p=pengguna">
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
                      <option value="1">Administrator</option>
                      <option value="2">Operator</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
  <!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>