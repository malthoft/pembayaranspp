<?php
include '../koneksi.php';

$tahun = $_POST['tahun'];
$nominal = $_POST['nominal'];

mysqli_query($koneksi,"INSERT INTO spp VALUES('','$tahun','$nominal')");

header("location:spp.php?info=simpan");

?>