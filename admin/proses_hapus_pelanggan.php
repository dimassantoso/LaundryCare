<?php
	include "config.php";
	$id_customer=$_GET['id_customer'];
	$modal=mysqli_query($conn,"DELETE FROM customer WHERE id_customer='$id_customer'");
	header('location:data-pelanggan.php');
?>