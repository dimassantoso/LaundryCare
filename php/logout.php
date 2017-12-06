<?php
	include 'url.php';
	session_start();
	session_unset();
	session_destroy();
	setcookie("user_address","", time() - 3600);

	header("Location:$home");
?>