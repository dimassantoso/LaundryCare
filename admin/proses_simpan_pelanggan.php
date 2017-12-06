<?php
include "config.php";
$email = $_POST['email'];
$password = $_POST['password'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$oauth_provider = 'local';

$password = md5($password);

$cek_username_email = mysqli_num_rows(mysqli_query($conn, "select email from customer where email='$email'" ));
if($cek_username_email > 0){
	echo "<script>alert('Email sudah digunakan');</script>";
	echo "<meta http-equiv='refresh' content='0;URL=data-pelanggan.php'>";
}
else{
	mysqli_query($conn,"INSERT INTO customer VALUES ('','$oauth_provider','$email','$password', '$nama', '$alamat', '$no_telp')");
	header('location:data-pelanggan.php');
}
?>