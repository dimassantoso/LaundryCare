<?php 
	session_start();
	require_once('php/db.php');
	
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
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/nivo-lightbox.css">
	<link rel="stylesheet" href="css/nivo_themes/default/default.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/normalize.css">
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>

    <script>
    	function makeOrder(){
    		var dataString = $('#orderForm').serialize();
	 		$.ajax({
		 		type:'POST',
		 		url:'php/make_order.php',
		 		data:dataString,
		 		success: function(html){		 			
		 			// if(html=='ok')
		 			// 	$('modalMakeOrder').modal('fade');
		 			// else
		 			alert(html);
		 			// 	$('#error_msg').html(html);
		 		},
		 		error : function(request,error){
		 			alert(error);
		 		}
	 		});
	 		return false;
    	}
    </script>
   
	<!-- google web font css -->
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,600,700' rel='stylesheet' type='text/css'>

	<script src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyB2OswT1O3Z_S8LgaiesXkp2VG0qSPJCtk&callback=loadMap""></script>
      
      <script>
         function loadMap() {
			
            var laundry = {lat: -7.597963814058707, lng: 112.7813826};
	        var map = new google.maps.Map(document.getElementById('location'), {
	          zoom: 15,
	          center: laundry
	        });
	        var marker = new google.maps.Marker({
	          position: laundry,
	          map: map
	        });
         }
      </script>

</head>
<body data-spy="scroll" data-target=".navbar-collapse" onload="loadMap()">
	
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
				<li><a href="#home" class="smoothScroll">HOME</a></li>
				<li><a href="#service2" class="smoothScroll">SERVICE</a></li>
				<li><a href="#about" class="smoothScroll">ABOUT</a></li>
				<li><a href="#contact" class="smoothScroll">LOCATION</a></li>
				
				<?php
					if(isset($_SESSION['login_user'])){
						// echo "<li><a href='pages/login.php'>".$_SESSION['login_user']."</a></li>";
						echo "<li class='dropdown'>". 	
				  			"<a href='#' class='dropdown-toggle' data-toggle='dropdown'>".
				  			$_SESSION['login_user']."<b class='caret'></b></a>".
				  			"<ul class='dropdown-menu'>".
				    			"<li><a href='#modalMakeOrder' data-toggle='modal'>MAKE ORDER</a></li>".
								"<li><a href='pages/user_page.php'>MY ORDER</a></li>".			
								"<li><a href='php/logout.php'>LOG OUT</a></li>".
				  				"</ul></li>";

					}
					else
						echo "<li><a href='pages/reg.php'>LOG IN</a></li>";
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
            <form class="form-horizontal" name="orderForm" id="orderForm" method="post">
						
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
							<span id="error_msg" style="color:red;float:left;font-size: smaller;font-style: italic;font-weight: bolder;"></span>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-8 col-sm-4">
								<input type="submit" name="order" class="form-control" value="Make Order" onclick="return makeOrder();" />
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


<!-- home section -->
<div id="home">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-6">
				<h1>Ready to be</h1>
				<h1><strong> Laundry Free?</strong></h1>
				<a href="#service2" class="btn btn-default smoothScroll">GET STARTED</a>
			</div>
		</div>
	</div>
</div>

<!-- service section -->
<div id="service2">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h2>Our Services</h2>
			</div>
			<div class="col-md-6 col-sm-6">
				<i class="fa fa-cubes"></i>
				<p>wet laundry wet laundry wet laundry wet laundry wet laundry wet laundry wet laundry wet laundry wet laundry wet laundry wet laundry</p>
			</div>
			<div class="col-md-6 col-sm-6">
				<i class="fa falter fa-group"></i>
				<p>dry laundry dry laundry dry laundry dry laundry dry laundry dry laundry dry laundry dry laundry dry laundry dry laundry dry laundry </p>
			</div>
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

<!-- about section -->
<div id="about">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h2>Our Story</h2>
			</div>
			<div class="col-md-6 col-sm-6">
				<img src="images/about.jpg" class="img-responsive" alt="about img">
			</div>
			<div class="col-md-6 col-sm-6">
				<p>Laundry Care is the smart laundry solution to all your laundry woes. We provide affordable laundry service that is designed around YOU and YOUR needs.

Our story started in 2009 when a stay-at-home-mom in Columbus, OH had an idea. She noticed that while everyone needs clean clothes, most people either hate doing the laundry or simply don’t have the time or energy to do it. Wash & fold services were ok in a pinch but they never seemed to get it right. She knew there was a need for something different, something BETTER: A laundry service that gets the laundry done just the way you like it without all the time and hassle.

Today, Laundry Care’s unique personalized laundry experience is available nationwide. Our clients love the quality, reliability and flexibility of our personalized laundry service over the regular, old wash & fold model available at Laundromats. Why spend valuable time doing the laundry when Laundry Care can do it for you-just the way you like?</p>
			</div>
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

<!-- contact section -->
<div id="contact">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h2>Location</h2>
			</div>
			<div id = "location" style = "width:100%; height:500px;text-align: center;"></div>
		</div>
	</div>
</div>

<!-- contact section -->
<!-- <div id="contact">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h2>Keep in touch</h2>
			</div>
			<form action="#" method="post" role="form">
				<div class="col-md-1 col-sm-1"></div>
				<div class="col-md-10 col-sm-10">
					<div class="col-md-6 col-sm-6">
						<input name="name" type="text" class="form-control" id="name" placeholder="Name">
				  	</div>
					<div class="col-md-6 col-sm-6">
						<input name="email" type="email" class="form-control" id="email" placeholder="Email">
				  	</div>
                    <div class="col-md-12 col-sm-12">
						<input name="subject" type="text" class="form-control" id="subject" placeholder="Subject">
	    	  	  	</div>
					<div class="col-md-12 col-sm-12">
						<textarea name="message" rows="5" class="form-control" id="message" placeholder="Message"></textarea>
					</div>
					<div class="col-md-offset-8 col-md-4 col-sm-4">
						<input name="submit" type="submit" class="form-control" id="submit" value="SEND MESSAGE">
					</div>
				</div>
				<div class="col-md-1 col-sm-1"></div>
			</form>
		</div>
	</div>
</div> -->

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
	include 'pages/footer.php';
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
<script src="js/jquery-v3.js"></script>
<script src="js/bootstrap.min.js"></script>	
<script src="js/nivo-lightbox.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/jquery.nav.js"></script>
<script src="js/isotope.js"></script>
<script src="js/imagesloaded.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>