<?php
    include 'include/header.php';
    if($_SESSION['tipe']!=1){
        echo "<script>alert('Anda Tidak Diijinkan Mengakses Halaman Ini');</script>";
        if($_SESSION['tipe']==3)
            echo "<meta http-equiv='refresh' content='0;URL=transaksi.php'>";
        else if($_SESSION['tipe']==2)
            echo "<meta http-equiv='refresh' content='0;URL=data-pelanggan.php'>";
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
                                User Login
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-table"></i> User Login
                                </li>
                                <li class="active">
                                    Data User Login
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <h4>Data User Login</h4>
                            <div class="table-responsive">
                                <button type="button" data-toggle="modal" data-target="#ModalAdd" class="btn btn-success pull-right" style="margin-bottom: 10px"><span class="glyphicon glyphicon-plus"></span> &nbsp;Tambah Data
                                </button>
                                <table class="table table-bordered table-hover table-striped js-dynamitable tablesorter" style="cursor: pointer;">
                                    <thead>
                                        <tr>
                                            <th width="10%">
                                                <center>No</center>
                                            </th>
                                            <th>
                                                <center>Nama Pegawai</center>
                                            </th>
                                            <th>
                                                <center>Username</center>
                                            </th>
                                            <th>
                                                <center>Hak Akses</center>
                                            </th>
                                            <th><center>Action</center></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th><input  class="js-filter form-control" type="text" value=""></th>
                                            <th><input class="js-filter form-control" type="text" value=""></th>
                                            <th> 
                                                <select class="js-filter form-control">
                                                    <option value="">Semua</option>
                                                    <option value="Petugas">Petugas</option>
                                                    <option value="Manajer">Manajer</option>
                                                </select>
                                            </th>
                                            <th></th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                            include 'config.php';
                                            $limit = 10;  
                                            if (isset($_GET["page"])) { 
                                                $page  = $_GET["page"]; 
                                            } 
                                            else { 
                                                $page=1; 
                                            };  
                                            $start_from = ($page-1) * $limit;  


                                            
                                            $query = "SELECT * 
                                                FROM pegawai 
                                                WHERE tipe != 1
                                                ORDER BY id_pegawai 
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
                                            <td class="align-middle"><?php echo $row['username']; ?></td>
                                            <td class="align-middle">
                                                <?php
                                                    if ($row['tipe'] == 2)
                                                        echo "Manajer";
                                                    else if ($row['tipe'] == 3)
                                                        echo "Petugas";
                                                ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="#" data-toggle="modal" data-target="" onclick="confirm_modal('proses_hapus_pegawai.php?&id_pegawai=<?php echo  $row['id_pegawai']; ?>');" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                                            </td>
                                        </tr>
                                    <?php $number++; } ?>
                                    </tbody>
                                </table>
                                <?php
                                    $rs_result = mysqli_query($conn, $query);  
                                    $row = mysqli_fetch_row($rs_result);  
                                    $total_records = $row[0];  
                                    $total_pages = ceil($total_records / $limit);  
                                    $pagLink = "<nav><ul class='pagination'>";  
                                    for ($i=1; $i<=$total_pages; $i++) {  
                                        $pagLink .= "<li><a href='user_login.php?page=".$i."'>".$i."</a></li>";  
                                    };  
                                    echo $pagLink . "</ul></nav>";  
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                        <form action="proses_simpan_pegawai.php" name="modal_popup" enctype="multipart/form-data" method="POST">

                            <div class="form-group">
                                <label>Nama Pegawai</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pegawai" required="required">
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required="required">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required">
                            </div>
                            <div class="form-group">
                                <label>Hak Akses</label>
                                <select id="tipe" name="tipe" class="form-control" required="">
                                    <option value="">Pilih</option>
                                    <option value="2">Manajer</option>
                                    <option value="3">Petugas</option>
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

        <!-- Javascript untuk popup modal Delete--> 
        <script src="js/dynamitable.jquery.min.js"></script>
        <script type="text/javascript">
            function confirm_modal(delete_url)
            {
                $('#modal_delete').modal('show', {backdrop: 'static'});
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
                        hrefTextPrefix : 'user_login.php?page='
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
