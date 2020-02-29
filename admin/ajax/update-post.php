<?php

if (file_exists('../../functions/connect.php')) {
    include_once '../../functions/connect.php';
}
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_double($website_url.'admin/', $website_url.'admin/posts', $name = $id_csrf)) {
    $pid = trim(filter_input(INPUT_POST, 'pid', FILTER_SANITIZE_STRING));
    $id_user = trim(filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_STRING));
    $texts = trim(filter_input(INPUT_POST, 'texts', FILTER_SANITIZE_STRING));
    $hashtag = trim(filter_input(INPUT_POST, 'hashtag', FILTER_SANITIZE_STRING));
    $image_url = trim(filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_STRING));
    $date_post = trim(filter_input(INPUT_POST, 'date_post', FILTER_SANITIZE_STRING));
    $likes = trim(filter_input(INPUT_POST, 'likes', FILTER_SANITIZE_STRING));
    $share = trim(filter_input(INPUT_POST, 'share', FILTER_SANITIZE_STRING));
    $adult_content_score = trim(filter_input(INPUT_POST, 'adult_content_score', FILTER_SANITIZE_STRING));
    $privacy = trim(filter_input(INPUT_POST, 'privacy', FILTER_SANITIZE_STRING));

    $update = update_posts_adm($pid, $id_user, $texts, $hashtag, $image_url, $date_post, $likes, $share, $adult_content_score, $privacy);

    if ($update == '1') {
        $data = show_users_post_id($pid, '1');
        include 'show-table-post.php';
    } elseif ($update == '0') {
        $msg = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Unknown Error! Please try again!</div>";
        die($msg);
    }
}
