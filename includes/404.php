<?php
  $page_title = $site_name.' - 404 Not Found';
  $page = '404';
  include 'head.php';
?>

  <body class="animated fadeIn">

   <!-- Fixed navbar -->

    <?php
    if (isset($_SESSION['id'])) {
        include 'header.php';
    } else {
        include 'header_offline.php';
    }
    ?>



    <!-- Begin page content -->

  <div class="container page-content edit-profile">

    <div class="row">

        <div class="container">

  <div class="col-md-12 col-xs-12 text-justify policy-text">

    <h1 class="gray"><center>Sorry! This page seems not found!</center></h1>
    <p><center class="gray"> 404 - Not found</center></p>

    <br/><hr class="gray" />
       <center> <a class="gray" href="javascript:history.go(-1)"> Return on previous page</a> | <a class="gray" href="<?php echo $site_url;?>">Go to home page</a></center>
        </div>
  </div>

 </div>

<br/>

    </div>

</div>

  <?php 
       include 'modal.php';
       include 'footer.php';
   ?>