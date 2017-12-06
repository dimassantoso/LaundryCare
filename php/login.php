<?php 
  include 'db.php';
  include 'url.php';
  require_once 'error.php';
  session_start();
  set_error_handler('handleError');
  
  if(isset( $_POST['email'])&&isset($_POST['pass'])){
        $myemail = mysqli_real_escape_string($conn,$_POST['email']);
        $mypassword = mysqli_real_escape_string($conn,($_POST['pass']));
        $mypassword = md5($mypassword); 
        mysqli_select_db($conn,"laundry");
        $sql = "SELECT * FROM customer WHERE email = '$myemail' AND password = '$mypassword'";
        $result = mysqli_query($conn,$sql);
        // if(!$result)
        //  die("Invalid Query ".mysqli_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count == 1) {
         // session_register("myemail");
          $_SESSION['login_user'] = $myemail;
          $_SESSION['id_user'] = $row['id_customer'];
          setcookie("user_address",$row['alamat'],time() + (86400 * 30), "/");
         
          echo "ok";
         //header("Location:$home");
         // exit();
        }else {
          echo "Your Login Name or Password is invalid";
     
    }
    mysqli_close($conn);
  } 
  else 
    echo "Please fill out the required fields";
?>