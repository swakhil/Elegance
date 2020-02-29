<?php

    //Format and Sanitize Post
    $status = trim(filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING));
    $status = html_entity_decode($status, ENT_QUOTES, 'UTF-8');
    $image_url = trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING));
    $privacy = trim(filter_input(INPUT_POST, 'privacy', FILTER_SANITIZE_STRING));
    $image_url_thumb = trim(filter_input(INPUT_POST, 'image_thumb', FILTER_SANITIZE_STRING));
    $adult_content_score = trim(filter_input(INPUT_POST, "adult_content_score", FILTER_SANITIZE_STRING));
    $block_adult_content = select_sqlarg('email_notifications', 'id_user', returnID(), 'block_adult_content');
    
    if (isset($_POST['privacy'])) {
        if ($privacy == 'Public') {
            $privacy = '0';
        } elseif ($privacy == 'Followers') {
            $privacy = '1';
        } elseif ($privacy == 'Only me') {
            $privacy = '2';
        }
    }

    if (isset($_POST['avatar_status']) || isset($_POST['cover_status'])) {
        $avatar_status = trim(filter_input(INPUT_POST, "avatar_status", FILTER_SANITIZE_STRING));
        $cover_status = trim(filter_input(INPUT_POST, "cover_status", FILTER_SANITIZE_STRING));
    } else {
        $avatar_status = '';
        $cover_status = '';
    }
                  
    if ($status != '' || $image_url != '') {
        $id_user = $_SESSION['id'];
        //Get hashtag in POST
        $hashtag = trim(gethashtags($status));
        $video = '';
        $video_thumb = '';
        $video_url = trim(filter_input(INPUT_POST, "v_url", FILTER_SANITIZE_STRING));
        $video_url_thumb = trim(filter_input(INPUT_POST, "v_thumb", FILTER_SANITIZE_STRING));
        $video_url_type = trim(filter_input(INPUT_POST, "v_type", FILTER_SANITIZE_STRING));
        $video_url_desc = trim(filter_input(INPUT_POST, "v_desc", FILTER_SANITIZE_STRING));
        $video_url_title = trim(filter_input(INPUT_POST, "v_title", FILTER_SANITIZE_STRING));
        $video_url_class = trim(filter_input(INPUT_POST, "v_type", FILTER_SANITIZE_STRING));
        $link_url = trim(filter_input(INPUT_POST, "link_url", FILTER_SANITIZE_STRING));
        $link_title_url = trim(filter_input(INPUT_POST, "url_title", FILTER_SANITIZE_STRING));
        $link_img_url = trim(filter_input(INPUT_POST, "url_image", FILTER_SANITIZE_STRING));
        $link_desc_url = trim(filter_input(INPUT_POST, "url_desc", FILTER_SANITIZE_STRING));
        $date_post = date('Y-m-d');
        $time_post = time();
        $likes = '';
        $share = '';
        $location = '';
        $user_share = '';
        $pid_share = '';
        $username = getusername($status);

        $pid = insert_post($id_user, $status, $hashtag, $image_url, $image_url_thumb, $video, $video_thumb, $video_url, $video_url_thumb, $video_url_type, $video_url_desc, $video_url_title, $video_url_class, $link_url, $link_title_url, $link_img_url, $link_desc_url, $date_post, $time_post, $likes, $share, $location, $user_share, $pid_share, $avatar_status, $cover_status, $privacy, $adult_content_score);
        TagNotifUsername($status, $pid);
        TagNotifUsername2($status, $pid);

        $row['pid'] = $pid;
        $row['privacy'] = $privacy;
        $row['id_user'] = $id_user;
        $row['time_post'] = $time_post;
        $row['texts'] = $status;
        $row['image_url'] = $image_url;
        $row['user_share'] = $user_share;
        $row['video_url'] = $video_url;
        $row['video_url_thumb'] = $video_url_thumb;
        $row['video_url_type'] = $video_url_type;
        $row['video_url_desc'] = $video_url_desc;
        $row['video_url_title'] = $video_url_title;
        $row['video_url_class'] = $video_url_class;
        $row['link_url'] = $link_url;
        $row['link_title_url'] =  $link_title_url;
        $row['link_img_url'] = $link_img_url;
        $row['link_desc_url'] = $link_desc_url;
        $row['adult_content_score'] = $adult_content_score;
    }
