<!DOCTYPE html>

<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="<?php echo $site_url.'admin/'.$site_favicon; ?>">

    <title><?php echo $page_title; ?></title>

    <?php 

         echo html_entity_decode($meta, ENT_QUOTES, 'UTF-8');

    ?>

    <!--     Fonts and icons     -->

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Lato:400|Inconsolata" rel="stylesheet" />

    <link rel="stylesheet" href="<?php echo $site_url; ?>assets/font-awesome/css/font-awesome.css" />

     <!-- Bootstrap core CSS -->

    <link href="<?php echo $site_url; ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- CSS -->

    <link href="<?php echo $site_url; ?>assets/css/animate.min.css" rel="stylesheet">

    <!-- GENERAL STYLE CSS -->

    <link href="<?php echo $site_url; ?>assets/css/style.css" rel="stylesheet">

    <!-- Plugin bootstrap-datepicker CSS -->

    <link href="<?php echo $site_url; ?>assets/css/bootstrap-datepicker.css" rel="stylesheet">

     <!-- Plugin jqGifPreview CSS -->

    <link rel="stylesheet" href="<?php echo $site_url; ?>assets/plugins/jqGifPreview/jqGifPreview.css" />

    <!--Plugins SweetAlert -->

    <link rel="stylesheet" href="<?php echo $site_url; ?>assets/plugins/sweetalert/dist/sweetalert.css">

    <link rel="stylesheet" type="text/css" href="<?php echo $site_url; ?>assets/plugins/sweetalert/themes/theme3.css">
 
    <!-- Plugin JQuery JS -->

    <script src="<?php echo $site_url; ?>assets/js/jquery.1.11.1.min.js"></script>

    <!-- Plugin Autosize JS -->

    <script src="<?php echo $site_url; ?>assets/js/autosize.js"></script>

    <!-- Plugin bootstrap-datepicker JS -->

    <script src="<?php echo $site_url; ?>assets/js/bootstrap-datepicker.js"></script>

    <!-- Plugin jqGifPreview JS -->

    <script src="<?php echo $site_url; ?>assets/plugins/jqGifPreview/jqGifPreview.js"></script>

    <!-- Begin emojionearea JavaScript -->

    <script type="text/javascript" src="<?php echo $site_url; ?>assets/plugins/emojionearea/emojionearea.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo $site_url; ?>assets/plugins/emojionearea/emojionearea.css" media="screen">

    <!-- End emojionearear JavaScript -->

    <!-- Begin php-emoji -->

    <link href="<?php echo $site_url; ?>assets/plugins/php-emoji/emoji.css?cb=<?php echo time(); ?>" rel="stylesheet" type="text/css" />

    <!-- End php-emoji -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->



  <script type="text/javascript"> var title = document.title; </script>

  <?php 
  if ($page != 'policy') {
      echo ReturnCSRF($_SESSION[$id_csrf.'_token']);
  }
  ?>
  
</head>