<?php

require('../functions/functions.php');

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
        if (isset($_POST['flag'])) {
            $like_id = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING));
            $count = select_count('user_likes', 'like_id', $like_id, 'user_id', $user_id);
            if ($count != 0) {
                echo $count;
            }
        }
 
        if (isset($_POST['flag1'])) {
            $like_id = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING));
            $count = select_count('user_likes', 'like_id', $like_id, 'user_id', $user_id);
     
            if ($count == 0) {
                $like_post_owner = select_sqlarg('posts', 'pid', $like_id, 'id_user');
                $dates = date('Y-m-d h:i:s');
                $time = time();
                $today = date("F j, Y, g:i a");
                insert_user_likes($like_id, $user_id, $like_post_owner, $dates, '0', '0', $time, $today);
                add_like($like_id);
                InsertNotifications($like_post_owner, $user_id, 'post', 'like', $like_id);
                $pid_post = $like_id;
                $id_user_post = $user_id;
                $id_email = $like_post_owner;
                $notif_string = 'liked';
                $email_notif_like = select_sqlarg('email_notifications', 'id_user', $id_email, 'likes');
                if ($email_notif_like == '1') {
                    include '../includes/email_notification.php';
                }
                $count = select_sqlarg('posts', 'pid', $like_id, 'likes');
                if ($count != 0) {
                    echo $count;
                }
            } else {
                delete_user_likes($like_id, $user_id);
                substract_like($like_id);
                $like_post_owner = select_sqlarg('posts', 'pid', $like_id, 'id_user');
                DeleteNotifications($user_id, $like_post_owner, 'post', 'like', $like_id);
                $count = select_sqlarg('posts', 'pid', $like_id, 'likes');
                if ($count != 0) {
                    echo $count;
                }
            }
        }
    }
}
