          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-tint-slash"></i></span>
              <div  class="info-box-content">
                <span class="info-box-text">Kelembaban Tanah</span>
                <?php while ($row = mysqli_fetch_array($result)){?>
                <span class="info-box-number" id="soil">...</span>
                <?php }?>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>