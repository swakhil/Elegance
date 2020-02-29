<?php
// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+
   include 'functions/redirect_session.php';

   //Applying CSRF, XSS Protection

   $token = generate_token($name = 'security');

   include 'includes/intro-signup.php';

?>

<!DOCTYPE html>

<html lang="en">

   <head>

      <meta charset="utf-8" />

      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

      <link rel="icon" type="image/png" href="<?php echo $site_url.'admin/'.$site_favicon; ?>">

      <title>Register to <?php echo $site_name; ?> </title>

      <?php echo html_entity_decode($meta, ENT_QUOTES, 'UTF-8'); ?>

      <link rel="icon" type="image/png" href="assets/img/favicon.png" />

      <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

      <meta name="viewport" content="width=device-width" />



      <!--     Fonts and icons     -->

      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />



      <!-- CSS Files -->

      <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

      <link href="assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

      <link href="assets/css/login-signup.css" rel="stylesheet" />

   </head>

   <body>

      <div class="image-container set-full-height"  style="background-image: url('<?php echo $site_url; ?>admin/<?php echo $background_home_5; ?>')">

         <!--   Big container   -->

         <div class="container">

            <div class="row">

               <div class="col-sm-8 col-sm-offset-2">

                  <!--      Wizard container        -->

                  <div class="wizard-container signup-container">

                     <div class="card wizard-card" data-color="green" id="wizardProfile">

                        <form action="" method="POST" id="signup_form">

                           <div class="wizard-header">

                              <br/><h5> Register to <?php echo $site_name; ?></h5>

                              <ol class="error-msg" id="tupdate"> </ol>

                           </div>

                           <div class="wizard-navigation">

                              <ul>

                                 <li><a href="#address" data-toggle="tab">SignUp</a></li>

                              </ul>

                           </div>

                           <div class="tab-content">

                              <div class="tab-pane" id="about">

                                 <div class="row">

                                    <h4 class="info-text">Let's start with basic information</h4>

                                    

                                 </div>

                              </div>

                              <div class="tab-pane" id="address">

                                 <div class="row">

                                    <div class="col-sm-10 col-sm-offset-1">

                                       <div class="input-group">

                                          <div class="form-group label-floating">

                                             <label class="control-label">FirstName </label>

                                             <input name="firstname" value='<?php echo isset($firstname)? $firstname:''; ?>' type="text" class="form-control">

                                          </div>

                                       </div>

                                       <div class="input-group">

                                          <div class="form-group label-floating">

                                             <label class="control-label">LastName </label>

                                             <input name="lastname" type="text" value='<?php echo isset($lastname)? $lastname:''; ?>' class="form-control">

                                          </div>

                                       </div>

                                    </div>

                                    <div class="col-sm-10 col-sm-offset-1">

                                       <div class="input-group">

                                          <div class="form-group label-floating">

                                             <label class="control-label">E-mail address </label>

                                             <input name="email" type="email" value='<?php echo isset($email)? $email:''; ?>' class="form-control">

                                          </div>

                                       </div>

                                    </div>  

                                    <div class="col-sm-10 col-sm-offset-1">

                                       <div class="form-group label-floating">

                                          <label class="control-label">Username</label>

                                          <input type="text" name="username" value='<?php echo isset($username)? $username:''; ?>' class="form-control">

                                       </div>

                                    </div>

                                    <div class="col-sm-5 col-sm-offset-1">

                                       <div class="form-group label-floating">

                                          <label class="control-label">Password</label>

                                          <input type="password" name="password" value='<?php echo isset($password)? $password:''; ?>' class="form-control">

                                       </div>

                                    </div>

                                    <div class="col-sm-5">

                                       <div class="form-group label-floating">

                                          <label class="control-label">Confirm your Password</label>

                                          <input type="password" name="password2" value='<?php echo isset($password2)? $password2:'';?>' class="form-control">

                                       </div>

                                    </div>

                                 </div>

                              </div>

                           </div>

                           <div class="wizard-footer">

                              <div class="pull-right">

                                 <input type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' value='Next' />

                                 <input type='button' class='btn btn-finish btn-fill btn-success btn-wd' name='finish' id="finish" value='Sign Up' />
                              </div>

                              <div class="pull-left">

                                 <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />

                              </div>

                              <div class="clearfix"></div>
                              <p><b>By signing up, you accept the <a href="<?php echo $site_url; ?>user/policy" target="_blank">privacy policy</a> of <?php echo $site_name; ?>.</p>
                              Already a member ? <a href="main">Login!</a>

                           </div>

                           <input type="hidden" name="token" id="token_id" value="<?php echo $_SESSION['security_token']; ?>">

                        </form>

                     </div>

                  </div>

                  <!-- wizard container -->

               </div>

            </div>

            <!-- end row -->

         </div>

         <!--  big container -->

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

   <script src="assets/js/main-signup.js" type="text/javascript"></script>

   <script src="assets/js/material-bootstrap-wizard.js" type="text/javascript"></script>

   <script src="assets/js/jquery.validate.min.js" type="text/javascript"></script>

</html>