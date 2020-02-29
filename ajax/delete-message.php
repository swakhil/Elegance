<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    $mid = trim(filter_input(INPUT_POST, 'mid', FILTER_SANITIZE_STRING));
    $data_mid = trim(filter_input(INPUT_POST, 'data_mid', FILTER_SANITIZE_STRING));
    $data_mid = crypt_data($data_mid, 'd');
    if ($data_mid == '0') {
        delete_msg_user_from($mid);
    } elseif ($data_mid == '1') {
        delete_msg_user_to($mid);
    }
}
