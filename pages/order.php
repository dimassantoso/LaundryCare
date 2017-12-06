<?php 
	session_start();
	require_once('../php/db.php');
	require_once('../php/error.php');
	include('../php/url.php');
	set_error_handler('handleError');
	if(!isset($_SESSION['login_user'])){
		header("Location:$login_page");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">

	<title>LaundryCare: Professional Laundry Service</title>

	<!-- stylesheet css -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/nivo-lightbox.css">
	<link rel="stylesheet" href="../css/nivo_themes/default/default.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/normalize.css">
    <script src="../js/vendor/modernizr-2.6.2.min.js"></script>
   
	<!-- google web font css -->
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,600,700' rel='stylesheet' type='text/css'>

</head>
<body data-spy="scroll" data-target=".navbar-collapse">
	
<!-- navigation -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
			</button>
			<a href="#home" class="navbar-brand smoothScroll">LaundryCare</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="../index.php" class="smoothScroll">HOME</a></li>
				<?php
					if(count($_SESSION)>0){
						// echo "<li><a href='pages/login.php'>".$_SESSION['login_user']."</a></li>";
						echo "<li class='dropdown'>". 	
				  			"<a href='#' class='dropdown-toggle' data-toggle='dropdown'>".
				  			$_SESSION['login_user']."<b class='caret'></b></a>".
				  			"<ul class='dropdown-menu'>".
				    			"<li><a href='#modalMakeOrder' data-toggle='modal'>MAKE ORDER</a></li>".
								"<li><a href='#'>MY ORDER</a></li>".			
								"<li><a href='../php/logout.php'>LOG OUT</a></li>".
				  				"</ul></li>";

					}
				?>
				
			</ul>
		</div>
	</div>
</div>	

<div class="modal fade" id="modalMakeOrder" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h3 class="modal-title" id="myModalLabel">
                    Make Order
                </h3>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
            <div class="main-login main-center">
            <form class="form-horizontal" name="orderForm" method="post" action="../php/make_order.php">
						
						<div class="form-group">
							<label for="address" class="cols-sm-2 control-label">Your Address</label>
							<div class="cols-sm-10">
							<?php 
								if(isset($_COOKIE['user_address']))
									echo "<input type='text' class='form-control' name='address' id='address' value='".$_COOKIE['user_address']."' required/>";
								else
									echo"<input type='text' class='form-control' name='address' id='address'  placeholder='Enter your Address' required/>";
							?>
																
							</div>
							
						</div>
						<div class="form-group">
							<label for="service" class="cols-sm-2 control-label">Service Option</label>
							<div class="cols-sm-10">
								<label class="radio-inline"><input type="radio" value="1" id="service" name="service">Laudry Cleaning</label>
								<label class="radio-inline"><input type="radio" value="2" id="service" name="service">Dry Cleaning</label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-8 col-sm-4">
								<input type="submit" name="order" class="form-control" value="Make Order"  />
							</div>
						</div>
							</form>
  				</div>
  				
			</div>
            <!-- Modal Footer -->
            <!-- <div class="modal-footer">
                <div id="note"></div>
            </div> -->
        </div>
    </div>
</div>

<!-- service section -->
<div id="orders">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h2>My Order</h2>
			</div>
			<div class="col-md-2 col-sm-2"></div>
			<div class="col-md-8 col-sm-8">
				<div class = "table-responsive">
				   <table class = "table table-striped table-hover">
				      
				     <!--  <caption>Order List</caption> -->
				      
				      <thead>
				         <tr>
				         	<th>No</th>
				            <th>Invoice Code</th>
				            <th>Service Type</th>
				            <th>Order Date</th>
				            <th>Finish Date</th>
				            <th>Weight (Kg)</th>
				            <th>Total Payment</th>
				            <th>Status</th>
				         </tr>
				      </thead>
				      
				      <tbody>
				      	<?php 
				      		include '../php/db.php';
						  	include '../php/url.php';
						  	include '../php/validate.php';
						  	require_once '../php/error.php';						  	
						  	set_error_handler('handleError');
						  	$id = $_SESSION['id_user'];
						  	$sql="SELECT * FROM list_order WHERE id_user='$id'";
						  	mysqli_select_db($conn,"laundry");
						  	$result = mysqli_query($conn,$sql);
						  	$i=1;
						  	if(mysqli_num_rows($result)>0){						  		
						  		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						  			$service="Laundry";						  			
						  			if($row['id_layanan']==2)
						  				$service="Dry Cleaning";
						  			$finish_date = "Not set yet";
						  			$weight = "Not set yet";
						  			$total = "Not set yet";
						  			if($row['status']!="Menunggu"){
						  				$finish_date = $row['tgl_selesai'];
						  				$weight = $row['berat'];
						  				$total = $row['bayar'];
						  			}
						  			
						  			echo "<tr><td>".$i."</td><td>".$row['no_nota']."</td><td>".$service."</td><td>".$row['tgl_order']."</td><td>".$finish_date."</td><td>".$weight."</td><td>".$total."</td><td>".$row['status']."</td></tr>";
						  			$i++;
						  		}
						  		mysqli_close($conn);
						  	}
						  	else
						  		echo "<h3>You have not made any order yet</h3>";
				      	?>
				       
				      </tbody>
				      
				   </table>
				</div>  	
			</div>
			<div class="col-md-2 col-sm-2"></div>
		</div>
	</div>
</div>

<!-- divider section -->
<div class="container">
	<div class="row">
		<div class="col-md-1 col-sm-1"></div>
		<div class="col-md-10 col-sm-10">
			<hr>
		</div>
		<div class="col-md-1 col-sm-1"></div>
	</div>
</div>

<?php
	include 'footer.php';
?>

<!-- divider section -->
<div class="container">
	<div class="row">
		<div class="col-md-1 col-sm-1"></div>
		<div class="col-md-10 col-sm-10">
			<hr>
		</div>
		<div class="col-md-1 col-sm-1"></div>
	</div>
</div>

<!-- copyright section -->
<div class="copyright">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<p>Copyright &copy; 2017 4bit Digital Firm 
                
                - Design: <a rel="nofollow" href="http://www.4bit.com" target="_parent">4bit</a></p>
			</div>
		</div>
	</div>
</div>

<!-- scrolltop section -->
<a href="#top" class="go-top"><i class="fa fa-angle-up"></i></a>


<!-- javascript js -->	
<script src="../js/jquery-v3.js"></script>
<script src="../js/bootstrap.min.js"></script>	
<script src="../js/nivo-lightbox.min.js"></script>
<script src="../js/smoothscroll.js"></script>
<script src="../js/jquery.nav.js"></script>
<script src="../js/isotope.js"></script>
<script src="../js/imagesloaded.min.js"></script>
<script src="../js/custom.js"></script>
<script src="../js/login.js"></script>
</body>
</html>