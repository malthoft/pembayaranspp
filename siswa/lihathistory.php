<?php 
session_start();

if($_SESSION['status']!="login"){
  header("location:../index.php?info=login");
}

?>
<?php 
include '../layouts/header.php';
include '../layouts/navbarsiswa.php';
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0"></h1>
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
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-12">
                <h3><center>Histori Pembayaran SPP</center></h3>
              </div>
                <!--<div class="col-6 text-right">
                  <a href="print_laporan.php" class="btn btn-primary btn-sm" target="blank_"><i class="fas fa-print"></i> Print Laporan</a>
                </div>-->
              </div>            
            </div>
            <?php $nisn = $_GET['nisn']; if($nisn == $_SESSION['nisn']) { ?>
              <div class="card-body">
              <?php 
              include "../koneksi.php";
              $nisn = $_GET['nisn'];
              $mysqli_query = mysqli_query($koneksi, "SELECT * FROM siswa where nisn='$nisn'");
              while($data_siswa = mysqli_fetch_array($mysqli_query)){
                ?>
                <div class="col-sm-6">
                  <h5><b>Nama Siswa : <?=$data_siswa['nama']?></b></h5>
                </div>
              <?php } ?>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">NO</th>
                    <th>Tanggal Bayar</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>SPP</th>
                    <th>Bayaran Masuk</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include "../koneksi.php";
                  $nisn = $_GET['nisn'];
                  $mysqli_query = mysqli_query($koneksi, "SELECT * FROM pembayaran JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp");
                  $no = 1;
                  while($data = mysqli_fetch_array($mysqli_query)){
                    ?>
                    <tr>
                      <?php if ($nisn == $data['nisn']) { ?>
                       <td><?php echo $no++; ?></td>
                       <td><?=$data['tgl_bayar']?></td>
                       <td><?=$data['bulan_dibayar']?></td>
                       <td><?=$data['tahun_dibayar']?></td>
                       <td>Tahun <?=$data['tahun']?> Rp. <?= number_format($data['nominal'])?></td>
                       <td>Rp. <?= number_format($data['jumlah_bayar'])?></td>                       
                     <?php } else { ?>
                     <?php } ?>

                   </tr>                   
                 <?php } ?>
                 <?php
                 $no = 1;
                 include "../koneksi.php";
                 $siswa    =mysqli_query($koneksi, "SELECT * FROM siswa INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas INNER JOIN spp ON siswa.id_spp=spp.id_spp");
                 while($d_siswa = mysqli_fetch_array($siswa)){
                  $data_pembayaran = mysqli_query($koneksi, "select SUM(jumlah_bayar) as jumlah_bayar FROM pembayaran where nisn='$d_siswa[nisn]'");
                  $data_pembayaran = mysqli_fetch_array($data_pembayaran);
                  $sudah_bayar = $data_pembayaran['jumlah_bayar'];
                  $kekurangan = $d_siswa['nominal']-$data_pembayaran['jumlah_bayar'];
                  ?>
                  <?php if($d_siswa['nisn'] == $_SESSION['nisn']) { ?>
                    <tr>
                    <td colspan="5" class="text-center"><b>Total Pembayaran Masuk</b></td>
                    <td><b>Rp. <?php echo number_format($sudah_bayar); ?></b></td>
                  </tr>
                  <tr>
                    <td colspan="5" class="text-center"><b>Sisa Pembayaran</b></td>
                    <td><b>Rp. <?php echo number_format($kekurangan); ?></b></td>
                  </tr>
                  <?php } else { ?>

                  <?php } ?>
                <?php } ?>
              </tbody>
            </table>
          </div>
            <?php } else { ?>
            
            <?php } ?>
          <div class="card-header">
            <div class="row">
              <div class="col-3">

              </div>
              <!--<div class="col-3 text-center">
                <div class="card-body text-center">
                  <table>
                    <tr>
                      <td></td>                      
                    </tr>
                    <tr>
                      <td>Mengetahui,</td>                      
                    </tr>
                    <tr>
                      <td>Kepala SMK ...........,<br><br><br><br></td>
                    </tr>
                    <tr>
                      <td>
                        <b><u>Nama Kepala Sekolah</u></b><br>
                        NIP. ...................
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="col-6">

              </div>
              <div class="col-3 text-center">
               <div class="card-body text-center">
                <table>
                  <?php
                  include "../koneksi.php";
                  $petugas    =mysqli_query($koneksi, "SELECT * FROM petugas where username='$_SESSION[username]'");
                  while($d_petugas = mysqli_fetch_array($petugas)){
                    ?>
                    <tr>
                      <td></td>                      
                    </tr>
                    <tr>
                      <td>Subang, <?php echo date('d-m-Y'); ?></td>                      
                    </tr>
                    <tr>
                      <td>Petugas Pembayaran,<br><br><br><br></td>
                    </tr>
                    <tr>
                      <td>
                        <b><u><?php echo $d_petugas['nama_petugas']; ?></u></b><br>
                      </td>
                    </tr>
                  <?php } ?>
                </table>
              </div>
            </div>-->
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<script>
  //window.print();
</script>
<!-- /.content-->
</div>
<!-- /.content-wrapper -->
<?php 
include '../layouts/footer.php';
?>