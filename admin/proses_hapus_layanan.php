<?php
	include "config.php";
	$id_layanan=$_GET['id_layanan'];
	$modal=mysqli_query($conn,"DELETE FROM layanan WHERE id_layanan='$id_layanan'");
	header('location:data-biaya.php');
?>