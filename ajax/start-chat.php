<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    $cvid = trim(filter_input(INPUT_POST, "cvid", FILTER_SANITIZE_STRING));
    $id_user = trim(filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING));
    if ($cvid == '') {
        //Create a conversation
        $cvid  = create_conversation(returnID(), $id_user);
    }
    $id_chat = trim(filter_input(INPUT_POST, "id_chat", FILTER_SANITIZE_STRING));
    $start_chat = start_chat($id_chat, $cvid, $id_user);
}
