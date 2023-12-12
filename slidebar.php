<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/logoIOT.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Hai <?php echo $_SESSION['nama'] ?></a>
        </div>
      </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               
          <li class="nav-item">
            <a href="?m=<?php echo $mode?>&p=dashboard" class="nav-link">
            <i class="fas fa-chart-area"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?m=<?php echo $mode?>&p=sensor" class="nav-link">
            <i class="fas fa-clock"></i>
              <p>
                Riwayat Sensor
              </p>
            </a>
          </li>
          <?php if($_SESSION['hak_akses'] == "1"){ ?>
          <li class="nav-item">
            <a href="?m=<?php echo $mode?>&p=pengguna" class="nav-link">
            <i class="fas fa-users"></i>
              <p>
                    Pengguna
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?m=<?php echo $mode?>&p=perangkat" class="nav-link">
            <i class="fas fa-hdd"></i>
              <p>
                    Perangkat
              </p>
            </a>
          </li>
          <?php }?>

          <li class="nav-item">
            <a href="logout.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>