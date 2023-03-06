<?php 
session_start();

  // cek apakah yang mengakses halaman ini sudah login
if($_SESSION['level']==""){
  header("location:../login.php?info=login");
}

?>
<?php 
include '../layouts/header.php';
include '../layouts/navbar.php';
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> History Pembayaran</h1>
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
      <div class="card card-secondary card-outline" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
          <div class="card-header">
            <div class="row">
              <div class="col-6">
                <h5>Data History Pembayaran</h5>
              </div>
              <!--<div class="col-6 text-right">
                <a href="print_laporan.php" class="btn btn-primary btn-sm" target="blank_"><i class="fas fa-print"></i> Print Laporan</a>
              </div>-->
            </div>            
          </div>
          <div class="card-body">
           <?php 
           if(isset($_GET['info'])){
            if($_GET['info'] == "hapus"){ ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-trash"></i> Sukses</h5>
                Data berhasil dihapus
              </div>
            <?php } else if($_GET['info'] == "simpan"){ ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Sukses</h5>
                Data berhasil disimpan
              </div>
            <?php }else if($_GET['info'] == "update"){ ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-edit"></i> Sukses</h5>
                Data berhasil diupdate
              </div>
            <?php } } ?>
            <table class="table table-bordered" id="datatable">
              <thead>
                <tr>
                  <th style="width: 10px">NO</th>
                  <th>NISN</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Data SPP</th>
                  <th>Sudah di Bayar</th>
                  <th>Sisa Pembayaran</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
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
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?=$d_siswa['nisn']?></td>
                    <td><?=$d_siswa['nama']?></td>
                    <td><?=$d_siswa['nama_kelas']?> <?=$d_siswa['kompetensi_keahlian']?></td>
                    <td>Tahun <?=$d_siswa['tahun']?> Nominal Rp. <?= number_format($d_siswa['nominal'])?></td>
                    <td>
                      <?php if ($sudah_bayar == '') { ?>
                        0
                      <?php } else { ?>
                        Rp. <?php echo number_format($sudah_bayar); ?>
                      <?php } ?>
                    </td>
                    <td>
                      <?php if ($kekurangan == '') { ?>
                        0
                      <?php } else { ?>
                        Rp. <?php echo number_format($kekurangan); ?>
                      <?php } ?>
                    </td>
                    <td>
                      <a href="lihathistory.php?nisn=<?php echo $d_siswa['nisn']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Lihat Data</a>                    
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php 
include '../layouts/footer.php';
?>