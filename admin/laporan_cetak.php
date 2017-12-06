<?php
    include "mpdf60/mpdf.php"; // Arahkan ke file mpdf.php didalam folder  "mpdf60/mpdf.php"df
    $mpdf=new mPDF('utf-8', 'A4', 12, 'arial'); // Membuat file mpdf baru
    ob_start(); 
    include_once "config.php";
    $tgl1   = $_GET['tgl1'];
    $tgl2   = $_GET['tgl2'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="js/bootstrap.min.js"></script>
    <title>Laporan Per <?php echo $tgl1." sampai ".$tgl2;?></title>
  </head>
  <body>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <?php
                    $grand_total = 0;
                    $query = "SELECT
                        id_order,
                        list_order.no_nota,
                        pegawai.nama as nama_pegawai,
                        list_order.berat,
                        layanan.nama_layanan as nama_layanan,
                        layanan.biaya_layanan,
                        list_order.tgl_order,
                        list_order.bayar
 
                        from
                        list_order 
                        inner join pegawai on pegawai.id_pegawai = list_order.id_pegawai
                        inner join customer on customer.id_customer = list_order.id_user
                        inner join layanan on layanan.id_layanan = list_order.id_layanan
                                            

                        WHERE 
                        tgl_order BETWEEN '$tgl1' AND '$tgl2' AND status LIKE 'Selesai'
                        ORDER BY ID_ORDER ASC";


                        $rs_result = mysqli_query($conn, $query);
                        $number = 1;
                        if (!$rs_result) {
                            die('Error : ' . mysqli_error($conn));
                        }
                        ?>
                            <h4 class="text-center"><center>Laporan Transaksi LaundryCare<br>Per <?php echo $tgl1." sampai ".$tgl2; ?></center></h4>
                            <table id="report" class="js-dynamitable table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%"><center>No Nota</center></th>
                                        <th width="9%"><center>Nama Pegawai</center></th>
                                        <th width="3%"><center>Berat (kg)</center></th>
                                        <th width="9%"><center>Nama Layanan</center></th>
                                        <th width="6%"><center>Biaya (Rp)</center></th>
                                        <th width="10%"><center>Tgl Order</center></th>
                                        <th width="7%"><center>Total Pembayaran (Rp)</center></th>
                                    </tr>
                                </thead>
                                <?php while ($row = mysqli_fetch_array($rs_result, MYSQLI_ASSOC)) { ?>
                                <tbody>
                                    <tr>
                                        <td class="align-middle"><?php echo $row['no_nota']; ?></td>
                                        <td class="align-middle"><?php echo $row['nama_pegawai']; ?></td>
                                        <td class="align-middle text-center"><?php echo $row['berat']; ?></td>
                                        <td class="align-middle"><?php echo $row['nama_layanan']; ?></td>
                                        <td class="align-middle text-right"><?php echo number_format($row['biaya_layanan']); ?></td>
                                        <td class="align-middle text-right"><?php echo $row['tgl_order']; ?></td>
                                        <td class="align-middle text-right">
                                            <?php 
                                                $total_biaya = $row['berat']*$row['biaya_layanan'];
                                                echo number_format($total_biaya); 
                                            ?>
                                        </td>
                                    </tr>
                                        <?php 
                                            $number++; 
                                            $grand_total = $grand_total + $total_biaya;  } 
                                        ?>
                                    <tr>
                                        <td colspan="6" class="align-middle text-right">Grand Total (Rp)</td>
                                        <td class="align-middle text-right"><?php echo number_format($grand_total);?></td>
                                    </tr>
                                </tbody>
                            </table>
            </div>
            <div class="table-responsive">
                <table id="report" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><center>Total Pelanggan</center></th>
                            <th><center>Total Pendapatan</center></th>
                        </tr>
                    </thead>
                    <thbody>
                        <tr>
                            <td class="align-middle text-center"><?php $total_pelanggan = mysqli_num_rows($rs_result); echo $total_pelanggan; ?></td>
                            <td class="align-middle text-center"><?php echo number_format($grand_total);?></td>
                        </tr>
                    </thbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
    ob_end_clean();
    $mpdf->WriteHTML($html);
    $mpdf->Output(".pdf" ,'I');
    exit;
?>