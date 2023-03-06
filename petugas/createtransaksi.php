<?php 
include '../koneksi.php';

$id_petugas = $_POST['id_petugas'];
$nisn = $_POST['nisn'];
$tanggal_bayar = date('Y-m-d');
$bulan_dibayar = $_POST['bulan_dibayar'];
$tahun_dibayar = $_POST['tahun_dibayar'];
$id_spp = $_POST['id_spp'];
$jumlah_bayar = $_POST['jumlah_bayar'];

mysqli_query($koneksi,"insert into pembayaran values('','$id_petugas','$nisn','$tanggal_bayar','$bulan_dibayar','$tahun_dibayar','$id_spp','$jumlah_bayar')");

header("location:transaksipembayaran.php?info=simpan");

?>