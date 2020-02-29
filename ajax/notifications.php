<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (notif_count() > '0') {
        $make_read = update_sql_arg('notifications', 'unread', '0', 'recipient_id', returnID()); ?>
  <script type='text/javascript'>
     document.title= title;
   </script>
<?php
    }
    $data = ShowNotifications(returnID(), '6'); ?>
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
                                 <b><a href="<?php echo $site_url.select_sql_id($row['sender_id'], 'username'); ?>"><?php echo select_sql_id($row['sender_id'], 'fullname'); ?></a></b>
                                  <a href="<?php echo $site_url.'post/'.$row['reference_id']; ?>">
                                   <?php echo notif_post_parameters($row['parameters'], 'has liked your <b>post</b>', 'has commented your <b>post</b>', 'has shared your <b>post</b>', 'has tagged you in a <b>post</b>'); ?> </span>
                                   <p class="notification-desc"><?php echo convert_links(truncate(select_post_id($row['reference_id'], 'texts'), '25')); ?>
                                   </p>
                                  </a>
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
                                 <b><a href="<?php echo $site_url; ?><?php echo select_sql_id($row['sender_id'], 'username'); ?>"><?php echo select_sql_id($row['sender_id'], 'fullname'); ?></a></b> <a href="<?php echo $site_url.'post/'.$row['reference_id']; ?>"><?php echo notif_friend_parameters($row['parameters'], 'has followed you', 'has post something', 'has liked a <b>publication</b>', 'has commented a <b>publication</b>', 'shared a publication'); ?>
                                 </a></span>
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
}
?>