<?php 
include '../koneksi.php';

$id_petugas = $_POST['id_petugas'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$nama_petugas = $_POST['nama_petugas'];
$level = $_POST['level'];

mysqli_query($koneksi,"update petugas set username='$username', password='$password', nama_petugas='$nama_petugas', level='$level' where id_petugas='$id_petugas'");

header("location:petugas.php?info=update");

?>