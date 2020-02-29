<?php 
// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+
include 'functions/functions.php';
include 'functions/redirect.php';

$page_title = SITE_NAME;
$page = 'post';
$id = ReturnID();
$pid = trim(filter_input(INPUT_GET, 'pid', FILTER_SANITIZE_STRING));
$verif_pid = verif_pid($pid);

if ($verif_pid > 0) {
    include 'includes/head.php'; ?>


  <body class="animated fadeIn">

    <!-- Fixed navbar -->
    <?php
       include 'includes/header.php'; ?>
    <!-- Begin page content -->
    <div class="container page-content" id="page-content">
      <div class="row">

  <?php
       include 'includes/left_side.php';
    $pid = trim(filter_input(INPUT_GET, 'pid', FILTER_SANITIZE_STRING));
    ;
    $datas = select_post($pid);
    foreach ($datas as $row) {
        ?>
          <br/>
         <?php
          include 'includes/post.php';
    } ?>
    <?php
    include 'includes/right_side.php'; ?>
      <input type="hidden" id="page-hidden-saved" value="<?php echo $page; ?>">
      <input type="hidden" id="id-hidden-saved" value="<?php echo $id; ?>">
      </div>
    </div>
   
  <?php 
       include 'includes/modal.php';
    include 'includes/chat.php';
    include 'includes/footer.php';
} else {
    include 'includes/404.php';
}
   ?>