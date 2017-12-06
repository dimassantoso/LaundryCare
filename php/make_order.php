<?php 
	include 'db.php';
  include 'url.php';
  require_once 'error.php';
	session_start();
  	set_error_handler('handleError');
  	if(isset($_POST['service'])){
      $id = $_SESSION['id_user'];
  		$myaddr = mysqli_real_escape_string($conn,$_POST['address']);
  		$petugas =  rand(10,14);
      $id_layanan = $_POST['service'];
  		mysqli_select_db($conn,"laundry");
      $sql = "SELECT count(id_order) num FROM list_order";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $count = $row['num']+1;
      $id_order = "TR00".$count;
      $status = "Menunggu";
      $order_date = date('Y-m-d');
      $tgl_selesai = date('Y-m-d', strtotime('+ 3 days'));
  		$sql = "INSERT INTO list_order(no_nota, id_layanan, id_pegawai,id_user,tgl_order,tgl_selesai,status) VALUES('$id_order','$id_layanan','$petugas','$id','$order_date','$tgl_selesai','$status')";
      $result = mysqli_query($conn,$sql);
      if ($result){
        echo "ok";
      }
      else
        echo "Something wrong ".mysqli_error($conn);
  	}
    else
      echo "Please choose your desired service";
  	mysqli_close($conn);
?>