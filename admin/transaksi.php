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
                        <h4>Semua Transaksi</h4>
                        <div class="table-responsive">
                             <button type="button" data-toggle="modal" data-target="#ModalAdd" class="btn btn-success pull-right" style="margin-bottom: 10px"><span class="glyphicon glyphicon-plus"></span> &nbsp;Transaksi Baru
                            </button>
                            <table class="js-dynamitable table table-bordered table-hover table-striped tablesorter" style="cursor: pointer;">
                                <thead>
                                    <tr>
                                        <th width="5%"><center>No Nota</center></th>
                                        <th width="9%"><center>Nama Pegawai</center></th>
                                        <th width="9%"><center>Nama Pelanggan</center></th>
                                        <th width="3%"><center>Berat (kg)</center></th>
                                        <th width="9%"><center>Nama Layanan</center></th>
                                        <th width="6%"><center>Biaya (Rp)</center></th>
                                        <th width="10%"><center>Tgl Order</center></th>
                                        <th width="10%"><center>Tgl Selesai</center></th>
                                        <th width="4%"><center>Status</center></th>
                                        <th width="7%"><center>Total Pembayaran (Rp)</center></th>
                                        <th width="15%"><center>Action</center></th>
                                    </tr>
                                    <tr>
                                        <th><input class="js-filter form-control" type="text" value=""></th>
                                        <th><input class="js-filter form-control" type="text" value=""></th>
                                        <th><input class="js-filter form-control" type="text" value=""></th>
                                        <th><input class="js-filter form-control" type="text" value=""></th>
                                        <th><input class="js-filter form-control" type="text" value=""></th>
                                        <th><input class="js-filter form-control" type="number" value=""></th>
                                        <th><input style="width: 100px;font-size: 1rem;" class="js-filter form-control" type="date" value=""></th>
                                        <th><input style="width: 100px;font-size: 1rem;" class="js-filter form-control" type="date" value=""></th>
                                        <th> 
                                            <select class="js-filter form-control">
                                                <option value="">Semua</option>
                                                <option value="Menunggu">Menunggu</option>
                                                <option value="Proses">Proses</option>
                                                <option value="Selesai">Selesai</option>
                                            </select>
                                        </th>
                                         <th><input class="js-filter form-control" type="number" value=""></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php

                                    $limit = 5;  
                                    if (isset($_GET["page"])) { 
                                        $page  = $_GET["page"]; 
                                    } 
                                    else { 
                                        $page=1; 
                                    };  
                                    $start_from = ($page-1) * $limit;  

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
                                            inner join pegawai on pegawai.id_pegawai = list_order.id_pegawai
                                            inner join customer on customer.id_customer = list_order.id_user
                                            inner join layanan on layanan.id_layanan = list_order.id_layanan
                                            order by id_order 
                                            DESC LIMIT $start_from, $limit";  
                                    $rs_result = mysqli_query($conn, $query);
                                    $number = 1;
                                    if (!$rs_result) {
                                        die('error' . mysqli_error($conn));
                                    }
                                    while ($row = mysqli_fetch_array($rs_result, MYSQLI_ASSOC)) {
                                        $id_order = $row['id_order'];
                                ?>
                                    <tr>
                                        <td class="align-middle"><?php echo $row['no_nota']; ?></td>
                                        <td class="align-middle"><?php echo $row['nama_pegawai']; ?></td>
                                        <td class="align-middle"><?php echo $row['nama_customer']; ?></td>
                                        <td class="align-middle text-center"><?php echo $row['berat']; ?></td>
                                        <td class="align-middle"><?php echo $row['nama_layanan']; ?></td>
                                        <td class="align-middle text-right"><?php echo number_format($row['biaya_layanan']); ?></td>
                                        <td class="align-middle text-right"><?php echo $row['tgl_order']; ?></td>
                                        <td class="align-middle text-right"><?php echo $row['tgl_selesai']; ?></td>
                                        <td class="align-middle">
                                            <?php
                                                if($row['status'] == 'Menunggu')
                                                    echo '<span class="label label-warning">Menunggu</span>';
                                                else if($row['status'] == 'Proses')
                                                    echo '<span class="label label-info">Proses</span>';
                                                else 
                                                    echo '<span class="label label-success">Selesai</span>';
                                            ?>
                                        </td>
                                        <td class="align-middle text-right"><?php echo number_format($row['berat']*$row['biaya_layanan']); ?></td>
                                        <td class="align-middle text-center">
                                            <?php 
                                                if($row['status']=='Proses'){ 

                                                if($row['berat']){?>
                                                <a href="#" class="open_modal btn btn-primary" id="<?php echo $row['id_order']; ?>"><span class="glyphicon glyphicon-euro"></span></a>
                                                <?php } else {?>
                                                <a href="#" class="open_modal_berat btn btn-warning" id="<?php echo $row['id_order']; ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                                <?php }?>
                                                <a href="#" onclick="confirm_modal('proses_hapus_transaksi.php?&id_order=<?php echo $row['id_order']; ?>');" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>

                                            <?php } else if($row['status']=='Menunggu') {?>
                                                <a href="#" onclick="edit_modal('proses_edit_transaksi.php?&id_order=<?php echo $row['id_order']; ?>');" class="btn btn-info"><span class="glyphicon glyphicon-ok"></span></a>
                                                <!-- <a href="#" class="btn btn-primary" disabled><span class="glyphicon glyphicon-euro"></span></a> -->
                                                <a href="#" onclick="confirm_modal('proses_hapus_transaksi.php?&id_order=<?php echo $row['id_order']; ?>');" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>

                                            <?php } else { ?>
                                                <!-- <a href="#" class="btn btn-info" disabled><span class="glyphicon glyphicon-ok"></span></a>
                                                <a href="#" class="btn btn-primary" disabled><span class="glyphicon glyphicon-euro"></span></a>
                                                 <a href="#" class="btn btn-danger" disabled><span class="glyphicon glyphicon-trash"></span></a> -->
                                                <a href="javascript:void(0);" class="btn btn-success" onclick="window.open('cetak_struk.php?id_order=<?php echo $id_order; ?>')"><span class="glyphicon glyphicon-print"></span> Cetak</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                   <?php 
                                        $number++; 
                                    } ?>

                                </tbody>
                            </table>
                            <?php  
                                $sql = "SELECT COUNT(id_order) FROM list_order";  
                                $rs_result = mysqli_query($conn, $sql);  
                                $row = mysqli_fetch_row($rs_result);  
                                $total_records = $row[0];  
                                $total_pages = ceil($total_records / $limit);  
                                $pagLink = "<nav><ul class='pagination'>";  
                                for ($i=1; $i<=$total_pages; $i++) {  
                                    $pagLink .= "<li><a href='transaksi.php?page=".$i."'>".$i."</a></li>";  
                                };  
                                echo $pagLink . "</ul></nav>";  
                            ?>
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

    <!-- jQuery -->
    <div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Transaksi Baru</h4>
                </div>

                <div class="modal-body">
                    <form action="proses_simpan_transaksi.php" name="modal_popup" enctype="multipart/form-data" method="POST">

                        <div class="form-group">
                            <label>No Nota</label>
                            <?php

                                $sql = mysqli_query($conn, "SELECT no_nota FROM list_order");
                                echo '<input type="text" class="form-control" id="no_nota" value="';
                                $no_nota = "TR001";
                                if(mysqli_num_rows($sql) == 0){
                                    echo $no_nota;
                                }
                                $result = mysqli_num_rows($sql);
                                $counter = 0;
                                while(list($no_nota) = mysqli_fetch_array($sql)){
                                    if (++$counter == $result) {
                                        $no_nota++;
                                        echo $no_nota;
                                    }
                                }
                                echo '"name="no_nota" placeholder="No Nota" readonly>';
                            ?>
                        </div>
                        <div class="form-group">
                            <label>ID Pegawai</label>
                            <?php
                                $sql = mysqli_query($conn, "SELECT id_pegawai, nama FROM pegawai WHERE username='".$_SESSION['username']."'");
                                $idPegawai = mysqli_fetch_array($sql, MYSQLI_ASSOC);
                                //print_r($idPegawai);
                                
                            ?>

                            <input type="number" class="form-control" id="id_pegawai" name="id_pegawai" placeholder="ID Pegawai" value=<?php echo $idPegawai['id_pegawai']; ?> readonly>
                        </div>
                        <div class="form-group">
                            <script>
                                $(document).ready(function(){ 
                                    $("#id_customer").change(function(){ 
                                        var id_customer = $(this).val();
                                        var nama = $(this).val();
                                        $.ajax({ 
                                            type: "POST", 
                                            url: "action.php", 
                                            data: {
                                                "nama": nama,
                                                "id_customer": id_customer,
                                               
                                            }, 
                                            dataType: 'json', 
                                        }); 
                                    }); 
                                });
                            </script>
                            <label>Nama Customer</label>
                            <select name="id_customer" class="form-control" id="id_customer" required>
                                <option value="" disable>Nama Customer</option>
                                <?php
                                    $query = mysqli_query($conn, "SELECT id_customer, nama FROM CUSTOMER");
                                    while(list($id_customer, $nama) = mysqli_fetch_array($query)){
                                        echo '<option value="'.$id_customer.'">'.$nama.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Berat (Kg.)</label>
                            <input type="number" class="form-control" id="berat" name="berat" placeholder="Berat (Kg.)" required>
                        </div>
                        <div class="form-group">
                            <script>
                                $(document).ready(function(){ 
                                    $("#nama_layanan").change(function(){ 
                                        var id_layanan = $(this).val();
                                        var nama_layanan = $(this).val();
                                        var biaya_layanan = $(this).val(); 
                                        $.ajax({ 
                                            type: "POST", 
                                            url: "action.php", 
                                            data: {
                                                "nama_layanan": nama_layanan,
                                                "id_layanan": id_layanan,
                                                "biaya_layanan" : biaya_layanan
                                            }, 
                                            dataType: 'json', 
                                            success: function(result){
                                              $("#biaya").val(result.biaya);
                                            }
                                        }); 
                                    }); 
                                });
                            </script>
                            <label>Nama Layanan</label>
                            <select name="id_layanan" class="form-control" id="nama_layanan" required>
                                <option value="" disable>Nama Layanan</option>
                                <?php
                                    $query = mysqli_query($conn, "SELECT id_layanan, nama_layanan, biaya_layanan FROM layanan");
                                    while(list($id_layanan, $nama_layanan, $biaya_layanan) = mysqli_fetch_array($query)){
                                        echo '<option value="'.$id_layanan.'">'.$nama_layanan.'('.$biaya_layanan.')'.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">
                                Simpan
                            </button>

                            <button type="reset" class="btn btn-default"  data-dismiss="modal" aria-hidden="true">
                                Batal
                            </button>
                        </div>

                    </form>



                </div>


            </div>
        </div>
    </div>

    <div id="ModalBayar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    </div>

    <!-- Modal Popup untuk delete--> 
    <div class="modal fade" id="modal_delete">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Konfirmasi</h4>
                </div>

                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-primary" id="delete_link">Hapus</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal popup Untuk mengubah status -->
    <div class="modal fade" id="modal_edit">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Proses?</h4>
                </div>

                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-primary" id="edit_link">Ya</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>
    <div id="ModalBerat" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dynamitable.jquery.min.js"></script>
    <script type="text/javascript">
       $(document).ready(function () {
       $(".open_modal_berat").click(function(e) {
          var m = $(this).attr("id");
               $.ajax({
                        url: "berat.php",
                        type: "GET",
                        data : {id_order: m,},
                        success: function (ajaxData){
                            $("#ModalBerat").html(ajaxData);
                            $("#ModalBerat").modal('show',{backdrop: 'true'});
                        }
                    });
           });
          });
    </script>
    <script type="text/javascript">
       $(document).ready(function () {
       $(".open_modal").click(function(e) {
          var m = $(this).attr("id");
               $.ajax({
                        url: "bayar.php",
                        type: "GET",
                        data : {id_order: m,},
                        success: function (ajaxData){
                            $("#ModalBayar").html(ajaxData);
                            $("#ModalBayar").modal('show',{backdrop: 'true'});
                        }
                    });
           });
          });
    </script>

    <script type="text/javascript">
        function confirm_modal(delete_url)
        {
            $("#modal_delete").modal('show', {backdrop: 'static'});
            document.getElementById('delete_link').setAttribute('href', delete_url);
        }
    </script>
    <script type="text/javascript">
        function edit_modal(edit_url)
        {
            $("#modal_edit").modal('show', {backdrop: 'static'});
            document.getElementById('edit_link').setAttribute('href', edit_url);
        }
    </script>

    <script src="js/jquery.simplePagination.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.pagination').pagination({
                items: <?php echo $total_records;?>,
                itemsOnPage: <?php echo $limit;?>,
                cssStyle: 'light-theme',
                currentPage : <?php echo $page;?>,
                hrefTextPrefix : 'transaksi.php?page='
            });
        });
    </script> 
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
    <script type="text/javascript">
        $(document).ready(function() { 
            $("#myTable").tablesorter( {sortList: [[0,0], [1,0]]} ); 
        }); 
    </script> 

</body>

</html>
