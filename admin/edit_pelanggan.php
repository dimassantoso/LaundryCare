<?php
    include 'config.php';
	$id_customer=$_GET['id_customer'];
    $query = "SELECT * 
        FROM customer 
        WHERE id_customer='$id_customer'";
	$retval=mysqli_query($conn,$query);
	while($row=mysqli_fetch_array($retval)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Data</h4>
        </div>

        <div class="modal-body">
        	<form action="proses_edit_pelanggan.php" name="modal_popup" enctype="multipart/form-data" method="POST">
        	   <div class="form-group">
                    <input type="hidden" name="id_customer"  class="form-control" value="<?php echo $row['id_customer']; ?>" />
                    <label>Nama Pelanggan</label>
                    <input type="text" required="required" class="form-control" id="nama" name="nama" placeholder="Nama Pelanggan" value="<?php echo $row['nama'];?>"/>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" required="required" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $row['email']; ?>">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" required="required" class="form-control" id="password" name="password" placeholder="Password" value="">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" required="required"  class="form-control" placeholder="Alamat" required="required"><?php echo $row['alamat']; ?> 
                    </textarea>
                </div>
                <div class="form-group">
                    <label>No. Telp</label>
                    <input type="number" required="required" class="form-control" id="no_telp" name="no_telp" placeholder="No. Telp" value="<?php echo $row['no_telp']; ?>">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Ubah</button>
                    <button type="reset" class="btn btn-default"  data-dismiss="modal" aria-hidden="true">Batal</button>
                </div>
          	</form>

             <?php } ?>
        </div>
    </div>
</div>