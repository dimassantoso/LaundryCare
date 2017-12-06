<?php 
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}
    require_once('../php/db.php');
    require_once('../php/error.php');
    set_error_handler('handleError');
    include('../php/url.php');
    // if(!isset($_SESSION['login_user'])){
    //     header('Location:$login_page');
    // }
?>
<!-- login section -->
<script src="../admin/login/assets/js/jquery-1.11.1.js"></script>
<script src="../js/vendor/jquery-1.10.2.min.js"></script>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="../js/jquery-v3.js"></script>
<script src="../js/bootstrap.min.js"></script>	
<script src="../js/nivo-lightbox.min.js"></script>
<script src="../js/smoothscroll.js"></script>
<script src="../js/jquery.nav.js"></script>
<script src="../js/isotope.js"></script>
<script src="../js/imagesloaded.min.js"></script>
<script src="../js/custom.js"></script>

<script>
	$(document).ready(function(){
		$('#email2').blur(function(){			
			var email2 = $(this).val();

			$.ajax({
				type	: 'POST',
				url 	: '../php/back_validate_email.php',
				data 	: 'email2='+email2,
				success	: function(data){
					var message = '<div style="color:red;line-height:18px;float:right;font-size: smaller;font-style: italic;font-weight: bolder;">'+data+'</div>';
					if(data=='&#10004;'){
						message = '<div style="color:green;line-height:18px;float:right;font-size: smaller;font-style: italic;font-weight: bolder;">'+data+'</div>';
					}

					$('#msg').html(message);
				}
			})

		});
	});
	
</script>

<div id="login">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-6">
				<h2>Log In</h2>
				
				<div class="main-login main-center">
					<form class="form-horizontal" name="login-form" id="login-form" method="post">

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Your Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="email" class="form-control" name="email" id="email"  placeholder="Enter your Email" required />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="pass" id="pass"  placeholder="Enter your Password" required />
								</div>
								<span class="errorlogin" id="errorlogin" style="color:red;line-height:20px;float:right;font-size: smaller;font-style: italic;font-weight: bolder;"></span>
							</div>
						</div>			

						<div class="form-group">
							<input type="submit" name="login" class="form-control" id="btn-login" value="Log in" onclick="return submitlogin();" />
						</div>
					</form>
				</div>
				
				<div class="col-md-10 col-sm-10">
					<hr>
				</div>
				<div class="main-login main-center">
					<form class="form-horizontal" method="post" action="../php/fb-login.php">
					<div class="form-group">
							<button name="fblogin" id="fblogin" class="form-control btn btn-primary">Log in with facebook</button>
						</div>
					</form>
				</div>
			</div>
			<script type="text/javascript">
				function validateLogin(){
					var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
					if(!re.test(document.loginForm.email.value)){
						alert( "Please enter a valid Email Address!" );
            			document.loginForm.email.focus() ;
						return false;
					}
					return true;
				}
      		</script>
			<div class="col-md-6 col-sm-6">
				<h2>Sign Up</h2>
				<div class="main-login main-center">
					<form class="form-horizontal" name="signup-form" id ="signup-form" method="post">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Your Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="nama" id="nama"  placeholder="Enter your Name" required/>									
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Your Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="email2" id="email2"  placeholder="Enter your Email" required/>									
								</div>								
								<span id="msg"></span>								
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password" 		data-fv-notempty="true"
                						data-fv-notempty-message="The password is required and cannot be empty"
                						data-fv-different="true"
                						data-fv-different-field="username"
                						data-fv-different-message="The password cannot be the same as username" placeholder="Enter your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="confirm" id="confirm"  data-fv-notempty="true"
                					data-fv-notempty-message="The confirm password is required and cannot be empty"
                					data-fv-identical="true"
                					data-fv-identical-field="password"
                					data-fv-identical-message="The password and its confirm are not the same" placeholder="Confirm your Password"/>
								</div>
								<span id="signup-submit-msg" style="color:red;line-height:18px;float:right;font-size: smaller;font-style: italic;font-weight: bolder;"></span>	
							</div>
						</div>
						<div class="form-group">
							<input type="submit" class="form-control" id="btn-signup" value="Sign Up" onclick="return regist();" />
						</div>
						
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	 function regist(){	 	
	 	var dataString = $('#signup-form').serialize();
	 	$.ajax({
	 		type:'POST',
	 		url:'../php/signup.php',
	 		data:dataString,
	 		success: function(html){
	 			//alert(html);
	 			if(html=='ok')
	 				window.location.replace('http://localhost/dry');
	 			else
	 				$('#signup-submit-msg').html(html);
	 		},
	 		error : function(request,error){
	 			alert(error);
	 		}
	 	});
	 	return false;
	 }
</script>
<script>
	function submitlogin(){	 	
	 	var dataS = $('#login-form').serialize();
	 	$.ajax({
	 		type:'POST',
	 		url:'../php/login.php',
	 		data:dataS,
	 		success: function(html){
	 			//alert(html);
	 			if(html=='ok')
	 				window.location.replace('http://localhost/dry');
	 			else
	 				$('#errorlogin').html(html);
	 		},
	 		error : function(request,error){
	 			alert(error);
	 		}
	 	});
	 	return false;
	 }
</script>