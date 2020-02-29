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
$page = 'hashtag';

/* Get Variable and Sanitize */
$hashtag = trim(filter_input(INPUT_GET, "q", FILTER_SANITIZE_STRING));
$page_title = '"'.$hashtag.'" search results | '.$site_name;

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

      if (isset($_GET['q']) && $_GET['q'] != '') {
          //Format and Sanitize
          $data = search_hashtag($hashtag, '4');
          foreach ($data as $row) {
              ?>
          <i class="pointer-hashtag" id="<?php echo $hashtag; ?>"></i>
          <?php
          include 'includes/post.php';
          }
      }
    ?>
    <div id="loadmore-hashtag"></div>
                <div id="end-loadmore" class="end-loadmore" style="display: none;"></div>
                  <div class="spinnera" id="spinner" <?php echo post_count(true, '2'); ?>>
                      <div class="bounce1"></div>
                      <div class="bounce2"></div>
                      <div class="bounce3"></div>
    </div>
    <?php
    include 'includes/right_side.php';
   ?>
      <input type="hidden" id="page-hidden" value="<?php echo $page; ?>">
      </div>
    </div>
   
  <?php 
       include 'includes/modal.php';
       include 'includes/chat.php';
       include 'includes/footer.php';
   ?>