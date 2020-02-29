<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    $id = returnID();
    $privacy = trim(filter_input(INPUT_POST, 'privacy', FILTER_SANITIZE_STRING));

    if (isset($_POST['privacy'])) {
        if ($privacy == 'Public') {
            $privacy = '0';
        } elseif ($privacy == 'Followers') {
            $privacy = '1';
        } elseif ($privacy == 'Only me') {
            $privacy = '2';
        }
    }

    update_sql_arg('users', 'privacy', $privacy, 'id', $id);
}
