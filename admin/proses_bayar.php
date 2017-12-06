<?php
	include "config.php";
	$id_order=$_POST['id_order'];
	$bayar = $_POST['bayar'];
	
	$query = "UPDATE list_order 
			SET bayar = '$bayar', status = 'Selesai' 
			WHERE id_order = '$id_order'";
	$modal = mysqli_query($conn, $query);
	header('location:transaksi.php');

?>