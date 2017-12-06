<?php
	include "config.php";
	$id_customer=$_POST['id_customer'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_telp = $_POST['no_telp'];

	$pengacak = "NDJS3289JSKS190JISJI"; 
	$password = md5($pengacak.md5($password).$pengacak);

	$query = "UPDATE customer 
			SET email = '$email', password = '$password', nama = '$nama', alamat = '$alamat', no_telp = '$no_telp' 
			WHERE id_customer = '$id_customer'";
	$modal = mysqli_query($conn, $query);
	header('location:data-pelanggan.php');
?>