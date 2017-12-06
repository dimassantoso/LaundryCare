<?php
    include 'include/header.php';
    if($_SESSION['tipe']==3){
        echo "<script>alert('Anda Tidak Diijinkan Mengakses Halaman Ini');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=transaksi.php'>";
    }
?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
        include 'include/nav.php';
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Data Master
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-table"></i> Data Master
                            </li>
                            <li class="active">
                                Data Pelanggan
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <h4>Data Pelanggan</h4>
                        <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#ModalAdd" class="btn btn-success pull-right" style="margin-bottom: 10px"><span class="glyphicon glyphicon-plus"></span> &nbsp;Tambah Data
                            </button>
                            <table class="js-dynamitable table table-bordered table-hover table-striped tablesorter" style="cursor: pointer;">
                                <thead>
                                    <tr>
                                        <th width="5%"><center>No</center></th>
                                        <th width="25%"><center>Nama Pelanggan</center></th>
                                        <th width="30%"><center>Alamat</center></th>
                                        <th width="10%"><center>No. HP</center></th>
                                        <th width="10%"><center>Email</center></th>
                                        <th width="25%"><center>Action</center></th>
                                    </tr>
                                    </tr>
                                        <th></th>
                                        <th><input class="js-filter form-control" type="text" value=""></th>
                                        <th><input class="js-filter form-control" type="text" value=""></th>
                                        <th><input class="js-filter form-control" type="number" value=""></th>
                                        <th><input class="js-filter form-control" type="email" value=""></th>
                                        <th></th>
                                    <tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'config.php';

                                    $limit = 5;  
                                    if (isset($_GET["page"])) { 
                                        $page  = $_GET["page"]; 
                                    } 
                                    else { 
                                        $page=1; 
                                    };  
                                    $start_from = ($page-1) * $limit;  

                                    $query = "SELECT * 
                                            FROM customer
                                            ORDER BY id_customer 
                                            ASC LIMIT $start_from, $limit";  
                                    $rs_result = mysqli_query($conn, $query); 
                                    $number = 1;
                                    if (!$rs_result) {
                                        die('error' . mysqli_error($conn));
                                    }
                                    while ($row = mysqli_fetch_array($rs_result, MYSQLI_ASSOC)) {
                                        ?>
                                        <tr>
                                            <td class="align-middle text-center"><?php echo $number ?></td>
                                            <td class="align-middle"><?php echo $row['nama']; ?></td>
                                            <td class="align-middle"><?php echo $row['alamat']; ?></td>
                                            <td class="align-middle"><?php echo $row['no_telp']; ?></td>
                                            <td class="align-middle"><?php echo $row['email']; ?></td>
                                            <td class="align-middle text-center">
                                               <a href="#" class="open_modal btn btn-warning" id="<?php echo $row['id_customer']; ?>"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                                                <a href="#" onclick="confirm_modal('proses_hapus_pelanggan.php?&id_customer=<?php echo $row['id_customer']; ?>');" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                                            </td>
                                        </tr>
                                        <?php $number++;
                                    } ?>
                                </tbody>
                            </table>
                            <?php  
                                $sql = "SELECT COUNT(id_customer) FROM customer";  
                                $rs_result = mysqli_query($conn, $sql);  
                                $row = mysqli_fetch_row($rs_result);  
                                $total_records = $row[0];  
                                $total_pages = ceil($total_records / $limit);  
                                $pagLink = "<nav><ul class='pagination'>";  
                                for ($i=1; $i<=$total_pages; $i++) {  
                                        $pagLink .= "<li><a href='data-pelanggan.php?page=".$i."'>".$i."</a></li>";  
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
    <!-- Modal Popup untuk Add--> 
    <div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
                </div>

                <div class="modal-body">
                    <form action="proses_simpan_pelanggan.php" name="modal_popup" enctype="multipart/form-data" method="POST">

                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pelanggan">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" placeholder="Alamat" required/></textarea>
                        </div>
                        <div class="form-group">
                            <label>No. Telp</label>
                            <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="No. Telp">
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

    <!-- Modal Popup untuk Edit--> 
    <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

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

    <!-- Javascript untuk popup modal Edit--> 
    <!-- jQuery -->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dynamitable.jquery.min.js"></script>
    <script type="text/javascript">
       $(document).ready(function () {
       $(".open_modal").click(function(e) {
          var m = $(this).attr("id");
               $.ajax({
                        url: "edit_pelanggan.php",
                        type: "GET",
                        data : {id_customer: m,},
                        success: function (ajaxData){
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal('show',{backdrop: 'true'});
                        }
                    });
           });
          });
    </script>
    <!-- Javascript untuk popup modal Delete--> 
    <script type="text/javascript">
        function confirm_modal(delete_url)
        {
            $("#modal_delete").modal('show', {backdrop: 'static'});
            document.getElementById('delete_link').setAttribute('href', delete_url);
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
                hrefTextPrefix : 'data-pelanggan.php?page='
            });
        });
    </script>
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
    <!-- <script type="text/javascript">
        $(document).ready(function() { 
            $("#myTable").tablesorter( {sortList: [[0,0], [1,0]]} ); 
        }); 
    </script>  -->

</body>

</html>
