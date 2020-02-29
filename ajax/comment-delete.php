<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    $cid = trim(filter_input(INPUT_POST, 'cid', FILTER_SANITIZE_STRING));

    $id_user_com = $_SESSION['id'];
    $cpid = select_sqlarg('comments', 'cid', $cid, 'cpid');
    $id_post_owner = select_sqlarg('posts', 'pid', $cpid, 'id_user');
    DeleteNotifications($id_user_com, $id_post_owner, 'post', 'comment', $cpid);
    //delete_comment($cid);
    deleteSQL('comments', 'cid', $cid);
}
