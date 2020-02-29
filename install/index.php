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

if (file_exists('../functions/connect.php')) {
    redirect('../');
}
if (function_exists('base64_encode')) {
    $base64_encode = 'Yes';
} else {
    $base64_encode = 'No';
}

if (function_exists('base64_decode')) {
    $base64_decode = 'Yes';
} else {
    $base64_decode = 'No';
}

if (function_exists('json_encode')) {
    $json_encode = 'Yes';
} else {
    $json_encode = 'No';
}

if (function_exists('json_decode')) {
    $json_decode = 'Yes';
} else {
    $json_decode = 'No';
}

if (function_exists('mail')) {
    $mail = 'Yes';
} else {
    $mail = 'No';
}

if (function_exists('number_format')) {
    $number_format = 'Yes';
} else {
    $number_format = 'No';
}

if (function_exists('file_get_contents')) {
    $file_get_contents = 'Yes';
} else {
    $file_get_contents = 'No';
}

if (function_exists('openssl_encrypt')) {
    $openssl_encrypt = 'Yes';
} else {
    $openssl_encrypt = 'No';
}

if (function_exists('curl_version')) {
    $curl = 'Yes';
} else {
    $curl = 'No';
}
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
            <p><b>Systems Requirements</b></p>
            <br/>

            <p><b>PHP :</b> <b>(PHP 5.5 or Higher)</b>
            <span>Your php version is : <?php echo phpversion(); ?></span>
            </p>
            <p><b>PDO :</b> 
            <?php
            if (!defined('PDO::ATTR_DRIVER_NAME')) {
                echo 'PDO unavailable';
            } else {
                echo "PDO available";
            }
             ?></p>
            <p><b>file_get_contents() :</b> <?php echo $file_get_contents; ?></p>
            <p><b>base64_encode() :</b> <?php echo $base64_encode; ?></p>
            <p><b>json_encode() :</b> <?php echo $json_encode; ?></p>
            <p><b>openssl_encrypt() :</b> <?php echo $openssl_encrypt; ?></p>
            <p><b>mail() :</b> <?php echo $mail; ?></p>
            <p><b>number_format() :</b> <?php echo $number_format; ?></p>
            <p><b>cURL :</b> <?php echo $curl; ?></p>

            <p><a class="btn btn-primary" onclick="document.location='config.php'; ">Continue</a>
            </p>
        </header>


    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>