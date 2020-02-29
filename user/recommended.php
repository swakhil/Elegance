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
$page_title = SITE_NAME;
$page = 'recommended';
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
       ?>
        <div class="col-md-13">
          <!-- People You May Know -->
          <div class="widget">
      
            <div class="widget-header">
              <h3 class="widget-caption-center"><center>People You May Know</center></h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <div class="card">
                  <div class="content">
                      <ul class="list-unstyled team-members">
                      <?php
                      $data = show_recommended('12');
                      foreach ($data as $row) {
                          if (is_follow_user($row['id']) == 0) {
                              ?>
                        <li id="recommended-<?php echo $row['id']; ?>">
                              <div class="row">
                                  <div class="col-xs-3">
                                      <div class="avatar">
                                      <a href="<?php echo $site_url.$row['username']; ?>">
                                          <img src="<?php echo $site_url.$row['avatar']; ?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                          </a>
                                      </div>
                                  </div>
                                  <div class="col-xs-6 blue-design">
                                  <a href="<?php echo $site_url.$row['username']; ?>">
                                     <?php echo $row['firstname'].' '.$row['lastname']; ?>
                                     </a>
                                  </div>
                                  <div class="col-xs-6">
                                     <a href="<?php echo $site_url.$row['username']; ?>"><?php echo show_username($row['username']); ?></a>
                                  </div>
                      
                                  <div class="col-xs-3 text-right">
                                      <btn class="btn btn-sm btn-azure btn-icon" id="follow-people" data-id="<?php echo $row['id']; ?>" data-state="follow"><i class="fa fa-user-plus"></i></btn>
                                  </div>
                              </div>
                          </li>
                          <?php
                          }
                      }
                      ?>
                      </ul>
                  </div>
              </div>          
            </div>
          </div><!-- End people yout may know --> 
        </div>
       <?php
       include '../includes/right_side.php';
   ?>

      </div>
    </div>
   
  <?php 
       include '../includes/chat.php';
       include '../includes/modal.php';
       include '../includes/footer.php';
   ?>