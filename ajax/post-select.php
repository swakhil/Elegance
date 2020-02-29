<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    $pid = trim(filter_input(INPUT_POST, 'pid', FILTER_SANITIZE_STRING));
    $select_post = select_sqlarg('posts', 'pid', $pid, 'texts');
    echo convert_links(nl2br($select_post));
}
