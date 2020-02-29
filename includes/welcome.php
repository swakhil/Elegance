<?php
include 'functions/redirect_session.php';
//Applying CSRF, XSS Protection
$token = generate_token($name = 'security');
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo $site_url.'admin/'.$site_favicon; ?>">
        <title><?php echo $site_name; ?></title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/welcome.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="">
        <link rel="apple-touch-icon-precomposed" href="">

    </head>

    <body id="page">
      <div class="backstretch" id="preview-background"><img class="preview-img-background" src="<?php echo $site_url; ?>admin/<?php echo $background_home_1; ?>"></div>
     <span id="fake-background"></span>
    <!-- Top menu -->
    <nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
      </div>
    </nav>

        <!-- Top content -->
        <div class="top-content">
          
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 text">
                            <h1><b clas="title-site"><?php echo general_settings('site_desc'); ?> </b></h1>
                            <div class="description">
                              <p>
                                <b>
                                <?php echo general_settings('site_desc2'); ?>
                                </b>
                              </p>
                            </div>
                        </div>
                        <div class="col-sm-4 form-box">
                          <div class="form-top navbar-social">
                            <div class="form-top-left">
                              <h3 class="welcome-text"><center>Welcome to</center></h3>
                                <p><img id="logo" src="admin/<?php echo $site_logo; ?>"/></p>
                            </div>

                            </div>
                            <div class="form-bottom">
                             <form role="form" action="login" method="POST" class="registration-form">
                              <div class="form-group">
                                <label class="sr-only" for="form-email">Email</label>
                                <input type="text" value="" name="email" placeholder="Email" class="form-email form-control" id="form-email">
                              </div>
                              <div class="form-group">
                              <label class="sr-only" for="form-password">Password</label>
                                <input type="password" value="" name="password" placeholder="Password" class="form-password form-control" id="form-password">
                              </div>
                                <button type="submit" name="submit" class="btn btn-login">Login</button>
                              <button type="submit" name="submit_signup" class="btn btn-login">Signup</button>
                              <input type="hidden" name="token" value="<?php echo $_SESSION['security_token']; ?>">
                          </form>
                          <a href="<?php echo $site_url; ?>user/forget" class="pw-style">Forgot Password?</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery.1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/scripts.js"></script>

        <script type="text/javascript">
         /*Background slideshow*/
         $.backstretch([
           "<?php echo $site_url; ?>admin/<?php echo $background_home_1; ?>",
           "<?php echo $site_url; ?>admin/<?php echo $background_home_2; ?>",
           "<?php echo $site_url; ?>admin/<?php echo $background_home_3; ?>",
           "<?php echo $site_url; ?>admin/<?php echo $background_home_4; ?>"
          ], {duration: 2000, fade: 1500});
        </script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>