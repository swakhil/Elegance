<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_POST['message']) || isset($_POST['user_to']) || isset($_POST['cvid'])) {
        //Format and Sanitize Variables
        $message = trim(filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING));
        $user_to = trim(filter_input(INPUT_POST, "user_to", FILTER_SANITIZE_STRING));
        $cvid = trim(filter_input(INPUT_POST, "cvid", FILTER_SANITIZE_STRING));
    }

    if (isset($_POST['cvid_2'])) {
        $cvid = trim(filter_input(INPUT_POST, "cvid_2", FILTER_SANITIZE_STRING));
    }

    if (isset($_POST['u'])) {
        $u = trim(filter_input(INPUT_POST, "u", FILTER_SANITIZE_STRING));
        $id = select_sqlarg('users', 'username', $u, 'id');

        if ($id == returnID() || $id == '') {
            /*******************/
        } else {
            $cvid = select_conversation(0, returnID(), $id, 'cvid');
            if ($cvid == '') {
                //Create a conversation
                $cvid  = create_conversation(returnID(), $id);
            }
        }
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
    }

    if (isset($_POST['u']) || isset($_POST['message']) || isset($_POST['cvid_2'])) {

  //All Messages with flag read
        $make_read = update_sqldouble_arg('messages', 'unread', '0', 'cvid_fk', 'user_to', $cvid, returnID());

        $make_read = update_sqldouble_arg('messages', 'notif_unread', '0', 'cvid_fk', 'user_to', $cvid, returnID());

        $data_message = select_message($cvid);
        foreach ($data_message as $row) {
            if (returnID() == $row['user_from']) {
                if ($row['hide_user_from'] == 0) {
                    ?>
                <li class="left clearfix">
                        <span class="chat-img1 pull-left">
                        <img src="<?php echo $site_url.select_sql_id($row['user_from'], 'avatar'); ?>" alt="<?php echo select_sql_id($row['user_from'], 'fullname'); ?> avatar" class="img-circle">
                        </span>
                        <div class="chat-body1 clearfix">
                            <span class="fa fa-trash dark-color delete-msg" mid="<?php echo $row['mid']; ?>" data-mid="<?php echo crypt_data('0', 'e'); ?>"></span>
                           <p><?php echo $row['message']; ?></p>
                           <div class="chat_time pull-right"><?php echo show_username(select_sql_id($row['user_from'], 'username')); ?> <?php echo timeago($row['dates_send']); ?></div>
                        </div>
                     </li>
                 <?php
                }
            } else {
                if ($row['hide_user_to'] == 0) {
                    ?>
                     <li class="left clearfix admin_chat">
                        <span class="chat-img1 pull-right">
                        <img src="<?php echo $site_url.select_sql_id($row['user_from'], 'avatar'); ?>" alt="<?php echo select_sql_id($row['user_from'], 'fullname'); ?> avatar" class="img-circle">
                        </span>
                        <div class="chat-body1 clearfix">
                            <span class="fa fa-trash dark-color delete-msg" mid="<?php echo $row['mid']; ?>" data-mid="<?php echo crypt_data('1', 'e'); ?>"></span>
                           <p><?php echo $row['message']; ?></p>
                           <div class="chat_time pull-left"><?php echo show_username(select_sql_id($row['user_from'], 'username')); ?> <?php echo timeago($row['dates_send']); ?></div>
                        </div>
                     </li>
                     <?php
                }
            }
        }
    }
}
?>