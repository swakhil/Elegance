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
$page_title = SITE_NAME.' | Notifications';
$page = 'home';
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

        <div class="col-md-11"><!--notif-design-->

        <?php
          $data = ShowNotifications(returnID(), '10');
        ?>

<div class="panel-heading header-notif-messages">

                 <h3 class="panel-title">

                  <span class="head-search"><i class="fa fa-globe"></i> <b>Notifications</b></span>

                 </h3>

</div>

<?php
foreach ($data as $row) {
            if ($row['type'] == 'post') {
                ?>



               <li class="notification">

                           <div class="media">

                              <div class="media-left">

                                 <div class="media-object">

                                    <a href="<?php echo $site_url; ?><?php echo select_sql_id($row['sender_id'], 'username'); ?>"><img src="<?php echo $site_url.select_sql_id($row['sender_id'], 'avatar_thumb'); ?>" class="img-circle width-notif-avatar" alt="Name">

                                    </a>

                                 </div>

                              </div>

                              <div class="media-body">

                                 <span class="notification-title">

                                 <b><a href="<?php echo $site_url; ?><?php echo select_sql_id($row['sender_id'], 'username'); ?>"><?php echo select_sql_id($row['sender_id'], 'fullname'); ?></a></b>

                                   <?php echo notif_post_parameters($row['parameters'], 'has liked your <b>post</b>', 'has commented your <b>post</b>', 'has shared your <b>post</b>', 'has tagged you in a <b>post</b>'); ?> </span>

                                 <p class="notification-desc"><?php echo convert_links(truncate(select_post_id($row['reference_id'], 'texts'), '25')); ?>

                                 </p>

                                 <div class="notification-meta">

                                    <small class="timestamp"><?php echo timeago($row['created_at']); ?></small>

                                 </div>

                              </div>

                              <div class="media-left">

                                 <div class="media-object">

                                    <?php
                                     if (select_post_id($row['reference_id'], 'image_url') != '') {
                                         echo ShowImageNotif($row['reference_id'], select_post_id($row['reference_id'], 'image_url'));
                                     } ?>

                                 </div>

                              </div>

                           </div>

                        </li>

<?php
            } elseif ($row['type'] == 'friends') {
                ?>

    <li class="notification">

                           <div class="media">

                              <div class="media-left">

                                 <div class="media-object">

                                    <a href="<?php echo $site_url; ?><?php echo select_sql_id($row['sender_id'], 'username'); ?>"><img src="<?php echo $site_url.select_sql_id($row['sender_id'], 'avatar_thumb'); ?>" class="img-circle width-notif-avatar" alt="Name">

                                    </a>

                                 </div>

                              </div>

                              <div class="media-body">

                                 <span class="notification-title">

                                 <b><a href="<?php echo $site_url; ?><?php echo select_sql_id($row['sender_id'], 'username'); ?>"><?php echo select_sql_id($row['sender_id'], 'fullname'); ?></a></b> <?php echo notif_friend_parameters($row['parameters'], 'has followed you', 'has post something', 'has liked a <b>publication</b>', 'has commented a <b>publication</b>', 'shared a publication'); ?></span>

                                 <?php
                                 if ($row['parameters'] != 'follow') {
                                     ?>

                                 <p class="notification-desc"><?php echo truncate(select_post_id($row['reference_id'], 'texts'), '25'); ?>

                                 </p>

                                 <?php
                                 } ?>

                                 <div class="notification-meta">

                                    <small class="timestamp"><?php echo timeago($row['created_at']); ?></small>

                                 </div>

                              </div>

                              <div class="media-left">

                                 <div class="media-object">

                                    <?php
                                    if ($row['parameters'] != 'follow') {
                                        if (select_post_id($row['reference_id'], 'image_url') != '') {
                                            echo ShowImageNotif($row['reference_id'], select_post_id($row['reference_id'], 'image_url'));
                                        }
                                    } else {
                                        ?>

                                      <a href="<?php echo $site_url; ?><?php echo select_sql_id($row['recipient_id'], 'username'); ?>"><img src="<?php echo $site_url.select_sql_id($row['recipient_id'], 'avatar_thumb'); ?>" class="img-circle width-notif-avatar" alt="Name">

                                    </a>

                                      <?php
                                    } ?>

                                 </div>

                              </div>

                           </div>

                        </li>

    <?php
            }
        }
if (notif_count(false, '') == '0') {
    ?>



               <li class="notification">

                           <div class="media">

                              <div class="media-body">

                                 <p class="notification-desc">

                                 You do not have any notifications.

                                 </p>

                              </div>

                           </div>

                        </li>

<?php
}
?>

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