<?php

$sql = "SELECT * FROM sensor WHERE sensor = 'Soil_Moisture' and sensor2 = 'MPU6050'";
$result = mysqli_query($db, $sql);

$waktu = "";
$data = "";
$data2 = "";
while($row = mysqli_fetch_array($result)){ 

  $waktu = $waktu . "'" . $row['waktu'] . "',";
  $data = $data . $row['nilai'] . ",";
  $data2 = $data2 . $row['nilai2'] . ",";
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
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
          <div class="col-lg-6">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Grafik Data Kelembaban Tanah</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="chartsoil" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- line chart -->

          </div>
          <div class="col-lg-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Grafik Data Kemiringan tanah</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="chartmpu" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- line chart -->

          </div>
          <div class="col-md-3 col-sm-6 col-12" align="center">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-tint-slash"></i></span>
              <div  class="info-box-content">
                <span class="info-box-text">Kelembaban Tanah</span>
                <span class="info-box-number" id="soil">...</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12"></div>
          <div class="col-md-3 col-sm-6 col-12" align="center">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-tachometer-alt"></i></span>
              <div  class="info-box-content">
                <span class="info-box-text">Kemiringan Tanah</span>
                <span class="info-box-number" id="mpu">...</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12"></div>
            <div class="col-md-3 col-sm-6 col-12" align="center">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-tint-slash"></i></span>
                <div  class="info-box-content">
                  <span class="info-box-text">Level</span>
                  <span class="info-box-number" id="level">...</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
<!-- Onesignal -->
<script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
<script src="page/belajar/notif.js"></script>
  <!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- ChartJS -->
<!-- <script src="plugins/chart.js/Chart.min.js"></script> -->
<!-- chartjs baru -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<!-- mqttjs -->
<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
<!-- subscribe data mqttjs -->
<script src="page/belajar/data.js"></script>