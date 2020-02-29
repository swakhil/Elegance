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
$page = 'support';
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
          <!-- People Support For Cause -->
          <div class="widget">
      
            <div class="widget-header">
              <h3 class="widget-caption-center"><center>Support this Cause</center></h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <div class="card">
                  <div class="content">
                      <p style="text-align:justify;">My name is Chandramouli and I’ve spent nearly 15+ years in the Education sector.</p>
                      <p style="text-align:justify;">I always had a challenge in understanding my neighbor, I know them personally as well professionally but never had a clue about their inclination towards social causes. They might be doing some great things, but I might never know until I ask them.</p><br>
                      <p style="text-align:justify;">This is when I felt there is a need to form a network just for this purpose, which will basically give us their social responsibility profile. A lot of people do post about their social activities on Facebook, LinkedIn, and other social websites, but as more and more post things other than social activities we tend to miss out on these important aspects of an individual. We all live in the age of turmoil and more than ever we all need each other to depend on one another or to get inspired.</p>
                      <p style="text-align:justify;">We will really appreciate if you can support us in this cause just by publishing details about your social activities.</p>
                      <p style="text-align:justify;">If you would like to fund this cause, we will also appreciate the same.</p>
                      <p style="text-align:justify;">  &bull;   Some portion of the funds will be used to develop this website, build a mobile APP and enhance the user experience.</p>
                      <p style="text-align:justify;">  &bull;   The remaining portion of the funds will be utilized for the causes which we are driving locally through our volunteers and social enterprises. We will share the complete details on how we are utilizing these funds.</p>
                      <p style="text-align:justify;">  &bull;   Support this cause using this link: <a href="https://paypal.me/chandramoulisamatham">here</a>.</p>  
                      <p style="text-align:justify;">Please review the below link for my Credentials or any other details.</p>
                      <p style="text-align:justify;"><a href="https://www.linkedin.com/in/chandrasamatham/">https://www.linkedin.com/in/chandrasamatham/</a></p>
                  </div>
              </div>          
            </div>
          </div><!-- End Support For Cause --> 
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