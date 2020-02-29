<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


include_once '../functions/functions.php';
include '../includes/check_active.php';
?>

<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<link rel="icon" type="image/png" href="<?php echo $site_url.'admin/'.$site_favicon; ?>">

	<title>Activate your account | <?php echo $site_name; ?> </title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <meta name="viewport" content="width=device-width" />

    

    <!--     Fonts and icons     -->

	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />



	<!-- CSS Files -->

	<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

	<link href="../assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

	<link href="../assets/css/login-signup.css" rel="stylesheet" />

</head>



<body>

	<div class="image-container set-full-height" style="background-color: #FF5B62;">   

	    <!--   Big container   -->

	    <div class="container">

	        <div class="row">

		        <div class="col-sm-8 col-sm-offset-2">

		            <!--      Wizard container        -->

		            <div class="wizard-container">

		                <div class="card wizard-card" data-color="green" id="wizardProfile">

		                    <form action="" method="POST" id="signup_form">



		                    	<div class="wizard-header">
		                        	<h5 >

		                        	  ACTIVATE YOUR ACCOUNT

		                        	</h5>

									<ol id="tupdate" class="error-msg"><?php echo $msg; ?></ol>

		                    	</div>

		                    	



								<div class="wizard-navigation">

									<ul>

			                            <li><a href="#about" data-toggle="tab">Enter the code</a></li>

			                        </ul>

								</div>



		                        <div class="tab-content">

		                            <div class="tab-pane" id="about">

		                              <div class="row">

		                                	<h4 class="info-text">We send you a code via email</h4>



		                                	<div class="col-sm-9 col-sm-offset-1">



												<div class="input-group">

													<div class="form-group label-floating">

													  <label class="control-label">Enter your <?php echo $site_name; ?>'s code</label>

													  <input name="code" type="number" class="form-control">

													</div>

												</div>

                                          </div>





								<div class="wizard-footer">

		                            <div class="pull-right">

		                                <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd' name='submit'  value='Submit' />

		                            </div>

		                           

		                        </div>

		                            	</div>

		                            </div>

		                       <a href="logout.php">Logout

		                        </div>

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

    <script src="<?php echo $site_url; ?>assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>

	<script src="<?php echo $site_url; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

	<script src="<?php echo $site_url; ?>assets/js/jquery.bootstrap.js" type="text/javascript"></script>



	<!--  Plugin for the Wizard -->

   <script src="<?php echo $site_url; ?>assets/js/main-signup.js" type="text/javascript"></script>

	<script src="<?php echo $site_url; ?>assets/js/material-bootstrap-wizard.js" type="text/javascript"></script>



    <!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->

	<script src="<?php echo $site_url; ?>assets/js/jquery.validate.min.js" type="text/javascript"></script>

</html>

