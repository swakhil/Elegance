<?php
include 'functions/redirect.php';
$page_title = SITE_NAME;
$page = 'home';
$id = ReturnID();
include 'includes/head.php';
?>


  <body class="animated fadeIn">

    <!-- Fixed navbar -->
    <?php
       include 'includes/header.php';
    ?>
    <!-- Begin page content -->
    <div class="container page-content" id="page-content">
      <div class="row">

  <?php
       include 'includes/left_side.php';

       include 'includes/timeline.php';

       include 'includes/right_side.php';
   ?>

      </div>
    </div>
   
  <?php 
       include 'includes/chat.php';
       include 'includes/footer.php';
   ?>