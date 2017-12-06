<?php
	 require_once 'error.php';
	 set_error_handler('handleError');
	 $dbhost = 'localhost';
	 $dbuser = 'root';
	 $dbpass = '';
	 $dbname = 'laundry';
	 $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	 if(! $conn ) {
	 	die('Could not connect: ' . mysqli_error($conn));
	 }

	 // echo 'Connected successfully';
	 //mysqli_close($conn);
?>