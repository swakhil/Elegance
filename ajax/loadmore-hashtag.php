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
    if (!empty($_POST['lastpid'])) {

    //Format and Sanitize Variables
        $last_post_id = trim(filter_input(INPUT_POST, "lastpid", FILTER_SANITIZE_STRING));
        $hashtag = trim(filter_input(INPUT_POST, "hashtag", FILTER_SANITIZE_STRING));
        $page = trim(filter_input(INPUT_POST, "page", FILTER_SANITIZE_STRING));
        $data = search_hashtag_loadmore($hashtag, '4', $last_post_id);
        foreach ($data as $row) {
            ?>
        <i class="pointer-hashtag" id="<?php echo $hashtag; ?>"></i>
         <?php
         include '../includes/post.php';
        }
    }
}
