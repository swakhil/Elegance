<?php 

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


include '../functions/functions.php';
include '../functions/redirect.php';
$page_title = SITE_NAME.' | Saved';
$page = 'saved';
$id = ReturnID();
include '../includes/head.php';
?>


  <body class="animated fadeIn">


    <!-- Fixed navbar -->

    <?php
       include '../includes/header.php';
    ?>

    <!-- Begin page content -->

    <div class="container page-content" id="page-content">

      <div class="row">



  <?php
       include '../includes/left_side.php';
       $select_save_data = select_save_data('pid', '4');
       $select_save_data_count = select_save_count('pid', '4');
      foreach ($select_save_data as $rew) {
          $pid = $rew['save'];
          $id_order = select_sqlarg('saved', 'save', $pid, 'id');
          $datas = select_post($pid);
          foreach ($datas as $row) {
              ?>

         <i class="pointer-saved" id="page-id-<?php echo $id_order; ?>"></i>

         <?php
          include '../includes/post.php';
          }
      }

      if ($select_save_data_count > '3') {
          ?>

    <div id="loadmore-saved"></div>

                <div id="end-loadmore-saved" class="end-loadmore" style="display: none;"></div>

                  <div class="spinnera" id="spinner-saved" <?php echo post_count(true, '2'); ?>>

                      <div class="bounce1"></div>

                      <div class="bounce2"></div>

                      <div class="bounce3"></div>

    </div>

    <?php
      }
    include '../includes/right_side.php';
   ?>

      <input type="hidden" id="page-hidden-saved" value="<?php echo $page; ?>">

      <input type="hidden" id="id-hidden-saved" value="<?php echo $id; ?>">

      </div>

    </div>

   

  <?php 
       include '../includes/modal.php';
       include '../includes/chat.php';
       include '../includes/footer.php';
   ?>