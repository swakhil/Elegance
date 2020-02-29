<?php
// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+
include 'functions/functions.php';
if (isset($_SESSION['aid'])) {
    $id = $_SESSION['aid'];
    $email = select_sqlarg('admin', 'id', $id, 'email');
    $id_user = select_sqlarg('users', 'email', $email, 'id');
    $_SESSION['id'] = $id_user;
    //Prevent CSRF attack
    $token = generate_token($name = $id_user);
    unset($_SESSION['aid']);
    redirect($site_url);
}
