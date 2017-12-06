<?php
    date_default_timezone_set('Asia/Jakarta');
    include 'include/header.php';
    include 'config.php';
    
    switch ($_SESSION['tipe']) {
        case 2: echo "<meta http-equiv='refresh' content='0;URL=data-pelanggan.php'>"; break;
        case 3: echo "<meta http-equiv='refresh' content='0;URL=transaksi.php'>"; break;
        default: break;
    } 
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
                            Dashboard 
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                        <?php 
                                            
                                            $sql = "SELECT * FROM list_order";
                                            $query = mysqli_query($conn, $sql);
                                            if($query){
                                                $count = mysqli_num_rows($query);
                                                echo $count;    
                                            }
                                            
                                        ?>
                                        </div>
                                        <div>Jumlah Transaksi</div>
                                    </div>
                                </div>
                            </div>
                            <a href="transaksi.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Lihat</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                        <?php 
                                            date_default_timezone_set('Asia/Jakarta');
                                            $now = date('Y-m-d');
                                            $sql = "SELECT * FROM list_order WHERE tgl_order = '$now'";
                                            $query = mysqli_query($conn, $sql);
                                           if($query){
                                                $count = mysqli_num_rows($query);
                                                echo $count;    
                                            }
                                        ?>
                                        </div>
                                        <div>Transaksi Hari Ini</div>
                                    </div>
                                </div>
                            </div>
                            <a href="transaksi_hari.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Lihat</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                        <?php 
                                            $sql = "SELECT * FROM customer";
                                            $query = mysqli_query($conn, $sql);
                                            if($query){
                                                $count = mysqli_num_rows($query);
                                                echo $count;    
                                            }
                                        ?>

                                        </div>
                                        <div>Pelanggan</div>
                                    </div>
                                </div>
                            </div>
                            <a href="data-pelanggan.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Lihat</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Transaksi Per Bulan</h3>
                            </div>
                            <div class="panel-body">
                                <div id="mygraph"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-plus fa-fw"></i> Transaksi Hari ini</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">

                                    <?php
                                        $today = date('Y-m-d');
                                        $query = "SELECT
                                                layanan.nama_layanan, COUNT(*) AS jumlah
                                                                              
                                                FROM
                                                list_order
                                                INNER JOIN layanan ON layanan.id_layanan = list_order.id_layanan

                                                GROUP BY layanan.nama_layanan
                                                ";  
                                    $rs_result = mysqli_query($conn, $query);
                                    $number = 1;
                                    if (!$rs_result) {
                                        die('error' . mysqli_error($conn));
                                    }
                                    ?>
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th class="align-middle text-center">Layanan #</th>
                                                <th class="align-middle text-center">Nama Layanan</th>
                                                <th class="align-middle text-center">Jumlah Transaksi</th>
                                            </tr>
                                        </thead>
                                    <?php while ($row = mysqli_fetch_array($rs_result, MYSQLI_ASSOC)) { ?>
                                        <tbody>
                                            <tr>
                                                <td class="align-middle text-center"><?php echo $number; ?></td>
                                                <td class="align-middle text-left"><?php echo $row['nama_layanan']; ?></td>
                                                <td class="align-middle text-center"><?php echo $row['jumlah']; ?></td>
                                            </tr>
                                        </tbody>
                                    <?php 
                                        $number++;} 
                                    ?>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="transaksi.php">Lihat Semua <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transaksi Hari ini</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">

                                    <?php
                                        $today = date('Y-m-d');
                                        $query = "SELECT
                                            id_order,
                                            list_order.no_nota,
                                            pegawai.nama as nama_pegawai,
                                            customer.nama as nama_customer,
                                            list_order.berat,
                                            layanan.nama_layanan as nama_layanan,
                                            layanan.biaya_layanan,
                                            list_order.tgl_order,
                                            list_order.tgl_selesai,
                                            list_order.status,
                                            list_order.bayar
 
                                            FROM
                                            list_order
                                            INNER JOIN pegawai ON pegawai.id_pegawai = list_order.id_pegawai
                                            INNER JOIN customer ON customer.id_customer = list_order.id_user
                                            INNER JOIN layanan ON layanan.id_layanan = list_order.id_layanan

                                            WHERE tgl_order = '$today'
                                            ORDER BY no_nota 
                                            DESC LIMIT 5";  
                                    $rs_result = mysqli_query($conn, $query);
                                    $number = 1;
                                    if (!$rs_result) {
                                        die('error' . mysqli_error($conn));
                                    }
                                    ?>
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th class="align-middle text-center">Order #</th>
                                                <th class="align-middle text-center">No Nota</th>
                                                <th class="align-middle text-center">Nama Pelanggan</th>
                                                <th class="align-middle text-center">Biaya Transaksi</th>
                                            </tr>
                                        </thead>
                                    <?php while ($row = mysqli_fetch_array($rs_result, MYSQLI_ASSOC)) { ?>
                                        <tbody>
                                            <tr>
                                                <td class="align-middle text-center"><?php echo $number; ?></td>
                                                <td class="align-middle text-center"><?php echo $row['no_nota']; ?></td>
                                                <td class="align-middle text-left"><?php echo $row['nama_customer']; ?></td>
                                                <td class="align-middle text-right"><?php echo number_format($row['berat']*$row['biaya_layanan']); ?></td>
                                            </tr>
                                        </tbody>
                                    <?php 
                                        $number++;} 
                                    ?>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="transaksi_hari.php">Lihat Semua <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-file fa-fw"></i> Laporan Bulan Ini</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">

                                    <?php
                                        $grand_total = 0;
                                        $query = "select
                                            id_order,
                                            list_order.no_nota,
                                            list_order.berat,
                                            layanan.biaya_layanan,
                                            list_order.bayar
 
                                            from
                                            list_order 
                                            inner join layanan on layanan.id_layanan = list_order.id_layanan
                                            

                                            where 
                                            month(tgl_order) = month(curdate()) and status like 'selesai'
                                            order by id_order desc limit 5";  
                                    $rs_result = mysqli_query($conn, $query);
                                    $number = 1;
                                    if (!$rs_result) {
                                        die('error' . mysqli_error($conn));
                                    }
                                    ?>
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th class="align-middle text-center">Order #</th>
                                                <th class="align-middle text-center">No Nota</th>
                                                <th class="align-middle text-center">Biaya Transaksi</th>
                                            </tr>
                                        </thead>
                                    <?php while ($row = mysqli_fetch_array($rs_result, MYSQLI_ASSOC)) { ?>
                                        <tbody>
                                            <tr>
                                                <td class="align-middle text-center"><?php echo $number; ?></td>
                                                <td class="align-middle text-center"><?php echo $row['no_nota']; ?></td>
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
                                                <td colspan="2" class="align-middle text-right">Grand Total (Rp)</td>
                                                <td class="align-middle text-right"><?php echo number_format($grand_total);?></td>
                                            </tr>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="laporan.php">Lihat Semua <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var chart;
            $(document).ready(function() {
                $.getJSON("data-chart.php", function(json) {
                
                    chart = new Highcharts.Chart({
                        chart: {
                            renderTo: 'mygraph',
                            type: 'line'
                            
                        },
                        title: {
                            text: 'Grafik Transaksi Per Bulan'
                            
                        },
                        subtitle: {
                            text: ''
                        
                        },
                        xAxis: {
                            title:{
                                text: 'Bulan'
                            },
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                        },
                        yAxis: {
                            title: {
                                text: 'Total Transaksi (Rp)'
                            },
                            plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                        },
                        tooltip: {
                            formatter: function() {
                                    return '<b>'+ 'Total Transaksi (Rp) : ' +'</b><br/>'+ 
                                    this.x +' : '+ this.y;
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'top',
                            x: -10,
                            y: 120,
                            borderWidth: 0
                        },
                        series: json
                    });
                });
            
            });
            
        });
        </script>
    <script src="js/highcharts.js"></script>
    <script src="js/exporting.js"></script>
</body>

</html>
