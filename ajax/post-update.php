<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    $pid = trim(filter_input(INPUT_POST, 'pid', FILTER_SANITIZE_STRING));
    $desc = trim(filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING));
    $desc = html_entity_decode($desc, ENT_QUOTES, 'UTF-8');
    $update_post = update_post($pid, $desc);
    echo convert_links(nl2br($update_post));
}
