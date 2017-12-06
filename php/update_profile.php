<?php 
	require_once 'db.php';
	require_once 'error.php';
	include 'url.php';
	session_start();
	set_error_handler('handleError');
	$nama = $_POST['name'];
	$nama = mysqli_real_escape_string($conn,($nama));
	$alamat= $_POST['address'];
	$alamat = mysqli_real_escape_string($conn,($alamat));
	$no_telp= $_POST['phone'];
	$no_telp=mysqli_real_escape_string($conn,($no_telp));
	$id=$_SESSION['id_user'];
    $sql = "UPDATE customer SET nama='$nama',alamat='$alamat',no_telp='$no_telp' WHERE id_customer='$id'";
    $result = mysqli_query($conn,$sql);
    if($result){
    	echo "ok";
    	header('Location:'.$data_user);
    }
    else
    	echo mysqli_error($conn);

?>