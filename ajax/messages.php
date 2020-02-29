<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (count_global_message(returnID(), false) > 0) {
        $make_read = update_sql_arg('messages', 'notif_unread', '0', 'user_to', returnID()); ?>
  <script type='text/javascript'>
     document.title= title;
   </script>
<?php
    }
    $data = select_conversation(7, returnID()); ?>
<div class="panel-heading header-notif-messages">
                 <h3 class="panel-title">
                  <span class="head-search"><i class="fa fa-comments"></i> <b>Messages</b></span>
                 </h3>
</div>
<?php
foreach ($data as $row) {
        if (returnID() == select_last_message($row['cvid'], 'user_from')) {
            ?>
    <li class="notification" onclick="window.location.href='<?php echo $site_url."messages/".select_sql_id($row['user_id'], 'username'); ?>'">
                           <div class="media">
                              <div class="media-left">
                                 <div class="media-object">
                                    <img src="<?php echo $site_url.select_sql_id($row['user_id'], 'avatar'); ?>" class="img-circle width-notif-avatar" alt="Name">
                                 </div>
                              </div>
                              <div class="media-body">
                                 <span class="notification-title"><strong><a href="<?php echo $site_url.select_sql_id($row['user_id'], 'username'); ?>"><?php echo select_sql_id($row['user_id'], 'fullname'); ?></a></strong></span>

                                 <p class="notification-desc"><span class="primary-font"><?php echo truncate(select_last_message($row['cvid'], 'message'), '35'); ?></span> <?php echo count_message($row['cvid'], true); ?></p>

                                 <div class="notification-meta">
                                    <small class="timestamp"><?php echo timeago($row['dates_cv']); ?></small>
                                 </div>
                              </div>
                             <div class="media-left">
                                 <div class="media-object">
                                  <i class="fa fa-share read-status"></i>
                                 </div>
                              </div>
                           </div>
                        </li>
<?php
        } else {
            ?>
    <li class="notification" onclick="window.location.href='<?php echo $site_url."messages/".select_sql_id($row['user_id'], 'username'); ?>'">
                           <div class="media">
                              <div class="media-left">
                                 <div class="media-object">
                                    <img src="<?php echo $site_url.select_sql_id($row['user_id'], 'avatar'); ?>" class="img-circle width-notif-avatar" alt="Name">
                                 </div>
                              </div>
                              <div class="media-body">
                                 <span class="notification-title"><strong><a href="<?php echo $site_url.select_sql_id($row['user_id'], 'username'); ?>"><?php echo select_sql_id($row['user_id'], 'fullname'); ?></a></strong></span>

                                 <p class="notification-desc"><span class="primary-font"><?php echo truncate(select_last_message($row['cvid'], 'message'), '35'); ?></span> <?php echo count_message($row['cvid'], true); ?></p>

                                 <div class="notification-meta">
                                    <small class="timestamp"><?php echo timeago($row['dates_cv']); ?></small>
                                 </div>
                              </div>
                             <div class="media-left">
                                 <div class="media-object">
                                  <i class="fa fa-share fa-rotate-180 read-status"></i>
                                  <!--<i class="fa fa-check-circle read-status"></i>-->
                                 </div>
                              </div>
                           </div>
                        </li>
<?php
        }
    }

    if(count_message_all(returnID()) == 0) {
      ?>

               <li class="notification">
                           <div class="media">
                              <div class="media-body">
                                 <p class="notification-desc">
                                 You do not have any messages.
                                 </p>
                              </div>
                           </div>
                        </li>
<?php
    }
}
?>