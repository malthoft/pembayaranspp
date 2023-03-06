<?php 
include '../koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);
$nama_petugas = $_POST['nama_petugas'];
$level = $_POST['level'];

mysqli_query($koneksi,"insert into petugas values('','$username','$password','$nama_petugas','$level')");

header("location:petugas.php?info=simpan");

?>