<?php
include '../koneksi.php';

$id_spp = $_POST['id_spp'];
$tahun = $_POST['tahun'];
$nominal = $_POST['nominal'];

mysqli_query($koneksi,"UPDATE spp SET tahun='$tahun', nominal='$nominal' WHERE id_spp='$id_spp'");

header("location:spp.php?info=update");

?>