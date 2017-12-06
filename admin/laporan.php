<?php
    date_default_timezone_set('Asia/Jakarta');
    include 'config.php';
    include 'include/header.php';
?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
            include('include/nav.php');
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Manajemen
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-table"></i> Manajemen
                            </li>
                            <li class="active">
                                Transaksi
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <h4>Transaksi</h4>
                        <div class="table-responsive">
                             <div class="well well-sm noprint">
                                <form class="form-inline" role="form" method="post" action="">
                                  <div class="form-group">
                                    <label class="sr-only" for="tgl1">Mulai</label>
                                    <input type="date" class="form-control" id="tgl1" name="tgl1" required>
                                  </div>
                                  <div class="form-group">
                                    <label class="sr-only" for="tgl2">Hingga</label>
                                    <input type="date" class="form-control" id="tgl2" name="tgl2" required>
                                  </div>
                                  <button type="submit" name="submit" class="btn btn-success">Tampilkan</button>
                                </form>
                            </div>
                            <?php if(isset($_REQUEST['submit'])){
                                $grand_total = 0;
                                    $submit = $_REQUEST['submit'];
                                    $tgl1 = $_REQUEST['tgl1'];
                                    $tgl2 = $_REQUEST['tgl2'];
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
                                    if(mysqli_num_rows($rs_result) > 0){
                                        ?>
                                            <div class="dropdown pull-right" style="margin-bottom : 10px;">
                                                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-export"></span>
                                                    Cetak
                                                    <span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                      <li><a href="#" onclick="window.open('laporan_cetak.php?tgl1=<?php echo $tgl1; ?>&tgl2=<?php echo $tgl2; ?>')">PDF</a></li>
                                                      <li class="divider"></li>
                                                      <li><a href="#" id="exportExcel">EXCEL</a></li>
                                                    </ul>
                                                  </div>
                                            <h4><center>Laporan Transaksi LaundryCare<br>Per <?php echo $tgl1." sampai ".$tgl2; ?></center></h4>
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
                                                <?php while ($row = mysqli_fetch_array($rs_result, MYSQLI_ASSOC)) {  ?>
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
                                            <table id="report" class="js-dynamitable table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th><center>Total Pelanggan</center></th>
                                                        <th><center>Total Pendapatan</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="align-middle text-center"><?php $total_pelanggan = mysqli_num_rows($rs_result); echo $total_pelanggan; ?></td>
                                                        <td class="align-middle text-center"><?php echo number_format($grand_total);?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <?php } else echo "Tidak/belum ada transaksi di tanggal tersebut atau Transaksi belum selesai"; } ?>
                                        </div>
                        </div>
                </div>
                <!-- /.row -->     

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.base64.js"></script>
    <script src="js/jquery.btechco.excelexport.js"></script>
    <script>
            $(document).ready(function () {
                $("#exportExcel").click(function () {
                    $("#report").btechco_excelexport({
                        containerid: "report"
                       , datatype: $datatype.Table
                    });
                });
            });
    </script>

</body>

</html>
