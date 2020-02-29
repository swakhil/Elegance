<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


error_reporting(E_ALL);

require_once 'functions/functions_install.php';
require_once 'functions/config.func.php';
$token = generate_token($name = 'config');

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
            <h1>Welcome!</h1>
            <p>Thank you for purchasing this script!</p>
            <p><b>Database Configuration</b></p>
            <br/>
            <form class="form-horizontal" method="POST" action="">
<fieldset>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="servername">Host</label>  
  <div class="col-md-4">
  <input id="servername" name="servername" type="text" placeholder="Enter Your Server Name" class="form-control input-md" required="">
  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="dbname">Database Name</label>  
  <div class="col-md-4">
  <input id="dbname" name="dbname" type="text" placeholder="Enter your Database Name" class="form-control input-md" required="">
  <span class="help-block">Make sure the database is already created.</span> 
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="username">Username</label>  
  <div class="col-md-4">
  <input id="username" name="username" type="text" placeholder="Enter Your Username" class="form-control input-md" required="">
   <span class="help-block">Username of the database.</span> 
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="dbpassword">Password</label>
  <div class="col-md-4">
    <input id="dbpassword" name="dbpassword" type="password" placeholder="Enter Your Password" class="form-control input-md" >
   <span class="help-block">Password of the database.</span> 
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-4">
    <button id="save" name="save" class="btn btn-info">Continue</button>
  </div>
</div>
<input type="hidden" name="token" value="<?php echo $_SESSION['config_token'] ; ?>">

</fieldset>
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