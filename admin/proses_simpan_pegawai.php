<?php
include "config.php";
$username = $_POST['username'];
$password = $_POST['password'];
$nama = $_POST['nama'];
$tipe = $_POST['tipe'];

$pengacak = "NDJS3289JSKS190JISJI"; 
$password = md5($pengacak.md5($password).$pengacak);


$cek_username = mysqli_num_rows(mysqli_query($conn, "SELECT username FROM pegawai WHERE username='$username'" ));
if($cek_username > 0){
	echo "<script>alert('Username sudah digunakan');</script>";
	echo "<meta http-equiv='refresh' content='0;URL=user_login.php'>";
}
else{
	mysqli_query($conn,"INSERT INTO pegawai VALUES ('','$username','$password', '$nama', '$tipe')");
	header('location:user_login.php');
}

?>