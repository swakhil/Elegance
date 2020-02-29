<?php
include 'functions/redirect_session.php';
//Applying CSRF, XSS Protection
$token = generate_token($name = 'security');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo $site_url.'admin/'.$site_favicon; ?>">
    <title><?php echo $site_name; ?></title>
	
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="http://allfont.net/allfont.css?fonts=agency-fb-bold" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
	
	<!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="">
    <link rel="apple-touch-icon-precomposed" href="">
		
</head>
<body style="background-color: #8FAADC;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('Homescreen.png');"><!--
				<div class="container-inside">
                    <div class="row align-items-start">
                        <p id="para"><b>There are many great souls who work for the well-being of society every day and expect nothing in return.</p> </b><br>
                    </div>
                    <div class="row align-items-center">
                        <p id="para"><b>This project is to identify those humanitarians, read their stories and get inspired to contribute to the Society whichever way possible.</p></b><br> 
                    </div>
                    <div class="row align-items-end">
                        <p id="para"><b>Just simply create your profile, post something you did and be an inspiration for others.</p> </b> 
                    </div>
                </div>	-->
			</div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
				<form role="form" action="login" method="POST" class="login100-form validate-form">
					<span class="login100-form-title p-b-59">
					<img height="70px" src="<?php echo $site_url.'admin/'.$site_logo; ?>"/>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" value="" name="email" placeholder="Email address..." id="form-email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" value="" name="password" placeholder="*************" id="form-password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-m w-full p-b-33">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								<span class="txt1">
									Remember me
								</span>
							</label>
						</div>

						
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" name="submit" class="btn-lg btn-success">Log In</button>
						</div>
						<a href="signup.php"><button type="button" class="btn-lg btn-warning">Signup</button></a>
                        <input type="hidden" name="token" value="<?php echo $_SESSION['security_token']; ?>">
						<!--<a href="#" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
							Register Here
							<i class="fa fa-long-arrow-right m-l-5"></i>-->
						</a>
					</div><br>
					<a href="<?php echo $site_url; ?>user/forget" class="pw-style">Forgot Password?</a>
				</form>
			</div>
		</div>
	</div>
	<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="assets/vendor/animsition/js/animsition.min.js"></script>
	<script src="assets/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/select2/select2.min.js"></script>
	<script src="assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="assets/vendor/countdowntime/countdowntime.js"></script>
	<script src="assets/js/main-signin.js"></script>
	<footer class="footer fixed-bottom footer-dark footer-shadow content container-fluid">
        <center> Network For Cause &copy; <?php echo date('Y'); ?> &nbsp;&nbsp;&nbsp; <b><a href="user/policy">Privacy Policy</a></b></center>
    </footer>
</body>
</html>