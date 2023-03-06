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
          <h1 class="m-0">Siswa <small></small></h1>
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
                  <h5>Data Siswa</h5>
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
                    <th>NISN</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Data SPP</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  include "../koneksi.php";
                  $siswa = mysqli_query($koneksi, "SELECT * FROM siswa INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas INNER JOIN spp ON siswa.id_spp=spp.id_spp");
                  while ($d_siswa = mysqli_fetch_array($siswa)) {
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?= $d_siswa['nisn'] ?></td>
                    <td><?= $d_siswa['nis'] ?></td>
                    <td><?= $d_siswa['nama'] ?></td>
                    <td><?= $d_siswa['nama_kelas'] ?> <?= $d_siswa['kompetensi_keahlian'] ?></td>
                    <td><?= $d_siswa['alamat'] ?></td>
                    <td><?= $d_siswa['no_telp'] ?></td>
                    <td>Tahun <?= $d_siswa['tahun'] ?> Nominal Rp.<?= number_format($d_siswa['nominal']) ?></td>
                    <td>
                      <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $d_siswa['nisn'] ?>"><i class="fas fa-edit"></i></a>
                      <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus<?php echo $d_siswa['nisn'] ?>"><i class="fas fa-trash "></i></a>
                    </td>
                  </tr>
                  <!-- Modal -->
                  <div class="modal fade" id="modal-edit<?php echo $d_siswa['nisn'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Data Siswa</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="updatesiswa.php" method="POST">
                            <div class="form-group">
                              <label>NISN</label>
                              <input type="text" name="nisn" value="<?php echo $d_siswa['nisn'] ?>" class="form-control" placeholder="Masukan NISN" readonly>
                            </div>
                            <div class="form-group">
                              <label>NIS</label>
                              <input type="text" name="nis" value="<?php echo $d_siswa['nis'] ?>" class="form-control" placeholder="Masukan NIS">
                            </div>
                            <div class="form-group">
                              <label>NAMA</label>
                              <input type="text" name="nama" value="<?php echo $d_siswa['nama'] ?>" class="form-control" placeholder="Masukkan Nama">
                            </div>
                            <div class="form-group">
                              <label>Kelas</label>
                              <select name="id_kelas" class="form-control">
                                <option>--- Pilih Kelas ---</option>
                                <?php
                                include "../koneksi.php";
                                $kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
                                while ($d_kelas = mysqli_fetch_array($kelas)) {
                                ?>
                                <option value="<?=$d_kelas['id_kelas'] ?>" <?php if ($d_kelas['id_kelas'] == $d_siswa['id_kelas']){ echo 'selected'; } ?>> <?=$d_kelas['nama_kelas'] ?> <?=$d_kelas['kompetensi_keahlian'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Alamat</label>
                              <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan Alamat"><?php echo $d_siswa['alamat'] ?></textarea>
                            </div>
                            <div class="form-group">
                              <label>No. Telp</label>
                              <input type="text" name="no_telp" value="<?php echo $d_siswa['no_telp'] ?>" class="form-control" placeholder="Masukan No. Telepon">
                            </div>
                            <div class="form-group">
                              <label>Data SPP</label>
                              <select name="id_spp" class="form-control">
                                <option>--- Pilih data SPP ---</option>
                                <?php
                                include "../koneksi.php";
                                $kelas = mysqli_query($koneksi, "SELECT * FROM spp");
                                while ($d_spp = mysqli_fetch_array($kelas)) {
                                ?>
                                <option value="<?=$d_spp['id_spp'] ?>" <?php if ($d_spp['id_spp'] == $d_siswa['id_kelas']){ echo 'selected'; } ?>>Tahun <?=$d_spp['tahun'] ?> Nominal Rp.<?= number_format($d_spp['nominal']) ?></option>
                                <?php } ?>
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
                  <div class="modal fade" id="modal-hapus<?php echo $d_siswa['nisn'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Hapus Data Siswa</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Apakah Anda yakin ingin Menghapus data ini?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <a href="deletesiswa.php?nisn=<?php echo $d_siswa['nisn']; ?>" class="btn btn-danger btn-sm"> Hapus</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                  <div class="modal fade" id="modal-tambah">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Tambah Data Siswa</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                        <div class="modal-body">
                          <form action="createsiswa.php" method="POST">
                            <div class="form-group">
                              <label>NISN</label>
                              <input type="text" name="nisn" class="form-control" placeholder="Masukan NISN">
                            </div>
                            <div class="form-group">
                              <label>NIS</label>
                              <input type="text" name="nis" class="form-control" placeholder="Masukan NIS">
                            </div>
                            <div class="form-group">
                              <label>NAMA</label>
                              <input type="text" name="nama" class="form-control" placeholder="Masukan Nama">
                            </div>
                            <div class="form-group">
                              <label>Kelas</label>
                              <select name="id_kelas" class="form-control">
                                <option>--- Pilih Kelas ---</option>
                                <?php
                              include "../koneksi.php";
                              $kelas    =mysqli_query($koneksi, "SELECT * FROM kelas");
                              while($d_kelas = mysqli_fetch_array($kelas)){
                                ?>
                                <option value="<?=$d_kelas['id_kelas']?>"><?=$d_kelas['nama_kelas']?> <?=$d_kelas['kompetensi_keahlian']?></option>
                              <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Alamat</label>
                              <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan Alamat"></textarea>
                            </div>
                            <div class="form-group">
                              <label>No. Telp</label>
                              <input type="text" name="no_telp" class="form-control" placeholder="Masukan No. Telepon">
                            </div>
                            <div class="form-group">
                              <label>Data SPP</label>
                              <select name="id_spp" class="form-control">
                                <option>--- Pilih data SPP ---</option>
                                <?php
                                include "../koneksi.php";
                                $kelas = mysqli_query($koneksi, "SELECT * FROM spp");
                                while ($d_spp = mysqli_fetch_array($kelas)) {
                                ?>
                                <option value="<?=$d_spp['id_spp'] ?>">Tahun <?=$d_spp['tahun'] ?> Nominal Rp. <?= number_format($d_spp['nominal']) ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
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