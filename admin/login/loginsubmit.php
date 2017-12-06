<?php
session_start();
include "../config.php";

$username = $_POST['username'];
$password = $_POST['password'];
$tipe = $_POST['tipe'];

	$valid = true;
    if (empty($username)) {
        $usernameError = 'Masukkan Username';
        $valid = false;
    }

    if (empty($password)) {
        $alamatError = 'Masukkan Password';
        $valid = false;
    }

    if (empty($tipe)) {
        $tipeError = 'Pilih Hak Akses';
        $valid = false;
    }


    if($valid){
		$query = "SELECT * FROM pegawai WHERE username='$username'";
		$hasil = mysqli_query($conn, $query) or die ("Error".mysqli_error($conn));
		$data = mysqli_fetch_array($hasil, MYSQLI_ASSOC);
		$pengacak ="NDJS3289JSKS190JISJI";

		if(md5($pengacak.md5($password).$pengacak) == $data['password'] && $tipe == $data['tipe']){
			$_SESSION['username']=$username;
			$_SESSION['tipe']=$tipe;
			$_SESSION['isLoggedIn']=1;
			echo "<script>alert('Berhasil Login, Selamat datang $username');</script>";
			if($_SESSION['tipe']==1)
				echo "<meta http-equiv='refresh' content='0;URL=../index.php'>";
			else if($_SESSION['tipe']==2)
				echo "<meta http-equiv='refresh' content='0;URL=../data-pelanggan.php'>";
			else if($_SESSION['tipe']==3)
				echo "<meta http-equiv='refresh' content='0;URL=../transaksi.php'>";
		}
		else{
			echo"<script>alert('Gagal Login');</script>";
			echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
		}
	}
	
?>
