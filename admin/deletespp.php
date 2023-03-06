<?php
include '../koneksi.php';

$id_spp = $_GET['id_spp'];

mysqli_query($koneksi,"DELETE FROM  spp WHERE id_spp='$id_spp'");

header("location:spp.php?info=hapus");

?>