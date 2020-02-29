<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+

   include_once 'functions/functions.php';
   
   include_once 'functions/redirect.php';
   
   $active0 = ''; $active1 = '1'; $active2 = ''; $active3 = '';$active4 = ''; $active5 = '';

   
   if ($page == 'dashboard') {
       $active0 = 'class="active"';
   }
   
   if ($page == 'general') {
       $active1 = 'class="active"';
   }
   
   if ($page == 'users') {
       $active2 = 'class="active"';
   }

   if ($page == 'posts') {
       $active3 = 'class="active"';
   }

   if ($page == 'seo') {
       $active4 = 'class="active"';
   }

   if ($page == 'ads') {
       $active5 = 'class="active"';
   }
   
   ?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <link rel="icon" type="image/png" href="<?php echo $site_favicon; ?>">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <title><?php echo $site_name; ?> | Admin</title>
      <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
      <meta name="viewport" content="width=device-width" />
      <!-- Bootstrap core CSS     -->
      <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
      <!-- Animation library for notifications   -->
      <link href="assets/css/animate.min.css" rel="stylesheet"/>
      <!--  Light Bootstrap Table core CSS    -->
      <link href="assets/css/bootstrap-dashboard.css" rel="stylesheet"/>
      <link href="assets/css/style.css" rel="stylesheet" />
      <!--     Fonts and icons     -->
      <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
      <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
      <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
      <!--Plugins SweetAlert -->
    <link rel="stylesheet" href="<?php echo $site_url; ?>admin/assets/sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $site_url; ?>admin/assets/sweetalert/themes/theme3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $site_url; ?>admin/assets/css/editor.css"></link>
    <link href="assets/css/forms.css" rel="stylesheet" />
    <link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script src="<?php echo $site_url; ?>admin/assets/js/jquery-1.11.3.min.js"></script>
   </head>
   <body>
      <script>hljs.initHighlightingOnLoad();</script>
      <div class="wrapper">
      <div class="sidebar"  data-color="" data-image="<?php echo $background_home_1; ?>">
         <div class="sidebar-wrapper">
            <div class="logo">
               <a href="<?php echo $website_url; ?>admin" class="simple-text">
               <img class="img-responsive" src="<?php echo $site_logo; ?>"/>
               </a>
            </div>
            <ul class="nav">
               <li <?php echo $active0; ?>>
                  <a href="<?php echo $website_url; ?>admin">
                     <i class="pe-7s-graph"></i>
                     <p>Admin Dashboard</p>
                  </a>
               </li>
               <li <?php echo $active1; ?>>
                  <a href="general.php">
                     <i class="pe-7s-settings"></i>
                     <p>General Settings</p>
                  </a>
               </li>
               <li <?php echo $active2; ?>>
                  <a href="users.php">
                     <i class="pe-7s-users"></i>
                     <p>Users</p>
                  </a>
               </li>
               <li <?php echo $active3; ?>>
                  <a href="posts.php">
                     <i class="pe-7s-news-paper"></i>
                     <p>Posts</p>
                  </a>
               </li>
               <li <?php echo $active4; ?>>
                  <a href="seo.php">
                     <i class="pe-7s-global"></i>
                     <p>Website SEO</p>
                  </a>
               </li>
               <li <?php echo $active5; ?>>
                  <a href="ads.php">
                     <i class="pe-7s-display1"></i>
                     <p>Website Ads</p>
                  </a>
               </li>
            </ul>
         </div>
      </div>
      <div class="main-panel">
      <nav class="navbar navbar-default navbar-fixed">
         <div class="container-fluid">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="#">Welcome <?php echo select_sql('fullname'); ?>!</a>
            </div>
            <div class="collapse navbar-collapse">
               <ul class="nav navbar-nav navbar-right">
                  <li>
                     <a href="switch_account.php">
                     Go to Website
                     </a>
                  <li>
                     <a href="logout.php">
                     Log out
                     </a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>