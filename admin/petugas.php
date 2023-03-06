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
          <h1 class="m-0">Petugas <small></small></h1>
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
                  <h5>Data Petugas</h5>
                </div>
                <div class="col-6 text-right">
                  <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Data</a>
                </div>
              </div>
            </div>
            <div class="card-body">
            <?php 
           if(isset($_GET['info'])){
            if($_GET['info'] == "hapus"){ ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-trash"></i> Sukses</h5>
                Data berhasil di hapus
              </div>
            <?php } else if($_GET['info'] == "simpan"){ ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Sukses</h5>
                Data berhasil di simpan
              </div>
            <?php }else if($_GET['info'] == "update"){ ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-edit"></i> Sukses</h5>
                Data berhasil di update
              </div>
            <?php } } ?>
              <table class="table table-bordered" id="datatable">
                <thead>
                  <tr>
                    <th style="width: 10px">NO</th>
                    <th>Username</th>
                    <th>Nama Petugas</th>
                    <th>Level</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>

                <?php
                  $no = 1;
                  include "../koneksi.php";
                  $petugas = mysqli_query($koneksi, "SELECT * FROM petugas");
                  while ($d_petugas = mysqli_fetch_array($petugas)) {
                  ?>

                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?=$d_petugas['username']?></td>
                    <td><?=$d_petugas['nama_petugas']?></td>
                    <td><?=$d_petugas['level']?></td>
                    <td>
                    <?php if ($d_petugas['username'] == $_SESSION['username']) { ?>
                          <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $d_petugas['id_petugas']; ?>"><i class="fas fa-edit"></i></a>
                        <?php } else { ?>
                          <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $d_petugas['id_petugas']; ?>"><i class="fas fa-edit"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus<?php echo $d_petugas['id_petugas']; ?>"><i class="fas fa-trash"></i></a>
                        <?php } ?>  
                    </td>
                  </tr>
                  <!-- Modal -->
                  <div class="modal fade" id="modal-edit<?php echo $d_petugas['id_petugas']; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Data Petugas</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="updatepetugas.php" method="POST">
                            <div class="form-group">
                              <label>Username</label>
                              <input type="text" name="id_petugas" value="<?php echo $d_petugas['id_petugas']; ?>" hidden>
                                <input type="text" name="username" value="<?php echo $d_petugas['username']; ?>" class="form-control" placeholder="Masukan Username">
                            </div>
                            <div class="form-group">
                              <label>Password</label>
                              <input type="password" name="password" value="" class="form-control" placeholder="Masukan Password" required>
                            </div>
                            <div class="form-group">
                              <label>Nama Petugas</label>
                              <input type="text" name="nama_petugas" value="<?php echo $d_petugas['nama_petugas']; ?>" class="form-control" placeholder="Masukkan Nama Petugas">
                            </div>
                            <div class="form-group">
                              <label>Level</label>
                              <select name="level" class="form-control">
                                <option>--- Pilih Level ---</option>
                                <option value="admin" <?php if($d_petugas['level'] == 'admin'){ echo 'selected'; } ?>>Admin</option>
                                  <option value="petugas" <?php if($d_petugas['level'] == 'petugas'){ echo 'selected'; } ?>>Petugas</option>
                              </select>
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
                  <div class="modal fade" id="modal-hapus<?php echo $d_petugas['id_petugas']; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Hapus Data Petugas</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Apakah Anda yakin ingin Menghapus data ini?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <a href="deletepetugas.php?id_petugas=<?php echo $d_petugas['id_petugas']; ?>" class="btn btn-primary">Hapus</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>  
                  <div class="modal fade" id="modal-tambah">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Tambah Data Petugas</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                        <div class="modal-body">
                        <form action="createpetugas.php" method="POST">
                            <div class="form-group">
                              <label>Username</label>
                              <input type="text" name="username" class="form-control" placeholder="Masukkan Username">
                            </div>
                            <div class="form-group">
                              <label>Password</label>
                              <input type="password" name="password" class="form-control" placeholder="Masukan password">
                            </div>
                            <div class="form-group">
                              <label>Nama Petugas</label>
                              <input type="text" name="nama_petugas" class="form-control" placeholder="Masukkan Username">
                            </div>
                            <div class="form-group">
                              <label>Level</label>
                              <select name="level" class="form-control">
                                <option>--- Pilih Level ---</option>
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                              </select>
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