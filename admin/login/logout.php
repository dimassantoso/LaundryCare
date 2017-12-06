<?php
include '../config.php';
session_start();
// menghapus session username
session_destroy();
echo"<script>alert('Anda akan keluar');</script>";
echo "<meta http-equiv='refresh' content='0;URL=../index.php'>";
mysqli_close($conn);
?>
