<?php
// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+
error_reporting(E_ALL);
function redirect_ins($url, $permanent = false)
{
    if ($permanent) {
        header('HTTP/1.1 301 Moved Permanently');
    }
    header('Location: '.$url);
    exit();
}
$path = '../functions/connect.php';
/*if (!file_exists($path)) {
    redirect_ins('../install');
}*/
include 'functions/admin.func.php';

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $url = url();
    $explode = explode('/', $url);
    $url = $explode[0].'/'.$explode[1].'/'.$explode[2].'/'.$explode[3].'/';
} else {
    $url = url();
    $explode = explode('/', $url);
    $url = $explode[0].'/'.$explode[1].'/'.$explode[2].'/';
}
$token = generate_token($name = 'admin');
?>
<!DOCTYPE html>
<html lang="en" >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Script Installation</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/heroic-features.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- Page Content -->
    <div class="container">
      <!-- Jumbotron Header -->
      <header class="jumbotron hero-spacer">
        <h1>Sign up as administrator</h1>
        <p>You are at the last part of the installation of your script. Once you finish, please <b>delete</b> the "<b>install</b>" folder for security purposes.</p>
        <p><b>Admin Configuration</b></p>
        <form method="POST" class="form-horizontal" action="" >
          <div class="form-group">
            <p class="col-sm-12">
              <?php  echo $errors1; echo $errors2; echo $errors3; echo $errors4; echo $errors5; echo $errors6; ?>
            </p>
            <label class="col-md-4 control-label" for="servername">FirstName</label>
            <div class="col-md-4">
              <input type="text" required class="form-control" name="firstname" placeholder="Enter Your FirstName">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="servername">LastName</label>
            <div class="col-md-4">
              <input type="text" required class="form-control" name="lastname" placeholder="Enter Your LastName">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="servername">Username</label>
            <div class="col-md-4">
              <input type="text" required class="form-control" name="username" placeholder="Enter Your Username">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="servername">Sex</label>
            <div class="col-md-4">
              <select name="sex" class="form-control">

                                          <?php if (isset($sex) && $sex != '') {
                                              ?>

                                             <option value="<?php echo $sex; ?>"><?php echo $sex; ?></option>

                                         <?php
                                           } else {
                                            ?>

                                             <option value="" selected="">Choose your Sex</option>

                                          <?php
                                           }

                                          ?>
                                             <option value="Male"> Male </option>

                                             <option value="Female"> Female </option>

                </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="servername">E-mail</label>
            <div class="col-md-4">
              <input type="email" required class="form-control" name="email" placeholder="Enter You Email Address">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="servername" >Website URL</label>
            <div class="col-md-4">
              <input type="url" required class="form-control" name="url"  placeholder="Enter Your Website URL" value="<?php echo $url; ?>">
              <span class="help-block">This is the base url. Make sure this url is pointed where the script is installed.</span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="servername">Password</label>
            <div class="col-md-4">
              <input type="password" name="password" required class="form-control" placeholder="Enter Your Password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="servername">Confirm Password</label>
            <div class="col-md-4">
              <input type="password" required class="form-control" name="passwordConfirm" placeholder="Reenter Your Password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="servername">Sign up an admin account</label>
            <div class="col-md-4">
              <button type="submit" name="signup_admin" class="btn btn-success">Sign Up</button>
            </div>
          </div>
          <input type="hidden" name="token" value="<?php echo $_SESSION['admin_token'] ; ?>">
        </form>
      </header>
    </div>
    <!-- /.container -->
    <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>