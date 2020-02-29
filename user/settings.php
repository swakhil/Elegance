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
include '../ajax/settings.func.php';
$page_title = $site_name.' - Settings';
$page = 'settings';
include '../includes/head.php';
?>
  <body class="animated fadeIn">
   <!-- Fixed navbar -->
    <?php
       include '../includes/header.php';
    ?>

    <!-- Begin page content -->
  <div class="container page-content edit-profile">
    <div class="row">
   <?php
       include '../includes/left_side.php';
   ?>
        <div class="col-md-9 well admin-content" id="general">
          <span id="msg-update"></span>
           <span id="general-update">
            <?php 
             include '../includes/settings-general.php';
            ?>
           </span>
        </div>
         
         
        <div class="col-md-3">
          <div class="tab-tabs">
            <div class="tabs-inside">
                <i class="fa fa-align-justify"></i>
                Settings
            </div>
        </div>
            <ul class="nav nav-settings">
                <li><a href="#" class="ajax-general"><i class="fa fa-gear fa-fw"></i>General Settings</a></li>
                <li class="ajax-email"><a href="#"><i class="fa fa-inbox fa-fw"></i>Options</a></li>
                <li class="ajax-password"><a href="#"><i class="fa fa-key fa-fw"></i>Password</a></li>
                <li class="ajax-deactivate"><a href="#"><i class="fa fa-power-off fa-fw"></i>Delete account</a></li>
            </ul>
        </div>

    </div>
</div>
  <?php 
       include '../includes/chat.php';
       include '../includes/footer.php';
   ?>