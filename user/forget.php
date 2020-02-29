<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


include '../functions/redirect_session.php';

include '../includes/forget.func.php';

//Applying CSRF, XSS Protection

$token = generate_token($name = 'security');

?>

<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<link rel="icon" type="image/png" href="<?php echo $site_url.'admin/'.$site_favicon; ?>">

	<title><?php echo $site_name; ?> | Forgot Password</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <meta name="viewport" content="width=device-width" />



	<!--     Fonts and icons  -->

	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" /> 

	<!-- CSS Files -->

	<link href="<?php echo $site_url; ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

	<link href="<?php echo $site_url; ?>assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

	<link href="<?php echo $site_url; ?>assets/css/login-signup.css" rel="stylesheet" />

</head>



<body>

	<div class="image-container set-full-height"  style="background-image: url('<?php echo $site_url; ?>admin/<?php echo $background_home_5; ?>')">

	  

	    <div class="container">

	        <div class="row">

		        <div class="col-sm-6 col-sm-offset-3">

		            <!--      Wizard container        -->

		            <div class="wizard-container">

		                <div class="card wizard-card" data-color="green" id="wizardProfile" >

		                	<?php

                            if (isset($_GET['t']) && isset($_GET['i']) && $forget_pwd == '1' && filter_input(INPUT_GET, 't', FILTER_SANITIZE_STRING) == $token_db && is_already_in_use('id', $id, 'users')) {
                                ?>

		                    <form action="" method="POST" id="signup_form">



		                    	<div class="wizard-header">

									<br/><h5><?php echo $site_name; ?> | Forgot Password</h5>

									<ol id="tupdate"  class="alert-msg"><?php echo $msg; ?></ol>

		                    	</div>

		                    	



								<div class="wizard-navigation">

									<ul>

			                            <li><a href="#about" data-toggle="tab"><?php echo $site_name; ?> | Reinitialize your password</a></li>

			                        </ul>

								</div>



		                        <div class="tab-content">

		                            <div class="tab-pane" id="about">

		                              <div class="row">

		                                	<h4 class="info-text info-font">Enter your password</h4>



		                                	<div class="col-sm-9 col-sm-offset-1">

												<div class="input-group">

													<div class="form-group label-floating">

													  <label class="control-label">Password</label>

													  <input name="password" type="password" class="form-control">

													</div>



													<div class="form-group label-floating">

													  <label class="control-label">Password again</label>

													  <input name="password2" type="password" class="form-control">

													</div>

												</div>

                                          </div>





								<div class="wizard-footer">

		                            <div class="pull-right">
		                            	<input type="hidden" name="token" value="<?php echo $_SESSION['security_token']; ?>">
		                                <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd' name='submit_pwd'  value='Send' />

		                            </div>

		                            

		                            <div class="clearfix"></div>

		                        </div>

		                            	</div>

		                            </div>

		                        </div>

		                    </form>

		                    <?php
                            } else {
                                ?>

		                    <form action="" method="POST" id="signup_form">



		                    	<div class="wizard-header">

									<!--<br/><h5><?php echo $site_name; ?> | Forgot Password</h5>-->

									<ol id="tupdate"  class="alert-msg"><?php echo $msg; ?></ol>

		                    	</div>

		                    	



								<div class="wizard-navigation">

									<ul>

			                            <li><a href="#about" data-toggle="tab"><?php echo $site_name; ?> | Reinitialize your password</a></li>

			                        </ul>

								</div>



		                        <div class="tab-content">

		                            <div class="tab-pane" id="about">

		                              <div class="row">

		                                	<h4 class="info-text info-font">Enter your email</h4>



		                                	<div class="col-sm-9 col-sm-offset-1">



												<div class="input-group">

													<div class="form-group label-floating">

													  <label class="control-label">Email Adress</label>

													  <input name="email" type="email" class="form-control">

													</div>

												</div>

                                          </div>

								<div class="wizard-footer">

		                            <div class="pull-right">

		                                <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd' name='submit'  value='Send' />

		                            </div>

		                            

		                            <div class="clearfix"></div>

		                        </div>

		                            	</div>

		                            </div>

		                        </div>

		                        <input type="hidden" name="token" value="<?php echo $_SESSION['security_token']; ?>">

		                    </form>

		                    <?php
                            }

                            ?>

		                </div>

		            </div> <!--container -->

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

    <script src="<?php echo $site_url; ?>assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>

	<script src="<?php echo $site_url; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

	<script src="<?php echo $site_url; ?>assets/js/jquery.bootstrap.js" type="text/javascript"></script>



	<!--  Plugin  -->

	<script src="<?php echo $site_url; ?>assets/js/demo.js" type="text/javascript"></script>

	<script src="<?php echo $site_url; ?>assets/js/material-bootstrap-wizard.js" type="text/javascript"></script>



    <!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->

	<script src="<?php echo $site_url; ?>assets/js/jquery.validate.min.js" type="text/javascript"></script>

	<style>

		.wizard-card .tab-content {

          min-height: 150px;

        }

	</style>

</html>

