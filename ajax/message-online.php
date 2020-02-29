<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_POST['u'])) {
        $u = trim(filter_input(INPUT_POST, "u", FILTER_SANITIZE_STRING));
        $id = select_sqlarg('users', 'username', $u, 'id');
        $time_online = select_sqlarg('online', 'online_user', $id, 'online_time');
        $online = getConnected($time_online);
        die($online);
    }
}
