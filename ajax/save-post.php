<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_POST['pid']) && $_POST['pid'] != '') {
        //Format and Sanitize
        $key = trim(filter_input(INPUT_POST, "pid", FILTER_SANITIZE_STRING));
        $key_db = select_sqlarg('saved', 'save', $key, 'save');
        if ($key_db == $key) {
            $return = '0';
            die($return);
        } else {
            $parameter = 'pid';
            save($key, $parameter);
            $return = '1';
            die($return);
        }
    }
}
