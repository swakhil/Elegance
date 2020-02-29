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
include 'includes/search-intro.php';
?>


<body>

     <!-- Fixed navbar -->
<?php
   include 'includes/header.php';
?>

 <div class="row" style="margin-top: 55px;">
  <div class="col-md-5 col-md-offset-4">
     
<?php
   if (isset($_GET['q']) && $_GET['q'] != '') {
       //Format and Sanitize
       $key = trim(filter_input(INPUT_GET, "q", FILTER_SANITIZE_STRING));
       $data = search_data($key, '8'); ?>
      <div class="panel panel-default" id="panel-head">
            <div class="panel-heading" id="panel-head">
                <a href="">
                 <h3 class="panel-title">
                  <span class="head-search"><i class="fa fa-search"></i> <?php echo search_count($key, 'true', 'search result', 'search results'); ?></span>
                 </h3>
                </a>
            </div>
            <div class="table-container">
                    <table class="table-users table" border="0">
                        <tbody>
                        <?php
                        foreach ($data as $row) {
                            ?>
                           <tr>
                                <td align="center">
                                 <a href="<?php echo $site_url.$row['username']; ?>/1">
                                    <img class="img-search" src="<?php echo $site_url.$row['avatar']; ?>" alt="User Image"/>
                                  </a>
                                </td>
                                <td class="user-search">
                                     <a href="<?php echo $site_url.$row['username']; ?>/1"><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></a>
                                     <br>
                                     <a href="<?php echo $site_url.$row['username']; ?>/1"><?php echo show_username($row['username']); ?>
                                     </a>
                                </td>
                                <td align="center">
                                    Last Login:  6/14/2017<br><small class="text-muted"><?php echo get_timeago($row['last_time_session']); ?></small>
                                </td>
                            </tr>
                           <?php
                        }
       if (search_count($key) == 0) {
           ?>
                             <tr>
                                <td class="user-search" align="center">
                                     No result to show.
                                </td>
                            </tr>
                            <?php
       } ?>
                        </tbody>
                    </table>
                </div>
        </div>

  <?php
   }
?>
 </div>
</div>
    <?php 
      include 'includes/chat.php';
      include 'includes/footer.php';
   ?>