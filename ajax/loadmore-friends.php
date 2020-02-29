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
    if (!empty($_POST['last-id'])) {

    //Format and Sanitize Variables
        $last_id = trim(filter_input(INPUT_POST, "last-id", FILTER_SANITIZE_STRING));
        $id = trim(filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING));
        $page = trim(filter_input(INPUT_POST, "page", FILTER_SANITIZE_STRING));

        if ($page == 'photos') {
            $data = show_friends_loadmore($last_id, $id, $page, '10');
            foreach ($data as $row) {
                include '../includes/load-photos.php';
            }
        } else {
            $data = show_friends_loadmore($last_id, $id, $page, '4');
            foreach ($data as $row) {
                include '../includes/load.php';
            }
        }
    }
}
