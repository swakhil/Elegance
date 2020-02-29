<?php
require '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_SESSION['id'])) {
        $firstname = trim(filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_STRING));
        $lastname = trim(filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_STRING));
        $username = trim(filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING));
        $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING));
        $sex = trim(filter_input(INPUT_POST, "sex", FILTER_SANITIZE_STRING));
        $birthday = trim(filter_input(INPUT_POST, "birthday", FILTER_SANITIZE_STRING));
        $country = trim(filter_input(INPUT_POST, "country", FILTER_SANITIZE_STRING));
        $about = trim(filter_input(INPUT_POST, "about", FILTER_SANITIZE_STRING));
        $msg = '';

        if ($firstname != '' && $lastname != '' && $username != '' && $email != '' && $sex != '' && $birthday != '' && $country != '' && $about != '') {
            update_sql_arg('users', 'firstname', $firstname, 'id', returnID());
            update_sql_arg('users', 'lastname', $lastname, 'id', returnID());
            update_sql_arg('users', 'sex', $sex, 'id', returnID());
            update_sql_arg('users', 'birthday', $birthday, 'id', returnID());
            update_sql_arg('users', 'country', $country, 'id', returnID());
            update_sql_arg('users', 'about', $about, 'id', returnID());

            if ($username == select_sql('username')) {
                update_sql_arg('users', 'username', $username, 'id', returnID());
                $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Updated!</div>";
            } elseif (is_already_in_use('username', $username, 'users')) {
                $msg = "<div class='alert alert-warning' role='alert'>
                     <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*username adress already in use!</div>";
            } else {
                update_sql_arg('users', 'username', $username, 'id', returnID());
                $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Updated!</div>";
            }

            if ($email == select_sql('email')) {
                $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Updated!</div>";
            } elseif (is_already_in_use('email', $email, 'users')) {
                $msg = "<div class='alert alert-warning' role='alert'>
                     <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Email adress already in use!</div>";
            } else {
                $email_user = $email;
                update_sql_arg('users', 'forget_pwd', '1', 'id', returnID());
                $id_email = select_sql('id');
                include '../includes/email_reset.php';
                $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Updated! A mail has been sent to : ".$email_user.". Please confirm to update your email address.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error! All champs are required.</div>";
        }
        die($msg);
    }
}
