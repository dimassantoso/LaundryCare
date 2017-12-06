<?php 
   include_once 'db.php';
   require_once 'validate.php';
   if(isset($_POST['email2'])){
   	$myemail = mysqli_real_escape_string($conn,$_POST['email2']);
   	mysqli_select_db($conn,"laundry");
   	if(cekEmail($myemail)){
   		if (!filter_var($myemail, FILTER_VALIDATE_EMAIL)) {
      		echo "Invalid email Address"; 
    	}
    	else
   			echo "&#10004;";
   	}
   	else
   		echo "Email Address has been registered.";
   }
?>