<?php
include '../koneksi.php';

$id_kelas = $_POST['id_kelas'];

mysqli_query($koneksi,"DELETE FROM  kelas WHERE id_kelas='$id_kelas'");

header("location:kelas.php?info=hapus");

?>