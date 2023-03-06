<?php 

session_start();


include 'koneksi.php';


$username = $_POST['username'];
$password = md5($_POST['password']);



$login = mysqli_query($koneksi,"SELECT * FROM petugas WHERE username='$username' AND password='$password'");

$cek = mysqli_num_rows($login);


if($cek > 0){

	$data = mysqli_fetch_assoc($login);

	//admin
	if($data['level']=="admin"){

		// buat session login dan username
		$_SESSION['id_petugas'] = $id_petugas;
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['level'] = "admin";
		header("location:admin/index.php");


	}else if($data['level']=="petugas"){
		// buat session login dan username
		$_SESSION['id_petugas'] = $id_petugas;
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['level'] = "petugas";
		// alihkan ke halaman dashboard pegawai
		header("location:petugas/index.php");

	}else{

		// alihkan ke halaman login kembali
		header("location:login.php?info=gagal");
	}	
}else{
	header("location:login.php?info=gagal");
}

?>