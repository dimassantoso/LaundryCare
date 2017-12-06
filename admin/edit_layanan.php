<?php
    include 'config.php';
	$id_layanan=$_GET['id_layanan'];
    $query = "SELECT * 
        FROM layanan 
        WHERE id_layanan='$id_layanan'";
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
        	<form action="proses_edit_layanan.php" name="modal_popup" enctype="multipart/form-data" method="POST">
        	   <div class="form-group">
                    <input type="hidden" name="id_layanan"  class="form-control" value="<?php echo $row['id_layanan']; ?>" />
                    <label>Nama Layanan</label>
                    <input type="text" required="required" class="form-control" id="nama" name="nama" placeholder="Nama Layanan" value="<?php echo $row['nama_layanan'];?>"/>
                </div>
                <div class="form-group">
                    <label>Biaya Per Kg.</label>
                    <input type="number" required="required" class="form-control" id="biaya" name="biaya" placeholder="Biaya Per Kg." value="<?php echo $row['biaya_layanan']; ?>">
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