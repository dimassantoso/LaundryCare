<?php 
	require_once 'db.php';
	require_once 'error.php';
	include 'url.php';
	session_start();
	set_error_handler('handleError');

	if(isset($_POST['password'])&&isset($_POST['pass_confirm'])){
		$pass = $_POST['password'];
		$pass2 = $_POST['pass_confirm'];
		if($pass==$pass2){
			$pass = mysqli_real_escape_string($conn,($pass));
        	$pass = md5($pass);
        	$id=$_SESSION['id_user'];
        	$sql = "UPDATE customer SET password='$pass' WHERE id_customer='$id'";
        	$result = mysqli_query($conn,$sql);
        	if($result)
        		echo "ok";
        	else
        		echo mysqli_error($conn);
		}
		else
    		echo "The passwords you entered do not match";
    	mysqli_close($conn);
	}
	else
		echo "Please fill out the required fields.";
?>