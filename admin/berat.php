<?php
    include 'config.php';
	$id_order=$_GET['id_order'];
    $query = "SELECT * 
        FROM list_order 
        WHERE id_order='$id_order'";
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
        	<form action="proses_berat.php" name="modal_popup" enctype="multipart/form-data" method="POST">
        	   <div class="form-group">
                    <input type="hidden" name="id_order"  class="form-control" value="<?php echo $row['id_order']; ?>" />
                    <label>Berat</label>
                    <input type="number" required="required" class="form-control" id="Berat" name="berat" placeholder="Berat"/>
                </div>
                 <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Edit</button>
                    <button type="reset" class="btn btn-default"  data-dismiss="modal" aria-hidden="true">Batal</button>
                </div>
          	</form>

             <?php } ?>
        </div>
    </div>
</div>