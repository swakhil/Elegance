<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


include_once '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (!empty($_POST['lastpid'])) {

    //Format and Sanitize Variables
        $pid = trim(filter_input(INPUT_POST, "lastpid", FILTER_SANITIZE_STRING));
        $id = trim(filter_input(INPUT_POST, "id_user", FILTER_SANITIZE_STRING));
        $page = trim(filter_input(INPUT_POST, "page", FILTER_SANITIZE_STRING));

        $data = show_timeline_loadmore($pid, '4', $page, $id);
        foreach ($data as $row) {
            include '../includes/post.php';
        }
    }
}
