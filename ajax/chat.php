<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    $cvid = trim(filter_input(INPUT_POST, "cvid", FILTER_SANITIZE_STRING));
    $id = trim(filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING));
    //All Messages with flag read
    $make_read = update_sql_arg('messages', 'unread', '0', 'cvid_fk', $cvid);

    $count = select_message($cvid, true);
    $data_message = select_message($cvid);
    if ($count > 0) {
        foreach ($data_message as $row) {
            if (returnID() == $row['user_from']) {
                if ($row['hide_user_from'] == 0) {
                    ?>
                 <div class="row msg_container base_sent">
                        <div class="col-md-10 col-md-10-edit col-xs-10">
                            <div class="messages msg_sent">
                                <p><?php echo $row['message']; ?></p>
                                <time datetime=""><?php echo show_username(select_sql_id($row['user_from'], 'username')); ?> • <?php echo timeago($row['dates_send']); ?></time>
                            </div>
                        </div>
                        <div class="col-md-2 col-md-2-edit col-xs-2 avatar-edit">
                            <img src="<?php echo $site_url.select_sql_id($row['user_from'], 'avatar'); ?>" class=" img-responsive" alt="<?php echo select_sql_id($row['user_from'], 'fullname'); ?> avatar">
                        </div>
                    </div>
                    <?php
                }
            } else {
                if ($row['hide_user_to'] == 0) {
                    ?>
                    <div class="row msg_container base_receive">
                        <div class="col-md-2 col-md-2-edit col-xs-2 avatar-edit">
                            <img src="<?php echo $site_url.select_sql_id($row['user_from'], 'avatar'); ?>" class=" img-responsive" alt="<?php echo select_sql_id($row['user_from'], 'fullname'); ?> avatar">
                        </div>
                        <div class="col-md-10 col-md-10-edit col-xs-10">
                            <div class="messages msg_receive">
                                <p><?php echo $row['message']; ?></p>
                                <time datetime=""><?php echo show_username(select_sql_id($row['user_from'], 'username')); ?> • <?php echo timeago($row['dates_send']); ?></time>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
        }
    } else {
        ?>
  <li class="notification">
                           <div class="media">
                              <div class="media-body">
                                 <p class="notification-desc"><center><span class="primary-font">Start a chat with <?php echo select_sql_id($id, 'fullname'); ?> today!</span></center></p>
                              </div>
                           </div>
                        </li>
  <?php
    }
}
?>