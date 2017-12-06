<?php
	session_start();
	if(isset($_SESSION['username']))
		echo"<script>alert('Anda sudah Log in, silahkan Log out terlebih dahulu');window.location='index.php'</script>";
	exit(1);
?>
