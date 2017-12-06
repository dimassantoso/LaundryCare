<?php
date_default_timezone_set('Asia/Jakarta');
include "config.php";
$no_nota = $_POST['no_nota'];
$id_pegawai = $_POST['id_pegawai'];
$id_user = $_POST['id_customer'];
$berat = $_POST['berat'];
$id_layanan = $_POST['id_layanan'];
$biaya = $_POST['biaya'];
$bayar = $_POST['bayar'];
$total_biaya = $biaya*$berat;

$tgl_order = date('Y-m-d');
$tgl_selesai = $tgl_order;
$tgl_selesai = date('Y-m-d', strtotime('+ 3 days'));

$retval = mysqli_query($conn,"INSERT INTO list_order VALUES ('','$no_nota','$id_layanan', '$id_pegawai', '$id_user', '$berat', '$tgl_order', '$tgl_selesai', 'Menunggu', '')");

if (!$retval) {
    die('error : ' . mysqli_error($conn));
}
header('location:transaksi.php');
?>