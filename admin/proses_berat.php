<?php
	include "config.php";
	$id_order=$_POST['id_order'];
	$berat = $_POST['berat'];
	
	$query = "UPDATE list_order 
			SET berat = '$berat'
			WHERE id_order = '$id_order'";
	$modal = mysqli_query($conn, $query);
	header('location:transaksi.php');

?>