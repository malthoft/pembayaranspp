<?php 
session_start();

  // cek apakah yang mengakses halaman ini sudah login
if($_SESSION['level']==""){
  header("location:../login.php?info=login");
}

?>
<?php 
include '../layouts/header.php';
?>



<!-- Content Wrapper. Contains page content 
  <div class="content-wrapper">-->
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
                  <h3><center>Laporan Pembayaran SPP</center></h3>
                </div>
                <!--<div class="col-6 text-right">
                  <a href="print_laporan.php" class="btn btn-primary btn-sm" target="blank_"><i class="fas fa-print"></i> Print Laporan</a>
                </div>-->
              </div>            
            </div>
            <div class="card-body">             
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Data SPP</th>
                    <th>Sudah di Bayar</th>
                    <th>Sisa Pembayaran</th>
                    <th>Status</th>
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
                      <th>
                        <?php if ($sudah_bayar == '') { ?>
                          0
                        <?php } else { ?>
                          Rp. <?php echo number_format($sudah_bayar); ?>
                        <?php } ?>
                      </th>
                      <th>
                        <?php if ($kekurangan == '') { ?>
                          0
                        <?php } else { ?>
                          Rp. <?php echo number_format($kekurangan); ?>
                        <?php } ?>
                      </th>
                      <th>
                        <?php if ($d_siswa['nominal'] == $sudah_bayar) { ?>
                          <div class="btn btn-success btn-sm">Lunas</div>
                        <?php } else { ?>
                          <div class="btn btn-warning btn-sm">Belum Lunas</div>
                        <?php } ?>
                      </th>
                    </tr>
                    <div class="modal fade" id="modal-edit<?php echo $d_siswa['nisn']; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Data Siswa</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="post" action="simpan_transaksi.php">
                              <div class="form-group">
                                <input type="text" name="nisn" class="form-control" value="<?php echo $d_siswa['nisn']; ?>" placeholder="Masukan NISN" hidden>
                                <input type="text" name="id_spp" value="<?php echo $d_siswa['id_spp']; ?>" class="form-control" placeholder="Masukan Nama Siswa" hidden>
                              </div>                            
                              <div class="form-group">
                                <label>Bulan</label>
                                <select class="form-control" name="bulan_dibayar">
                                  <option>--- Pilih Bulan ---</option>
                                  <option value="Januari">Januari</option>
                                  <option value="Februari">Februari</option>
                                  <option value="Maret">Maret</option>
                                  <option value="April">April</option>
                                  <option value="Mei">Mei</option>
                                  <option value="Juni">Juni</option>
                                  <option value="Juli">Juli</option>
                                  <option value="Agustus">Agustus</option>
                                  <option value="September">September</option>
                                  <option value="Oktober">Oktober</option>
                                  <option value="November">November</option>
                                  <option value="Desember">Desember</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Tahun</label>
                                <select class="form-control" name="tahun_dibayar">
                                  <option selected="selected">--- Tahun ---</option>
                                  <?php
                                  for($i=date('Y'); $i>=date('Y')-32; $i-=1){
                                    echo"<option value='$i'> $i </option>";
                                  }
                                  ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Jumah Bayar</label>
                                <input type="text" name="jumlah_bayar" class="form-control" placeholder="Masukan Nominal">
                              </div>
                              <?php
                              include "../koneksi.php";
                              $petugas    =mysqli_query($koneksi, "SELECT * FROM petugas where username='$_SESSION[username]'");
                              while($d_petugas = mysqli_fetch_array($petugas)){
                                ?>
                                <input type="text" name="id_petugas" value="<?php echo $d_petugas['id_petugas']; ?>" hidden>
                              <?php } ?>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="modal-hapus<?php echo $d_siswa['nisn']; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Hapus Data Siswa</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Apakah Anda Yakin Akan Menghapus Data Ini !!!</p>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                            <a href="hapus_siswa.php?nisn=<?php echo $d_siswa['nisn']; ?>" class="btn btn-primary">Hapus</a>
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
                          <form action="simpan_siswa.php" method="post">
                            <div class="form-group">
                              <label>NISN</label>
                              <input type="text" name="nisn" class="form-control" placeholder="Masukan NISN">
                            </div>
                            <div class="form-group">
                              <label>NIS</label>
                              <input type="text" name="nis" class="form-control" placeholder="Masukan NIS">
                            </div>
                            <div class="form-group">
                              <label>Nama</label>
                              <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Siswa">
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
                              <textarea class="form-control" name="alamat" rows="3" placeholder="Masukan Alamat ..."></textarea>
                            </div>
                            <div class="form-group">
                              <label>NO. Telephone</label>
                              <input type="text" name="no_telp" class="form-control" placeholder="Masukan NO. Telephone">
                            </div>
                            <div class="form-group">
                              <label>Data SPP</label>
                              <select name="id_spp" class="form-control">
                                <option>--- Pilih Data SPP ---</option>
                                <?php
                                include "../koneksi.php";
                                $spp    =mysqli_query($koneksi, "SELECT * FROM spp");
                                while($d_spp = mysqli_fetch_array($spp)){
                                  ?>
                                  <option value="<?=$d_spp['id_spp']?>">Tahun <?=$d_spp['tahun']?> Nominal Rp. <?= number_format($d_spp['nominal'])?></option>
                                <?php } ?> 
                              </select>
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                </tbody>
              </table>
            </table>
          </div>
          <div class="card-header">
            <div class="row">
              <div class="col-3 text-center">
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
                  <tr>
                    <td></td>                      
                  </tr>
                  <tr>
                    <td>Subang, <?php echo date('d-m-Y'); ?></td>                      
                  </tr>
                  <tr>
                    <td>Bendahara Sekolah,<br><br><br><br></td>
                  </tr>
                  <tr>
                    <td>
                      <b><u>Bendahara Sekolah</u></b><br>
                      NIP. ...................
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<script>
 window.print();
</script>
  <!-- /.content
  </div>-->
  <!-- /.content-wrapper -->
  <?php 
//include '../layouts/footer.php';
  ?>