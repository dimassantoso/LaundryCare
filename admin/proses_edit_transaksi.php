<?php
	include 'config.php';
	$id_order = $_GET['id_order'];
	$changeStatus = 'Proses';

	$query = "UPDATE list_order 
			SET status = 'Proses'
			WHERE id_order = '$id_order'";
	$modal = mysqli_query($conn, $query);
	header('location:transaksi.php');

?>