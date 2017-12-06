<?php 
	function cekEmail($email){
		include 'db.php';
		mysqli_select_db($conn,"laundry");
        $sql = "SELECT email FROM customer WHERE email = '$email'";
      	$result = mysqli_query($conn,$sql);
      	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      	$count = mysqli_num_rows($result);
      	if($count>0)
      		return false;
      	else
      		return true;
	}
  function cekID($id){
    include 'db.php';
    mysqli_select_db($conn,"laundry");
        $sql = "SELECT id_customer FROM customer WHERE id_customer = '$id'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count>0)
          return false;
        else
          return true;
  }
?>