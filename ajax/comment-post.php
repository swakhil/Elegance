<?php

include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_SESSION['id'])) {
        if (!empty($_POST['comment']) || !empty($_POST['image'])) {

    //Format and Sanitize Comment
            $comment = trim(filter_input(INPUT_POST, "comment", FILTER_SANITIZE_SPECIAL_CHARS));
            $cpid = trim(filter_input(INPUT_POST, "pid", FILTER_SANITIZE_STRING));
            $img = trim(filter_input(INPUT_POST, "image", FILTER_SANITIZE_STRING));
            $id_user_com = $_SESSION['id'];
            $time = time();
            $id_post_owner = select_sqlarg('posts', 'pid', $cpid, 'id_user');
            $date = date('Y-m-d h:i:s');
            $adult_content_score = '0';

            $insert_comment = insert_comment($comment, $img, $cpid, $time, $id_user_com, $id_post_owner, $date, $date, $date, $adult_content_score);

            InsertNotifications($id_post_owner, $id_user_com, 'post', 'comment', $cpid);
            $pid_post = $cpid;
            $id_user_post = $id_user_com;
            $id_email = $id_post_owner;
            $notif_string = 'commented';
            $email_notif_comment = select_sqlarg('email_notifications', 'id_user', $id_email, 'comments');
            if ($email_notif_comment == '1') {
                include '../includes/email_notification.php';
            }

            if ($insert_comment != '') {
                $row_com['id_user_com'] = $id_user_com;
                $row_com['id_user_com'] = $id_user_com;
                $row_com['times_com'] = $time;
                $row_com['comment'] = $comment;
                $row_com['cid'] = $insert_comment;
                $row['pid'] = $cpid;
                $row_com['img'] = $img;
                $row_com['adult_content_score'] = $adult_content_score;
                include('../includes/comment.php');
            }
        }
    }
}
