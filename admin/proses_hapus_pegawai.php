<?php
	include "config.php";
	$id_pegawai=$_GET['id_pegawai'];
	$modal=mysqli_query($conn,"DELETE FROM pegawai WHERE id_pegawai='$id_pegawai'");
	header('location:user_login.php');
?>