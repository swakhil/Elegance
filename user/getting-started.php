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
$page_title = $site_name.'- Getting Started';
$page = 'getting-started';
include '../includes/head.php';
?>
  <body class="animated fadeIn">

    <!-- Fixed navbar -->
    <?php
       include '../includes/header.php';
    ?>
    <!-- Begin page content -->
    <link href="<?php echo $site_url; ?>assets/css/people_directory.css" rel="stylesheet">
    <div class="container page-content ">
                
      <div class="directory-info-row">
      <p class="col-sm-12 started-title" id="design-gradient">Get Starting by follow this people!</p>
          <div class="row">
                   <?php
                      $data = show_recommended('9');
                      foreach ($data as $row) {
                          if (is_follow_user($row['id']) == 0) {
                              ?>
                 <div class="col-md-4 col-sm-4 col-xs-8" >
                  <div class="panel" id="gradient-started">
                  <div class="panel-body" id="design-started">
                      <div class="media">
                          <a class="pull-left" href="<?php echo $site_url.$row['username']; ?>">
                              <img class="img-responsive thumbnail media-object" src="<?php echo $site_url.$row['avatar']; ?>" alt="<?php echo $row['firstname'].' '.$row['lastname']; ?> Photos">
                          </a>
                          <div class="media-body">
                             <h4>
                               <a href="<?php echo $site_url.$row['username']; ?>">
                              <?php echo $row['firstname'].' '.$row['lastname']; ?>
                              </a>
                              <span class="text-muted small">
                              <br/>
                              <a href="<?php echo $site_url.$row['username']; ?>">
                                     <?php echo $row['username']; ?>
                              </a>
                              </span>
                            </h4>
                             <a data-toggle="dropdown" data-state="follow" class="btn btn-azure color-white follow-user-<?php echo $row['id']; ?>" href="#" id="follow-user" data-id="<?php echo $row['id']; ?>"> Follow <i class="fa fa-user-plus"></i></a>
                         </div>
                      </div>
                   </div>
                  </div>
                </div>
             <?php
                          }
                      }
             ?>
                  <div class="col-md-12 col-sm-6 col-xs-12">
                  <div class="panel" id="gradient-started">
                  <div class="panel-body" id="gradient-started"><a href="<?php echo $site_url; ?>" class="btn btn-azure" id="btn-final-design">Take me to Home <i class="fa fa-home"></i></a><br/>
                  </div>
                  </div>
                  </div>
          

        </div> <!--row -->
		
      </div> <!--directory-info-row -->
  
    </div><!--container page-content -->

    <?php include '../includes/footer.php'; ?>