<?php
	include "config.php";
	$id_order=$_GET['id_order'];
	$modal=mysqli_query($conn,"DELETE FROM list_order WHERE id_order='$id_order'");
	header('location:transaksi.php');
?>