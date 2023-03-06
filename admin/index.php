<?php 
session_start();

if($_SESSION['level']==""){
  header("location:../login.php?info=login");
}

?>

<?php
include '../layouts/header.php';
include '../layouts/navbar.php';
include '../koneksi.php';
?>


  <!-- /.navbar -->
<html>
  <body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Dashboard <small></small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
      <div class="row">
      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <p>Total Siswa</p>

                <?php
              
              $query1 = "SELECT nisn FROM siswa ORDER BY nisn";
              $query1_run = mysqli_query($koneksi, $query1);

              $row = mysqli_num_rows($query1_run);
              echo '<h1> '.$row.'</h1>';
              
              ?>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="siswa.php" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <p>Total Kelas</p>

                <?php
              
              $query2 = "SELECT id_kelas FROM kelas ORDER BY id_kelas";
              $query2_run = mysqli_query($koneksi, $query2);

              $row2 = mysqli_num_rows($query2_run);
              echo '<h1> '.$row2.'</h1>';
              
              ?>
              </div>
              <div class="icon">
                <i class="fa fa-school"></i>
              </div>
              <a href="kelas.php" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <p>Petugas</p>

                <?php
              
              $query3 = "SELECT id_petugas FROM petugas ORDER BY id_petugas";
              $query3_run = mysqli_query($koneksi, $query3);

              $row3 = mysqli_num_rows($query3_run);
              echo '<h1> '.$row3.'</h1>';
              
              ?>
              </div>
              <div class="icon">
                <i class="fa fa-user-secret"></i>
              </div>
              <a href="petugas.php" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
      </div>
          <div class="col-lg-12">

          <div class="card card-secondary card-outline" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <div class="card-body">
                <h6 class="card-title">Selamat Datang Admin di Aplikasi Pembayaran SPP</h6>
              </div>
            </div>
          </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>
</body>
</html>

<?php
include '../layouts/footer.php';
?>