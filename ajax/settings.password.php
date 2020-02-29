<?php
require '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_SESSION['id'])) {
        $password = trim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));
        $newpassword = trim(filter_input(INPUT_POST, "newpassword", FILTER_SANITIZE_STRING));
        $newpasswordagain = trim(filter_input(INPUT_POST, "newpasswordagain", FILTER_SANITIZE_STRING));
        $passworddb= select_sql('password');
        $msg = '';

        if ($password != '' && $newpassword != '' && $newpasswordagain != '') {
            if ($newpassword == $newpasswordagain) {
                if (password_verify($password, $passworddb)) {
                    if (mb_strlen($newpassword) < 8) {
                        $msg = "<div class='alert alert-danger' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Your password must contain eight characters.</div>";
                    } else {
                        $newpassword = crypt($newpassword, '$6$rl$stringforsalt$');
                        update_sql_arg('users', 'password', $newpassword, 'id', returnID());
                        $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Password Updated!</div>";
                    }
                } else {
                    $msg = "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Incorrect Password! Enter your actual password.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Passwords doesn't match! /div>";
            }
        } else {
            $msg = "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error! All champs are required.</div>";
        }

        die($msg);
    }
}
