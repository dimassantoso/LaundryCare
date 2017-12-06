<?php
include "config.php";
$nama = $_POST['nama'];
$biaya = $_POST['biaya'];

mysqli_query($conn,"INSERT INTO layanan VALUES ('','$nama', '$biaya')");
header('location:data-biaya.php');
?>