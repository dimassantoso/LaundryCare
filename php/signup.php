<?php 
	include 'db.php';
  	include 'url.php';
  	include 'validate.php';
  	require_once 'error.php';
  	session_start();
  	set_error_handler('handleError');
  	if(isset( $_POST['nama'])&&isset($_POST['email2'])&&isset($_POST['password'])&&isset($_POST['confirm'])){
  		if($_POST['password']==$_POST['confirm']){
  			$myemail = mysqli_real_escape_string($conn,$_POST['email2']);
	        $mypassword = mysqli_real_escape_string($conn,$_POST['password']);
	        $mypassword = md5($mypassword);
	        $myname = mysqli_real_escape_string($conn,$_POST['nama']);
	        mysqli_select_db($conn,"laundry");
	        if(cekEmail($myemail)){
	        	$sql = "SELECT count(id_customer) num FROM customer";
      			$result = mysqli_query($conn,$sql);
      			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      			$count = $row['num']+1;
	        	$sql = "INSERT INTO customer (id_customer,email, password, nama, oauth_provider) VALUES ('$count','$myemail','$mypassword','$myname','local')";
		      	$result = mysqli_query($conn,$sql);

		      	if($result){
		      		$sql="SELECT id_customer from customer where email LIKE '$myemail'";
		      		$result = mysqli_query($conn,$sql);
			      	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			      	$_SESSION['login_user'] = $myemail;
			        $_SESSION['id_user'] = $row['id_customer'];
			        setcookie("user_address", "", time() - 3600);
			        echo "ok";
			        // header("Location:$home");
				    
		      	}
		      	else
		      		echo mysqli_error($conn);
	        }else echo "Email already exists";
  		}else echo "The passwords you entered do not match";
	}
	else
		echo "NONE";
	mysqli_close($conn);
?>