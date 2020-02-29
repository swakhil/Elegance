<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


require '../functions/functions.php';
$token = trim(filter_input(INPUT_GET, 't', FILTER_SANITIZE_STRING));
$id = crypt_data(trim(filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING)), 'd');
$id = select_sqlarg('users', 'id', $id, 'id');

if ($id != '') {
    $password = select_sqlarg('users', 'id', $id, 'password');
    $email = select_sqlarg('users', 'id', $id, 'email');
    $token_local = sha1($password.$email);
    if ($token == $token_local) {
        update_active($id);
        //Prevent CSRF attack
        $token = generate_token($name = $id);
        $_SESSION['id'] = $id;
        redirect($site_url.'user/avatar');
    } else {
        redirect($site_url);
    }
} else {
    redirect($site_url.'404');
}
