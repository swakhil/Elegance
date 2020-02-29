<?php
// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+
include '../functions/functions.php';
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $email = select_sqlarg('users', 'id', $id, 'email');
    $id_admin = select_sqlarg('admin', 'email', $email, 'id');
    $_SESSION['aid'] = $id_admin;
    //Prevent CSRF attack
    $token = generate_token($name = $id_admin);
    unset($_SESSION['id']);
    redirect($site_url.'admin/');
}
