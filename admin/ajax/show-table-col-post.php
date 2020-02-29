<?php
if (file_exists('../../functions/connect.php')) {
    include_once '../../functions/connect.php';
}
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_double($website_url.'admin/', $website_url.'admin/posts', $name = $id_csrf)) {
    $pid = trim(filter_input(INPUT_POST, 'pid', FILTER_SANITIZE_STRING));
    $data = show_users_post_id($pid, '1');
    include 'show-table-post.php';
}
