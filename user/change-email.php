<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


require '../functions/functions.php';


if (isset($_GET['t']) && isset($_GET['i']) && isset($_GET['e'])) {
    $token = trim(filter_input(INPUT_GET, 't', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_GET, 'e', FILTER_SANITIZE_STRING));
    $email = crypt_data($email, 'd');
    $id = trim(filter_input(INPUT_GET, 'i', FILTER_SANITIZE_STRING));
    $id = crypt_data($id, 'd');
    $password_db = select_sql_id($id, 'password');
    $token_db = sha1($password_db.$email);
    $forget_pwd = select_sql_id($id, 'forget_pwd');

    if ($token == $token_db && is_already_in_use('id', $id, 'users') && $forget_pwd == '1') {
        update_sql_arg('users', 'email', $email, 'id', $id);
        update_sql_arg('users', 'forget_pwd', '0', 'id', $id);
        redirect($site_url.'user/settings?ml='.crypt_data("1", "e"));
    } else {
        redirect($site_url.'404');
    }
} else {
    redirect($site_url.'404');
}
