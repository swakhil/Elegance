<?php

if (file_exists('../../functions/connect.php')) {
    include_once '../../functions/connect.php';
}
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_double($website_url.'admin/', $website_url.'admin/users', $name = $id_csrf)) {
    $id = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING));
    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
    $sex = trim(filter_input(INPUT_POST, 'sex', FILTER_SANITIZE_STRING));
    $birthday = trim(filter_input(INPUT_POST, 'birthday', FILTER_SANITIZE_STRING));
    $country = trim(filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING));
    $code = trim(filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING));
    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $language = trim(filter_input(INPUT_POST, 'language', FILTER_SANITIZE_STRING));
    $date_signin = trim(filter_input(INPUT_POST, 'date_signin', FILTER_SANITIZE_STRING));

    $update = update_users_adm($id, $firstname, $lastname, $email, $sex, $birthday, $country, $code, $username, $language, $date_signin);

    if ($update == '1') {
        include 'show-table.php';
    } elseif ($update == '0') {
        $msg = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Unknown Error! Please try again!</div>";
        die($msg);
    }
}
