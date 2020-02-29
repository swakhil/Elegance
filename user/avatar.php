<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+

   error_reporting(E_ALL);
   include '../functions/redirect.php';

?>

<!DOCTYPE html>

<html lang="en">

   <head>

      <meta charset="utf-8" />

      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

      <link rel="icon" type="image/png" href="<?php echo $site_url.'admin/'.$site_favicon; ?>">

      <title><?php echo $site_name; ?> | Upload your avatar</title>

      <link href="<?php echo $site_url; ?>assets/css/avatar.css" rel="stylesheet">

      <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

      <meta name="viewport" content="width=device-width" />

      <link rel="stylesheet" href="<?php echo $site_url; ?>assets/font-awesome/css/font-awesome.css" />



      <!-- CSS Files -->

      <link href="<?php echo $site_url; ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

      <link href="<?php echo $site_url; ?>assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

      <link href="<?php echo $site_url; ?>assets/css/login-signup.css" rel="stylesheet" />

   </head>

   <body>

      <div class="image-container set-full-height"  style="background-image: url('<?php echo $site_url; ?>admin/<?php echo $background_home_5; ?>')">

         <div class="container margin-container">

            <div class="row">

               <div class="col-sm-6 col-sm-offset-3">

                  <!--      Wizard container        -->

                  <div class="wizard-container avatar-contain">

                     <div class="card wizard-card" data-color="green" id="wizardProfile" >

                        <div class="wizard-header">

                           <br/><h5><?php echo $site_name; ?> | Upload your avatar</h5>

                        </div>

                        <div class="wizard-navigation">

                           <ul>

                              <li><a href="#about" data-toggle="tab">Add A Profile Picture</a></li>

                           </ul>

                        </div>

                        <div class="tab-content">

                           <div class="tab-pane" id="about">

                              <div class="row">

                                 <h4 class="info-text">Profile Picture</h4>

                                 <div class="col-sm-9 col-sm-offset-1">

                                    <div id="imgContainer">

                                       <form enctype="multipart/form-data" action="<?php echo $site_url; ?>ajax/upload_avatar_started" method="post" name="image_upload_form" id="image_upload_form">

                                          <div id="imgArea">

                                             <img src="<?php echo $site_url.select_sql('avatar');?>">

                                             <div class="progressBar">

                                                <div class="bar"></div>

                                                <div class="percent">0%</div>

                                             </div>

                                             <div id="imgChange"><span class="fa fa-camera"></span> Upload Photo

                                                <input type="file" accept="image/*" name="uploadavatar" id="image_upload_file">

                                             </div>

                                          </div>

                                          <input type="hidden" name="token" id="token_id" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">

                                       </form>

                                    </div>

                                 </div>

                                 <div class="wizard-footer">

                                    <div class="pull-right">

                                       <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd' name='submit' onclick="document.location='<?php echo $site_url; ?>user/getting-started'" value='Continue' />

                                    </div>

                                    <div class="clearfix"></div>

                                 </div>

                              </div>

                           </div>

                        </div>

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

   <!--   Core JS Files -->

   <script src="<?php echo $site_url; ?>assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>

   <script src="<?php echo $site_url; ?>assets/js/jquery.form.js"></script>

   <!--  Core Javascript  -->

   <script src="<?php echo $site_url; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

   <script src="<?php echo $site_url; ?>assets/js/jquery.bootstrap.js" type="text/javascript"></script>

   <!--  Plugin for the Wizard -->

   <script src="<?php echo $site_url; ?>assets/js/main-signup.js" type="text/javascript"></script>

   <script src="<?php echo $site_url; ?>assets/js/material-bootstrap-wizard.js" type="text/javascript"></script>

   <!--  More information about jquery.validate here: http://jqueryvalidation.org/  -->

   <script src="<?php echo $site_url; ?>assets/js/jquery.validate.min.js" type="text/javascript"></script>

</html>