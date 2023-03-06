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
                  <th>Petugas</th>
                  <th>NISN</th>
                  <th>Nama Siswa</th>
                  <th>Tanggal Bayar</th>
                  <th>Bulan Dibayar</th>
                  <th>Tahun Dibayar</th>
                  <th>SPP</th>
                  <th>Jumlah Dibayar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                include "../koneksi.php";
                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran LEFT JOIN petugas ON petugas.id_petugas = pembayaran.id_petugas LEFT JOIN siswa ON siswa.nisn = pembayaran.nisn LEFT JOIN spp ON spp.id_spp = pembayaran.id_spp");
                while ($data = mysqli_fetch_array($query)){
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?=$data['nama_petugas']?></td>
                    <td><?=$data['nisn']?></td>
                    <td><?=$data['nama']?></td>
                    <td><?=$data['tgl_bayar']?></td>
                    <td><?=$data['bulan_dibayar']?></td>
                    <td><?=$data['tahun_dibayar']?></td>
                    <td>Rp.<?= number_format($data['nominal'])?></td>
                    <td>Rp.<?= number_format($data['jumlah_bayar'])?></td>
                    <td>
                    <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus<?php echo $data['id_pembayaran'] ?>"><i class="fas fa-trash "></i></a>                   
                    </td>
                  </tr>
                  <div class="modal fade" id="modal-hapus<?php echo $data['id_pembayaran'] ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <form action="deletepembayaran.php" method="POST">
                            <h4 class="modal-title">Hapus Data Pembayaran</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Apakah Anda yakin ingin Menghapus data berikut ??</p>
                          </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <a href="deletepembayaran.php?id_pembayaran=<?php echo $data['id_pembayaran']; ?>" class="btn btn-danger btn-sm"> Hapus</a>
                            </div>
                            </form>
                        </div>
                      </div>
                    </div>
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