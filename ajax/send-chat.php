<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_SESSION['id'])) {
        if (isset($_POST['message']) || isset($_POST['user_to']) || isset($_POST['cvid'])) {
            //Format and Sanitize Variables
            $message = trim(filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING));
            $user_to = trim(filter_input(INPUT_POST, "user_to", FILTER_SANITIZE_STRING));
            $cvid = trim(filter_input(INPUT_POST, "cvid", FILTER_SANITIZE_STRING));
        }


        if (isset($_POST['message']) && trim($_POST['message']) != '') {
            $dates_send = date('Y-m-d H:i:s');
            insert_message($cvid, returnID(), $user_to, $message, '0', '1', '1', $dates_send);
            $messages_text = $message;
            $id_user_post = returnID();
            $id_email = $user_to;
            $email_notif_message = select_sqlarg('email_notifications', 'id_user', $id_email, 'messages');
            if ($email_notif_message == '1') {
                include '../includes/email_message.php';
            }
            update_sql_arg('conversation', 'dates_cv', $dates_send, 'cvid', $cvid);


            $count = select_message($cvid, true);
            $data_message = select_message($cvid);
            if ($count > 0) {
                foreach ($data_message as $row) {
                    if (returnID() == $row['user_from']) {
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
                    } else {
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
        }
    }
}
?>