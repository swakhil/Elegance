<?php
include 'functions/redirect_session.php';
include_once 'includes/login.func.php';

//Applying CSRF, XSS Protection
$token = generate_token($name = 'security');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="icon" type="image/png" href="<?php echo $site_url.'admin/'.$site_favicon; ?>">
	<title>Login to <?php echo $site_name; ?></title>
	<?php echo html_entity_decode($meta, ENT_QUOTES, 'UTF-8'); ?>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<!--  Fonts and icons  -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

	<!-- CSS Files -->
	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/material-bootstrap-wizard.css" rel="stylesheet" />
	<link href="assets/css/login-signup.css" rel="stylesheet" />
</head>

<body>
	<div class="image-container set-full-height"  style="background-image: url('<?php echo $site_url; ?>admin/<?php echo $background_home_5; ?>')">
	  
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-6 col-sm-offset-3">
		            <!--      Wizard container        -->
		            <div class="wizard-container">
		                <div class="card wizard-card" data-color="green" id="wizardProfile" >
		                    <form action="" method="POST" id="signup_form">

		                    	<div class="wizard-header">
									<br/><h5>Login to <?php echo $site_name; ?></h5>
									<ol id="tupdate"  class="alert-msg"><?php echo $msg; ?></ol>
		                    	</div>
		                    	

								<div class="wizard-navigation">
									<ul>
			                            <li><a href="#about" data-toggle="tab"></a></li>
			                        </ul>
								</div>

		                        <div class="tab-content">
		                            <div class="tab-pane" id="about">
		                              <div class="row">
		                                	<h4 class="info-text" info-font>Login</h4>

		                                	<div class="col-sm-9 col-sm-offset-1">

												<div class="input-group">
													<div class="form-group label-floating">
													  <label class="control-label">Email Address</label>
													  <input name="email" type="text" value='<?php echo isset($email)? $email:''; ?>' class="form-control">
													</div>
													<div class="form-group label-floating">
													  <label class="control-label">Password</label>
													  <input name="password" value='<?php echo isset($password)? $password:''; ?>' type="password" class="form-control">
													</div>
												</div>
                                          </div>


								<div class="wizard-footer">
		                            <div class="pull-right">
		                                <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd' name='submit'  value='Log In' />
		                            </div>
		                            
		                            <div class="clearfix"></div>
		                        </div>
		                            	</div>
		                            </div>
		                             <a href="<?php echo $site_url; ?>user/forget">Forgot Password?</a><br/>
		                             Not a member yet? <a href="signup.php">Register</a>
		                        </div>
		                        <input type="hidden" name="token" value="<?php echo $_SESSION['security_token']; ?>">
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	        </div><!-- end row -->
	    </div> <!--  big container -->

	    <div class="footer">
	        <div class="container text-center">
	            All rights Reserved - Copyright <?php echo $site_name; ?> <?php  echo date('Y')?>.
	        </div>
	    </div>
	</div>


</body>
	<!--   Core JS Files   -->
    <script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/jquery.bootstrap.js" type="text/javascript"></script>

	<!--  Plugin -->
	<script src="assets/js/material-bootstrap-wizard.js" type="text/javascript"></script>

    <!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="assets/js/jquery.validate.min.js" type="text/javascript"></script>
</html>
