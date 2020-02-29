<?php 

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


include '../functions/functions.php';
$page_title = $site_name.' - Privacy Policy';
$page = 'policy';
 include '../includes/head.php';
?>

  <body class="animated fadeIn">

   <!-- Fixed navbar -->

    <?php
    if (isset($_SESSION['id'])) {
        include '../includes/header.php';
    } else {
        include '../includes/header_offline.php';
    }
    ?>



    <!-- Begin page content -->

  <div class="container page-content edit-profile">

    <div class="row">

        <div class="container">

  <div class="col-md-12 col-xs-12 text-justify policy-text">

    <?php echo htmlspecialchars_decode(utf8_decode(general_settings('privacy'))); ?>

  </div>

 </div>

<br/>

    </div>

</div>

  <?php 
       include '../includes/modal.php';
       include '../includes/footer.php';
   ?>