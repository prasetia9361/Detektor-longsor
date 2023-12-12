<?php 
require "ceklogin.php";
require "config.php";?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<?php include "header.php"?>
<?php
if (isset($_GET['m'])) {
  $mode = $_GET['m'];
  
  # code...
}
  else {
    $mode = "hold-transition sidebar-mini";
  }
  ?>
<body class=<?php echo $mode;?>>
<div class="wrapper">

  <!-- Navbar -->
<?php include "navbar.php"?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AIndex | Website IOT</span>
    </a>
    <!-- Sidebar -->
  <?php include "slidebar.php"?>
    <!-- /.sidebar -->
  </aside>
    <?php 
      if(isset($_GET['p'])){
        $page = $_GET['p'];
        include "page/".$page.".php";
      }
     else{
        include "page/dashboard.php";
      }
    ?>
  <!-- Content Wrapper. Contains page content -->

          <!-- /.content-wrapper -->

           <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Tema</h5>
      <li class="nav-item">
            <a href="?m=dark-mode" class="nav-link">
              <p>
                Mode Gelap
              </p>
            </a>
      </li>
      <li class="nav-item">
            <a href="?m=hold-transition sidebar-mini" class="nav-link">
              <p>
                Mode Terang
              </p>
            </a>
      </li>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include "footer.php"?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>