<?php
	include "config.php";
	$id_layanan=$_POST['id_layanan'];
	$nama = $_POST['nama'];
	$biaya = $_POST['biaya'];
	
	$query = "UPDATE layanan 
			SET nama_layanan = '$nama', biaya_layanan = '$biaya' 
			WHERE id_layanan = '$id_layanan'";
	$modal = mysqli_query($conn, $query);
	header('location:data-biaya.php');
?>