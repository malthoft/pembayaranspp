<?php
include '../koneksi.php';

$id_pembayaran = $_GET['id_pembayaran'];

mysqli_query($koneksi,"DELETE FROM  pembayaran WHERE id_pembayaran='$id_pembayaran'");

header("location:historypembayaran.php?info=hapus");

?>