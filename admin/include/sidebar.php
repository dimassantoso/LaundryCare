<?php 

function echoActiveClassIfRequestMatches($requestUri){
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
    if ($current_file_name == $requestUri)
        echo 'class="active"';
}

?>
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <?php if($_SESSION['tipe']==3){ ?>
           <li <?=echoActiveClassIfRequestMatches("transaksi") || echoActiveClassIfRequestMatches("transaksi_hari")?>>
                <a href="javascript:;" data-toggle="collapse" data-target="#manajemen"><i class="fa fa-fw fa-bar-chart-o"></i> Manajemen <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="manajemen" class="collapse">
                    <!-- <li <?=echoActiveClassIfRequestMatches("transaksi")?>>
                        <a href="transaksi.php">Transaksi</a>
                    </li> -->
                    <li <?=echoActiveClassIfRequestMatches("transaksi") || echoActiveClassIfRequestMatches("transaksi_hari")?>>
                        <a href="javascript:;" data-toggle="collapse" data-target="#transaksi"><i class="fa fa-fw fa-money"></i> Transaksi <span class="fa fa-fw fa-caret-down"></a>
                        <ul id="transaksi" class="collapse">
                            <li <?=echoActiveClassIfRequestMatches("transaksi_hari")?> style="display: block; padding: 10px 15px 10px 38px;background-color: transparent;">
                                <a href="transaksi_hari.php" style="text-decoration: none; color: #999;">Transaksi Hari Ini</a>
                            </li>
                            <li <?=echoActiveClassIfRequestMatches("transaksi")?> style="display: block; padding: 10px 15px 10px 38px;">
                                <a href="transaksi.php" style="text-decoration: none; color: #999;">Semua Transaksi</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        <?php } elseif ($_SESSION['tipe']==2) { ?>
            <li <?=echoActiveClassIfRequestMatches("data-pelanggan") || echoActiveClassIfRequestMatches("data-biaya") ?>>
                <a href="javascript:;" data-toggle="collapse" data-target="#data-master"><i class="fa fa-fw fa-table"></i> Data Master <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="data-master" class="collapse">
                    <li <?=echoActiveClassIfRequestMatches("data-pelanggan")?>>
                        <a href="data-pelanggan.php">Data Pelanggan</a>
                    </li>
                    <li <?=echoActiveClassIfRequestMatches("data-biaya")?>>
                        <a href="data-biaya.php">Data Biaya Layanan</a>
                    </li>
                </ul>
            </li>
            <li <?=echoActiveClassIfRequestMatches("transaksi") || echoActiveClassIfRequestMatches("transaksi_hari") || echoActiveClassIfRequestMatches("laporan")?>>
                <a href="javascript:;" data-toggle="collapse" data-target="#manajemen"><i class="fa fa-fw fa-bar-chart-o"></i> Manajemen <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="manajemen" class="collapse">
                    <!-- <li <?=echoActiveClassIfRequestMatches("transaksi")?>>
                        <a href="transaksi.php">Transaksi</a>
                    </li> -->
                    <li <?=echoActiveClassIfRequestMatches("transaksi") || echoActiveClassIfRequestMatches("transaksi_hari")?>>
                        <a href="javascript:;" data-toggle="collapse" data-target="#transaksi"><i class="fa fa-fw fa-money"></i> Transaksi <span class="fa fa-fw fa-caret-down"></a>
                        <ul id="transaksi" class="collapse">
                            <li <?=echoActiveClassIfRequestMatches("transaksi_hari")?> style="display: block; padding: 10px 15px 10px 38px;background-color: transparent;">
                                <a href="transaksi_hari.php" style="text-decoration: none; color: #999;">Transaksi Hari Ini</a>
                            </li>
                            <li <?=echoActiveClassIfRequestMatches("transaksi")?> style="display: block; padding: 10px 15px 10px 38px;">
                                <a href="transaksi.php" style="text-decoration: none; color: #999;">Semua Transaksi</a>
                            </li>
                        </ul>
                    </li>
                    <li <?= echoActiveClassIfRequestMatches("laporan")?>>
                        <a href="laporan.php"><i class="fa fa-fw fa-file"></i> Laporan</a>
                    </li>
                </ul>
            </li>
        <?php } else{ ?>
            <li <?=echoActiveClassIfRequestMatches("index")?>>
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li <?=echoActiveClassIfRequestMatches("data-pelanggan") || echoActiveClassIfRequestMatches("data-biaya") ?>>
                <a href="javascript:;" data-toggle="collapse" data-target="#data-master"><i class="fa fa-fw fa-table"></i> Data Master <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="data-master" class="collapse">
                    <li <?=echoActiveClassIfRequestMatches("data-pelanggan")?>>
                        <a href="data-pelanggan.php">Data Pelanggan</a>
                    </li>
                    <li <?=echoActiveClassIfRequestMatches("data-biaya")?>>
                        <a href="data-biaya.php">Data Biaya Layanan</a>
                    </li>
                </ul>
            </li>
            <li <?=echoActiveClassIfRequestMatches("transaksi") || echoActiveClassIfRequestMatches("transaksi_hari") || echoActiveClassIfRequestMatches("laporan")?>>
                <a href="javascript:;" data-toggle="collapse" data-target="#manajemen"><i class="fa fa-fw fa-bar-chart-o"></i> Manajemen <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="manajemen" class="collapse">
                    <!-- <li <?=echoActiveClassIfRequestMatches("transaksi")?>>
                        <a href="transaksi.php">Transaksi</a>
                    </li> -->
                    <li <?=echoActiveClassIfRequestMatches("transaksi") || echoActiveClassIfRequestMatches("transaksi_hari")?>>
                        <a href="javascript:;" data-toggle="collapse" data-target="#transaksi"><i class="fa fa-fw fa-money"></i> Transaksi <span class="fa fa-fw fa-caret-down"></a>
                        <ul id="transaksi" class="collapse">
                            <li <?=echoActiveClassIfRequestMatches("transaksi_hari")?> style="display: block; padding: 10px 15px 10px 38px;background-color: transparent;">
                                <a href="transaksi_hari.php" style="text-decoration: none; color: #999;">Transaksi Hari Ini</a>
                            </li>
                            <li <?=echoActiveClassIfRequestMatches("transaksi")?> style="display: block; padding: 10px 15px 10px 38px;">
                                <a href="transaksi.php" style="text-decoration: none; color: #999;">Semua Transaksi</a>
                            </li>
                        </ul>
                    </li>
                    <li <?= echoActiveClassIfRequestMatches("laporan")?>>
                        <a href="laporan.php"><i class="fa fa-fw fa-file"></i> Laporan</a>
                    </li>
                </ul>
            </li>
            <li <?=echoActiveClassIfRequestMatches("user_login")?>>
                <a href="user_login.php"><i class="fa fa-fw fa-user"></i> User Login</a>
            </li>
        <?php } ?>
    </ul>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('ul li a').click(function(){
            $('li a').removeClass("active");
            $(this).addClass("active");
        });
    });
</script>