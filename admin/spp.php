<?php 
session_start();

if($_SESSION['level']==""){
  header("location:../login.php?info=login");
}

?>

<?php
include '../layouts/header.php';
include '../layouts/navbar.php';
?>


<!-- /.navbar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">SPP <small></small></h1>
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
        <div class="col-lg-12">
        <div class="card card-secondary card-outline" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div class="card-header">
              <div class="row">
                <div class="col-6">
                  <h5>Data SPP</h5>
                </div>
                <div class="col-6 text-right">
                  <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Data</a>
                </div>
              </div>
            </div>
            <div class="card-body">

            <?php
              if (isset($_GET['info'])) {
                if ($_GET['info'] == "hapus") { ?>
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-trash"></i> Sukses</h5>
                    Data berhasil di Hapus
                  </div>
                <?php } else if ($_GET['info'] == "simpan") { ?>
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Sukses</h5>
                    Data berhasil di Tambahkan
                  </div>
                <?php } else if ($_GET['info'] == "update") { ?>
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-edit"></i> Sukses</h5>
                    Data berhasil di Update
                  </div>
              <?php }
              } ?>

              <table class="table table-bordered" id="datatable">
                <thead>
                  <tr>
                    <th style="width: 10px">NO</th>
                    <th>Tahun</th>
                    <th>Nominal</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  include "../koneksi.php";
                  $kelas = mysqli_query($koneksi, "SELECT * FROM spp");
                  while ($d_spp = mysqli_fetch_array($kelas)) {
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?= $d_spp['tahun'] ?></td>
                    <td>Rp. <?= number_format($d_spp['nominal']) ?></td>
                    <td>
                      <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $d_spp['id_spp'] ?>"><i class="fas fa-edit"></i></a>
                      <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus<?php echo $d_spp['id_spp'] ?>"><i class="fas fa-trash "></i></a>
                    </td>
                  </tr>
                  <!-- Modal -->
                  <div class="modal fade" id="modal-edit<?php echo $d_spp['id_spp'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Data SPP</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="updatespp.php" method="POST">
                            <div class="form-group">
                              <label>Tahun</label>
                              <input type="text" name="id_spp" value="<?php echo $d_spp['id_spp'] ?>" hidden>
                              <input type="text" name="tahun" class="form-control" value="<?php echo $d_spp['tahun'] ?>" placeholder="Masukkan Tahun">
                            </div>
                            <div class="form-group">
                              <label>Nominal</label>
                              <input type="text" name="nominal" class="form-control" value="<?php echo $d_spp['nominal'] ?>" placeholder="Masukan Nominal">
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal fade" id="modal-hapus<?php echo $d_spp['id_spp'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Hapus Data SPP</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="deletespp.php" method="POST">
                        <div class="modal-body">
                        <p>Apakah Anda yakin ingin Menghapus data berikut ?? <br> Tahun: <b><?php echo $d_spp['tahun']; ?></b> <br> Nominal: <b>Rp. <?= number_format($d_spp['nominal']) ?></b></p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <a href="deletespp.php?id_spp=<?php echo $d_spp['id_spp']; ?>" class="btn btn-danger btn-sm"> Hapus</a>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                  <div class="modal fade" id="modal-tambah">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Tambah Data SPP</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                        <div class="modal-body">
                        <form action="createspp.php" method="POST">
                            <div class="form-group">
                            <label>Tahun</label>
                              <input type="text" name="tahun" class="form-control" placeholder="Masukkan Tahun">
                            </div>
                            <div class="form-group">
                              <label>Nominal</label>
                              <input type="text" name="nominal" class="form-control" placeholder="Masukan Nominal">
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                          </form>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
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