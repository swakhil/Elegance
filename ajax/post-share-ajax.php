<?php

require('../functions/functions.php');

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
        if (isset($_POST['flag'])) {
            $share_id = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING));
            $count = select_count('user_share', 'share_id', $share_id, 'user_id', $user_id);
            if ($count != 0) {
                echo $count;
            }
        }

        if (isset($_POST['flag1'])) {
            $share_id = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING));
            $desc = trim(filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING));
            $count = select_count('user_share', 'share_id', $share_id, 'user_id', $user_id);
            $share_post_owner = select_sqlarg('posts', 'pid', $share_id, 'id_user');
            $dates = date('Y-m-d h:i:s');
            $time = time();
            $today = date("F j, Y, g:i a");
            insert_user_share($share_id, $user_id, $share_post_owner, $dates, '0', '0', $time, $today);
            add_share($share_id);
            InsertNotifications($share_post_owner, $user_id, 'post', 'share', $share_id);
            $pid_post = $share_id;
            $id_user_post = $user_id;
            $id_email = $share_post_owner;
            $notif_string = 'shared';
            $email_notif_share = select_sqlarg('email_notifications', 'id_user', $id_email, 'shares');
            if ($email_notif_share == '1') {
                include '../includes/email_notification.php';
            }

            $count = select_sqlarg('posts', 'pid', $share_id, 'share');
            if ($count != 0) {
                echo $count;
            }


            if (isset($_SESSION['id'])) {
    
                //Format and Sanitize Post
                $status = trim(filter_input(INPUT_POST, "desc", FILTER_SANITIZE_STRING));
                $status = html_entity_decode($status, ENT_QUOTES, 'UTF-8');
                $privacy = select_sql('privacy');
    
                $id_user = $_SESSION['id'];
                $avatar_status = '';
                $cover_status = '';
                $hashtag = trim(gethashtags($status));
                $image_url = '';
                $image_url_thumb = '';
                $video = '';
                $video_thumb = '';
                $video_url = '';
                $video_url_thumb = '';
                $video_url_type = '';
                $video_url_desc = '';
                $video_url_title = '';
                $video_url_class = '';
                $link_url = '';
                $link_title_url = '';
                $link_img_url = '';
                $link_desc_url = '';
                $date_post = date('Y-m-d');
                $time_post = time();
                $likes = '';
                $share = '';
                $location = '';
                $user_share = select_post_id($share_id, 'id_user');
                $pid_share = $share_id;
                $adult_content_score = '0';

                $pid = insert_post($id_user, $status, $hashtag, $image_url, $image_url_thumb, $video, $video_thumb, $video_url, $video_url_thumb, $video_url_type, $video_url_desc, $video_url_title, $video_url_class, $link_url, $link_title_url, $link_img_url, $link_desc_url, $date_post, $time_post, $likes, $share, $location, $user_share, $pid_share, $avatar_status, $cover_status, $privacy, $adult_content_score);
            }
        }
    }
}
