<?php 

session_start();


include 'koneksi.php';


$nisn = $_POST['nisn'];
$nis = ($_POST['nis']);



$data = mysqli_query($koneksi,"SELECT * FROM siswa WHERE nisn='$nisn' AND nis='$nis'");

$cek = mysqli_num_rows($data);


if($cek > 0){
        $_SESSION['nisn'] = $nisn;
		$_SESSION['nis'] = $nis;
		$_SESSION['nama'] = $nama;
		$_SESSION['status'] = "login";
		header("location:siswa/index.php");

}else {
    header("location:index.php?info=gagal");
}
?>